@extends('layouts.default')

@section('main')

<div class="date">
    <form action="back" method="POST">
        @csrf
        <button class="attendance-btn"><</button>
        <input type="hidden" value="{{$today}}" name="day">
        <input type="hidden" value="back">
    </form>

    <h1 class="table-title">{{$today}}</h1>

    <form action="next" method="POST">
        @csrf
        <button class="attendance-btn">></button>
        <input type="hidden" value="{{$today}}" name="day">
        <input type="hidden" value="next">
    </form>
</div>

<table class="table">
    <tr class="table-tr">
        <th class="table-th">名前</th>
        <th class="table-th">勤務開始</th>
        <th class="table-th">勤務終了</th>
        <th class="table-th">休憩時間</th>
        <th class="table-th">勤務時間</th>
    </tr>
    @foreach($attendances as $attendance)

    <tr class="table-tr">
        <td class="table-td">
            {{$attendance->user->name}}
        </td>
        <td class="table-td">
            {{$attendance->start_time}}
        </td>
        <td class="table-td">
            {{$attendance->end_time}}
        </td>
        <td class="table-td">
            {{$attendance->RestSum}}
        </td>
        <td class="table-td">
            {{$attendance->AttendanceSum}}
        </td>
    </tr>
    @endforeach
</table>


<div class="pagination">
    {{ $attendances->links() }}
</div>


@endsection
