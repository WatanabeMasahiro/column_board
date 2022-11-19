@include('includes.head')


@include('includes.header', ['sub_title' => '記事投稿（報告）'])



<div class="container">


    <div class="row my-5">
        <span class="">投稿しました。</span>
        <span class="">投稿に失敗しました。</span>
    </div>



</div>


<!-- HOMEへ戻るボタン -->
@include('includes.home-return-btn')

<!-- 登録(記事等投稿)をやり直すボタン -->
<div class="home-return-button my-4">
    <a href="/post" class="btn btn-secondary mx-4 fw-bold">登録を<br />やり直す</a>
</div>

<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')



@include('includes.footer')