@props(['current' => null])

@php
    $services = [
        [
            'key' => 'testing-duration',
            'title' => 'Lama Pengujian',
            'route' => 'services.testing-duration',
        ],
        [
            'key' => 'testing-accreditation-scope',
            'title' => 'Ruang Lingkup Akreditasi',
            'route' => 'services.testing-accreditation-scope',
        ],
        [
            'key' => 'sample-collection',
            'title' => 'Pengambilan Contoh',
            'route' => 'services.sample-collection',
        ],
        [
            'key' => 'calibration',
            'title' => 'Kalibrasi',
            'route' => 'services.calibration',
        ],
        [
            'key' => 'product-certification',
            'title' => 'Sertifikasi Produk',
            'route' => 'services.product-certification',
        ],
        [
            'key' => 'lph',
            'title' => 'Lembaga Pemeriksa Halal',
            'route' => 'lph',
        ],
    ];

    $relatedServices = collect($services)
        ->reject(fn ($service) => $service['key'] === $current);
@endphp

<section class="mt-4 sm:mt-6">
    <div class="grid gap-2.5 sm:gap-3 lg:grid-cols-[0.95fr_1.8fr]">
        <div class="relative min-h-[118px] overflow-hidden rounded-[8px] bg-[#08236f] text-white shadow-[0_12px_30px_rgba(8,35,111,0.14)] sm:min-h-[210px] sm:shadow-[0_16px_44px_rgba(8,35,111,0.16)]">
            <img src="{{ asset('assets/section1.jpg') }}" alt="" aria-hidden="true"
                class="absolute inset-0 h-full w-full object-cover object-center opacity-78">
            <div class="absolute inset-0 bg-gradient-to-t from-[#061a54] via-[#061a54]/62 to-[#061a54]/8"></div>
            <div class="relative flex h-full min-h-[118px] flex-col justify-end p-3 sm:min-h-[210px] sm:p-5">
                <p class="text-[9px] font-semibold uppercase tracking-[0.14em] text-[#f4d35e] sm:text-[10px] sm:tracking-[0.16em]">Layanan terkait</p>
                <h2 class="mt-1.5 max-w-sm text-[15px] font-semibold leading-snug sm:mt-2 sm:text-[24px] sm:leading-tight">
                    Sekalian cek layanan yang sering dibutuhkan bersama
                </h2>
            </div>
        </div>

        <div class="grid gap-2 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($relatedServices as $service)
                <a href="{{ route($service['route']) }}"
                    class="group flex min-h-[58px] items-center gap-2.5 rounded-[8px] border border-black/10 bg-white px-3 py-2.5 shadow-[0_8px_22px_rgba(15,23,42,0.045)] transition hover:-translate-y-0.5 hover:border-[#d4af37]/70 hover:shadow-[0_18px_44px_rgba(8,35,111,0.10)] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#d4af37] sm:min-h-[76px] sm:gap-3 sm:p-4">
                    <div class="min-w-0 flex-1">
                        <p class="text-[9px] font-semibold uppercase tracking-[0.1em] text-[#d4af37] sm:text-[10px] sm:tracking-[0.12em]">Layanan</p>
                        <h3 class="mt-0.5 text-[13px] font-semibold leading-snug text-[#08236f] sm:text-[15px]">
                            {{ $service['title'] }}
                        </h3>
                    </div>
                    <span
                        class="grid h-7 w-7 shrink-0 place-items-center rounded-full bg-[#eef4ff] text-[#08236f] transition group-hover:bg-[#08236f] group-hover:text-white sm:h-8 sm:w-8">
                        <svg class="h-3 w-3 transition group-hover:translate-x-0.5 sm:h-3.5 sm:w-3.5" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                        </svg>
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>
