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
        $recent_articles = $User->articles()->simplePaginate(15);
        
        return view(
            'main.index',
            [
                'recent_articles' => $recent_articles,
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
