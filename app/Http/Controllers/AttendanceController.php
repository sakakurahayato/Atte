<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rest;
use GuzzleHttp\Promise\Create;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use Illuminate\Pagination\Paginator;

class AttendanceController extends Controller
{
    public function index()
    {
        // $items = Auth::user();
        $attendance = Attendance::getAttendance();
        if(is_null($attendance)){
            return view('layouts.index');
        }
        $rest = $attendance->rests->whereNull('end_time')->first();
        if($attendance->end_time){
            return view('layouts.index')->with(['is_attendance_start' => true,'is_attendance_end' => true]);
        }
        if($attendance->start_time){
            if(isset($rest)){
                return view('layouts.index')->with(['is_rest' => true,'is_attendance_start' => true]);
            }else {
                return view('layouts.index')->with(['is_rest' => false, 'is_attendance_start' => true]);
            }
        }
    }
    public function work_start(Request $request)
    {
        $date = Carbon::now();
        $last_attendance = Attendance::where('user_id',Auth::id())->latest()->first();
        // dd($last_attendance);
        if (is_null($last_attendance->end_time)) {
            $end =
                [
                    'end_time' => "23:59:59"
                ];
            $last_attendance->update($end);
        }
        $data =
            [
                'user_id' => Auth::id(),
                'date' => $date->toDateString(),
                'start_time' => $date->toTimeString(),
            ];
        Attendance::create($data);
        
        return redirect('/');
    }
    public function work_end()
    {
        $date = Carbon::now();
        $data =
        [
            'end_time' => $date->toTimeString()
        ];
        $attendance = Attendance::where('user_id', Auth::id())->latest()->first();
        $attendance->update($data);
        return redirect('/');
    }
    public function attendance(Request $request)
    {
        // $attendances = Attendance::all()->groupBy('date');
        $today = Carbon::now()->format('y-m-d');
        $attendances = Attendance::whereDate('date',$today)->paginate(5);
        // dd($attendances);
        return view('layouts.attendance',compact('attendances','today'));
    }

    public function next(Request $request)
    {
        $today = Carbon::now();
        $date = new Carbon($request->day);
        $today = $date->addDay()->format('Y-m-d');
        $attendances = Attendance::whereDate('date',$today)->paginate(5);
        return view('layouts.attendance',compact('today','attendances'));
    }
    public function back(Request $request)
    {
        $date = new Carbon($request->day);
        $today = $date->subDay()->format('Y-m-d');
        $attendances = Attendance::whereDate('date',$today)->paginate(5);
        return view('layouts.attendance',compact('today','attendances'));
    }
}
