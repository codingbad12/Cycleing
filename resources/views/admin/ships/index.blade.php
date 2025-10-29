@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-semibold">Manajemen Kapal</h2>
    <a href="{{ route('ships.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        <i class="bi bi-plus-lg"></i> Tambah Kapal
    </a>
</div>

@if (session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="overflow-x-auto bg-white shadow rounded-xl">
    <table class="min-w-full text-left border-collapse">
        <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
            <tr>
                <th class="px-6 py-3">No</th>
                <th class="px-6 py-3">Nama Kapal</th>
                <th class="px-6 py-3">Harga / Hari</th>
                <th class="px-6 py-3">Kapasitas</th>
                <th class="px-6 py-3">Gambar</th>
                <th class="px-6 py-3">Panjang (m)</th>
                <th class="px-6 py-3">Tahun Pembuatan</th>
                <th class="px-6 py-3">Kecepatan Maks</th>
                <th class="px-6 py-3">Stok</th>
                <th class="px-6 py-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-800">
            @forelse ($ships as $index => $ship)
                <tr class="border-b hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-3">{{ $ships->firstItem() + $index }}</td>
                    <td class="px-6 py-3 font-medium">{{ $ship->name }}</td>
                    <td class="px-6 py-3">Rp {{ number_format($ship->price_per_day, 0, ',', '.') }}</td>
                    <td class="px-6 py-3">{{ $ship->capacity }} orang</td>
                    <td class="px-6 py-3">
                        @if ($ship->image)
                            <img src="{{ asset('storage/' . $ship->image) }}" alt="{{ $ship->name }}" class="w-16 h-16 object-cover rounded-lg border">
                        @else
                            <span class="text-gray-400 italic">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td class="px-6 py-3">{{ $ship->length }} m</td>
                    <td class="px-6 py-3">{{ $ship->year_built }}</td>
                    <td class="px-6 py-3">{{ $ship->max_speed }} knot</td>
                    <td class="px-6 py-3">{{ $ship->stock }}</td>

                    <td class="px-6 py-3 text-right flex justify-end items-center space-x-3">
                        {{-- Detail --}}
                        <a href="{{ route('ships.show', $ship->id) }}"
                           class="text-green-600 hover:text-green-800"
                           title="Lihat Detail">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        {{-- Edit --}}
                        <a href="{{ route('ships.edit', $ship->id) }}"
                           class="text-blue-600 hover:text-blue-800"
                           title="Edit Kapal">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        {{-- Delete --}}
                        <form action="{{ route('ships.destroy', $ship->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin menghapus kapal ini?')"
                                    class="text-red-600 hover:text-red-800"
                                    title="Hapus Kapal">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="px-6 py-3 text-center text-gray-500">
                        Belum ada data kapal.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $ships->links() }}
</div>
@endsection
