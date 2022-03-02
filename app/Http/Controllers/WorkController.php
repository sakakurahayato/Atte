<?php

namespace App\Http\Controllers;
// require 'vemdor/autoload.php';

use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Rest;
use GuzzleHttp\Promise\Create;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    public function work_start(Request $request)
    {
        $date = Carbon::now();
        $data =
        [
            'user_id' => Auth::id(),
            'date' => $date->toDateString(),
            'start_time'=>$date->toTimeString(),
        ];
        Attendance::create($data);
        return redirect('/');
    }
    public function work_end()
    {
        $date = Carbon::now();
        $data =
        [
            'end_time'=>$date->toTimeString()
        ];
        Attendance::where('user_id',Auth::id())->latest()->first()->update($data);
        return redirect('/');
    }
    public function rest_start(Request $request)
    {
        $dt = Carbon::now();
        $date = $dt->toDateString();
        $attendance = Attendance::where('user_id',Auth::id())->where('date',$date)->first();
        $data =
        [
            'attendance_id' =>$attendance->id,
            'date' => $date,
            'start_time' => $dt->toTimeString(),
        ];
        Rest::create($data);
        return redirect('/');
    }
    public function rest_end()
    {
        $dt = Carbon::now();
        $date = $dt->toDateString();
        $data =
            [
                'end_time' => $dt->toTimeString()
            ];
        $attendance = Attendance::where('user_id', Auth::id())->where('date', $date)->first();
        $rest = $attendance->rests->whereNull('end_time')->first();
        $rest->update($data);
        return redirect('/');
    }
}
