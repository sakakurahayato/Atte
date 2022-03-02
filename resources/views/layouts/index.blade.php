@extends('layouts.default')

@section('main')

<div class="index-container">
    @if(Auth::check())
    <p class="index-text">
        {{-- {{Auth::user()->name()}}
        さんお疲れ様です！ --}}
    </p>
    @endif

    <div class="block-wrap">

        @if(!isset($is_attendance_start))
        <form action="/work_start" method="post">
            @csrf
            <button type="submit" class="block" id="work-start">勤務開始</button>
            <input type="hidden">
        </form>
        @else
        <p class="block" style="background-color: rgb(179, 179, 179); cursor: default;">勤務開始</p>
        @endif

        @if(!isset($is_attendance_end))
        <form action="/work_end" method="post">
            @csrf
            <button type="submit" class="block" id="work-end">勤務終了</button>
        </form>
        @else
        <p class="block" style="background-color:rgb(179, 179, 179); cursor: default;">勤務終了</p>
        @endif
    </div>

    <div class="block-wrap">
        @if(isset($is_rest))
        @if(!$is_rest)
        <form action="/rest_start" method="post">
            @csrf
            <button type="submit" class="block" id="rest-start">休憩開始</button>
        </form>
        @else
        <p class="block" style="background-color:rgb(179, 179, 179); cursor: default;">休憩開始</p>
        @endif
        @endif

        @if(isset($is_rest))
        @if($is_rest)
        <form action="/rest_end" method="post">
            @csrf
            <button type="submit" class="block" id="rest-end">休憩終了</button>
        </form>
        @else
        <p class="block" style="background-color:rgb(179, 179, 179); cursor: default;">休憩終了</p>
        @endif
        @endif
    </div>
@endsection
