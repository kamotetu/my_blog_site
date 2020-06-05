@extends('layouts.admin')

@section('content_css')
    {{ asset('css/main/admin.css') }}
@endsection

@section('content_js')
    {{ asset('js/admion_article_textarea.js') }}
@endsection

@section('content')
    <h1>投稿する</h1>
    <p>タイトル</p>
    <form action="{{route('article.store')}}"method="post">
        @csrf
        <input type="text" name="title">

        <p>タグ</p>
        <input type="text" name="tag">

        <p>記事</p>
        <textarea name="article" id="input_article_textarea" cols="30" rows="3"></textarea>
        <button type=submit>投稿する</button>
    </form>

@endsection