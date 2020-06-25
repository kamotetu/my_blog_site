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

        }catch(Throwable $t){
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
