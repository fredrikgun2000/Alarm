<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
<style type="text/css">
	
</style>
	<a href="/logout">Logout</a>
	<input type="" name="" id="loadtanggal">
	<input type="" name="" id="loadwaktu">

	<form method="POST" id="simpanalarm">
		@csrf
		<input type="hidden" name="email" id="email" value="{{Session::get('email')}}">
		<div class="row">
			<div class="col-12">Isi</div>
		</div>
		<div class="row">
			<div class="col-12">
				<textarea id="isiinput" name="isiinput"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-12">tanggal/waktu</div>
		</div>

		<div class="row">
		  <input type="date" id="dateinput" name="dateinput">
		  <input type="time" id="timeinput" name="timeinput">
		</div>
		<div class="row">
			pengulangan
		</div>
		<div class="row">
			<select name="pengulanganinput">
				<option>...</option>
				<option>oneday</option>
				<option>everyday</option>
			</select>
		</div>
		<div class="row">
			<div class="col-12">
				<input type="submit" value="buat alarm">
			</div>
		</div>
	</form>
	<div id="tampilalarm"></div>

	<script src="/js/main.js"></script>

</body>
</html>