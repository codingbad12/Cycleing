<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ship;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class ShipController extends Controller
{
    public function index(Request $request)
    {
        // Fetch ships from the database
        $query = Ship::query();
        $activeFilters = [];
        
        // Handle search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%");
            });
            $activeFilters['search'] = $search;
        }
        
        // Handle type filter
        if ($request->has('type')) {
            $filteredTypes = $request->input('type');
            $query->whereIn('type', $filteredTypes);
            $activeFilters['types'] = $filteredTypes;
        }
        
        // Handle price range filter
        if ($request->has('min_price') && $request->has('max_price')) {
            $minPrice = (int)$request->input('min_price');
            $maxPrice = (int)$request->input('max_price');
            
            if ($minPrice > 0 || $maxPrice < 2000) {
                $query->whereBetween('price_per_day', [$minPrice, $maxPrice]);
                $activeFilters['price_range'] = ['min' => $minPrice, 'max' => $maxPrice];
            }
        }
        
        // Handle capacity filter
        if ($request->has('min_capacity')) {
            $minCapacity = (int)$request->input('min_capacity');
            if ($minCapacity > 0) {
                $query->where('capacity', '>=', $minCapacity);
                $activeFilters['min_capacity'] = $minCapacity;
            }
        }
        
        $ships = $query->get();
        
        // Get all available ship types for filter options
        $shipTypes = Ship::distinct()->pluck('type')->filter()->values()->all();
        
        // Get all available amenities for filter options
        $allAmenities = Ship::whereNotNull('features')
            ->get()
            ->pluck('features')
            ->flatten()
            ->unique()
            ->values()
            ->all();
        
        return view('user.ships.index', compact('ships', 'shipTypes', 'allAmenities', 'activeFilters'));
    }

    public function show($id)
    {
        // Fetch the ship from the database
        $ship = Ship::findOrFail($id);
        
        // Get similar ships for "You May Also Like" section
        $similarShips = Ship::where('id', '!=', $id)
            ->where('type', $ship->type)
            ->limit(3)
            ->get();
        
        return view('user.ships.show', compact('ship', 'similarShips'));
    }
    
    public function book(Request $request, $id)
    {
        $validated = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'guests' => 'required|integer|min:1',
            'captain' => 'required|string',
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $ship = Ship::findOrFail($id);

        $startDate = new \DateTime($validated['start_date']);
        $endDate = new \DateTime($validated['end_date']);
        $duration = $startDate->diff($endDate)->days + 1;
        if ($duration > 5) {
            return back()->withErrors(['end_date' => 'Maximum booking duration is 5 days'])->withInput();
        }

        $totalPrice = $duration * (int) $ship->price_per_day;

        Booking::create([
            'user_id' => $user->id,
            'ship_id' => $ship->id,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_price' => $totalPrice,
            'status' => 'pending',
            'notes' => null,
        ]);

        return redirect()->route('ships.show', $id)->with('success', 'Booking request submitted successfully!');
    }
    
    /**
     * Get user's bookings by ship type
     */
    private function getUserBookingsByType($shipType)
    {
        return [];
    }
    
    /**
     * Get ship by ID
     */
    private function getDummyShipById($id)
    {
        $ships = $this->getDummyShips();
        foreach ($ships as $ship) {
            if ($ship['id'] == $id) {
                return $ship;
            }
        }
        return null;
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