<?php

namespace App\Http\Controllers;

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
        $db_test = "";

        return view('index', compact('test'));
    }

    public function indexPost(Request $request)
    {
        return redirect('/index');
    }
    

}
