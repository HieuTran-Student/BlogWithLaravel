<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{$title, 'Hieu\'s Blog'}}</title>
	<link rel="stylesheet" href="{{asset('user/blog/fontawesome/css/all.min.css')}}"> <!-- https://fontawesome.com/ -->
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet"> <!-- https://fonts.google.com/ -->
    <link href="{{asset('user/blog/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('user/blog/css/templatemo-xtra-blog.css')}}" rel="stylesheet">

    <!-- FontAwesome JS-->
	<script defer src="{{asset('user/blog/assets/fontawesome/js/all.min.js')}}"></script>

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="{{asset('user/blog/assets/css/theme-1.css')}}">
    <style>
        .custom-navbar {
            margin-left: 18.4%;

        }
        .show {
            left:-60; !important
        }
        .justify-content-start {
            background: #0cc;
        }
   </style>
</head>
<body>

    {{-- Left --}}
    <header class="header text-center">

	    <nav class="navbar navbar-expand-lg navbar-dark" >
            <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navigation" aria-controls="navigation"
            aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			</button>

			<div id="navigation" class="collapse navbar-collapse flex-column" >


				<ul class="navbar-nav flex-column text-left">
					<li class="nav-item ">
                        @if (isset($userName))
                            <a style="text-decoration: none;" class="nav-link" href="{{route('user.homePage')}}">
                                Blog Home
                                <span class="sr-only"></span>
                            </a>
                        @else
                            <a style="text-decoration: none;" class="nav-link" href="{{route('user.homePageGuest')}}">
                                <i class="fas fa-home fa-fw mr-2"></i>
                                Blog Home
                                <span class="sr-only"></span>
                            </a>
                        @endif
					</li>

                </ul>

                <div class="profile-section pt-3 pt-lg-0">

                    <hr>
                    <h1 class="blog-name pt-lg-4 mb-0">
                        @if (isset($userName))
                            <a href="{{route('user.homePage')}}">Hiếu</a>
                        @else
                            <a href="{{route('user.homePageGuest')}}">Hiếu</a>
                        @endif
                    </h1>
                    <img class="profile-image mb-3 rounded-circle mx-auto"
                    src="{{asset('admin/dashboard_admin/images/avatar.jpg')}}" alt="image" >
					<div class="bio mb-3">Hi, my name is Tran Trong Hieu.<br>
                        <p >Find out more about me</p>
                    </div>

					<ul class="social-list list-inline py-3 mx-auto">
			            <li class="list-inline-item"><a href="#"><i class="fab fa-twitter fa-fw"></i></a></li>
                        <li class="list-inline-item">
                            <a href="https://www.linkedin.com/in/hi%E1%BA%BFu-tr%E1%BA%A7n-tr%E1%BB%8Dng-83060a201/" target="_blank">
                                <i class="fab fa-linkedin-in fa-fw"></i>
                            </a>
                        </li>
			            <li class="list-inline-item"><a href="https://github.com/HieuTran-Student"  target="_blank"><i class="fab fa-github-alt fa-fw"></i></a></li>
			            <li class="list-inline-item"><a href="https://stackoverflow.com/users/13010465/hi%e1%ba%bfu-tr%e1%ba%a7n-tr%e1%bb%8dng"  target="_blank"><i class="fab fa-stack-overflow fa-fw"></i></a></li>
			            <li class="list-inline-item"><a href="https://codepen.io/hiu-the-looper"  target="_blank"><i class="fab fa-codepen fa-fw"></i></a></li>
			        </ul>

				</div>
			</div>
		</nav>
    </header>

    {{-- Navbar USer --}}
    <nav  style="padding: 22px" class="navbar navbar-expand-xl navbar-dark bg-dark custom-navbar">
        <a href="#" class="navbar-brand"><i class="fa fa-cube"></i>Hieu's<b>Blog</b></a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">

            <div class="navbar-nav ml-auto">

                <div class="nav-item dropdown ">
                    @if (isset($userName) )
                        <a href="#" data-toggle="dropdown"
                            class="nav-item nav-link dropdown-toggle user-action "
                            style="color: #fff;"><img src="{{asset('img/User-img.png')}} "
                            style="width: 30px; height: 30px;" class="avatar" alt="Avatar"> {{$userName }}
                            <b class="caret"></b>
                        </a>
                        <div class="dropdown-menu ">
                            <a href="#" class="dropdown-item"><i class="fa fa-user-o"></i> Profile</a>
                            <a href="#" class="dropdown-item"><i class="fa fa-calendar-o"></i> Calendar</a>
                            <a href="#" class="dropdown-item"><i class="fa fa-sliders"></i> Settings</a>
                            <div class="divider dropdown-divider"></div>
                            <a href="{{route('user.logout')}}" class="dropdown-item"><i class="material-icons">&#xE8AC;</i> Logout</a>
                        </div>
                    @else
                        <a href="#" data-toggle="dropdown"
                            class="nav-item nav-link dropdown-toggle user-action "
                            style="color: #fff;"><img src="{{asset('img/User-img.png')}} "
                            style="width: 30px; height: 30px;" class="avatar" alt="Avatar"> Account
                            <b class="caret"></b>
                        </a>
                        <div class="dropdown-menu ">
                            <a href="{{route('user.getLogin')}}" class="dropdown-item"><i class="fa fa-user-o"></i> Login</a>
                            <a href="{{route('user.getSignUp')}}" class="dropdown-item"><i class="fa fa-user-o"></i> Register</a>
                            <div class="divider dropdown-divider"></div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <main class="tm-main">
            <!-- Search form -->
            <div class="row tm-row">
                <div class="col-12">
                    <form method="GET" class="form-inline tm-mb-80 tm-search-form">
                        <input  class="form-control tm-search-input" name="query" type="text" placeholder="Search..." aria-label="Search"
                        id="myInput" onkeyup="myFunction()" title="Search in a name">
                        <button class="tm-search-button" type="submit">
                            <i class="fas fa-search tm-search-icon" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
          @yield('post')  @yield('content')
            <footer class="row tm-row">
                <hr class="col-12">
                <div class="col-md-6 col-12 tm-color-gray">
                    Design: <a rel="nofollow" target="_parent" href="https://templatemo.com" class="tm-external-link">TemplateMo</a>
                </div>
                <div class="col-md-6 col-12 tm-color-gray tm-copyright">
                    Copyright 2020 Xtra Blog Company Co. Ltd.
                </div>
            </footer>
        </main>
    </div>

    <!-- Javascript -->
    {{-- Search --}}
    <script>
        function myFunction() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            ul = document.getElementById("myUL");
            li = ul.getElementsByTagName("article");
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("h2")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    </script>

    <script src="{{asset('user/blog/js/jquery.min.js')}}"></script>
    <script src="{{asset('user/blog/js/templatemo-script.js')}}"></script>

    <script src="{{asset('user/blog/assets/plugins/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('user/blog/assets/plugins/popper.min.js')}}"></script>
    <script src="{{asset('user/blog/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- Style Switcher (REMOVE ON YOUR PRODUCTION SITE) -->
    <script src="{{asset('user/blog/assets/js/demo/style-switcher.js')}}"></script>
</body>
</html>
