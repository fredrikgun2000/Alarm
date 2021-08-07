$(document).ready(function(){
	loadalarm();
	// setInterval(loadalarm,1000);
	setInterval(loadtime,500);
	setInterval(alarm,1000);
})

function alarm() {
	var count=$('#countalarm').val();
	var loadtime=$('#loadwaktu').val();
	var loaddate=$('#loadtanggal').val();
	
	var time = $('.time').map(function() {
	  return this.value;
	}).get().join();
		for (var i = 1; i <= time.length; i++) {
			var hours = time.split(":")[0];
		var minutes = time.split(":")[1];
			console.log(time.length);
		if(hours<12) {
			if (hours=='00') {
				hours=12;
			}
			var stringwaktu=hours+':'+minutes+' am';
		}
		if(hours>12){
			hours=hours-12;
			if (hours<10) {
				hours='0'+hours;
			}
			var stringwaktu=hours+':'+minutes+' pm';
		}
		if (stringwaktu==loadtime && date==loaddate) {
			var email=$('#email').val();
			$.ajax({
				url:'alarm/'+email,
				method:'GET',
			})
		}
		}

	// 	var time=$('#time'+[i]).val();
	// 	var date=$('#date'+[i]).val();
	// 	var hours = time.split(":")[0];
	// 	var minutes = time.split(":")[1];
	
		
}


function loadtime() {
	$.ajax({
		url:'loadtime',
		method:'GET',
		success:function(data){
			$('#loadtanggal').val(data.tanggal);
			$('#loadwaktu').val(data.waktu);
		}
	})
}

function loadalarm() {
	var email=$('#email').val();
	$.ajax({
		url:'/loadalarm/'+email,
		method:'GET',
		success:function(data){
			$('#tampilalarm').html(data);
			count();
		}
	})
}

function count() {
	var email=$('#email').val();
	$.ajax({
		url:'/countalarm/'+email,
		method:'GET',
		success:function(data){
			$('#countalarm').val(data);
		}
	})
}

$(document).on('click','.hapus',function(){
	var id=$(this).attr('id');
	$.ajax({
		url:'hapusalarm/'+id,
		method:'GET',
	})
})

$('#simpanalarm').on('submit',function(e){
	e.preventDefault();
	$.ajax({
		url:'/simpanalarm/post',
		method:'post',
		data:new FormData(this),
		dataType:'JSON',
		contentType: false,
		cache: false,
		processData: false,
		success:function(data){
			loadalarm();
		}
	})
});
