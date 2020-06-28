<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Tag;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;


class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->id != null){
            $Article = new Article();
            $article = $Article->find($request->id);
            $tags = [];
            foreach($article->tags as $tag){
                array_push($tags, $tag->name);
            }

            $tags_string = implode(",", $tags);
            
            return view(
                'main.article.index',
                [
                    'article' => $article,
                    'tags_string' => $tags_string,
                ]);
        }else{
            return view('main.article.index');
        }
    }

    public function store(Request $request)
    {
        $errors = [];

        if($request->title === null){
            $errors['title'] = 'タイトルが入力されていません。';
        }
        if($request->article === null){
            $errors['article'] = '記事が入力されていません。';
        }

        if(!empty($errors)){
            return view(
                'main.article.index',
                [
                    'errors' => $errors,
                ]
            );
        }

        DB::beginTransaction();
        
        try{
            $Article = new Article();
            $Article->title = $request->title;
            $Article->article = $request->article;
            $Article->user_id = $request->user()->id;
            if(!empty($request->genre)){
                $Genre = new Genre();
                $Genre->updateOrCreate(['name' => $request->genre]);
                $genre_value = $Genre->where('name', $request->genre)->first();
            }
            if(!empty($request->tag)){
                $Tag = new Tag();
                $patterns = [];
                $patterns[0] = '/,/';
                $patterns[1] = '/\s/';
                $patterns[2] = '/、/';
                $patterns[3] = '/　/';
                $result = preg_replace($patterns, ",", $request->tag);
                $tags = explode(",", $result);
            }
            $Article->save();
            foreach($tags as $tag){
                if(!empty($tag)){
                    $Tag->updateOrCreate(['name' => $tag]);
                    $tag_value = $Tag->where('name', $tag)->first();
                    $Article->tags()->attach($tag_value->id);
                }
            }
                
            if(!empty($genre_value)){
                $Article->genres()->attach($genre_value->id);
            }

        }catch(\Throwable $t){
            DB::rollback();
            return back()->withInput();
        }

        DB::commit();
    
        return redirect(
            route(
                'article.edit',
                [
                    'id' => $Article->id,
                ]
            )
        );
    }

    public function edit(Request $request)
    {
        $Article = new Article();
        if($request->id){
            $article = $Article->find($request->id);
            foreach($article->tags as $tag){
                $tags[] = $tag->name;
            }
            $tags_string = implode(",", $tags);
            foreach($article->genres as $genre){
                $genres[] = $genre->name;
            }

            return view(
                'main.article.edit',
                    [
                        'article' => $article,
                        'tags_string' => $tags_string,
                        'genre' => $genres[0],
                    ]
            );
        }else{
            return redirect()->back();
        }
        
    }

    public function update(Request $request)
    {
        $errors = [];
        $Article = new Article();
        $article = $Article->find($request->id);
        if(empty($request->title)){
            $errors['title_error'] = 'タイトルが入力されていません。';
        }else{
            $article->title = $request->title;
        }

        if(empty($request->article)){
            $errors['article_error'] = '本文が入力されていません。';
        }else{
            $article->article = $request->article;
        }

        DB::beginTransaction();

        try{
            $article->save();
        }catch(QueryException $ex){
            return view(
                'main.article.edit',
                [
                    'article' => $article,
                    'tags_string' => $request->tag,
                ]
            );
        }

        if($request->tag){
            $Tag = new Tag();
            $patterns = [];
            $patterns[0] = '/,/';
            $patterns[1] = '/\s/';
            $patterns[2] = '/、/';
            $patterns[3] = '/　/';
            $result = preg_replace($patterns, ",", $request->tag);
            $tags = explode(",", $result);
            $tags_array = [];
            $article->tags()->detach();
            foreach($tags as $tag){
                if(!empty($tag)){
                    $Tag->updateOrCreate(['name' => $tag]);
                    $tag_value = $Tag->where('name', $tag)->first();
                    $article->tags()->attach($tag_value->id);
                    array_push($tags_array, $tag);
                }
            }
            $tags_string = implode(",", $tags_array);
        }
        if($request->genre){
            $Genre = new Genre();
            $Genre->updateOrCreate(['name' => $request->genre]);
            $genre_value = $Genre->where('name', $request->genre)->first();
            $article->genres()->detach();
            $article->genres()->attach($genre_value->id);
        }

        DB::commit();

        return view(
            'main.article.edit',
            [
                'article' => $article,
                'tags_string' => $tags_string,
                'genre' => $request->genre,
            ]
        );
    }

    public function list(Request $request)
    {
        $user = Auth::user();

        $articles = $user->articles;

        return view(
            'main.article.list',
                [
                    'articles' => $articles,
                ]
            );
    }
}
