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
                <div class="card-header text-center text-danger h5">{{ __('新しいパスワードを入力') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end" style="font-size: 0.94em;">{{ __('パスワード(確認)') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row d-md-none text-center mb-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary px-4">
                                    {{ __('送信') }}
                                </button>
                            </div>
                        </div>

                        <div class="form-group row d-none d-md-block mb-3">
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
                <a href="/" class="btn btn-sm btn-warning mx-4 fw-bold">HOMEへ<br />戻る</a>
                <a href="/login" class="btn btn-sm btn-success mx-4 fw-bold">ログイン画面へ<br />戻る</a>
            </div>

        </div>
    </div>
</div>
@endsection
