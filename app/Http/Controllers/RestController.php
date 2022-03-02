<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Rest;
use GuzzleHttp\Promise\Create;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestController extends Controller
{
    public function rest_start(Request $request)
    {
        $dt = Carbon::now();
        $date = $dt->toDateString();
        $attendance = Attendance::where('user_id', Auth::id())->where('date', $date)->first();
        $data =
            [
                'attendance_id' => $attendance->id,
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
