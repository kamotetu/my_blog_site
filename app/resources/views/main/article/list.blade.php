@extends('layouts.admin')

@section('content_css')
    {{ asset('css/main/admin.css') }}
@endsection

@section('content')
    <div class="main_article se se_radius">
        <div class="main_article_container se_container">
            <div class="article_content">
                @if($articles)
                    <ul>
                        @foreach($articles as $article)
                        <li>
                            <a href="{{route('article.edit', ['id' => $article->id])}}">{{ $article['title'] }}</a>{{ $article->updated_at }}
                            <p>{{ mb_strimwidth($article['article'], 0, 100, "...") }}</p>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection