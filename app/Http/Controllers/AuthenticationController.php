<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\User;
use App\Models\Department;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    /**
     * Get a system setting value.
     */
    private function getSetting(string $key, string $default = '0'): string
    {
        return Setting::where('setting_key', $key)
            ->value('setting_value') ?? $default;
    }

    /**
     * Check whether user registration is enabled.
     */
    private function registrationAllowed(): bool
    {
        return $this->getSetting('allow_registration', '1') === '1';
    }

    /**
     * Check whether account verification is required.
     */
    private function verificationRequired(): bool
    {
        return $this->getSetting('require_verification', '0') === '1';
    }

    /**
     * Show Register Page.
     */
    public function register()
    {
        /*
        |--------------------------------------------------------------------------
        | Check Allow User Registration Setting
        |--------------------------------------------------------------------------
        */

        if (!$this->registrationAllowed()) {
            return redirect()
                ->route('login')
                ->with(
                    'status',
                    'User registration is currently disabled.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Get Departments
        |--------------------------------------------------------------------------
        */

        $departments = Department::all();

        return view('auth.register', compact('departments'));
    }

    /**
     * Handle Register.
     */
    public function storeRegister(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Check Allow User Registration Setting
        |--------------------------------------------------------------------------
        */

        if (!$this->registrationAllowed()) {
            return redirect()
                ->route('login')
                ->with(
                    'status',
                    'User registration is currently disabled.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Validate Registration
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            /*
            |--------------------------------------------------------------------------
            | Public Users Cannot Register as Admin
            |--------------------------------------------------------------------------
            */

            'role' => [
                'required',
                'in:Student,Staff,Technician,student,staff,technician',
            ],

            'department_id' => [
                'required',
                'exists:departments,id',
            ],

            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],

            'terms' => [
                'required',
                'accepted',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Normalize Role
        |--------------------------------------------------------------------------
        */

        $role = ucfirst(strtolower($request->role));

        /*
        |--------------------------------------------------------------------------
        | Determine Account Status
        |--------------------------------------------------------------------------
        */

        if ($role === 'Admin') {
            $status = 'Active';
        } else {
            $status = $this->verificationRequired()
                ? 'InActive'
                : 'Active';
        }

        /*
        |--------------------------------------------------------------------------
        | Create User Data
        |--------------------------------------------------------------------------
        */

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department_id' => $request->department_id,
            'role' => $role,
            'status' => $status,
        ];

        /*
        |--------------------------------------------------------------------------
        | Save Phone Number
        |--------------------------------------------------------------------------
        */

        if ($request->filled('phone')) {
            $userData['phone'] = $request->phone;
        }

        /*
        |--------------------------------------------------------------------------
        | Create User
        |--------------------------------------------------------------------------
        */

        $newUser = User::create($userData);

        /*
        |--------------------------------------------------------------------------
        | Audit Registration
        |--------------------------------------------------------------------------
        |
        | Registration happens before authentication.
        | Therefore, explicitly pass the new user's ID
        | as argument #6.
        |
        */

        AuditLog::record(
            'create',
            'Users',
            'New ' . $role . ' account registered: ' . $newUser->name,
            null,
            [
                'user_id' => $newUser->id,
                'name' => $newUser->name,
                'email' => $newUser->email,
                'role' => $newUser->role,
                'status' => $newUser->status,
                'department_id' => $newUser->department_id,
            ],
            $newUser->id
        );

        /*
        |--------------------------------------------------------------------------
        | Registration Success Message
        |--------------------------------------------------------------------------
        */

        if ($role !== 'Admin' && $this->verificationRequired()) {
            return redirect()
                ->route('login')
                ->with(
                    'status',
                    'Registration successful. Your account is waiting for verification. Please contact the administrator.'
                );
        }

        return redirect()
            ->route('login')
            ->with(
                'status',
                'Registration successful. Please login.'
            );
    }

    /**
     * Show Login Page.
     */
    public function login()
    {
        /*
        |--------------------------------------------------------------------------
        | Already Logged In
        |--------------------------------------------------------------------------
        */

        if (Auth::check()) {
            return $this->redirectByRole();
        }

        return view('auth.login');
    }

    /**
     * Handle Login.
     */
    public function storeLogin(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate Login
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
                'string',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Login Credentials
        |--------------------------------------------------------------------------
        */

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        /*
        |--------------------------------------------------------------------------
        | Attempt Login
        |--------------------------------------------------------------------------
        */

        if (!Auth::attempt($credentials)) {

            /*
            |--------------------------------------------------------------------------
            | Failed Login Audit
            |--------------------------------------------------------------------------
            |
            | There is no authenticated user here,
            | so user_id remains null.
            |
            */

            AuditLog::record(
                'failed login',
                'Authentication',
                'Failed login attempt for email: ' . $request->email
            );

            return back()
                ->withErrors([
                    'email' => 'Invalid email or password.',
                ])
                ->onlyInput('email');
        }

        /*
        |--------------------------------------------------------------------------
        | Regenerate Session
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerate();

        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Check Account Verification / Status
        |--------------------------------------------------------------------------
        |
        | Admin is excluded from verification.
        |
        | Admin can always login.
        |
        | Student / Staff / Technician are checked
        | only when verification is enabled.
        |
        */

        if (
            $user->role !== 'Admin' &&
            $this->verificationRequired() &&
            $user->status !== 'Active'
        ) {

            /*
            |--------------------------------------------------------------------------
            | Audit Unverified Login Attempt
            |--------------------------------------------------------------------------
            */

            AuditLog::record(
                'failed login',
                'Authentication',
                'Login blocked because account is not verified: ' . $user->name,
                null,
                [
                    'email' => $user->email,
                    'role' => $user->role,
                    'status' => $user->status,
                    'reason' => 'Account not verified',
                ],
                $user->id
            );

            /*
            |--------------------------------------------------------------------------
            | Logout Unverified User
            |--------------------------------------------------------------------------
            */

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with(
                    'status',
                    'Your account has not been verified yet. Please contact the administrator.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Update Last Seen
        |--------------------------------------------------------------------------
        */

        $user->update([
            'last_seen_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Audit Successful Login
        |--------------------------------------------------------------------------
        |
        | The user ID belongs in argument #6.
        |
        */

        AuditLog::record(
            'login',
            'Authentication',
            $user->name . ' logged into the system.',
            null,
            [
                'email' => $user->email,
                'role' => $user->role,
                'status' => $user->status,
            ],
            $user->id
        );

        /*
        |--------------------------------------------------------------------------
        | Redirect Based On Role
        |--------------------------------------------------------------------------
        */

        return $this->redirectByRole();
    }

    /**
     * Redirect User Based On Role.
     */
    private function redirectByRole()
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'Admin') {
            return redirect()->route('dashboard.index');
        }

        /*
        |--------------------------------------------------------------------------
        | STAFF
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'Staff') {
            return redirect()->route('homepage');
        }

        /*
        |--------------------------------------------------------------------------
        | STUDENT
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'Student') {
            return redirect()->route('homepage');
        }

        /*
        |--------------------------------------------------------------------------
        | TECHNICIAN
        |--------------------------------------------------------------------------
        |
        | Technician goes directly to:
        |
        | /technical/reports
        |
        | TechnicalReportController@index
        |
        */

        if ($user->role === 'Technician') {
            return redirect()->route('technical.reports.index');
        }

        /*
        |--------------------------------------------------------------------------
        | UNKNOWN ROLE
        |--------------------------------------------------------------------------
        */

        AuditLog::record(
            'security',
            'Authentication',
            'User was logged out because the account role is not configured correctly.',
            null,
            [
                'role' => $user->role,
            ],
            $user->id
        );

        Auth::logout();

        return redirect()
            ->route('login')
            ->withErrors([
                'email' => 'Your account role is not configured correctly.',
            ]);
    }

    /**
     * Logout.
     */
    public function logout(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Get Current User BEFORE Logout
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Audit Logout BEFORE Auth::logout()
        |--------------------------------------------------------------------------
        |
        | The user ID is argument #6.
        |
        */

        if ($user) {
            AuditLog::record(
                'logout',
                'Authentication',
                $user->name . ' logged out of the system.',
                null,
                [
                    'email' => $user->email,
                    'role' => $user->role,
                ],
                $user->id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Logout
        |--------------------------------------------------------------------------
        */

        Auth::logout();

        /*
        |--------------------------------------------------------------------------
        | Invalidate Session
        |--------------------------------------------------------------------------
        */

        $request->session()->invalidate();

        /*
        |--------------------------------------------------------------------------
        | Regenerate CSRF Token
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerateToken();

        /*
        |--------------------------------------------------------------------------
        | Redirect To Login
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('login')
            ->with(
                'status',
                'You have been logged out successfully.'
            );
    }
}
