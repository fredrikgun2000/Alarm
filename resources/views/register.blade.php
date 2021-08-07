<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
<body>
	<form method="post" id="formregister" action="{{url('/register/post')}}">
		@csrf
		<div>email<input type="text" name="email" id="email" required></div>
		<div>password<input type="password" name="password" id="password" required></div>
		<button>Register</button>
	</form>

<script src="/js/main.js"></script>


</body>
</html>