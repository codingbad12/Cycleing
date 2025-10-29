<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShipController extends Controller
{
    public function index(Request $request)
    {
        // In a real application, we would fetch ships from the database
        // For now, we'll use dummy data
        $ships = $this->getDummyShips();
        
        // Handle search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $ships = collect($ships)->filter(function($ship) use ($search) {
                return stripos($ship['name'], $search) !== false || 
                       stripos($ship['type'], $search) !== false;
            })->all();
        }
        
        return view('user.ships.index', compact('ships'));
    }

    public function show($id)
    {
        // In a real application, we would fetch the ship from the database
        // For now, we'll use dummy data
        $ships = $this->getDummyShips();
        $ship = collect($ships)->firstWhere('id', $id);
        
        if (!$ship) {
            abort(404);
        }
        
        return view('user.ships.show', compact('ship'));
    }

    private function getDummyShips()
    {
        return [
            [
                'id' => 1,
                'name' => 'Luxury Yacht',
                'type' => 'Yacht',
                'price_per_day' => 1200,
                'capacity' => 12,
                'image' => 'https://via.placeholder.com/600x400?text=Luxury+Yacht',
                'description' => 'Experience luxury on the water with this stunning yacht. Perfect for special occasions and unforgettable adventures.',
                'amenities' => ['WiFi', 'Kitchen', 'Air Conditioning', 'BBQ', 'Sound System']
            ],
            [
                'id' => 2,
                'name' => 'Speed Demon',
                'type' => 'Speedboat',
                'price_per_day' => 500,
                'capacity' => 6,
                'image' => 'https://via.placeholder.com/600x400?text=Speed+Boat',
                'description' => 'Feel the adrenaline with this high-speed boat. Ideal for thrill-seekers and water sports enthusiasts.',
                'amenities' => ['Sound System', 'Cooler', 'Navigation System']
            ],
            [
                'id' => 3,
                'name' => 'Sailing Beauty',
                'type' => 'Sailboat',
                'price_per_day' => 350,
                'capacity' => 8,
                'image' => 'https://via.placeholder.com/600x400?text=Sailboat',
                'description' => 'Experience the traditional way of sailing with this beautiful sailboat. Perfect for a peaceful day on the water.',
                'amenities' => ['Kitchen', 'Sleeping Quarters', 'Navigation System']
            ],
            [
                'id' => 4,
                'name' => 'Family Cruiser',
                'type' => 'Pontoon',
                'price_per_day' => 300,
                'capacity' => 10,
                'image' => 'https://via.placeholder.com/600x400?text=Pontoon',
                'description' => 'Ideal for family outings and relaxed cruising. Spacious and comfortable for all-day enjoyment.',
                'amenities' => ['BBQ', 'Cooler', 'Seating Area', 'Canopy']
            ],
            [
                'id' => 5,
                'name' => 'Fishing Pro',
                'type' => 'Fishing Boat',
                'price_per_day' => 250,
                'capacity' => 4,
                'image' => 'https://via.placeholder.com/600x400?text=Fishing+Boat',
                'description' => 'Equipped with everything you need for a successful fishing trip. Perfect for both beginners and experienced anglers.',
                'amenities' => ['Fishing Gear', 'Cooler', 'Navigation System', 'Fish Finder']
            ],
            [
                'id' => 6,
                'name' => 'Island Explorer',
                'type' => 'Catamaran',
                'price_per_day' => 800,
                'capacity' => 15,
                'image' => 'https://via.placeholder.com/600x400?text=Catamaran',
                'description' => 'Stable and spacious catamaran perfect for exploring multiple islands in comfort and style.',
                'amenities' => ['Kitchen', 'Sleeping Quarters', 'WiFi', 'Air Conditioning', 'Sound System']
            ],
        ];
    }
}