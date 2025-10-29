@extends('admin.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow">
    <h2 class="text-2xl font-semibold mb-6">Tambah Kapal Baru</h2>

    <form action="{{ route('ships.store') }}" method="POST" enctype="multipart/form-data">
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded-lg">
                <strong>Terjadi kesalahan:</strong>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @csrf

        {{-- Nama Kapal --}}
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Nama Kapal</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                   placeholder="Masukkan nama kapal">
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Harga per Hari --}}
        <div class="mb-4">
            <label for="price_per_day" class="block text-gray-700 font-medium mb-2">Harga per Hari (Rp)</label>
            <input type="number" id="price_per_day" name="price_per_day" value="{{ old('price_per_day') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            @error('price_per_day') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Kapasitas --}}
        <div class="mb-4">
            <label for="capacity" class="block text-gray-700 font-medium mb-2">Kapasitas (orang)</label>
            <input type="number" id="capacity" name="capacity" value="{{ old('capacity') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            @error('capacity') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Jenis Kapal --}}
        <div class="mb-4">
            <label for="types" class="block text-gray-700 font-medium mb-2">Tipe Kapal</label>
            <select name="types[]" id="types" multiple
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->nama }}</option>
                @endforeach
            </select>
            <p class="text-sm text-gray-500 mt-1">Tekan Ctrl (Windows) / Cmd (Mac) untuk memilih lebih dari satu.</p>
        </div>

        {{-- Gambar --}}
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-medium mb-2">Gambar Kapal</label>
            <input type="file" id="image" name="image" accept="image/*"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2">
            @error('image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
            <textarea id="description" name="description" rows="4"
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
        </div>

        {{-- Detail Teknis --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="length" class="block text-gray-700 font-medium mb-2">Panjang (m)</label>
                <input type="number" step="0.1" id="length" name="length" value="{{ old('length') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2">
            </div>
            <div>
                <label for="year_built" class="block text-gray-700 font-medium mb-2">Tahun Pembuatan</label>
                <input type="number" id="year_built" name="year_built" value="{{ old('year_built') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2">
            </div>
            <div>
                <label for="max_speed" class="block text-gray-700 font-medium mb-2">Kecepatan Maks (knot)</label>
                <input type="number" id="max_speed" name="max_speed" value="{{ old('max_speed') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2">
            </div>
            <div>
                <label for="stock" class="block text-gray-700 font-medium mb-2">Stok</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2">
            </div>
        </div>

        {{-- Fasilitas --}}
        <div class="mb-4">
            <label for="amenities" class="block text-gray-700 font-medium mb-2">Fasilitas</label>
            <textarea id="amenities" name="amenities" rows="3"
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">{{ old('amenities') }}</textarea>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end space-x-2 mt-6">
            <a href="{{ route('ships.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                Batal
            </a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
