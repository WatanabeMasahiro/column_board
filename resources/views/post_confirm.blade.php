@include('includes.head')


@include('includes.header', ['sub_title' => '記事投稿（確認）'])



<div class="container">


    <div class="row">
        <span class="">以下の内容で投稿します。<br />宜しいですか??</span>
    </div>


    <div class="row">
        <div>ここで記事の表示確認</div>
    </div>


    <table class="table">
        <tr>
            <th>画像タイトル：</th>
            <td></td>
        </tr>
        <tr>
            <th>画像：</th>
            <td></td>
        </tr>

        <tr>
            <th>関連ワード①</th>
            <td></td>
        </tr>
        <tr>
            <th>関連ワード②</th>
            <td></td>
        </tr>
        <tr>
            <th>関連ワード③</th>
            <td></td>
        </tr>
    </table>

    <form action="post_report" method="post">
        <button type="submit" class="btn btn-secondary">投稿</button>
            <input type="reset" value="やり直す" />
    </form>


</div>


<!-- HOMEへ戻るボタン -->
@include('includes.home-return-btn')


<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')



@include('includes.footer')