<?php

namespace App\Http\Controllers;

use Session;
use Validator;
use App\Models\Article;
use App\Models\Article_user;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\CommentRequest;
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
        if($request->session()->has('article_id'))  { $request->session()->remove('article_id'); }
        if($request->session()->has('post_data'))   { $request->session()->remove('post_data');  }
        if($request->session()->has('update_data')) { $request->session()->remove('update_data');}
        if($request->session()->has('delete_data')) { $request->session()->remove('delete_data');}
        if($request->session()->has('post_img'))    { $request->session()->remove('post_img');   }
        if($request->session()->has('update_img'))  { $request->session()->remove('update_img'); }

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
        if($request->session()->has('article_id'))  { $request->session()->remove('article_id'); }
        if($request->session()->has('post_data'))   { $request->session()->remove('post_data');  }
        if($request->session()->has('update_data')) { $request->session()->remove('update_data');}
        if($request->session()->has('delete_data')) { $request->session()->remove('delete_data');}
        if($request->session()->has('post_img'))    { $request->session()->remove('post_img');   }
        if($request->session()->has('update_img'))  { $request->session()->remove('update_img'); }

        $user = Auth::user();
        $articles = Article::select('articles.*', 'article_users.article_id')
            ->selectRaw('COUNT(article_users.article_id) as favorite_no')
            ->leftJoin('article_users', 'articles.id', '=', 'article_users.article_id')
            ->groupBy('articles.id')
            ->where('delete_flag', 0)
            ->where('articles.user_id', Auth::id());     // ログインユーザーの投稿した記事に絞る

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

        //クエリ文字列のバリデータ
        $validator = Validator::make($request->query(), [
            'search_text' => 'max:30',
        ]);
        if ($validator->fails()) {
            $vali_msg = 'およそ30文字以内で入力して下さい';
            return view('my-article', compact('user', 'articles', 'str_search', 'date_desc1', 'date_desc2', 'good_desc1', 'good_desc2', 'paginator_currentpage_10limit_over', 'vali_msg'));
        }

        return view('my-article', compact('user', 'articles', 'str_search', 'date_desc1', 'date_desc2', 'good_desc1', 'good_desc2', 'paginator_currentpage_10limit_over'));
    }


    public function myArticlePost(Request $request)
    {
        $request->session()->put('article_id', $request->article_id);
        return redirect('/my-article')->withInput();
    }


    /* ユーザーがグッドした記事一覧 */
    public function myGoodArticleGet(Request $request)
    {
        if($request->session()->has('article_id'))  { $request->session()->remove('article_id'); }
        if($request->session()->has('post_data'))   { $request->session()->remove('post_data');  }
        if($request->session()->has('update_data')) { $request->session()->remove('update_data');}
        if($request->session()->has('delete_data')) { $request->session()->remove('delete_data');}
        if($request->session()->has('post_img'))    { $request->session()->remove('post_img');   }
        if($request->session()->has('update_img'))  { $request->session()->remove('update_img'); }

        $user = Auth::user();
        $articles = Article::select('articles.*', 'article_users.article_id')
            ->selectRaw('COUNT(article_users.article_id) as favorite_no')
            ->leftJoin('article_users', 'articles.id', '=', 'article_users.article_id')
            ->groupBy('articles.id')
            ->where('delete_flag', 0)
            ->where('article_users.user_id', Auth::id());     // ログインユーザーのグッドした記事に絞る

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
        return view('my-good-article', compact('user', 'articles', 'str_search', 'date_desc1', 'date_desc2', 'good_desc1', 'good_desc2', 'paginator_currentpage_10limit_over'));
    }


    public function myGoodArticlePost(Request $request)
    {
        $request->session()->put('article_id', $request->article_id);
        return redirect('/my-good-article')->withInput();
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
    public function commentPost(CommentRequest $request)
    {
        if(!($request->session()->has('article_id'))) {
            return redirect('/');
        } 
        $article_id = array('article_id' => decrypt($request->session()->get('article_id')));
        $request->merge($article_id);
        $user_id = array('user_id' => Auth::id());
        $request->merge($user_id);
        $comment = new Comment;
        $form = $request->all();
        unset($form['_token']);
        $comment->fill($form)->save();
        $request->session()->flash('comment_success', 'コメントを投稿しました。');
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
        if($request->session()->has('post_data')) {$request->session()->remove('post_data');}
        if($request->session()->has('post_img'))  {$request->session()->remove('post_img'); }
        $user = Auth::user();
        return view('post', compact('user'));
    }


    public function postPost(PostRequest $request)
    {
        // 拡張子つきでファイル名を取得
        if($request->file('image')){

            $img_filename = $request->file('image')->getClientOriginalName();
            // 拡張子のみ
            $extension = $request->file('image')->getClientOriginalExtension();
            // 新しいファイル名を生成（形式：元のファイル名_ランダムの英数字.拡張子）
            $new_img_filename = pathinfo($img_filename, PATHINFO_FILENAME) . "_" . uniqid() . "." . $extension;
            // /storage/image/tmpフォルダに画像ファイルを移動する
            $request->file('image')->move(public_path() . "/storage/image/tmp", $new_img_filename);
            $img_tmp_filepath = "/storage/image/tmp/" . $new_img_filename;
            $request->session()->put('post_img',[   'new_img_filename'  => $new_img_filename,
                                                    'tmp_filepath'      => $img_tmp_filepath]);
        } else {
            $request->session()->put('post_img', [  'new_img_filename'  => null,
                                                    'tmp_filepath'      => null]);
        }

        $request->session()->push('post_data', $request->except('image', '_token'));
        return redirect('/post_confirm')->withInput();
    }


    /* 投稿確認 */
    public function post_confirmGet(Request $request)
    {
        // バリデーション処理

        if(!($request->session()->has('post_data'))) {
            return redirect('/');
        }
        $user = Auth::user();
        $post_data = Session::get('post_data')[0];
        return view('post_confirm', compact('user', 'post_data'));
    }


    public function post_confirmPost(Request $request)
    {
        if(!($request->session()->has('post_data'))) {
            return redirect('/');
        }

        $post_data = Session::get('post_data')[0];
        unset($post_data['_token']);

        if($request->has('postBtn')) {
            $post_data = array_merge($post_data, array('user_id' => Auth::id(), 'delete_flag' => 0, 'image' => Session::get('post_img.new_img_filename')));
            $article = new Article;
            $article->fill($post_data)->save();

            if( !(empty(Session::get('post_img.new_img_filename')) || empty(Session::get('post_img.new_img_filename'))) ) {
                // レコードを挿入したときのIDを取得
                $lastInsertedId = $article->id;
                // ディレクトリを作成
                if (!file_exists(public_path() . "/image/" . $lastInsertedId)) {
                    mkdir(public_path() . "/image/" . $lastInsertedId, 0777);
                }
                // 一時保存から本番の格納場所へ移動
                rename( public_path() . "/storage/image/tmp/" . Session::get('post_img.new_img_filename'),
                        public_path() . "/image/" . $lastInsertedId . "/" . Session::get('post_img.new_img_filename'));
                // 一時保存の画像を削除
                \File::cleanDirectory(public_path() . "/storage/image/tmp");
            }

            if($request->session()->has('post_img')) { $request->session()->remove('post_img');}

            return redirect('/post_report');
        } else if ($request->has('retryBtn')) {
            $request->merge($post_data);
            return redirect('/post')->withInput();
        }

        return redirect('/');
    }


    /* 投稿報告 */
    public function post_reportGet(Request $request)
    {
        if(!($request->session()->has('post_data'))) {
            return redirect('/');
        }

        if($request->session()->has('post_data')) {$request->session()->remove('post_data');}
        if($request->session()->has('post_img'))  {$request->session()->remove('post_img'); }

        $user = Auth::user();
        return view('post_report', compact('user'));
    }

    public function post_reportPost(Request $request)
    {
        return redirect('/');
    }


    /* 更新 */
    public function updateGet(Request $request)
    {
        if($request->session()->has('update_data')) {$request->session()->remove('update_data');}
        if($request->session()->has('update_img'))  {$request->session()->remove('update_img'); }

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


    public function updatePost(UpdateRequest $request)
    {
        if(!($request->session()->has('article_id'))) {
            return redirect('/');
        }

        // 拡張子つきでファイル名を取得
        if($request->file('image')){

            $img_filename = $request->file('image')->getClientOriginalName();
            // 拡張子のみ
            $extension = $request->file('image')->getClientOriginalExtension();
            // 新しいファイル名を生成（形式：元のファイル名_ランダムの英数字.拡張子）
            $new_img_filename = pathinfo($img_filename, PATHINFO_FILENAME) . "_" . uniqid() . "." . $extension;
            // /storage/image/tmpフォルダに画像ファイルを移動する
            $request->file('image')->move(public_path() . "/storage/image/tmp", $new_img_filename);
            $img_tmp_filepath = "/storage/image/tmp/" . $new_img_filename;
            $request->session()->put('update_img', ['new_img_filename'  => $new_img_filename,
                                                    'tmp_filepath'      => $img_tmp_filepath]);
        } else {
            $request->session()->put('update_img', ['new_img_filename'  => null,
                                                    'tmp_filepath'      => null]);
        }

        $request->merge(['article_id' => decrypt($request->session()->get('article_id'))]);
        $request->session()->push('update_data', $request->except('image', '_token'));
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
            $update_data = array_merge($update_data, array('image' => Session::get('update_img.new_img_filename')));
            $article = Article::find($update_data['article_id']);
            $article->fill($update_data)->update();

            if( !(empty(Session::get('update_img.new_img_filename')) || empty(Session::get('update_img.new_img_filename'))) ) {
                // 記事のIDを取得
                $article_id = $update_data['article_id'];
                // ディレクトリを作成
                if (!file_exists(public_path() . "/image/" . $article_id)) {
                    mkdir(public_path() . "/image/" . $article_id, 0777);
                }
                // 一時保存から本番の格納場所へ移動
                rename( public_path() . "/storage/image/tmp/" . Session::get('update_img.new_img_filename'),
                        public_path() . "/image/" . $article_id . "/" . Session::get('update_img.new_img_filename'));
                // 一時保存の画像を削除
                \File::cleanDirectory(public_path() . "/storage/image/tmp");
            }

            if($request->session()->has('update_img'))  {$request->session()->remove('update_img'); }

            return redirect('/update_report')->withInput();
        } else if ($request->has('retryBtn')) {
            unset($update_data['article_id']);
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

        if($request->session()->has('update_img'))  {$request->session()->remove('update_img'); }

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
            unset($update_data['article_id']);
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
            $user->delete();
            Auth::logout();
            return redirect('/');
        } else {
            return redirect('/withdrawal');
        }
    }


}
