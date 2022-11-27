@include('includes.head')


@include('includes.header', ['sub_title' => '記事閲覧'])

<div class="container border-bottom border-2 border-secondary">

    <!-- *** ユーザー登録ボタン・テキストファイル出力ボタン *** -->
    <div class="my-4 border-bottom border-2 border-secondary">
        <a href="/register" class="btn btn-sm btn-danger px-3 mx-4 mt-2 mb-4 fw-bold" style="color:#111111; width:90px;">ユーザー<br />登録</a>
        <button type="button" class="btn btn-sm px-3 mx-4 mt-2 mb-4 fw-bold" style="background-color:#7DBCD1; font-size:10px; width:80px;">テキスト<br />ファイル<br />出力</button>
    </div>


    <div class="text-center my-4 py-4 border-top border-2 border-secondary">
        <a href="/update" class="btn btn-success me-5 text-dark fw-bold">この記事を<br />更新</a>
        <a href="/delete_confirm" class="btn btn-danger text-dark ms-5 fw-bold">この記事を<br />削除</a>
    </div>

    <!-- *** グッドボタン *** -->
    <div class="row mb-0">
        <div class="d-none d-md-block col-md"></div>                    <!-- d-md以上 -->
        <div class="d-md-none col" style="max-width: 320px;"></div>     <!-- d-md以下 -->
        <div class="col-2 text-center fw-bold" style="font-size: 0.8em;">
            <p class="good-after-btn mb-0"><i class="fa-solid fa-thumbs-up"></i><span style="padding-right: 0.1em;"></span>グッド済</p>
            <p class="good-before-btn mb-0"><i class="fa-solid fa-thumbs-up"></i><span style="padding-right: 0.1em;"></span>グッドする</p>
        </div>
    </div>


    <!-- *** 記事閲覧テーブル *** -->
    <div class="article-view-table table-responsive mt-3 mx-1">
        <div class="d-none d-md-block">     <!-- d-md以上 -->
            <table class="table table-hover border border-5 border-secondary fw-bold" style="background:#cacad0;">
                @foreach ($articles as $article)
                <thead class="bg-secondary">
                    <tr class="desc-title-row min_fontsize_0_6em">
                        <th colspan="1" style="width: 130px; background-color: #e0d8d8;">更新日時<br />{{$article->updated_at->format('Y/m/d H:i:s')}}</th>
                        <th colspan="1" style="width: 130px; background-color: #e0d8d8;">投稿日時<br />{{$article->created_at->format('Y/m/d H:i:s')}}</th>
                        <th colspan="10" style="background-color: #e0d8d8;"></th>
                        </th>
                    </tr>
                </thead>
                <tbody class="nondata_tbody">
                    <tr>
                        <th class="px-5" colspan="12"><span>{{$article->content_title}}</span></th>
                    </tr>
                    <tr>
                        <td class="px-5" colspan="12"><span class="min_fontsize_0_9em">{{$article->content}}</span></td>
                    </tr>
                    <tr>
                        <td class="px-2 text-center" colspan="12"><div><img src="{{ asset('/D1000148.JPG') }}" alt="image" width="300px" height="200px" /></div></td>
                    </tr>
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
            <table class="table table-hover border border-5 border-secondary fw-bold my-0" style="background:#cacad0;">
                @foreach ($articles as $article)
                <thead class="bg-secondary">
                    <tr class="desc-title-row min_fontsize_0_6em">
                        <th colspan="1" style="width: 70px; background-color: #e0d8d8;">更新日時<br />{{$article->updated_at->format('Y/m/d')}}<br />{{$article->updated_at->format('H:i:s')}}</th>
                        <th colspan="1" style="width: 70px; background-color: #e0d8d8;">投稿日時<br />{{$article->created_at->format('Y/m/d')}}<br />{{$article->created_at->format('H:i:s')}}</th>
                        <th colspan="10" style="background-color: #e0d8d8;"></th>
                        </th>
                    </tr>
                </thead>
                <tbody class="nondata_tbody">
                    <tr>
                        <th class="px-2" colspan="12"><span>{{$article->content_title}}</span></th>
                    </tr>
                    <tr>
                        <td class="px-2" colspan="12"><span class="min_fontsize_0_8em">{{$article->content}}</span></td>
                    </tr>
                    <tr>
                        <td class="px-2 text-center" colspan="12"><div><img src="{{ asset('/D1000148.JPG') }}" alt="image" width="300px" height="200px" /></div></td>
                    </tr>
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
    <div class="my-4 comment-border">
        <div>
            <p class="comment-title ps-2 fw-bold">▼コメント(最新順)</p>
            <div class="comment-box ps-2">
                <pre>ここにコメントが入るようになっている。
                    テストテストテスト・・・・・・。
                </pre>
            </div>
            <div class="comment-box ps-2">
                <pre>ここにコメントが入るようになっている。
                    テストテストテスト・・・・・・。
                </pre>
            </div>
            <div class="comment-box ps-2">
                <pre>ここにコメントが入るようになっている。
                    テストテストテスト・・・・・・。
                </pre>
            </div>
        </div>

        <!-- コメントフォーム -->
        <div class="mt-4 ps-2 pb-3 comment-form">
            <p class="fw-bold">▼コメント入力</p>
            <form action="/comment" method="POST">
                <div class="mb-2">
                    <textarea name="comment" rows="3" cols="30"></textarea>
                </div>
                <button type="submit" name="comment-btn" class="btn btn-primary me-1">コメントする</button>
                <input type="reset" name="clear-btn" class="btn btn-secondary ms-1" value="クリア" />
            </form>
        </div>
    </div>


</div>


<!-- HOMEへ戻るボタン -->
@include('includes.home-return-btn')

<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')


@include('includes.footer')