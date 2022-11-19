@include('includes.head')


@include('includes.header', ['sub_title' => '記事更新（報告）'])



<div class="container">


    <div class="row my-5">
        <span class="">更新しました。</span>
        <span class="">更新に失敗しました。</span>
    </div>



</div>


<!-- HOMEへ戻るボタン -->
@include('includes.home-return-btn')

<!-- 更新をやり直すボタン -->
<div class="home-return-button my-4">
    <a href="/update" class="btn btn-secondary mx-4 fw-bold">更新を<br />やり直す</a>
</div>

<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')



@include('includes.footer')