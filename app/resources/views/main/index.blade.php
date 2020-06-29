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
                    <ul>
                        @foreach($articles as $article)
                        <li>
                            <h5 class="index_title">{{ $article->title }}</h5>
                            <div class="index_article">{{ $article->article }}</div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection