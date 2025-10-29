@extends('admin.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow">
    <h2 class="text-2xl font-semibold mb-6">Edit Data Kapal</h2>

    <form action="{{ route('ships.update', $ship->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Nama Kapal --}}
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Nama Kapal</label>
            <input type="text" id="name" name="name" value="{{ old('name', $ship->name) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
        </div>

        {{-- Harga per Hari --}}
        <div class="mb-4">
            <label for="price_per_day" class="block text-gray-700 font-medium mb-2">Harga per Hari (Rp)</label>
            <input type="number" id="price_per_day" name="price_per_day" value="{{ old('price_per_day', $ship->price_per_day) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
        </div>

        {{-- Kapasitas --}}
        <div class="mb-4">
            <label for="capacity" class="block text-gray-700 font-medium mb-2">Kapasitas (orang)</label>
            <input type="number" id="capacity" name="capacity" value="{{ old('capacity', $ship->capacity) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
        </div>

        {{-- Tipe Kapal --}}
        <div class="mb-4">
            <label for="types" class="block text-gray-700 font-medium mb-2">Tipe Kapal</label>
            <select name="types[]" id="types" multiple
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}"
                        {{ in_array($type->id, $ship->types->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $type->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Gambar --}}
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-medium mb-2">Gambar Kapal</label>
            @if ($ship->image)
                <img src="{{ asset('storage/' . $ship->image) }}" alt="Gambar Kapal" class="w-32 h-32 object-cover rounded-lg mb-2 border">
            @endif
            <input type="file" id="image" name="image" accept="image/*"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2">
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
            <textarea id="description" name="description" rows="4"
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">{{ old('description', $ship->description) }}</textarea>
        </div>

        {{-- Detail Teknis --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="length" class="block text-gray-700 font-medium mb-2">Panjang (m)</label>
                <input type="number" step="0.1" id="length" name="length" value="{{ old('length', $ship->length) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2">
            </div>
            <div>
                <label for="year_built" class="block text-gray-700 font-medium mb-2">Tahun Pembuatan</label>
                <input type="number" id="year_built" name="year_built" value="{{ old('year_built', $ship->year_built) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2">
            </div>
            <div>
                <label for="max_speed" class="block text-gray-700 font-medium mb-2">Kecepatan Maks (knot)</label>
                <input type="number" id="max_speed" name="max_speed" value="{{ old('max_speed', $ship->max_speed) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2">
            </div>
            <div>
                <label for="stock" class="block text-gray-700 font-medium mb-2">Stok</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock', $ship->stock) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2">
            </div>
        </div>

        {{-- Fasilitas --}}
        <div class="mb-4">
            <label for="amenities" class="block text-gray-700 font-medium mb-2">Fasilitas</label>
            <textarea id="amenities" name="amenities" rows="3"
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">{{ old('amenities', $ship->amenities) }}</textarea>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end space-x-2 mt-6">
            <a href="{{ route('ships.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                Batal
            </a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
