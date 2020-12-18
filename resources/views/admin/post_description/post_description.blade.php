@extends('layouts.reviewPost')

@section('post_description')
    <button class="btn btn-secondary" type="button" style="margin-top:3%" >
        <a href="{{url('admin/post')}}" style="color: aliceblue; text-decoration: none">Quay về danh sách bài viết</a> </button>
        <button class="btn btn-secondary btn-danger" type="button" style="margin-top:3%; margin-left:30%" >
        <a href="{{url('admin/post/editDescription/'.$post->id)}}" style="color: aliceblue; text-decoration: none">Sửa Nội dung</a> </button>
    <!-- Title -->
    <h1 class="mt-4">{{$post->title}}</h1>
    <!-- Author -->
    <p >
        <img height="30px" width="30px"
        src="{{asset('admin/dashboard_admin/images/clock.png')}}" alt=""> {{$time}}
        <img style="margin-left: 3%" height="30px" width="30px"
        src="{{asset('admin/dashboard_admin/images/user.png')}}" alt=""> {{$author->name}}
        <img style="margin-left: 3%" height="30px" width="30px"
        src="{{asset('admin/dashboard_admin/images/comment.png')}}" alt=""> chưa làm
    </p>
    <hr>

    <!-- Preview Image -->
    <img class="img-fluid rounded" src="{{asset('img/'.$post->image)}}" alt="Image Review">
    <hr>

    <!-- Post Content -->
   {!!$post_desc->descriptions!!}
    <hr>
@endsection


