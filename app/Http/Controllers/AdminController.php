<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use App\Models\Contact;
use App\Models\Review;

class AdminController extends Controller
{

public function dashboard()
{
    if(!session()->has('admin_login')){
        return redirect('/admin'); // redirect to login
    }

    $reviews = Review::latest()->take(5)->get();

    return view('admin.dashboard',compact('reviews'));
}

public function login(){
    return view('admin.login');
}

public function deleteMessage($id)
{
    $msg = Contact::find($id);

    if($msg){
        $msg->delete();
    }

    return redirect()->back()->with('success','Message Deleted Successfully');
}

public function logout()
{
    session()->forget('admin_login');
    return redirect('/admin');
}

public function loginCheck(Request $request)
{
    if($request->email == "admin@gmail.com" && $request->password == "1234"){

        session(['admin_login' => true]); // create admin session

        return redirect('/admin/dashboard');
    }

    return back()->with('error','Invalid Login');
}

public function cars(){

    if(!session()->has('admin_login')){
        return redirect('/admin');
    }

    $cars = DB::table('cars')->get();
    return view('admin.cars',compact('cars'));
}

public function addCar(){
    return view('admin.add_car');
}

public function saveCar(Request $request){

    DB::table('cars')->insert([
        'name'=>$request->name,
        'price'=>$request->price,
        'image'=>$request->image
    ]);

    return redirect('/admin/cars');
}

public function deleteCar($id){
    DB::table('cars')->where('id',$id)->delete();
    return back();
}

public function bookings()
{
    if(!session()->has('admin_login')){
        return redirect('/admin');
    }
    $messages = DB::table('contacts')->get();
    return view('admin.bookings', compact('messages'));
}

}