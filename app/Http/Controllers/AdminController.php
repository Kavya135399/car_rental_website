<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;

class AdminController extends Controller
{

    public function login(){
        return view('admin.login');
    }

    public function logout(Request $request)
{
    Session::flush(); // destroy session
    return redirect('/admin');
}

    public function loginCheck(Request $request){

        if($request->email == "admin@gmail.com" && $request->password == "1234"){
            return redirect('/admin/dashboard');
        }

        return back()->with('error','Invalid Login');
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

    public function cars(){
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
    $messages = DB::table('contacts')->get();

    return view('admin.bookings', compact('messages'));
}

}