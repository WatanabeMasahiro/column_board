<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
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
        // $articles = Article::with('article_users')->where('delete_flag', 0);
        $articles = Article::select('articles.*', 'article_users.article_id')
            ->selectRaw('COUNT(article_users.article_id) as favorite_no')
            ->leftJoin('article_users', 'articles.id', '=', 'article_users.article_id')
            ->groupBy('articles.id')
            ->where('delete_flag', 0);

        // 検索結果の有無で「記事一覧($articles)」の出力結果を変える
        $search_text = array('search_text' => trim($request->search_text));
        $request->merge($search_text);
        $str_search = $request->search_text;
        $date_desc1 = $request->date_desc1;
        $date_desc2 = $request->date_desc2;
        $good_desc1 = $request->good_desc1;
        $good_desc2 = $request->good_desc2;

        // 検索機能
        if(!empty($str_search)) {
            $articles->where(function($articles) use($str_search){
                $articles->where('content_title', 'like', "%{$str_search}%")
                    ->orwhere('content', 'like', "%{$str_search}%")
                    ->orwhere('image_title', 'like', "%{$str_search}%")
                    ->orwhere('related_word1', 'like', "%{$str_search}%")
                    ->orwhere('related_word2', 'like', "%{$str_search}%")
                    ->orwhere('related_word3', 'like', "%{$str_search}%");
            });
        }

        // 最新順・グッド順の機能
        if($date_desc1 == true || $date_desc2 == true) {
            $articles = $articles->orderBy('created_at', 'desc')->paginate(10);
        } else if($good_desc1 == true || $good_desc2 == true) {
            $articles = $articles->orderBy('favorite_no', 'desc')->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $articles = $articles->orderBy('created_at', 'desc')->paginate(10);
        }

        $paginator_currentpage_10limit_over = false;
        if($articles->currentPage() > 10){
            $paginator_currentpage_10limit_over = true;
        }
        return view('index', compact('user', 'articles', 'str_search', 'date_desc1', 'date_desc2', 'good_desc1', 'good_desc2', 'paginator_currentpage_10limit_over'));
    }


    public function indexPost(Request $request)
    {
        $article_id = array('article_id' => decrypt($request->article_id));
        $request->merge($article_id);
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
        $comments = Comment::where('article_id', $article_id)->get();

        return view('article', compact('user', 'articles', 'comments'));
    }

    public function articlePost(Request $request)
    {
        // encryptのデベロッパー変更後のエラー画面の遷移先
        $article_id = array('article_id' => decrypt($request->article_id));
        $request->merge($article_id);
        if ($request->has('updateBtn')) {
            return redirect('/update')->withInput();
        } else if($request->has('deleteBtn')) {
            return redirect('/delete_confirm')->withInput();
        }
        return redirect('/');
    }

    /* コメント */
    public function commentPost(Request $request)
    {
        $article_id = array('article_id' => decrypt($request->article_id));
        $request->merge($article_id);
        $comment = new Comment;
        $form = $request->all();
        unset($form['_token']);
        $comment->fill($form)->save();
        return redirect('/article')->withInput();   //記事一覧ページで「コメントしました」と点滅表示
    }


    /* 投稿 */
    public function postGet(Request $request)
    {
        $user = Auth::user();
        return view('post', compact('user'));
    }

    public function postPost(Request $request)
    {
        // 拡張子つきでファイル名を取得
        if($request->file('image')){
            $image_name = $request->file('image')->getClientOriginalName();
            // 拡張子のみ
            $extension = $request->file('image')->getClientOriginalExtension();
            // 新しいファイル名を生成（形式：元のファイル名_ランダムの英数字.拡張子）
            $new_image_name = pathinfo($image_name, PATHINFO_FILENAME) . "_" . uniqid() . "." . $extension;
            // tmpフォルダに画像ファイルを移動する
            $request->file('image')->move(public_path() . "/img/tmp", $new_image_name);
            $image = "/img/tmp/" . $new_image_name;

            $request->merge(array('image' => $new_image_name));
        } else {
            $request->merge(array('image' => null));
        }

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
        $article_id = $request->old('article_id');
        $articles = Article::where('id', $article_id)->get();
        return view('update', compact('user', 'articles'));
    }

    public function updatePost(Request $request)
    {
        return redirect('/update_confirm')->withInput();
    }

    /* 更新確認 */
    public function update_confirmGet(Request $request)
    {
        // バリデーション処理

        $user = Auth::user();
        $update_data = Session::get('_old_input');
        return view('update_confirm', compact('user', 'update_data'));
    }

    public function update_confirmPost(Request $request)
    {
        if($request->has('updateBtn')) {
            // もしpostで[id]パラメータがないときの処理
            $user = Auth::user();
            $article_id = decrypt($request->article_id);
            if ($article_id == null) {
                return redirect('/');
            }
            $article = Article::find($article_id);
            $form = $request->all();
            unset($form['_token']);
            $article->fill($form)->update();
            // 更新後の画像ファイル.binの扱い（※まずは違う画像を保存→閲覧で観れるか確認）
            return redirect('/update_report')->withInput();
        } else if ($request->has('retryBtn')) {
            // もどった先でdd()にて値がきていることを確認→old関数を反映？
            return redirect('/update')->withInput();
        }
        return redirect('/');
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
        $article_id = $request->old('article_id');
        if ($article_id == null) {
            return redirect('/');
        }
        $articles = Article::where('id', $article_id)->get();
        return view('delete_confirm', compact('user', 'articles'));
    }

    public function delete_confirmPost(Request $request)
    {
        if ($request->has('deleteBtn')) {
            // もしpostで[id]パラメータがないときの処理
            $user = Auth::user();
            $article_id = decrypt($request->article_id);
            if ($article_id == null) {
                return redirect('/');
            }
            $field = Article::find($article_id);
            $field->delete_flag = 1;
            $field->save();
            return redirect('/delete_report');
        } else {
            return redirect('/');
        }
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
            // $user->where('id', $user->id)->delete(); /*** <-これは物理削除 ***/
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
