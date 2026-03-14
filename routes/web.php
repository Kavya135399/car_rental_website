<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
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

Route::get('/contact', function () {
    return view('contact');
});

/* CONTACT FORM SAVE ROUTE */
Route::post('/contact-send', [ContactController::class, 'send'])->name('contact.send');


/* CAR SINGLE PAGE */

Route::get('/car-single', function (Request $request) {

    $cars = [

        1 => [
            'name' => 'Swift Dzire',
            'brand' => 'Maruti Suzuki',
            'fuel_type' => 'Petrol',
            'transmission' => 'Manual',
            'seats' => 4,
            'driver' => true,
            'image' => 'car-1.jpg',
            'description' => 'Compact sedan with excellent mileage and comfort.'
        ],

        2 => [
            'name' => 'Honda City',
            'brand' => 'Honda',
            'fuel_type' => 'Petrol',
            'transmission' => 'Automatic',
            'seats' => 4,
            'driver' => true,
            'image' => 'car-2.jpg',
            'description' => 'A stylish and premium sedan designed for comfort and smooth driving.'
        ],

        3 => [
            'name' => 'Honda Amaze',
            'brand' => 'Honda',
            'fuel_type' => 'Petrol',
            'transmission' => 'Manual',
            'seats' => 4,
            'driver' => true,
            'image' => 'car-3.jpg',
            'description' => 'Compact and efficient sedan perfect for city travel.'
        ],

        4 => [
            'name' => 'Kia Carens',
            'brand' => 'Kia',
            'fuel_type' => 'Diesel',
            'transmission' => 'Manual',
            'seats' => 7,
            'driver' => true,
            'image' => 'car-4.jpg',
            'description' => 'A versatile 7-seater MPV designed for family trips.'
        ],

        5 => [
            'name' => 'Innova Crysta',
            'brand' => 'Toyota',
            'fuel_type' => 'Diesel',
            'transmission' => 'Manual',
            'seats' => 7,
            'driver' => true,
            'image' => 'car-5.jpg',
            'description' => 'Premium 7-seater MPV with luxury and comfort.'
        ],

        6 => [
            'name' => 'Innova Hycross',
            'brand' => 'Toyota',
            'fuel_type' => 'Petrol',
            'transmission' => 'Automatic',
            'seats' => 6,
            'driver' => true,
            'image' => 'car-6.avif',
            'description' => 'Premium hybrid MPV with modern technology.'
        ],

        7 => [
            'name' => 'Toyota Fortuner',
            'brand' => 'Toyota',
            'fuel_type' => 'Diesel',
            'transmission' => 'Automatic',
            'seats' => 6,
            'driver' => true,
            'image' => 'car-7.jpg',
            'description' => 'Luxury SUV built for performance and adventure.'
        ],

        8 => [
            'name' => 'Toyota Camry',
            'brand' => 'Toyota',
            'fuel_type' => 'Hybrid',
            'transmission' => 'Automatic',
            'seats' => 4,
            'driver' => true,
            'image' => 'car-8.jpg',
            'description' => 'Luxury hybrid sedan with premium comfort.'
        ],

        9 => [
            'name' => 'Maruti Invicto',
            'brand' => 'Maruti Suzuki',
            'fuel_type' => 'Hybrid',
            'transmission' => 'Automatic',
            'seats' => 6,
            'driver' => true,
            'image' => 'car-9.avif',
            'description' => 'Reliable hybrid MPV perfect for city and highway travel.'
        ],

    ];

    $car_id = $request->query('id', 1);

    if (!isset($cars[$car_id])) {
        abort(404);
    }

    $car = $cars[$car_id];

    return view('car-single', compact('car'));

});


/* ================= ADMIN ROUTES ================= */

Route::get('/admin', [AdminController::class,'login']);
Route::post('/admin/login', [AdminController::class,'loginCheck']);

Route::get('/admin/dashboard', [AdminController::class,'dashboard']);

Route::get('/admin/cars', [AdminController::class,'cars']);
Route::get('/admin/cars/add', [AdminController::class,'addCar']);
Route::post('/admin/cars/save', [AdminController::class,'saveCar']);
Route::get('/admin/cars/delete/{id}', [AdminController::class,'deleteCar']);

Route::get('/admin/bookings', [AdminController::class,'bookings']);

Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');