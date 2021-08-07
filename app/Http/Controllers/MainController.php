<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use App\User;
use App\Alarm;

class MainController extends Controller
{
    public function index()
    {
    	return view('index');
    }

    public function loadtime()
    { 
		$tanggal = Carbon::now()->format('yy-m-d');
		$waktu = Carbon::now()->format('h:i a');
		return Response()->JSON(['tanggal'=>$tanggal,'waktu'=>$waktu]); 
    }

    public function loadalarm($email)
    {
    	$data=alarm::where('email',$email)->get();
    	return view('alarm',['data'=>$data]);
    }

    public function simpanalarmpost(Request $request)
    {
    	$email=$request['email'];
    	$isi=$request['isiinput'];
    	$tanggal=$request['dateinput'];
    	$time=$request['timeinput'];
    	$pengulangan=$request['pengulanganinput'];
    	$cekalarm=alarm::where('email','=',$email)->where('tanggal','=',$tanggal)->where('waktu','=',$time)->first();
    	if ($cekalarm) {
    		return Response()->JSON(['alarm'=>'tanggal dan waktu sudah ada']);
    	}else{
    		$ceknomor=alarm::where('email','=',$email)->latest('nomor')->first();
    		if ($ceknomor) {
    			$nomor=$ceknomor->nomor;
    			$simpannomor=$nomor+1;

    		$data=array(
	    			'nomor'=>$simpannomor,
	    			'email'=>$email,
	    			'isi'=>$isi,
	    			'tanggal'=>$tanggal,
	    			'waktu'=>$time,
	    			'status'=>'belum',
	    			'pengulangan'=>$pengulangan,
	    		);
    		alarm::create($data);
    		
    		}else{
	    		$data=array(
	    			'nomor'=>1,
	    			'email'=>$email,
	    			'isi'=>$isi,
	    			'tanggal'=>$tanggal,
	    			'waktu'=>$time,
    				'status'=>'belum',
    				'pengulangan'=>$pengulangan,

    			);
    			alarm::create($data);
    		}
    	}
    }

    public function countalarm($email)
    {
    	$count=alarm::where('email',$email)->count();
    	return Response()->JSON($count);
    }

    public function register()
    {
    	return view('register');
    }

    public function login()
    {
    	return view('login');
    }

    public function sendverify($email)
	{
			try{
	        Mail::send('verify', ['email' => $email], function ($message) use ($email)
	        {
	            $message->subject('verification Your Email');
	            $message->from('gunawan@example.com', 'gunawan');
	            $message->to($email);
	        });
	        return view('rsendverify',['email'=>$email]);
	    }
	    	catch (Exception $e){
	        return response (['status' => false,'errors' => $e->getMessage()]);
	    }
	}

	public function sendemail($email,$data,$etype)
	{
		try{
	        Mail::send($etype, ['data' => $data], function ($message) use ($email)
	        {
	            $message->subject('You Have ALARM');
	            $message->from('gunawan@example.com', 'Gunawan ALARM');
	            $message->to($email);
	        });
	        return $data;
	    }
	    	catch (Exception $e){
	        return response (['status' => false,'errors' => $e->getMessage()]);
	    }
	}

	public function sendalarmemail($email)
	{
			$jam = Carbon::now()->format('h');
			$menit = Carbon::now()->format('i');
			$type = Carbon::now()->format('a');
			$tanggal = Carbon::now()->format('yy-m-d');
			$etype = 'emailalarm';

			if ($type=='pm') {
					$editwaktu=$jam+12;
					$waktu=$editwaktu.':'.$menit;
					$cek=alarm::where('email','=',$email)->where('waktu','=',$waktu)->first();
					$status=$cek->status;
					$pengulangan=$cek->pengulangan;
				if ($status=='belum') {
					if ($pengulangan=='oneday') {
						$data=alarm::where('email','=',$email)->where('tanggal',$tanggal)->where('waktu','=',$waktu)->get();
						alarm::where('email','=',$email)->where('waktu','=',$waktu)->update(['status'=>'sudah']);
						return $this->sendemail($email,$data,$etype);
				}else if ($pengulangan=='everyday') {
					$data=alarm::where('email','=',$email)->where('tanggal',$tanggal)->where('waktu','=',$waktu)->get();
					$cekdata=alarm::where('email','=',$email)->where('tanggal',$tanggal)->where('waktu','=',$waktu)->first();
					$datetanggal=explode('-', $cekdata->tanggal);
					$gantitanggal=$datetanggal[2]+1;
					$updatetanggal=$datetanggal[0].'-'.$datetanggal[1].'-'.$gantitanggal;
					alarm::where('email','=',$email)->where('waktu','=',$waktu)->update(['tanggal'=>$updatetanggal]);
					return $this->sendemail($email,$data,$etype);
				}
			}else{
				return 'sudah bunyi';
			}			
		}else if ($type=='am') {
			$waktu=$jam.':'.$menit;
			$cek=alarm::where('email','=',$email)->where('waktu','=',$waktu)->first();
					$status=$cek->status;
					$pengulangan=$cek->pengulangan;
				if ($status=='belum') {
					if ($pengulangan=='oneday') {
						$data=alarm::where('email','=',$email)->where('tanggal',$tanggal)->where('waktu','=',$waktu)->get();
						alarm::where('email','=',$email)->where('waktu','=',$waktu)->update(['status'=>'sudah']);
						return $this->sendemail($email,$data,$etype);
				}else if ($pengulangan=='everyday') {
					$data=alarm::where('email','=',$email)->where('tanggal',$tanggal)->where('waktu','=',$waktu)->get();
					$cekdata=alarm::where('email','=',$email)->where('tanggal',$tanggal)->where('waktu','=',$waktu)->first();
					$datetanggal=explode('-', $cekdata->tanggal);
					$gantitanggal=$datetanggal[2]+1;
					$updatetanggal=$datetanggal[0].'-'.$datetanggal[1].'-'.$gantitanggal;
					alarm::where('email','=',$email)->where('waktu','=',$waktu)->update(['tanggal'=>$updatetanggal]);
					return $this->sendemail($email,$data,$etype);
				}
		}else{
			return 'sudah bunyi';
		}
	}
}
	public function hapusalarm($id,$email)
	{
		alarm::where('id',$id)->delete();
		return Response()->JSON('deleted');
	}

     public function verify($email)
    {
    	$data=array(
    		'email'=>$email
    	);
    	$date=Carbon::now();
    	$date->toDateTimeString();
    	user::where('email',$email)->update(['email_verified_at'=>$date]);
    	return view('login');
    }

    public function registerpost(Request $request)
    {
    	$email=$request['email'];
    	$password=Hash::make($request['password']);
    	$data=array(
    		'email'=>$email,
    		'password'=>$password
    	);
    	User::create($data);
    	return $this->sendverify($email);

    }

    public function loginpost(Request $request)
    {
    	$email=$request['email'];
    	$password=$request['password'];
    	$passwords=Hash::make($password);
    	$check=user::where('email',$email)->first();
    	$cekverify=$check->email_verified_at;
    	$cekpassw=$check->password;

    	if ($passwords&&$cekpassw) {
    		if ($cekverify!='') {
	                Session::put('email',$check->email);
	                Session::put('login','true');
	                return redirect('/');
    		}else{
    			return view('register.rsendverify',['email'=>$email]);
    		}
    	}
    }

    public function logout()
    {
    	Session::flush();
        return redirect('/login');
    }
}
