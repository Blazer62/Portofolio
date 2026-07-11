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

    toggle.addEventListener('click', function() {
        if (menu.style.display === 'block') {
            closeMenu();
        } else {
            openMenu();
        }
    });

    links.forEach(function(link) {
        link.addEventListener('click', closeMenu);
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
    { el: typewriterEl2, text: '  name: "Gusti Rizky Ananda"', speed: 30 }
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

const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

document.querySelectorAll('.animate-on-scroll').forEach(el => {
    observer.observe(el);
});

function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
    document.body.style.overflow = 'auto';
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
</script>

<script>
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
</script>
