<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Đăng ký</title>
   <!--Made with love by Mutiullah Samim -->
    <link rel="stylesheet" href="{{asset('user/login_user')}}/css/style.css">
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Đăng ký</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
            </div>

			<div class="card-body">

            @if (Session::has('error'))
			<p class="text-danger"> {{session('error')}} </p>
            @endif

            <form method="POST" action="{{route('user.postSignUp')}}" >
                @csrf

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-user-circle"></i></span>
                    </div>
                    <input required id="name" type="text" class="form-control" placeholder="Tên của bạn" name="name">

                </div>

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-at"></i></span>
						</div>
						<input required type="email" class="form-control" placeholder="Email" name="email">

                    </div>

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input required id="password" type="password" class="form-control" placeholder="Mật khẩu" name="password" onkeyup="check();" >
                    </div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
                        <span class="input-group-text"><img src="{{asset('user/images/key.png')}}" width="60%" alt=""></span>
						</div>
                        <input required id="confirmPassword" type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="confirmPassword" onkeyup="check();">

					</div>                      <span id="message"></span>
					<div class="form-group">
						<input type="submit" value="Sign Up" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
                Đẵ có tài khoản?<a href="{{route('user.getLogin')}}">Đăng nhập</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
<script>

var check = function() {
    if (document.getElementById('password').value ==
        document.getElementById('confirmPassword').value) {
        document.getElementById('message').style.color = 'aqua';
        document.getElementById('message').innerHTML = 'Ok';
    } else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'Chưa trùng khớp';
        }
};
</script>
</html>
