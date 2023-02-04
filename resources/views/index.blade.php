@include('includes.head')


@include('includes.header', ['sub_title' => 'HOME'])



<div class="container">

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

    <!-- *** フォーム(GET id="syncer") *** -->
    <form action="/" method="GET" id="syncer" class="form_get"></form>

    <!-- *** 検索フォーム *** -->
    <div class="mt-5 mb-2 text-center">
        <input form="syncer" type="search" name="search_text" value="{{$str_search}}" placeholder="Search for..." class="search_text mt-1" style="width: 160px; padding-left:5px;" />
        <button form="syncer" type="submit" name="search_btn" class="search_btn btn btn-sm btn-primary mb-1" alt="検索" title="検索" style="transform: scale(-1, 1); margin-bottom: 2px;"><i class="fas fa-search"></i></button>
    </div>


    <!-- *** 記事一覧テーブル *** -->
    <div class="row mt-3 mx-1">
        <div class="d-none d-sm-block">     <!-- d-sm以上 -->
            <table class="table table-hover border border-5 border-secondary fw-bold min_fontsize1" style="background:#cacad0;">
                <thead class="bg-secondary">
                    <tr class="desc-title-row">
                        <th colspan="1" style="width: 80px;" class="date_desc_anchor">
                            <input form="syncer" type="hidden" name="date_desc1" value="{{$date_desc1}}" class="date_desc_input">
                            <a id="date_desc_anchor1">最新順▼</a>
                        </th>
                        <th colspan="1" style="width: 95px; background-color: #e0d8d8;" class="good_desc_anchor">
                            <input form="syncer" type="hidden" name="good_desc1" value="{{$good_desc1}}" class="good_desc_input">
                            <a id="good_desc_anchor1" style="color:#aaaaaa;">グッド順▼</a>
                        </th>
                        <th colspan="10" style="background-color: #e0d8d8;"></th>
                    </tr>
                </thead>
            @unless( $paginator_currentpage_10limit_over )
                <tbody class="if_nondata_tbody">
                    @forelse ($articles as $article)
                    <tr class="recordData_content">
                        <td class="d-none">
                            <span>記事No:</span><br /><span class="article_id">{{encrypt($article->id)}}</span>
                            <form class="form_post" action="/" method="POST">
                                @csrf
                                <input class="input_post" type="hidden" name="article_id" value="" />
                            </form>
                        </td>
                        <td colspan="10" class="py-3">
                            <div class="p-1 mb-1" style="background-color:#f5f5f5; min-width:400px;">
                                <span style="background-color:silver;" class="px-2 rounded-circle me-1">題名</span>
                                <span>{{mb_strimwidth(strip_tags( $article->content_title ),0,50,'…','UTF-8')}}</span>
                            </div>
                            <div class="p-1 pb-2" style="background-color:#f5f5f5; min-width:400px; line-height: 0.6em;">
                                <p class="pt-2 mb-2"><span style="background-color:silver;" class="px-2 rounded-circle">本文</span></p>
                                <span class="new-line min_fontsize_0_6em">{{mb_strimwidth(strip_tags( $article->content ),0,500,'…【続く】','UTF-8')}}</span>
                            </div>
                        </td>
                        <td colspan="2" class="text-center align-middle">
                            @if( Auth::check() && ($user->id == $article->user_id) )
                            <div><i class="fa-solid fa-star text-danger"></i></div>
                            @endif
                            <div><i class="fa-solid fa-thumbs-up" style="color:darkorange;"></i><span style="margin-left:2px;">{{$article->article_users->count()}}</span></div>
                        </td>
                    </tr>
                    @empty
                    <tr class="bg-white">
                        <td colspan="12">
                            <div class="if_nondata_div text-center fw-bold fs-4">記事がありません</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            @else
                <tbody class="if_nondata_tbody">
                    <tr class="bg-white">
                        <td colspan="12">
                            <div class="if_nondata_div text-center fw-bold fs-4">記事がありません</div>
                        </td>
                    </tr>
                </tbody>
            @endunless
            </table>
        </div>

        <div class="d-sm-none">     <!-- d-sm以下 -->
            <table class="table table-hover border border-5 border-secondary fw-bold min_fontsize1" style="background:#cacad0; margin: 8px auto 20px;">
                <thead class="bg-secondary">
                    <tr class="desc-title-row">
                        <th colspan="1" style="width: 50px;" class="date_desc_anchor min_fontsize_0_7em">
                            <input form="syncer" type="hidden" name="date_desc2" value="{{$date_desc2}}" class="date_desc_input">
                            <a id="date_desc_anchor2">最新▼</a>
                        </th>
                        <th colspan="1" style="width: 60px; background-color: #e0d8d8;" class="good_desc_anchor min_fontsize_0_7em">
                            <input form="syncer" type="hidden" name="good_desc2" value="{{$good_desc2}}" class="good_desc_input">
                            <a id="good_desc_anchor2" style="color:#aaaaaa;">グッド▼</a>
                        </th>
                        <th colspan="10" style="background-color: #e0d8d8;"></th>
                    </tr>
                </thead>
            @unless( $paginator_currentpage_10limit_over )
                <tbody class="if_nondata_tbody">
                    @forelse ($articles as $article)
                    <tr class="recordData_content">
                        <td class="d-none">
                            <span>記事No:</span><br /><span class="article_id">{{encrypt($article->id)}}</span>
                            <form class="form_post" action="/" method="POST">
                                @csrf
                                <input class="input_post" type="hidden" name="article_id" value="" />
                            </form>
                        </td>
                        <td colspan="12" class="py-3">
                            <div class="p-1 mb-1" style="background-color:#f5f5f5; min-width:250px;">
                                <span style="background-color:silver;" class="px-2 rounded-circle me-1">題名<br/></span>
                                <span class="new-line min_fontsize_0_9em">{{mb_strimwidth(strip_tags( $article->content_title ),0,40,'…','UTF-8')}}</span>
                            </div>
                            <div class="p-1 pb-3" style="background-color:#f5f5f5; line-height: 0.6em; min-width:250px;">
                                <p class="pt-2 mb-2"><span style="background-color:silver;" class="px-2 rounded-circle">本文</span></p>
                                <span class="new-line min_fontsize_0_6em">{{mb_strimwidth(strip_tags( $article->content ),0,300,'…【続く】','UTF-8')}}</span>
                            </div>
                            <div>
                                <i class="fa-solid fa-thumbs-up" style="color:darkorange;"></i><span style="margin-left:2px;">{{$article->article_users->count()}}</span>
                                @if( Auth::check() && ($user->id == $article->user_id) )
                                <i class="fa-solid fa-star text-danger ms-1"></i>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="bg-white">
                        <td colspan="12">
                            <div class="if_nondata_div text-center fw-bold fs-4">記事がありません</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            @else
                <tbody class="if_nondata_tbody">
                    <tr class="bg-white">
                        <td colspan="12">
                            <div class="if_nondata_div text-center fw-bold fs-4">記事がありません</div>
                        </td>
                    </tr>
                </tbody>
            @endunless
            </table>
        </div>

        <!-- ページネーション -->
        <div class="d-flex text-center align-items-center justify-content-center mt-3 mb-5">{{ $articles->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}</div>
    </div>


</div>


<!-- 退会ページボタン -->
@if( Auth::check() )
<div class="withdrawal-button my-4">
    <a href="/withdrawal" class="btn btn-sm mx-4 bg-warning fw-bold">ユーザー<br />退会ページ</a>
</div>
@endif


<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')



@include('includes.footer')