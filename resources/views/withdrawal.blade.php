@include('includes.head')


@include('includes.header', ['sub_title' => 'ユーザー退会'])



<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card my-5" style="box-shadow: 0px 0px 10px 0 rgba(10, 78, 230, 0.2); border:2px solid rgba(0, 80, 235, 0.2);">

                <div class="card-header text-center text-danger h5">退会ボタンを押して下さい</div>

                <div class="card-body pb-2">
                    <form method="POST" action="/withdrawal">
                        @csrf
                        <div class="text-center mb-2">
                            <button name="withdrawalBtn" type="submit" class="withdrawalBtn btn btn-primary">　退会　</button>
                        </div> 
                    </form>
                </div>

            </div>

        </div>
    </div>

</div>


<!-- HOMEへ戻るボタン -->
@include('includes.home-return-btn')


@include('includes.footer')
