@extends('layouts.mainPage')
@section('title', $title)
@section('content')

<div class="row tm-row">
    <div class="col-12">
        <hr class="tm-hr-primary tm-mb-55">
        <!-- Video player 1422x800 -->
        {{-- <video style="width: 360px " controls class="tm-mb-40">
            <source src="video/wheat-field.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video> --}}
        <div class="custom-title">

            <h2 class="pt-2 tm-color-primary tm-post-title title-custom">{{$postData[0]->postTitle}}</h2>
            <img style="width: 50%; height: 100%;" src="{{asset('img/'.$postData[0]->postImage)}}" alt="">
        </div>

    </div>
</div>
<div class="row tm-row">
    <div class="col-lg-8 tm-post-col">
        <div class="tm-post-full">
            <div class="mb-4" style="margin-top: 5%">
                <p>
                    <img height="30px" width="30px"
                    src="{{asset('admin/dashboard_admin/images/clock.png')}}" alt=""> {{$postData[0]->publishTime}}
                    <img style="margin-left: 3%" height="30px" width="30px"
                    src="{{asset('admin/dashboard_admin/images/user.png')}}" alt=""> {{$postData[0]->author}}
                    <img style="margin-left: 3%" height="30px" width="30px"
                    src="{{asset('admin/dashboard_admin/images/comment.png')}}" alt=""> <span class="fb-comments-count" data-href="http://127.0.0.1:8000/user/. {{$postData[0]->id}}"></span>
                </p>
                {!!$postData[0]->desc!!}
                <span class="d-block text-right tm-color-primary">{{$postData[0]->catTitle}}</span>
            </div>

            <!-- Comments -->
            <div>

                <div class="fb-comments" data-href="http://127.0.0.1:8000/user/. {{$postData[0]->id}}" data-width="10" data-numposts="10"></div>
                <div id="fb-root"></div>
                <script async defer crossorigin="anonymous"
                src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0&appId=3550241328394741  " nonce="YJi4JYUu"></script>
            </div>
        </div>
    </div>
    <aside class="col-lg-4 tm-aside-col">
        <div class="tm-post-sidebar">
            <hr class="mb-3 tm-hr-primary">
            <h2 class="mb-4 tm-post-title tm-color-primary">Thể Loại</h2>
            <ul class="tm-mb-75 pl-5 tm-category-list">
                @foreach ($cat as $item)
                <li style="margin-bottom: 5%">
                    <a style="text-decoration: none;" href="{{url('user/postWithCategory/'. $item->id)}}" class="tm-color-primary">
                        <img style="width: 30px; height: 30px; margin-right:4%"
                        src="{{asset('img/'. $item->image)}}" alt="">
                        {{$item->title}}
                    </a>
                </li>
                @endforeach
            </ul>
            <hr class="mb-3 tm-hr-primary">
            <h2 class="tm-mb-40 tm-post-title tm-color-primary">Bài viết liên quan</h2>
            @foreach ($relatePost as $item)
            <a href="{{url('user/'. $item->id)}}" class="d-block tm-mb-40">
                <figure>
                    <img src="{{asset('img/'.$item->postImage)}}" alt="Post Image" class="mb-3 img-fluid">
                    <figcaption class="tm-color-primary">{{$item->postTitle}}</figcaption>
                </figure>
            </a>
            @endforeach

        </div>
    </aside>
</div>
@endsection
