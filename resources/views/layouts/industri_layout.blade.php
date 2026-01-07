<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title', 'Area Mentor | e-Prakerin')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

    <style>
        :root {
            /* Warna Mentor kita buat nuansa Ungu/Indigo biar beda dikit dari Admin (Biru) & Siswa */
            --color-primary-dark: #4c1d95; /* violet-900 */
            --color-primary-light: #7c3aed; /* violet-600 */
            --sidebar-width: 16rem;
            --sidebar-collapsed-width: 5rem;
        }
        .sidebar-transition { transition: width 0.3s ease-in-out, transform 0.3s ease-in-out; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }

        .collapsed .sidebar-text, .collapsed .sidebar-header-text { display: none; }
        .collapsed .sidebar-icon { margin-right: 0; text-align: center; width: 100%; }
        .collapsed .sidebar-logo { width: 32px; height: 32px; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased overflow-hidden">

    <div class="flex h-screen w-full">

        @include('industri.partials.sidebar')

        <div class="flex-1 flex flex-col h-screen overflow-hidden relative transition-all duration-300" id="main-content">

            <header class="bg-white shadow-sm z-20 h-16 flex items-center justify-between px-6 sticky top-0">
                <div class="flex items-center">
                    <button id="sidebar-toggle-btn" class="text-gray-600 focus:outline-none p-2 rounded-md hover:bg-gray-100 transition">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h2 class="ml-4 text-lg font-bold text-[--color-primary-dark] hidden md:block">
                        @yield('page_title', 'Dashboard Mentor')
                    </h2>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="text-right hidden md:block">
                        <div class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-purple-600 uppercase font-bold">
                            {{ Auth::user()->instansi->nama_perusahaan ?? 'Mentor Industri' }}
                        </div>
                    </div>
                    <div class="h-10 w-10 rounded-full bg-purple-600 text-white flex items-center justify-center font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-4 md:p-6 lg:p-8">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
                        <p class="font-bold">Sukses</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebar-toggle-btn');
        const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';

        function initSidebar() {
            if (window.innerWidth >= 1024) {
                if (isCollapsed) {
                    sidebar.classList.add('collapsed', 'w-20');
                    sidebar.classList.remove('w-64');
                } else {
                    sidebar.classList.remove('collapsed', 'w-20');
                    sidebar.classList.add('w-64');
                }
            } else {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('w-20', 'collapsed');
                sidebar.classList.add('w-64');
            }
        }
        initSidebar();

        toggleBtn.addEventListener('click', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.toggle('w-64');
                sidebar.classList.toggle('w-20');
                sidebar.classList.toggle('collapsed');
                localStorage.setItem('sidebar-collapsed', sidebar.classList.contains('collapsed'));
            } else {
                sidebar.classList.toggle('-translate-x-full');
            }
        });
        window.addEventListener('resize', initSidebar);
    </script>
</body>
</html>
