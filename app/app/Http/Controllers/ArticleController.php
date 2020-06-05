<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('main.article.index');
    }

    public function store(Request $request)
    {
        $Article = new Article();
        $Article->title = $request->title;
        $Article->article = $request->article;
        $Article->user_id = $request->user()->id;
        $Article->save();
        $Tag = new Tag();
        $Tag->name = $request->name;
        $Tag->save();
        $articles = $Article::all();
        return view('main.article.index');
    }
}
