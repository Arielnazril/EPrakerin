<aside id="sidebar" class="bg-[--color-primary-dark] text-white flex flex-col z-30 sidebar-transition h-screen shadow-2xl overflow-hidden fixed lg:static inset-y-0 left-0">

    <div class="h-16 flex items-center justify-center border-b border-white/10 shadow-sm bg-blue-900/50">
        <div class="flex items-center space-x-3 px-4">
            <div class="bg-white p-1.5 rounded shadow-lg flex-shrink-0 sidebar-logo transition-all">
                <img src="{{ asset('img/logo_smk.png') }}" alt="Logo" class="h-6 w-6">
            </div>
            <div class="sidebar-header-text transition-all duration-300 overflow-hidden whitespace-nowrap">
                <h1 class="text-lg font-bold tracking-wide leading-none">SISWA</h1>
                <p class="text-[10px] text-blue-200 uppercase tracking-wider">Area Magang</p>
            </div>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto py-4 px-3 custom-scrollbar space-y-1">

        @include('admin.partials.sidebar_item', ['route' => 'siswa.dashboard', 'icon' => 'fas fa-home', 'label' => 'Dashboard'])
        @include('admin.partials.sidebar_item', ['route' => 'siswa.transkrip.index', 'icon' => 'fas fa-clipboard-list', 'label' => 'Transkrip'])

        <div class="pt-4 pb-2 px-3 text-[10px] font-bold text-blue-300 uppercase tracking-wider sidebar-text whitespace-nowrap">Kegiatan Harian</div>

        @include('admin.partials.sidebar_item', ['route' => 'siswa.logbook.history', 'icon' => 'fas fa-history', 'label' => 'Riwayat Logbook'])
        @include('admin.partials.sidebar_item', ['route' => 'siswa.logbook.create', 'icon' => 'fas fa-pen-fancy', 'label' => 'Isi Logbook Baru'])

        <div class="pt-4 pb-2 px-3 text-[10px] font-bold text-blue-300 uppercase tracking-wider sidebar-text whitespace-nowrap">Akun</div>

        @include('admin.partials.sidebar_item', ['route' => 'profile.edit', 'icon' => 'fas fa-user-cog', 'label' => 'Profil Saya'])
    </div>

    <div class="p-4 border-t border-white/10">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center justify-center w-full p-2 rounded-lg bg-red-600 hover:bg-red-700 transition shadow-lg text-white group overflow-hidden">
                <i class="fas fa-power-off text-lg sidebar-icon transition-all"></i>
                <span class="ml-2 font-bold sidebar-text whitespace-nowrap">Keluar</span>
            </button>
        </form>
    </div>
</aside>
