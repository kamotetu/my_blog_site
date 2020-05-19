@extends('layouts.app')

{{-- @section('layout_css')
{{ asset('css/layout/layout.css') }}
@endsection --}}

@section('content')

    <div class="header_container">
        @include('header.header')
    </div>

    <div class="app_container">
        <div class="back_logo_image">
            <img src="{{ asset('img/back_home.png') }}" alt="かもてつ日記" class="back_logo_image_home">
        </div>
        @yield('contents')
    </div>

    <div class="right_container">
        @include('layouts.right_menu')
    </div>

@endsection