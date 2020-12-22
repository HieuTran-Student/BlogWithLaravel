@extends('layouts.admin')
@section('title', $title)

@section('content')
<div class="right">
    <div class="right__content">
        <div class="right__title">Bảng điều khiển</div>
        <p class="right__desc">Xem thể loại đã xóa</p>

        @if (Session::has('message'))
            <p class="text-success">{{session('message')}}</p>
        @endif

        <div class="right__table">
            <div class="right__tableWrapper">

                <table id="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tên thể loại</th>
                            <th>Mô tả</th>
                            <th>Hình ảnh</th>
                            <th>Khôi phục</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($del_Cat as $item)
                            <tr>
                            <td >{{$item->id}}</td>
                            <td data-label="Tên thể loại" width ="200px">{{$item->title}}</td>
                            <td data-label="Mô tả" width = "400px">{{$item->detail}}</td>
                            <td ><img src="{{asset('img').'/'.$item->image}}"
                                alt="Category image" width="60px" height="60px">
                            </td>
                            <td data-label="Khôi Phục"  class="right__iconTable">
                                <a href="{{url('admin/category/'.$item->id.'/restore')}}"
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
