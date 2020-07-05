@extends('layouts.layout')

@section('sub_title')
    | 
@endsection

@section('content_css')
    {{ 'css/main/index.css' }}
@endsection

@section('contents')
    <div class="main_index_container">
        <div class=main_index_content>
            <div class="main_index_content_title_area">
                <div class="main_index_genre">
                    {{dd($article->genres)}}
                </div>
                <div class="main_index_title">
                    {{ $article->title }}
                </div>
                <div class="main_index_article">
                    {! GitDown::parseAndCache($article->article) !}
                </div>
            </div>
        </div>
    </div>
@endsection