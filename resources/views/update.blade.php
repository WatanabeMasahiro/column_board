@include('includes.head')


@include('includes.header', ['sub_title' => '記事更新'])



<div class="container border-bottom border-2 border-secondary">

    <div style="max-width:500px; margin: 30px auto;">
        @foreach($articles as $article)
        <form action="update" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="row mb-2">
                <label class=""><span class="text-danger">※</span>タイトル：</label>
                <input type="text" name="content_title" class="ps-2" value="{{$article['content_title']}}" required />
                @error('content_title')
                <p class="min_fontsize_0_8em text-danger mt-0 mb-1">{{$message}}</p>
                @enderror
            </div>
            <div class="row mb-3">
                <label class=""><span class="text-danger">※</span>本文：</label>
                <textarea class="" rows="8" name="content" class="ps-2" required>{{$article['content']}}</textarea>
                @error('content')
                <p class="min_fontsize_0_8em text-danger mt-0 mb-1">{{$message}}</p>
                @enderror
            </div>

            <div class="row mb-2">
                <label class="">画像タイトル：</label>
                <input type="text" name="image_title" value="{{$article['image_title']}}" />
                @error('image_title')
                <p class="min_fontsize_0_8em text-danger mt-0 mb-1">{{$message}}</p>
                @enderror
            </div>
            <div class="row mb-3">
                <label class="">画像：</label>
                <input type="file" name="image" class="ps-2" />
            </div>
            <div class="mb-4">
                <div class="row mb-1 w-50">
                    <label class="">関連ワード①：</label>
                    <input type="text" name="related_word1" class="ps-2" value="{{$article['related_word1']}}" />
                    @error('related_word1')
                    <p class="min_fontsize_0_7em text-danger mt-0 mb-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="row mb-1 w-50">
                    <label class="">関連ワード②：</label>
                    <input type="text" name="related_word2" class="ps-2" value="{{$article['related_word2']}}" />
                    @error('related_word2')
                    <p class="min_fontsize_0_7em text-danger mt-0 mb-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="row mb-1 w-50">
                    <label class="">関連ワード③：</label>
                    <input type="text" name="related_word3" class="ps-2" value="{{$article['related_word3']}}" />
                    @error('related_word3')
                    <p class="min_fontsize_0_7em text-danger mt-0 mb-1">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-secondary me-3">更新</button>
                <input type="reset" value="表示をリセット" class="ms-3" />
            </div>
        </form>
        @endforeach
    </div>

</div>


<!-- HOMEへ戻るボタン -->
@include('includes.home-return-btn')


<!-- トップへ戻るボタン -->
@include('includes.top-return-btn')



@include('includes.footer')