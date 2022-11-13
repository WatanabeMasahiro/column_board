<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class Column_boardController extends Controller
{

    // public function __construct()
    // {
    //     ;
    // }

    public function indexGet(Request $request)
    {
        $test = "test_Column_board";
        $articles = Article::orderBy('id', 'desc')->paginate(5);

        return view('index', compact('test', 'articles'));
    }

    public function indexPost(Request $request)
    {
        return redirect('/index');
    }
    

    public function postGet(Request $request)
    {
        $test = "test_Column_board";
        $articles = Article::all();

        return view('post', compact('test', 'articles'));
    }

    public function postPost(Request $request)
    {
        return redirect('/post');
    }


    public function myArticleGet(Request $request)
    {
        $test = "test_Column_board";
        $articles = Article::orderBy('id', 'desc')->paginate(5);

        return view('my-article', compact('test', 'articles'));
    }

    public function myArticlePost(Request $request)
    {
        return redirect('/my-article');
    }


    public function myGoodArticleGet(Request $request)
    {
        $test = "test_Column_board";
        $articles = Article::orderBy('id', 'desc')->paginate(5);

        return view('my-good-article', compact('test', 'articles'));
    }

    public function myGoodArticlePost(Request $request)
    {
        return redirect('/my-good-article');
    }

}
