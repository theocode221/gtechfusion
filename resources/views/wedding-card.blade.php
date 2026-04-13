<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="theme-color" content="#0a0a0a">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="GTechFusion">
<link rel="apple-touch-icon" href="/public/images/gtech-icon.png">
<link rel="manifest" href="/manifest.json">
    <title>E-Wedding Card — GTechFusion</title>
    <link rel="icon" type="image/png" href="/public/images/gtech-icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Outfit:wght@200;300;400&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --white: #ffffff;
            --accent: #c8a96e;
            --green-deep: #1a2e1a;
            --font-display: 'Cormorant Garamond', serif;
            --font-body: 'Outfit', sans-serif;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: var(--font-body);
            font-weight: 300;
            background: #0a0a0a;
            color: var(--white);
            overflow-x: hidden;
            cursor: none;
        }

        /* ── Custom Cursor ── */
        .cursor {
            position: fixed;
            width: 8px; height: 8px;
            background: var(--accent);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            transform: translate(-50%, -50%);
        }
        .cursor-ring {
            position: fixed;
            width: 32px; height: 32px;
            border: 1px solid rgba(200,169,110,0.45);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9998;
            transform: translate(-50%, -50%);
        }

        /* ── NAV ── */
.nav {
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 500;
    padding: 1.6rem 3.5rem;
    padding-top: max(1.6rem, env(safe-area-inset-top) + 0.8rem);
    padding-left: max(3.5rem, env(safe-area-inset-left) + 1rem);
    padding-right: max(3.5rem, env(safe-area-inset-right) + 1rem);
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(to bottom, rgba(0,0,0,0.55), transparent);
}

        .nav-logo {
            font-family: var(--font-display);
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--white);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.15rem;
        }

        .nav-logo img {
            width: 36px; height: 36px;
            object-fit: contain;
        }

        .nav-logo span { color: var(--accent); }

        .nav-cta {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.65rem 1.6rem;
            background: var(--accent);
            color: #0a0a0a;
            font-family: var(--font-body);
            font-size: 0.72rem;
            font-weight: 400;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            text-decoration: none;
            clip-path: polygon(0 0, calc(100% - 8px) 0, 100% 8px, 100% 100%, 8px 100%, 0 calc(100% - 8px));
            transition: background 0.3s ease;
        }

        .nav-cta:hover { background: var(--white); }

        /* ══════════════════════════════════
           SECTION 1 — HERO
        ══════════════════════════════════ */
        .hero {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

.hero-bg {
    position: absolute;
    inset: 0;
    background-image: url('/public/images/landscape-wed4.jpeg');
    background-size: cover;
    background-position: center 30%;
    will-change: transform;
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to bottom,
        rgba(0,0,0,0.5)  0%,
        rgba(0,0,0,0.65) 25%,
        rgba(0,0,0,0.75) 50%,
        rgba(0,0,0,0.88) 75%,
        rgba(0,0,0,1.0)  100%
    );
}

        .hero-content {
            position: relative;
            z-index: 10;
            text-align: center;
            padding: 0 2rem;
        }

        .hero-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            font-size: 0.68rem;
            font-weight: 300;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 1.5rem;
            opacity: 0;
            animation: fadeUp 1s 0.3s ease forwards;
        }

        .hero-tag::before,
        .hero-tag::after {
            content: '';
            display: block;
            width: 32px; height: 1px;
            background: var(--accent);
        }

        .hero-title {
            font-family: var(--font-display);
            font-size: clamp(3.5rem, 9vw, 7.5rem);
            font-weight: 300;
            line-height: 1;
            letter-spacing: 0.02em;
            color: var(--white);
            margin-bottom: 0.5rem;
            opacity: 0;
            animation: fadeUp 1.2s 0.5s ease forwards;
        }

        .hero-title em {
            font-style: italic;
            color: var(--accent);
        }

        .hero-subtitle {
            font-family: var(--font-display);
            font-size: clamp(1rem, 2.5vw, 1.5rem);
            font-weight: 300;
            font-style: italic;
            color: rgba(255,255,255,0.6);
            margin-bottom: 2.5rem;
            opacity: 0;
            animation: fadeUp 1s 0.7s ease forwards;
        }

        .hero-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 1rem 2.5rem;
            border: 1px solid rgba(200,169,110,0.5);
            color: var(--accent);
            font-family: var(--font-body);
            font-size: 0.75rem;
            font-weight: 300;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.35s ease;
            opacity: 0;
            animation: fadeUp 1s 0.9s ease forwards;
        }

        .hero-btn:hover {
            background: var(--accent);
            color: #0a0a0a;
            border-color: var(--accent);
        }

        .hero-scroll {
            position: absolute;
            bottom: 2.5rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            z-index: 10;
            opacity: 0;
            animation: fadeIn 1s 1.4s ease forwards;
        }

        .hero-scroll span {
            font-size: 0.6rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.35);
        }

        .scroll-line {
            width: 1px;
            height: 50px;
            background: linear-gradient(to bottom, rgba(200,169,110,0.6), transparent);
            animation: scrollPulse 2s ease infinite;
        }

        @keyframes scrollPulse {
            0%, 100% { opacity: 0.4; transform: scaleY(1); }
            50% { opacity: 1; transform: scaleY(1.1); }
        }

        /* ══════════════════════════════════
           SECTION 2 — WHAT IS IT
        ══════════════════════════════════ */
        .section-what {
            padding: 8rem 3.5rem;
            max-width: 1100px;
            margin: 0 auto;
        }

        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.9s ease, transform 0.9s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 0.7rem;
            font-size: 0.65rem;
            font-weight: 400;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 1.5rem;
        }

        .section-label::before {
            content: '';
            display: block;
            width: 24px; height: 1px;
            background: var(--accent);
        }

        .section-title {
            font-family: var(--font-display);
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 300;
            line-height: 1.15;
            color: var(--white);
            margin-bottom: 1.5rem;
        }

        .section-title em {
            font-style: italic;
            color: var(--accent);
        }

        .section-desc {
            font-size: 0.95rem;
            font-weight: 200;
            line-height: 1.9;
            color: rgba(255,255,255,0.5);
            max-width: 560px;
            margin-bottom: 4rem;
        }

        /* Feature Cards */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.2rem;
        }

        .feat-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 18px;
            padding: 1.8rem 1.5rem;
            transition: background 0.3s ease, border-color 0.3s ease, transform 0.3s ease;
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease, background 0.3s ease, border-color 0.3s ease;
        }

        .feat-card.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .feat-card:hover {
            background: rgba(200,169,110,0.05);
            border-color: rgba(200,169,110,0.2);
            transform: translateY(-4px);
        }

        .feat-icon {
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }

        .feat-title {
            font-family: var(--font-display);
            font-size: 1.15rem;
            font-weight: 400;
            color: var(--white);
            margin-bottom: 0.5rem;
        }

        .feat-desc {
            font-size: 0.75rem;
            font-weight: 300;
            line-height: 1.7;
            color: rgba(255,255,255,0.4);
        }

        /* Divider */
        /*.divider {*/
        /*    width: 100%;*/
        /*    height: 1px;*/
        /*    background: linear-gradient(to right, transparent, rgba(200,169,110,0.3), transparent);*/
        /*    margin: 0 3.5rem;*/
        /*}*/

        /* ══════════════════════════════════
           SECTION 3 — EXAMPLES (placeholder)
        ══════════════════════════════════ */
        .section-examples {
            padding: 8rem 3.5rem;
            max-width: 1100px;
            margin: 0 auto;
            text-align: center;
        }

        .examples-placeholder {
            margin-top: 3rem;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .example-card {
            aspect-ratio: 9/16;
            background: rgba(255,255,255,0.03);
            border: 1px dashed rgba(255,255,255,0.1);
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            color: rgba(255,255,255,0.2);
            font-size: 0.72rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .example-card.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .example-card-icon {
            font-size: 2rem;
            opacity: 0.3;
        }

        /* ══════════════════════════════════
           SECTION 4 — CTA BOTTOM
        ══════════════════════════════════ */
        .section-cta {
            padding: 8rem 3.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .section-cta::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at center, rgba(200,169,110,0.06) 0%, transparent 70%);
            pointer-events: none;
        }

        .cta-title {
            font-family: var(--font-display);
            font-size: clamp(2.5rem, 5vw, 4.5rem);
            font-weight: 300;
            line-height: 1.1;
            color: var(--white);
            margin-bottom: 1.2rem;
        }

        .cta-title em {
            font-style: italic;
            color: var(--accent);
        }

        .cta-sub {
            font-size: 0.9rem;
            font-weight: 200;
            color: rgba(255,255,255,0.45);
            margin-bottom: 3rem;
            letter-spacing: 0.05em;
        }

        .cta-btns {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .btn-gold {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 1rem 2.5rem;
            background: var(--accent);
            color: #0a0a0a;
            font-family: var(--font-body);
            font-size: 0.78rem;
            font-weight: 400;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            text-decoration: none;
            clip-path: polygon(0 0, calc(100% - 10px) 0, 100% 10px, 100% 100%, 10px 100%, 0 calc(100% - 10px));
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .btn-gold:hover {
            background: var(--white);
            transform: translateY(-2px);
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2.5rem;
            border: 1px solid rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.6);
            font-family: var(--font-body);
            font-size: 0.78rem;
            font-weight: 300;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        /* Footer */
        .page-footer {
            padding: 2rem 3.5rem;
            border-top: 1px solid rgba(255,255,255,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .page-footer span {
            font-size: 0.68rem;
            color: rgba(255,255,255,0.2);
            letter-spacing: 0.1em;
        }

        .page-footer a {
            font-size: 0.68rem;
            color: rgba(255,255,255,0.2);
            text-decoration: none;
            letter-spacing: 0.1em;
            transition: color 0.3s ease;
        }

        .page-footer a:hover { color: var(--accent); }
        
        /* ── Back to Top ── */
.back-to-top {
    position: fixed;
    bottom: 2.5rem;
    right: 2.5rem;
    width: 48px; height: 48px;
    background: rgba(10,10,10,0.7);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(200,169,110,0.3);
    border-radius: 50%;
    color: var(--accent);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 400;
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.35s ease, transform 0.35s ease, background 0.25s ease, border-color 0.25s ease;
    pointer-events: none;
}

.back-to-top.visible {
    opacity: 1;
    transform: translateY(0);
    pointer-events: all;
}

.back-to-top:hover {
    background: var(--accent);
    color: #0a0a0a;
    border-color: var(--accent);
    transform: translateY(-3px);
}

@media (max-width: 768px) {
    .back-to-top {
        width: 38px; height: 38px;
        bottom: max(1.5rem, env(safe-area-inset-bottom) + 0.8rem);
        right: 1.2rem;
    }

    .back-to-top svg {
        width: 14px; height: 14px;
    }
}

        /* ── Keyframes ── */
        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }

        /* ── Responsive ── */
/* ── Mobile Menu Button ── */
.mobile-wed-btn {
    display: none;
    background: none;
    border: none;
    cursor: pointer;
    padding: 0.5rem;
}

.mobile-wed-btn span {
    display: block;
    width: 22px; height: 1.5px;
    background: var(--white);
    margin: 5px 0;
    transition: all 0.3s ease;
    transform-origin: center;
}

.mobile-wed-btn.open span:nth-child(1) { transform: translateY(6.5px) rotate(45deg); }
.mobile-wed-btn.open span:nth-child(2) { opacity: 0; }
.mobile-wed-btn.open span:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); }

/* ── Mobile Drawer ── */
.wed-mobile-nav {
    display: none;
    position: fixed; inset: 0;
    z-index: 600; pointer-events: none;
}

.wed-mobile-backdrop {
    position: absolute; inset: 0;
    background: rgba(0,0,0,0.6);
    opacity: 0; transition: opacity 0.35s ease;
    backdrop-filter: blur(4px);
}

.wed-mobile-drawer {
    position: absolute; top: 0; right: 0;
    width: min(300px, 85vw); height: 100%;
    background: rgba(10,10,10,0.6);
    backdrop-filter: blur(20px);
    border-left: 1px solid rgba(255,255,255,0.06);
    padding: max(5rem, env(safe-area-inset-top) + 3.5rem) 2rem max(2rem, env(safe-area-inset-bottom) + 1rem);
    transform: translateX(100%);
    transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    display: flex; flex-direction: column; gap: 0;
}

.wed-mobile-nav.open { pointer-events: all; }
.wed-mobile-nav.open .wed-mobile-backdrop { opacity: 1; }
.wed-mobile-nav.open .wed-mobile-drawer { transform: translateX(0); }

.wed-mobile-link {
    display: flex; align-items: center; justify-content: space-between;
    padding: 1.2rem 0;
    border-bottom: 1px solid rgba(255,255,255,0.05);
    font-family: var(--font-display);
    font-size: 1.1rem; font-weight: 300;
    color: rgba(255,255,255,0.7);
    text-decoration: none;
    transition: color 0.25s ease;
}

.wed-mobile-link:hover { color: var(--accent); }

.wed-mobile-bottom {
    margin-top: auto;
    display: flex; flex-direction: column; gap: 1rem;
}

.wed-mobile-cta {
    display: flex; align-items: center; justify-content: center;
    padding: 0.9rem;
    background: var(--accent); color: #0a0a0a;
    font-size: 0.75rem; font-weight: 400;
    letter-spacing: 0.15em; text-transform: uppercase;
    text-decoration: none;
    clip-path: polygon(0 0, calc(100% - 8px) 0, 100% 8px, 100% 100%, 8px 100%, 0 calc(100% - 8px));
    transition: background 0.3s ease;
}

.wed-mobile-cta:hover { background: var(--white); }

.ios-wed-hint {
    display: none; align-items: center; gap: 0.5rem;
    padding: 0.8rem 1rem;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 10px;
    font-size: 0.68rem; color: rgba(255,255,255,0.4); line-height: 1.5;
}

.ios-wed-hint strong { color: var(--accent); font-weight: 400; }

@media (max-width: 768px) {
    body { cursor: auto; }
    .cursor, .cursor-ring { display: none; }

    .nav {
        padding: 1rem 1.5rem;
        padding-top: max(1rem, env(safe-area-inset-top) + 0.8rem);
        padding-left: max(1.5rem, env(safe-area-inset-left));
        padding-right: max(1.5rem, env(safe-area-inset-right));
    }

    .nav-cta { display: none; }
    .mobile-wed-btn { display: block; }
    .wed-mobile-nav { display: block; }

    .hero { height: 100svh; }
    .hero-title { font-size: clamp(3rem, 12vw, 5rem); }
    .hero-subtitle { font-size: clamp(0.9rem, 3vw, 1.2rem); }
    .hero-btn { padding: 0.85rem 1.8rem; font-size: 0.7rem; }

    .hero-scroll {
        bottom: max(2rem, env(safe-area-inset-bottom) + 1rem);
    }

    .section-what, .section-examples, .section-cta {
        padding: 5rem 1.5rem;
        padding-left: max(1.5rem, env(safe-area-inset-left));
        padding-right: max(1.5rem, env(safe-area-inset-right));
    }

    .features-grid { grid-template-columns: 1fr 1fr; gap: 0.8rem; }
    .feat-card { padding: 1.2rem 1rem; }
    .feat-icon { font-size: 1.4rem; margin-bottom: 0.6rem; }
    .feat-title { font-size: 1rem; }
    .feat-desc { font-size: 0.7rem; }

    .examples-placeholder { grid-template-columns: 1fr; }
    .example-card { aspect-ratio: 3/4; }

    .cta-btns { flex-direction: column; align-items: stretch; }
    .btn-gold, .btn-outline { justify-content: center; }

    .page-footer {
        flex-direction: column; gap: 0.8rem; text-align: center;
        padding: 1.5rem;
        padding-bottom: max(1.5rem, env(safe-area-inset-bottom) + 0.5rem);
    }

    .section-title { font-size: clamp(2rem, 8vw, 3rem); }
    .cta-title { font-size: clamp(2rem, 8vw, 3.5rem); }
}
    </style>
</head>
<body>

    <div class="cursor" id="cursor"></div>
    <div class="cursor-ring" id="cursorRing"></div>

    <!-- NAV -->
<nav class="nav">
    <a href="/" class="nav-logo">
        <img src="/public/images/gtech-icon.png" alt="GTechFusion">
        <span>-Tech</span><span style="color:var(--accent)">Fusion</span>
    </a>
    <a href="#reserve" class="nav-cta">Reserve Now</a>
    <button class="mobile-wed-btn" id="wedMenuBtn" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>
</nav>

<!-- Mobile Nav -->
<div class="wed-mobile-nav" id="wedMobileNav">
    <div class="wed-mobile-backdrop" id="wedBackdrop"></div>
    <div class="wed-mobile-drawer">
        <a href="#about" class="wed-mobile-link" id="wedAboutLink">
            Features
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
        <a href="#" class="wed-mobile-link" id="wedExamplesLink">
            Examples
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
        <a href="/" class="wed-mobile-link">
            ← Back to Home
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
        <div class="wed-mobile-bottom">
            <a href="https://wa.me/60187882609" target="_blank" class="wed-mobile-cta">
                Book via WhatsApp →
            </a>
            <div class="ios-wed-hint" id="iosWedHint">
                <span>📲</span>
                <span>Tap <strong>Share ⬆️</strong> then <strong>Add to Home Screen</strong></span>
            </div>
        </div>
    </div>
</div>

    <!-- ══ SECTION 1: HERO ══ -->
    <section class="hero" id="hero">
        <div class="hero-bg" id="heroBg"></div>
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <div class="hero-tag">GTechFusion Presents</div>
            <h1 class="hero-title">
                E-Wedding<br><em>Card</em>
            </h1>
            <p class="hero-subtitle">Your love story, beautifully digital.</p>
            <a href="#about" class="hero-btn">
                Discover More
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12l7 7 7-7"/>
                </svg>
            </a>
        </div>

        <div class="hero-scroll">
            <span>Scroll</span>
            <div class="scroll-line"></div>
        </div>
    </section>

    <!-- ══ SECTION 2: WHAT IS IT ══ -->
    <section class="section-what" id="about">

        <div class="reveal">
            <div class="section-label">What You Get</div>
            <h2 class="section-title">
                More Than Just<br>an <em>Invitation</em>
            </h2>
            <p class="section-desc">
                A fully digital wedding card experience — beautifully designed, instantly shareable, and packed with features that make your big day even more memorable.
            </p>
        </div>

        <div class="features-grid">
            <div class="feat-card" style="transition-delay: 0s">
                <div class="feat-icon">🗺️</div>
                <div class="feat-title">Digital Address</div>
                <div class="feat-desc">Interactive Google Maps integration so your guests never get lost finding the venue.</div>
            </div>
            <div class="feat-card" style="transition-delay: 0.1s">
                <div class="feat-icon">🏛️</div>
                <div class="feat-title">Venue Details</div>
                <div class="feat-desc">Full venue info, hall name, dress code, and everything guests need to know.</div>
            </div>
            <div class="feat-card" style="transition-delay: 0.2s">
                <div class="feat-icon">🕐</div>
                <div class="feat-title">Date & Time</div>
                <div class="feat-desc">Countdown timer to your big day, with date and time displayed in elegant style.</div>
            </div>
            <div class="feat-card" style="transition-delay: 0.3s">
                <div class="feat-icon">💬</div>
                <div class="feat-title">Live Wishes</div>
                <div class="feat-desc">Real-time guest wishes feed — messages appear live as your guests send them.</div>
            </div>
            <div class="feat-card" style="transition-delay: 0.4s">
                <div class="feat-icon">🔔</div>
                <div class="feat-title">Wish Notifications</div>
                <div class="feat-desc">Get instant notifications every time a guest sends a heartfelt message to you.</div>
            </div>
            <div class="feat-card" style="transition-delay: 0.5s">
                <div class="feat-icon">📱</div>
                <div class="feat-title">Share Anywhere</div>
                <div class="feat-desc">One link to share on WhatsApp, Instagram, or anywhere — works on all devices.</div>
            </div>
        </div>

    </section>

    <!--<div class="divider reveal"></div>-->

    <!-- ══ SECTION 3: EXAMPLES ══ -->
    <section class="section-examples">
        <div class="reveal">
            <div class="section-label">Our Work</div>
            <h2 class="section-title">
                See It In <em>Action</em>
            </h2>
            <p class="section-desc" style="margin: 0 auto 1rem; text-align:center;">
                Real wedding cards crafted with love. More examples coming soon.
            </p>
        </div>

        <div class="examples-placeholder">
            <div class="example-card" style="transition-delay: 0s">
                <div class="example-card-icon">💌</div>
                <span>Example coming soon</span>
            </div>
            <div class="example-card" style="transition-delay: 0.15s">
                <div class="example-card-icon">💌</div>
                <span>Example coming soon</span>
            </div>
            <div class="example-card" style="transition-delay: 0.3s">
                <div class="example-card-icon">💌</div>
                <span>Example coming soon</span>
            </div>
        </div>
    </section>

    <!--<div class="divider reveal"></div>-->

    <!-- ══ SECTION 4: CTA ══ -->
    <section class="section-cta reveal" id="reserve">
        <div class="section-label" style="justify-content:center; margin-bottom:1.5rem;">Reserve Your Slot</div>
        <h2 class="cta-title">
            Ready to Make It<br><em>Unforgettable?</em>
        </h2>
        <p class="cta-sub">Limited slots available. Book your e-wedding card today.</p>
        <div class="cta-btns">
            <a href="https://wa.me/60187882609" target="_blank" class="btn-gold">
                Book via WhatsApp
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
            <a href="mailto:system@gtechfusion.com" class="btn-outline">
                Send Us an Email
            </a>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="page-footer">
        <span>© {{ date('Y') }} GTechFusion. All rights reserved.</span>
        <a href="/">← Back to Home</a>
    </footer>
    
    <!-- Back to Top Button -->
<button class="back-to-top" id="backToTop" aria-label="Back to top">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M12 19V5M5 12l7-7 7 7"/>
    </svg>
</button>

    <script>
        // ── Cursor ──
        const cursor     = document.getElementById('cursor');
        const cursorRing = document.getElementById('cursorRing');
        let ringX = window.innerWidth / 2, ringY = window.innerHeight / 2;
        let mouseX = ringX, mouseY = ringY;

        document.addEventListener('mousemove', e => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            cursor.style.left = mouseX + 'px';
            cursor.style.top  = mouseY + 'px';
        });

        (function animateRing() {
            ringX += (mouseX - ringX) * 0.1;
            ringY += (mouseY - ringY) * 0.1;
            cursorRing.style.left = ringX + 'px';
            cursorRing.style.top  = ringY + 'px';
            requestAnimationFrame(animateRing);
        })();

        // ── Hero Parallax ──
        const heroBg = document.getElementById('heroBg');
        document.addEventListener('mousemove', e => {
            const xRatio = (e.clientX / window.innerWidth)  - 0.5;
            const yRatio = (e.clientY / window.innerHeight) - 0.5;
            heroBg.style.transform = `translate(${xRatio * 18}px, ${yRatio * 18}px)`;
        });

        // ── Scroll Parallax on hero ──
        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            heroBg.style.transform = `translateY(${scrollY * 0.4}px)`;
        });

        // ── Scroll Reveal ──
        const reveals    = document.querySelectorAll('.reveal');
        const featCards  = document.querySelectorAll('.feat-card');
        const exCards    = document.querySelectorAll('.example-card');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.15 });

        reveals.forEach(el => observer.observe(el));
        featCards.forEach(el => observer.observe(el));
        exCards.forEach(el => observer.observe(el));
        
        // ── Back to Top ──
const backToTop = document.getElementById('backToTop');
const footer    = document.querySelector('.page-footer');

const footerObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            backToTop.classList.add('visible');
        } else {
            // Hide when scrolled back to top
            if (window.scrollY < 300) {
                backToTop.classList.remove('visible');
            }
        }
    });
}, { threshold: 0.1 });

footerObserver.observe(footer);

// Also show after scrolling past hero
window.addEventListener('scroll', () => {
    if (window.scrollY > window.innerHeight * 0.8) {
        backToTop.classList.add('visible');
    } else {
        backToTop.classList.remove('visible');
    }
});

backToTop.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
    </script>
    
    <script>
    // ── Mobile Nav Wedding Page ──
    const wedMenuBtn    = document.getElementById('wedMenuBtn');
    const wedMobileNav  = document.getElementById('wedMobileNav');
    const wedBackdrop   = document.getElementById('wedBackdrop');
    const wedAboutLink  = document.getElementById('wedAboutLink');
    const wedExamplesLink = document.getElementById('wedExamplesLink');

    function openWedMenu() {
        wedMenuBtn.classList.add('open');
        wedMobileNav.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeWedMenu() {
        wedMenuBtn.classList.remove('open');
        wedMobileNav.classList.remove('open');
        document.body.style.overflow = '';
    }

    wedMenuBtn.addEventListener('click', e => {
        e.stopPropagation();
        wedMobileNav.classList.contains('open') ? closeWedMenu() : openWedMenu();
    });

    wedBackdrop.addEventListener('click', closeWedMenu);

    // Close menu when nav links clicked
    [wedAboutLink, wedExamplesLink].forEach(link => {
        link.addEventListener('click', closeWedMenu);
    });

    // iOS hint
    const isIOS = /iphone|ipad|ipod/i.test(navigator.userAgent);
    const isStandalone = window.navigator.standalone;
    const iosWedHint = document.getElementById('iosWedHint');
    if (isIOS && !isStandalone && iosWedHint) iosWedHint.style.display = 'flex';

    // Register service worker
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => navigator.serviceWorker.register('/sw.js').catch(() => {}));
    }
</script>

</body>
</html>