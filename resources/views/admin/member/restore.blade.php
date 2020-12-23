@extends('layouts.admin')
@section('title', $title)

@section('content')

<div class="right">
    <div class="right__content">
        <div class="right__title">Bảng điều khiển</div>
        <p class="right__desc">Xem thể loại</p>

        @if (Session::has('message'))
            <p class="text-danger"> {{session('message')}} </p>
        @endif

        <div class="right__table">
            <div class="right__tableWrapper">
                <table id="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Ngày tạo</th>
                            <th>Khôi phục</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($member as $item)
                            <tr>
                            <td >{{$item->id}}</td>
                            <td data-label="Tên thể loại" width ="200px">{{$item->name}}</td>
                            <td data-label="Mô tả" width = "400px">{{$item->email}}</td>
                            <td data-label="Mô tả" width = "400px">{{$item->created_at}}</td>
                            <td data-label="Khôi phục"  class="right__iconTable">
                                <a href="{{url('admin/member/restoreMember/'.$item->id)}}"
                                   onclick="return confirm('Khôi phục thành viên này ?')">
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
