<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="theme-color" content="#0a0a0a">
<title>Admin — GTechFusion</title>
<link rel="icon" type="image/png" href="/public/images/gtech-icon.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Outfit:wght@200;300;400&display=swap" rel="stylesheet">

<style>
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}

:root{
  --white:#ffffff;
  --white-dim:rgba(255,255,255,0.55);
  --white-faint:rgba(255,255,255,0.08);
  --accent:#c8a96e;
  --accent-dim:rgba(200,169,110,0.15);
  --accent-border:rgba(200,169,110,0.25);
  --danger:#e05c5c;
  --danger-dim:rgba(224,92,92,0.1);
  --font-display:'Cormorant Garamond',serif;
  --font-body:'Outfit',sans-serif;
}

html,body{
  height:100%;height:100dvh;
  overflow:hidden;
  font-family:var(--font-body);font-weight:300;
  background:#0a0a0a;color:var(--white);
  cursor:none;
}

/* ── Custom Cursor ── */
.cursor{
  position:fixed;width:8px;height:8px;
  background:var(--accent);border-radius:50%;
  pointer-events:none;z-index:9999;
  transform:translate(-50%,-50%);
  transition:width 0.3s,height 0.3s,opacity 0.3s;
}
.cursor-ring{
  position:fixed;width:36px;height:36px;
  border:1px solid rgba(200,169,110,0.5);border-radius:50%;
  pointer-events:none;z-index:9998;
  transform:translate(-50%,-50%);
  transition:width 0.3s,height 0.3s,opacity 0.3s;
}
.cursor.hover{width:14px;height:14px;}
.cursor-ring.hover{width:50px;height:50px;opacity:0.5;}

/* ── Background (same as welcome) ── */
.bg{
  position:fixed;inset:-60px;
  background-image:url('/public/images/welcome-bg.jpg');
  background-size:cover;background-position:center;
  will-change:transform;
}
.bg-overlay{
  position:fixed;inset:0;
  background:linear-gradient(135deg,rgba(0,0,0,0.82) 0%,rgba(0,0,0,0.65) 50%,rgba(0,0,0,0.78) 100%);
  pointer-events:none;
}
.bg-vignette{
  position:fixed;inset:0;
  background:radial-gradient(ellipse at center,transparent 30%,rgba(0,0,0,0.7) 100%);
  pointer-events:none;
}
.bg-grain{
  position:fixed;inset:0;opacity:0.035;
  background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
  background-size:200px 200px;pointer-events:none;
}

/* ── Page Layout ── */
.page{
  position:relative;z-index:10;
  height:100vh;height:100dvh;
  display:grid;grid-template-rows:auto 1fr auto;
  padding:2.5rem 3.5rem;
  padding-top:max(2.5rem,env(safe-area-inset-top)+1rem);
  padding-bottom:max(1.5rem,env(safe-area-inset-bottom)+0.5rem);
}

/* ── Nav ── */
nav{
  display:flex;align-items:center;justify-content:space-between;
  opacity:0;transform:translateY(-16px);
  animation:fadeUp 0.9s 0.2s ease forwards;
}
.logo{
  font-family:var(--font-display);font-size:1.5rem;font-weight:600;
  letter-spacing:0.04em;color:var(--white);text-decoration:none;
  display:inline-flex;align-items:center;gap:0;
}
.logo img{width:42px;height:42px;object-fit:contain;}
.logo-text{color:var(--white);}
.logo-accent{color:var(--accent);}

.nav-badge{
  display:inline-flex;align-items:center;gap:0.5rem;
  padding:0.35rem 1rem;
  border:1px solid var(--accent-border);
  border-radius:999px;
  font-size:0.68rem;font-weight:300;letter-spacing:0.2em;text-transform:uppercase;
  color:rgba(255,255,255,0.4);
}
.nav-badge span{
  width:6px;height:6px;border-radius:50%;
  background:var(--accent);
  animation:badgePulse 2s ease-in-out infinite;
}
@keyframes badgePulse{
  0%,100%{opacity:0.4;transform:scale(1);}
  50%{opacity:1;transform:scale(1.3);}
}

/* ── Center Content ── */
.center{
  display:flex;align-items:center;justify-content:center;
}

/* ── Login Card ── */
.login-card{
  width:100%;max-width:420px;
  background:rgba(10,10,10,0.45);
  backdrop-filter:blur(24px);-webkit-backdrop-filter:blur(24px);
  border:1px solid rgba(255,255,255,0.07);
  border-radius:24px;
  padding:2.8rem 2.4rem;
  box-shadow:0 32px 80px rgba(0,0,0,0.5),0 1px 0 rgba(255,255,255,0.04) inset;
  opacity:0;transform:translateY(24px);
  animation:fadeUp 0.8s 0.5s ease forwards;
  position:relative;overflow:hidden;
}

/* Gold top accent line */
.login-card::before{
  content:'';
  position:absolute;top:0;left:10%;right:10%;height:1px;
  background:linear-gradient(to right,transparent,var(--accent),transparent);
  opacity:0.6;
}

/* ── Card Header ── */
.card-header{
  text-align:center;margin-bottom:2rem;
}
.card-icon{
  width:56px;height:56px;margin:0 auto 1.2rem;
  background:linear-gradient(135deg,rgba(200,169,110,0.15),rgba(200,169,110,0.05));
  border:1px solid var(--accent-border);
  border-radius:16px;
  display:flex;align-items:center;justify-content:center;
  font-size:1.5rem;
}
.card-title{
  font-family:var(--font-display);
  font-size:1.9rem;font-weight:400;font-style:italic;
  color:var(--white);letter-spacing:0.01em;
  margin-bottom:0.3rem;
}
.card-sub{
  font-size:0.68rem;font-weight:300;
  letter-spacing:0.2em;text-transform:uppercase;
  color:rgba(255,255,255,0.25);
}

/* ── Divider ── */
.divider{
  display:flex;align-items:center;gap:0.8rem;
  margin:1.6rem 0;
}
.divider::before,.divider::after{
  content:'';flex:1;height:1px;
  background:rgba(255,255,255,0.06);
}
.divider span{
  font-size:0.65rem;color:rgba(200,169,110,0.5);
  letter-spacing:0.2em;
}

/* ── Alert ── */
.alert{
  display:flex;align-items:center;gap:0.6rem;
  padding:0.85rem 1rem;
  background:var(--danger-dim);
  border:1px solid rgba(224,92,92,0.2);
  border-radius:12px;
  font-size:0.76rem;font-weight:300;
  color:rgba(255,120,120,0.9);
  margin-bottom:1.4rem;
  animation:fadeUp 0.3s ease;
}
.alert-icon{font-size:0.9rem;flex-shrink:0;}

/* ── Form ── */
.form-group{margin-bottom:1.2rem;}
.form-label{
  display:block;font-size:0.6rem;font-weight:400;
  letter-spacing:0.22em;text-transform:uppercase;
  color:rgba(255,255,255,0.3);margin-bottom:0.55rem;
}
.input-wrap{position:relative;}
.input-icon{
  position:absolute;left:1rem;top:50%;transform:translateY(-50%);
  color:rgba(255,255,255,0.2);pointer-events:none;
  transition:color 0.25s ease;
}
.form-input{
  width:100%;
  padding:0.88rem 1rem 0.88rem 2.8rem;
  background:rgba(255,255,255,0.04);
  border:1px solid rgba(255,255,255,0.08);
  border-radius:12px;
  font-family:var(--font-body);font-size:0.85rem;font-weight:300;
  color:var(--white);outline:none;
  transition:border-color 0.25s,box-shadow 0.25s,background 0.25s;
  -webkit-autofill:{background:transparent;}
}
.form-input::placeholder{color:rgba(255,255,255,0.2);}
.form-input:focus{
  border-color:var(--accent-border);
  background:rgba(200,169,110,0.04);
  box-shadow:0 0 0 3px rgba(200,169,110,0.07);
}
.form-input:focus + .input-icon,
.input-wrap:focus-within .input-icon{
  color:rgba(200,169,110,0.5);
}

/* Password toggle */
.pw-toggle{
  position:absolute;right:1rem;top:50%;transform:translateY(-50%);
  background:none;border:none;cursor:pointer;
  color:rgba(255,255,255,0.2);padding:0.2rem;
  transition:color 0.2s;
}
.pw-toggle:hover{color:rgba(200,169,110,0.6);}

/* ── Remember row ── */
.remember-row{
  display:flex;align-items:center;justify-content:space-between;
  margin-bottom:1.6rem;
}
.remember-label{
  display:flex;align-items:center;gap:0.55rem;
  font-size:0.75rem;font-weight:300;
  color:rgba(255,255,255,0.3);cursor:pointer;
  user-select:none;
}
.remember-label input[type="checkbox"]{
  width:15px;height:15px;
  accent-color:var(--accent);cursor:pointer;
}
.remember-label:hover{color:rgba(255,255,255,0.5);}

/* ── Submit Button ── */
.submit-btn{
  width:100%;padding:1rem;
  background:var(--accent);color:#0a0a0a;
  font-family:var(--font-body);font-size:0.75rem;font-weight:400;
  letter-spacing:0.18em;text-transform:uppercase;
  border:none;cursor:pointer;
  clip-path:polygon(0 0,calc(100% - 10px) 0,100% 10px,100% 100%,10px 100%,0 calc(100% - 10px));
  transition:all 0.3s ease;
  position:relative;overflow:hidden;
}
.submit-btn::before{
  content:'';position:absolute;inset:0;
  background:rgba(255,255,255,0);
  transition:background 0.3s;
}
.submit-btn:hover{background:#d4b87a;transform:translateY(-2px);}
.submit-btn:hover::before{background:rgba(255,255,255,0.08);}
.submit-btn:active{transform:translateY(0);}
.submit-btn-inner{
  display:flex;align-items:center;justify-content:center;gap:0.5rem;
  position:relative;z-index:1;
}

/* ── Footer ── */
footer{
  display:flex;align-items:center;justify-content:space-between;
  opacity:0;animation:fadeUp 0.9s 1s ease forwards;
}
.footer-left{
  font-size:0.7rem;font-weight:300;
  letter-spacing:0.1em;color:rgba(255,255,255,0.2);
}
.footer-right{
  font-size:0.7rem;font-weight:300;
  letter-spacing:0.1em;color:rgba(255,255,255,0.2);
}
.footer-right a{
  color:rgba(200,169,110,0.5);text-decoration:none;
  transition:color 0.2s;
}
.footer-right a:hover{color:var(--accent);}

/* ── Deco side line ── */
.deco-line{
  position:fixed;right:3.5rem;top:50%;transform:translateY(-50%);
  display:flex;flex-direction:column;align-items:center;gap:1rem;
  z-index:20;opacity:0;animation:fadeIn 1s 1.2s ease forwards;
}
.deco-line::before,.deco-line::after{
  content:'';display:block;width:1px;height:60px;
  background:rgba(255,255,255,0.1);
}
.deco-scroll{
  writing-mode:vertical-rl;font-size:0.62rem;font-weight:300;
  letter-spacing:0.25em;text-transform:uppercase;
  color:rgba(255,255,255,0.2);
}

/* ── Animations ── */
@keyframes fadeUp{to{opacity:1;transform:translateY(0);}}
@keyframes fadeIn{to{opacity:1;}}

/* ── Loading state ── */
.submit-btn.loading{pointer-events:none;opacity:0.7;}
.submit-btn.loading .btn-text{opacity:0;}
.submit-btn.loading .btn-spinner{display:block;}
.btn-spinner{
  display:none;
  width:16px;height:16px;
  border:1.5px solid rgba(10,10,10,0.3);
  border-top-color:#0a0a0a;
  border-radius:50%;
  animation:spin 0.7s linear infinite;
  position:absolute;
}
@keyframes spin{to{transform:rotate(360deg);}}

/* ── Mobile ── */
@media(max-width:768px){
  .page{
    padding:1.5rem;
    padding-top:max(1.5rem,env(safe-area-inset-top)+1rem);
    padding-bottom:max(1.5rem,env(safe-area-inset-bottom)+0.5rem);
  }
  .deco-line{display:none;}
  body{cursor:auto;}
  .cursor,.cursor-ring{display:none;}
  .login-card{padding:2rem 1.6rem;}
  .card-title{font-size:1.6rem;}
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

    {{-- NAV --}}
    <nav>
        <a href="/" class="logo">
            <img src="/public/images/gtech-icon.png" alt="GTechFusion">
            <span class="logo-text">-Tech<span class="logo-accent">Fusion</span></span>
        </a>
        <div class="nav-badge">
            <span></span> Admin Portal
        </div>
    </nav>

    {{-- CENTER: LOGIN CARD --}}
    <div class="center">
        <div class="login-card">

            <div class="card-header">
                <div class="card-icon">💍</div>
                <div class="card-title">Welcome Back</div>
                <div class="card-sub">GTechFusion · Admin Dashboard</div>
            </div>

            <div class="divider"><span>✦</span></div>

            {{-- Error Alert --}}
            @if($errors->any())
            <div class="alert">
                <span class="alert-icon">⚠</span>
                <span>{{ $errors->first() }}</span>
            </div>
            @endif

            {{-- Session Error --}}
            @if(session('error'))
            <div class="alert">
                <span class="alert-icon">⚠</span>
                <span>{{ session('error') }}</span>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}" id="loginForm">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <div class="input-wrap">
                        <svg class="input-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="2" y="4" width="20" height="16" rx="2"/>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                        </svg>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-input"
                            placeholder="admin@gtechfusion.com"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="email"
                        >
                    </div>
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrap">
                        <svg class="input-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="11" width="18" height="11" rx="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-input"
                            placeholder="Enter your password"
                            required
                            autocomplete="current-password"
                            style="padding-right:3rem;"
                        >
                        <button type="button" class="pw-toggle" id="pwToggle" title="Show/Hide password">
                            <svg id="eyeIcon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Remember me --}}
                <div class="remember-row">
                    <label class="remember-label">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        Remember me
                    </label>
                </div>

                {{-- Submit --}}
                <button type="submit" class="submit-btn" id="submitBtn">
                    <div class="submit-btn-inner">
                        <div class="btn-spinner" id="btnSpinner"></div>
                        <span class="btn-text">
                            Sign In to Dashboard
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-left:4px;">
                                <path d="M5 12h14M12 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </div>
                </button>

            </form>

        </div>
    </div>

    {{-- FOOTER --}}
    <footer>
        <div class="footer-left">© {{ date('Y') }} GTechFusion. All rights reserved.</div>
        <div class="footer-right"><a href="/">← Back to Website</a></div>
    </footer>

</div>

<div class="deco-line">
    <span class="deco-scroll">Admin</span>
</div>

<script>
// ── Parallax + Zoom (same as welcome) ──
const bg = document.getElementById('bg');
const cursor = document.getElementById('cursor');
const cursorRing = document.getElementById('cursorRing');
const STRENGTH = 18, ZOOM_START = 1.06, ZOOM_DUR = 2000;
let mouseX = window.innerWidth/2, mouseY = window.innerHeight/2;
let ringX = mouseX, ringY = mouseY;
let offsetX = 0, offsetY = 0, targetX = 0, targetY = 0, startTime = null;

function lerp(a,b,t){return a+(b-a)*t;}
function easeOutCubic(t){return 1-Math.pow(1-t,3);}

document.addEventListener('mousemove', e => {
    mouseX = e.clientX; mouseY = e.clientY;
    cursor.style.left = mouseX + 'px';
    cursor.style.top  = mouseY + 'px';
    targetX = ((mouseX / window.innerWidth)  - 0.5) * STRENGTH;
    targetY = ((mouseY / window.innerHeight) - 0.5) * STRENGTH;
});

// Hover effect on interactive elements
document.querySelectorAll('a,button,input,.login-card').forEach(el => {
    el.addEventListener('mouseenter', () => {
        cursor.classList.add('hover');
        cursorRing.classList.add('hover');
    });
    el.addEventListener('mouseleave', () => {
        cursor.classList.remove('hover');
        cursorRing.classList.remove('hover');
    });
});

function animate(ts) {
    if (!startTime) startTime = ts;
    const progress = Math.min((ts - startTime) / ZOOM_DUR, 1);
    const scale = ZOOM_START - (ZOOM_START - 1.0) * easeOutCubic(progress);
    offsetX = lerp(offsetX, targetX, 0.06);
    offsetY = lerp(offsetY, targetY, 0.06);
    bg.style.transform = `scale(${scale}) translate(${offsetX/scale}px,${offsetY/scale}px)`;
    ringX = lerp(ringX, mouseX, 0.1);
    ringY = lerp(ringY, mouseY, 0.1);
    cursorRing.style.left = ringX + 'px';
    cursorRing.style.top  = ringY + 'px';
    requestAnimationFrame(animate);
}
requestAnimationFrame(animate);

// ── Password toggle ──
const pwToggle = document.getElementById('pwToggle');
const pwInput  = document.getElementById('password');
const eyeIcon  = document.getElementById('eyeIcon');
let pwVisible  = false;

pwToggle.addEventListener('click', () => {
    pwVisible = !pwVisible;
    pwInput.type = pwVisible ? 'text' : 'password';
    eyeIcon.innerHTML = pwVisible
        ? `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>`
        : `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
});

// ── Form loading state ──
document.getElementById('loginForm').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    const spinner = document.getElementById('btnSpinner');
    btn.classList.add('loading');
    spinner.style.display = 'block';
});
</script>

</body>
</html>