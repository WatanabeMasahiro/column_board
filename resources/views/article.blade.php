@include('includes.head')


@include('includes.header', ['sub_title' => 'HOME'])

<div class="container">

    <!-- *** ユーザー登録ボタン *** -->
    <div class="row user-register-button my-4 border-bottom border-2 border-secondary">
                <div class="col"><a href="/register" class="btn btn-sm btn-danger px-3 mx-4 mt-2 mb-4 fw-bold" style="color:#111111;">ユーザー<br />登録</a></div>
                <div class="col"><button type="button" class="btn btn-sm px-3 mx-4 mt-2 mb-4 fw-bold" style="background-color:#7DBCD1; font-size:10px;">テキスト<br />ファイル<br />出力</button></div>
                <div class="col-8"></div>
            </tr>
        </table>
    </div>


    <div>ここに閲覧記事</div>


    <div>ここにコメント</div>


    <div class="row">
        <!-- HOMEへ戻るボタン -->
        @include('includes.home-return-btn')
        <div class="home-return-button my-4">
            <a href="/" class="btn btn-warning mx-4 fw-bold">HOMEへ<br />戻る</a>
        </div>

        <div class="my-4">
            <a href="/delete_comfirm" class="btn btn-danger mx-4 fw-bold">この記事を<br />削除</a>
        </div>
        <div class="my-4">
            <a href="/update" class="btn btn-success mx-4 fw-bold">この記事を<br />更新</a>
        </div>
    </div>

</div>

<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')


@include('includes.footer')