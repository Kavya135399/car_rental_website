<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarsesController extends Controller
{
    // 👉 USER SIDE
    public function index()
    {
        $cars = Car::all();
        return view('carss', compact('cars'));
    }

    // 👉 ADMIN FORM
    public function create()
    {
        return view('admin.add-carss');
    }

    // 👉 STORE DATA
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('cars', 'public');
        } else {
            $image = null;
        }

        Car::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'image' => $image
        ]);

        return redirect()->back()->with('success', 'Car Added Successfully!');
    }
}