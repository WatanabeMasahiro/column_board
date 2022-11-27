<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

class Column_boardController extends Controller
{

    // public function __construct()
    // {
    //     ;
    // }

    /* 記事一覧 */
    public function indexGet(Request $request)
    {
        $user = Auth::user();
        $articles = Article::orderBy('id', 'desc')->paginate(5);
        return view('index', compact('user', 'articles'));
    }

    public function indexPost(Request $request)
    {
        return redirect('/article')->withInput();
    }

    /* ユーザー記事一覧 */
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

    /* ユーザーがグッドした記事一覧 */
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

    /* 記事閲覧(記事の詳細内容) */
    public function articleGet(Request $request)
    {
        $user = Auth::user();
        $article_id = $request->old('article_id');
        $articles = Article::where('id', $article_id)->get();
        return view('article', compact('user', 'articles'));
    }

    public function articlePost(Request $request)
    {
        // ここでコメントの処理をする
        return redirect('/article');
    }

    /* 投稿 */
    public function postGet(Request $request)
    {
        $user = Auth::user();
        return view('post', compact('user'));
    }

    public function postPost(Request $request)
    {
        return redirect('/post_confirm')->withInput();
    }

    /* 投稿確認 */
    public function post_confirmGet(Request $request)
    {
        // バリデーション処理

        $user = Auth::user();
        $post_data = Session::get('_old_input');
        return view('post_confirm', compact('user', 'post_data'));
    }

    public function post_confirmPost(Request $request)
    {
        if($request->has('postBtn')) {
            $user = Auth::user();
            $user_id = array('user_id' => $user->id);
            $delete_flag = array('delete_flag' => 0);
            $request->merge($user_id)->merge($delete_flag);
            $article = new Article;
            $form = $request->all();
            unset($form['_token']);
            $article->fill($form)->save();
            // 登録後の画像ファイル.binの扱い（※まずは違う画像を保存→閲覧で観れるか確認）
            return redirect('/post_report')->withInput();
        } else if ($request->has('retryBtn')) {
            // もどった先でdd()にて値がきていることを確認→old関数を反映？
            return redirect('/post')->withInput();
        }
        return redirect('/');
    }

    /* 投稿報告 */
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

    /* 更新 */
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

    /* 更新確認 */
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

    /* 更新報告 */
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

    /* 削除確認 */
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

    /* 削除報告 */
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

    /* 退会 */
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
