@include('includes.head')


@include('includes.header', ['sub_title' => '記事削除（確認）'])



<div class="container border-bottom border-2 border-secondary">

    <div class="row">
        <span class="text-center my-3">以下の記事を削除します。<br />宜しいですか??</span>
    </div>

    <!-- *** 記事の表示確認テーブル *** -->
    <div class="article-view-table table-responsive my-4">

        <div class="d-none d-md-block mb-4">     <!-- d-md以上 -->
            <table class="table border border-5 border-secondary fw-bold bg-white">
                @foreach($articles as $article)
                <thead class="bg-secondary">
                    <tr class="desc-title-row">
                        <th class="text-center fs-5" style="letter-spacing:0.1em;"><span style="background-color:silver;" class="px-3 rounded-pill">表示確認</span></th>
                    </tr>
                </thead>
                <tbody class="nondata_tbody">
                    <tr>
                        <th class="px-5" colspan="12"><span>{{$article['content_title']}}</span></th>
                    </tr>
                    <tr>
                        <td class="px-5" colspan="12"><span class="new-line min_fontsize_0_9em">{{$article['content']}}</span></td>
                    </tr>
                    @if(!empty($article->image))
                    <tr>
                        <td class="px-2 text-center" colspan="12">
                            <div>
                                <figure class="my-0">
                                    <img src="{{ asset('image/' . $article->id . '/' . $article->image) }}" alt="確認用画像" width="300px" height="200px" class="img-fluid img-thumbnail" />
                                    <figcaption class="min_fontsize_0_8em">{{$article['image_title']}}</figcaption>
                                </figure>
                            </div>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td class="px-2" colspan="12">
                            <p class="my-0 border-bottom border-2">関連ワード①：　{{$article['related_word1']}}</p>
                            <p class="my-0 border-bottom border-2">関連ワード②：　{{$article['related_word2']}}</p>
                            <p class="my-0 border-bottom border-2">関連ワード③：　{{$article['related_word3']}}</p>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>

        <div class="d-md-none mb-4">     <!-- d-md以下 -->
            <table class="table border border-5 border-secondary fw-bold bg-white">
                @foreach($articles as $article)
                <thead class="bg-secondary">
                    <tr class="desc-title-row">
                        <th class="text-center" style="letter-spacing:0.1em;"><span style="background-color:silver;" class="px-3 rounded-pill">表示確認</span></th>
                    </tr>
                </thead>
                <tbody class="nondata_tbody">
                    <tr>
                        <th class="px-2" colspan="12"><span>{{$article['content_title']}}</span></th>
                    </tr>
                    <tr>
                        <td class="px-2" colspan="12"><span class="new-line min_fontsize_0_8em">{{$article['content']}}</span></td>
                    </tr>
                    @if(!empty($article->image))
                    <tr>
                        <td class="px-2 text-center" colspan="12">
                            <div>
                                <figure class="my-0">
                                    <img src="{{ asset('image/' . $article->id . '/' . $article->image) }}" alt="確認用画像" width="300px" height="200px" class="img-fluid img-thumbnail" />
                                    <figcaption class="min_fontsize_0_8em">{{$article['image_title']}}</figcaption>
                                </figure>
                            </div>
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td class="px-2" colspan="12">
                            <p class="my-0 border-bottom border-2">関連ワード①：　{{$article['related_word1']}}</p>
                            <p class="my-0 border-bottom border-2">関連ワード②：　{{$article['related_word2']}}</p>
                            <p class="my-0 border-bottom border-2">関連ワード③：　{{$article['related_word3']}}</p>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>

        <form action="delete_confirm" method="POST">
            @csrf
            <div class="text-center my-4">
                <button type="submit" name="deleteBtn" class="btn btn-secondary me-3">削除</button>
                <a href="/article" class="btn btn-light ms-3">戻る</a>
            </div>
        </form>

    </div>

</div>


<!-- HOMEへ戻るボタン -->
@include('includes.home-return-btn')


<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')



@include('includes.footer')