<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Auth;

class IndexController extends Controller
{
    public function index()
    {
        $User = Auth::user();
        $articles = $User->articles()->get();
        
        return view(
            'main.index',
            [
                'articles' => $articles,
            ]    
        );
    }

    public function show(Request $request)
    {
        $Article = new Article();
        $article = $Article->find($request->id);
        return view(
            'main.show',
            [
                'article' => $article,
            ]
        );
    }
}
