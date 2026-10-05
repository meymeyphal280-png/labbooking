@extends('layout.welcome')

@section('content')

<div class="min-h-screen bg-slate-50 text-slate-800">

    <div class="mx-auto max-w-5xl px-4 py-6 sm:px-6 lg:px-8 lg:py-8">

        {{-- HEADER --}}
        <div class="mb-6">

            <a
                href="{{ route('audit.index') }}"
                class="mb-4 inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-emerald-600"
            >

                <i data-lucide="arrow-left" class="h-4 w-4"></i>

                Back to Audit Logs

            </a>


            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <div class="mb-2 flex items-center gap-2">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">

                            <i data-lucide="shield-check" class="h-5 w-5"></i>

                        </div>

                        <span class="text-sm font-semibold text-emerald-600">
                            Security Activity
                        </span>

                    </div>

                    <h1 class="text-2xl font-bold text-slate-900">
                        Audit Log Details
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        Detailed information about this system activity.
                    </p>

                </div>


                <button
                    type="button"
                    onclick="deleteAuditLog()"
                    class="inline-flex h-10 items-center justify-center gap-2 rounded-xl bg-red-600 px-4 text-sm font-semibold text-white shadow-sm transition hover:bg-red-700"
                >

                    <i data-lucide="trash-2" class="h-4 w-4"></i>

                    Delete Log

                </button>

            </div>

        </div>


        {{-- MAIN CARD --}}
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

            {{-- TOP --}}
            <div class="border-b border-slate-200 bg-slate-50/70 p-6">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center">

                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-100 text-2xl font-bold text-emerald-700">

                        {{ strtoupper(substr($auditLog->user?->name ?? 'S', 0, 1)) }}

                    </div>


                    <div class="flex-1">

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            User
                        </p>

                        <h2 class="mt-1 text-xl font-bold text-slate-900">
                            {{ $auditLog->user?->name ?? 'System' }}
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            {{ $auditLog->user?->email ?? 'System generated' }}
                        </p>

                    </div>


                    @php

                        $action = strtolower(
                            trim($auditLog->action ?? '')
                        );

                        $actionClasses = match($action) {

                            'login' =>
                                'bg-emerald-50 text-emerald-700 border-emerald-200',

                            'logout' =>
                                'bg-slate-100 text-slate-600 border-slate-200',

                            'create' =>
                                'bg-blue-50 text-blue-700 border-blue-200',

                            'update' =>
                                'bg-amber-50 text-amber-700 border-amber-200',

                            'delete' =>
                                'bg-red-50 text-red-700 border-red-200',

                            'approve' =>
                                'bg-emerald-50 text-emerald-700 border-emerald-200',

                            'reject' =>
                                'bg-red-50 text-red-700 border-red-200',

                            'failed login' =>
                                'bg-red-50 text-red-700 border-red-200',

                            default =>
                                'bg-slate-50 text-slate-600 border-slate-200',
                        };

                    @endphp


                    <span class="inline-flex items-center rounded-xl border px-4 py-2 text-sm font-bold {{ $actionClasses }}">

                        {{ $auditLog->action }}

                    </span>

                </div>

            </div>


            {{-- DETAILS --}}
            <div class="p-6">

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">


                    {{-- MODULE --}}
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-slate-500 shadow-sm">

                                <i data-lucide="folder" class="h-5 w-5"></i>

                            </div>

                            <div>

                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Module
                                </p>

                                <p class="mt-1 text-sm font-bold text-slate-800">
                                    {{ $auditLog->module ?? 'System' }}
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- IP --}}
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-slate-500 shadow-sm">

                                <i data-lucide="globe" class="h-5 w-5"></i>

                            </div>

                            <div>

                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    IP Address
                                </p>

                                <p class="mt-1 font-mono text-sm font-bold text-slate-800">
                                    {{ $auditLog->ip_address ?? '—' }}
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- DATE --}}
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-slate-500 shadow-sm">

                                <i data-lucide="calendar" class="h-5 w-5"></i>

                            </div>

                            <div>

                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Date
                                </p>

                                <p class="mt-1 text-sm font-bold text-slate-800">
                                    {{ $auditLog->created_at?->format('d F Y') }}
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- TIME --}}
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-slate-500 shadow-sm">

                                <i data-lucide="clock" class="h-5 w-5"></i>

                            </div>

                            <div>

                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Time
                                </p>

                                <p class="mt-1 text-sm font-bold text-slate-800">
                                    {{ $auditLog->created_at?->format('h:i:s A') }}
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- USER ID --}}
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-slate-500 shadow-sm">

                                <i data-lucide="user" class="h-5 w-5"></i>

                            </div>

                            <div>

                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    User ID
                                </p>

                                <p class="mt-1 text-sm font-bold text-slate-800">
                                    {{ $auditLog->user_id ?? 'System' }}
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- DEPARTMENT --}}
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-slate-500 shadow-sm">

                                <i data-lucide="building-2" class="h-5 w-5"></i>

                            </div>

                            <div>

                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                    Department
                                </p>

                                <p class="mt-1 text-sm font-bold text-slate-800">

                                    {{ $auditLog->user?->department?->department_name ?? '—' }}

                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- DESCRIPTION --}}
                <div class="mt-6">

                    <div class="mb-2 flex items-center gap-2">

                        <i data-lucide="align-left" class="h-4 w-4 text-emerald-600"></i>

                        <h3 class="text-sm font-bold text-slate-800">
                            Description
                        </h3>

                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">

                        <p class="text-sm leading-7 text-slate-600">

                            {{ $auditLog->description ?: 'No description available.' }}

                        </p>

                    </div>

                </div>


                {{-- USER AGENT --}}
                @if($auditLog->user_agent)

                    <div class="mt-6">

                        <div class="mb-2 flex items-center gap-2">

                            <i data-lucide="monitor" class="h-4 w-4 text-emerald-600"></i>

                            <h3 class="text-sm font-bold text-slate-800">
                                User Agent
                            </h3>

                        </div>

                        <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-slate-50 p-5">

                            <code class="break-all font-mono text-xs leading-6 text-slate-600">
                                {{ $auditLog->user_agent }}
                            </code>

                        </div>

                    </div>

                @endif


                {{-- OLD VALUES --}}
                @if(!empty($auditLog->old_values))

                    <div class="mt-6">

                        <div class="mb-2 flex items-center gap-2">

                            <i data-lucide="history" class="h-4 w-4 text-amber-600"></i>

                            <h3 class="text-sm font-bold text-slate-800">
                                Previous Values
                            </h3>

                        </div>

                        <pre class="overflow-x-auto rounded-2xl border border-amber-200 bg-amber-50 p-5 text-xs leading-6 text-slate-700">{{ json_encode($auditLog->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>

                    </div>

                @endif


                {{-- NEW VALUES --}}
                @if(!empty($auditLog->new_values))

                    <div class="mt-6">

                        <div class="mb-2 flex items-center gap-2">

                            <i data-lucide="file-plus-2" class="h-4 w-4 text-emerald-600"></i>

                            <h3 class="text-sm font-bold text-slate-800">
                                New Values
                            </h3>

                        </div>

                        <pre class="overflow-x-auto rounded-2xl border border-emerald-200 bg-emerald-50 p-5 text-xs leading-6 text-slate-700">{{ json_encode($auditLog->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- DELETE FORM --}}
<form
    id="deleteAuditForm"
    method="POST"
    action="{{ route('audit.destroy', $auditLog) }}"
    class="hidden"
>

    @csrf

    @method('DELETE')

</form>


<script src="https://unpkg.com/lucide@latest"></script>

<script>

    document.addEventListener('DOMContentLoaded', function () {

        lucide.createIcons();

    });


    function deleteAuditLog() {

        if (
            confirm(
                'Are you sure you want to delete this audit log? This action cannot be undone.'
            )
        ) {

            document
                .getElementById('deleteAuditForm')
                .submit();

        }

    }

</script>

@endsection