document.addEventListener('DOMContentLoaded', () => {

    // --- MOBILE MENU ---
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuPanel = document.getElementById('mobile-menu-panel');
    const navLinks = document.querySelectorAll('#mobile-menu .nav-link');

    if (mobileMenu) {
        const openMenu = () => {
            mobileMenu.classList.remove('invisible', 'opacity-0');
            menuPanel.classList.remove('-translate-x-full');
        };

        const closeMenu = () => {
            mobileMenu.classList.add('opacity-0');
            menuPanel.classList.add('-translate-x-full');
            setTimeout(() => {
                mobileMenu.classList.add('invisible');
            }, 300);
        };
        menuBtn.addEventListener('click', openMenu);
        mobileMenu.addEventListener('click', closeMenu);
        navLinks.forEach(link => link.addEventListener('click', closeMenu));
        menuPanel.addEventListener('click', (e) => e.stopPropagation());
    }

    // --- DESKTOP DROPDOWN ---
    const dropdownMenu = document.getElementById('dropdown-menu');
    const moreDropdownContainer = document.getElementById('more-dropdown-container');

    if (dropdownMenu && moreDropdownContainer) {
        moreDropdownContainer.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });

        dropdownMenu.addEventListener('click', (e) => e.stopPropagation());

        window.addEventListener('click', () => {
            dropdownMenu.classList.add('hidden');
        });
    }

    // --- SCROLL ANIMATION ---
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            $(entry.target).toggleClass('is-visible', entry.isIntersecting);
        });
    }, { threshold: 0.1 });

    $('.animate-on-scroll').each((i, el) => observer.observe(el));

    // --- CLONING SCROLLING GALLERY ---
    const $imageSet = $('#scrolling-gallery .gallery-image-set');
    if ($imageSet.length) {
        const $clone = $imageSet.clone();
        $('#scrolling-gallery').append($clone);
    }

    // --- SET HERO HEIGHT ---
    function setHeroHeight() {
        $('.hero').css('height', $(window).height() + 'px');
    }
    setHeroHeight();
    $(window).on('resize', function () {
        setHeroHeight();
    });
});


