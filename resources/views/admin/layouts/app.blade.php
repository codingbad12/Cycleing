<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="flex bg-gray-100 min-h-screen">

    <!-- SIDEBAR -->
    <aside class="bg-gray-900 text-gray-100 w-64 h-screen p-5 flex flex-col fixed">
        <div class="text-2xl font-bold mb-6">
            Admin Panel
        </div>
        <nav class="flex-1 space-y-2">
            <a href="{{ route('ships.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-800 {{ request()->is('admin/ships*') ? 'bg-gray-800' : '' }}">
                <i class="bi bi-kanban"></i>
                <span>Ship Management</span>
            </a>
            <a href="{{ route('types.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-800 {{ request()->is('admin/types*') ? 'bg-gray-800' : '' }}">
                <i class="bi bi-tags"></i>
                <span>Type Management</span>
            </a>
            <a href="#"
               class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-800 {{ request()->is('admin/peminjaman*') ? 'bg-gray-800' : '' }}">
                <i class="bi bi-calendar-check"></i>
                <span>Peminjaman</span>
            </a>
        </nav>

        <div class="mt-auto pt-4 border-t border-gray-700">
            <div class="flex items-center justify-between px-2 mb-3">
                <div>
                    <p class="font-semibold">{{ Auth::user()->profil->nama}}</p>
                    <p class="text-sm text-gray-400">{{ Auth::user()->email ?? 'admin@example.com' }}</p>
                </div>
                <img src="{{ asset('images/admin-avatar.png') }}" class="w-10 h-10 rounded-full" alt="Admin Avatar">
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 rounded-lg hover:bg-gray-800">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="flex-1 ml-64 flex flex-col">
        <!-- TOPBAR -->
        <header class="bg-white shadow p-4 flex items-center justify-between sticky top-0 z-10">
            <h1 class="text-xl font-semibold">@yield('page_title', 'Dashboard')</h1>
            <span class="text-gray-500">Welcome, {{ Auth::user()->profil->nama}}</span>
        </header>

        <!-- PAGE CONTENT -->
        <main class="p-6">
            @yield('content')
        </main>
    </div>

</body>
</html>
