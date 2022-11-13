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
        <p id="subTitle" class="text-center">- ユーザー登録 -</p>

    </div>
</header>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header text-center"><b>{{ __('登録するユーザー情報を入力') }}</b></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('お名前') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end py-0">{{ __('パスワード') }}<button id="btn-toggle-pw" class="btn btn-dark btn-sm ml-1 p-0" type="button"><i class="toggle-pw fas fa-eye-slash"></i></button><br/><p class="mb-0" style="font-size:0.6em;">(※8文字以上)</p></label>

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
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end" style="font-size: 0.94em;">{{ __('パスワード') }}<button id="btn-toggle-pwConfirm" class="btn btn-dark btn-sm ml-1 p-0" type="button"><i class="toggle-pwConfirm fas fa-eye-slash"></i></button><br/><p class="mb-0" style="font-size:0.6em;">(確認用)</p></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mt-2 mb-4">
                            <div class="col-md-12 text-center d-md-none col-md-12">
                                <button type="submit" class="user_register_btn btn btn-primary">
                                    {{ __('ユーザー登録') }}
                                </button>
                            </div>

                            <div class="col-md-12 text-center d-none d-md-block pb-1">
                                <button type="submit" class="user_register_btn btn btn-primary">
                                    {{ __('ユーザー登録') }}
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
