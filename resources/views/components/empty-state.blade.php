@props([
    'title' => 'Belum Ada Data',
    'message' => 'Saat ini data atau informasi yang Anda cari belum tersedia.',
    'icon' => 'box', // box, search, document, etc.
    'buttonUrl' => null,
    'buttonText' => 'Kembali',
    'showContact' => true
])

<div class="w-full text-center py-12 px-6 bg-white/60 backdrop-blur-md rounded-2xl border border-gray-100/80 shadow-md max-w-md mx-auto my-6" {{ $attributes }}>
    <!-- Icon Container -->
    <div class="mb-5 flex justify-center">
        <div class="relative w-20 h-20 bg-gradient-to-br from-[#08236f]/5 to-[#d4af37]/10 rounded-full flex items-center justify-center">
            @if($icon === 'search')
                <svg class="w-10 h-10 text-[#08236f]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            @elseif($icon === 'document')
                <svg class="w-10 h-10 text-[#08236f]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            @else
                <svg class="w-10 h-10 text-[#08236f]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            @endif
            <!-- Miniature golden ornament -->
            <div class="absolute -top-1 -right-1 w-4 h-4 bg-[#d4af37] rounded-full border border-white"></div>
        </div>
    </div>

    <!-- Message Details -->
    <div class="space-y-2">
        <h3 class="text-lg font-bold text-[#08236f] tracking-tight">
            {{ $title }}
        </h3>
        <p class="text-xs text-gray-500 max-w-xs mx-auto leading-relaxed">
            {{ $message }}
        </p>
    </div>

    <!-- Call to Actions -->
    @if($buttonUrl || $showContact)
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-center gap-2">
            @if($buttonUrl)
                <a href="{{ $buttonUrl }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-transparent text-xs font-semibold rounded-lg text-white bg-[#08236f] hover:bg-[#061a53] shadow transition duration-150 focus:outline-none">
                    {{ $buttonText }}
                </a>
            @endif
            @if($showContact)
                <a href="{{ route('contact') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-gray-200 text-xs font-semibold rounded-lg text-gray-600 bg-white hover:bg-gray-50 transition duration-150 focus:outline-none">
                    Hubungi Kami
                </a>
            @endif
        </div>
    @endif
</div>
