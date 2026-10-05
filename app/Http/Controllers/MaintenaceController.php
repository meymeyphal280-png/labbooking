<?php

namespace App\Http\Controllers;

use App\Models\Maintenace;
use App\Models\Equipment;
use App\Models\Laboratory;
use App\Models\User;
use Illuminate\Http\Request;

class MaintenaceController extends Controller
{
    /**
     * Display all maintenance records.
     */
    public function index(Request $request)
    {
        $query = Maintenace::with([
            'laboratory',
            'equipment',
            'technician'
        ]);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('issue', 'like', "%{$search}%")

                    ->orWhere('action_taken', 'like', "%{$search}%")

                    ->orWhereHas('equipment', function ($equipment) use ($search) {
                        $equipment->where(
                            'equipment_name',
                            'like',
                            "%{$search}%"
                        );
                    })

                    ->orWhereHas('laboratory', function ($lab) use ($search) {
                        $lab->where(
                            'lab_name',
                            'like',
                            "%{$search}%"
                        );
                    })

                    ->orWhereHas('technician', function ($technician) use ($search) {
                        $technician->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );
                    });
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Date filter
        if ($request->filled('date')) {
            $query->whereDate(
                'maintenance_date',
                $request->date
            );
        }

        // Maintenance records
        $maintenances = $query
            ->latest('maintenance_date')
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | FORM DATA
        |--------------------------------------------------------------------------
        */

        $laboratories = Laboratory::orderBy('lab_name')->get();

        // IMPORTANT:
        // Blade uses $equipmentList
        $equipmentList = Equipment::orderBy('equipment_name')->get();

        $technicians = User::whereIn('role', [
            'Technician',
            'Admin'
        ])
            ->where('status', 'Active')
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | STATISTICS
        |--------------------------------------------------------------------------
        */

        $totalMaintenance = Maintenace::count();

        $pendingMaintenance = Maintenace::where(
            'status',
            'pending'
        )->count();

        $completedMaintenance = Maintenace::where(
            'status',
            'done'
        )->count();

        $totalCost = Maintenace::sum('cost');

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view('page.maintenace', compact(
            'maintenances',
            'equipmentList',
            'laboratories',
            'technicians',
            'totalMaintenance',
            'pendingMaintenance',
            'completedMaintenance',
            'totalCost'
        ));
    }


    /**
     * Display maintenance history for a specific equipment.
     */
    public function equipmentMaintenance(Equipment $equipment)
    {
        /*
        |--------------------------------------------------------------------------
        | Selected equipment
        |--------------------------------------------------------------------------
        */

        $selectedEquipment = $equipment;


        /*
        |--------------------------------------------------------------------------
        | Maintenance records for this equipment
        |--------------------------------------------------------------------------
        */

        $maintenances = Maintenace::with([
            'laboratory',
            'equipment',
            'technician'
        ])
            ->where('equipment_id', $equipment->id)
            ->latest('maintenance_date')
            ->paginate(10);


        /*
        |--------------------------------------------------------------------------
        | Form data
        |--------------------------------------------------------------------------
        */

        $equipmentList = Equipment::orderBy('equipment_name')->get();

        $laboratories = Laboratory::orderBy('lab_name')->get();

        $technicians = User::whereIn('role', [
            'Technician',
            'Admin'
        ])
            ->where('status', 'Active')
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Statistics for this equipment
        |--------------------------------------------------------------------------
        */

        $totalMaintenance = Maintenace::where(
            'equipment_id',
            $equipment->id
        )->count();

        $pendingMaintenance = Maintenace::where(
            'equipment_id',
            $equipment->id
        )
            ->where('status', 'pending')
            ->count();

        $completedMaintenance = Maintenace::where(
            'equipment_id',
            $equipment->id
        )
            ->where('status', 'done')
            ->count();

        $totalCost = Maintenace::where(
            'equipment_id',
            $equipment->id
        )->sum('cost');


        /*
        |--------------------------------------------------------------------------
        | View
        |--------------------------------------------------------------------------
        */

        return view('page.maintenace', compact(
            'selectedEquipment',
            'maintenances',
            'equipmentList',
            'laboratories',
            'technicians',
            'totalMaintenance',
            'pendingMaintenance',
            'completedMaintenance',
            'totalCost'
        ));
    }


    /**
     * Store new maintenance record.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'laboratory_id' => [
                'required',
                'exists:laboratories,id',
            ],

            'equipment_id' => [
                'required',
                'exists:equipment,id',
            ],

            'technician_id' => [
                'required',
                'exists:users,id',
            ],

            'maintenance_date' => [
                'required',
                'date',
            ],

            'issue' => [
                'required',
                'string',
                'max:1000',
            ],

            'action_taken' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'status' => [
                'required',
                'in:pending,done',
            ],

            'cost' => [
                'required',
                'numeric',
                'min:0',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Create maintenance
        |--------------------------------------------------------------------------
        */

        $maintenance = Maintenace::create($validated);


        /*
        |--------------------------------------------------------------------------
        | Update equipment status
        |--------------------------------------------------------------------------
        */

        $equipment = Equipment::find(
            $validated['equipment_id']
        );

        if ($equipment) {

            if ($validated['status'] === 'pending') {

                $equipment->update([
                    'status' => 'Repair',
                ]);

            } elseif ($validated['status'] === 'done') {

                $equipment->update([
                    'status' => 'Active',
                    'condition' => 'Good',
                ]);
            }
        }


        return redirect()
            ->route('maintenance.index')
            ->with(
                'success',
                'Maintenance record added successfully.'
            );
    }


    /**
     * Update maintenance record.
     */
    public function update(
        Request $request,
        Maintenace $maintenance
    ) {
        $validated = $request->validate([

            'action_taken' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'status' => [
                'required',
                'in:pending,done',
            ],

            'cost' => [
                'required',
                'numeric',
                'min:0',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Update maintenance
        |--------------------------------------------------------------------------
        */

        $maintenance->update($validated);


        /*
        |--------------------------------------------------------------------------
        | Update equipment status
        |--------------------------------------------------------------------------
        */

        $equipment = $maintenance->equipment;

        if ($equipment) {

            if ($validated['status'] === 'done') {

                $equipment->update([
                    'status' => 'Active',
                    'condition' => 'Good',
                ]);

            } else {

                $equipment->update([
                    'status' => 'Repair',
                ]);
            }
        }


        return redirect()
            ->route('maintenance.index')
            ->with(
                'success',
                'Maintenance record updated successfully.'
            );
    }


    /**
     * Delete maintenance record.
     */
    public function destroy(Maintenace $maintenance)
    {
        /*
        |--------------------------------------------------------------------------
        | Remember equipment before deleting maintenance
        |--------------------------------------------------------------------------
        */

        $equipment = $maintenance->equipment;


        /*
        |--------------------------------------------------------------------------
        | Delete maintenance
        |--------------------------------------------------------------------------
        */

        $maintenance->delete();


        /*
        |--------------------------------------------------------------------------
        | Update equipment status
        |--------------------------------------------------------------------------
        */

        if ($equipment) {

            $hasPendingMaintenance = Maintenace::where(
                'equipment_id',
                $equipment->id
            )
                ->where('status', 'pending')
                ->exists();


            if (!$hasPendingMaintenance) {

                $equipment->update([
                    'status' => 'Active',
                ]);
            }
        }


        return redirect()
            ->route('maintenance.index')
            ->with(
                'success',
                'Maintenance record deleted successfully.'
            );
    }
}