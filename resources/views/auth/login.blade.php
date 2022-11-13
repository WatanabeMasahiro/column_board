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
        <p id="subTitle" class="text-center">- ログイン -</p>

    </div>
</header>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header h5 text-center text-dark" style="letter-spacing: 0.05em"><b>{{ __('ログイン情報を入力') }}</b></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>メールアドレスかパスワードが間違っています。</strong>
                                    </span>
                                @enderror
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>メールアドレスかパスワードが間違っています。</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード ') }}<button id="btn-toggle-password" class="btn btn-dark btn-sm ml-1 p-0" type="button"><i class="toggle-password fas fa-eye-slash"></i></button></label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('ログイン情報を保存') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">

                              <div class="user_login_btn d-md-none col-md-12 mt-2 mb-3 text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('ログイン') }}
                                </button>
                              </div>

                              <div class="user_login_btn d-none d-md-block col-md-12 mb-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('ログイン') }}
                                </button>
                              </div>

                              <div class="d-md-none col-md-12 text-center">
                                @if (Route::has('register'))
                                    <a class="btn btn-link col-12 text-decoration-none" href="{{ route('register') }}">{{ __('ユーザー登録') }}</a>
                                @endif

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link col-12 text-decoration-none" href="{{ route('password.request') }}">
                                        {{ __('パスワードを忘れた方') }}
                                    </a>
                                @endif
                              </div>

                              <div class="d-none d-md-block col-md-12">
                                @if (Route::has('register'))
                                    <a class="btn btn-link pl-1 text-decoration-none" href="{{ route('register') }}">{{ __('ユーザー登録') }}</a>
                                @endif

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link pl-1 text-decoration-none" href="{{ route('password.request') }}">
                                        {{ __('パスワードを忘れた方') }}
                                    </a>
                                @endif
                              </div>

                            </div>
                        </div>

                    </form>
                </div>

            </div>

            <!-- HOMEへ戻るボタン -->
            <div class="home-return-button my-4">
                <a href="/" class="btn btn-warning mx-4 fw-bold">HOMEへ<br />戻る</a>
            </div>

        </div>
    </div>
</div>
@endsection
