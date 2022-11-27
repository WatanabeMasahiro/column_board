@include('includes.head')


@include('includes.header', ['sub_title' => '記事投稿（確認）'])



<div class="container">


    <div class="row">
        <span class="">以下の内容で投稿します。<br />宜しいですか??</span>
    </div>


    <div class="row">
        <div class="bg-info">{{$post_data['content_title']}}</div>
        <div class="bg-secondary">{{$post_data['content']}}</div>
    </div>


    <table class="table">
        <tr>
            <th>画像タイトル：</th>
            <td>{{$post_data['image_title']}}</td>
        </tr>
        <tr>
            <th>画像：</th>
            <td>{{$post_data['image']}}</td>
        </tr>

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

    <form action="post_confirm" method="POST">
        @csrf
        <input type="hidden" name="content_title" value="{{$post_data['content_title']}}" />
        <input type="hidden" name="content" value="{{$post_data['content']}}" />
        <input type="hidden" name="image_title" value="{{$post_data['image_title']}}" />
        <input type="hidden" name="image" value="{{$post_data['image']}}" />
        <input type="hidden" name="related_word1" value="{{$post_data['related_word1']}}" />
        <input type="hidden" name="related_word2" value="{{$post_data['related_word2']}}" />
        <input type="hidden" name="related_word3" value="{{$post_data['related_word3']}}" />
        <button type="submit" name="postBtn" class="btn btn-secondary" value="true">投稿</button>
        <input type="submit" name="retryBtn" value="やり直す" />
    </form>


</div>


<!-- HOMEへ戻るボタン -->
@include('includes.home-return-btn')


<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')



@include('includes.footer')