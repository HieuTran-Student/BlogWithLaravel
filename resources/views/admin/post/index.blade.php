@extends('layouts.admin')
@section('title', $title)
@section('content')

<div class="right">
    <div class="right__content">
        <div class="right__title">Bảng điều khiển</div>
        <p class="right__desc">Xem thể loại</p>
        <div class="right__table">
            <div class="right__tableWrapper">
                <table id="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Thể Loại</th>
                            <th>Tiêu đề bài viết</th>
                            <th>Hình Ảnh</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                            <th>Thêm nội dung</th>
                            <th>Xem nội dung</th>
                        </tr>
                    </thead>

                    @if (Session::has('message'))
                    <ul>
                        <li class="text-danger"> {{ session('message') }}</li>
                    </ul>
                    @endif

                    <tbody>
                        @foreach ($lstPost as $item)
                            <tr>
                            <td id="post_id" >{{$item->id}}</td>
                            <td id="cat_title">{{$item->cat_title}}</td>
                            <td id="post_title" data-label="Tên Bài Viết" width ="200px">{{$item->post_title}}</td>
                            <td ><img id="image"  src="{{asset('img').'/'.$item->image}}"
                                alt="Category image" width="60px" height="60px">
                            </td>
                            <td data-label="Sửa"  class="right__iconTable">
                                <a href="{{url('admin/post/'.$item->id.'/edit')}}">
                                <img  src="{{asset('admin/dashboard_admin')}}/assets/icon-edit.svg" alt=""></a>
                            </td>
                            <td data-label="Xoá"  class="right__iconTable">
                                <a href="{{url('admin/post/'.$item->id.'/delete')}}"
                                   onclick="return confirm('Xóa thể loại này ?')">
                                    <img src="{{asset('admin/dashboard_admin')}}/assets/delete.png" alt="">
                                </a>
                            </td>
                            <td  data-label="Thêm nội dung" width ="100px"  class="right__iconTable ">
                            <a  href="{{url('admin/post/createPostContent/'.$item->id)}}"  >
                                    <img src="{{asset('admin/dashboard_admin')}}/images/create.png" alt="">
                                </a>
                            </td>
                            <td  data-label="Xem nội dung" width ="100px"  class="right__iconTable ">
                                <a  href="{{url('admin/post/postDescription/'.$item->id)}}"  >
                                        <img src="{{asset('admin/dashboard_admin')}}/images/content.png" alt="">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>



@endsection
