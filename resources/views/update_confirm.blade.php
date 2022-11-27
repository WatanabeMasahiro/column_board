@include('includes.head')


@include('includes.header', ['sub_title' => '記事更新（確認）'])



<div class="container">


    <div class="row">
        <span class="">以下の内容で更新します。<br />宜しいですか??</span>
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

    <form action="update_report" method="POST">
        @csrf
        <button type="submit" class="btn btn-secondary">更新</button>
            <input type="reset" value="やり直す" />
    </form>


</div>


<!-- HOMEへ戻るボタン -->
@include('includes.home-return-btn')


<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')



@include('includes.footer')