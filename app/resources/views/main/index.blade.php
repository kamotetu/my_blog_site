@extends('layouts.layout')

@section('sub_title')
    | ホーム
@endsection

@section('main_image')
    <div class="main_image">
        <img src="{{asset('/img/main_image.png')}}" alt="{{config('const.app_name')}}">
    </div>
@endsection