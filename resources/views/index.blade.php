<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8" />
    <meta name="description" content="コラムボード。短い評論で自己思想の共有ができるような、コラムと掲示板(ボード)を掛け合わせた主張の場。" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minmum-scale=1.0" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('/site_favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">

    <title>コラムボード</title>

</head>
<body>

    <header class="header">     <!-- header -->
        <div class="cantainer my-3">

            <div id="siteTitle" class="text-center">
                <h1 class="bg-primary">
                    <a href="/" class=" text-dark text-decoration-none">
                        <b><i class="fa-solid fa-newspaper"></i><span class="mx-2">コラムボード</span><i class="fa-regular fa-newspaper"></i></b>
                    </a>
                </h1>
            </div>

            <p class="text-center">- HOME -</p>

            <p class="text-end border-bottom">ようこそ〇〇さん</p>

            <nav class="text-center">ここにナビゲーションバー</nav>

        </div>
    </header>                   <!-- /header -->


    <div class="container text-center">

        <hr />

        <div class="row">
            <p>これはテストです。</p>
            
            @if($test)
            <p>〜⭐︎{{$test}}✨〜</p>
            @endif

            <p><i class="fas fa-thumbs-up mx-3 bg-info"></i></p>
        </div>

        <div class="row">
            <table class="table table-hover">
                <thead class="bg-secondary">
                    <tr>
                        <th>テストテーブルhead</th>
                    </tr>
                </thead>
                <tbody class="nondata_tbody">

                </tbody>
            </table>
        </div>

        <p class="text-center">ここにページネーション</p>

        <!-- <table border="1">
            @foreach ($articles as $article)
            <tr>
                <td>{{$article->id}}</td>
                <td>{{$article->content_title}}</td>
                <td>{{$article->created_at}}</td>
            </tr>
            @endforeach
        </table>

        <table border="1" style="width: 60%; margin-top: 10px;">
            @foreach ($articles as $article)
            <tr>
                <td>{{$article->content}}</td>
            </tr>
            @endforeach
        </table> -->

    </div>



    <footer class="footer border-top border-bottom border-2">     <!-- footer -->

        <hr class="border border-secondary w-75 mt-3" style="margin: 0 auto;" />

        <div class="container-fluid text-center my-3">
            <div class="row">
                <p class="mt-3"><b>Copyright - M-Watanabe, 2022.</b></p>
            </div>
        </div>

    </footer>                   <!-- /footer -->

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="{{ asset('/js/main.js') }}"></script>
</body>
</html>