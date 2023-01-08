@include('includes.head')


@include('includes.header', ['sub_title' => '記事投稿（確認）'])



<div class="container">


    <div class="row">
        <span class="">以下の内容で投稿します。<br />宜しいですか??</span>
    </div>


    <div class="row">
        <div class="bg-info">{{$post_data['content_title']}}</div>
        <div class="bg-secondary pre-wrap">{{$post_data['content']}}</div>
    </div>


    <table class="table">
        <tr>
            <th>画像タイトル：</th>
            <td>{{$post_data['image_title']}}</td>
        </tr>
        @if(!empty(Session::get('post_img.tmp_filepath')))
        <tr>
            <th>画像：</th>
            <td>
                <div><img src="{{Session::get('post_img.tmp_filepath')}}" alt="確認用画像" width="300px" height="200px" class="img-fluid" /></div>
            </td>
        </tr>
        @endif
        <tr>
            <th>関連ワード①</th>
            <td>{{$post_data['related_word1']}}</td>
        </tr>
        <tr>
            <th>関連ワード②</th>
            <td>{{$post_data['related_word2']}}</td>
        </tr>
        <tr>
            <th>関連ワード③</th>
            <td>{{$post_data['related_word3']}}</td>
        </tr>
    </table>

    <form action="post_confirm" method="POST" enctype=“multipart/form-data”>
        @csrf
        <button type="submit" name="postBtn" class="btn btn-secondary me-2">投稿</button>
        <input type="submit" name="retryBtn" value="やり直す" class="ms-2" />
    </form>


</div>


<!-- HOMEへ戻るボタン -->
@include('includes.home-return-btn')


<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')



@include('includes.footer')