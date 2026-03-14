<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car; // Make sure this model exists

class CarController extends Controller
{
    public function cars()
    {
        $cars = Car::all(); // fetch all cars from database
        return view('cars', compact('cars'));
    }
}