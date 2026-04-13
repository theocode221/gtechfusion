<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="theme-color" content="#0a0a0a">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="GTechFusion">
<link rel="apple-touch-icon" href="/public/images/gtech-icon.png">
    <title>{{ config('app.name', 'GTechFusion') }}</title>
    <link rel="icon" type="image/png" href="/public/images/gtech-icon.png">
    <link rel="shortcut icon" type="image/png" href="/public/images/gtech-icon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600&family=Outfit:wght@200;300;400&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --white: #ffffff;
            --white-dim: rgba(255, 255, 255, 0.55);
            --accent: #c8a96e;
            --font-display: 'Cormorant Garamond', serif;
            --font-body: 'Outfit', sans-serif;
        }

        html, body { 
    height: 100%; 
    height: 100dvh;
    overflow: hidden; 
}

        body {
            font-family: var(--font-body);
            font-weight: 300;
            background: #0a0a0a;
            color: var(--white);
            cursor: none;
        }
        
        html {
    background: #0a0a0a;
}

        .cursor {
            position: fixed; width: 8px; height: 8px;
            background: var(--accent); border-radius: 50%;
            pointer-events: none; z-index: 9999;
            transform: translate(-50%, -50%);
            transition: width 0.3s ease, height 0.3s ease;
        }

        .cursor-ring {
            position: fixed; width: 36px; height: 36px;
            border: 1px solid rgba(200, 169, 110, 0.5); border-radius: 50%;
            pointer-events: none; z-index: 9998;
            transform: translate(-50%, -50%);
            transition: width 0.3s ease, height 0.3s ease, opacity 0.3s ease;
        }

        .bg {
            position: fixed; inset: -60px;
            background-image: url('/public/images/welcome-bg.jpg');
            background-size: cover; background-position: center;
            background-repeat: no-repeat; will-change: transform;
        }

        .bg-overlay {
            position: fixed; inset: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0.72) 0%, rgba(0,0,0,0.40) 50%, rgba(0,0,0,0.68) 100%);
            pointer-events: none;
        }

        .bg-vignette {
            position: fixed; inset: 0;
            background: radial-gradient(ellipse at center, transparent 40%, rgba(0,0,0,0.6) 100%);
            pointer-events: none;
        }

        .bg-grain {
            position: fixed; inset: 0; opacity: 0.035;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
            background-size: 200px 200px; pointer-events: none;
        }

.page {
    position: relative; z-index: 10; 
    height: 100vh; height: 100dvh;
    display: grid; grid-template-rows: auto 1fr auto;
    padding: 2.5rem 3.5rem;
    padding-top: max(2.5rem, env(safe-area-inset-top) + 1rem);
    padding-bottom: env(safe-area-inset-bottom);
}

        nav {
            display: flex; align-items: center; justify-content: space-between;
            opacity: 0; transform: translateY(-16px);
            animation: fadeUp 0.9s 0.2s ease forwards;
        }

        .logo {
            font-family: var(--font-display); font-size: 1.5rem; font-weight: 600;
            letter-spacing: 0.04em; color: var(--white); text-decoration: none;
            display: inline-flex; align-items: center; gap: 0rem;
        }

        .logo img { width: 42px; height: 42px; object-fit: contain; }
        .logo span { color: var(--accent); }
        .logo .logo-text { color: var(--white); }
        .logo .logo-accent { color: var(--accent); }

        .nav-links { display: flex; gap: 2.5rem; list-style: none; }

        .nav-links a {
            font-size: 0.78rem; font-weight: 300; letter-spacing: 0.18em;
            text-transform: uppercase; color: var(--white-dim);
            text-decoration: none; transition: color 0.3s ease; position: relative;
        }

        .nav-links a::after {
            content: ''; position: absolute; bottom: -3px; left: 0;
            width: 0; height: 1px; background: var(--accent); transition: width 0.3s ease;
        }

        .nav-links a:hover { color: var(--white); }
        .nav-links a:hover::after { width: 100%; }

        .hero {
            display: flex; flex-direction: column;
            justify-content: center; align-items: flex-start; max-width: 780px;
        }

        .hero-tag {
            display: inline-flex; align-items: center; gap: 0.6rem;
            font-size: 0.7rem; font-weight: 400; letter-spacing: 0.25em;
            text-transform: uppercase; color: var(--accent); margin-bottom: 1.8rem;
            opacity: 0; animation: fadeUp 0.9s 0.5s ease forwards;
        }

        .hero-tag::before { content: ''; display: block; width: 28px; height: 1px; background: var(--accent); }

        .hero-title {
            font-family: var(--font-display); font-size: clamp(3.2rem, 7vw, 6rem);
            font-weight: 300; line-height: 1.08; letter-spacing: -0.01em;
            color: var(--white); margin-bottom: 1.6rem;
            opacity: 0; animation: fadeUp 1s 0.7s ease forwards;
        }

        .hero-title em { font-style: italic; color: var(--accent); }

        .hero-sub {
            font-size: 0.95rem; font-weight: 200; line-height: 1.75;
            color: var(--white-dim); max-width: 460px; margin-bottom: 3rem;
            opacity: 0; animation: fadeUp 0.9s 0.9s ease forwards;
        }

        .hero-actions {
            display: flex; align-items: center; gap: 2rem;
            opacity: 0; animation: fadeUp 0.9s 1.1s ease forwards;
        }

        .btn-primary {
            display: inline-flex; align-items: center; gap: 0.6rem;
            padding: 0.9rem 2.2rem; background: var(--accent); color: #0a0a0a;
            font-family: var(--font-body); font-size: 0.78rem; font-weight: 400;
            letter-spacing: 0.15em; text-transform: uppercase; text-decoration: none;
            transition: all 0.3s ease;
            clip-path: polygon(0 0, calc(100% - 10px) 0, 100% 10px, 100% 100%, 10px 100%, 0 calc(100% - 10px));
        }

        .btn-primary:hover { background: var(--white); transform: translateY(-2px); }

        .btn-ghost {
            display: inline-flex; align-items: center; gap: 0.5rem;
            font-size: 0.78rem; font-weight: 300; letter-spacing: 0.15em;
            text-transform: uppercase; color: var(--white-dim);
            text-decoration: none; transition: color 0.3s ease;
        }

        .btn-ghost svg { transition: transform 0.3s ease; }
        .btn-ghost:hover { color: var(--white); }
        .btn-ghost:hover svg { transform: translateX(4px); }

        footer {
            display: flex; align-items: center; justify-content: space-between;
            opacity: 0; animation: fadeUp 0.9s 1.3s ease forwards;
        }
        
/*        @supports (padding-bottom: env(safe-area-inset-bottom)) {*/
/*    footer {*/
/*        padding-bottom: env(safe-area-inset-bottom);*/
/*    }*/
/*}*/

        .footer-left { font-size: 0.72rem; font-weight: 300; letter-spacing: 0.1em; color: rgba(255,255,255,0.3); }

        .social-links { display: flex; gap: 1.5rem; }

        .social-links a {
            font-size: 0.7rem; font-weight: 300; letter-spacing: 0.18em;
            text-transform: uppercase; color: rgba(255,255,255,0.3);
            text-decoration: none; transition: color 0.3s ease;
        }

        .social-links a:hover { color: var(--accent); }

        .deco-line {
            position: fixed; right: 3.5rem; top: 50%; transform: translateY(-50%);
            display: flex; flex-direction: column; align-items: center; gap: 1rem;
            z-index: 20; opacity: 0; animation: fadeIn 1s 1.5s ease forwards;
        }

        .deco-line::before, .deco-line::after {
            content: ''; display: block; width: 1px; height: 60px;
            background: rgba(255,255,255,0.15);
        }

        .deco-scroll {
            writing-mode: vertical-rl; font-size: 0.62rem; font-weight: 300;
            letter-spacing: 0.25em; text-transform: uppercase; color: rgba(255,255,255,0.3);
        }

        /* ── Services Dropdown ── */
        .nav-services { position: relative; list-style: none; }

        .nav-services > a {
            font-size: 0.78rem; font-weight: 300; letter-spacing: 0.18em;
            text-transform: uppercase; color: var(--white-dim);
            text-decoration: none; transition: color 0.3s ease; position: relative; cursor: pointer;
        }

        .nav-services > a::after {
            content: ''; position: absolute; bottom: -3px; left: 0;
            width: 0; height: 1px; background: var(--accent); transition: width 0.3s ease;
        }

        .nav-services > a:hover { color: var(--white); }
        .nav-services > a:hover::after { width: 100%; }

        .services-dropdown {
            position: absolute; top: calc(100% + 16px); left: 50%; transform: translateX(-50%);
            background: rgba(10, 10, 10, 0.15); backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px; padding: 0.5rem; min-width: 290px;
            opacity: 0; visibility: hidden; pointer-events: none;
            transition: opacity 0.25s ease, visibility 0.25s ease; z-index: 999;
        }

        .services-dropdown.open { opacity: 1; visibility: visible; pointer-events: all; }

        .sdrop-item {
            display: flex; align-items: center; gap: 1rem; padding: 0.85rem 1rem;
            border-radius: 10px; cursor: pointer; opacity: 0; transform: translateY(8px);
            transition: background 0.2s ease;
        }

        .sdrop-item.revealed { animation: sdropReveal 0.7s ease forwards; }
        .sdrop-item:hover { background: rgba(255,255,255,0.06); }

        .sdrop-icon {
            font-size: 1.3rem; width: 36px; height: 36px;
            display: flex; align-items: center; justify-content: center;
            background: rgba(255,255,255,0.05); border-radius: 10px; flex-shrink: 0;
        }

        .sdrop-text { display: flex; flex-direction: column; gap: 0.2rem; }
        .sdrop-title { font-size: 0.82rem; font-weight: 400; color: var(--white); letter-spacing: 0.02em; }
        .sdrop-sub { font-size: 0.68rem; font-weight: 300; color: rgba(255,255,255,0.4); letter-spacing: 0.02em; }

        @keyframes sdropReveal { to { opacity: 1; transform: translateY(0); } }

        /* ── Contact Modals ── */
        .contact-modals { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 100; }

        .cmodal { position: fixed; right: 7rem; pointer-events: none; opacity: 0; transition: none; }
        .cmodal.active { pointer-events: all; }

        .cmodal-inner {
            display: flex; align-items: center; gap: 1rem;
            background: rgba(10, 10, 10, 0.35); backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px; padding: 1rem 1.4rem; min-width: 340px;
            box-shadow: 0 24px 60px rgba(0,0,0,0.5); white-space: nowrap;
        }

        .cmodal-avatar {
            width: 42px; height: 42px; border-radius: 50%;
            background: linear-gradient(135deg, #8b1a1a, #c8a96e);
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-display); font-size: 1.1rem; font-weight: 600;
            color: white; flex-shrink: 0;
        }

        .cmodal-info { display: flex; flex-direction: column; gap: 0.3rem; }
        .cmodal-name { font-size: 0.85rem; font-weight: 400; color: var(--white); letter-spacing: 0.02em; }

        .cmodal-detail {
            display: flex; align-items: center; gap: 0.4rem;
            font-size: 0.72rem; font-weight: 300; color: rgba(255,255,255,0.5);
            text-decoration: none; transition: color 0.2s ease; letter-spacing: 0.02em;
        }

        .cmodal-detail:hover { color: var(--accent); }
        .cmodal-social { gap: 0.6rem; flex-wrap: wrap; min-width: 340px; }

        .social-pill {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.45rem 1rem; border: 1px solid rgba(255,255,255,0.12);
            border-radius: 999px; font-size: 0.75rem; font-weight: 300;
            letter-spacing: 0.1em; color: rgba(255,255,255,0.6);
            text-decoration: none; transition: all 0.25s ease;
        }

        .social-pill:hover { border-color: var(--accent); color: var(--accent); background: rgba(200,169,110,0.08); }
        
        /* ── Mobile Contact Modal ── */
.mob-contact-overlay {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 800;
    background: rgba(0,0,0,0.5);
    backdrop-filter: blur(6px);
    align-items: flex-end;
    justify-content: center;
}

.mob-contact-overlay.show {
    display: flex;
    animation: overlayFadeIn 0.3s ease forwards;
}

@keyframes overlayFadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.mob-contact-sheet {
    width: 100%;
    max-width: 480px;
    background: rgba(12,12,12,0.85);
    backdrop-filter: blur(24px);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 24px 24px 0 0;
    padding: 1.2rem 1.5rem;
    padding-bottom: max(1.5rem, env(safe-area-inset-bottom) + 1rem);
    transform: translateY(100%);
    animation: sheetSlideUp 0.45s cubic-bezier(0.34,1.56,0.64,1) forwards;
}

@keyframes sheetSlideUp {
    to { transform: translateY(0); }
}

.mob-sheet-header {
    text-align: center;
    margin-bottom: 1.5rem;
}

.mob-sheet-pill {
    width: 36px; height: 4px;
    background: rgba(255,255,255,0.15);
    border-radius: 99px;
    margin: 0 auto 1rem;
}

.mob-sheet-title {
    font-family: var(--font-display);
    font-size: 1.3rem;
    font-weight: 400;
    color: var(--white);
    margin-bottom: 0.3rem;
}

.mob-sheet-sub {
    font-size: 0.72rem;
    color: rgba(255,255,255,0.35);
    letter-spacing: 0.05em;
}

/* Social Cards */
.mob-social-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.9rem 1rem;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 14px;
    margin-bottom: 0.6rem;
    cursor: pointer;
    transition: all 0.25s ease;
    opacity: 0;
    transform: translateY(16px);
}

.mob-social-card.revealed {
    animation: cardReveal 0.4s ease forwards;
}

@keyframes cardReveal {
    to { opacity: 1; transform: translateY(0); }
}

.mob-social-card:hover, .mob-social-card:active {
    background: rgba(255,255,255,0.08);
    border-color: rgba(200,169,110,0.2);
    transform: translateY(-2px);
}

.mob-social-icon {
    width: 44px; height: 44px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}

.mob-social-text {
    display: flex; flex-direction: column; gap: 0.2rem; flex: 1;
}

.mob-social-name {
    font-size: 0.85rem; font-weight: 400; color: var(--white);
}

.mob-social-desc {
    font-size: 0.68rem; color: rgba(255,255,255,0.35);
}

.mob-social-arrow {
    color: rgba(255,255,255,0.2);
    flex-shrink: 0;
}

/* Contact Cards (Step 2) */
.mob-back-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.72rem;
    color: rgba(255,255,255,0.4);
    cursor: pointer;
    margin-bottom: 1rem;
    transition: color 0.2s ease;
}

.mob-back-btn:hover { color: var(--accent); }

.mob-step-label {
    font-size: 0.68rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.3);
    margin-bottom: 1rem;
}

.mob-contact-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 14px;
    margin-bottom: 0.6rem;
    cursor: pointer;
    transition: all 0.25s ease;
    opacity: 0;
    transform: translateY(12px);
    animation: cardReveal 0.4s ease forwards;
}

.mob-contact-card:nth-child(2) { animation-delay: 0.05s; }
.mob-contact-card:nth-child(3) { animation-delay: 0.1s; }

.mob-contact-card:hover, .mob-contact-card:active {
    background: rgba(37,211,102,0.06);
    border-color: rgba(37,211,102,0.2);
}

.mob-contact-avatar {
    width: 42px; height: 42px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-family: var(--font-display);
    font-size: 1.1rem; font-weight: 600;
    color: white; flex-shrink: 0;
}

.mob-contact-info {
    display: flex; flex-direction: column; gap: 0.2rem; flex: 1;
}

.mob-contact-name {
    font-size: 0.82rem; font-weight: 400; color: var(--white);
}

.mob-contact-num {
    font-size: 0.7rem; color: rgba(255,255,255,0.4);
}

.mob-wa-badge {
    display: flex; align-items: center; gap: 0.3rem;
    padding: 0.3rem 0.7rem;
    background: rgba(37,211,102,0.1);
    border: 1px solid rgba(37,211,102,0.2);
    border-radius: 999px;
    font-size: 0.65rem; color: #25d366;
}

        /* ── Animations ── */
        @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeIn { to { opacity: 1; } }

        /* ── Mobile hamburger ── */
        .mobile-menu-btn {
            display: none; flex-direction: column; gap: 5px;
            cursor: pointer; padding: 0.5rem; z-index: 200;
            background: none; border: none;
        }

        .mobile-menu-btn span {
            display: block; width: 24px; height: 1.5px;
            background: var(--white); transition: all 0.3s ease; transform-origin: center;
        }

        .mobile-menu-btn.open span:nth-child(1) { transform: translateY(6.5px) rotate(45deg); }
        .mobile-menu-btn.open span:nth-child(2) { opacity: 0; }
        .mobile-menu-btn.open span:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); }

        /* ── Mobile Nav Drawer ── */
        .mobile-nav { display: none; position: fixed; inset: 0; z-index: 150; pointer-events: none; }

        .mobile-nav-backdrop {
            position: absolute; inset: 0; background: rgba(0,0,0,0.6);
            opacity: 0; transition: opacity 0.35s ease; backdrop-filter: blur(4px);
        }

.mobile-nav-drawer {
    position: absolute; top: 0; right: 0;
    width: min(320px, 85vw); height: 100%;
    background: rgba(10,10,10,0.45); backdrop-filter: blur(20px);
    border-left: 1px solid rgba(255,255,255,0.06);
    padding: max(5rem, env(safe-area-inset-top) + 3.5rem) 2.5rem max(3rem, env(safe-area-inset-bottom) + 1.5rem);
            transform: translateX(100%);
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            display: flex; flex-direction: column; gap: 0;
        }

        .mobile-nav.open { pointer-events: all; }
        .mobile-nav.open .mobile-nav-backdrop { opacity: 1; }
        .mobile-nav.open .mobile-nav-drawer { transform: translateX(0); }

        .mobile-nav-link {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.2rem 0; border-bottom: 1px solid rgba(255,255,255,0.05);
            font-size: 1.1rem; font-weight: 300; font-family: var(--font-display);
            letter-spacing: 0.05em; color: rgba(255,255,255,0.7);
            text-decoration: none; transition: color 0.25s ease;
        }

        .mobile-nav-link:hover { color: var(--accent); }

        .mobile-nav-link svg { opacity: 0.3; transition: opacity 0.25s ease, transform 0.25s ease; }
        .mobile-nav-link:hover svg { opacity: 0.8; transform: translateX(4px); }

        .mobile-services-toggle {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.2rem 0; border-bottom: 1px solid rgba(255,255,255,0.05);
            font-size: 1.1rem; font-weight: 300; font-family: var(--font-display);
            letter-spacing: 0.05em; color: rgba(255,255,255,0.7);
            cursor: pointer; transition: color 0.25s ease;
        }

        .mobile-services-toggle.active { color: var(--accent); }
        .mobile-services-toggle .arrow { transition: transform 0.3s ease; opacity: 0.4; }
        .mobile-services-toggle.active .arrow { transform: rotate(90deg); opacity: 0.8; }

        .mobile-services-list { max-height: 0; overflow: hidden; transition: max-height 0.4s ease; }
        .mobile-services-list.open { max-height: 300px; }

        .mobile-service-item {
            display: flex; align-items: center; gap: 0.8rem;
            padding: 0.9rem 0 0.9rem 0.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.03);
            text-decoration: none; transition: all 0.2s ease;
        }

        .mobile-service-item:last-child { border-bottom: none; }

        .mobile-service-icon {
            font-size: 1.1rem; width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            background: rgba(255,255,255,0.04); border-radius: 8px; flex-shrink: 0;
        }

        .mobile-service-text { display: flex; flex-direction: column; gap: 0.1rem; }
        .mobile-service-title { font-size: 0.8rem; font-weight: 400; color: rgba(255,255,255,0.6); }
        .mobile-service-sub { font-size: 0.65rem; color: rgba(255,255,255,0.3); }
        .mobile-service-item:hover .mobile-service-title { color: var(--accent); }

        .mobile-nav-bottom { margin-top: auto; display: flex; flex-direction: column; gap: 1rem; }

        .mobile-contact-btn {
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            padding: 0.9rem; background: var(--accent); color: #0a0a0a;
            font-size: 0.75rem; font-weight: 400; letter-spacing: 0.15em;
            text-transform: uppercase; text-decoration: none;
            clip-path: polygon(0 0, calc(100% - 8px) 0, 100% 8px, 100% 100%, 8px 100%, 0 calc(100% - 8px));
            transition: background 0.3s ease;
        }

        .mobile-contact-btn:hover { background: var(--white); }

        .mobile-social-row { display: flex; gap: 1rem; justify-content: center; }

        .mobile-social-row a {
            font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase;
            color: rgba(255,255,255,0.25); text-decoration: none; transition: color 0.2s ease;
        }

        .mobile-social-row a:hover { color: var(--accent); }

        .ios-hint {
            display: none; align-items: center; gap: 0.5rem;
            padding: 0.8rem 1rem; background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08); border-radius: 10px;
            font-size: 0.68rem; color: rgba(255,255,255,0.4); line-height: 1.5;
        }

        .ios-hint strong { color: var(--accent); font-weight: 400; }

        /* ── PWA Banner ── */
        .pwa-banner {
            display: none; position: fixed;
            bottom: max(1.5rem, env(safe-area-inset-bottom) + 0.5rem);
            left: 1rem; right: 1rem; z-index: 300;
            background: rgba(10,10,10,0.88); backdrop-filter: blur(16px);
            border: 1px solid rgba(200,169,110,0.2); border-radius: 16px;
            padding: 1rem 1.2rem; align-items: center; gap: 1rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.5);
            animation: slideUp 0.5s ease forwards;
        }

        .pwa-banner.show { display: flex; }

        @keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        .pwa-banner-icon { width: 42px; height: 42px; border-radius: 10px; overflow: hidden; flex-shrink: 0; }
        .pwa-banner-icon img { width: 100%; height: 100%; object-fit: cover; }
        .pwa-banner-text { flex: 1; }
        .pwa-banner-title { font-size: 0.8rem; font-weight: 400; color: var(--white); }
        .pwa-banner-sub { font-size: 0.65rem; color: rgba(255,255,255,0.4); margin-top: 0.1rem; }

        .pwa-banner-btn {
            padding: 0.5rem 1rem; background: var(--accent); color: #0a0a0a;
            font-size: 0.7rem; font-weight: 400; letter-spacing: 0.08em;
            border: none; border-radius: 8px; cursor: pointer; white-space: nowrap;
            transition: background 0.2s ease;
        }

        .pwa-banner-btn:hover { background: var(--white); }
        .pwa-banner-close { background: none; border: none; color: rgba(255,255,255,0.3); font-size: 1.1rem; cursor: pointer; padding: 0.2rem; line-height: 1; }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .page {
                padding: 1.5rem;
                padding-top: max(1.5rem, env(safe-area-inset-top) + 1rem);
                padding-bottom: max(1.5rem, env(safe-area-inset-bottom) + 0.5rem);
                padding-left: max(1.5rem, env(safe-area-inset-left));
                padding-right: max(1.5rem, env(safe-area-inset-right));
            }
            .nav-links { display: none; }
            .mobile-menu-btn { display: flex; }
            .mobile-nav { display: block; }
            .deco-line { display: none; }
            .hero-title { font-size: clamp(2.8rem, 10vw, 3.5rem); }
            footer { flex-direction: column; gap: 1rem; align-items: flex-start; }
            body { cursor: auto; }
            .cursor, .cursor-ring { display: none; }
            .cmodal { right: 1rem; left: 1rem; }
            .cmodal-inner { min-width: unset; white-space: normal; }
        }
    </style>
</head>
<body>

    <div class="cursor" id="cursor"></div>
    <div class="cursor-ring" id="cursorRing"></div>

    <div class="bg" id="bg"></div>
    <div class="bg-overlay"></div>
    <div class="bg-vignette"></div>
    <div class="bg-grain"></div>

    <div class="page">

        <nav>
            <a href="/" class="logo">
                <img src="/public/images/gtech-icon.png" alt="GTechFusion Icon">
                <span class="logo-text">-Tech<span class="logo-accent">Fusion</span></span>
            </a>
            <ul class="nav-links">
                <li class="nav-services" id="servicesTrigger">
                    <a href="#">Services</a>
                    <div class="services-dropdown" id="servicesDropdown">
                        <div class="sdrop-item" onclick="window.location='/wedding-card'">
                            <div class="sdrop-icon">💌</div>
                            <div class="sdrop-text">
                                <span class="sdrop-title">Wedding Card Design</span>
                                <span class="sdrop-sub">E-digital invitation card</span>
                            </div>
                        </div>
                        <div class="sdrop-item">
                            <div class="sdrop-icon">📊</div>
                            <div class="sdrop-text">
                                <span class="sdrop-title">Attendance Dashboard</span>
                                <span class="sdrop-sub">With wish notification system</span>
                            </div>
                        </div>
                        <div class="sdrop-item">
                            <div class="sdrop-icon">🏨</div>
                            <div class="sdrop-text">
                                <span class="sdrop-title">Wedding Vendor Hub</span>
                                <span class="sdrop-sub">Traveloka-style marketplace</span>
                            </div>
                        </div>
                    </div>
                </li>
                <li><a href="#">Work</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#" id="contactTrigger">Contact</a></li>
            </ul>
            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>
        </nav>

        <!-- Mobile Nav Drawer -->
        <div class="mobile-nav" id="mobileNav">
            <div class="mobile-nav-backdrop" id="mobileNavBackdrop"></div>
            <div class="mobile-nav-drawer">
                <div class="mobile-services-toggle" id="mobileServicesToggle">
                    Services
                    <svg class="arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                </div>
                <div class="mobile-services-list" id="mobileServicesList">
                    <a href="/wedding-card" class="mobile-service-item">
                        <div class="mobile-service-icon">💌</div>
                        <div class="mobile-service-text">
                            <span class="mobile-service-title">Wedding Card Design</span>
                            <span class="mobile-service-sub">E-digital invitation card</span>
                        </div>
                    </a>
                    <a href="#" class="mobile-service-item">
                        <div class="mobile-service-icon">📊</div>
                        <div class="mobile-service-text">
                            <span class="mobile-service-title">Attendance Dashboard</span>
                            <span class="mobile-service-sub">With wish notification system</span>
                        </div>
                    </a>
                    <a href="#" class="mobile-service-item">
                        <div class="mobile-service-icon">🏨</div>
                        <div class="mobile-service-text">
                            <span class="mobile-service-title">Wedding Vendor Hub</span>
                            <span class="mobile-service-sub">Traveloka-style marketplace</span>
                        </div>
                    </a>
                </div>
                <a href="#" class="mobile-nav-link">Work <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="#" class="mobile-nav-link">About <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <div class="mobile-nav-bottom">
                    <button class="mobile-contact-btn" id="mobileContactBtn">Contact Us →</button>
                    <div class="mobile-social-row">
                        <a href="https://instagram.com/gtechfusion" target="_blank">Instagram</a>
                        <a href="https://threads.net/@gtechfusion" target="_blank">Threads</a>
                        <a href="https://wa.me/60187882609" target="_blank">WhatsApp</a>
                    </div>
                    <div class="ios-hint" id="iosHint">
                        <span>📲</span>
                        <span>Tap <strong>Share ⬆️</strong> then <strong>Add to Home Screen</strong> to install</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- PWA Banner -->
        <div class="pwa-banner" id="pwaBanner">
            <div class="pwa-banner-icon"><img src="/public/images/gtech-icon.png" alt="GTechFusion"></div>
            <div class="pwa-banner-text">
                <div class="pwa-banner-title">GTechFusion</div>
                <div class="pwa-banner-sub">Add to Home Screen for quick access</div>
            </div>
            <button class="pwa-banner-btn" id="pwaInstallBtn">Install</button>
            <button class="pwa-banner-close" id="pwaBannerClose">✕</button>
        </div>

        <section class="hero">
            <div class="hero-tag">Digital Innovation Studio</div>
            <h1 class="hero-title">Where Ideas<br>Meet <em>Precision</em></h1>
            <p class="hero-sub">We craft thoughtful digital experiences — blending technology and design to build products that are fast, beautiful, and built to last.</p>
            <div class="hero-actions">
                <a href="#" class="btn-primary">Get Started <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="#" class="btn-ghost">View Our Work <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
            </div>
        </section>

        <footer>
            <div class="footer-left">© {{ date('Y') }} GTechFusion. All rights reserved.</div>
            <div class="social-links">
                <a href="https://instagram.com/gtechfusion" target="_blank">Instagram</a>
                <a href="https://threads.net/@gtechfusion" target="_blank">Threads</a>
                <a href="https://wa.me/60187882609" target="_blank">WhatsApp</a>
            </div>
        </footer>

    </div>

    <div class="deco-line"><span class="deco-scroll">Scroll</span></div>

    <!-- Contact Modals -->
    <div class="contact-modals" id="contactModals">
        <div class="cmodal" id="modal1">
            <div class="cmodal-inner">
                <div class="cmodal-avatar">H</div>
                <div class="cmodal-info">
                    <div class="cmodal-name">Mr. Hafizi Hasbullah</div>
                    <a class="cmodal-detail" href="mailto:hafizihasbullah@gtechfusion.com">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        hafizihasbullah@gtechfusion.com
                    </a>
                    <a class="cmodal-detail" href="tel:+60187882609">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.4 2 2 0 0 1 3.6 1.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.78a16 16 0 0 0 6 6l.95-.95a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.73 16z"/></svg>
                        MY +60187882609
                    </a>
                </div>
            </div>
        </div>
        <div class="cmodal" id="modal2">
            <div class="cmodal-inner">
                <div class="cmodal-avatar" style="background: linear-gradient(135deg, #2a4a7f, #1a2f55);">H</div>
                <div class="cmodal-info">
                    <div class="cmodal-name">Mr. Haniff Rahim</div>
                    <a class="cmodal-detail" href="mailto:haniffrahim@gtechfusion.com">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        haniffrahim@gtechfusion.com
                    </a>
                    <a class="cmodal-detail" href="tel:+601133470207">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.4 2 2 0 0 1 3.6 1.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.78a16 16 0 0 0 6 6l.95-.95a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.73 16z"/></svg>
                        MY +601133470207
                    </a>
                </div>
            </div>
        </div>
        <div class="cmodal" id="modal3">
            <div class="cmodal-inner cmodal-social">
                <a class="social-pill" href="https://instagram.com/gtechfusion" target="_blank">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
                    Instagram
                </a>
                <a class="social-pill" href="https://threads.net/@gtechfusion" target="_blank">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/><path d="M8 12c0-2.21 1.79-4 4-4s4 1.79 4 4-1.79 4-4 4"/></svg>
                    Threads
                </a>
                <a class="social-pill" href="https://tiktok.com/@gtechfusion" target="_blank">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>
                    TikTok
                </a>
                <a class="social-pill" href="https://wa.me/60187882609" target="_blank">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                    WhatsApp
                </a>
            </div>
        </div>
    </div>
    
    <!-- Mobile Contact Modal -->
<div class="mob-contact-overlay" id="mobContactOverlay">
    <div class="mob-contact-sheet" id="mobContactSheet">

        <!-- Header -->
        <div class="mob-sheet-header">
            <div class="mob-sheet-pill"></div>
            <p class="mob-sheet-title">Get In Touch</p>
            <p class="mob-sheet-sub">Choose how you'd like to reach us</p>
        </div>

        <!-- Step 1: Social Cards -->
        <div class="mob-step" id="mobStep1">
            <div class="mob-social-card" id="mobWaCard">
                <div class="mob-social-icon" style="background: rgba(37,211,102,0.12); color: #25d366;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.124.558 4.122 1.532 5.855L.057 23.882l6.195-1.625A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.894a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.981 1-3.641-.235-.374A9.861 9.861 0 012.106 12C2.106 6.58 6.58 2.106 12 2.106S21.894 6.58 21.894 12 17.42 21.894 12 21.894z"/></svg>
                </div>
                <div class="mob-social-text">
                    <span class="mob-social-name">WhatsApp</span>
                    <span class="mob-social-desc">Chat with us directly</span>
                </div>
                <svg class="mob-social-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
            </div>
            <div class="mob-social-card" id="mobIgCard">
                <div class="mob-social-icon" style="background: rgba(225,48,108,0.12); color: #e1306c;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1.5" fill="currentColor" stroke="none"/></svg>
                </div>
                <div class="mob-social-text">
                    <span class="mob-social-name">Instagram</span>
                    <span class="mob-social-desc">Follow & message us</span>
                </div>
                <svg class="mob-social-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
            </div>
            <div class="mob-social-card" id="mobThreadCard">
                <div class="mob-social-icon" style="background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.8);">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M12.186 24h-.007c-3.581-.024-6.334-1.205-8.184-3.509C2.35 18.44 1.5 15.586 1.473 12.01v-.017c.027-3.579.877-6.43 2.525-8.482C5.845 1.205 8.6.024 12.18 0h.014c2.746.018 5.1.808 6.845 2.282 1.658 1.404 2.653 3.362 2.962 5.827l-2.485.338c-.527-3.95-3.019-6.013-7.322-6.042-2.979.02-5.026.968-6.262 2.898C4.708 6.99 4.109 9.3 4.087 12c.022 2.7.62 5.01 1.844 6.697 1.236 1.93 3.283 2.877 6.262 2.898h.006c2.677-.018 4.497-.735 5.613-2.19.97-1.261 1.468-3.12 1.484-5.527a7.686 7.686 0 00-.087-1.098c-.594.296-1.29.46-2.02.46-2.73 0-4.95-2.22-4.95-4.95 0-2.73 2.22-4.95 4.95-4.95s4.95 2.22 4.95 4.95c0 .398-.048.784-.137 1.153.332.98.501 2.05.501 3.152-.018 2.98-.669 5.336-1.937 7.001C18.68 21.178 15.797 24 12.186 24z"/></svg>
                </div>
                <div class="mob-social-text">
                    <span class="mob-social-name">Threads</span>
                    <span class="mob-social-desc">Follow our updates</span>
                </div>
                <svg class="mob-social-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
            </div>
            <div class="mob-social-card" id="mobTikCard">
                <div class="mob-social-icon" style="background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.8);">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.78 1.52V6.75a4.85 4.85 0 01-1.01-.06z"/></svg>
                </div>
                <div class="mob-social-text">
                    <span class="mob-social-name">TikTok</span>
                    <span class="mob-social-desc">Watch our content</span>
                </div>
                <svg class="mob-social-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
            </div>
        </div>

        <!-- Step 2: WhatsApp Contact Cards -->
        <div class="mob-step" id="mobStep2" style="display:none;">
            <div class="mob-back-btn" id="mobBackBtn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
                Back
            </div>
            <p class="mob-step-label">Choose a contact</p>
            <div class="mob-contact-card" onclick="window.open('https://wa.me/60187882609','_blank')">
                <div class="mob-contact-avatar" style="background: linear-gradient(135deg, #8b1a1a, #c8a96e);">H</div>
                <div class="mob-contact-info">
                    <span class="mob-contact-name">Mr. Hafizi Hasbullah</span>
                    <span class="mob-contact-num">+60 18-788 2609</span>
                </div>
                <div class="mob-wa-badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="#25d366"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.124.558 4.122 1.532 5.855L.057 23.882l6.195-1.625A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.894a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.981 1-3.641-.235-.374A9.861 9.861 0 012.106 12C2.106 6.58 6.58 2.106 12 2.106S21.894 6.58 21.894 12 17.42 21.894 12 21.894z"/></svg>
                    Chat
                </div>
            </div>
            <div class="mob-contact-card" onclick="window.open('https://wa.me/601133470207','_blank')">
                <div class="mob-contact-avatar" style="background: linear-gradient(135deg, #2a4a7f, #1a2f55);">H</div>
                <div class="mob-contact-info">
                    <span class="mob-contact-name">Mr. Haniff Rahim</span>
                    <span class="mob-contact-num">+60 11-3347 0207</span>
                </div>
                <div class="mob-wa-badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="#25d366"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.124.558 4.122 1.532 5.855L.057 23.882l6.195-1.625A11.945 11.945 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.894a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.981 1-3.641-.235-.374A9.861 9.861 0 012.106 12C2.106 6.58 6.58 2.106 12 2.106S21.894 6.58 21.894 12 17.42 21.894 12 21.894z"/></svg>
                    Chat
                </div>
            </div>
        </div>

    </div>
</div>

    <script>
        // ── Parallax + Zoom ──
        const bg = document.getElementById('bg');
        const cursor = document.getElementById('cursor');
        const cursorRing = document.getElementById('cursorRing');
        const STRENGTH = 20, ZOOM_START = 1.08, ZOOM_DUR = 2000;
        let mouseX = window.innerWidth/2, mouseY = window.innerHeight/2;
        let ringX = mouseX, ringY = mouseY;
        let offsetX = 0, offsetY = 0, targetX = 0, targetY = 0, startTime = null;

        function lerp(a,b,t){return a+(b-a)*t;}
        function easeOutCubic(t){return 1-Math.pow(1-t,3);}

        document.addEventListener('mousemove', e => {
            mouseX = e.clientX; mouseY = e.clientY;
            cursor.style.left = mouseX+'px'; cursor.style.top = mouseY+'px';
            targetX = ((mouseX/window.innerWidth)-0.5)*STRENGTH;
            targetY = ((mouseY/window.innerHeight)-0.5)*STRENGTH;
        });

        function animate(ts) {
            if(!startTime) startTime = ts;
            const progress = Math.min((ts-startTime)/ZOOM_DUR,1);
            const scale = ZOOM_START-(ZOOM_START-1.0)*easeOutCubic(progress);
            offsetX = lerp(offsetX,targetX,0.06);
            offsetY = lerp(offsetY,targetY,0.06);
            bg.style.transform = `scale(${scale}) translate(${offsetX/scale}px,${offsetY/scale}px)`;
            ringX = lerp(ringX,mouseX,0.1); ringY = lerp(ringY,mouseY,0.1);
            cursorRing.style.left = ringX+'px'; cursorRing.style.top = ringY+'px';
            requestAnimationFrame(animate);
        }
        requestAnimationFrame(animate);
    </script>

    <script>
        // ── Contact Modals ──
        document.addEventListener('DOMContentLoaded', function() {
            const trigger = document.getElementById('contactTrigger');
            const modals = [
                document.getElementById('modal1'),
                document.getElementById('modal2'),
                document.getElementById('modal3')
            ];
            if(!trigger || modals.some(m=>!m)) return;
            let step = 0;
            const GAP = 16, MODAL_H = 82;

            function animateModal(modal, fromY, toY) {
                modal.style.transition = 'none';
                modal.style.top = fromY+'px';
                modal.style.opacity = '0';
                modal.style.display = 'block';
                modal.getBoundingClientRect();
                modal.style.transition = 'top 0.6s cubic-bezier(0.34,1.56,0.64,1), opacity 0.4s ease';
                modal.style.top = toY+'px';
                modal.style.opacity = '1';
            }

            function showModal(index) {
                const rect = trigger.getBoundingClientRect();
                const fromY = rect.bottom;
                const centerY = window.innerHeight/2 - MODAL_H/2;
                const toYMap = [centerY-MODAL_H-GAP, centerY, centerY+MODAL_H+GAP];
                animateModal(modals[index], fromY, toYMap[index]);
            }

            function resetModals() {
                step = 0;
                modals.forEach(m => {
                    m.style.transition = 'opacity 0.25s ease';
                    m.style.opacity = '0';
                    setTimeout(()=>{m.style.display='none';}, 260);
                });
            }

            modals.forEach(m=>{m.style.display='none'; m.style.opacity='0';});

            document.addEventListener('click', function (e) {
                if(step===0){ if(!trigger.contains(e.target)) return; showModal(0); step=1; }
                else if(step===1){ showModal(1); step=2; }
                else if(step===2){ showModal(2); step=3; }
                else if(step===3){ resetModals(); }
            });
        });
    </script>

    <script>
        // ── Services Dropdown ──
        const servicesTrigger = document.getElementById('servicesTrigger');
        const servicesDropdown = document.getElementById('servicesDropdown');
        const sdropItems = servicesDropdown.querySelectorAll('.sdrop-item');
        let dropOpen = false;

        function openDropdown() {
            dropOpen = true;
            servicesDropdown.classList.add('open');
            sdropItems.forEach(item => { item.classList.remove('revealed'); item.style.opacity='0'; item.style.transform='translateY(8px)'; });
            sdropItems.forEach((item,i) => setTimeout(()=>item.classList.add('revealed'), i*200));
        }

        function closeDropdown() {
            dropOpen = false;
            servicesDropdown.classList.remove('open');
            sdropItems.forEach(item=>item.classList.remove('revealed'));
        }

        servicesTrigger.addEventListener('click', e=>{ e.stopPropagation(); dropOpen?closeDropdown():openDropdown(); });
        document.addEventListener('click', e=>{ if(!servicesTrigger.contains(e.target)) closeDropdown(); });
    </script>

    <script>
        // ── Mobile Menu ──
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileNav = document.getElementById('mobileNav');
        const mobileNavBackdrop = document.getElementById('mobileNavBackdrop');
        const mobileServicesTog = document.getElementById('mobileServicesToggle');
        const mobileServicesList = document.getElementById('mobileServicesList');

        mobileMenuBtn.addEventListener('click', e => {
            e.stopPropagation();
            const isOpen = mobileNav.classList.contains('open');
            isOpen ? closeMobileMenu() : openMobileMenu();
        });

        function openMobileMenu() {
            mobileMenuBtn.classList.add('open');
            mobileNav.classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileMenu() {
            mobileMenuBtn.classList.remove('open');
            mobileNav.classList.remove('open');
            document.body.style.overflow = '';
        }

        mobileNavBackdrop.addEventListener('click', closeMobileMenu);

        mobileServicesTog.addEventListener('click', () => {
            mobileServicesTog.classList.toggle('active');
            mobileServicesList.classList.toggle('open');
        });

        // iOS hint
        const isIOS = /iphone|ipad|ipod/i.test(navigator.userAgent);
        const isStandalone = window.navigator.standalone;
        const iosHint = document.getElementById('iosHint');
        if(isIOS && !isStandalone && iosHint) iosHint.style.display = 'flex';

        // PWA
        let deferredPrompt = null;
        const pwaBanner = document.getElementById('pwaBanner');
        const pwaInstallBtn = document.getElementById('pwaInstallBtn');
        const pwaBannerClose = document.getElementById('pwaBannerClose');

        window.addEventListener('beforeinstallprompt', e => {
            e.preventDefault();
            deferredPrompt = e;
            if(window.innerWidth <= 768) setTimeout(()=>pwaBanner.classList.add('show'), 3000);
        });

        pwaInstallBtn.addEventListener('click', async () => {
            if(!deferredPrompt) return;
            deferredPrompt.prompt();
            const {outcome} = await deferredPrompt.userChoice;
            deferredPrompt = null;
            pwaBanner.classList.remove('show');
        });

        pwaBannerClose.addEventListener('click', ()=>pwaBanner.classList.remove('show'));

        if('serviceWorker' in navigator) {
            window.addEventListener('load', ()=>navigator.serviceWorker.register('/sw.js').catch(()=>{}));
        }
        
        
        // ── Mobile Contact Modal ──
const mobileContactBtn   = document.getElementById('mobileContactBtn');
const mobContactOverlay  = document.getElementById('mobContactOverlay');
const mobStep1           = document.getElementById('mobStep1');
const mobStep2           = document.getElementById('mobStep2');
const mobWaCard          = document.getElementById('mobWaCard');
const mobIgCard          = document.getElementById('mobIgCard');
const mobThreadCard      = document.getElementById('mobThreadCard');
const mobTikCard         = document.getElementById('mobTikCard');
const mobBackBtn         = document.getElementById('mobBackBtn');
const socialCards        = document.querySelectorAll('.mob-social-card');

function openMobContact() {
    closeMobileMenu();
    mobContactOverlay.classList.add('show');
    document.body.style.overflow = 'hidden';
    // Animate cards one by one
    socialCards.forEach((card, i) => {
        card.classList.remove('revealed');
        card.style.opacity = '0';
        card.style.transform = 'translateY(16px)';
        setTimeout(() => card.classList.add('revealed'), i * 100);
    });
}

function closeMobContact() {
    mobContactOverlay.classList.remove('show');
    document.body.style.overflow = '';
    // Reset to step 1
    setTimeout(() => {
        mobStep1.style.display = 'block';
        mobStep2.style.display = 'none';
    }, 300);
}

function showStep2() {
    mobStep1.style.display = 'none';
    mobStep2.style.display = 'block';
}

mobileContactBtn.addEventListener('click', openMobContact);

// Close when clicking backdrop
mobContactOverlay.addEventListener('click', e => {
    if (e.target === mobContactOverlay) closeMobContact();
});

// Social card actions
mobWaCard.addEventListener('click', showStep2);
mobIgCard.addEventListener('click', () => window.open('https://instagram.com/gtechfusion', '_blank'));
mobThreadCard.addEventListener('click', () => window.open('https://threads.net/@gtechfusion', '_blank'));
mobTikCard.addEventListener('click', () => window.open('https://tiktok.com/@gtechfusion', '_blank'));
mobBackBtn.addEventListener('click', () => {
    mobStep2.style.display = 'none';
    mobStep1.style.display = 'block';
    // Re-animate cards
    socialCards.forEach((card, i) => {
        card.classList.remove('revealed');
        setTimeout(() => card.classList.add('revealed'), i * 100);
    });
});
    </script>

</body>
</html>