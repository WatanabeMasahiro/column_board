@include('includes.head')


@include('includes.header', ['sub_title' => '記事更新'])



<div class="container">

    <div class="row border-bottom border-secondary border-5">
        <form action="post_confirm" method="GET">
            <label class=""><span class="text-danger">❇︎</span>タイトル：</label>
            <input type="text" name="content_title" />

            <label class=""><span class="text-danger">❇︎</span>本文：</label>
            <textarea class="" name="content"></textarea>

            <label class="">画像タイトル：</label>
            <input type="text" name="image_title" />

            <label class="">画像：</label>
            <input type="file" name="image" />

            <label class="">関連ワード①：</label>
            <input type="text" name="related_word1" />

            <label class="">関連ワード②：</label>
            <input type="text" name="related_word2" />

            <label class="">関連ワード③：</label>
            <input type="text" name="related_word3" />

            <button type="submit" class="btn btn-secondary">更新</button>
            <input type="reset" value="クリア" />

        </form>
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