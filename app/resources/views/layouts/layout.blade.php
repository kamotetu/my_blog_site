@extends('layouts.app')

{{-- @section('layout_css')
{{ asset('css/layout/layout.css') }}
@endsection --}}

@section('content')

    <div class="header_container">
        @include('header.header')
    </div>
    <div class="app_container">
        @yield('contents')
    </div>
    <div class="right_container">
        @include('layouts.right_menu')
    </div>

@endsection