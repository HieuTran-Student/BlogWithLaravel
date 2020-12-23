<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Admin Dashboard')</title>
    <link rel="stylesheet" href="{{asset('admin/dashboard_admin')}}/css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"></script>

</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="dashboard">
                <div class="left">
                    <span class="left__icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    <div class="left__content">
                        <div class="left__logo" style="    margin-left: 37%;">LOGO</div>
                        <div class="left__profile">
                            <div class="left__image"><img src="{{asset('admin/dashboard_admin')}}/images/admin_512.png" alt=""></div>
                        <p class="left__name">admin</p>
                        </div>
                        <ul class="left__menu">
                            <li class="left__menuItem">
                            <a href="{{route('admin.dashboard')}}" class="left__title"><img src="{{asset('admin/dashboard_admin')}}/assets/icon-dashboard.svg" alt="">Dashboard</a>
                            </li>
                            <li class="left__menuItem custom">
                                <div class="left__title"><img src="{{asset('admin/dashboard_admin')}}/assets/icon-book.svg" alt="">Bài Viết<img class="left__iconDown" src="{{asset('admin/dashboard_admin')}}/assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="{{route('post.create')}}">Thêm Bài Viết</a>
                                    <a class="left__link" href="{{route('post.index')}}">Xem Bài Viết</a>
                                    <a class="left__link" href="{{url('admin/posts/viewRestore')}}">Bài Đã Xóa</a>
                                </div>
                            </li>
                            <li class="left__menuItem custom">
                                <div class="left__title"><img src="{{asset('admin/dashboard_admin')}}/assets/icon-edit.svg" alt="">Thể Loại<img class="left__iconDown" src="{{asset('admin/dashboard_admin')}}/assets/arrow-down.svg" alt=""></div>
                                <div class="left__text" >
                                    <a class="left__link" href="{{route('category.create')}}">Thêm Thể Loại</a>
                                    <a class="left__link" href="{{route('category.index')}}">Xem Thể Loại</a>
                                    <a class="left__link" href="{{route('category.viewRestore')}}">Thể Loại Đã Xóa</a>
                                </div>
                            </li>
                            <li class="left__menuItem custom1 ">
                                <div class="left__title"><img src="{{asset('admin/dashboard_admin')}}/assets/icon-tag.svg" alt="">Thành Viên<img class="left__iconDown" src="{{asset('admin/dashboard_admin')}}/assets/arrow-down.svg" alt=""></div>
                                <div class="left__text custom-admin">
                                    <a class="left__link" href="{{route('admin.member.index')}}">Xem thành viên </a>
                                    <a class="left__link" href="{{route('admin.member.viewDeleteMember')}}">Khôi phục thành viên</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                            <a href="{{route('logout')}}" class="left__title"><img src="{{asset('admin/dashboard_admin')}}/assets/icon-logout.svg" alt="">Đăng Xuất</a>
                            </li>
                        </ul>
                    </div>
                </div>
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{asset('admin/dashboard_admin')}}/js/main.js">  </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function showPreview(event, id) {
            if(event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById(id);
                preview.src = src;
                preview.style.display = "block";
            }
        }


        $(document).ready(function() {

            // Cấu hình các nhãn phân trang
            $('#table').dataTable({
                "language": {
                    "sProcessing": "Đang xử lý...",
                    "sLengthMenu": "Xem _MENU_ mục",
                    "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
                    "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                    "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
                    "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                    "sInfoPostFix": "",
                    "sSearch": "Tìm:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "Đầu",
                        "sPrevious": "Trước",
                        "sNext": "Tiếp",
                        "sLast": "Cuối"
                    }
                }
            });

        });
    </script>

</body>
</html>
