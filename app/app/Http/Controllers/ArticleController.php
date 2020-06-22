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

        if(isset($errors)){
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
                $Genre->name = $request->genre;
            }
            if(!empty($request->tag)){
                $Tag = new Tag();
                $Tag->name = $request->tag;
            }
        }catch(Throwable $t){
            DB::rollback();
            return back()->withInput();
        }

        try{
            $Article->save();
            if(isset($Tag)){
                $Tag->save();
                $tag_id = $Tag->id;
                $Article->tags()->attach($tag_id);
            }
            if(isset($Genre)){
                $Genre->save();
                $genre_id = $Genre->id;
                $Article->genres()->attach($genre_id);
            }
        }catch(QueryException $ex){
            DB::rollback();
            return back()->withInput();
        }
        DB::commit();
    
        return redirect(
            route(
                'article.show',
                [
                    'Article_id' => $Article,
                    'id' => $Article->id,
                ]
            )
        );
    }

    
    public function show(Request $request, $id = null)
    {
        $Article = new Article();
        if($request->Article_id){
            $article = $Article->find($request->Article_id);
        }else{
            $article = $Article->find($id);
        }
        return view(
            'main.article.show',
                [
                    'article' => $article,
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
