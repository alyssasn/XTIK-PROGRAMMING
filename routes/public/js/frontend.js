/**
 * Frontend JavaScript for XTIK Programming
 * Features: Mobile Hamburger Navigation, Scroll Animations, Navbar Transition, Back To Top, News Modal
 */

document.addEventListener('DOMContentLoaded', () => {

    // 1. Mobile & Floating Navigation Toggle (Garis 3 Buka-Tutup)
    const menuToggle = document.getElementById('menu-toggle');
    const menuIcon = document.querySelector('.menu-icon');
    const navMenu = document.querySelector('.mobile-drawer');
    const drawerBackdrop = document.querySelector('.mobile-drawer-backdrop');

    const openMenu = () => {
        if (menuToggle) menuToggle.checked = true;
        if (menuIcon) menuIcon.classList.add('active');
        if (navMenu) navMenu.classList.add('open');
        document.body.classList.add('nav-open');
    };

    const closeMenu = () => {
        if (menuToggle) menuToggle.checked = false;
        if (menuIcon) menuIcon.classList.remove('active');
        if (navMenu) navMenu.classList.remove('open');
        document.body.classList.remove('nav-open');
    };

    const toggleNav = (e) => {
        if (navMenu && navMenu.classList.contains('open')) {
            closeMenu();
        } else {
            openMenu();
        }
    };

    if (menuIcon) {
        menuIcon.addEventListener('click', (e) => {
            // Prevent double trigger if label triggers checkbox
            e.preventDefault();
            toggleNav(e);
        });
    }

    if (menuToggle) {
        menuToggle.addEventListener('change', () => {
            if (menuToggle.checked) {
                openMenu();
            } else {
                closeMenu();
            }
        });
    }

    // Close on backdrop click
    if (drawerBackdrop) {
        drawerBackdrop.addEventListener('click', closeMenu);
    }

    // Close menu when clicking on any link inside mobile drawer
    document.querySelectorAll('.mobile-drawer a').forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    // Close when clicking outside
    document.addEventListener('click', (e) => {
        if (navMenu && navMenu.classList.contains('open')) {
            const isClickInsideMenu = navMenu.contains(e.target);
            const isClickOnIcon = menuIcon && menuIcon.contains(e.target);
            if (!isClickInsideMenu && !isClickOnIcon) {
                closeMenu();
            }
        }
    });

    // Close on ESC key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeMenu();
        }
    });

    // 2. Navbar Floating / Glass Effect on Scroll
    const headerFloating = document.querySelector('.header-floating');
    const backToTopBtn = document.getElementById('backToTop');

    const handleScrollEffects = () => {
        const scrollY = window.scrollY || window.pageYOffset;

        // Navbar floating shrink & elevate
        if (headerFloating) {
            if (scrollY > 40) {
                headerFloating.classList.add('scrolled');
            } else {
                headerFloating.classList.remove('scrolled');
            }
        }

        // Back to top visibility
        if (backToTopBtn) {
            if (scrollY > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        }
    };

    window.addEventListener('scroll', handleScrollEffects, { passive: true });
    handleScrollEffects(); // run once on load

    // Back to top click
    if (backToTopBtn) {
        backToTopBtn.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // 3. Scroll Reveal Animation using IntersectionObserver
    const animatedElements = document.querySelectorAll(
        '.reveal-on-scroll, .animate-on-scroll, .news-card, .agenda-item-card, .learning-card, .stat-item, .person-card-modern, .intro-text-side, .intro-image-side'
    );

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    obs.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -40px 0px'
        });

        animatedElements.forEach((el, index) => {
            el.classList.add('reveal-on-scroll');
            // Stagger animation if in a grid
            const parent = el.parentElement;
            if (parent && (
                parent.classList.contains('news-grid') ||
                parent.classList.contains('learning-cards') ||
                parent.classList.contains('stats-grid') ||
                parent.classList.contains('agenda-grid') ||
                parent.classList.contains('organigram-tier')
            )) {
                el.style.transitionDelay = `${(index % 4) * 0.12}s`;
            }
            observer.observe(el);
        });
    } else {
        // Fallback for older browsers
        animatedElements.forEach(el => el.classList.add('is-visible'));
    }

    // 4. Smooth Scrolling for internal anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId && targetId !== '#') {
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    e.preventDefault();
                    const headerHeight = headerFloating ? 90 : 0;
                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerHeight;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

    // 5. News Modal Reader (Pop-up Baca Berita)
    window.openNewsModal = (title, date, imageUrl, content) => {
        let modal = document.getElementById('newsModal');
        if (!modal) {
            modal = document.createElement('div');
            modal.id = 'newsModal';
            modal.className = 'news-modal-overlay';
            modal.innerHTML = `
                <div class="news-modal-card">
                    <button class="modal-close-btn" onclick="closeNewsModal()" aria-label="Tutup">&times;</button>
                    <div id="modalImageContainer" style="margin-bottom:18px; border-radius:14px; overflow:hidden; max-height:300px; display:none;">
                        <img id="modalImage" src="" alt="" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <span id="modalDate" style="display:inline-block; font-size:0.85rem; color:#0b5aa2; font-weight:600; margin-bottom:8px;"></span>
                    <h2 id="modalTitle" style="font-size:1.6rem; font-weight:800; color:#0f172a; line-height:1.35; margin-bottom:16px;"></h2>
                    <div id="modalContent" style="color:#334155; line-height:1.75; font-size:1rem; white-space:pre-line;"></div>
                </div>
            `;
            document.body.appendChild(modal);

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    closeNewsModal();
                }
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeNewsModal();
            });
        }

        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalDate').innerHTML = `<i class="fa-regular fa-calendar"></i> ${date}`;
        document.getElementById('modalContent').textContent = content;

        const imgContainer = document.getElementById('modalImageContainer');
        const img = document.getElementById('modalImage');
        if (imageUrl) {
            img.src = imageUrl;
            img.alt = title;
            imgContainer.style.display = 'block';
        } else {
            imgContainer.style.display = 'none';
        }

        modal.style.display = 'flex';
        setTimeout(() => modal.classList.add('open'), 10);
        document.body.style.overflow = 'hidden';
    };

    window.closeNewsModal = () => {
        const modal = document.getElementById('newsModal');
        if (modal) {
            modal.classList.remove('open');
            setTimeout(() => {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }, 250);
        }
    };
});
