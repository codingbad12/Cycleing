<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::withCount('ships')->paginate(10);
        return view('admin.type.index', compact('types'));
    }

    public function create()
    {
        return view('admin.type.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:types,nama',
        ]);

        Type::create(['nama' => $request->nama]);

        return redirect()->route('types.index')->with('success', 'Tipe kapal berhasil ditambahkan.');
    }

    public function edit(Type $type)
    {
        return view('admin.type.edit', compact('type'));
    }

    public function update(Request $request, Type $type)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:types,nama,' . $type->id,
        ]);

        $type->update(['nama' => $request->nama]);

        return redirect()->route('types.index')->with('success', 'Tipe kapal berhasil diperbarui.');
    }

    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('types.index')->with('success', 'Tipe kapal berhasil dihapus.');
    }
}
