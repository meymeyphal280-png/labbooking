<?php
namespace App\Http\Controllers;
use App\Models\Equipment;
use App\Models\Laboratory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class EquipmentController extends Controller
{
    /**
     * Get the actual category table name.
     */
    private function categoryTable(): string
    {
        if (Schema::hasTable('category__eps')) {
            return 'category__eps';
        }

        if (Schema::hasTable('category__e_p_s')) {
            return 'category__e_p_s';
        }

        return 'category__eps';
    }

    /**
     * Display equipment inventory.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | STATISTICS
        |--------------------------------------------------------------------------
        */

        $totalEquipment = Equipment::count();

        $activeUnits = Equipment::query()
            ->where('status', 'Active')
            ->where(function ($query) {
                $query->whereNull('condition')
                    ->orWhere('condition', '!=', 'Broken');
            })
            ->sum('quantity');

        $inRepair = Equipment::query()
            ->where('status', 'Repair')
            ->sum('quantity');

        $broken = Equipment::query()
            ->where('condition', 'Broken')
            ->sum('quantity');

        /*
        |--------------------------------------------------------------------------
        | EQUIPMENT QUERY
        |--------------------------------------------------------------------------
        */

        $query = Equipment::with([
            'laboratory',
            'category',
        ]);

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            $query->where(function ($q) use ($search) {
                $q->where(
                    'equipment_name',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'equipment_code',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'serial_number',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'brand',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'description',
                    'like',
                    '%' . $search . '%'
                );
            });
        }

        /*
        |--------------------------------------------------------------------------
        | LABORATORY FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('laboratory_id')) {
            $query->where(
                'laboratory_id',
                $request->input('laboratory_id')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CATEGORY FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category_id')) {
            $query->where(
                'category_id',
                $request->input('category_id')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | STATUS FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->input('status')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CONDITION FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('condition')) {
            $query->where(
                'condition',
                $request->input('condition')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */

        $equipment = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | LABORATORIES
        |--------------------------------------------------------------------------
        */

        $laboratories = Laboratory::orderBy(
            'lab_name'
        )->get();

        /*
        |--------------------------------------------------------------------------
        | CATEGORIES
        |--------------------------------------------------------------------------
        */

        $categoryTable = $this->categoryTable();

        $categories = Category::from($categoryTable)
            ->orderBy('category')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view('page.equipment', [
            'equipment'      => $equipment,
            'laboratories'   => $laboratories,
            'categories'     => $categories,
            'totalEquipment' => $totalEquipment,
            'activeUnits'    => $activeUnits,
            'inRepair'       => $inRepair,
            'broken'         => $broken,
            'editEquipment'  => null,
        ]);
    }

    /**
     * Store new equipment.
     */
    public function store(Request $request)
    {
        $categoryTable = $this->categoryTable();

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'equipment_name' => [
                'required',
                'string',
                'max:255',
            ],

            'equipment_code' => [
                'required',
                'string',
                'max:255',
                'unique:equipment,equipment_code',
            ],

            'serial_number' => [
                'nullable',
                'string',
                'max:255',
            ],

            'laboratory_id' => [
                'required',
                'exists:laboratories,id',
            ],

            'category_id' => [
                'required',
                'exists:' . $categoryTable . ',id',
            ],

            'brand' => [
                'nullable',
                'string',
                'max:255',
            ],

            'purchase_date' => [
                'nullable',
                'date',
            ],

            'condition' => [
                'required',
                Rule::in([
                    'Good',
                    'Fair',
                    'Broken',
                ]),
            ],

            'status' => [
                'required',
                Rule::in([
                    'Active',
                    'Repair',
                    'Missing',
                    'Disposed',
                ]),
            ],

            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],

            /*
            |--------------------------------------------------------------------------
            | DESCRIPTION
            |--------------------------------------------------------------------------
            */

            'description' => [
                'nullable',
                'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | IMAGE
            |--------------------------------------------------------------------------
            */

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | CLEAN DESCRIPTION
        |--------------------------------------------------------------------------
        */

        if (isset($validated['description'])) {
            $validated['description'] = trim(
                $validated['description']
            );

            if ($validated['description'] === '') {
                $validated['description'] = null;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | STORE IMAGE
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store(
                    'equipment',
                    'public'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE EQUIPMENT
        |--------------------------------------------------------------------------
        */

        Equipment::create($validated);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('equipment.index')
            ->with(
                'success',
                'Equipment added successfully.'
            );
    }

    /**
     * Display the specified equipment.
     */
    public function show(Equipment $equipment)
    {
        $equipment->load([
            'laboratory',
            'category',
        ]);

        return view(
            'page.equipment-show',
            compact('equipment')
        );
    }

    /**
     * Show equipment page with edit modal opened.
     *
     * $equipment is the selected Equipment model.
     * $equipmentList is the paginator used by the table.
     */
    public function edit(
        Request $request,
        Equipment $equipment
    ) {
        /*
        |--------------------------------------------------------------------------
        | LOAD SELECTED EQUIPMENT
        |--------------------------------------------------------------------------
        */

        $equipment->load([
            'laboratory',
            'category',
        ]);

        /*
        |--------------------------------------------------------------------------
        | STATISTICS
        |--------------------------------------------------------------------------
        */

        $totalEquipment = Equipment::count();

        $activeUnits = Equipment::query()
            ->where('status', 'Active')
            ->where(function ($query) {
                $query->whereNull('condition')
                    ->orWhere(
                        'condition',
                        '!=',
                        'Broken'
                    );
            })
            ->sum('quantity');

        $inRepair = Equipment::query()
            ->where('status', 'Repair')
            ->sum('quantity');

        $broken = Equipment::query()
            ->where(
                'condition',
                'Broken'
            )
            ->sum('quantity');

        /*
        |--------------------------------------------------------------------------
        | EQUIPMENT LIST
        |--------------------------------------------------------------------------
        */

        $query = Equipment::with([
            'laboratory',
            'category',
        ]);

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {
            $search = trim(
                $request->input('search')
            );

            $query->where(function ($q) use ($search) {
                $q->where(
                    'equipment_name',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'equipment_code',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'serial_number',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'brand',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'description',
                    'like',
                    '%' . $search . '%'
                );
            });
        }

        /*
        |--------------------------------------------------------------------------
        | FILTERS
        |--------------------------------------------------------------------------
        */

        if ($request->filled('laboratory_id')) {
            $query->where(
                'laboratory_id',
                $request->input('laboratory_id')
            );
        }

        if ($request->filled('category_id')) {
            $query->where(
                'category_id',
                $request->input('category_id')
            );
        }

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->input('status')
            );
        }

        if ($request->filled('condition')) {
            $query->where(
                'condition',
                $request->input('condition')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */

        $equipmentList = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | LABORATORIES
        |--------------------------------------------------------------------------
        */

        $laboratories = Laboratory::orderBy(
            'lab_name'
        )->get();

        /*
        |--------------------------------------------------------------------------
        | CATEGORIES
        |--------------------------------------------------------------------------
        */

        $categoryTable = $this->categoryTable();

        $categories = Category::from($categoryTable)
            ->orderBy('category')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | RETURN EQUIPMENT PAGE
        |--------------------------------------------------------------------------
        */

        return view('page.equipment', [
            'equipment'      => $equipmentList,
            'editEquipment'  => $equipment,
            'laboratories'   => $laboratories,
            'categories'     => $categories,
            'totalEquipment' => $totalEquipment,
            'activeUnits'    => $activeUnits,
            'inRepair'       => $inRepair,
            'broken'         => $broken,
        ]);
    }

    /**
     * Update equipment.
     */
    public function update(
        Request $request,
        Equipment $equipment
    ) {
        $categoryTable = $this->categoryTable();

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'equipment_name' => [
                'required',
                'string',
                'max:255',
            ],

            'equipment_code' => [
                'required',
                'string',
                'max:255',

                Rule::unique(
                    'equipment',
                    'equipment_code'
                )->ignore($equipment->id),
            ],

            'serial_number' => [
                'nullable',
                'string',
                'max:255',
            ],

            'laboratory_id' => [
                'required',
                'exists:laboratories,id',
            ],

            'category_id' => [
                'required',
                'exists:' . $categoryTable . ',id',
            ],

            'brand' => [
                'nullable',
                'string',
                'max:255',
            ],

            'purchase_date' => [
                'nullable',
                'date',
            ],

            'condition' => [
                'required',
                Rule::in([
                    'Good',
                    'Fair',
                    'Broken',
                ]),
            ],

            'status' => [
                'required',
                Rule::in([
                    'Active',
                    'Repair',
                    'Missing',
                    'Disposed',
                ]),
            ],

            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],

            /*
            |--------------------------------------------------------------------------
            | DESCRIPTION
            |--------------------------------------------------------------------------
            */

            'description' => [
                'nullable',
                'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | IMAGE
            |--------------------------------------------------------------------------
            */

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | CLEAN DESCRIPTION
        |--------------------------------------------------------------------------
        */

        if (array_key_exists('description', $validated)) {
            $validated['description'] = trim(
                (string) $validated['description']
            );

            if ($validated['description'] === '') {
                $validated['description'] = null;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE IMAGE
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            /*
            | Delete old image
            */

            if ($equipment->image) {
                Storage::disk('public')->delete(
                    $equipment->image
                );
            }

            /*
            | Store new image
            */

            $validated['image'] = $request
                ->file('image')
                ->store(
                    'equipment',
                    'public'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE EQUIPMENT
        |--------------------------------------------------------------------------
        */

        $equipment->update($validated);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('equipment.index')
            ->with(
                'success',
                'Equipment updated successfully.'
            );
    }

    /**
     * Delete equipment.
     */
    public function destroy(
        Equipment $equipment
    ) {
        /*
        |--------------------------------------------------------------------------
        | DELETE IMAGE
        |--------------------------------------------------------------------------
        */

        if ($equipment->image) {
            Storage::disk('public')->delete(
                $equipment->image
            );
        }

        /*
        |--------------------------------------------------------------------------
        | DELETE EQUIPMENT
        |--------------------------------------------------------------------------
        */

        $equipment->delete();

        return redirect()
            ->route('equipment.index')
            ->with(
                'success',
                'Equipment deleted successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | CATEGORY MANAGEMENT
    |--------------------------------------------------------------------------
    */

    /**
     * Store category.
     */
    public function storeCategory(
        Request $request
    ) {
        $categoryTable = $this->categoryTable();

        $validated = $request->validate([
            'category' => [
                'required',
                'string',
                'max:255',

                'unique:' .
                    $categoryTable .
                    ',category',
            ],
        ]);

        Category::from($categoryTable)
            ->create($validated);

        return redirect()
            ->route('equipment.index')
            ->with(
                'success',
                'Equipment category added successfully.'
            );
    }

    /**
     * Delete category.
     */
    public function destroyCategory(
        Category $category
    ) {
        if ($category->equipment()->exists()) {
            return redirect()
                ->route('equipment.index')
                ->with(
                    'error',
                    'This category cannot be deleted because equipment is using it.'
                );
        }

        $category->delete();

        return redirect()
            ->route('equipment.index')
            ->with(
                'success',
                'Equipment category deleted successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | MAINTENANCE
    |--------------------------------------------------------------------------
    */

    /**
     * Display equipment maintenance page.
     */
    public function maintenance(
        Equipment $equipment
    ) {
        $equipment->load([
            'laboratory',
            'category',
        ]);

        return view(
            'page.equipment-maintenance',
            compact('equipment')
        );
    }
}
