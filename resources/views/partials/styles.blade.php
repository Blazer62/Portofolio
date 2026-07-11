<style>
    body { font-family: 'Outfit', sans-serif; }
    html { scroll-behavior: smooth; }

    .animate-on-scroll {
        opacity: 0; transform: translateY(40px);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }
    .is-visible { opacity: 1; transform: translateY(0); }

    .bg-pattern {
        background-image: radial-gradient(rgba(16, 185, 129, 0.1) 1px, transparent 1px);
        background-size: 30px 30px;
    }

    .code-block {
        font-family: 'Fira Code', monospace;
        background: #1e1e2e;
        border: 1px solid #313244;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.4);
    }
    .code-header {
        background: #181825;
        padding: 14px 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .code-dot { width: 12px; height: 12px; border-radius: 50%; }
    .code-dot:nth-child(1) { background: #f38ba8; }
    .code-dot:nth-child(2) { background: #fab387; }
    .code-dot:nth-child(3) { background: #a6e3a1; }
    html:not(.dark) .code-block {
        background: #f4f5f7;
        border-color: #d4d4d8;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    html:not(.dark) .code-header {
        background: #e8eaed;
    }
    html:not(.dark) .code-block .text-zinc-200,
    html:not(.dark) .code-block .text-zinc-300,
    html:not(.dark) .code-block .text-zinc-500 {
        color: #27272a;
    }
    html:not(.dark) .code-block .text-emerald-400 {
        color: #059669;
    }

    #particles-canvas {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        pointer-events: none; z-index: 0;
    }

    .glitch-text {
        position: relative;
    }
    .glitch-text::before,
    .glitch-text::after {
        content: attr(data-text);
        position: absolute; top: 0; left: 0;
        width: 100%; height: 100%;
    }
    .glitch-text::before {
        color: #f38ba8;
        z-index: -1;
        animation: glitch-offset 3s infinite linear alternate-reverse;
    }
    .glitch-text::after {
        color: #89b4fa;
        z-index: -2;
        animation: glitch-offset2 2s infinite linear alternate-reverse;
    }
    @keyframes glitch-offset {
        0% { transform: translate(0); }
        20% { transform: translate(-2px, 2px); }
        40% { transform: translate(-2px, -2px); }
        60% { transform: translate(2px, 2px); }
        80% { transform: translate(2px, -2px); }
        100% { transform: translate(0); }
    }
    @keyframes glitch-offset2 {
        0% { transform: translate(0); }
        25% { transform: translate(3px, -1px); }
        50% { transform: translate(-3px, 1px); }
        75% { transform: translate(1px, 3px); }
        100% { transform: translate(-1px, -3px); }
    }

    .cursor-blink {
        animation: blink 0.8s step-end infinite;
    }
    @keyframes blink {
        50% { opacity: 0; }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }
    .float-anim { animation: float 4s ease-in-out infinite; }

    .gradient-border {
        position: relative;
    }
    .gradient-border::before {
        content: '';
        position: absolute; inset: 0;
        border-radius: inherit;
        padding: 1px;
        background: linear-gradient(135deg, #10b981, #059669, #34d399);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: 0;
        transition: opacity 0.4s;
    }
    .gradient-border:hover::before { opacity: 1; }

    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #10b981; border-radius: 3px; }

    .loading-bar {
        height: 3px;
        background: linear-gradient(90deg, #10b981, #34d399, #10b981);
        background-size: 200% 100%;
        animation: loading 2s ease-in-out infinite;
    }
    @keyframes loading {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    .tilt-card {
        transform-style: preserve-3d;
        perspective: 1000px;
    }

    .stat-card {
        background: rgba(255,255,255,.8);
        border: 1px solid #e4e4e7;
        border-radius: 16px;
        padding: 20px 12px;
        text-align: center;
        transition: all 0.3s ease;
        backdrop-filter: blur(4px);
    }
    .dark .stat-card {
        background: rgba(24,24,27,.6);
        border-color: rgba(255,255,255,.06);
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(16,185,129,.1);
    }
    .stat-num {
        font-size: 1.8rem;
        font-weight: 800;
        background: linear-gradient(135deg, #10b981, #059669);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.2;
    }
    .stat-label {
        font-size: .8rem;
        color: #71717a;
        margin-top: 4px;
        font-weight: 500;
    }
    .dark .stat-label {
        color: #a1a1aa;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1.1fr .9fr;
        gap: 60px;
    }
    .contact-left h3 {
        font-size: 1.6rem;
        font-weight: 700;
        margin-bottom: 16px;
    }
    .contact-left p {
        color: #52525b;
        margin-bottom: 32px;
        line-height: 1.8;
    }
    .dark .contact-left p {
        color: #a1a1aa;
    }
    .social-links {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }
    .social-link {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        border: 2px solid #e4e4e7;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #71717a;
        font-size: 1.2rem;
        background: #fff;
        transition: all 0.3s ease;
    }
    .dark .social-link {
        border-color: rgba(255,255,255,.08);
        color: #a1a1aa;
        background: transparent;
    }
    .social-link:hover {
        border-color: #10b981;
        color: #10b981;
        background: #f0fdf4;
        transform: translateY(-5px);
        box-shadow: 0 8px 28px rgba(16,185,129,.12);
    }
    .dark .social-link:hover {
        background: rgba(16,185,129,.06);
    }

    .contact-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .form-group label {
        font-size: .85rem;
        font-weight: 500;
        color: #52525b;
    }
    .dark .form-group label {
        color: #a1a1aa;
    }
    .form-group input,
    .form-group textarea {
        padding: 14px 18px;
        border: 1px solid #e4e4e7;
        border-radius: 12px;
        font-family: 'Outfit', sans-serif;
        font-size: .95rem;
        transition: all 0.3s ease;
        outline: none;
        background: #fafafa;
        color: #18181b;
    }
    .dark .form-group input,
    .dark .form-group textarea {
        background: #18181b;
        border-color: rgba(255,255,255,.08);
        color: #f4f4f5;
    }
    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16,185,129,.12);
        background: #fff;
    }
    .dark .form-group input:focus,
    .dark .form-group textarea:focus {
        background: #1a1a1a;
    }
    .form-group textarea {
        min-height: 140px;
        resize: vertical;
    }
    .form-error {
        font-size: .8rem;
        color: #ef4444;
        display: none;
    }
    .form-group.error input,
    .form-group.error textarea {
        border-color: #ef4444;
    }
    .form-group.error .form-error {
        display: block;
    }

    .btn-submit {
        padding: 16px 40px;
        background: linear-gradient(135deg, #10b981, #059669);
        color: #fff;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.3s ease;
        font-family: 'Outfit', sans-serif;
    }
    .btn-submit:hover {
        transform: scale(1.02);
        box-shadow: 0 8px 32px rgba(16,185,129,.3);
    }
    .btn-submit.loading {
        pointer-events: none;
        opacity: .85;
    }
    .btn-submit .spinner {
        display: none;
        width: 18px;
        height: 18px;
        border: 2px solid rgba(255,255,255,.3);
        border-top-color: #fff;
        border-radius: 50%;
        animation: spin-contact .6s linear infinite;
    }
    .btn-submit.loading .spinner {
        display: block;
    }
    .btn-submit.loading .btn-text {
        display: none;
    }
    @keyframes spin-contact {
        to { transform: rotate(360deg); }
    }

    .toast {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 99999;
        background: #fff;
        border: 1px solid #e4e4e7;
        border-radius: 14px;
        padding: 16px 24px;
        box-shadow: 0 10px 40px rgba(0,0,0,.08);
        display: flex;
        align-items: center;
        gap: 12px;
        transform: translateY(100px);
        opacity: 0;
        transition: all 0.3s ease;
    }
    .dark .toast {
        background: #18181b;
        border-color: rgba(255,255,255,.08);
        box-shadow: 0 10px 40px rgba(0,0,0,.3);
    }
    .toast.show {
        transform: translateY(0);
        opacity: 1;
    }
    .toast-icon {
        font-size: 1.5rem;
        color: #10b981;
    }
    .toast-msg {
        font-size: .9rem;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .contact-grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }
    }
</style>
