<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title', 'Admin Panel | e-Prakerin')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --color-primary-dark: #1e3a8a;
            --color-primary-light: #2563eb;
            --sidebar-width: 16rem; /* 64 (w-64) */
            --sidebar-collapsed-width: 5rem; /* 20 (w-20) */
        }

        /* Transisi Halus */
        .sidebar-transition {
            transition: width 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        /* Scrollbar Custom */
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }

        /* Logic Sembunyikan Teks saat Collapsed */
        .collapsed .sidebar-text,
        .collapsed .sidebar-header-text {
            display: none;
        }
        .collapsed .sidebar-icon {
            margin-right: 0;
            text-align: center;
            width: 100%;
        }
        .collapsed .sidebar-logo {
            width: 32px;
            height: 32px;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased overflow-hidden">

    <div class="flex h-screen w-full">

        @include('admin.partials.sidebar')

        <div class="flex-1 flex flex-col h-screen overflow-hidden relative transition-all duration-300" id="main-content">

            <header class="bg-white shadow-sm z-20 h-16 flex items-center justify-between px-6 sticky top-0">

                <div class="flex items-center">
                    <button id="sidebar-toggle-btn" class="text-gray-600 focus:outline-none p-2 rounded-md hover:bg-gray-100 transition">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h2 class="ml-4 text-lg font-bold text-[--color-primary-dark] hidden md:block">
                        @yield('page_title', 'Admin Dashboard')
                    </h2>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="text-right hidden md:block">
                        <div class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-500 uppercase">{{ Auth::user()->role }}</div>
                    </div>
                    <div class="h-10 w-10 rounded-full bg-[--color-primary-dark] text-white flex items-center justify-center font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-4 md:p-6 lg:p-8">

                @if(session('success'))
                    <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
                        <p class="font-bold">Sukses</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm" role="alert">
                        <p class="font-bold">Error</p>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden lg:hidden glass-effect" onclick="toggleSidebar()"></div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const overlay = document.getElementById('mobile-overlay');
        const toggleBtn = document.getElementById('sidebar-toggle-btn');

        // Cek LocalStorage: Apakah user sebelumnya mengecilkan sidebar?
        const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';

        // Fungsi inisialisasi saat load
        function initSidebar() {
            if (window.innerWidth >= 1024) { // Desktop Mode
                if (isCollapsed) {
                    sidebar.classList.add('collapsed', 'w-20');
                    sidebar.classList.remove('w-64');
                } else {
                    sidebar.classList.remove('collapsed', 'w-20');
                    sidebar.classList.add('w-64');
                }
            } else { // Mobile Mode
                sidebar.classList.add('-translate-x-full'); // Sembunyi default
                sidebar.classList.remove('w-20', 'collapsed'); // Reset width
                sidebar.classList.add('w-64');
            }
        }

        // Jalankan saat load
        initSidebar();

        // Event Listener Tombol Toggle
        toggleBtn.addEventListener('click', () => {
            if (window.innerWidth >= 1024) {
                // Logic Desktop: Toggle Width (Collapse)
                sidebar.classList.toggle('w-64');
                sidebar.classList.toggle('w-20');
                sidebar.classList.toggle('collapsed');

                // Simpan preferensi user
                const collapsedState = sidebar.classList.contains('collapsed');
                localStorage.setItem('sidebar-collapsed', collapsedState);
            } else {
                // Logic Mobile: Toggle Slide (Off-canvas)
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }
        });

        // Resize Event (Biar responsif saat layar diputar/resize)
        window.addEventListener('resize', () => {
            initSidebar();
            if (window.innerWidth >= 1024) {
                overlay.classList.add('hidden'); // Hilangkan overlay di desktop
                sidebar.classList.remove('-translate-x-full'); // Pastikan sidebar muncul di desktop
            }
        });
    </script>
</body>
</html>
