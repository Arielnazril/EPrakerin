@php
    $url = Route::has($route) ? route($route) : '#';
    // Logic aktif: jika route sama, atau berada di child route
    $isActive = request()->routeIs($route) || request()->routeIs($route . '.*');

    $baseClass = "flex items-center p-2.5 rounded-lg transition-all duration-200 mb-1 group relative overflow-hidden cursor-pointer";
    $activeClass = "bg-[--color-primary-light] text-white shadow-md";
    $inactiveClass = "text-blue-100 hover:bg-white/10 hover:text-white";
@endphp

<a href="{{ $url }}" class="{{ $baseClass }} {{ $isActive ? $activeClass : $inactiveClass }}" title="{{ $label }}">

    {{-- Ikon: Saat collapsed, margin kanan hilang otomatis lewat CSS di layout utama --}}
    <div class="w-6 flex-shrink-0 flex justify-center items-center mr-3 sidebar-icon transition-all">
        <i class="{{ $icon }} text-lg"></i>
    </div>

    {{-- Label: Punya class sidebar-text agar bisa di-hide oleh JS --}}
    <span class="text-sm font-medium tracking-wide sidebar-text whitespace-nowrap transition-opacity duration-300">
        {{ $label }}
    </span>

    {{-- Indikator Aktif --}}
    @if($isActive)
        <div class="absolute right-2 w-1.5 h-1.5 bg-white rounded-full animate-pulse sidebar-text"></div>
    @endif
</a>
