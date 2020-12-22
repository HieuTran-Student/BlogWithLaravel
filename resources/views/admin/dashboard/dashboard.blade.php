@extends('layouts.admin')
@section('content')

<div class="right">
    <div class="right__content">
        <div class="right__title">Bảng điều khiển</div>
        <p class="right__desc">Bảng điều khiển</p>
        <div class="right__cards">
            <a class="right__card" style=" text-decoration: none;" href="{{route('post.index')}}">
                <div class="right__cardTitle">Bài Viết</div>
                <div class="right__cardNumber">{{$countPost}}</div>
                <div class="right__cardDesc">Xem Chi Tiết <img src="{{asset('admin/dashboard_admin')}}/assets/arrow-right.svg" alt=""></div>
            </a>
            <a class="right__card" style=" text-decoration: none;" href="{{route('category.index')}}">
                <div class="right__cardTitle">Thể Loại</div>
                <div class="right__cardNumber">{{$countCategory}}</div>
                <div class="right__cardDesc">Xem Chi Tiết <img src="{{asset('admin/dashboard_admin')}}/assets/arrow-right.svg" alt=""></div>
            </a>
            <a class="right__card" style=" text-decoration: none;" href="{{route('admin.member.index')}}">
                <div class="right__cardTitle">Thành Viên</div>
                <div class="right__cardNumber">{{$countMember}}</div>
                <div class="right__cardDesc">Xem Chi Tiết <img src="{{asset('admin/dashboard_admin')}}/assets/arrow-right.svg" alt=""></div>
            </a>
            <span class="right__card" style=" text-decoration: none;" href="#">
                <div class="right__cardTitle">Admin</div>
                <div class="right__cardNumber">{{$countAdmin}}</div>
                <div class="right__cardDesc">Admin<img src="{{asset('admin/dashboard_admin')}}/assets/arrow-right.svg" alt=""></div>
            </span>
        </div>
        {{-- <div class="right__table">
            <p class="right__tableTitle">Đơn hàng mới</p>
            <div class="right__tableWrapper">
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th style="text-align: left;">Email</th>
                            <th>Số Hoá Đơn</th>
                            <th>ID Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Kích thước</th>
                            <th>Trạng Thái</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td data-label="STT">1</td>
                            <td data-label="Email" style="text-align: left;">chibaosinger@gmail.com</td>
                            <td data-label="Số Hoá Đơn">6577544</td>
                            <td data-label="ID Sản Phẩm">2</td>
                            <td data-label="Số Lượng">1</td>
                            <td data-label="Kích thước">Trung Bình</td>
                            <td data-label="Trạng Thái">
                                Đã Thanh Toán
                            </td>
                        </tr>
                        <tr>
                            <td data-label="STT">2</td>
                            <td data-label="Email" style="text-align: left;">midu@gmail.com</td>
                            <td data-label="Số Hoá Đơn">4578644</td>
                            <td data-label="ID Sản Phẩm">4</td>
                            <td data-label="Số Lượng">2</td>
                            <td data-label="Kích thước">Nhỏ</td>
                            <td data-label="Trạng Thái">
                                Đang Xử Lý
                            </td>
                        </tr>
                        <tr>
                            <td data-label="STT">3</td>
                            <td data-label="Email" style="text-align: left;">miku@gmail.com</td>
                            <td data-label="Số Hoá Đơn">2657544</td>
                            <td data-label="ID Sản Phẩm">3</td>
                            <td data-label="Số Lượng">5</td>
                            <td data-label="Kích thước">Lớn</td>
                            <td data-label="Trạng Thái">
                                Đang Xử Lý
                            </td>
                        </tr>
                        <tr>
                            <td data-label="STT">4</td>
                            <td data-label="Email" style="text-align: left;">dangthimydung@gmail.com</td>
                            <td data-label="Số Hoá Đơn">9659544</td>
                            <td data-label="ID Sản Phẩm">8</td>
                            <td data-label="Số Lượng">12</td>
                            <td data-label="Kích thước">Trung Bình</td>
                            <td data-label="Trạng Thái">
                                Đang Xử Lý
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="" class="right__tableMore"><p>Xem tất cả các đơn đặt hàng</p> <img src="{{asset('admin/dashboard_admin')}}/assets/arrow-right-black.svg" alt=""></a>
        </div> --}}
    </div>
</div>
@endsection
