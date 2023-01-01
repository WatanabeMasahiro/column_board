@include('includes.head')


@include('includes.header', ['sub_title' => '記事更新（確認）'])



<div class="container">


    <div class="row">
        <span class="">以下の内容で更新します。<br />宜しいですか??</span>
    </div>


    <div class="row">
        <div class="bg-info">{{$update_data['content_title']}}</div>
        <div class="bg-secondary">{{$update_data['content']}}</div>
    </div>


    <table class="table">
        <tr>
            <th>画像タイトル：</th>
            <td>{{$update_data['image_title']}}</td>
        </tr>
        <tr>
            <th>画像：</th>
            <td>{{$update_data['image']}}</td>
        </tr>

        <tr>
            <th>関連ワード①</th>
            <td>{{$update_data['related_word1']}}</td>
        </tr>
        <tr>
            <th>関連ワード②</th>
            <td>{{$update_data['related_word2']}}</td>
        </tr>
        <tr>
            <th>関連ワード③</th>
            <td>{{$update_data['related_word3']}}</td>
        </tr>
    </table>


    <form action="update_confirm" method="POST">
        @csrf
        <button type="submit" name="updateBtn" class="btn btn-secondary me-2">更新</button>
        <input type="submit" name="retryBtn" value="やり直す" class="ms-2" />
    </form>


</div>


<!-- HOMEへ戻るボタン -->
@include('includes.home-return-btn')


<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')



@include('includes.footer')