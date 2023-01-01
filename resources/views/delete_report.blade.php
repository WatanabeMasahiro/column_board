@include('includes.head')


@include('includes.header', ['sub_title' => '記事削除（報告）'])



<div class="container border-bottom border-2 border-secondary">


    <div class="row my-5 text-center">
        <span class="h4 fw-bold">記事を<br />削除しました</span>
    </div>


</div>


<!-- HOMEへ戻るボタン -->
<div class="text-center">
@include('includes.home-return-btn')
</div>

<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')


@include('includes.footer')