<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Article_user;
use App\Models\Comment;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Storage;
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
        if($request->session()->has('article_id')) {
            $request->session()->remove('article_id');
        }

        $user = Auth::user();
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

        // ページネーション
        $paginator_currentpage_10limit_over = false;
        if($articles->currentPage() > 10){
            $paginator_currentpage_10limit_over = true;
        }
        return view('index', compact('user', 'articles', 'str_search', 'date_desc1', 'date_desc2', 'good_desc1', 'good_desc2', 'paginator_currentpage_10limit_over'));
    }


    public function indexPost(Request $request)
    {
        $request->session()->put('article_id', $request->article_id);
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
        if(!($request->session()->has('article_id'))) {
            return redirect('/');
        } 
        $article_id = decrypt($request->session()->get('article_id'));
        $articles = Article::where('id', $article_id)->get();
        $comments = Comment::where('article_id', $article_id)->get();

        $form = [   'user_id' => Auth::id(),
                    'article_id' => $article_id,
                ];
        $good = false;
        if(Article_user::where($form)->exists()) {
            $good = true;
        }
        return view('article', compact('user', 'articles', 'comments', 'good'));
    }


    public function articlePost(Request $request)
    {
        if(!($request->session()->has('article_id'))) {
            return redirect('/');
        } 
        if ($request->has('updateBtn')) {
            return redirect('/update')->withInput();
        } else if ($request->has('deleteBtn')) {
            return redirect('/delete_confirm')->withInput();
        }
        return redirect('/');
    }


    /* コメント */
    public function commentPost(Request $request)
    {
        if(!($request->session()->has('article_id'))) {
            return redirect('/');
        } 
        $article_id = array('article_id' => decrypt($request->session()->get('article_id')));
        $request->merge($article_id);
        $comment = new Comment;
        $form = $request->all();
        unset($form['_token']);
        $comment->fill($form)->save();
        return redirect('/article')->withInput();
    }


    public function csvfilePost(Request $request)
    {
        // カラムの作成
        $head = ['タイトル', '本文'];
        // データの作成
        if(!($request->session()->has('article_id'))) {
            return redirect('/');
        } 
        $article_id = decrypt($request->session()->get('article_id'));
        $articles = Article::select('content_title', 'content')->where('id', $article_id)->get()->toArray();
        // ファイル名
        $title = $articles[0]['content_title'];
        $now_date = now()->format("Y-m-d_H-i-s");
        $file_name = 'storage/csv/'.$title.'_'.$now_date.'.csv';

        // 書き込み用ファイルを開く
        $f = fopen($file_name, 'w');
        if ($f) {
            // カラムの書き込み
            mb_convert_variables('SJIS', 'UTF-8', $head);
            fputcsv($f, $head);
            // データの書き込み
            foreach ($articles as $article) {
            mb_convert_variables('SJIS', 'UTF-8', $article);
            fputcsv($f, $article);
            }
        }
        // ファイルを閉じる
        fclose($f);

        // HTTPヘッダ
        header("Content-Type: application/octet-stream");
        header('Content-Length: '.filesize($file_name));
        header('Content-Disposition: attachment; filename='.$file_name);
        readfile($file_name);

        // ストレージに溜まるCSVデータの削除
        Storage::disk('public')->delete('csv/'.$title.'_'.$now_date.'.csv');

        // articleGet()と同じ記述
        $user = Auth::user();
        if(!($request->session()->has('article_id'))) {
            return redirect('/');
        } 
        $article_id = decrypt($request->session()->get('article_id'));
        $articles = Article::where('id', $article_id)->get();
        $comments = Comment::where('article_id', $article_id)->get();
        $user_id = Auth::id();
        $form = [   'user_id' => $user_id,
                    'article_id' => $article_id,
                ];
        $good = false;
        if(Article_user::where($form)->exists()) {
            $good = true;
        }
        return view('article', compact('user', 'articles', 'comments', 'good'));
    }


    /* GOODする処理 */
    public function goodPost(Request $request)
    {
        $article_user = new Article_user;
        $user_id = Auth::id();
        $article_id = decrypt($request->session()->get('article_id'));
        $form = [   'user_id' => $user_id,
                    'article_id' => $article_id,
                ];
        if(Article_user::where($form)->exists()) {
            return redirect('/');
        }
        $article_user->fill($form)->save();
        return redirect('/article')->withInput();
    }

    /* GOODを外す処理 */
    public function good_removePost(Request $request)
    {
        $user_id = Auth::id();
        $article_id = decrypt($request->session()->get('article_id'));
        $form = [   'user_id' => $user_id,
                    'article_id' => $article_id,
                ];
        if( !(Article_user::where($form)->exists()) ) {
            return redirect('/');
        }
        Article_user::where($form)->delete();
        return redirect('/article')->withInput();
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
        if($request->session()->has('update_data')) {
            $request->session()->remove('update_data');
        }

        $user = Auth::user();

        if(!($request->session()->has('article_id'))) {
            return redirect('/');
        }

        $article_id = decrypt($request->session()->get('article_id'));
        $articles = Article::where('id', $article_id)->get();
        if(!empty(Session::get('_old_input.update_data'))) {
            $articles = array(Session::get('_old_input.update_data'));
        }
        return view('update', compact('user', 'articles'));
    }


    public function updatePost(Request $request)
    {
        if(!($request->session()->has('article_id'))) {
            return redirect('/');
        }
        $request->merge(['article_id' => decrypt($request->session()->get('article_id'))]);
        $request->session()->push('update_data', $request->toArray());
        return redirect('/update_confirm');
    }


    /* 更新確認 */
    public function update_confirmGet(Request $request)
    {
        // バリデーション処理

        if(!($request->session()->has('article_id'))) {
            return redirect('/');
        }
        if(!($request->session()->has('update_data'))) {
            return redirect('/');
        }

        $user = Auth::user();
        $update_data = Session::get('update_data')[0];
        return view('update_confirm', compact('user', 'update_data'));
    }


    public function update_confirmPost(Request $request)
    {
        if(!($request->session()->has('article_id'))) {
            return redirect('/');
        }
        if(!($request->session()->has('update_data'))) {
            return redirect('/');
        }

        $update_data = Session::get('update_data')[0];
        unset($update_data['_token']);

        if($request->has('updateBtn')) {
            $article = Article::find($update_data['article_id']);
            $article->fill($update_data)->update();
            // 更新後の画像ファイル.binの扱い（※まずは違う画像を保存→閲覧で観れるか確認）
            return redirect('/update_report')->withInput();
        } else if ($request->has('retryBtn')) {
            $request->merge(['update_data' => $update_data]);
            return redirect('/update')->withInput();
        }
        return redirect('/');
    }


    /* 更新報告 */
    public function update_reportGet(Request $request)
    {
        if(!($request->session()->has('article_id'))) {
            return redirect('/');
        }
        if(!($request->session()->has('update_data'))) {
            return redirect('/');
        }

        $user = Auth::user();
        return view('update_report', compact('user'));
    }


    public function update_reportPost(Request $request)
    {
        if(!($request->session()->has('article_id'))) {
            return redirect('/');
        }
        if(!($request->session()->has('update_data'))) {
            return redirect('/');
        }

        if($request->has('restartBtn')) {
            $update_data = Session::get('update_data')[0];
            unset($update_data['_token']);
            $request->merge(['update_data' => $update_data]);
            return redirect('/update')->withInput();
        }
        return redirect('/');
    }


    /* 削除確認 */
    public function delete_confirmGet(Request $request)
    {
        if($request->session()->has('delete_data')) {
            $request->session()->remove('delete_data');
        }

        $user = Auth::user();

        if(!($request->session()->has('article_id'))) {
            return redirect('/');
        }

        $flag_check =Article::where('id', decrypt($request->session()->get('article_id')))->where('delete_flag', 1)->first();
        if(!(empty($flag_check))) {
            return redirect('/');
        }

        $article_id = decrypt($request->session()->get('article_id'));
        $articles = Article::where('id', $article_id)->get();
        return view('delete_confirm', compact('user', 'articles'));
    }


    public function delete_confirmPost(Request $request)
    {
        if(!($request->session()->has('article_id'))) {
            return redirect('/');
        }

        if ($request->has('deleteBtn')) {
            $user = Auth::user();
            $article_id = decrypt($request->session()->get('article_id'));
            $field = Article::find($article_id);
            $field->delete_flag = 1;
            $field->save();

            $request->session()->put('delete_data', encrypt($article_id));
            return redirect('/delete_report');
        } else {
            return redirect('/');
        }

    }


    /* 削除報告 */
    public function delete_reportGet(Request $request)
    {
        if(!($request->session()->has('article_id'))) {
            return redirect('/');
        }
        if(!($request->session()->has('delete_data'))) {
            return redirect('/');
        }

        $user = Auth::user();
        return view('delete_report', compact('user'));
    }


    public function delete_reportPost(Request $request)
    {
        return redirect('/');
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
