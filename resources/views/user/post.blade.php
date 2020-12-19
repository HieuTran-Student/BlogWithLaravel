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
            <img src="{{asset('img/'.$postData[0]->postImage)}}" alt="">
        </div>

    </div>
</div>
<div class="row tm-row">
    <div class="col-lg-8 tm-post-col">
        <div class="tm-post-full">
            <div class="mb-4">
                <p class="tm-mb-40">{{$postData[0]->publishTime}} posted by {{$postData[0]->author}}</p>
                {!!$postData[0]->desc!!}
                <span class="d-block text-right tm-color-primary">{{$postData[0]->catTitle}}</span>
            </div>

            <!-- Comments -->
            <div>
                <h2 class="tm-color-primary tm-post-title">Comments</h2>
                <hr class="tm-hr-primary tm-mb-45 custom-hr">
                <div class="tm-comment tm-mb-45">
                    <figure class="tm-comment-figure">
                        <img src="img/comment-1.jpg" alt="Image" class="mb-2 rounded-circle img-thumbnail">
                        <figcaption class="tm-color-primary text-center">Mark Sonny</figcaption>
                    </figure>
                    <div>
                        <p>
                            Praesent aliquam ex vel lectus ornare tritique. Nunc et eros
                            quis enim feugiat tincidunt et vitae dui. Nullam consectetur
                            justo ac ex laoreet rhoncus. Nunc id leo pretium, faucibus
                            sapien vel, euismod turpis.
                        </p>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="tm-color-primary">REPLY</a>
                            <span class="tm-color-primary">June 14, 2020</span>
                        </div>
                    </div>
                </div>
                <div class="tm-comment-reply tm-mb-45">
                    <hr>
                    <div class="tm-comment">
                        <figure class="tm-comment-figure">
                            <img src="img/comment-2.jpg" alt="Image" class="mb-2 rounded-circle img-thumbnail">
                            <figcaption class="tm-color-primary text-center">Jewel Soft</figcaption>
                        </figure>
                        <p>
                            Nunc et eros quis enim feugiat tincidunt et vitae dui.
                            Nullam consectetur justo ac ex laoreet rhoncus. Nunc
                            id leo pretium, faucibus sapien vel, euismod turpis.
                        </p>
                    </div>
                    <span class="d-block text-right tm-color-primary">June 21, 2020</span>
                </div>
                <form action="" class="mb-5 tm-comment-form">
                    <h2 class="tm-color-primary tm-post-title mb-4">Your comment</h2>
                    <div class="mb-4">
                        <input class="form-control" name="name" type="text">
                    </div>
                    <div class="mb-4">
                        <input class="form-control" name="email" type="text">
                    </div>
                    <div class="mb-4">
                        <textarea class="form-control" name="message" rows="6"></textarea>
                    </div>
                    <div class="text-right">
                        <button class="tm-btn tm-btn-primary tm-btn-small">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <aside class="col-lg-4 tm-aside-col">
        <div class="tm-post-sidebar">
            <hr class="mb-3 tm-hr-primary">
            <h2 class="mb-4 tm-post-title tm-color-primary">Thể Loại</h2>
            <ul class="tm-mb-75 pl-5 tm-category-list">
                @foreach ($cat as $item)
                <li>
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
