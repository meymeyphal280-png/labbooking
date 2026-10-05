<?php

namespace App\Http\Controllers;

use App\Models\LabSchedule;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Symfony\Component\Process\Process;

class LabScheduleController extends Controller
{
    private array $days = [
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
        'Sunday',
    ];

    private array $sessions = [
        'Session 1' => [
            'start' => '07:00',
            'end'   => '08:30',
        ],
        'Session 2' => [
            'start' => '08:50',
            'end'   => '10:20',
        ],
        'Session 3' => [
            'start' => '10:30',
            'end'   => '12:00',
        ],
    ];

    public function index()
    {
        $schedules = LabSchedule::with('laboratory')
            ->orderByRaw("CASE day_of_week WHEN 'Monday' THEN 1 WHEN 'Tuesday' THEN 2 WHEN 'Wednesday' THEN 3 WHEN 'Thursday' THEN 4 WHEN 'Friday' THEN 5 WHEN 'Saturday' THEN 6 WHEN 'Sunday' THEN 7 ELSE 8 END")
            ->orderByRaw("CASE session WHEN 'Session 1' THEN 1 WHEN 'Session 2' THEN 2 WHEN 'Session 3' THEN 3 ELSE 4 END")
            ->get();

        $scheduleMap = $this->buildScheduleMap($schedules);
        $laboratories = Laboratory::orderBy('lab_name')->get();

        return view('page.lab-schedule', [
            'days'         => $this->days,
            'sessions'     => $this->sessions,
            'schedules'    => $schedules,
            'scheduleMap'  => $scheduleMap,
            'laboratories' => $laboratories,
        ]);
    }

    public function create()
    {
        $this->checkAdmin();

        $schedules = LabSchedule::with('laboratory')
            ->orderByRaw("CASE day_of_week WHEN 'Monday' THEN 1 WHEN 'Tuesday' THEN 2 WHEN 'Wednesday' THEN 3 WHEN 'Thursday' THEN 4 WHEN 'Friday' THEN 5 WHEN 'Saturday' THEN 6 WHEN 'Sunday' THEN 7 ELSE 8 END")
            ->orderByRaw("CASE session WHEN 'Session 1' THEN 1 WHEN 'Session 2' THEN 2 WHEN 'Session 3' THEN 3 ELSE 4 END")
            ->get();

        $scheduleMap = $this->buildScheduleMap($schedules);
        $laboratories = Laboratory::orderBy('lab_name')->get();

        return view('page.lab-schedule', [
            'days'            => $this->days,
            'sessions'        => $this->sessions,
            'schedules'       => $schedules,
            'scheduleMap'     => $scheduleMap,
            'laboratories'    => $laboratories,
            'editingSchedule' => null,
        ]);
    }

    public function store(Request $request)
    {
        $this->checkAdmin();

        $validated = $request->validate([
            'laboratory_id' => ['required', 'exists:laboratories,id'],
            'day_of_week'   => ['required', Rule::in($this->days)],
            'session'       => ['required', Rule::in(array_keys($this->sessions))],
            'status'        => ['required', Rule::in(['Available', 'Unavailable'])],
        ]);

        $session = $this->sessions[$validated['session']];

        $exists = LabSchedule::where('laboratory_id', $validated['laboratory_id'])
            ->where('day_of_week', $validated['day_of_week'])
            ->where('session', $validated['session'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->with('error', 'This laboratory is already scheduled for this day and session.');
        }

        LabSchedule::create([
            'laboratory_id' => $validated['laboratory_id'],
            'day_of_week'   => $validated['day_of_week'],
            'session'       => $validated['session'],
            'start_time'    => $session['start'],
            'end_time'      => $session['end'],
            'status'        => $validated['status'],
            'created_by'    => Auth::id(),
        ]);

        return redirect()
            ->route('labschedule.index')
            ->with('success', 'Laboratory schedule created successfully.');
    }

    public function show(LabSchedule $labschedule)
    {
        $labschedule->load('laboratory');

        return view('page.lab-schedule', [
            'days'         => $this->days,
            'sessions'     => $this->sessions,
            'schedules'    => collect([$labschedule]),
            'scheduleMap'  => $this->buildScheduleMap(collect([$labschedule])),
            'laboratories' => Laboratory::orderBy('lab_name')->get(),
        ]);
    }

    public function edit(LabSchedule $labschedule)
    {
        $this->checkAdmin();

        $schedules = LabSchedule::with('laboratory')
            ->orderByRaw("CASE day_of_week WHEN 'Monday' THEN 1 WHEN 'Tuesday' THEN 2 WHEN 'Wednesday' THEN 3 WHEN 'Thursday' THEN 4 WHEN 'Friday' THEN 5 WHEN 'Saturday' THEN 6 WHEN 'Sunday' THEN 7 ELSE 8 END")
            ->orderByRaw("CASE session WHEN 'Session 1' THEN 1 WHEN 'Session 2' THEN 2 WHEN 'Session 3' THEN 3 ELSE 4 END")
            ->get();

        $scheduleMap = $this->buildScheduleMap($schedules);
        $laboratories = Laboratory::orderBy('lab_name')->get();

        return view('page.lab-schedule', [
            'days'            => $this->days,
            'sessions'        => $this->sessions,
            'schedules'       => $schedules,
            'scheduleMap'     => $scheduleMap,
            'laboratories'    => $laboratories,
            'editingSchedule' => $labschedule,
        ]);
    }

    public function update(Request $request, LabSchedule $labschedule)
    {
        $this->checkAdmin();

        $validated = $request->validate([
            'laboratory_id' => ['required', 'exists:laboratories,id'],
            'day_of_week'   => ['required', Rule::in($this->days)],
            'session'       => ['required', Rule::in(array_keys($this->sessions))],
            'status'        => ['required', Rule::in(['Available', 'Unavailable'])],
        ]);

        $session = $this->sessions[$validated['session']];

        $exists = LabSchedule::where('laboratory_id', $validated['laboratory_id'])
            ->where('day_of_week', $validated['day_of_week'])
            ->where('session', $validated['session'])
            ->where('id', '!=', $labschedule->id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->with('error', 'This laboratory is already scheduled for this day and session.');
        }

        $labschedule->update([
            'laboratory_id' => $validated['laboratory_id'],
            'day_of_week'   => $validated['day_of_week'],
            'session'       => $validated['session'],
            'start_time'    => $session['start'],
            'end_time'      => $session['end'],
            'status'        => $validated['status'],
        ]);

        return redirect()
            ->route('labschedule.index')
            ->with('success', 'Laboratory schedule updated successfully.');
    }

    public function destroy(LabSchedule $labschedule)
    {
        $this->checkAdmin();

        $labschedule->delete();

        return redirect()
            ->route('labschedule.index')
            ->with('success', 'Laboratory schedule deleted successfully.');
    }

    /**
     * Build schedule map returning Laravel Collections.
     */
    private function buildScheduleMap($schedules)
    {
        $map = [];

        foreach ($this->days as $day) {
            foreach ($this->sessions as $session => $time) {
                $map[$day][$session] = collect();
            }
        }

        foreach ($schedules as $schedule) {
            $map[$schedule->day_of_week][$schedule->session]->push($schedule);
        }

        return $map;
    }

    private function checkAdmin(): void
    {
        abort_unless(
            Auth::check() && Auth::user()->role === 'Admin',
            403
        );
    }

    public function userIndex()
    {
        $schedules = LabSchedule::with('laboratory')
            ->orderByRaw("CASE day_of_week WHEN 'Monday' THEN 1 WHEN 'Tuesday' THEN 2 WHEN 'Wednesday' THEN 3 WHEN 'Thursday' THEN 4 WHEN 'Friday' THEN 5 WHEN 'Saturday' THEN 6 WHEN 'Sunday' THEN 7 ELSE 8 END")
            ->orderByRaw("CASE session WHEN 'Session 1' THEN 1 WHEN 'Session 2' THEN 2 WHEN 'Session 3' THEN 3 ELSE 4 END")
            ->get();

        $scheduleMap = $this->buildScheduleMap($schedules);

        return view('ui.user-lab-schedule', [
            'days'        => $this->days,
            'sessions'    => $this->sessions,
            'schedules'   => $schedules,
            'scheduleMap' => $scheduleMap,
        ]);
    }

public function exportPdf()
{
    /*
    |--------------------------------------------------------------------------
    | Load Khmer font bytes and base64-encode them
    |--------------------------------------------------------------------------
    | Dompdf cannot shape the Khmer script, so we render the schedule through
    | headless Chrome (which performs proper Khmer glyph shaping) and embed the
    | local Noto Sans Khmer fonts so no network access is required.
    */

    $regularPath = public_path('fonts/static/NotoSansKhmer-Regular.ttf');
    $boldPath    = public_path('fonts/static/NotoSansKhmer-Bold.ttf');

    if (!file_exists($regularPath)) {
        abort(500, "Khmer font not found at: {$regularPath}. Run `find resources -iname '*NotoSansKhmer*'` to locate it and fix this path.");
    }

    $notoRegularBase64 = base64_encode(file_get_contents($regularPath));
    $notoBoldBase64    = file_exists($boldPath)
        ? base64_encode(file_get_contents($boldPath))
        : $notoRegularBase64; // fall back to regular weight if bold wasn't downloaded

    /*
    |--------------------------------------------------------------------------
    | Get laboratory schedules
    |--------------------------------------------------------------------------
    */

    $schedules = LabSchedule::with('laboratory')
        ->orderByRaw("CASE day_of_week WHEN 'Monday' THEN 1 WHEN 'Tuesday' THEN 2 WHEN 'Wednesday' THEN 3 WHEN 'Thursday' THEN 4 WHEN 'Friday' THEN 5 WHEN 'Saturday' THEN 6 WHEN 'Sunday' THEN 7 ELSE 8 END")
        ->orderByRaw("CASE session WHEN 'Session 1' THEN 1 WHEN 'Session 2' THEN 2 WHEN 'Session 3' THEN 3 ELSE 4 END")
        ->get();

    $scheduleMap = $this->buildScheduleMap($schedules);

    $khmerDays = [
        'Monday'    => 'ចន្ទ',
        'Tuesday'   => 'អង្គារ',
        'Wednesday' => 'ពុធ',
        'Thursday'  => 'ព្រហស្បតិ៍',
        'Friday'    => 'សុក្រ',
        'Saturday'  => 'សៅរ៍',
        'Sunday'    => 'អាទិត្យ',
    ];

    /*
    |--------------------------------------------------------------------------
    | Render the HTML view for Chrome to print
    |--------------------------------------------------------------------------
    */

    $html = view('ui.pdf', [
        'days'               => $this->days,
        'sessions'           => $this->sessions,
        'schedules'          => $schedules,
        'scheduleMap'        => $scheduleMap,
        'khmerDays'          => $khmerDays,
        'notoRegularBase64'  => $notoRegularBase64,
        'notoBoldBase64'     => $notoBoldBase64,
        'dateRangeStart' => null,
        'dateRangeEnd'   => null,
        'monthKh'        => null,
        'yearKh'         => null,
    ])->render();

    $chrome = $this->findChromeBinary();

    $tempDir = storage_path('app' . DIRECTORY_SEPARATOR . 'pdf-tmp');
    if (!is_dir($tempDir)) {
        mkdir($tempDir, 0775, true);
    }

    $htmlPath = $tempDir . DIRECTORY_SEPARATOR . 'schedule-' . uniqid() . '.html';
    $pdfPath  = $tempDir . DIRECTORY_SEPARATOR . 'schedule-' . uniqid() . '.pdf';
    $profile  = $tempDir . DIRECTORY_SEPARATOR . 'profile-' . uniqid();

    file_put_contents($htmlPath, $html);

    try {
        $command = array_merge([
            $chrome,
            '--headless=new',
            '--disable-gpu',
            '--no-sandbox',
            '--allow-file-access-from-files',
            '--print-to-pdf-no-header',
            '--no-pdf-header-footer',
            "--user-data-dir={$profile}",
            "--print-to-pdf={$pdfPath}",
            $this->pathToFileUrl($htmlPath),
        ]);

        $process = new Process($command);
        $process->setTimeout(60);
        $process->run();

        if (!$process->isSuccessful()) {
            abort(500, 'Failed to generate PDF: ' . mb_substr($process->getErrorOutput(), 0, 500));
        }

        if (!file_exists($pdfPath)) {
            abort(500, 'Chrome did not produce a PDF output file.');
        }

        return response()->download($pdfPath, 'laboratory-weekly-schedule.pdf')->deleteFileAfterSend(true);
    } finally {
        @unlink($htmlPath);
        if (is_dir($profile)) {
            $this->rrmdir($profile);
        }
    }
}

/**
 * Locate a Chromium-based browser binary (Chrome or Edge).
 */
protected function findChromeBinary(): string
{
    $candidates = [
        'C:\Program Files\Google\Chrome\Application\chrome.exe',
        'C:\Program Files (x86)\Google\Chrome\Application\chrome.exe',
        'C:\Program Files\Microsoft\Edge\Application\msedge.exe',
        'C:\Program Files (x86)\Microsoft\Edge\Application\msedge.exe',
        '/usr/bin/google-chrome',
        '/usr/bin/chromium-browser',
        '/usr/bin/chromium',
        '/Applications/Google Chrome.app/Contents/MacOS/Google Chrome',
    ];

    foreach ($candidates as $binary) {
        if (file_exists($binary)) {
            return $binary;
        }
    }

    abort(500, 'Chrome/Edge browser not found. Install Google Chrome to export the Khmer PDF.');
}

/**
 * Convert a filesystem path to a file:// URL.
 */
protected function pathToFileUrl(string $path): string
{
    if (DIRECTORY_SEPARATOR === '\\') {
        return 'file:///' . str_replace('\\', '/', ltrim($path, '/\\'));
    }

    return 'file://' . $path;
}

/**
 * Recursively remove a directory.
 */
protected function rrmdir(string $dir): void
{
    $items = glob($dir . DIRECTORY_SEPARATOR . '*', GLOB_NOSORT) ?: [];
    foreach ($items as $item) {
        is_dir($item) ? $this->rrmdir($item) : @unlink($item);
    }
    @rmdir($dir);
}
 
}