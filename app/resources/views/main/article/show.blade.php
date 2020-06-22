@extends('layouts.admin')

@section('content_css')
    {{ asset('css/main/admin.css') }}
@endsection

@section('content')
    <div class="main_article se se_radius">
        <div class="main_article_container se_container">
            <div class="article_content">
                <p>{{ $article->title }}</p>
                <br>
                @foreach($article->tags as $tag)
                    {{ $tag->name }}
                @endforeach

                <br>
                <br>

                <p>{{ $article->article }}</p>

                <div class="article_show_nav">
                    <p><a href="{{ route('article.index') }}">新規作成</a></p>
                    <p><a href="{{ route('article.list') }}">リストへ</a></p>
                    <p><a href="{{ route('article.index', ['id' => $article->id]) }}">編集</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection