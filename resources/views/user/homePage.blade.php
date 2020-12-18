@extends('layouts.mainPage')
@section('title', $title)
{{-- title TRang chu --}}
@section('content')
<div class="row tm-row" id="myUL">
    @foreach ($post as $item)
        <article class="col-12 col-md-6 tm-post">
            <hr class="tm-hr-primary">
            {{-- {{url('admin/post/'.$post_Edit->id)}} --}}
            <a href="{{url('user/'.$item->id )}}" class="effect-lily tm-post-link tm-pt-60"  style="text-decoration: none;">
                <div class="tm-post-link-inner">
                    <img src="{{asset('user/blog/img/img-01.jpg')}}" alt="Image" class="img-fluid">
                </div>
                <span class="position-absolute tm-new-badge">New hoặc ko có (chưa l)</span>
                <h2 class="tm-pt-30 tm-color-primary tm-post-title">{{$item->postTitle}} </h2>
            </a>
            <p class="tm-pt-30">
                {{$item->shortDesc}}
            </p>
            <div class="d-flex justify-content-between tm-pt-45">
                <span class="tm-color-primary">{{$item->catTitle}}</span>
                <span class="tm-color-primary">{{$item->publishTime}}</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <span>0 comments</span>
                <span>{{$item->author}}</span>
            </div>
        </article>
    @endforeach
</div>

{{-- pagination --}}
<div class="row tm-row tm-mt-100 tm-mb-75 customSVG">
    {{ $post->links() }}
</div>
@endsection
