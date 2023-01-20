@include('includes.head')


@include('includes.header', ['sub_title' => '記事投稿'])



<div class="container border-bottom border-2 border-secondary">

    <div class="row" style="max-width:500px; margin: 30px auto;">
        <form action="post" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="row mb-2">
                <label class=""><span class="text-danger">※</span>タイトル：</label>
                <input type="text" name="content_title" value="{{old('content_title')}}" class="ps-2" required />
                @error('content_title')
                <p class="min_fontsize_0_8em text-danger mt-0 mb-1">{{$message}}</p>
                @enderror
            </div>
            <div class="row mb-4">
                <label class=""><span class="text-danger">※</span>本文：</label>
                <textarea class="" rows="8" name="content" class="ps-2" required>{{old('content')}}</textarea>
                @error('content')
                <p class="min_fontsize_0_8em text-danger mt-0 mb-1">{{$message}}</p>
                @enderror
            </div>

            <div class="row mb-2">
                <label class="">画像タイトル：</label>
                <input type="text" name="image_title" value="{{old('image_title')}}" class="ps-2" />
                @error('image_title')
                <p class="min_fontsize_0_8em text-danger mt-0 mb-1">{{$message}}</p>
                @enderror
            </div>
            <div class="row mb-4">
                <label class="">画像：</label>
                <input type="file" name="image" class="ps-2" />
            </div>
            <div class="mb-4">
                <div class="row mb-1 w-50">
                    <label class="mb-1">関連ワード①：</label>
                    <input type="text" name="related_word1" value="{{old('related_word1')}}" class="ps-2" />
                    @error('related_word1')
                    <p class="min_fontsize_0_7em text-danger mt-0 mb-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="row mb-1 w-50">
                    <label class="">関連ワード②：</label>
                    <input type="text" name="related_word2" value="{{old('related_word2')}}" class="ps-2" />
                    @error('related_word2')
                    <p class="min_fontsize_0_7em text-danger mt-0 mb-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="row mb-1 w-50">
                    <label class="">関連ワード③：</label>
                    <input type="text" name="related_word3" value="{{old('related_word3')}}" class="ps-2" />
                    @error('related_word3')
                    <p class="min_fontsize_0_7em text-danger mt-0 mb-1">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-secondary me-3">投稿確認</button>
                <input type="reset" value="クリア" class="ms-3" />
            </div>
        </form>
    </div>

</div>


<!-- HOMEへ戻るボタン -->
@include('includes.home-return-btn')


<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')



@include('includes.footer')