{{-- resources/views/admin/partials/sidebar_item.blade.php --}}
@php
    /**
     * Komponen: Item Menu Sidebar Admin
     * Menerima variabel: $route, $icon, $label
     */
     
    // Cek apakah route saat ini sesuai dengan menu ini
    $isActive = request()->routeIs($route);

    // Style Standar
    $baseClass = "flex items-center p-3 rounded-lg transition-all duration-200";
    
    // Style jika Aktif (Background Terang + Shadow)
    $activeClass = "bg-[--color-primary-light] font-bold shadow-md ring-1 ring-white/30 text-white transform scale-[1.02]";
    
    // Style jika Tidak Aktif (Hover effect)
    $inactiveClass = "hover:bg-white/10 text-gray-100 hover:text-white";
@endphp

<a href="{{ Route::has($route) ? route($route) : '#' }}" 
   class="{{ $baseClass }} {{ $isActive ? $activeClass : $inactiveClass }} mb-1">
   
    {{-- Icon dengan lebar tetap agar rapi --}}
    <div class="w-8 flex justify-center items-center mr-2">
        <i class="{{ $icon }} text-lg"></i>
    </div>
    
    {{-- Label Menu --}}
    <span class="text-sm tracking-wide">{{ $label }}</span>
    
    {{-- Indikator Aktif (Dot kecil di kanan) --}}
    @if($isActive)
        <i class="fas fa-circle text-[6px] text-white ml-auto animate-pulse"></i>
    @endif
</a>