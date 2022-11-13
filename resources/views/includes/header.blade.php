<body>

    <header class="header">                                         <!-- header -->
        <div class="cantainer my-3">

            <!-- *** タイトル *** -->
            <div class="row">
                <div class="col"></div>
                <div id="siteTitle" class="col text-center">
                    <h1 id="siteTitle_h1" class="bg-info py-3 rounded-circle">
                        <a href="/" class=" text-dark text-decoration-none">
                            <b><i class="fa-solid fa-newspaper"></i><span class="mx-2">コラムボード</span><i class="fa-regular fa-newspaper"></i></b>
                        </a>
                    </h1>
                </div>
                <div class="col"></div>
            </div>

            <!-- *** サブタイトル *** -->
            <p id="subTitle" class="text-center">- {{ $sub_title }} -</p>

            <!-- *** ログイン・ログアウト *** -->
            <div class="row border-bottom border-4 border-secondary mx-5 my-2">
                <div class="col d-flex align-items-end mb-2">ようこそ<span class="font-size="1.5em;">〇〇さん</span></div>
                <div class="col text-end">
                    <a href="/login" class="btn btn-outline-success mb-2">ログイン</a>
                    <a id="logout-link" class="logout-links btn btn-outline-danger mb-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('ログアウト') }}</a>
                </div>
            </div>

            <!-- *** ナビゲーションバー *** -->
            <div class="row">
                <div class="col"></div>
                <div class="col-10">
                    <nav class="navbar navbar-expand-lg navbar-light fw-bold" style="background-color: #a8a8a8;">
                        <span class="d-lg-none" style="margin-left:20px; font-size:20px;">メニュー</span>
                        <button class="navbar-toggler border-light border-2" type="button" style="margin-right:20px;" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
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