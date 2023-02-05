@extends('layouts.app')

@section('content')

<header class="header">                                         <!-- header -->
    <div class="cantainer my-3">

        <!-- *** タイトル *** -->
        <div class="row">
            <div class="col"></div>
            <div id="siteTitle" class="col text-center">
                <h1 id="siteTitle_h1" class="bg-info py-3 rounded-circle">
                    <a href="/login" class=" text-dark text-decoration-none">
                        <b><i class="fa-solid fa-newspaper"></i><span class="mx-2">コラムボード</span><i class="fa-regular fa-newspaper"></i></b>
                    </a>
                </h1>
            </div>
            <div class="col"></div>
        </div>

        <!-- *** サブタイトル *** -->
        @if (session('status'))
            <p id="subTitle" class="text-center">- ユーザーパスワードリセット完了 -</p>
        @endif

    </div>
</header>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                @if (session('status'))
                    <div class="card-header text-center text-primary h5">{{ __('パスワードリセット完了') }}</div>

                    <div class="card-body mt-3 mb-2">
                        <div class="alert alert-success text-center" role="alert">
                            {{ session('status') }}
                        </div>
                    </div>
                @else
                    <div class="text-center my-4">表示すべき情報は現在ありません。</div>
                @endif
            </div>

            <!-- HOMEまたはログイン画面へ戻るボタン -->
            <div class="home-return-button my-4">
                <a href="/" class="btn btn-sm btn-warning mx-4 fw-bold">HOMEへ<br />戻る</a>
                <a href="/login" class="btn btn-sm btn-success mx-4 fw-bold">ログイン画面へ<br />戻る</a>
            </div>

        </div>
    </div>
</div>
@endsection
