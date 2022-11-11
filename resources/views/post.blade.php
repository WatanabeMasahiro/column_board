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

    <header class="header">                                         <!-- header -->
        <div class="cantainer my-3">

            <!-- *** タイトル *** -->
            <div class="row">
                <div class="col"></div>
                <div id="siteTitle" class="col text-center">
                    <h1 id="siteTitle_h1" class=" bg-info py-3 rounded-circle">
                        <a href="/" class=" text-dark text-decoration-none">
                            <b><i class="fa-solid fa-newspaper"></i><span class="mx-2">コラムボード</span><i class="fa-regular fa-newspaper"></i></b>
                        </a>
                    </h1>
                </div>
                <div class="col"></div>
            </div>

            <!-- *** サブタイトル *** -->
            <p id="subTitle" class="text-center">- 記事投稿 -</p>

            <!-- *** ログイン・ログアウト *** -->
            <div class="row border-bottom border-4 mx-5 my-2">
                <div class="col d-flex align-items-end mb-2">ようこそ〇〇さん</div>
                <div class="col text-end">
                    <a href="/login" class="btn btn-outline-success mb-2">ログイン</a>
                    <a href="/logout" class="btn btn-outline-danger mb-2">ログアウト</a>
                </div>
            </div>

            <!-- *** ナビゲーションバー *** -->
            <div class="row">
                <div class="col"></div>
                <div class="col-10">
                    <nav class="navbar navbar-expand-lg navbar-light fw-bold" style="background-color: #a8a8a8;">
                        <span class="d-lg-none" style="margin-left:20px; font-size:20px;">メニュー</span>
                        <button class="navbar-toggler border-light" type="button" style="margin-right:20px;" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav mx-2 mt-2">                     <!-- d-lg以上 -->
                                <div class="bg-hover-white"><a class="nav-link d-none d-lg-block" href="/post">記事投稿</a></div>
                                <div class="bg-hover-white"><a class="nav-link d-none d-lg-block" href="/my-article">あなたの記事一覧</a></div>
                                <div class="bg-hover-white"><a class="nav-link d-none d-lg-block" href="/my-good-article">グッドした記事一覧</a></div>
                            </div>
                                <div class="navbar-nav mx-2 mt-2 border-top border-bottom border-light">     <!-- d-lg以下 -->
                                <div class="bg-hover-white"><a class="nav-link d-lg-none border-top border-light" href="/post">記事投稿</a></div>
                                <div class="bg-hover-white"><a class="nav-link d-lg-none border-top border-light" href="/my-article">あなたの記事一覧</a></div>
                                <div class="bg-hover-white"><a class="nav-link d-lg-none border-top border-bottom border-light" href="/my-good-article">グッドした記事一覧</a></div>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="col"></div>
            </div>

        </div>
    </header>                                                       <!-- /header -->


    <div class="container">

        <div class="csv-button my-4">
            <button type="button" class="btn btn-sm mx-4 fw-bold" style="background-color:#7DBCD1; font-size:10px;">最新順<br />CSVファイル<br />出力</button>
            <button type="button" class="btn btn-sm mx-4 fw-bold" style="background-color:#7DBCD1; font-size:10px;">グッド順<br />CSVファイル<br />出力</button>
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



    <footer class="footer border-top border-bottom border-2 mb-2">       <!-- footer -->

        <hr class="border border-secondary w-75 mt-3" style="margin: 0 auto;" />

        <div class="container-fluid text-center my-3">
            <div class="row">
                <p class="mt-3"><b>Copyright - M-Watanabe, 2022.</b></p>
            </div>
        </div>

    </footer>                                                       <!-- /footer -->

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="{{ asset('/js/main.js') }}"></script>
</body>
</html>