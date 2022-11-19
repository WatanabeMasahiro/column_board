@include('includes.head')


@include('includes.header', ['sub_title' => 'グッドした記事一覧'])



<div class="container">

    <!-- *** CSV出力ボタン *** -->
    <div class="csv-button my-4 border-bottom border-2 border-secondary">
        <button type="button" class="btn btn-sm mx-4 mt-2 mb-4 fw-bold" style="background-color:#7DBCD1; font-size:0.6em;">最新順<br />CSVファイル<br />出力</button>
        <button type="button" class="btn btn-sm mx-4 mt-2 mb-4 fw-bold" style="background-color:#7DBCD1; font-size:0.6em;">グッド順<br />CSVファイル<br />出力</button>
    </div>


    <!-- *** 検索フォーム *** -->
    <div class="row mt-5 mb-1">
        <div class="d-none d-lg-block col-lg"></div>    <!-- d-lg以上 -->
        <div class="d-none d-lg-block col-lg-3">
            <form action="/" method="GET">
                <input type="text" name="search_text" placeholder="Search for..." class="" style="width: 160px; padding-left:5px;" />
                <button type="input" class="btn btn-sm btn-primary" alt="検索" title="検索" style="transform: scale(-1, 1); margin-bottom: 2px;"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <div class="d-lg-none col text-center">         <!-- d-lg以下 -->
            <form action="/" method="GET">
                <input type="text" name="search_text" placeholder="Search for..." class="" style="width: 160px; padding-left:5px;" />
                <button type="input" class="btn btn-sm btn-primary" alt="検索" title="検索" style="transform: scale(-1, 1); margin-bottom: 2px;"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>


    <!-- *** 記事一覧テーブル *** -->
    <div class="row mt-3 mx-1">
        <div class="d-none d-md-block">     <!-- d-md以上 -->
            <table class="table table-hover border border-5 border-secondary fw-bold min_fontsize1" style="background:#cacad0;">
                <thead class="bg-secondary">
                    <tr class="desc-title-row">
                        <th colspan="1" style="width: 70px;" class="date_desc_anchor"><a href="/?date_desc=true">最新順▼</a></th>
                        <th colspan="1" style="width: 70px; background-color: #e0d8d8;" class="good_desc_anchor"><a href="/?good_desc=true" style="color:#aaaaaa;">グッド順▼</a></th>
                        <th colspan="10" style="background-color: #e0d8d8;"></th>
                        </th>
                    </tr>
                </thead>
                <tbody class="nondata_tbody">
                    @foreach ($articles as $article)
                    <tr>
                        <td colspan="1"><span>記事No:</span><br />{{$article->id}}</td>
                        <td colspan="3"><span style="display: inline-block; width:30px;">題名：</span>{{mb_substr($article->content_title, 0, 10, "UTF-8")}}<br /><span style="display: inline-block; width:30px;"></span>{{mb_substr($article->content_title, 10, 10, "UTF-8")}}</td>
                        <td colspan="5"><span style="display: inline-block; width:30px;">本文：</span>{{mb_substr($article->content, 0, 15, "UTF-8")}}<br /><span style="display: inline-block; width:30px;"></span>{{mb_substr($article->content, 15, 15, "UTF-8")}}…</td>
                        <td colspan="1"><i class="fa-solid fa-thumbs-up" style="color:darkorange;"></i><span style="margin-left:2px;">123</span></td>
                        <td colspan="1"><i class="fa-solid fa-star text-danger"></i></td>
                        <td colspan="1"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-md-none">     <!-- d-md以下 -->
            <table class="table table-hover border border-5 border-secondary fw-bold min_fontsize1" style="background:#cacad0;">
                <thead class="bg-secondary">
                    <tr class="desc-title-row">
                        <th colspan="1" style="width: 70px;" class="date_desc_anchor"><a href="/?date_desc=true">最新順▼</a></th>
                        <th colspan="1" style="width: 70px; background-color: #e0d8d8;" class="good_desc_anchor"><a href="/?good_desc=true" style="color:#aaaaaa;">グッド順▼</a></th>
                        <th colspan="10" style="background-color: #e0d8d8;"></th>
                        </th>
                    </tr>
                </thead>
                <tbody class="nondata_tbody">
                    @foreach ($articles as $article)
                    <tr>
                        <td colspan="1"><span>記事No:</span><br />{{$article->id}}</td>
                        <td colspan="3"><span style="display: inline-block;">題名：</span><br />{{mb_substr($article->content_title, 0, 6, "UTF-8")}}<br /><span style="display: inline-block;"></span>{{mb_substr($article->content_title, 6, 6, "UTF-8")}}</td>
                        <td colspan="5"><span style="display: inline-block;">本文：</span><br />{{mb_substr($article->content, 0, 15, "UTF-8")}}<br /><span style="display: inline-block;"></span>{{mb_substr($article->content, 15, 15, "UTF-8")}}…</td>
                        <td colspan="1"><i class="fa-solid fa-thumbs-up" style="color:darkorange;"></i><span style="margin-left:2px;">123</span></td>
                        <td colspan="1"><i class="fa-solid fa-star text-danger"></i></td>
                        <td colspan="1"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- ページネーション -->
        <div class="d-flex text-center align-items-center justify-content-center mt-3 mb-5">{{ $articles->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}</div>
    </div>
</div>


<!-- HOMEへ戻るボタン -->
@include('includes.home-return-btn')

<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')



@include('includes.footer')