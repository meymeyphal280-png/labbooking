<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>
        Audit Logs Report
    </title>

    <style>

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 9px;
            color: #334155;
        }

        h1 {
            margin: 0;
            font-size: 20px;
            color: #0f172a;
        }

        .subtitle {
            margin-top: 4px;
            color: #64748b;
            font-size: 10px;
        }

        .header {
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #10b981;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f1f5f9;
            color: #475569;
            font-size: 8px;
            text-align: left;
            padding: 7px;
            border: 1px solid #cbd5e1;
        }

        td {
            padding: 7px;
            border: 1px solid #e2e8f0;
            vertical-align: top;
        }

        .action {
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            color: #94a3b8;
            font-size: 8px;
        }

    </style>

</head>

<body>

    <div class="header">

        <h1>
            Audit Logs Report
        </h1>

        <div class="subtitle">
            System Security Activity Report
        </div>

        <div class="subtitle">
            Generated:
            {{ now()->format('d M Y h:i A') }}
        </div>

    </div>


    <table>

        <thead>

            <tr>

                <th>
                    #
                </th>

                <th>
                    User
                </th>

                <th>
                    Action
                </th>

                <th>
                    Module
                </th>

                <th>
                    Description
                </th>

                <th>
                    IP
                </th>

                <th>
                    Date / Time
                </th>

            </tr>

        </thead>


        <tbody>

            @foreach($auditLogs as $log)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>

                        {{ $log->user?->name ?? 'System' }}

                        <br>

                        <span style="color:#94a3b8;">
                            {{ $log->user?->email ?? '' }}
                        </span>

                    </td>

                    <td class="action">

                        {{ $log->action }}

                    </td>

                    <td>

                        {{ $log->module ?? 'System' }}

                    </td>

                    <td>

                        {{ $log->description ?? 'No description' }}

                    </td>

                    <td>

                        {{ $log->ip_address ?? '—' }}

                    </td>

                    <td>

                        {{ $log->created_at?->format('d M Y') }}

                        <br>

                        {{ $log->created_at?->format('h:i A') }}

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>


    <div class="footer">

        Total records:
        {{ $auditLogs->count() }}

        &nbsp; | &nbsp;

        Lab Booking System Audit Log

    </div>

</body>

</html>