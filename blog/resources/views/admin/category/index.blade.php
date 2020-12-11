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
                            <th>Tên thể loại</th>
                            <th>Mô tả</th>
                            <th>Hình ảnh</th>
                            <th>Sửa</th>
                            <th>Xoá</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($lstCategories as $item)
                            <tr>
                            <td >{{$item->id}}</td>
                            <td data-label="Tên thể loại" width ="200px">{{$item->title}}</td>
                            <td data-label="Mô tả" width = "400px">{{$item->detail}}</td>
                            <td ><img src="{{asset('img').'/'.$item->image}}"
                                alt="Category image" width="60px" height="60px">
                            </td>
                            <td data-label="Sửa"  class="right__iconTable">
                                <a href="{{url('admin/category/'.$item->id.'/edit')}}">
                                <img src="{{asset('admin/dashboard_admin')}}/assets/icon-edit.svg" alt=""></a>
                            </td>
                            <td data-label="Xoá"  class="right__iconTable">
                                <a href="{{url('admin/category/'.$item->id.'/delete')}}"
                                   onclick="return confirm('Xóa thể loại này ?')">
                                    <img src="{{asset('admin/dashboard_admin')}}/assets/delete.png" alt="">
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
