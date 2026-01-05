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
            --color-red-logout: #c30737; 
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        
        @include('admin.partials.sidebar')

        <div class="flex-1 flex flex-col h-screen overflow-hidden relative w-full transition-all duration-300" id="main-content">
            
            <header class="bg-white shadow-sm z-20 h-16 flex items-center justify-between px-4 lg:hidden">
                <button id="mobile-menu-button" class="text-[--color-primary-dark] focus:outline-none p-2 rounded-md hover:bg-gray-100">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
                <span class="font-bold text-lg text-[--color-primary-dark]">Admin Panel</span>
                <div class="w-8"></div> 
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 md:p-6 lg:p-8 relative w-full">
                @yield('content')
            </main>
        </div>
    </div>

    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden lg:hidden glass-effect"></div>

    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.querySelector('aside'); 
        const overlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        mobileMenuButton.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    </script>
</body>
</html>