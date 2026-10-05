<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Laboratory;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of departments.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Department Query
        |--------------------------------------------------------------------------
        */

        $query = Department::query();

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            $query->where(function ($q) use ($search) {
                $q->where('department_name', 'like', '%' . $search . '%')
                    ->orWhere('faculty', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Faculty Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('faculty')) {
            $query->where('faculty', $request->input('faculty'));
        }

        /*
        |--------------------------------------------------------------------------
        | Departments
        |--------------------------------------------------------------------------
        |
        | withCount() provides:
        | - users_count
        | - laboratories_count
        |
        */

        $departments = $query
            ->withCount([
                'users',
                'laboratories',
            ])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Faculty List
        |--------------------------------------------------------------------------
        */

        $faculties = Department::query()
            ->whereNotNull('faculty')
            ->where('faculty', '!=', '')
            ->select('faculty')
            ->distinct()
            ->orderBy('faculty')
            ->pluck('faculty');

        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $totalDepartments = Department::count();
        $totalUsers = User::count();
        $totalLaboratories = Laboratory::count();

        /*
        |--------------------------------------------------------------------------
        | Return Department Management Page
        |--------------------------------------------------------------------------
        */

        return view('page.departments', [
            'departments' => $departments,
            'faculties' => $faculties,
            'totalDepartments' => $totalDepartments,
            'totalUsers' => $totalUsers,
            'totalLaboratories' => $totalLaboratories,
        ]);
    }

    /**
     * Store a newly created department.
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(
            [
                'department_name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'faculty' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'description' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],
            ],
            [
                'department_name.required' =>
                    'Please enter the department name.',

                'department_name.string' =>
                    'Department name must be a valid text.',

                'department_name.max' =>
                    'Department name cannot exceed 255 characters.',

                'faculty.required' =>
                    'Please enter the faculty.',

                'faculty.string' =>
                    'Faculty must be a valid text.',

                'faculty.max' =>
                    'Faculty cannot exceed 255 characters.',

                'description.max' =>
                    'Description cannot exceed 1000 characters.',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Create Department
        |--------------------------------------------------------------------------
        */

        Department::create($validated);

        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('department.index')
            ->with('success', 'Department created successfully.');
    }

    /**
     * Display the specified department.
     */
    public function show(Department $department)
    {
        /*
        |--------------------------------------------------------------------------
        | Load Department Relationships
        |--------------------------------------------------------------------------
        |
        | The department-show Blade page uses:
        | - $department->users
        | - $department->laboratories
        |
        */

        $department->load([
            'users',
            'laboratories',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Return Department Details Page
        |--------------------------------------------------------------------------
        */

        return view(
            'page.department-show',
            compact('department')
        );
    }

    /**
     * Update the specified department.
     */
    public function update(Request $request, Department $department)
    {
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(
            [
                'department_name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'faculty' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'description' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],
            ],
            [
                'department_name.required' =>
                    'Please enter the department name.',

                'department_name.string' =>
                    'Department name must be a valid text.',

                'department_name.max' =>
                    'Department name cannot exceed 255 characters.',

                'faculty.required' =>
                    'Please enter the faculty.',

                'faculty.string' =>
                    'Faculty must be a valid text.',

                'faculty.max' =>
                    'Faculty cannot exceed 255 characters.',

                'description.max' =>
                    'Description cannot exceed 1000 characters.',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Update Department
        |--------------------------------------------------------------------------
        */

        $department->update($validated);

        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('department.index')
            ->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified department.
     */
    public function destroy(Department $department)
    {
        /*
        |--------------------------------------------------------------------------
        | Prevent Delete When Users Exist
        |--------------------------------------------------------------------------
        */

        if ($department->users()->exists()) {
            return redirect()
                ->route('department.index')
                ->with(
                    'error',
                    'This department cannot be deleted because it has users.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Prevent Delete When Laboratories Exist
        |--------------------------------------------------------------------------
        */

        if ($department->laboratories()->exists()) {
            return redirect()
                ->route('department.index')
                ->with(
                    'error',
                    'This department cannot be deleted because it has laboratories.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Department
        |--------------------------------------------------------------------------
        */

        $department->delete();

        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('department.index')
            ->with(
                'success',
                'Department deleted successfully.'
            );
    }
}

