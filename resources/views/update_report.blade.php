@include('includes.head')


@include('includes.header', ['sub_title' => '記事更新（報告）'])



<div class="container border-bottom border-2 border-secondary">


    <div class="row my-5 text-center">
        <span class="h4 fw-bold">記事を<br />更新しました</span>
    </div>


</div>


<!-- HOMEへ戻る・更新をやり直すボタン -->
<div class="home-return-button my-4 text-center">
    <a href="/" class="btn btn-warning me-4 fw-bold">HOMEへ<br />戻る</a>
    <button form="restart" type="submit" name="restartBtn" class="btn btn-secondary ms-4 fw-bold">更新を<br />やり直す</button>
    <form id="restart" action="update_report" method="POST">@csrf</form>
</div>


<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')



@include('includes.footer')