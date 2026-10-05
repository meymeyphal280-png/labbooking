<!DOCTYPE html>

<html lang="en">

<head>


<meta charset="UTF-8">

<style>

    @page {
        margin: 35px 35px 45px 35px;
    }

    * {
        box-sizing: border-box;
    }

    body {
        font-family: DejaVu Sans, sans-serif;
        color: #1f2937;
        font-size: 10px;
        line-height: 1.5;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .document-header {
        width: 100%;
        border-bottom: 2px solid #166534;
        padding-bottom: 12px;
        margin-bottom: 18px;
    }

    .header-table {
        width: 100%;
        border-collapse: collapse;
    }

    .header-left {
        width: 70%;
        vertical-align: middle;
    }

    .header-right {
        width: 30%;
        text-align: right;
        vertical-align: middle;
    }

    .university-name {
        font-size: 16px;
        font-weight: bold;
        color: #14532d;
        margin-bottom: 3px;
    }

    .department-name {
        font-size: 11px;
        font-weight: bold;
        color: #374151;
    }

    .system-name {
        font-size: 9px;
        color: #6b7280;
        margin-top: 2px;
    }

    .document-label {
        font-size: 9px;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .document-number {
        font-size: 11px;
        font-weight: bold;
        color: #111827;
        margin-top: 3px;
    }


    /* =========================================================
       TITLE
    ========================================================= */

    .title-section {
        text-align: center;
        margin: 18px 0 20px 0;
    }

    .title {
        font-size: 18px;
        font-weight: bold;
        color: #111827;
        margin: 0;
    }

    .subtitle {
        font-size: 10px;
        color: #6b7280;
        margin-top: 4px;
    }


    /* =========================================================
       REPORT INFORMATION
    ========================================================= */

    .information-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 18px;
    }

    .information-table td {
        border: 1px solid #d1d5db;
        padding: 7px 9px;
    }

    .information-label {
        width: 15%;
        background: #f3f4f6;
        font-weight: bold;
        color: #374151;
    }

    .information-value {
        width: 35%;
        color: #111827;
    }


    /* =========================================================
       SUMMARY
    ========================================================= */

    .section-title {
        font-size: 11px;
        font-weight: bold;
        color: #14532d;
        border-bottom: 1px solid #d1d5db;
        padding-bottom: 5px;
        margin-bottom: 8px;
    }

    .summary-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .summary-table th {
        background: #f3f4f6;
        border: 1px solid #d1d5db;
        padding: 7px;
        text-align: center;
        font-size: 9px;
        font-weight: bold;
        color: #374151;
    }

    .summary-table td {
        border: 1px solid #d1d5db;
        padding: 8px;
        text-align: center;
        font-size: 13px;
        font-weight: bold;
        color: #111827;
    }


    /* =========================================================
       BOOKING TABLE
    ========================================================= */

    .booking-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .booking-table thead {
        display: table-header-group;
    }

    .booking-table th {
        background: #166534;
        color: white;
        border: 1px solid #14532d;
        padding: 7px 5px;
        text-align: left;
        font-size: 8.5px;
        font-weight: bold;
    }

    .booking-table td {
        border: 1px solid #d1d5db;
        padding: 6px 5px;
        vertical-align: top;
        font-size: 8.5px;
        color: #374151;
        word-wrap: break-word;
    }

    .booking-table tbody tr:nth-child(even) {
        background: #f9fafb;
    }

    .center {
        text-align: center !important;
    }


    /* =========================================================
       COLUMN WIDTHS
    ========================================================= */

    .col-number {
        width: 4%;
    }

    .col-user {
        width: 15%;
    }

    .col-lab {
        width: 15%;
    }

    .col-date {
        width: 10%;
    }

    .col-time {
        width: 12%;
    }

    .col-participants {
        width: 8%;
    }

    .col-purpose {
        width: 24%;
    }

    .col-status {
        width: 12%;
    }


    /* =========================================================
       STATUS
    ========================================================= */

    .status {
        font-weight: bold;
    }

    .status-approved {
        color: #166534;
    }

    .status-pending {
        color: #92400e;
    }

    .status-rejected {
        color: #991b1b;
    }

    .status-cancelled {
        color: #6b7280;
    }


    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .empty {
        text-align: center;
        padding: 18px !important;
        color: #6b7280 !important;
        font-style: italic;
    }


    /* =========================================================
       FOOTER
    ========================================================= */

    .footer {
        margin-top: 25px;
        border-top: 1px solid #d1d5db;
        padding-top: 10px;
        font-size: 8.5px;
        color: #6b7280;
    }

    .footer-table {
        width: 100%;
        border-collapse: collapse;
    }

    .footer-left {
        width: 65%;
    }

    .footer-right {
        width: 35%;
        text-align: right;
    }


    /* =========================================================
       SIGNATURE
    ========================================================= */

    .signature-section {
        margin-top: 35px;
        width: 100%;
    }

    .signature-table {
        width: 100%;
        border-collapse: collapse;
    }

    .signature-cell {
        width: 50%;
        text-align: center;
        vertical-align: top;
        font-size: 9px;
        color: #374151;
    }

    .signature-space {
        height: 45px;
    }

    .signature-line {
        width: 170px;
        border-bottom: 1px solid #374151;
        margin: 0 auto 5px auto;
    }


    /* =========================================================
       PAGE NUMBER
    ========================================================= */

    .page-number:after {
        content: counter(page);
    }

</style>
```

</head>

<body>

```
{{-- =========================================================
     DOCUMENT HEADER
========================================================= --}}

<div class="document-header">

    <table class="header-table">

        <tr>

            <td class="header-left">

                <div class="university-name">
                    NATIONAL UNIVERSITY OF BATTAMBANG
                </div>

                <div class="department-name">
                    NUBB LABORATORY
                </div>

                <div class="system-name">
                    Laboratory Booking Management System
                </div>

            </td>


            <td class="header-right">

                <div class="document-label">
                    Official Report
                </div>

                <div class="document-number">
                    Report #{{ $report->id }}
                </div>

            </td>

        </tr>

    </table>

</div>


{{-- =========================================================
     TITLE
========================================================= --}}

<div class="title-section">

    <div class="title">
        {{ $report->report_name }}
    </div>

    <div class="subtitle">
        Laboratory Booking Report
    </div>

</div>


{{-- =========================================================
     REPORT INFORMATION
========================================================= --}}

<table class="information-table">

    <tr>

        <td class="information-label">
            Report Type
        </td>

        <td class="information-value">
            Booking
        </td>

        <td class="information-label">
            Generated Date
        </td>

        <td class="information-value">
            {{ $report->created_at
                ? $report->created_at->format('d M Y h:i A')
                : now()->format('d M Y h:i A')
            }}
        </td>

    </tr>


    <tr>

        <td class="information-label">
            Period From
        </td>

        <td class="information-value">

            {{ $dateFrom
                ? \Carbon\Carbon::parse($dateFrom)->format('d M Y')
                : 'All Dates'
            }}

        </td>


        <td class="information-label">
            Period To
        </td>

        <td class="information-value">

            {{ $dateTo
                ? \Carbon\Carbon::parse($dateTo)->format('d M Y')
                : 'All Dates'
            }}

        </td>

    </tr>


    <tr>

        <td class="information-label">
            Status
        </td>

        <td class="information-value">

            {{ $status === 'all'
                ? 'All Statuses'
                : $status
            }}

        </td>


        <td class="information-label">
            Generated By
        </td>

        <td class="information-value">

            {{ $report->generatedBy->name ?? 'System' }}

        </td>

    </tr>

</table>


{{-- =========================================================
     SUMMARY
========================================================= --}}

<div class="section-title">
    BOOKING SUMMARY
</div>


<table class="summary-table">

    <thead>

        <tr>

            <th>
                Total Bookings
            </th>

            <th>
                Approved
            </th>

            <th>
                Pending
            </th>

            <th>
                Rejected
            </th>

            <th>
                Cancelled
            </th>

        </tr>

    </thead>


    <tbody>

        <tr>

            <td>
                {{ $data['total'] }}
            </td>

            <td>
                {{ $data['approved'] }}
            </td>

            <td>
                {{ $data['pending'] }}
            </td>

            <td>
                {{ $data['rejected'] }}
            </td>

            <td>
                {{ $data['cancelled'] }}
            </td>

        </tr>

    </tbody>

</table>


{{-- =========================================================
     BOOKING DETAILS
========================================================= --}}

<div class="section-title">
    BOOKING DETAILS
</div>


<table class="booking-table">

    <thead>

        <tr>

            <th class="col-number center">
                No.
            </th>

            <th class="col-user">
                Requester
            </th>

            <th class="col-lab">
                Laboratory
            </th>

            <th class="col-date">
                Booking Date
            </th>

            <th class="col-time">
                Time
            </th>

            <th class="col-participants center">
                Participants
            </th>

            <th class="col-purpose">
                Purpose
            </th>

            <th class="col-status center">
                Status
            </th>

        </tr>

    </thead>


    <tbody>

        @forelse($data['items'] as $index => $booking)

            <tr>

                {{-- NUMBER --}}

                <td class="center">
                    {{ $index + 1 }}
                </td>


                {{-- USER --}}

                <td>

                    <strong>
                        {{ $booking->user->name ?? '—' }}
                    </strong>

                    @if($booking->user->email ?? false)

                        <br>

                        <span style="color:#6b7280;">
                            {{ $booking->user->email }}
                        </span>

                    @endif

                </td>


                {{-- LABORATORY --}}

                <td>

                    {{ $booking->laboratory->lab_name ?? '—' }}

                    @if($booking->laboratory->room_number ?? false)

                        <br>

                        <span style="color:#6b7280;">
                            Room {{ $booking->laboratory->room_number }}
                        </span>

                    @endif

                </td>


                {{-- DATE --}}

                <td>

                    {{ $booking->booking_date
                        ? \Carbon\Carbon::parse(
                            $booking->booking_date
                        )->format('d M Y')
                        : '—'
                    }}

                </td>


                {{-- TIME --}}

                <td>

                    {{ $booking->start_time
                        ? \Carbon\Carbon::parse(
                            $booking->start_time
                        )->format('h:i A')
                        : '—'
                    }}

                    <br>

                    <span style="color:#6b7280;">
                        to
                    </span>

                    <br>

                    {{ $booking->end_time
                        ? \Carbon\Carbon::parse(
                            $booking->end_time
                        )->format('h:i A')
                        : '—'
                    }}

                </td>


                {{-- PARTICIPANTS --}}

                <td class="center">

                    {{ $booking->participants ?? 0 }}

                </td>


                {{-- PURPOSE --}}

                <td>

                    {{ \Illuminate\Support\Str::limit(
                        $booking->purpose ?? '—',
                        80
                    ) }}

                </td>


                {{-- STATUS --}}

                <td class="center">

                    @php

                        $statusClass = match(
                            $booking->status
                        ) {

                            'Approved'
                                => 'status-approved',

                            'Pending'
                                => 'status-pending',

                            'Rejected'
                                => 'status-rejected',

                            'Cancelled'
                                => 'status-cancelled',

                            default => '',

                        };

                    @endphp


                    <span class="status {{ $statusClass }}">

                        {{ $booking->status ?? '—' }}

                    </span>

                </td>

            </tr>


        @empty

            <tr>

                <td
                    colspan="8"
                    class="empty"
                >

                    No booking records found for the selected criteria.

                </td>

            </tr>

        @endforelse

    </tbody>

</table>


{{-- =========================================================
     SIGNATURE
========================================================= --}}

<div class="signature-section">

    <table class="signature-table">

        <tr>

            <td class="signature-cell">

                Prepared By

                <div class="signature-space"></div>

                <div class="signature-line"></div>

                {{ $report->generatedBy->name ?? 'System' }}

            </td>


            <td class="signature-cell">

                Approved By

                <div class="signature-space"></div>

                <div class="signature-line"></div>

                Laboratory Administrator

            </td>

        </tr>

    </table>

</div>


{{-- =========================================================
     FOOTER
========================================================= --}}

<div class="footer">

    <table class="footer-table">

        <tr>

            <td class="footer-left">

                NUBB Laboratory Booking Management System

                <br>

                Generated:
                {{ now()->format('d M Y h:i A') }}

            </td>


            <td class="footer-right">

                Page
                <span class="page-number"></span>

            </td>

        </tr>

    </table>

</div>

</body>

</html>
