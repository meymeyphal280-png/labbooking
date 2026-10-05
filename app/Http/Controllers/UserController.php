<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of users with search, filter, metrics, and monthly registration trends.
     */
    public function index(Request $request)
    {
        // Define active status threshold (e.g., active in the last 5 minutes)
        $activeThreshold = Carbon::now()->subMinutes(5);

        // Start building the base query
        $query = User::with('department');

        // Search Keyword (Name or Email)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by Role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filter by Status (Active vs Inactive)
        if ($request->filled('status')) {
           $status = strtolower($request->status);

if ($status == 'active') {

    $query->where('status', 'Active')
          ->where('last_seen_at', '>=', $activeThreshold);

} elseif ($status == 'inactive') {

    $query->where(function ($q) use ($activeThreshold) {

        $q->where('status', 'InActive')
          ->orWhereNull('last_seen_at')
          ->orWhere('last_seen_at', '<', $activeThreshold);

    });

}
        }

        // Metric Card Calculations
        $totalUsers     = User::count();
        $totalStudents  = User::where('role', 'Student')->count();
        $totalLecturers = User::where('role', 'Staff')->count();
        
        // Count ONLY users who are marked active AND seen in the last 5 minutes
      $activeUsers = User::where('status', 'Active')
    ->where('last_seen_at', '>=', $activeThreshold)
    ->count();

        // ------------------------------------------------------------------
        // Dynamic Bar Chart: User Registration Trends (Last 6 Months)
        // ------------------------------------------------------------------
        $chartRows = User::selectRaw("
                YEAR(created_at) as year,
                MONTH(created_at) as month,
                COUNT(*) as total
            ")
            ->where('created_at', '>=', Carbon::now()->subMonths(5)->startOfMonth())
            ->groupByRaw("YEAR(created_at), MONTH(created_at)")
            ->orderByRaw("YEAR(created_at), MONTH(created_at)")
            ->get();

        $rawChartData = [];

        foreach ($chartRows as $row) {
            $monthName = Carbon::create($row->year, $row->month, 1)->format('M');
            $rawChartData[$monthName] = $row->total;
        }

        $monthlyTrends = collect();

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthKey = $date->format('M');

            $monthlyTrends->push([
                'label' => strtoupper($monthKey),
                'count' => $rawChartData[$monthKey] ?? 0,
            ]);
        }

        $maxRegistrations = max($monthlyTrends->pluck('count')->max(), 1);

        // Paginate results with query params preserved
        $users = $query->paginate(6)->withQueryString();

        // Fetch departments for dropdown
        $departments = Department::all();

        return view('page.user', compact(
            'users', 
            'departments', 
            'totalUsers', 
            'totalStudents', 
            'totalLecturers', 
            'activeUsers',
            'monthlyTrends',
            'maxRegistrations'
        ));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', Password::defaults()],
            'department_id' => ['nullable', 'exists:departments,id'],
           'role' => [
    'required',
    'string',
    'in:Admin,Staff,Student,Technician'
],

'status' => [
    'required',
    'string',
    'in:Active,InActive'
],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('user.index')->with('success', 'អ្នកប្រើប្រាស់ត្រូវបានបន្ថែមដោយជោគជ័យ / User created successfully.');
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'department_id' => ['nullable', 'exists:departments,id'],
           'role' => [
    'required',
    'in:Admin,Staff,Student,Technician'
],

'status' => [
    'required',
    'in:Active,InActive'
],
            'password'      => ['nullable', Password::defaults()],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
    
}