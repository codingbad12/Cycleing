@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-semibold">Daftar Tipe Kapal</h2>
    <a href="{{ route('types.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        <i class="bi bi-plus-lg"></i> Tambah Tipe
    </a>
</div>

@if (session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="overflow-x-auto bg-white shadow rounded-xl">
    <table class="min-w-full text-left">
        <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
            <tr>
                <th class="px-6 py-3">No</th>
                <th class="px-6 py-3">Nama Tipe</th>
                <th class="px-6 py-3">Jumlah Perahu</th>
                <th class="px-6 py-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($types as $index => $type)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-3">{{ $types->firstItem() + $index }}</td>
                    <td class="px-6 py-3 font-medium">{{ $type->nama }}</td>
                    <td class="px-6 py-3 font-medium">{{ $type->ships_count }}</td>
                    <td class="px-6 py-3 text-right">
                        <a href="{{ route('types.edit', $type->id) }}" class="text-blue-600 hover:underline">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('types.edit', $type->id) }}" class="text-blue-600 hover:underline ml-2">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('types.destroy', $type->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin menghapus tipe ini?')" class="text-red-600 hover:underline ml-2">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-3 text-center text-gray-500">Belum ada data tipe kapal.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $types->links() }}
</div>
@endsection
