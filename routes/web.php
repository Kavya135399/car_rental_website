<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CarsesController;
// user
Route::get('/carss', [CarsesController::class, 'index']);
// ADMIN
Route::get('/admin/add-carss', [CarsesController::class, 'create']);
Route::post('/admin/add-carss', [CarsesController::class, 'store']);
// Route::post('/review/save',[ReviewController::class,'saveReview']);
Route::get('/feedback', [ReviewController::class, 'index']);
Route::post('/feedback', [ReviewController::class, 'store']);

Route::get('/admin/messages/delete/{id}', [AdminController::class, 'deleteMessage']);


use App\Http\Controllers\BookingController;

Route::get('/booking', [BookingController::class, 'index']);
Route::post('/booking', [BookingController::class, 'store']);
use App\Http\Controllers\CarController;

Route::get('/cars',[CarController::class,'cars']);

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

// Route::get('/cars', function () {
//     return view('cars');
// });

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

Route::get('/admin/cars/edit/{id}',[AdminController::class,'editCar']);
Route::post('/admin/cars/update/{id}',[AdminController::class,'updateCar']);
/* CAR SINGLE PAGE */

Route::get('/booking', function () {
    return view('booking');
});
Route::post('/booking-submit', function () {
    return "Booking Submitted Successfully!";
});
Route::get('/car-single', function (Request $request) {

    $cars = [

        1 => [
            'name' => 'Swift Dzire',
            'brand' => 'Maruti Suzuki',
            'fuel_type' => 'Petrol',
            'transmission' => 'Manual',
            'seats' => 4,
            'driver' => true,
            
            'images' => ['swift.jpg', 'swift1.jpg', 'swift2.jpg'],

            'description' => 'Compact sedan with excellent mileage and comfort. Perfect for city commuting and short trips, this car offers smooth handling, low maintenance, and fuel efficiency. It comfortably seats 4 passengers and comes with modern features like air conditioning, touchscreen infotainment, and a spacious boot for luggage. Its stylish design and reliable performance make it an ideal choice for daily drives, family outings, or business travel.'
        ],

        2 => [
            'name' => 'Honda City',
            'brand' => 'Honda',
            'fuel_type' => 'Petrol',
            'transmission' => 'Automatic',
            'seats' => 4,
            'driver' => true,
            'images' => ['honda.jpg', 'honda1.jpg', 'honda2.jpg'],
            'description' => 'A stylish and premium sedan designed for comfort and smooth driving. Ideal for executives, small families, or anyone who enjoys a refined driving experience, it features an automatic transmission for effortless handling. The cabin is spacious with high-quality interiors, offering advanced infotainment, automatic climate control, and safety features like airbags and ABS. Its sleek exterior, combined with efficient petrol performance, makes it perfect for city commutes, highway trips, or business travel. The Honda City balances luxury, reliability, and practicality in one elegant package.'
        ],

        3 => [
            'name' => 'Honda Amaze',
            'brand' => 'Honda',
            'fuel_type' => 'Petrol',
            'transmission' => 'Manual',
            'seats' => 4,
            'driver' => true,
            'images' => ['amaze.jpg', 'amaze1.jpg', 'amaze2.jpg'],
            'description' => 'Compact and efficient sedan, perfect for city travel and everyday commuting. It offers smooth manual transmission, excellent fuel economy, and easy maneuverability in tight traffic. The cabin is comfortable for 4 passengers, with well-cushioned seats, sufficient legroom, and practical storage space. Equipped with modern features like air conditioning, infotainment system, and safety essentials, the Amaze is ideal for small families, solo travelers, or couples looking for a reliable, stylish, and budget-friendly sedan for both short trips and longer drives.'
        ],

        4 => [
            'name' => 'Kia Carens',
            'brand' => 'Kia',
            'fuel_type' => 'Diesel',
            'transmission' => 'Manual',
            'seats' => 6,
            'driver' => true,
            'images' => ['kia.jpg', 'kia1.jpg', 'kia2.jpg'],
            'description' => 'A versatile 7-seater MPV designed for family trips and group travel. It offers a spacious and flexible cabin with multiple seating configurations, ensuring comfort for all passengers. The diesel engine delivers strong performance while maintaining fuel efficiency, making it ideal for both city drives and long highway journeys. With advanced safety features, modern infotainment, air conditioning, and ample luggage space, the Kia Carens is perfect for family vacations, airport transfers, or weekend getaways. Its combination of style, practicality, and reliability makes it a top choice for those needing space without compromising comfort.'
        ],

        5 => [
            'name' => 'Innova Crysta',
            'brand' => 'Toyota',
            'fuel_type' => 'Diesel',
            'transmission' => 'Manual',
            'seats' => 6,
            'driver' => true,
            'images' => ['innova.jpg', 'innova1.jpg', 'innova2.jpg'],
            'description' => 'A premium 7-seater MPV that combines luxury, comfort, and reliability. Known for its smooth ride and spacious interiors, it is perfect for family trips, group travel, or long-distance journeys. The diesel engine offers strong performance with excellent fuel efficiency, while the cabin provides plush seating, advanced infotainment, and climate control for a comfortable experience. With robust build quality, modern safety features, and ample luggage space, the Innova Crysta is ideal for those seeking a versatile, high-end vehicle for both city drives and highway adventures.'
        ],

        6 => [
            'name' => 'Innova Hycross',
            'brand' => 'Toyota',
            'fuel_type' => 'Petrol',
            'transmission' => 'Automatic',
            'seats' => 6,
            'driver' => true,
            'images' => ['hycross.avif', 'hycross2.jpg', 'hycross11.jpg'],
            'description' => 'A premium 6-seater hybrid MPV that blends luxury, efficiency, and modern technology. Designed for comfort and smooth automatic driving, it offers a spacious cabin with plush seats, advanced infotainment, and climate control, making every journey enjoyable. The hybrid engine ensures excellent fuel efficiency and lower emissions, perfect for city commutes or long highway trips. With stylish design, ample luggage space, and advanced safety features, the Innova Hycross is ideal for families, executives, or small groups looking for a high-end, eco-friendly vehicle for versatile travel.'
        ],

        7 => [
            'name' => 'Toyota Fortuner',
            'brand' => 'Toyota',
            'fuel_type' => 'Diesel',
            'transmission' => 'Automatic',
            'seats' => 6,
            'driver' => true,
            'images' => ['fortuner.jpg', 'fortuner1.jpg', 'fortuner2.jpg'],
            'description' => 'A premium 6-seater SUV that combines rugged performance with luxury. Built for both city roads and off-road adventures, it features a powerful diesel engine, smooth automatic transmission, and 4x4 capability for challenging terrains. The spacious and well-appointed cabin offers comfortable seating, advanced infotainment, climate control, and modern safety features, ensuring a secure and enjoyable ride for all passengers. Ideal for family trips, corporate travel, or adventure enthusiasts, the Fortuner delivers reliability, style, and versatility in one commanding package.'
        ],

        8 => [
            'name' => 'Toyota Camry',
            'brand' => 'Toyota',
            'fuel_type' => 'Hybrid',
            'transmission' => 'Automatic',
            'seats' => 4,
            'driver' => true,
            'images' => ['camry.jpg', 'camry1.jpg', 'camry2.jpg'],
            'description' => 'A luxury 4-seater hybrid sedan that blends elegance, comfort, and efficiency. Designed for smooth automatic driving, it offers a spacious cabin with premium leather seats, advanced infotainment, and climate control, making every ride comfortable and refined. The hybrid engine delivers excellent fuel efficiency with reduced emissions, ideal for city commuting and long highway journeys. With modern safety features, sleek design, and quiet, smooth handling, the Camry is perfect for executives, small families, or anyone seeking a stylish, reliable, and eco-friendly luxury sedan.'
        ],

        9 => [
            'name' => 'Maruti Invicto',
            'brand' => 'Maruti Suzuki',
            'fuel_type' => 'Hybrid',
            'transmission' => 'Automatic',
            'seats' => 6,
            'driver' => true,
            'images' => ['invicto.avif', 'in1.jpg', 'in2.jpg'],
            'description' => 'A reliable 6-seater hybrid sedan, perfect for both city drives and highway trips. It combines fuel efficiency with modern features, including automatic transmission, comfortable seating, and advanced infotainment. The cabin is spacious enough for small families or groups, with ample legroom and luggage space. Equipped with essential safety features and smooth handling, the Invicto is ideal for daily commutes, airport transfers, or weekend getaways. Its blend of practicality, comfort, and eco-friendly hybrid performance makes it a smart choice for cost-effective and hassle-free travel.'
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

// Route::get('/admin', [AdminController::class,'login']);
// Route::post('/admin/login', [AdminController::class,'loginCheck']);

// Route::get('/admin/dashboard', [AdminController::class,'dashboard']);

// Route::get('/admin/cars', [AdminController::class,'cars']);
// Route::get('/admin/cars/add', [AdminController::class,'addCar']);
// Route::post('/admin/cars/save', [AdminController::class,'saveCar']);
// Route::get('/admin/cars/delete/{id}', [AdminController::class,'deleteCar']);

// Route::get('/admin/bookings', [AdminController::class,'bookings']);

// Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');



// use App\Http\Controllers\PasswordResetController;

// Route::get('/forgot-password',[PasswordResetController::class,'forgotForm']);
// Route::post('/send-otp',[PasswordResetController::class,'sendOtp']);

// Route::get('/verify-otp',[PasswordResetController::class,'verifyForm']);
// Route::post('/verify-otp',[PasswordResetController::class,'verifyOtp']);

// Route::get('/reset-password',[PasswordResetController::class,'resetForm']);
// Route::post('/reset-password',[PasswordResetController::class,'resetPassword']);


Route::get('/admin', [AdminController::class,'login']);
Route::post('/admin/login', [AdminController::class,'loginCheck']);
Route::post('/admin/logout', [AdminController::class,'logout'])->name('admin.logout');
Route::get('/admin/dashboard', [AdminController::class,'dashboard']);
Route::get('/admin/cars', [AdminController::class,'cars']);
Route::get('/admin/cars/add', [AdminController::class,'addCar']);
Route::post('/admin/cars/save', [AdminController::class,'saveCar']);
Route::get('/admin/cars/edit/{id}', [AdminController::class,'editCar']);
Route::post('/admin/cars/update/{id}', [AdminController::class,'updateCar']);
Route::get('/admin/cars/delete/{id}', [AdminController::class,'deleteCar']);
Route::get('/admin/bookings', [AdminController::class,'bookings']);
Route::get('/admin/messages/delete/{id}', [AdminController::class,'deleteMessage']);

// Password Reset
use App\Http\Controllers\PasswordResetController;

Route::get('/forgot-password', [PasswordResetController::class,'forgotForm']);
Route::post('/send-otp', [PasswordResetController::class,'sendOtp']);

Route::get('/verify-otp', [PasswordResetController::class,'verifyForm']);
Route::post('/verify-otp', [PasswordResetController::class,'verifyOtp']);

Route::get('/reset-password', [PasswordResetController::class,'resetForm']);
Route::post('/reset-password', [PasswordResetController::class,'resetPassword']);

// test
Route::get('/forgot', function() {
    return view('test-forgot');
});
// Route::post('/test2', [TestController::class, ]);
Route::post('/test-forgot', function(Request $request) {
    dd('POST received!', $request->all());
});


// use App\Http\Controllers\AdminCarController;
// use App\Http\Controllers\CarsController;

// // Admin
// Route::get('/admin/add-car', [AdminCarController::class, 'create']);
// Route::post('/admin/add-car', [AdminCarController::class, 'store']);

// // User
// Route::get('/cars', [CarsController::class, 'index']);