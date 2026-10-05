@extends('layout.welcome')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Header Banner -->
    <div class="bg-blue-600 rounded-2xl p-6 text-white shadow-md mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 bg-blue-500/60 rounded-xl flex items-center justify-center">
                    <i data-lucide="shield-check" class="w-5 h-5 text-white"></i>
                </div>
                <h1 class="text-2xl font-bold">Role & Permission Management</h1>
            </div>
            <p class="text-blue-100 text-sm">
                Review and update access permissions for faculty and students across different laboratory clusters.
            </p>
        </div>
        <a href="{{ route('admin.roles.index') }}" class="px-4 py-2 bg-blue-500/50 hover:bg-blue-500 rounded-xl text-sm font-medium transition-colors text-center self-start md:self-auto">
            Reload Matrix
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm flex items-center gap-2">
            <i data-lucide="check-circle" class="w-4 h-4"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- Matrix Form -->
    <form action="{{ route('admin.roles.update') }}" method="POST">
        @csrf

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden mb-6">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="py-4 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider w-1/3">
                                Permission / Action
                            </th>
                            @foreach($roles as $role)
                                <th class="py-4 px-6 text-xs font-semibold text-slate-700 uppercase tracking-wider text-center">
                                    <span class="inline-block px-3 py-1 bg-slate-200/60 rounded-full text-slate-800">
                                        {{ $role }}
                                    </span>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($permissionModules as $module => $permissions)
                            <!-- Group Header Row -->
                            <tr class="bg-slate-50/50">
                                <td colspan="{{ count($roles) + 1 }}" class="py-3 px-6 text-xs font-bold text-blue-600 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <i data-lucide="folder" class="w-4 h-4"></i>
                                        {{ $module }}
                                    </div>
                                </td>
                            </tr>

                            <!-- Permission Rows -->
                            @foreach($permissions as $key => $label)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="py-3.5 px-6 text-sm text-slate-700 font-medium">
                                        {{ $label }}
                                        <span class="block text-xs font-mono text-slate-400">{{ $key }}</span>
                                    </td>

                                    @foreach($roles as $role)
                                        <td class="py-3.5 px-6 text-center">
                                            <label class="inline-flex items-center justify-center cursor-pointer">
                                                <input 
                                                    type="checkbox" 
                                                    name="permissions[{{ $role }}][]" 
                                                    value="{{ $key }}"
                                                    class="w-4 h-4 text-blue-600 rounded border-slate-300 focus:ring-blue-500 focus:ring-offset-0 transition-all cursor-pointer"
                                                    {{ in_array($key, $assignedPermissions[$role] ?? []) ? 'checked' : '' }}
                                                >
                                            </label>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sticky Footer Action Bar -->
        <div class="sticky bottom-4 bg-white/90 backdrop-blur-md border border-slate-200 shadow-lg rounded-2xl p-4 flex items-center justify-between">
            <p class="text-xs text-slate-500">
                Changes will take effect immediately upon saving.
            </p>
            <div class="flex items-center gap-3">
                <button type="reset" class="px-4 py-2 border border-slate-200 text-slate-600 font-medium text-sm rounded-xl hover:bg-slate-50 transition-colors">
                    Reset
                </button>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold text-sm rounded-xl hover:bg-blue-700 shadow-sm transition-colors flex items-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    Save Changes
                </button>
            </div>
        </div>
    </form>

</div>
@endsection