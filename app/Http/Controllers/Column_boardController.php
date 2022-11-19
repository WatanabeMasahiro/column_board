<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Column_boardController extends Controller
{

    // public function __construct()
    // {
    //     ;
    // }

    public function indexGet(Request $request)
    {
        $user = Auth::user();
        $articles = Article::orderBy('id', 'desc')->paginate(5);

        return view('index', compact('user', 'articles'));
    }

    public function indexPost(Request $request)
    {
        return redirect('/index');
    }


    public function articleGet(Request $request)
    {
        $user = Auth::user();
        $articles = Article::orderBy('id', 'desc')->paginate(5);

        return view('article', compact('user', 'articles'));
    }

    public function articlePost(Request $request)
    {
        // ここでセッションに値を入れて→post_confirmで使う。（その後、セッション解除）
        return redirect('/article');
    }


    public function myArticleGet(Request $request)
    {
        $user = Auth::user();
        $articles = Article::orderBy('id', 'desc')->paginate(5);

        return view('my-article', compact('user', 'articles'));
    }

    public function myArticlePost(Request $request)
    {
        return redirect('/my-article');
    }


    public function myGoodArticleGet(Request $request)
    {
        $user = Auth::user();
        $articles = Article::orderBy('id', 'desc')->paginate(5);

        return view('my-good-article', compact('user', 'articles'));
    }

    public function myGoodArticlePost(Request $request)
    {
        return redirect('/my-good-article');
    }


    public function postGet(Request $request)
    {
        $user = Auth::user();
        $articles = Article::all();

        return view('post', compact('user', 'articles'));
    }

    public function postPost(Request $request)
    {
        return redirect('/post');
    }


    public function post_confirmGet(Request $request)
    {
        $user = Auth::user();
        $articles = Article::all();

        return view('post_confirm', compact('user', 'articles'));
    }

    public function post_confirmPost(Request $request)
    {
        return redirect('/post_comfirm');
    }


    public function post_reportGet(Request $request)
    {
        $user = Auth::user();
        $articles = Article::all();

        return view('post_report', compact('user', 'articles'));
    }

    public function post_reportPost(Request $request)
    {
        return redirect('/post_report');
    }


    public function updateGet(Request $request)
    {
        $user = Auth::user();
        $articles = Article::all();

        return view('update', compact('user', 'articles'));
    }

    public function updatePost(Request $request)
    {
        return redirect('/update');
    }


    public function update_confirmGet(Request $request)
    {
        $user = Auth::user();
        $articles = Article::all();

        return view('update_confirm', compact('user', 'articles'));
    }

    public function update_confirmPost(Request $request)
    {
        return redirect('/update_confirm');
    }


    public function update_reportGet(Request $request)
    {
        $user = Auth::user();
        $articles = Article::all();

        return view('update_report', compact('user', 'articles'));
    }

    public function update_reportPost(Request $request)
    {
        return redirect('/update_report');
    }


    public function delete_confirmGet(Request $request)
    {
        $user = Auth::user();
        $articles = Article::all();

        return view('delete_confirm', compact('user', 'articles'));
    }

    public function delete_confirmPost(Request $request)
    {
        return redirect('/delete_confirm');
    }


    public function delete_reportGet(Request $request)
    {
        $user = Auth::user();
        $articles = Article::all();

        return view('delete_report', compact('user', 'articles'));
    }

    public function delete_reportPost(Request $request)
    {
        return redirect('/delete_report');
    }


    public function withdrawalGet(Request $request)
    {
        $user = Auth::user();
        return view('withdrawal', compact('user'));
    }

    public function withdrawalPost(Request $request)
    {
        if ($request->has('withdrawalBtn')) {
            $user = Auth::user();
            Auth::logout();
            // $user->where('id', $user->id)->delete(); /*** 物理削除 ***/
            $param = [
                'name'              => 'withdrawing_member',
                'email'             => 'withdrawal@withdrawal',
                'withdrawal_flag'   => 1,
            ];
            $user->where('id', $user->id)->update($param);
            return redirect('/');
        } else {
            return redirect('/withdrawal');
        }
    }

}
