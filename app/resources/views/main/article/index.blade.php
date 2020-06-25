@extends('layouts.admin')

@section('content_css')
    {{ asset('css/main/admin.css') }}
@endsection

@section('content_js')
    {{ asset('js/admion_article_textarea.js') }}
@endsection

@section('content')
<div class="article_index_container">
    
    <h1>@if(isset($article)) 編集する @else 投稿する @endif</h1>
    <p>タイトル</p>
    <form action="{{route('article.store')}}"method="post">
        @csrf
        <input type="text" name="title" value="{{ $article->title ?? '' }}">

        <p>タグ</p>
        <input type="text" name="tag" value="{{ $tags_string ?? '' }}">

        <p>ジャンル</p>
        <input type="radio" name="genre" value="1" checked="checked">プログラミング
        <input type="radio" name="genre" value="2">趣味

        <p>記事</p>
        <textarea name="article" id="input_article_textarea" cols="30" rows="3">{{ $article->article ?? '' }}</textarea>
        <button type=submit id="input_article_submit">投稿する</button>
    </form>

    {{-- <div id="app">
        <sample-component></sample-component>
    </div> --}}


</div>
@endsection