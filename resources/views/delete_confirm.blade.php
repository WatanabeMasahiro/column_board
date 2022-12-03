@include('includes.head')


@include('includes.header', ['sub_title' => '記事削除（確認）'])



<div class="container">


    <div class="row">
        <span class="">以下の記事を削除します。<br />宜しいですか??</span>
    </div>


    <div class="row my-5">
        <table >
            @foreach($articles as $article)
            <tbody>
                <tr>
                    <td>更新日時<br />{{$article->updated_at->format('Y/m/d H:i:s')}}</td>
                    <td>投稿日時<br />{{$article->created_at->format('Y/m/d H:i:s')}}</td>
                </tr>
                <tr>
                    <td>{{$article->content_title}}</td>
                </tr>
                <tr>
                    <td>{{$article->content}}</td>
                </tr>
                <tr>
                    <td>{{$article->image_title}}</td>
                </tr>
                <tr>
                    <td>{{$article->image}}</td>
                </tr>
                <tr>
                    <td>{{$article->related_word1}}</td>
                </tr>
                <tr>
                    <td>{{$article->related_word2}}</td>
                </tr>
                <tr>
                    <td>{{$article->related_word3}}</td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>


    <form action="delete_confirm" method="POST">
        @csrf
        @foreach($articles as $article)
        <input type="hidden" name="article_id" value="{{encrypt($article->id)}}">
        @endforeach
        <button type="submit" name="deleteBtn" class="btn btn-secondary">削除</button>
        <a href="/article" class="btn btn-light">戻る</a>
    </form>


</div>


<!-- HOMEへ戻るボタン -->
@include('includes.home-return-btn')


<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')



@include('includes.footer')