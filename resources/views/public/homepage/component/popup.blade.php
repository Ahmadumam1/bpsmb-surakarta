@if ($popup)
    @php
        $images = collect([
            $popup->image_url,
            $popup->image_2_url,
            $popup->image_3_url,
        ])->filter()->values();
    @endphp

    @if ($images->isNotEmpty())
        <div id="announcement-popup" class="fixed inset-0 z-[9999] hidden flex items-center justify-center bg-black/60 backdrop-blur-sm p-4 opacity-0 transition-opacity duration-300 ease-out">
            <!-- Background Backdrop (No click closing) -->
            <div id="popup-overlay" class="absolute inset-0"></div>
            
            <!-- Modal Box -->
            <div class="popup-card relative z-10 w-full max-w-3xl mx-4 transform scale-95 opacity-0 transition-all duration-300 ease-out bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col">
                
                <!-- Slides Container -->
                <div class="relative overflow-hidden flex-1 bg-white h-[75vh] md:h-[580px] w-full">
                    @foreach ($images as $index => $imgUrl)
                        <div data-popup-slide="{{ $index }}" class="popup-slide w-full h-full {{ $index === 0 ? 'block' : 'hidden' }}">
                            @if ($popup->link_url)
                                <a href="{{ $popup->link_url }}" class="block w-full h-full">
                                    <img src="{{ $imgUrl }}" alt="Slide {{ $index + 1 }}" class="w-full h-full object-contain">
                                </a>
                            @else
                                <div class="w-full h-full">
                                    <img src="{{ $imgUrl }}" alt="Slide {{ $index + 1 }}" class="w-full h-full object-contain">
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                
                <!-- Bottom Action Button bar -->
                <div class="bg-gray-50 border-t border-gray-100 px-5 py-3 flex items-center justify-end">
                    <button type="button" id="popup-action-btn" class="w-full sm:w-auto min-w-[120px] rounded-lg bg-[#08236f] hover:bg-[#0b2f93] px-6 py-2.5 text-sm font-semibold text-white shadow-md active:scale-95 transition-all focus:outline-none">
                        {{ $images->count() > 1 ? 'Next' : 'Tutup' }}
                    </button>
                </div>
            </div>
        </div>

        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const popupEl = document.getElementById('announcement-popup');
                    if (!popupEl) return;
                    
                    const imagesCount = {{ $images->count() }};
                    let currentSlide = 0;
                    
                    // Cek apakah pengguna sudah melihat popup di sesi ini
                    const hasSeen = sessionStorage.getItem('home_popup_dismissed');
                    if (!hasSeen) {
                        // Tampilkan popup dengan delay kecil agar transisi terlihat mulus
                        popupEl.classList.remove('hidden');
                        
                        // Force reflow untuk memicu transisi css
                        popupEl.offsetHeight;
                        
                        popupEl.classList.remove('opacity-0');
                        popupEl.classList.add('opacity-100');
                        
                        const cardEl = popupEl.querySelector('.popup-card');
                        if (cardEl) {
                            cardEl.classList.remove('scale-95', 'opacity-0');
                            cardEl.classList.add('scale-100', 'opacity-100');
                        }
                    }
                    
                    const closePopup = () => {
                        popupEl.classList.remove('opacity-100');
                        popupEl.classList.add('opacity-0');
                        
                        const cardEl = popupEl.querySelector('.popup-card');
                        if (cardEl) {
                            cardEl.classList.remove('scale-100', 'opacity-100');
                            cardEl.classList.add('scale-95', 'opacity-0');
                        }
                        
                        // Simpan status bahwa popup sudah dilihat dalam sesi ini
                        sessionStorage.setItem('home_popup_dismissed', 'true');
                        
                        // Sembunyikan elemen setelah animasi selesai (300ms)
                        setTimeout(() => {
                            popupEl.classList.add('hidden');
                        }, 300);
                    };
                    
                    const actionBtn = document.getElementById('popup-action-btn');
                    const slides = popupEl.querySelectorAll('[data-popup-slide]');
                    
                    if (actionBtn) {
                        actionBtn.addEventListener('click', () => {
                            if (currentSlide < imagesCount - 1) {
                                // Sembunyikan slide aktif saat ini
                                slides[currentSlide].classList.add('hidden');
                                slides[currentSlide].classList.remove('block');
                                
                                // Naikkan index slide
                                currentSlide++;
                                
                                // Tampilkan slide berikutnya
                                slides[currentSlide].classList.remove('hidden');
                                slides[currentSlide].classList.add('block');
                                
                                // Jika ini adalah slide terakhir, ubah text tombol menjadi 'Tutup'
                                if (currentSlide === imagesCount - 1) {
                                    actionBtn.textContent = 'Tutup';
                                }
                            } else {
                                // Close modal
                                closePopup();
                            }
                        });
                    }
                });
            </script>
        @endpush
    @endif
@endif
