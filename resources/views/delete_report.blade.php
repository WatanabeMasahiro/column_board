@include('includes.head')


@include('includes.header', ['sub_title' => '記事削除（報告）'])



<div class="container">


    <div class="row my-5">
        <span class="">削除しました。</span>
        <span class="">削除に失敗しました。</span>
    </div>



</div>


<!-- HOMEへ戻るボタン -->
@include('includes.home-return-btn')

<!-- 削除をやり直すボタン -->
<div class="home-return-button my-4">
    <a href="/delete" class="btn btn-secondary mx-4 fw-bold">削除を<br />やり直す</a>
</div>

<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')


@include('includes.footer')