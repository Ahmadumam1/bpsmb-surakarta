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
            <div class="popup-card relative z-10 w-full max-w-3xl mx-4 transform scale-95 opacity-0 transition-all duration-300 ease-out bg-white rounded-xl shadow-2xl overflow-hidden flex flex-col">
                
                <!-- Yellow Header Bar -->
                <div class="bg-[#f39c12] text-white px-5 py-3 font-semibold text-base sm:text-[17px] tracking-wide shadow-sm flex items-center justify-between select-none">
                    <span>{{ $popup->title ?? 'Informasi Terkait PDP' }}</span>
                </div>

                <!-- Slides Container (Scrollable) -->
                <div class="relative overflow-y-auto flex-1 bg-white max-h-[70vh] md:max-h-[580px] w-full p-4 sm:p-6">
                    @foreach ($images as $index => $imgUrl)
                        <div data-popup-slide="{{ $index }}" class="popup-slide w-full {{ $index === 0 ? 'block' : 'hidden' }}">
                            @if ($popup->link_url)
                                <a href="{{ $popup->link_url }}" class="block w-full">
                                    <img src="{{ $imgUrl }}" alt="Slide {{ $index + 1 }}" class="w-full h-auto block object-contain rounded-lg shadow-sm">
                                </a>
                            @else
                                <div class="w-full">
                                    <img src="{{ $imgUrl }}" alt="Slide {{ $index + 1 }}" class="w-full h-auto block object-contain rounded-lg shadow-sm">
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                
                <!-- Bottom Action Button bar -->
                <div class="bg-white border-t border-gray-200 px-5 py-3 flex items-center justify-end">
                    <button type="button" id="popup-action-btn" class="w-full sm:w-auto min-w-[100px] rounded bg-[#6c757d] hover:bg-[#5a6268] active:bg-[#4e555b] px-4 py-2 text-sm font-semibold text-white shadow-md transition-all focus:outline-none">
                        {{ $images->count() > 1 ? 'Next' : 'Close' }}
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
                        
                        // Disable scroll pada body
                        document.body.classList.add('overflow-hidden');
                        
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
                        
                        // Re-enable scroll pada body
                        document.body.classList.remove('overflow-hidden');
                        
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
                                
                                // Jika ini adalah slide terakhir, ubah text tombol menjadi 'Close'
                                if (currentSlide === imagesCount - 1) {
                                    actionBtn.textContent = 'Close';
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
