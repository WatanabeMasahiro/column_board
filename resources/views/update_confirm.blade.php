@include('includes.head')


@include('includes.header', ['sub_title' => '記事更新（確認）'])



<div class="container border-bottom border-2 border-secondary">

    <div class="row">
        <span class="text-center my-3">以下の内容で更新します。<br />宜しいですか??</span>
    </div>

    <!-- *** 記事の表示確認テーブル *** -->
    <div class="article-view-table table-responsive my-4">

        <div class="d-none d-md-block mb-4">     <!-- d-md以上 -->
            <table class="table border border-5 border-secondary fw-bold bg-white">
                <thead class="bg-secondary">
                    <tr class="desc-title-row">
                        <th class="text-center fs-5" style="letter-spacing:0.1em;"><span style="background-color:silver;" class="px-3 rounded-pill">表示確認</span></th>
                    </tr>
                </thead>
                <tbody class="nondata_tbody">
                    <tr>
                        <th class="px-5" colspan="12"><span>{{$update_data['content_title']}}</span></th>
                    </tr>
                    <tr>
                        <td class="px-5" colspan="12"><span class="new-line min_fontsize_0_9em">{{$update_data['content']}}</span></td>
                    </tr>
                    @if(!empty(Session::get('update_img.tmp_filepath')))
                    <tr>
                        <td class="px-2 text-center" colspan="12">
                            <div>
                                <figure class="my-0">
                                    <img src="{{Session::get('update_img.tmp_filepath')}}" alt="確認用画像" width="300px" height="200px" class="img-fluid img-thumbnail" />
                                    <figcaption class="min_fontsize_0_8em">{{$update_data['image_title']}}</figcaption>
                                </figure>
                            </div>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td class="px-2" colspan="12">
                            <p class="my-0 border-bottom border-2">関連ワード①：　{{$update_data['related_word1']}}</p>
                            <p class="my-0 border-bottom border-2">関連ワード②：　{{$update_data['related_word2']}}</p>
                            <p class="my-0 border-bottom border-2">関連ワード③：　{{$update_data['related_word3']}}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-md-none mb-4">     <!-- d-md以下 -->
            <table class="table border border-5 border-secondary fw-bold bg-white">
                <thead class="bg-secondary">
                    <tr class="desc-title-row">
                        <th class="text-center" style="letter-spacing:0.1em;"><span style="background-color:silver;" class="px-3 rounded-pill">表示確認</span></th>
                    </tr>
                </thead>
                <tbody class="nondata_tbody">
                    <tr>
                        <th class="px-2" colspan="12"><span>{{$update_data['content_title']}}</span></th>
                    </tr>
                    <tr>
                        <td class="px-2" colspan="12"><span class="new-line min_fontsize_0_8em">{{$update_data['content']}}</span></td>
                    </tr>
                    @if(!empty(Session::get('update_img.tmp_filepath')))
                    <tr>
                        <td class="px-2 text-center" colspan="12">
                            <div>
                                <figure class="my-0">
                                    <img src="{{Session::get('update_img.tmp_filepath')}}" alt="確認用画像" width="300px" height="200px" class="img-fluid img-thumbnail" />
                                    <figcaption class="min_fontsize_0_8em">{{$update_data['image_title']}}</figcaption>
                                </figure>
                            </div>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td class="px-2" colspan="12">
                            <p class="my-0 border-bottom border-2">関連ワード①：　{{$update_data['related_word1']}}</p>
                            <p class="my-0 border-bottom border-2">関連ワード②：　{{$update_data['related_word2']}}</p>
                            <p class="my-0 border-bottom border-2">関連ワード③：　{{$update_data['related_word3']}}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <form action="update_confirm" method="POST" enctype=“multipart/form-data”>
            @csrf
            <div class="text-center my-4">
                <button type="submit" name="updateBtn" class="btn btn-secondary me-3">更新</button>
                <input type="submit" name="retryBtn" value="やり直す" class="ms-3" />
            </div>
        </form>

    </div>

</div>


<!-- HOMEへ戻るボタン -->
@include('includes.home-return-btn')


<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')



@include('includes.footer')