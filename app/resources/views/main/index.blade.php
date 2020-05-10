@extends('layouts.layout')

@section('sub_title')
    | ホーム
@endsection

@section('content_css')
    {{ 'css/main/index.css' }}
@endsection

@section('contents')
    <div class="main_index">
        <div class="main_index_home">
            @include('main.info')
            @include('main.article')
        </div>
    </div>
@endsection

