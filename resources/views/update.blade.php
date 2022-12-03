@include('includes.head')


@include('includes.header', ['sub_title' => '記事更新'])



<div class="container border-bottom border-2 border-secondary">

    <div style="max-width:500px; margin: 30px auto;">
        @foreach($articles as $article)
        <form action="update" method="POST">
        @csrf
            <div class="row mb-2">
                <label class=""><span class="text-danger">※</span>タイトル：</label>
                <input type="text" name="content_title" class="ps-2" value="{{$article->content_title}}" required />
            </div>
            <div class="row mb-3">
                <label class=""><span class="text-danger">※</span>本文：</label>
                <textarea class="" name="content" class="ps-2" value="{{$article->content}}" required></textarea>
            </div>

            <div class="row mb-2">
                <label class="">画像タイトル：</label>
                <input type="text" name="image_title" value="{{$article->image_title}}" />
            </div>
            <div class="row mb-3">
                <label class="">画像：</label>
                <input type="file" name="image" class="ps-2" value="{{$article->image}}" />
            </div>
            <div class="mb-4">
                <div class="row mb-1 w-50">
                    <label class="">関連ワード①：</label>
                    <input type="text" name="related_word1" class="ps-2" value="{{$article->related_word1}}" />
                </div>
                <div class="row mb-1 w-50">
                    <label class="">関連ワード②：</label>
                    <input type="text" name="related_word2" class="ps-2" value="{{$article->related_word2}}" />
                </div>
                <div class="row mb-1 w-50">
                    <label class="">関連ワード③：</label>
                    <input type="text" name="related_word3" class="ps-2" value="{{$article->related_word3}}" />
                </div>
            </div>
            <div>
                <input type="hidden" name="article_id" value="{{encrypt($article->id)}}">
                <button type="submit" class="btn btn-secondary me-3">更新</button>
                <input type="reset" value="クリア" class="ms-3" />
            </div>
        </form>
        @endforeach
    </div>


    <div class="row">
        <div>ここで記事の表示確認</div>
    </div>


</div>


<!-- HOMEへ戻るボタン -->
@include('includes.home-return-btn')


<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')



@include('includes.footer')