@extends('layouts.admin')

@section('content_css')
    {{ 'css/main/admin.css' }}
@endsection

@section('content')
    <h1>投稿する</h1>
    <p>タイトル</p>
    <input type="text" name="title">

    <p>タグ</p>
    <input type="text" name="tag">

    <p>記事</p>
    <textarea name="text" id="input_article_textarea" cols="30" rows="3"></textarea>
@endsection