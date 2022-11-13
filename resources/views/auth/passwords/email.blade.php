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
        <p id="subTitle" class="text-center">- ユーザーパスワードリセット -</p>

    </div>
</header>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center text-dark h5"><b>{{ __('パスワードのリセット') }}</b></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success text-center" role="alert">
                            <span>メールを送信しました。送信メールから<br/>パスワードのリセットを行って下さい。</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>エラーが発生しました。<br/>アドレスを確認し、再度お試し下さい。</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row d-md-none text-center mb-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary px-4">
                                    {{ __('送信') }}
                                </button>
                            </div>
                        </div>

                        <div class="form-group row d-none d-md-block mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary px-4">
                                    {{ __('送信') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <!-- HOMEまたはログイン画面へ戻るボタン -->
            <div class="home-return-button my-4">
                <a href="/" class="btn btn-warning mx-4 fw-bold">HOMEへ<br />戻る</a>
                <a href="/login" class="btn btn-success mx-4 fw-bold">ログイン画面へ<br />戻る</a>
            </div>

        </div>
    </div>
</div>
@endsection
