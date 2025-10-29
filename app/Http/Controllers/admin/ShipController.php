<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ship;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class ShipController extends Controller
{
    public function index()
    {
        $ships = Ship::with('types')->latest()->paginate(10);
        return view('admin.ships.index', compact('ships'));
    }

    public function create()
    {
        $types = Type::all();
        return view('admin.ships.create', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price_per_day' => 'required|numeric',
            'capacity' => 'required|integer',
            'length' => 'nullable|numeric',
            'year_built' => 'nullable|integer',
            'max_speed' => 'nullable|numeric',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'amenities' => 'nullable|string',
            'types' => 'array|required',
        ]);

        $data = $request->except('types');

        // Upload image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('ships', 'public');
        }

        $ship = Ship::create($data);
        $ship->types()->attach($request->types);

        return redirect()->route('ships.index')->with('success', 'Ship berhasil ditambahkan!');
    }

    public function edit(Ship $ship)
    {
        $types = Type::all();
        $selectedTypes = $ship->types->pluck('id')->toArray();

        return view('admin.ships.edit', compact('ship', 'types', 'selectedTypes'));
    }

    public function update(Request $request, Ship $ship)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price_per_day' => 'required|numeric',
            'capacity' => 'required|integer',
            'length' => 'nullable|numeric',
            'year_built' => 'nullable|integer',
            'max_speed' => 'nullable|numeric',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'amenities' => 'nullable|string',
            'types' => 'array|required',
        ]);

        $data = $request->except('types');

        if ($request->hasFile('image')) {
            // Hapus file lama
            if ($ship->image) {
                Storage::disk('public')->delete($ship->image);
            }
            $data['image'] = $request->file('image')->store('ships', 'public');
        }

        $ship->update($data);
        $ship->types()->sync($request->types);

        return redirect()->route('ships.index')->with('success', 'Ship berhasil diperbarui!');
    }

    public function destroy(Ship $ship)
    {
        if ($ship->image) {
            Storage::disk('public')->delete($ship->image);
        }
        $ship->types()->detach();
        $ship->delete();

        return redirect()->route('ships.index')->with('success', 'Ship berhasil dihapus!');
    }
}
