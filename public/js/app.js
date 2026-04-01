(function() {
    "use strict";

    // Custom Cursor
    const cursor = document.getElementById('cursor');
    const trail = document.getElementById('cursorTrail');
    let trailX = 0, trailY = 0;
    
    if (cursor && trail) {
        document.addEventListener('mousemove', e => {
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';
            setTimeout(() => {
                trail.style.left = e.clientX + 'px';
                trail.style.top = e.clientY + 'px';
            }, 80);
        });

        document.querySelectorAll('a, button, .event-card, .artist-card, .exp-card, .ticket-card').forEach(el => {
            el.addEventListener('mouseenter', () => { 
                cursor.style.transform = 'translate(-50%,-50%) scale(2.5)'; 
            });
            el.addEventListener('mouseleave', () => { 
                cursor.style.transform = 'translate(-50%,-50%) scale(1)'; 
            });
        });
    }

    // Navbar scroll
    const navbar = document.getElementById('navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 60);
        });
    }

    // Mobile Menu Toggle
    const menuToggle = document.getElementById('menuToggle');
    const navLinks = document.querySelector('.nav-links');

    if (menuToggle && navLinks) {
        menuToggle.addEventListener('click', () => {
            menuToggle.classList.toggle('active');
            navLinks.classList.toggle('active');
            document.body.style.overflow = navLinks.classList.contains('active') ? 'hidden' : '';
        });
    }

    // Scroll reveal
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { 
        threshold: 0.12, 
        rootMargin: '0px 0px -60px 0px' 
    });
    reveals.forEach(el => observer.observe(el));

    // Countdown timer - target: May 16 2026
    function updateCountdown() {
        const target = new Date('2026-05-16T20:00:00');
        const now = new Date();
        const diff = target - now;

        const daysEl = document.getElementById('days');
        const hoursEl = document.getElementById('hours');
        const minsEl = document.getElementById('minutes');
        const secsEl = document.getElementById('seconds');

        if (!daysEl || !hoursEl || !minsEl || !secsEl) return;

        if (diff <= 0) {
            daysEl.textContent = '00';
            hoursEl.textContent = '00';
            minsEl.textContent = '00';
            secsEl.textContent = '00';
            return;
        }

        const d = Math.floor(diff / 86400000);
        const h = Math.floor((diff % 86400000) / 3600000);
        const m = Math.floor((diff % 3600000) / 60000);
        const s = Math.floor((diff % 60000) / 1000);

        daysEl.textContent = String(d).padStart(2, '0');
        hoursEl.textContent = String(h).padStart(2, '0');
        minsEl.textContent = String(m).padStart(2, '0');
        secsEl.textContent = String(s).padStart(2, '0');
    }

    if (document.getElementById('days')) {
        updateCountdown();
        setInterval(updateCountdown, 1000);
    }

    // Language switch via POST (no URL param)
    window.setLang = function(locale) {
        if (locale === 'en') {
            window.location.href = 'en.html';
        } else {
            window.location.href = 'index.html';
        }
    };

    // Language Dropdown Toggle
    const langBtn = document.getElementById('lang-menu-btn');
    const langDropdown = document.getElementById('lang-dropdown');

    if (langBtn && langDropdown) {
        langBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            langDropdown.classList.toggle('show');
        });

        document.addEventListener('click', (e) => {
            if (!langDropdown.contains(e.target) && !langBtn.contains(e.target)) {
                langDropdown.classList.remove('show');
            }
        });
    }

    // Smooth nav scroll
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const target = document.querySelector(a.getAttribute('href'));
            if (target) {
                e.preventDefault();

                // Close mobile menu if open
                if (navLinks && navLinks.classList.contains('active')) {
                    menuToggle.classList.remove('active');
                    navLinks.classList.remove('active');
                    document.body.style.overflow = '';
                }

                target.scrollIntoView({ 
                    behavior: 'smooth' 
                });
            }
        });
    });

})();
