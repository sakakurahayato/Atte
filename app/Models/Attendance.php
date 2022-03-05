<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','date','start_time','end_time'];

    public static $rules = array(
        'user_id' => 'required',
        'date' => 'required|integer',
        'start_time'=>'integer',
        'end_time'=>'integer'
    );

    public function rests(){
        return $this->hasMany(Rest::class);
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public static function getAttendance(){
        $id = Auth::id();
        $date = new Carbon();
        $attendance = Attendance::where('user_id',$id)->where('date',$date->toDateString())->first();
        return $attendance;
    }

    public function getRestSecondsAttribute(){
        $rests = $this->rests;
        if (is_null($rests)) {
            return null;
        }
        $restSum = 0;
        foreach ($rests as $rest) {
            $rest_start = new Carbon($rest->start_time);
            $rest_end = new Carbon($rest->end_time);
            $restTime = $rest_start->diffInSeconds($rest_end);
            $restSum += $restTime;
        }
        return $restSum;
    }

    public function getRestSumAttribute(){
        $RestSeconds = $this->RestSeconds;
        $hours = floor($RestSeconds/3600);
        $minutes = floor(($RestSeconds/60)%60);
        $seconds = $RestSeconds%60;
        $hms = sprintf("%02d:%02d:%02d",$hours,$minutes,$seconds);
        return $hms;
    }
    public function getAttendanceSumAttribute(){
        $RestSeconds = $this->RestSeconds;

        $start_time = new Carbon($this->start_time);
        $end_time = new Carbon($this->end_time);
        $attendanceTime = $start_time->diffInSeconds($end_time);

        $AttendanceSeconds = $attendanceTime-$RestSeconds;
        $hours = floor($AttendanceSeconds / 3600);
        $minutes = floor(($AttendanceSeconds / 60) % 60);
        $seconds = $AttendanceSeconds % 60;
        $hms = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
        return $hms;
    }
}
