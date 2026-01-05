<aside class="w-64 bg-[--color-primary-dark] text-white flex flex-col fixed inset-y-0 left-0 z-30 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-2xl h-full">
    
    <div class="h-20 flex items-center justify-center border-b border-white/20 shadow-sm bg-[--color-primary-dark]">
        <div class="flex items-center space-x-3">
            <div class="bg-white p-1.5 rounded-lg shadow-lg">
                <img src="{{ asset('img/logo_smk.png') }}" alt="Logo" class="h-8 w-8">
            </div>
            <div>
                <h1 class="text-lg font-extrabold tracking-wide text-white leading-tight">ADMIN</h1>
                <p class="text-[10px] text-blue-200 uppercase tracking-wider font-semibold">Administrator Panel</p>
            </div>
        </div>
    </div>

    <div class="px-6 py-6 border-b border-white/10 bg-white/5">
        <div class="flex items-center space-x-3">
            <div class="h-10 w-10 rounded-full bg-white/20 flex items-center justify-center text-lg font-bold shadow-inner ring-2 ring-white/30">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="overflow-hidden">
                <p class="font-bold text-sm truncate text-white">{{ Auth::user()->name ?? 'Administrator' }}</p>
                <p class="text-xs text-blue-200 truncate flex items-center">
                    <i class="fas fa-circle text-[8px] text-green-400 mr-1.5 animate-pulse"></i> Online
                </p>
            </div>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto py-6 px-3 space-y-1 custom-scrollbar">
        
        <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('dashboard') ? 'bg-[--color-primary-light] font-bold shadow-md' : '' }}">
            <i class="fas fa-tachometer-alt mr-4 w-5 text-center"></i>
            <span>Dashboard</span>
        </a>

        <div class="pt-4 pb-2 px-3 text-xs font-bold text-blue-300 uppercase tracking-wider">Master Data</div>

        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-white/10 transition">
            <i class="fas fa-users mr-4 w-5 text-center"></i>
            <span>Data Siswa</span>
        </a>
        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-white/10 transition">
            <i class="fas fa-chalkboard-teacher mr-4 w-5 text-center"></i>
            <span>Data Guru</span>
        </a>
        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-white/10 transition">
            <i class="fas fa-building mr-4 w-5 text-center"></i>
            <span>Data Industri</span>
        </a>

        <div class="pt-4 pb-2 px-3 text-xs font-bold text-blue-300 uppercase tracking-wider">Monitoring</div>

        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-white/10 transition">
            <i class="fas fa-clipboard-check mr-4 w-5 text-center"></i>
            <span>Verifikasi Logbook</span>
        </a>
    </div>

    <div class="p-4 border-t border-white/20">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center justify-center w-full p-3 rounded-lg bg-[--color-red-logout] hover:bg-red-700 transition shadow-lg text-white font-bold">
                <i class="fas fa-power-off mr-2"></i> Logout
            </button>
        </form>
    </div>
</aside>