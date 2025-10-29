<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Ship;

class HomeController extends Controller
{
    public function index()
    {
        // Load featured ships from database (latest 6)
        $featuredShips = Ship::latest()->take(6)->get();

        // Prepare slideshow images from storage/app/public/ships (up to 5)
        $slideshowImages = [];
        try {
            $files = Storage::disk('public')->files('ships');
            if (!empty($files)) {
                $files = array_values($files);
                $files = array_slice($files, 0, 5);
                foreach ($files as $f) {
                    $slideshowImages[] = asset('storage/' . $f);
                }
            }
        } catch (\Exception $e) {
            // ignore and leave slideshowImages empty
        }

        return view('user.home', compact('featuredShips', 'slideshowImages'));
    }

    public function about()
    {
        return view('user.about');
    }
}