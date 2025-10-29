<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ship;
use Illuminate\Support\Facades\Log;

class ShipManagementController extends Controller
{
    /**
     * Display a listing of ships
     */
    public function index()
    {
        $ships = Ship::latest()->paginate(10);
        return view('admin.ships.index', compact('ships'));
    }

    /**
     * Show the form for creating a new ship
     */
    public function create()
    {
        return view('admin.ships.create');
    }

    /**
     * Store a newly created ship
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:Yacht,Speedboat,Catamaran,Pontoon,Fishing Boat,Sailboat',
            'capacity' => 'required|integer|min:1',
            'price_per_day' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'nullable|string',
            'specifications' => 'nullable|array',
            'specifications.capacity' => 'nullable|string',
            'specifications.length' => 'nullable|string',
            'specifications.max_speed' => 'nullable|string',
            'specifications.year_built' => 'nullable|string',
            'images' => 'nullable|array|max:3',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);
        $features = isset($validated['features']) ? array_filter(array_map('trim', explode(',', $validated['features']))) : null;

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('ships', 'public');
        }

        Ship::create([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'capacity' => $validated['capacity'],
            'price_per_day' => $validated['price_per_day'],
            'location' => $validated['location'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'features' => $features,
            'specifications' => $validated['specifications'] ?? null,
            'status' => 'available',
        ]);
        
        Log::info('Admin created new ship', ['ship_name' => $validated['name']]);
        
        return redirect()->route('admin.ships.index')
            ->with('success', 'Ship created successfully');
    }

    /**
     * Display the specified ship
     */
    public function show($id)
    {
        $ship = Ship::findOrFail($id);
        return view('admin.ships.show', compact('ship'));
    }

    /**
     * Show the form for editing the specified ship
     */
    public function edit($id)
    {
        $ship = Ship::findOrFail($id);
        return view('admin.ships.edit', compact('ship'));
    }

    /**
     * Update the specified ship
     */
    public function update(Request $request, $id)
    {
        $ship = Ship::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:Yacht,Speedboat,Catamaran,Pontoon,Fishing Boat,Sailboat',
            'capacity' => 'required|integer|min:1',
            'price_per_day' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'nullable|string',
            'specifications' => 'nullable|array',
            'specifications.capacity' => 'nullable|string',
            'specifications.length' => 'nullable|string',
            'specifications.max_speed' => 'nullable|string',
            'specifications.year_built' => 'nullable|string',
            'images' => 'nullable|array|max:3',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:3072',
            'status' => 'required|in:available,rented,maintenance',
        ]);

        $features = isset($validated['features']) ? array_filter(array_map('trim', explode(',', $validated['features']))) : null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('ships', 'public');
        }

        $ship->update([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'capacity' => $validated['capacity'],
            'price_per_day' => $validated['price_per_day'],
            'location' => $validated['location'],
            'description' => $validated['description'],
            'image' => $request->hasFile('image') ? $imagePath : $ship->image,
            'features' => $features,
            'specifications' => $validated['specifications'] ?? $ship->specifications,
            'status' => $validated['status'],
        ]);
        
        Log::info('Admin updated ship', ['ship_id' => $id, 'ship_name' => $validated['name']]);
        
        return redirect()->route('admin.ships.index')
            ->with('success', 'Ship updated successfully');
    }

    /**
     * Remove the specified ship
     */
    public function destroy($id)
    {
        $ship = Ship::findOrFail($id);
        $shipName = $ship->name;
        
        // In a real app, you would check if the ship is currently rented
        // before allowing deletion or implement soft deletes
        
        $ship->delete();
        
        Log::info('Admin deleted ship', ['ship_id' => $id, 'ship_name' => $shipName]);
        
        return redirect()->route('admin.ships.index')
            ->with('success', 'Ship removed successfully');
    }
}