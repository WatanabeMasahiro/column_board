<html>
<body>
    <div class="container">これはテストです。</div>
    @if($test)
    <p>〜⭐︎{{$test}}✨〜</p>
    @endif

    <table border="1">
        @foreach ($articles as $article)
        <tr>
            <td>{{$article->id}}</td>
            <td>{{$article->content_title}}</td>
            <td>{{$article->created_at}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>