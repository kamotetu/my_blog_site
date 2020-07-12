@extends('layouts.layout')

@section('sub_title')
    | ホーム
@endsection

@section('content_css')
    {{ 'css/main/index.css' }}
@endsection

@section('contents')
    <div class="main_index_container">
        <div class=main_index_content>
            <div class="main_index_content_title_area">
                <div class="main_index_content_title">
                    最近の記事
                    <ul class="main_index_title">
                        @foreach($recent_articles as $article)
                        <a href="{{ route('show', ['id' => $article->id]) }}">
                            <li>
                                <h6 class="index_title">{{ $article->title }}</h6>
                                <div class="index_article">{{ mb_strimwidth($article->article, 0, 50, "...") }}</div>
                            </li>
                        </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection