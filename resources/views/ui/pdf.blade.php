<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="utf-8">

    <title>តារាងកាលវិភាគប្រើប្រាស់បន្ទប់កុំព្យូទ័រ</title>

    <!-- =========================================================
         NOTO SANS KHMER - embedded locally so glyph shaping works
    ========================================================== -->
    <style>
        @font-face {
            font-family: "Noto Sans Khmer";
            font-style: normal;
            font-weight: 400;
            src: url(data:font/ttf;base64,{{ $notoRegularBase64 }}) format("truetype");
        }
        @font-face {
            font-family: "Noto Sans Khmer";
            font-style: normal;
            font-weight: 500;
            src: url(data:font/ttf;base64,{{ $notoRegularBase64 }}) format("truetype");
        }
        @font-face {
            font-family: "Noto Sans Khmer";
            font-style: normal;
            font-weight: 600;
            src: url(data:font/ttf;base64,{{ $notoRegularBase64 }}) format("truetype");
        }
        @font-face {
            font-family: "Noto Sans Khmer";
            font-style: normal;
            font-weight: 700;
            src: url(data:font/ttf;base64,{{ $notoBoldBase64 }}) format("truetype");
        }
    </style>

    <style>

        @page {
            size: A4 landscape;
            margin: 10mm 10mm 8mm 10mm;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            font-family: "Noto Sans Khmer", sans-serif;
            color: #0b2d63;
            background: #ffffff;
        }

        body {
            font-size: 11px;
            font-weight: 400;
        }

        /* =========================================================
           MAIN CONTAINER
        ========================================================== */

        .page {
            width: 100%;
            margin: 0 auto;
        }

        /* =========================================================
           LETTERHEAD
        ========================================================== */

        .letterhead {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        .letterhead td {
            vertical-align: top;
            border: none;
        }

        .letterhead .left {
            width: 50%;
            text-align: center;
            font-size: 16px;
            line-height: 1.7;
            font-weight: 700;
            color: #092e67;
        }

        .letterhead .left .university {
            font-weight: 500;
            font-size: 15px;
        }

        .letterhead .left .faculty {
            font-weight: 500;
            font-size: 14px;
        }

        .letterhead .right {
            width: 50%;
            text-align: center;
            font-size: 16px;
            line-height: 1.8;
            font-weight: 700;
            color: #092e67;
        }

        /* Decorative underline */

        .header-line {
            width: 70px;
            height: 1px;
            margin: 4px auto 0 auto;
            background: #092e67;
            position: relative;
        }

        .header-line::before,
        .header-line::after {
            content: "";
            position: absolute;
            top: 0;
            width: 20px;
            height: 1px;
            background: #092e67;
        }

        .header-line::before {
            left: -25px;
        }

        .header-line::after {
            right: -25px;
        }

        /* =========================================================
           TITLE
        ========================================================== */

        .title {
            text-align: center;
            margin-top: 10px;
            color: #092e67;
            font-size: 20px;
            font-weight: 700;
            line-height: 1.7;
        }

        .title-sub {
            text-align: center;
            color: #092e67;
            font-size: 15px;
            font-weight: 500;
            margin-top: 3px;
            margin-bottom: 9px;
        }

        .accent {
            color: #ed1c24;
            font-weight: 700;
        }

        /* =========================================================
           SCHEDULE TABLE
        ========================================================== */

        .schedule {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            border: 2px solid #08a9df;
        }

        .schedule th {
            background: #062d69;
            color: #ffffff;
            border: 1.5px solid #08a9df;
            height: 35px;
            padding: 5px 3px;
            text-align: center;
            vertical-align: middle;
            font-size: 13px;
            font-weight: 700;
        }

        .schedule td {
            border: 1.5px solid #08a9df;
            height: 115px;
            padding: 5px;
            text-align: center;
            vertical-align: middle;
            color: #092e67;
        }

        /* First column */

        .schedule .session-header {
            width: 9%;
        }

        .schedule .session-cell {
            width: 9%;
            text-align: center;
        }

        /* =========================================================
           SESSION
        ========================================================== */

        .session-name {
            color: #ed1c24;
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 7px;
        }

        .session-time {
            color: #092e67;
            font-size: 11px;
            font-weight: 500;
        }

        /* =========================================================
           SCHEDULE ENTRY
        ========================================================== */

        .entry {
            width: 100%;
            padding: 3px 2px;
            line-height: 1.7;
        }

        .lab-name {
            color: #092e67;
            font-size: 12px;
            font-weight: 500;
        }

        .room {
            color: #092e67;
            font-size: 11px;
            font-weight: 400;
        }

        /* Room number */

        .room-number {
            color: #ed1c24;
            font-weight: 700;
        }

        /* Available */

        .entry.available .lab-name {
            color: #092e67;
        }

        /* Unavailable */

        .entry.unavailable {
            opacity: 0.65;
        }

        /* =========================================================
           EMPTY CELL
        ========================================================== */

        .empty-cell {
            min-height: 80px;
        }

        /* =========================================================
           FOOTER
        ========================================================== */

        .footer {
            width: 100%;
            margin-top: 8px;
            display: table;
            color: #092e67;
        }

        .footer-left,
        .footer-right {
            display: table-cell;
            vertical-align: top;
        }

        .footer-left {
            width: 55%;
            text-align: left;
            font-size: 10px;
            line-height: 1.8;
        }

        .footer-right {
            width: 45%;
            text-align: center;
            font-size: 10px;
            line-height: 1.8;
        }

        .signature-space {
            height: 38px;
        }

        .signature-line {
            width: 75%;
            margin: 0 auto;
            border-bottom: 1px solid #092e67;
        }

        /* =========================================================
           PRINT
        ========================================================== */

        @media print {

            body {
                background: #ffffff;
            }

            .page {
                width: 100%;
            }

            .schedule {
                page-break-inside: avoid;
            }

            tr {
                page-break-inside: avoid;
            }
        }

    </style>
</head>


<body>

<div class="page">

    <!-- =========================================================
         LETTERHEAD
    ========================================================== -->

    <table class="letterhead">

        <tr>

            <!-- LEFT -->

            <td class="left">

                ព្រះរាជាណាចក្រកម្ពុជា

                <div class="header-line"></div>

                <div class="university">
                    សាកលវិទ្យាល័យជាតិបាត់ដំបង
                </div>

                <div class="faculty">
                    មហាវិទ្យាល័យវិទ្យាសាស្ត្រ និងបច្ចេកវិទ្យា
                </div>

            </td>


            <!-- RIGHT -->

            <td class="right">

                ជាតិ សាសនា ព្រះមហាក្សត្រ

                <div class="header-line"></div>

            </td>

        </tr>

    </table>


    <!-- =========================================================
         TITLE
    ========================================================== -->

    <div class="title">

        តារាងកាលវិភាគប្រើប្រាស់បន្ទប់កុំព្យូទ័រ
        <br>

        បច្ចេកវិទ្យាព័ត៌មាន
        (វេនរសៀល)

    </div>


    <!-- =========================================================
         DATE
    ========================================================== -->

    <div class="title-sub">

        សម្រាប់ថ្ងៃទី

        <span class="accent">
            {{ $dateRangeStart ?? '__' }}
        </span>

        ដល់

        <span class="accent">
            {{ $dateRangeEnd ?? '__' }}
        </span>

        ខែ

        <span class="accent">
            {{ $monthKh ?? '__' }}
        </span>

        ឆ្នាំ

        <span class="accent">
            {{ $yearKh ?? '២០២៦' }}
        </span>

    </div>


    <!-- =========================================================
         SCHEDULE TABLE
    ========================================================== -->

    <table class="schedule">

        <thead>

            <tr>

                <th class="session-header">
                    ម៉ោង
                </th>

                @foreach($days as $day)

                    <th>
                        {{ $khmerDays[$day] ?? $day }}
                    </th>

                @endforeach

            </tr>

        </thead>


        <tbody>

            @foreach($sessions as $session => $time)

                <tr>

                    <!-- SESSION -->

                    <td class="session-cell">

                        <div class="session-name">
                            {{ $session }}
                        </div>

                        <div class="session-time">
                            ({{ $time['start'] }} - {{ $time['end'] }})
                        </div>

                    </td>


                    <!-- DAYS -->

                    @foreach($days as $day)

                        <td>

                            @forelse($scheduleMap[$day][$session] ?? [] as $schedule)

                                <div class="entry {{ strtolower($schedule->status) }}">

                                    <div class="lab-name">

                                        {{ $schedule->laboratory->lab_name }}

                                    </div>


                                    @if($schedule->laboratory->room_number)

                                        <div class="room">

                                            បន្ទប់

                                            <span class="room-number">
                                                {{ $schedule->laboratory->room_number }}
                                            </span>

                                        </div>

                                    @endif

                                </div>

                            @empty

                                <div class="empty-cell"></div>

                            @endforelse

                        </td>

                    @endforeach

                </tr>

            @endforeach

        </tbody>

    </table>


    <!-- =========================================================
         FOOTER
    ========================================================== -->

    <div class="footer">

        <!-- LEFT -->

        <div class="footer-left">

            <strong>សំគាល់ ៖</strong>

            មហាវិទ្យាល័យវិទ្យាសាស្ត្រ និងបច្ចេកវិទ្យា
            សូមកែសម្រួលក្នុងករណីចាំបាច់

        </div>


        <!-- RIGHT -->

        <div class="footer-right">

            ថ្ងៃទី ____ ខែ ____ ឆ្នាំ
            {{ $yearKh ?? '២០២៦' }}

            <br>

            អ្នកសម្របសម្រួល

            <div class="signature-space"></div>

            <div class="signature-line"></div>

            អ្នកសម្របសម្រួល

        </div>

    </div>

</div>

</body>

</html>