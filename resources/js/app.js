import './bootstrap';

const videoModal = document.querySelector('[data-video-modal]');

if (videoModal) {
    const videoFrame = videoModal.querySelector('[data-video-modal-frame]');
    const videoTitle = videoModal.querySelector('[data-video-modal-title]');

    const closeVideoModal = () => {
        videoModal.classList.add('hidden');
        videoModal.classList.remove('grid');
        document.body.classList.remove('overflow-hidden');

        if (videoFrame) {
            videoFrame.innerHTML = '';
        }
    };

    document.addEventListener('click', (event) => {
        const trigger = event.target.closest('[data-video-modal-open]');

        if (trigger) {
            const embedUrl = trigger.dataset.videoEmbedUrl;

            if (!embedUrl) {
                return;
            }

            event.preventDefault();

            const target = new URL(embedUrl, window.location.origin);

            if (target.hostname.includes('youtube.com') || target.hostname.includes('youtube-nocookie.com')) {
                target.searchParams.set('autoplay', '1');
                target.searchParams.set('rel', '0');
            }

            if (videoFrame) {
                videoFrame.innerHTML = `
                    <iframe
                        src="${target.toString()}"
                        title="${trigger.dataset.videoTitle || 'Video'}"
                        class="h-full w-full"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen
                    ></iframe>
                `;
            }

            if (videoTitle) {
                videoTitle.textContent = trigger.dataset.videoTitle || 'Video';
            }

            videoModal.classList.remove('hidden');
            videoModal.classList.add('grid');
            document.body.classList.add('overflow-hidden');
            return;
        }

        if (event.target.closest('[data-video-modal-close]')) {
            closeVideoModal();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeVideoModal();
        }
    });
}

const pageLoader = document.querySelector('[data-page-loader]');

if (pageLoader) {
    let hasLoaded = document.readyState === 'complete';
    let hasShownLoader = false;

    const showLoaderDelay = window.setTimeout(() => {
        if (hasLoaded) {
            return;
        }

        hasShownLoader = true;
        pageLoader.classList.remove('pointer-events-none', 'opacity-0');
        pageLoader.classList.add('opacity-100');
    }, 400);

    const hidePageLoader = () => {
        hasLoaded = true;
        window.clearTimeout(showLoaderDelay);

        if (!hasShownLoader) {
            pageLoader.remove();
            return;
        }

        pageLoader.classList.add('pointer-events-none', 'opacity-0');
        pageLoader.classList.remove('opacity-100');

        window.setTimeout(() => {
            pageLoader.remove();
        }, 550);
    };

    if (hasLoaded) {
        hidePageLoader();
    } else {
        window.addEventListener('load', hidePageLoader, { once: true });
    }
}

const backToTopButton = document.querySelector('[data-back-to-top]');
const whatsappFloatingButton = document.querySelector('[data-whatsapp-floating]');

if (whatsappFloatingButton) {
    const toggleWhatsappFloatingButton = () => {
        const shouldShow = (window.scrollY || document.documentElement.scrollTop) > 100;

        whatsappFloatingButton.classList.toggle('pointer-events-none', !shouldShow);
        whatsappFloatingButton.classList.toggle('translate-y-3', !shouldShow);
        whatsappFloatingButton.classList.toggle('opacity-0', !shouldShow);
        whatsappFloatingButton.classList.toggle('translate-y-0', shouldShow);
        whatsappFloatingButton.classList.toggle('opacity-100', shouldShow);
    };

    toggleWhatsappFloatingButton();
    window.addEventListener('scroll', toggleWhatsappFloatingButton, { passive: true });
    window.addEventListener('resize', toggleWhatsappFloatingButton);
}

if (backToTopButton) {
    const toggleBackToTopButton = () => {
        const scrollTop = window.scrollY || document.documentElement.scrollTop;
        const viewportHeight = window.innerHeight;
        const pageHeight = document.documentElement.scrollHeight;
        const isNearBottom = scrollTop + viewportHeight >= pageHeight * 0.65;

        backToTopButton.classList.toggle('pointer-events-none', !isNearBottom);
        backToTopButton.classList.toggle('translate-y-3', !isNearBottom);
        backToTopButton.classList.toggle('opacity-0', !isNearBottom);
        backToTopButton.classList.toggle('translate-y-0', isNearBottom);
        backToTopButton.classList.toggle('opacity-100', isNearBottom);
    };

    backToTopButton.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth',
        });
    });

    toggleBackToTopButton();
    window.addEventListener('scroll', toggleBackToTopButton, { passive: true });
    window.addEventListener('resize', toggleBackToTopButton);
}
