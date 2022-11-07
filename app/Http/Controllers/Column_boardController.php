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
        $articles = Article::all();

        return view('index', compact('test', 'articles'));
    }

    public function indexPost(Request $request)
    {
        return redirect('/index');
    }
    

}
