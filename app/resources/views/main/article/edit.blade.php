@extends('layouts.admin')

@section('content_css')
    {{ asset('css/main/admin.css') }}
@endsection

@section('content_js')
    {{ asset('js/admion_article_textarea.js') }}
@endsection

@section('content')
<div class="article_index_container">
    
    <h1>編集する</h1>
    <p>タイトル id{{ $article->id }}</p>
    <form action="{{route('article.update')}}"method="post">
        @csrf
        <input type="text" name="title" value="{{ $article->title }}">

        <p>タグ</p>
        <input type="text" name="tag" value="{{ $tags_string ?? '' }}">

        <p>ジャンル</p>
        <input type="radio" name="genre" value="プログラミング" @if ($genre == 'プログラミング') checked="checked" @endif>プログラミング
        <input type="radio" name="genre" value="趣味"  @if ($genre == '趣味') checked="checked" @endif>趣味

        <p>記事</p>
        <textarea name="article" id="input_article_textarea" cols="30" rows="3">{{ $article->article }}</textarea>

        <input type="hidden" name="id" value="{{ $article->id }}">

        <button type=submit id="input_article_submit">更新する</button>
    </form>

    {{-- <div id="app">
        <sample-component></sample-component>
    </div> --}}


</div>
@endsection