<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>学校Laravel - @yield('title')</title>
	<link rel="stylesheet" href="{{ asset('static/css/bootstrap.min.css') }}">
	@section('style')

	@show
</head>
<body>
	<!-- 头部 -->
	@section('herader')
	<div class="jumbotron">
		<div class="container">
			<h2>学</h2>
		</div>
	</div>
	@show
	<!-- 中间内容 -->
	<div class="container">
		<div class="row">
			<!-- 左侧菜单 -->
			<div class="col-md-3">
				@section('leftmenu')
					<div class="list-group">
						<a href="{{ url('student/index') }}" class="list-group-item {{ Request::getPathInfo() != '/student/create' ? 'active' : '' }}">学生列表</a>
						<a href="{{ url('student/create') }}" class="list-group-item {{ Request::getPathInfo() == '/student/create' ? 'active' : '' }}">新增学生</a>
					</div>
				@show
			</div>
			<div class="col-md-9">
				@yield('content')

			</div>
		</div>
	</div>
	<!-- 尾部 -->
	@section('footer')
	<div class="jumbotron" style="margin: 0;">
		<div class="container">
			<span> @2020 syy</span>
		</div>
	</div>
	@show
	<!-- jQuery -->
	<script src="{{ asset('static/js/jquery-2.1.1.min.js') }}"></script>
	<!-- Bootstrap JavaScript -->
	<script src="{{ asset('static/js/bootstrap.min.js') }}"></script>

	@section('javascript')

	@show
</body>
</html>