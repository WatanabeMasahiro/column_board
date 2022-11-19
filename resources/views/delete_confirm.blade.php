@include('includes.head')


@include('includes.header', ['sub_title' => '記事削除（確認）'])



<div class="container">


    <div class="row">
        <span class="">以下の記事を削除します。<br />宜しいですか??</span>
    </div>


    <div class="row my-5">
        <div>ここで記事の表示確認</div>
    </div>


    <form action="delete_report" method="post">
        <button type="submit" class="btn btn-secondary">削除</button>
        <a href="/article" class="btn btn-light">戻る</a>
    </form>


</div>


<!-- HOMEへ戻るボタン -->
@include('includes.home-return-btn')


<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')



@include('includes.footer')