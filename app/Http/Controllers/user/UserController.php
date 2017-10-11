<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rooms;
use App\UserTransaction;
use Auth;
use DB;
use App\UserPayment;
use App\User;
use App\Amenity;
use App\TransactionAmenity;
class UserController extends Controller
{
	public function __construct(){
		$this->middleware('customerCheck');
	}

     public function tambook(){
      $room_id =  $_GET['id'];

      $find = Rooms::where('id',$room_id)->first();
      $ams = Amenity::all();


      return view('user.book', compact('find', 'ams'));
    }

    public function book_now(Request $request,$id){
    	$this->validate($request, [
            'totalprice' => 'required',
            'check_in_time' => 'required',
            'check_in_date' => 'required',
            'check_out_date' => 'required',
            'total_amenity' => 'required',
            'occupants' => 'required'
         ]);  

         $total_amenity = explode(' ', $request['total_amenity']);
         $total_quantity = explode(' ', $request['total_quantity']);


    	$differenceFormat = '%a';
		$datetime1 = date_create($request['check_in_date']);
    	$datetime2 = date_create($request['check_out_date']);
    	$interval = date_diff($datetime1, $datetime2);
    	$days = intval($interval->format($differenceFormat));



    	$find = Rooms::where('id',$id)->first();

        $users = DB::select('SELECT * FROM `user_transactions` WHERE ((UNIX_TIMESTAMP("' . $request['check_in_date'] . '") BETWEEN UNIX_TIMESTAMP(check_in) AND UNIX_TIMESTAMP(check_out)) OR (UNIX_TIMESTAMP("' . $request['check_out_date'] . '") BETWEEN UNIX_TIMESTAMP(check_in) AND UNIX_TIMESTAMP(check_out))) AND (status_id = 1 OR status_id = 2 OR status_id = 5) AND room_id = ' . $find->room_number);

        if (count($users))
            return redirect()->back()->with('no', 'error');


    	$price = $find->category->price;
        $book = new UserTransaction;
        $book->user_id = Auth::id();
        $book->room_id = $find->room_number;
        $book->status_id = 1;
        $book->check_in = $request['check_in_date'];
        $book->check_in_time =  $request['check_in_time'];
        $book->check_out = $request['check_out_date'];
        $book->occupants = $request['occupants'];
        $book->bill = $request['totalprice'];
        $book->save();

        for ($i = 0; $i < sizeof($total_amenity); $i++) {


            $am = new TransactionAmenity;
            $am->user_transaction_id = $book->id;
            $am->amenity_id = $total_amenity[$i];
            $am->quantity = $total_quantity[$i];
            $am->save();

        }

       return redirect()->back()->with('ok', 'You have already booked. Thank you for choosing us.');

    }

    public function customer_logout(){
        Auth::logout();
        return redirect('/');
    }

    public function customer_activity(){
        $activity = UserTransaction::where('user_id', Auth::id())->orderBy('id','desc')->get();
        return view('user.activity', compact('activity'));
    }

    public function customer_profile(){
        return view('user.profile');
    }

    public function customer_setting(){
        return view('user.setting');
    }

    public function customer_activity_view($id){
        $find = UserTransaction::findOrFail($id);
        $amenities = TransactionAmenity::where('user_transaction_id', $id)->get();

        $differenceFormat = '%a';
        $datetime1 = date_create($find->check_in);
        $datetime2 = date_create($find->check_out);
        $interval = date_diff($datetime1, $datetime2);
        $days = intval($interval->format($differenceFormat));

        return view('user.activity_view', compact('find','days','amenities'));
    }

    public function customer_payment(Request $request, $id){
        $this->validate($request, [
            'proof'=> 'required'
        ]);      
          $size= getimagesize($request->proof);
        
         if($size[0] > 850 && $size[1] > 450){
            return redirect()->back()->with('ok','Image Size is to big , kindly select another one!');
         }

        $imageName = time().'.'.$request->proof->getClientOriginalExtension();       

        $find = UserTransaction::findOrFail($id);

        $pay = new UserPayment;

        $path = $request['proof'];
        $data = file_get_contents($path);
        $base64 = base64_encode($data);

        $pay->image = $base64;
        $find->proof()->save($pay);

       return redirect()->back()->with('ok','Image uploaded successfully!');


    }

    public function customer_password_change(Request $request){
        $this->validate($request, [
            'new_password'=> 'required|max:12',
            'retype_password'=> 'required|same:new_password'
        ]);
        $change = User::where('id', Auth::id())->update(['password'=> bcrypt($request['retype_password'])]);

        if($change){
            return redirect()->back()->with('ok', 'Password has been change successfully!.');
        }
    }

    public function customer_update_info(Request $request){
        $this->validate($request, [
            'fname' => 'required|max:20',
            'lname' => 'required|max:20',
            'contact' => 'required|max:15',
            'email' => 'required|max:30|email'
        ]);

        $update = User::where('id', Auth::id())->update(['fname'=> $request['fname'],'lname'=> $request['lname'],'contact'=> $request['contact'],'email'=> $request['email']]);

        if($update){
            return redirect()->back()->with('ok', 'Personal Information has been change successfully!.');
        }
    }
}
