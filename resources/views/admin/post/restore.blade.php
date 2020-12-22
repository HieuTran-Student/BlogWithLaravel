@extends('layouts.admin')
@section('title', $title)
@section('content')

<div class="right">
    <div class="right__content">
        <div class="right__title">Bảng điều khiển</div>
        <p class="right__desc">Bài viết đã xóa</p>
        <div class="right__table">
            <div class="right__tableWrapper">
                <table id="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Thể Loại</th>
                            <th>Tiêu đề bài viết</th>
                            <th>Hình Ảnh</th>
                            <th>Khôi Phục</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($lstPost_Delete as $item)
                            <tr>
                            <td >{{$item->id}}</td>
                            <td>{{$item->cat_title}}</td>
                            <td data-label="Tên Bài Viết" width ="200px">{{$item->post_title}}</td>
                            <td ><img src="{{asset('img').'/'.$item->image}}"
                                alt="Category image" width="60px" height="60px">
                            </td>
                            <td data-label="Khôi Phục"  class="right__iconTable">
                                <a href="{{url('admin/post/'.$item->id.'/restore')}}"
                                   onclick="return confirm('Restore')">
                                    <img src="{{asset('img')}}/restore.png" alt="">
                                </a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="alert" role="alert" id="result"></div>
    </div>

@endsection
