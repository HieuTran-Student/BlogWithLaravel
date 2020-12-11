<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login - Admin</title>
  <link rel="stylesheet" href="{{asset('admin/login_admin')}}/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="wrapper">
	<div class="container">

		<h1>Welcome</h1>

		@if ($errors)
			@foreach ($errors->all() as $error)
				<p class="text-danger"> {{$error}} </p>
			@endforeach
		@endif

		@if (Session::has('error'))
			<p class="text-danger"> {{session('error')}} </p>
        @endif



    <form class="form" method="POST" action="{{route('login')}}">
        @csrf
            <input type="email" placeholder="email" name="email" value="admin@gmail.com">
            <input type="password" placeholder="Password" name="password">
            <button type="submit" >Login</button>
    </form>
	</div>

	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script  src="{{asset('admin/login_admin')}}/script.js"></script>

</body>
</html>
