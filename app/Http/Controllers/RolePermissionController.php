<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    /**
     * Display the Role & Permission Matrix page.
     */
    public function index()
    {
        // Define roles (can also be loaded from a Role model)
        $roles = ['Admin', 'Staff', 'Student', 'Technician'];

        // Group permissions by cluster/module
        $permissionModules = [
            'Laboratory Access' => [
                'view_labs'        => 'View Laboratory Clusters',
                'reserve_lab'      => 'Reserve Lab Slots',
                'unlock_doors'     => 'Remote Door Access',
            ],
            'Equipment & Assets' => [
                'book_equipment'   => 'Book Lab Equipment',
                'report_issue'     => 'Report Damaged Equipment',
                'maintenance_log'  => 'Manage Maintenance Logs',
            ],
            'User & Role Administration' => [
                'manage_users'     => 'Create / Edit Users',
                'assign_roles'     => 'Manage Roles & Permissions',
            ],
        ];

        // Mock current assignments (replace with model database query like $role->permissions)
        $assignedPermissions = [
            'Admin'      => ['view_labs', 'reserve_lab', 'unlock_doors', 'book_equipment', 'report_issue', 'maintenance_log', 'manage_users', 'assign_roles'],
            'Staff'      => ['view_labs', 'reserve_lab', 'book_equipment', 'report_issue', 'maintenance_log'],
            'Student'    => ['view_labs', 'reserve_lab', 'book_equipment', 'report_issue'],
            'Technician' => ['view_labs', 'book_equipment', 'report_issue', 'maintenance_log'],
        ];

        return view('page.permission', compact('roles', 'permissionModules', 'assignedPermissions'));
    }

    /**
     * Save/Update permission changes.
     */
    public function update(Request $request)
    {
        $request->validate([
            'permissions' => 'nullable|array',
        ]);

        // Process saving matrix values to your DB/Pivot table here...

        return redirect()->back()->with('success', 'Permissions updated successfully!');
    }
}