<?php

namespace App\Http\Controllers;

use App\Models\Ship;
use App\Models\Review;  
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $ships = Ship::with('types')->paginate(9); // atau all()
        $reviews = Review::with('user', 'ship')->latest()->take(3)->get(); // 3 testimonial terbaru
        return view('user.home', compact('ships', 'reviews'));
    }

    public function about()
    {
        return view('user.about');
    }
}
