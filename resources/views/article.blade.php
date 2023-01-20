@include('includes.head')


@include('includes.header', ['sub_title' => '記事閲覧'])

<div class="container border-bottom border-2 border-secondary">

    <!-- *** ユーザー登録リンク *** -->
    <div class="user-register-button my-4 border-bottom border-2 border-secondary">
        @unless( Auth::check() )
        <div class="text-center mb-2">
            <span style="font-size:0.8em; width:200px;"><a href="/register" class="pe-1" style="font-size:1.2em;">ユーザー登録</a>すると<br />記事投稿ができるようになります</span>
        </div>
        @else
        <div class="text-center mb-2">
            <span style="font-size:0.8em; width:200px;"><a href="/register" style="font-size:1.2em;">ユーザー登録</a></span>
        </div>
        @endunless
    </div>

    <!-- *** コメントのバリデーションのエラーメッセージ *** -->
    @error('comment')
    <div class="flashingWarning text-danger text-center my-0">{{$message}}</div>
    @enderror
    <!-- *** コメント投稿時の表示テキスト *** -->
    @if(session('comment_success'))
    <div class="flashingWarning text-primary text-center h4 my-0">{{session('comment_success')}}</div>
    @endif


    <div class="text-center mt-4 py-4 border-top border-2 border-secondary">
        <!--- *** CSVファイル出力 *** -->
        <div  class="text-start mb-4 min_fontsize_0_8em">
            <a href="#" id="text_file">CSVファイル出力</a>
            <form action="article_csvfile" method="POST" id="text_file_form">
                @csrf
                @foreach ($articles as $article)
                <input type="hidden" name="article_id" value="{{encrypt($article->id)}}" />
                @endforeach
            </form>
        </div>

        @foreach($articles as $article)
        @if(Auth::id() == $article->user_id)
        <!-- *** 記事の更新・削除の遷移ボタン *** -->
        <div class="mb-4">
            <form action="article" method="POST">
                @csrf
                <button type="submit" name="updateBtn" class="btn btn-success me-4 text-dark fw-bold min_fontsize_0_8em">この記事を<br />改稿</button>
                <button type="submit" name="deleteBtn" class="btn btn-danger text-dark ms-4 fw-bold min_fontsize_0_8em">この記事を<br />削除</button>
            </form>
        </div>
        @endif
        @endforeach
    </div>


    @if(Auth::check())
    <!-- *** グッドボタン *** -->
    <div class="fw-bold min_fontsize_0_8em">
    @foreach($articles as $article)
    @if(Auth::id() == $article->user_id)
        <p class="bg-info ps-1 pt-1 fw-light" style="width:120px;"><i class="fa-solid fa-star text-danger ms-1"></i>あなたの記事</p>
    @else
        @if($good == true)
        <form action="good_remove" method="POST">
            @csrf
            <button class="border good-after-btn py-2 rounded-pill" type="submit"><i class="fa-solid fa-thumbs-up"></i><span style="padding-right: 0.2em;"></span>グッド済</button>
        </form>
        @elseif($good == false)
        <form action="good" method="POST">
            @csrf
            <button class="border good-before-btn py-2 rounded-pill" type="submit"><i class="fa-solid fa-thumbs-up"></i><span style="padding-right: 0.2em;"></span>グッドする</button>
        </form>
        @endif
    @endif
    @endforeach
    </div>
    @endif


    <!-- *** 記事閲覧テーブル *** -->
    <div class="article-view-table table-responsive mt-3 mx-1">
        <div class="d-none d-md-block">     <!-- d-md以上 -->
            <table class="table border border-5 border-secondary fw-bold" style="background:#cacad0;">
                @foreach ($articles as $article)
                <thead class="bg-secondary">
                    <tr class="desc-title-row min_fontsize_0_6em">
                        <th colspan="1" style="width: 130px; background-color: #e0d8d8;">更新日時<br />{{$article->updated_at->format('Y/m/d H:i:s')}}</th>
                        <th colspan="1" style="width: 130px; background-color: #e0d8d8;">投稿日時<br />{{$article->created_at->format('Y/m/d H:i:s')}}</th>
                        <th colspan="10" style="background-color: #e0d8d8;"></th>
                    </tr>
                </thead>
                <tbody class="nondata_tbody">
                    <tr>
                        <th class="px-5" colspan="12"><span>{{$article->content_title}}</span></th>
                    </tr>
                    <tr>
                        <td class="px-5" colspan="12"><span class="new-line min_fontsize_0_9em">{{$article->content}}</span></td>
                    </tr>
                    @if(!empty($article->image))
                    <tr>
                        <td class="px-2 text-center" colspan="12">
                            <div>
                                <figure class="my-0">
                                    <img src="{{ asset('image/' . $article->id . '/' . $article->image) }}" alt="この記事の画像" width="300px" height="200px" class="img-fluid img-thumbnail" />
                                    <figcaption class="min_fontsize_0_8em">{{$article->image_title}}</figcaption>
                                </figure>
                            </div>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td class="px-2" colspan="12">
                            <p class="my-0 border-bottom border-2">関連ワード①：　{{$article->related_word1}}</p>
                            <p class="my-0 border-bottom border-2">関連ワード②：　{{$article->related_word2}}</p>
                            <p class="my-0 border-bottom border-2">関連ワード③：　{{$article->related_word3}}</p>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>

        <div class="d-md-none">     <!-- d-md以下 -->
            <table class="table border border-5 border-secondary fw-bold my-0" style="background:#cacad0;">
                @foreach ($articles as $article)
                <thead class="bg-secondary">
                    <tr class="desc-title-row min_fontsize_0_6em">
                        <th colspan="1" style="width: 70px; background-color: #e0d8d8;">更新日時<br />{{$article->updated_at->format('Y/m/d')}}<br />{{$article->updated_at->format('H:i:s')}}</th>
                        <th colspan="1" style="width: 70px; background-color: #e0d8d8;">投稿日時<br />{{$article->created_at->format('Y/m/d')}}<br />{{$article->created_at->format('H:i:s')}}</th>
                        <th colspan="12" style="background-color: #e0d8d8;"></th>
                    </tr>
                </thead>
                <tbody class="nondata_tbody">
                    <tr>
                        <th class="px-2" colspan="12"><span>{{$article->content_title}}</span></th>
                    </tr>
                    <tr>
                        <td class="px-2" colspan="12"><span class="new-line min_fontsize_0_8em">{{$article->content}}</span></td>
                    </tr>
                    @if(!empty($article->image))
                    <tr>
                        <td class="px-2 text-center" colspan="12">
                            <div>
                                <figure class="my-0">
                                    <img src="{{ asset('image/' . $article->id . '/' . $article->image) }}" alt="この記事の画像" width="300px" height="200px" class="img-fluid img-thumbnail" />
                                    <figcaption class="min_fontsize_0_8em">{{$article->image_title}}</figcaption>
                                </figure>
                            </div>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td class="px-2" colspan="12">
                            <p class="my-0 border-bottom border-2">関連ワード①：　{{$article->related_word1}}</p>
                            <p class="my-0 border-bottom border-2">関連ワード②：　{{$article->related_word2}}</p>
                            <p class="my-0 border-bottom border-2">関連ワード③：　{{$article->related_word3}}</p>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>


    <!-- コメント -->
    <div class="d-none d-sm-block">     <!-- d-sm以上 -->
        <div class="my-4 comment-border">
            <div>
                <p class="comment-title px-2 fw-bold">▼コメント(最新順)</p>
                @forelse ($comments as $comment)
                    @foreach ($articles as $article)
                        @if($article->user_id == $comment->user_id)
                        <div class="new-line p-2 my-4 lh-1 text-primary" style="background-color:antiquewhite;"><i class="fa-solid fa-star text-danger mb-1"></i><br />{{($comment->comment)}}</div>
                        @else
                        <div class="new-line p-2 my-4 lh-1" style="background-color:antiquewhite;">{{($comment->comment)}}</div>
                        @endif
                    @endforeach
                @empty
                <div class="bg-secondary p-2 my-5 h3">コメントがありません。</div>
                @endforelse
            </div>
            <!-- コメントフォーム -->
            <div class="mt-4 ps-2 pb-3 comment-form">
                <p class="fw-bold">▼コメント入力</p>
                <form action="/comment" method="POST">
                @csrf
                    <div class="mb-2">
                        <textarea name="comment" rows="3" cols="30" required></textarea>
                        @foreach ($articles as $article)
                        <input type="hidden" name="article_id" value="{{encrypt($article->id)}}">
                        @endforeach
                    </div>
                    <button type="submit" name="comment-btn" value="true" class="btn btn-primary me-1">コメントする</button>
                    <input type="reset" name="clear-btn" class="btn btn-secondary ms-1" value="クリア" />
                </form>
            </div>
        </div>
    </div>

    <div class="d-sm-none">     <!-- d-sm以下 -->
        <div class="my-4 comment-border-sm">
            <div>
                <p class="comment-title px-2 fw-bold">▼コメント(最新順)</p>
                @forelse ($comments as $comment)
                    @foreach ($articles as $article)
                        @if($article->user_id == $comment->user_id)
                        <div class="new-line p-2 my-4 lh-1 text-primary" style="background-color:antiquewhite;"><i class="fa-solid fa-star text-danger mb-1"></i><br />{{($comment->comment)}}</div>
                        @else
                        <div class="new-line p-2 my-4 lh-1" style="background-color:antiquewhite;">{{($comment->comment)}}</div>
                        @endif
                    @endforeach
                @empty
                <div class="bg-secondary p-2 my-5 h3">コメントがありません。</div>
                @endforelse
            </div>
            <!-- コメントフォーム -->
            <div class="mt-4 ps-2 pb-3 comment-form">
                <p class="fw-bold">▼コメント入力</p>
                <form action="/comment" method="POST">
                @csrf
                    <div class="mb-2">
                        <textarea name="comment" rows="3" cols="30" required></textarea>
                        @foreach ($articles as $article)
                        <input type="hidden" name="article_id" value="{{encrypt($article->id)}}">
                        @endforeach
                    </div>
                    <button type="submit" name="comment-btn" value="true" class="btn btn-primary me-1">コメントする</button>
                    <input type="reset" name="clear-btn" class="btn btn-secondary ms-1" value="クリア" />
                </form>
            </div>
        </div>
    </div>

</div>


<!-- HOMEへ戻るボタン -->
@include('includes.home-return-btn')

<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')


@include('includes.footer')