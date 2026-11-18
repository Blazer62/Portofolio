<script>
(function() {
    var toggle = document.getElementById('menu-toggle');
    var menu = document.getElementById('mobile-menu');
    var menuIcon = document.getElementById('menu-icon');
    var closeIcon = document.getElementById('close-icon');
    var links = document.querySelectorAll('.mobile-link');
    if (!toggle || !menu) return;

    function openMenu() {
        menu.style.display = 'block';
        menuIcon.classList.add('hidden');
        closeIcon.classList.remove('hidden');
    }

    function closeMenu() {
        menu.style.display = 'none';
        menuIcon.classList.remove('hidden');
        closeIcon.classList.add('hidden');
    }

    toggle.addEventListener('click', function(e) {
        e.stopPropagation();
        if (menu.style.display === 'block') {
            closeMenu();
        } else {
            openMenu();
        }
    });

    links.forEach(function(link) {
        link.addEventListener('click', function() {
            closeMenu();
        });
    });

    document.addEventListener('click', function(e) {
        if (!toggle.contains(e.target) && !menu.contains(e.target)) {
            closeMenu();
        }
    });
})();

const typewriterEl = document.getElementById('typewriter');
const typewriterEl2 = document.getElementById('typewriter2');
if (typewriterEl && typewriterEl2) {
const lines = [
    { el: typewriterEl, text: "const developer = {", speed: 40 },
    { el: typewriterEl2, text: '  fokus: "Frontend Development"', speed: 30 }
];

function typeLine(lineObj, callback) {
    const el = lineObj.el;
    const text = lineObj.text;
    let i = 0;
    el.textContent = '';
    function type() {
        if (i < text.length) {
            el.textContent += text.charAt(i);
            i++;
            setTimeout(type, lineObj.speed + Math.random() * 30);
        } else if (callback) {
            setTimeout(callback, 500);
        }
    }
    type();
}

function startTypewriter() {
    typeLine(lines[0], () => {
        typeLine(lines[1]);
    });
}

startTypewriter();
setInterval(() => {
    typewriterEl.textContent = '';
    typewriterEl2.textContent = '';
    setTimeout(startTypewriter, 300);
}, 6000);
}

const html = document.documentElement;
const themeToggle = document.getElementById('theme-toggle');
const sunIcon = document.getElementById('sun-icon');
const moonIcon = document.getElementById('moon-icon');

if (localStorage.theme === 'light') {
    html.classList.remove('dark');
    sunIcon.classList.add('hidden');
    moonIcon.classList.remove('hidden');
}

themeToggle.addEventListener('click', () => {
    html.classList.toggle('dark');
    if (html.classList.contains('dark')) {
        localStorage.theme = 'dark';
        sunIcon.classList.remove('hidden');
        moonIcon.classList.add('hidden');
    } else {
        localStorage.theme = 'light';
        sunIcon.classList.add('hidden');
        moonIcon.classList.remove('hidden');
    }
});

const observerOptions = {
    root: null,
    rootMargin: '0px',
    threshold: 0.15
};

const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            obs.unobserve(entry.target);
        }
    });
}, observerOptions);

document.querySelectorAll('.animate-on-scroll').forEach(el => {
    observer.observe(el);
});

function openModal(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.style.display = 'flex';
    el.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.style.display = 'none';
    el.classList.add('hidden');
    document.body.style.overflow = '';
}

document.querySelectorAll('[data-tilt]').forEach(card => {
    card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        const rotateX = ((y - centerY) / centerY) * -8;
        const rotateY = ((x - centerX) / centerX) * 8;
        card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-8px)`;
    });
    card.addEventListener('mouseleave', () => {
        card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0px)';
    });
});

(function() {
    var counters = document.querySelectorAll('.counter');
    if (!counters.length) return;

    var obs = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                var el = entry.target;
                var target = parseInt(el.getAttribute('data-target'));
                var current = 0;
                var step = Math.max(1, Math.ceil(target / 40));
                var timer = setInterval(function() {
                    current += step;
                    if (current >= target) {
                        el.textContent = target;
                        clearInterval(timer);
                    } else {
                        el.textContent = current;
                    }
                }, 30);
                obs.unobserve(el);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(function(c) { obs.observe(c); });
})();

/* Scroll to top */
(function() {
    var btn = document.getElementById('scrollTopBtn');
    if (!btn) return;
    window.addEventListener('scroll', function() {
        if (window.scrollY > 400) {
            btn.classList.remove('opacity-0', 'invisible');
            btn.classList.add('opacity-100', 'visible');
        } else {
            btn.classList.add('opacity-0', 'invisible');
            btn.classList.remove('opacity-100', 'visible');
        }
    });
})();

/* Progress bar skill muncul saat terlihat */
(function() {
    var bars = document.querySelectorAll('.skill-fill[data-width]');
    if (!bars.length) return;

    var obs = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                var el = entry.target;
                el.style.width = el.getAttribute('data-width') + '%';
                obs.unobserve(el);
            }
        });
    }, { threshold: 0.3 });

    bars.forEach(function(bar) { obs.observe(bar); });
})();

/* Pencarian & filter proyek */
(function() {
    var search = document.getElementById('projectSearch');
    var cards = Array.prototype.slice.call(document.querySelectorAll('.project-card'));
    var filterBtns = Array.prototype.slice.call(document.querySelectorAll('.filter-btn[data-filter]'));
    var empty = document.getElementById('projectEmpty');
    if (!cards.length && !empty) return;

    var activeFilter = 'all';

    function apply() {
        var q = (search ? search.value : '').toLowerCase().trim();
        var visible = 0;

        cards.forEach(function(card) {
            var haystack = (card.getAttribute('data-search') || '').toLowerCase();
            var tech = (card.getAttribute('data-tech') || '').toLowerCase();
            var matchQuery = !q || haystack.indexOf(q) !== -1;
            var matchFilter = activeFilter === 'all' || tech.indexOf(activeFilter.toLowerCase()) !== -1;

            if (matchQuery && matchFilter) {
                card.style.display = '';
                visible++;
            } else {
                card.style.display = 'none';
            }
        });

        if (empty) {
            empty.classList.toggle('hidden', visible !== 0);
        }
    }

    if (search) {
        search.addEventListener('input', apply);
    }

    filterBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            activeFilter = btn.getAttribute('data-filter');
            filterBtns.forEach(function(b) { b.classList.remove('active'); });
            btn.classList.add('active');
            apply();
        });
    });
})();

/* Preview proyek */
window.openProjectPreview = function(button) {
    var data;
    try {
        data = JSON.parse(button.getAttribute('data-project'));
    } catch (e) {
        return;
    }

    function setText(id, value) {
        var el = document.getElementById(id);
        if (!el) return;
        if (value) {
            el.innerHTML = value;
            el.classList.remove('hidden');
        } else {
            el.textContent = '';
            el.classList.add('hidden');
        }
    }

    function setBlock(id, value) {
        var el = document.getElementById(id);
        if (!el) return;
        el.classList.toggle('hidden', !value);
        if (value) el.textContent = value;
    }

    var img = document.getElementById('previewImage');
    if (img) {
        if (data.image) {
            img.src = data.image;
            img.classList.remove('hidden');
        } else {
            img.classList.add('hidden');
        }
    }

    setText('previewTitle', data.title || '');
    setText('previewCategory', data.category || '');
    setText('previewDescription', data.description || '');
    setBlock('previewProblem', data.problem || '');
    setBlock('previewGoal', data.goal || '');
    setBlock('previewRole', data.role || '');

    var features = document.getElementById('previewFeatures');
    if (features) {
        features.innerHTML = '';
        (data.features || []).forEach(function(feature) {
            var li = document.createElement('li');
            li.className = 'flex items-start gap-2';
            li.innerHTML = '<span class="text-emerald-500 mt-0.5">&#10003;</span><span>' + feature + '</span>';
            features.appendChild(li);
        });
        features.parentElement.classList.toggle('hidden', !(data.features || []).length);
    }

    var tech = document.getElementById('previewTech');
    if (tech) {
        tech.innerHTML = '';
        (data.tech || []).forEach(function(item) {
            var span = document.createElement('span');
            span.className = 'text-[10px] uppercase tracking-wider font-bold px-2.5 py-1 rounded-md dark:bg-zinc-800 dark:text-zinc-300 bg-zinc-100 text-zinc-600';
            span.textContent = item;
            tech.appendChild(span);
        });
        tech.parentElement.classList.toggle('hidden', !(data.tech || []).length);
    }

    var live = document.getElementById('previewLive');
    if (live) {
        live.href = data.live || '#';
        live.classList.toggle('hidden', !data.live);
    }

    var github = document.getElementById('previewGithub');
    if (github) {
        github.href = data.github || '#';
        github.classList.toggle('hidden', !data.github);
    }

    var detail = document.getElementById('previewDetail');
    if (detail) {
        detail.href = data.detail || '#';
        detail.classList.toggle('hidden', !data.detail);
    }

    openModal('previewModal');
};

/* Lightbox sertifikat */
window.openLightbox = function(src) {
    var img = document.getElementById('lightboxImage');
    if (!img) return;
    img.src = src;
    openModal('lightbox');
};

/* Transisi halaman saat pindah halaman */
(function() {
    function revealSection(el) {
        if (!el) return;
        el.classList.remove('section-enter');
        void el.offsetWidth; // paksa reflow agar animasi bisa diulang
        el.classList.add('section-enter');
    }

    function scrollToHash(hash) {
        var target = document.querySelector(hash);
        if (!target) return;

        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        revealSection(target);

        // Jangan tambahkan tanda # ke bilah URL agar URL tetap bersih tanpa #proyek atau #skill
        if (history.replaceState) {
            history.replaceState(null, '', window.location.pathname + window.location.search);
        }
    }

    function handleNavigation(e, link) {
        if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
        if (link.target === '_blank' || link.hasAttribute('download')) return;

        var href = link.getAttribute('href');
        if (!href) return;
        if (href.indexOf('mailto:') === 0 || href.indexOf('tel:') === 0 || href.indexOf('javascript:') === 0) return;

        // Anchor di halaman yang sama: cukup scroll halus ke elemen bersangkutan
        if (href.charAt(0) === '#') {
            if (href.length < 2) return;
            e.preventDefault();
            scrollToHash(href);
            return;
        }

        var url;
        try {
            url = new URL(link.href, window.location.href);
        } catch (err) {
            return;
        }

        // Tautan eksternal: biarkan browser menangani secara default
        if (url.origin !== window.location.origin) return;

        // Link ke halaman yang sama dengan beda hash
        if (url.pathname === window.location.pathname && url.search === window.location.search) {
            if (url.hash) {
                e.preventDefault();
                scrollToHash(url.hash);
            }
            return;
        }

        // Untuk tautan ke halaman lain (CV, Blog, Detail Proyek, Login, dsb):
        // Eksekusi navigasi langsung dengan window.location.href agar ekstensi mobile simulator,
        // iframe, smartphone, maupun desktop selalu berpindah URL secara instan tanpa tertahan.
        e.preventDefault();
        window.location.href = url.href;
    }

    document.addEventListener('click', function(e) {
        var link = e.target.closest('a');
        if (!link) return;
        handleNavigation(e, link);
    });

    // Dukungan simulator mobile berbasis touch / touch emulation
    var lastNavTime = 0;
    document.addEventListener('touchend', function(e) {
        var link = e.target.closest('a');
        if (!link) return;
        var href = link.getAttribute('href');
        if (!href || href.charAt(0) === '#' || href.indexOf('mailto:') === 0 || href.indexOf('tel:') === 0) return;
        if (link.target === '_blank' || link.hasAttribute('download')) return;

        var url;
        try {
            url = new URL(link.href, window.location.href);
        } catch (err) {
            return;
        }

        if (url.origin !== window.location.origin) return;
        if (url.pathname === window.location.pathname && url.search === window.location.search) return;

        var now = Date.now();
        if (now - lastNavTime < 800) return;
        lastNavTime = now;

        window.location.href = url.href;
    }, { passive: true });

    // Kembalikan halaman ke kondisi normal, termasuk saat browser memakai bfcache.
    window.addEventListener('pageshow', function(event) {
        document.body.classList.remove('page-exit');

        if (event.persisted) {
            var main = document.querySelector('main.page-enter');
            if (main) {
                main.style.animation = 'none';
                void main.offsetWidth;
                main.style.animation = '';
            }
        }
    });

    window.addEventListener('hashchange', function() {
        document.body.classList.remove('page-exit');
    });
})();
</script>
