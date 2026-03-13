<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; 

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/services', function () {
    return view('services');
});

Route::get('/pricing', function () {
    return view('pricing');
});

Route::get('/cars', function () {
    return view('cars');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/blog-single', function () {
    return view('blog-single');
});

Route::get('/car-single', function (Request $request) {
    // Frontend-only cars array
    $cars = [
        1 => [
            'name' => 'Range Rover',
            'brand' => 'Cheverolet',
            'fuel_type' => 'Petrol',
            'transmission' => 'Automatic',
            'seats' => 5,
            'price' => 500,
            'driver' => true,
            'image' => 'car-1.jpg',
            'description' => 'Luxury SUV perfect for city travel and long-distance trips.'
        ],
        2 => [
            'name' => 'Honda',
            'brand' => 'Subaru',
            'fuel_type' => 'Diesel',
            'transmission' => 'Automatic',
            'seats' => 5,
            'price' => 450,
            'driver' => true,
            'image' => 'car-2.jpg',
            'description' => 'Comfortable sedan with premium features.'
        ],
        3 => [
            'name' => 'Crysta',
            'brand' => 'Toyota',
            'fuel_type' => 'Diesel',
            'transmission' => 'Automatic',
            'seats' => 7,
            'price' => 600,
            'driver' => true,
            'image' => 'car-3.jpg',
            'description' => 'Spacious MPV suitable for family trips.'
        ],
        // add more cars here
    ];

    $car_id = $request->query('id', 1); // default to 1 if no id is given
    if (!isset($cars[$car_id])) {
        abort(404); // show 404 if id does not exist
    }

    $car = $cars[$car_id];

    return view('car-single', compact('car'));
});

Route::get('/contact', function () {
    return view('contact');
});

use App\Http\Controllers\AdminController;

Route::get('/admin', [AdminController::class,'login']);
Route::post('/admin/login', [AdminController::class,'loginCheck']);

Route::get('/admin/dashboard', [AdminController::class,'dashboard']);

Route::get('/admin/cars', [AdminController::class,'cars']);
Route::get('/admin/cars/add', [AdminController::class,'addCar']);
Route::post('/admin/cars/save', [AdminController::class,'saveCar']);
Route::get('/admin/cars/delete/{id}', [AdminController::class,'deleteCar']);

Route::get('/admin/bookings', [AdminController::class,'bookings']);


Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');