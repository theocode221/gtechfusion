<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="theme-color" content="#f5e6e0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<title>Hafizi & Airen — Wedding Invitation</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Great+Vibes&family=Outfit:wght@200;300;400&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}

:root{
  --pink:#e8a4b0;
  --green:#7a9e7e;
  --gold:#c9a84c;
  --cream:#fdf8f0;
  --text:#3a2820;
  --text-light:#7a6258;
  --font-display:'Cormorant Garamond',serif;
  --font-script:'Great Vibes',cursive;
  --font-body:'Outfit',sans-serif;
}

html,body{
  height:100%;
  overflow:hidden;
  background:#f5e6e0;
}

body{
  font-family:var(--font-body);
  color:var(--text);
}

/* ── Language Toggle ── */
.lang-toggle{
  position:fixed;top:max(1rem, env(safe-area-inset-top) + 0.5rem);right:1rem;
  z-index:1000;
  display:flex;align-items:center;
  background:rgba(255,255,255,0.7);
  backdrop-filter:blur(10px);
  border:1px solid rgba(200,150,150,0.2);
  border-radius:999px;
  padding:0.2rem;
  box-shadow:0 2px 12px rgba(0,0,0,0.08);
}

.lang-btn{
  padding:0.3rem 0.8rem;
  font-size:0.65rem;font-weight:400;
  letter-spacing:0.1em;text-transform:uppercase;
  border:none;background:none;cursor:pointer;
  border-radius:999px;color:var(--text-light);
  transition:all 0.3s ease;font-family:var(--font-body);
}

.lang-btn.active{background:var(--pink);color:white;}

/* ══════════════════════
   ENVELOPE PAGE
══════════════════════ */
#envelopePage{
  position:fixed;inset:0;
  display:flex;align-items:center;justify-content:center;
  overflow:hidden;
  z-index:500;
  background:#f5e6e0;
}

/* Full screen background scene */
.env-scene-bg{
  position:absolute;inset:0;
  background-image:url('/public/images/env-background.png');
  background-size:cover;
  background-position:center;
  z-index:1;
}

/* Subtle vignette */
.env-scene-bg::after{
  content:'';position:absolute;inset:0;
  background:radial-gradient(ellipse at center, transparent 40%, rgba(0,0,0,0.08) 100%);
}

/* ── Envelope container ── */
.envelope-stage{
  position:relative;
  z-index:10;
  display:flex;
  align-items:center;
  justify-content:center;
  width:100%;
  height:100%;
  perspective:1000px;
}

.envelope-wrap{
  position:relative;
  /* Natural envelope size — overflows on mobile nicely */
  width:min(600px, 130vw);
  height:min(420px, 91vw);
  flex-shrink:0;
}

/* ── Envelope body image ── */
.env-body{
  position:absolute;
  inset:0;
  z-index:2;
}

.env-body img{
  width:100%;height:100%;
  object-fit:fill;
  display:block;
}

/* ── Flap — animates open ── */
.env-flap{
  position:absolute;
  top:0;left:0;right:0;
  /* Flap covers top ~48% of envelope */
  height:50%;
  transform-origin:top center;
  transform:rotateX(0deg);
  transform-style:preserve-3d;
  z-index:6;
  transition:none;
}

.env-flap-img{
  position:absolute;inset:0;
  backface-visibility:hidden;
}

.env-flap-img img{
  width:100%;height:100%;
  object-fit:fill;
  display:block;
}

/* Back of flap */
.env-flap-back{
  position:absolute;inset:0;
  backface-visibility:hidden;
  transform:rotateX(180deg);
  background:linear-gradient(180deg,rgba(240,200,200,0.4),rgba(220,170,170,0.2));
  clip-path:polygon(0 0,100% 0,50% 88%);
}

/* ── Seal ── */
.seal-wrap{
  position:absolute;
  top:48%;left:50%;
  transform:translate(-50%,-50%);
  z-index:10;
  display:flex;flex-direction:column;align-items:center;
  cursor:pointer;
  transition:transform 0.35s ease;
}

.seal-wrap:hover{
  transform:translate(-50%,-50%) scale(1.06);
}

.seal-img{
  width:clamp(80px,14vw,130px);
  height:clamp(80px,14vw,130px);
  position:relative;
  display:flex;align-items:center;justify-content:center;
}

.seal-img img{
  width:100%;height:100%;
  object-fit:contain;
  filter:drop-shadow(0 4px 12px rgba(0,0,0,0.25));
}

.seal-monogram{
  position:absolute;
  top:50%;left:50%;
  transform:translate(-50%,-50%);
  font-family:var(--font-script);
  font-size:clamp(1rem,3vw,1.6rem);
  color:rgba(255,255,255,0.92);
  text-shadow:0 1px 4px rgba(0,0,0,0.4);
  pointer-events:none;
  white-space:nowrap;
}

.seal-label{
  margin-top:0.5rem;
  font-size:0.6rem;
  letter-spacing:0.25em;
  text-transform:uppercase;
  color:rgba(92,45,30,0.55);
  text-align:center;
  animation:sealPulse 2.5s ease-in-out infinite;
}

@keyframes sealPulse{
  0%,100%{opacity:0.4;}
  50%{opacity:0.9;}
}

/* ── You're Invited text ── */
.env-invited{
  position:absolute;
  bottom:14%;left:50%;
  transform:translateX(-50%);
  text-align:center;
  z-index:5;
  pointer-events:none;
  white-space:nowrap;
}

.env-invited-script{
  font-family:var(--font-script);
  font-size:clamp(1.8rem,6vw,3rem);
  color:rgba(92,45,30,0.7);
  text-shadow:0 1px 6px rgba(255,255,255,0.4);
  line-height:1;
}

.env-invited-sub{
  font-size:clamp(0.55rem,1.5vw,0.75rem);
  letter-spacing:0.3em;
  text-transform:uppercase;
  color:rgba(92,45,30,0.45);
  margin-top:0.4rem;
}

/* ── White reveal overlay ── */
.reveal-overlay{
  position:fixed;inset:0;
  background:rgba(255,255,255,0);
  z-index:700;
  pointer-events:none;
  transition:background 0s;
}

.reveal-overlay.reveal-in{
  transition:background 0.8s ease;
  background:rgba(255,255,255,1);
}

.reveal-overlay.reveal-out{
  transition:background 1s ease;
  background:rgba(255,255,255,0);
}

/* ══════════════════════
   CARD PAGE
══════════════════════ */
#cardPage{
  display:none;
  position:relative;
  background:var(--cream);
  overflow-x:hidden;
}

#cardPage.visible{display:block;}

/* ── COVER ── */
.card-cover{
  position:relative;
  min-height:100vh;
  display:flex;align-items:center;justify-content:center;
  overflow:hidden;
  background:linear-gradient(160deg,#f9f0f5 0%,#fdf0f2 50%,#f5f7f0 100%);
}

.card-cover::before{
  content:'';position:absolute;inset:0;
  background:
    radial-gradient(circle at 10% 10%,rgba(232,164,176,0.2) 0%,transparent 35%),
    radial-gradient(circle at 90% 90%,rgba(184,212,187,0.2) 0%,transparent 35%);
}

/* Corner decorations */
.corner{position:absolute;width:120px;height:120px;opacity:0.4;}
.corner-tl{top:0;left:0;}
.corner-tr{top:0;right:0;transform:scaleX(-1);}
.corner-bl{bottom:0;left:0;transform:scaleY(-1);}
.corner-br{bottom:0;right:0;transform:scale(-1);}

.cover-content{
  position:relative;z-index:5;
  text-align:center;padding:3rem 2rem;
  max-width:420px;width:100%;
}

.cover-tag{
  font-size:0.6rem;letter-spacing:0.35em;text-transform:uppercase;
  color:var(--green);margin-bottom:1.5rem;
  display:flex;align-items:center;justify-content:center;gap:0.8rem;
  opacity:0;animation:fadeUp 1s 0.3s ease forwards;
}
.cover-tag::before,.cover-tag::after{content:'';display:block;width:24px;height:1px;background:var(--green);}

.cover-bismillah{
  font-family:var(--font-display);font-size:1rem;
  font-weight:300;font-style:italic;color:var(--green);
  margin-bottom:1.5rem;opacity:0;animation:fadeUp 1s 0.5s ease forwards;
}

.cover-names{
  font-family:var(--font-script);
  font-size:clamp(3rem,12vw,4.5rem);
  color:var(--text);line-height:1.1;margin-bottom:0.8rem;
  opacity:0;animation:fadeUp 1.2s 0.7s ease forwards;
}

.cover-amp{color:var(--pink);display:block;font-size:0.6em;}

.cover-divider{
  display:flex;align-items:center;justify-content:center;gap:0.8rem;
  margin:1.2rem 0;opacity:0;animation:fadeUp 1s 0.9s ease forwards;
}
.cover-divider::before,.cover-divider::after{content:'';flex:1;max-width:60px;height:1px;background:linear-gradient(to right,transparent,var(--gold));}
.cover-divider::after{background:linear-gradient(to left,transparent,var(--gold));}
.cover-divider span{color:var(--gold);font-size:0.8rem;}

.cover-subtitle{
  font-family:var(--font-display);font-size:1rem;
  font-weight:300;font-style:italic;color:var(--text-light);
  margin-bottom:2rem;opacity:0;animation:fadeUp 1s 1.1s ease forwards;
}

/* Countdown */
.countdown{
  display:flex;gap:1rem;justify-content:center;
  margin:1.5rem 0;opacity:0;animation:fadeUp 1s 1.3s ease forwards;
}

.cd-item{display:flex;flex-direction:column;align-items:center;gap:0.3rem;}

.cd-num{
  font-family:var(--font-display);font-size:1.8rem;font-weight:400;
  color:var(--text);background:rgba(255,255,255,0.7);
  border:1px solid rgba(201,168,76,0.2);border-radius:10px;
  width:52px;height:52px;display:flex;align-items:center;justify-content:center;
  box-shadow:0 2px 8px rgba(0,0,0,0.05);
}

.cd-label{font-size:0.52rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--text-light);}

.scroll-hint{
  margin-top:2rem;display:flex;flex-direction:column;align-items:center;gap:0.5rem;
  opacity:0;animation:fadeIn 1s 2s ease forwards;
}
.scroll-hint span{font-size:0.58rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--text-light);opacity:0.6;}
.scroll-dot{width:1px;height:40px;background:linear-gradient(to bottom,var(--pink),transparent);animation:scrollPulse 2s ease infinite;}

/* ── SECTIONS ── */
.card-section{padding:5rem 1.5rem;max-width:480px;margin:0 auto;position:relative;}
.section-ornament{text-align:center;margin-bottom:2rem;font-size:1.1rem;color:var(--pink);letter-spacing:0.3em;}
.section-heading{font-family:var(--font-display);font-size:clamp(1.8rem,6vw,2.5rem);font-weight:300;font-style:italic;color:var(--text);text-align:center;margin-bottom:0.8rem;}
.section-sub{font-size:0.8rem;font-weight:300;color:var(--text-light);text-align:center;line-height:1.8;margin-bottom:2rem;}

.floral-div{display:flex;align-items:center;justify-content:center;gap:0.8rem;margin:2rem 0;}
.floral-div::before,.floral-div::after{content:'';flex:1;height:1px;background:linear-gradient(to right,transparent,rgba(201,168,76,0.4));}
.floral-div::after{background:linear-gradient(to left,transparent,rgba(201,168,76,0.4));}
.floral-div-icon{font-size:1rem;color:var(--pink);}

/* Invite card */
.invite-card{
  background:rgba(255,255,255,0.85);border:1px solid rgba(201,168,76,0.2);
  border-radius:16px;padding:2rem 1.5rem;text-align:center;
}
.invite-from{font-size:0.65rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--text-light);margin-bottom:0.8rem;}
.invite-parents{font-family:var(--font-display);font-size:1rem;font-weight:400;color:var(--text);line-height:1.8;margin-bottom:1.2rem;}
.invite-body{font-size:0.82rem;font-weight:300;color:var(--text-light);line-height:1.8;}

/* Detail cards */
.detail-cards{display:flex;flex-direction:column;gap:1rem;}
.detail-card{
  background:rgba(255,255,255,0.8);border:1px solid rgba(184,212,187,0.4);
  border-radius:14px;padding:1.2rem 1.5rem;display:flex;align-items:center;gap:1rem;
  transition:transform 0.2s ease;
}
.detail-card:hover{transform:translateY(-2px);}
.detail-icon{width:44px;height:44px;background:linear-gradient(135deg,#e8f2e9,#fdf0f2);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0;}
.detail-info{flex:1;}
.detail-label{font-size:0.6rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--text-light);margin-bottom:0.3rem;}
.detail-value{font-family:var(--font-display);font-size:1rem;font-weight:400;color:var(--text);}
.detail-sub{font-size:0.72rem;color:var(--text-light);margin-top:0.1rem;}

.map-btn{
  display:flex;align-items:center;justify-content:center;gap:0.5rem;
  width:100%;padding:0.9rem;margin-top:1rem;
  background:linear-gradient(135deg,var(--green),#6a9470);color:white;
  border:none;border-radius:12px;cursor:pointer;font-family:var(--font-body);
  font-size:0.75rem;letter-spacing:0.1em;text-transform:uppercase;text-decoration:none;
  transition:all 0.3s ease;box-shadow:0 4px 12px rgba(122,158,126,0.3);
}
.map-btn:hover{transform:translateY(-2px);}

/* Gallery */
.gallery-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:0.8rem;margin-top:1.5rem;}
.gallery-item{aspect-ratio:3/4;background:linear-gradient(160deg,#e8f2e9,#fdf0f2);border-radius:12px;border:1px solid rgba(201,168,76,0.15);display:flex;align-items:center;justify-content:center;overflow:hidden;}
.gallery-item:first-child{grid-column:span 2;aspect-ratio:4/3;}
.gallery-placeholder{display:flex;flex-direction:column;align-items:center;gap:0.5rem;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--text-light);opacity:0.6;}

/* RSVP */
.rsvp-form{background:rgba(255,255,255,0.85);border:1px solid rgba(201,168,76,0.2);border-radius:16px;padding:1.8rem 1.5rem;}
.form-group{margin-bottom:1.2rem;}
.form-label{display:block;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--text-light);margin-bottom:0.5rem;}
.form-input{width:100%;padding:0.75rem 1rem;background:rgba(255,255,255,0.9);border:1px solid rgba(184,212,187,0.5);border-radius:10px;font-family:var(--font-body);font-size:0.85rem;color:var(--text);outline:none;transition:border-color 0.2s ease;}
.form-input:focus{border-color:var(--green);}
.attend-btns{display:flex;gap:0.8rem;}
.attend-btn{flex:1;padding:0.7rem;border:1px solid rgba(184,212,187,0.5);background:transparent;border-radius:10px;font-family:var(--font-body);font-size:0.8rem;color:var(--text-light);cursor:pointer;transition:all 0.25s ease;}
.attend-btn.selected{background:var(--green);color:white;border-color:var(--green);}
.submit-btn{width:100%;padding:1rem;background:linear-gradient(135deg,var(--pink),#d4839a);color:white;border:none;border-radius:12px;cursor:pointer;font-family:var(--font-body);font-size:0.8rem;letter-spacing:0.1em;text-transform:uppercase;margin-top:1rem;transition:all 0.3s ease;box-shadow:0 4px 12px rgba(232,164,176,0.4);}
.submit-btn:hover{transform:translateY(-2px);}

/* Wishes */
.wishes-list{display:flex;flex-direction:column;gap:0.8rem;margin-bottom:1.5rem;max-height:280px;overflow-y:auto;}
.wish-item{background:rgba(255,255,255,0.8);border:1px solid rgba(232,164,176,0.2);border-radius:12px;padding:1rem 1.2rem;animation:wishAppear 0.4s ease;}
@keyframes wishAppear{from{opacity:0;transform:translateY(10px);}to{opacity:1;transform:translateY(0);}}
.wish-name{font-size:0.75rem;font-weight:400;color:var(--green);margin-bottom:0.3rem;}
.wish-text{font-family:var(--font-display);font-style:italic;font-size:0.9rem;color:var(--text);line-height:1.6;}
.wish-form{background:rgba(255,255,255,0.85);border:1px solid rgba(201,168,76,0.2);border-radius:16px;padding:1.5rem;}

/* Ang pau */
.angpau-cards{display:flex;flex-direction:column;gap:1rem;}
.angpau-card{background:rgba(255,255,255,0.85);border:1px solid rgba(201,168,76,0.2);border-radius:14px;padding:1.2rem 1.5rem;display:flex;align-items:center;gap:1rem;cursor:pointer;transition:all 0.25s ease;}
.angpau-card:hover{transform:translateY(-2px);}
.angpau-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;flex-shrink:0;}
.angpau-info{flex:1;}
.angpau-name{font-size:0.85rem;font-weight:400;color:var(--text);}
.angpau-num{font-size:0.72rem;color:var(--text-light);margin-top:0.2rem;}
.copy-btn{font-size:0.6rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--green);border:1px solid rgba(122,158,126,0.3);background:none;border-radius:6px;padding:0.3rem 0.6rem;cursor:pointer;transition:all 0.2s ease;font-family:var(--font-body);}
.copy-btn:hover{background:var(--green);color:white;}

/* Closing */
.card-closing{background:linear-gradient(160deg,#f9f0f5,#f0f7f1);padding:5rem 1.5rem;text-align:center;position:relative;overflow:hidden;}
.closing-quote{font-family:var(--font-script);font-size:clamp(1.8rem,7vw,2.5rem);color:var(--text);line-height:1.4;margin-bottom:1.5rem;}
.closing-names{font-family:var(--font-display);font-size:1.2rem;font-style:italic;color:var(--green);margin-bottom:0.5rem;}
.closing-thank{font-size:0.75rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--text-light);}

/* Section backgrounds */
.section-bg-1{background:linear-gradient(160deg,#fdf8fc,#f8fcf8);}
.section-bg-2{background:linear-gradient(160deg,#fdf5f8,#f8fcf8);}
.section-bg-3{background:linear-gradient(160deg,#fdf0f5,#fdf8f5);}
.section-bg-4{background:linear-gradient(160deg,#f0f7f1,#fdf8f5);}
.section-bg-5{background:linear-gradient(160deg,#fdf8f5,#fdf0f5);}

/* Back to top */
.back-to-top{
  position:fixed;bottom:max(2rem, env(safe-area-inset-bottom) + 1rem);right:1.5rem;
  width:44px;height:44px;background:rgba(255,255,255,0.85);
  backdrop-filter:blur(10px);border:1px solid rgba(200,150,150,0.3);
  border-radius:50%;color:var(--pink);display:flex;align-items:center;justify-content:center;
  cursor:pointer;z-index:400;opacity:0;transform:translateY(20px);
  transition:opacity 0.35s ease,transform 0.35s ease,background 0.25s ease;
  pointer-events:none;
}
.back-to-top.visible{opacity:1;transform:translateY(0);pointer-events:all;}
.back-to-top:hover{background:var(--pink);color:white;}

/* Scroll reveal */
.reveal{opacity:0;transform:translateY(30px);transition:opacity 0.8s ease,transform 0.8s ease;}
.reveal.visible{opacity:1;transform:translateY(0);}

/* Keyframes */
@keyframes fadeUp{to{opacity:1;transform:translateY(0);}}
@keyframes fadeIn{to{opacity:1;}}
@keyframes scrollPulse{0%,100%{opacity:0.3;transform:scaleY(1);}50%{opacity:0.8;transform:scaleY(1.1);}}

/* Mobile */
@media(max-width:768px){
  .cd-num{width:46px;height:46px;font-size:1.5rem;}
  .back-to-top{width:36px;height:36px;}
  .back-to-top svg{width:14px;height:14px;}
}
</style>
</head>
<body>

<!-- Language toggle -->
<div class="lang-toggle">
  <button class="lang-btn active" onclick="setLang('en')">EN</button>
  <button class="lang-btn" onclick="setLang('my')">BM</button>
</div>

<!-- White reveal overlay -->
<div class="reveal-overlay" id="revealOverlay"></div>

<!-- ══ ENVELOPE PAGE ══ -->
<div id="envelopePage">

  <!-- Background scene (butterflies etc) -->
  <div class="env-scene-bg"></div>

  <div class="envelope-stage">
    <div class="envelope-wrap" id="envelopeWrap">

      <!-- Envelope body image -->
      <div class="env-body">
        <img src="/public/images/env-body.png" alt="Envelope">
      </div>

      <!-- Top flap image — animates open -->
      <div class="env-flap" id="envFlap">
        <div class="env-flap-img">
          <img src="/public/images/env-flap.png" alt="Flap">
        </div>
        <div class="env-flap-back"></div>

        <!-- Seal stuck to flap tip — travels with flap -->
        <div class="seal-wrap" id="sealWrap" onclick="openEnvelope()">
          <div class="seal-img">
            <img src="/public/images/env-seal.png" alt="Seal">
            <div class="seal-monogram">H&amp;A</div>
          </div>
          <div class="seal-label lang-el" data-en="Tap to open" data-my="Ketuk untuk buka">Tap to open</div>
        </div>
      </div>

      <!-- You're Invited text -->
      <div class="env-invited">
        <div class="env-invited-script lang-el" data-en="You're Invited" data-my="Anda Dijemput">You're Invited</div>
        <div class="env-invited-sub">Hafizi &amp; Airen</div>
      </div>

    </div>
  </div>
</div>

<!-- ══ CARD PAGE ══ -->
<div id="cardPage">

  <!-- COVER -->
  <div class="card-cover">
    <!-- Corner SVG decorations -->
    <svg class="corner corner-tl" viewBox="0 0 120 120" fill="none">
      <circle cx="20" cy="20" r="8" fill="#f5b8c4" opacity="0.5"/>
      <circle cx="40" cy="12" r="5" fill="#a8c9ab" opacity="0.4"/>
      <ellipse cx="55" cy="30" rx="14" ry="6" fill="#a8c9ab" opacity="0.25" transform="rotate(-30 55 30)"/>
      <circle cx="15" cy="45" r="4" fill="#f9d77e" opacity="0.4"/>
    </svg>
    <svg class="corner corner-tr" viewBox="0 0 120 120" fill="none">
      <circle cx="20" cy="20" r="8" fill="#f5b8c4" opacity="0.5"/>
      <circle cx="40" cy="12" r="5" fill="#a8c9ab" opacity="0.4"/>
      <ellipse cx="55" cy="30" rx="14" ry="6" fill="#a8c9ab" opacity="0.25" transform="rotate(-30 55 30)"/>
    </svg>
    <svg class="corner corner-bl" viewBox="0 0 120 120" fill="none">
      <circle cx="20" cy="20" r="8" fill="#a8c9ab" opacity="0.5"/>
      <circle cx="40" cy="12" r="5" fill="#f5b8c4" opacity="0.4"/>
    </svg>
    <svg class="corner corner-br" viewBox="0 0 120 120" fill="none">
      <circle cx="20" cy="20" r="8" fill="#a8c9ab" opacity="0.5"/>
      <circle cx="40" cy="12" r="5" fill="#f5b8c4" opacity="0.4"/>
    </svg>

    <div class="cover-content">
      <div class="cover-tag lang-el" data-en="Wedding Invitation" data-my="Jemputan Perkahwinan">Wedding Invitation</div>
      <div class="cover-bismillah lang-el" data-en="Bismillahirrahmanirrahim" data-my="Bismillahirrahmanirrahim">Bismillahirrahmanirrahim</div>
      <div class="cover-names">
        Amir <span class="cover-amp">&</span> Syahira
      </div>
      <div class="cover-divider"><span>✦</span></div>
      <div class="cover-subtitle lang-el"
        data-en="Together with their families invite you to celebrate their union"
        data-my="Bersama keluarga menjemput anda meraikan perkahwinan mereka">
        Together with their families invite you to celebrate their union
      </div>
      <div class="countdown">
        <div class="cd-item"><div class="cd-num" id="cdDays">00</div><div class="cd-label lang-el" data-en="Days" data-my="Hari">Days</div></div>
        <div class="cd-item"><div class="cd-num" id="cdHours">00</div><div class="cd-label lang-el" data-en="Hours" data-my="Jam">Hours</div></div>
        <div class="cd-item"><div class="cd-num" id="cdMins">00</div><div class="cd-label lang-el" data-en="Mins" data-my="Minit">Mins</div></div>
        <div class="cd-item"><div class="cd-num" id="cdSecs">00</div><div class="cd-label lang-el" data-en="Secs" data-my="Saat">Secs</div></div>
      </div>
      <div class="scroll-hint">
        <span class="lang-el" data-en="scroll to explore" data-my="tatal untuk lihat">scroll to explore</span>
        <div class="scroll-dot"></div>
      </div>
    </div>
  </div>

  <!-- INVITATION -->
  <div class="card-section section-bg-1 reveal">
    <div class="section-ornament">✿ ✦ ✿</div>
    <h2 class="section-heading lang-el" data-en="You Are Warmly Invited" data-my="Anda Dijemput Hadir">You Are Warmly Invited</h2>
    <div class="floral-div"><span class="floral-div-icon">🌸</span></div>
    <div class="invite-card">
      <div class="invite-from lang-el" data-en="With love from both families" data-my="Dengan penuh kasih dari kedua keluarga">With love from both families</div>
      <div class="invite-parents lang-el"
        data-en="Encik Ahmad bin Hassan & Puan Rohani binti Yusof<br>together with<br>Encik Rahim bin Ismail & Puan Norzila binti Abdullah"
        data-my="Encik Ahmad bin Hassan & Puan Rohani binti Yusof<br>berserta<br>Encik Rahim bin Ismail & Puan Norzila binti Abdullah">
        Encik Ahmad bin Hassan & Puan Rohani binti Yusof<br>together with<br>Encik Rahim bin Ismail & Puan Norzila binti Abdullah
      </div>
      <div class="invite-body lang-el"
        data-en="cordially invite you to the wedding reception of their beloved children"
        data-my="dengan penuh hormat menjemput anda ke majlis perkahwinan anak-anak mereka yang dikasihi">
        cordially invite you to the wedding reception of their beloved children
      </div>
    </div>
  </div>

  <!-- DETAILS -->
  <div class="card-section section-bg-2 reveal">
    <div class="section-ornament">✦</div>
    <h2 class="section-heading lang-el" data-en="The Details" data-my="Butiran Majlis">The Details</h2>
    <div class="floral-div"><span class="floral-div-icon">🌿</span></div>
    <div class="detail-cards">
      <div class="detail-card">
        <div class="detail-icon">📅</div>
        <div class="detail-info">
          <div class="detail-label lang-el" data-en="Date" data-my="Tarikh">Date</div>
          <div class="detail-value">Saturday, 15 November 2025</div>
          <div class="detail-sub lang-el" data-en="17 Jamadil Awal 1447H" data-my="17 Jamadil Awal 1447H">17 Jamadil Awal 1447H</div>
        </div>
      </div>
      <div class="detail-card">
        <div class="detail-icon">🕐</div>
        <div class="detail-info">
          <div class="detail-label lang-el" data-en="Time" data-my="Masa">Time</div>
          <div class="detail-value">11:00 AM — 4:00 PM</div>
          <div class="detail-sub lang-el" data-en="Lunch Reception" data-my="Majlis Makan Tengah Hari">Lunch Reception</div>
        </div>
      </div>
      <div class="detail-card">
        <div class="detail-icon">🏛️</div>
        <div class="detail-info">
          <div class="detail-label lang-el" data-en="Venue" data-my="Tempat">Venue</div>
          <div class="detail-value">Dewan Seri Mawar</div>
          <div class="detail-sub">No. 12, Jalan Bahagia, Johor Bahru</div>
        </div>
      </div>
      <div class="detail-card">
        <div class="detail-icon">👗</div>
        <div class="detail-info">
          <div class="detail-label lang-el" data-en="Dress Code" data-my="Kod Pakaian">Dress Code</div>
          <div class="detail-value lang-el" data-en="Pastel Green & Soft Pink" data-my="Hijau Pastel & Merah Jambu Lembut">Pastel Green & Soft Pink</div>
        </div>
      </div>
    </div>
    <a href="https://maps.google.com" target="_blank" class="map-btn">
      📍 <span class="lang-el" data-en="Get Directions" data-my="Dapatkan Arah">Get Directions</span>
    </a>
  </div>

  <!-- GALLERY -->
  <div class="card-section section-bg-3 reveal">
    <div class="section-ornament">✿</div>
    <h2 class="section-heading lang-el" data-en="Our Story" data-my="Kisah Kami">Our Story</h2>
    <div class="floral-div"><span class="floral-div-icon">💕</span></div>
    <div class="gallery-grid">
      <div class="gallery-item"><div class="gallery-placeholder"><span>🌸</span><span class="lang-el" data-en="Photo coming soon" data-my="Foto akan datang">Photo coming soon</span></div></div>
      <div class="gallery-item"><div class="gallery-placeholder"><span>🌿</span></div></div>
      <div class="gallery-item"><div class="gallery-placeholder"><span>💐</span></div></div>
    </div>
  </div>

  <!-- RSVP -->
  <div class="card-section section-bg-4 reveal">
    <div class="section-ornament">✦</div>
    <h2 class="section-heading lang-el" data-en="Will You Join Us?" data-my="Adakah Anda Hadir?">Will You Join Us?</h2>
    <p class="section-sub lang-el" data-en="Please let us know by 1st November 2025" data-my="Sila maklumkan sebelum 1 November 2025">Please let us know by 1st November 2025</p>
    <div class="floral-div"><span class="floral-div-icon">✉️</span></div>
    <div class="rsvp-form">
      <div class="form-group">
        <label class="form-label lang-el" data-en="Your Name" data-my="Nama Anda">Your Name</label>
        <input type="text" class="form-input" id="rsvpName" placeholder="Enter your name">
      </div>
      <div class="form-group">
        <label class="form-label lang-el" data-en="Attendance" data-my="Kehadiran">Attendance</label>
        <div class="attend-btns">
          <button class="attend-btn" id="btnYes" onclick="selectAttend('yes')">✓ <span class="lang-el" data-en="Yes, I'll be there!" data-my="Ya, saya hadir!">Yes, I'll be there!</span></button>
          <button class="attend-btn" id="btnNo" onclick="selectAttend('no')">✗ <span class="lang-el" data-en="Regretfully no" data-my="Maaf, tidak dapat hadir">Regretfully no</span></button>
        </div>
      </div>
      <div class="form-group" id="paxGroup" style="display:none;">
        <label class="form-label lang-el" data-en="Number of Guests" data-my="Bilangan Tetamu">Number of Guests</label>
        <input type="number" class="form-input" id="rsvpPax" min="1" max="10" placeholder="1">
      </div>
      <button class="submit-btn" onclick="submitRSVP()"><span class="lang-el" data-en="Send RSVP 💌" data-my="Hantar RSVP 💌">Send RSVP 💌</span></button>
    </div>
  </div>

  <!-- WISHES -->
  <div class="card-section section-bg-5 reveal">
    <div class="section-ornament">💌</div>
    <h2 class="section-heading lang-el" data-en="Send Your Wishes" data-my="Ucapan Anda">Send Your Wishes</h2>
    <div class="floral-div"><span class="floral-div-icon">🌸</span></div>
    <div class="wishes-list" id="wishesList">
      <div class="wish-item">
        <div class="wish-name">Sarah & Family</div>
        <div class="wish-text lang-el" data-en="Wishing you both a lifetime of happiness! 🌸" data-my="Semoga bahagia bersama selamanya! 🌸">Wishing you both a lifetime of happiness! 🌸</div>
      </div>
      <div class="wish-item">
        <div class="wish-name">Uncle Rahman</div>
        <div class="wish-text lang-el" data-en="Congratulations! May Allah bless your marriage 🤲" data-my="Tahniah! Semoga Allah memberkati perkahwinan anda 🤲">Congratulations! May Allah bless your marriage 🤲</div>
      </div>
    </div>
    <div class="wish-form">
      <div class="form-group">
        <label class="form-label lang-el" data-en="Your Name" data-my="Nama Anda">Your Name</label>
        <input type="text" class="form-input" id="wishName" placeholder="Your name">
      </div>
      <div class="form-group">
        <label class="form-label lang-el" data-en="Your Wish" data-my="Ucapan Anda">Your Wish</label>
        <textarea class="form-input" id="wishText" rows="3" placeholder="Write your wish here..."></textarea>
      </div>
      <button class="submit-btn" onclick="submitWish()"><span class="lang-el" data-en="Send Wish 💕" data-my="Hantar Ucapan 💕">Send Wish 💕</span></button>
    </div>
  </div>

  <!-- ANG PAU -->
  <div class="card-section section-bg-1 reveal">
    <div class="section-ornament">🎁</div>
    <h2 class="section-heading lang-el" data-en="Digital Gift (Ang Pau)" data-my="Hadiah Digital (Ang Pau)">Digital Gift (Ang Pau)</h2>
    <p class="section-sub lang-el" data-en="Your presence is the greatest gift. If you wish to send a token of love:" data-my="Kehadiran anda adalah hadiah terbesar. Jika ingin menghantar tanda sayang:">Your presence is the greatest gift. If you wish to send a token of love:</p>
    <div class="floral-div"><span class="floral-div-icon">💝</span></div>
    <div class="angpau-cards">
      <div class="angpau-card">
        <div class="angpau-icon" style="background:rgba(0,180,100,0.1);">💚</div>
        <div class="angpau-info"><div class="angpau-name">Touch 'n Go eWallet</div><div class="angpau-num">012-345 6789</div></div>
        <button class="copy-btn" onclick="copyText('0123456789',this)">Copy</button>
      </div>
      <div class="angpau-card">
        <div class="angpau-icon" style="background:rgba(255,180,0,0.1);">🏦</div>
        <div class="angpau-info"><div class="angpau-name">Maybank</div><div class="angpau-num">1234 5678 9012</div></div>
        <button class="copy-btn" onclick="copyText('1234567890123',this)">Copy</button>
      </div>
    </div>
  </div>

  <!-- CLOSING -->
  <div class="card-closing reveal">
    <div class="closing-quote lang-el"
      data-en='"And of His signs is that He created for you from yourselves mates that you may find tranquility in them"'
      data-my='"Dan antara tanda-tanda kebesaran-Nya ialah Dia menciptakan untuk kamu isteri-isteri dari jenis kamu sendiri supaya kamu merasa tenteram"'>
      "And of His signs is that He created for you from yourselves mates that you may find tranquility in them"
    </div>
    <div class="closing-names">Hafizi &amp; Airen</div>
    <div class="closing-thank lang-el" data-en="Thank you for being part of our special day 🌸" data-my="Terima kasih kerana menjadi sebahagian daripada hari istimewa kami 🌸">Thank you for being part of our special day 🌸</div>
  </div>

  <!-- Back to top -->
  <button class="back-to-top" id="backToTop" onclick="window.scrollTo({top:0,behavior:'smooth'})">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
  </button>

</div><!-- end cardPage -->

<script>
// ── Language ──
let currentLang = 'en';
function setLang(lang) {
  currentLang = lang;
  document.querySelectorAll('.lang-btn').forEach((b,i) => b.classList.toggle('active', (i===0&&lang==='en')||(i===1&&lang==='my')));
  document.querySelectorAll('.lang-el').forEach(el => {
    const val = el.getAttribute('data-' + lang);
    if (val) el.innerHTML = val;
  });
}

// ── Envelope Open ──
let opened = false;

function openEnvelope() {
  if (opened) return;
  opened = true;

  const flap    = document.getElementById('envFlap');
  const seal    = document.getElementById('sealWrap');
  const overlay = document.getElementById('revealOverlay');
  const envPage = document.getElementById('envelopePage');
  const cardPage= document.getElementById('cardPage');

  // Hide seal label
  const label = seal.querySelector('.seal-label');
  if (label) { label.style.transition='opacity 0.3s'; label.style.opacity='0'; }

  // Flap + seal open together (seal is inside flap div already)
  setTimeout(() => {
    flap.style.transition = 'transform 3s cubic-bezier(0.4, 0, 0.2, 1)';
    flap.style.transform  = 'rotateX(-180deg)';
  }, 300);

  // White reveal starts at halfway
  setTimeout(() => {
    overlay.classList.add('reveal-in');
  }, 1800);

  // Switch to card
  setTimeout(() => {
    envPage.style.display = 'none';
    cardPage.classList.add('visible');
    cardPage.style.opacity = '1';
    startCountdown();
    initScrollReveal();
    // Fade white out
    setTimeout(() => {
      overlay.classList.remove('reveal-in');
      overlay.classList.add('reveal-out');
      setTimeout(() => overlay.classList.remove('reveal-out'), 1000);
    }, 200);
  }, 3000);
}

// ── Countdown ──
function startCountdown() {
  const wedding = new Date('2025-11-15T11:00:00');
  function update() {
    const diff = wedding - new Date();
    if (diff <= 0) { ['cdDays','cdHours','cdMins','cdSecs'].forEach(id => document.getElementById(id).textContent='00'); return; }
    document.getElementById('cdDays').textContent  = String(Math.floor(diff/86400000)).padStart(2,'0');
    document.getElementById('cdHours').textContent = String(Math.floor((diff%86400000)/3600000)).padStart(2,'0');
    document.getElementById('cdMins').textContent  = String(Math.floor((diff%3600000)/60000)).padStart(2,'0');
    document.getElementById('cdSecs').textContent  = String(Math.floor((diff%60000)/1000)).padStart(2,'0');
  }
  update(); setInterval(update, 1000);
}

// ── Scroll Reveal ──
function initScrollReveal() {
  const obs = new IntersectionObserver(entries => {
    entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('visible'); });
  }, {threshold:0.15});
  document.querySelectorAll('.reveal').forEach(el => obs.observe(el));

  // Back to top
  const btn = document.getElementById('backToTop');
  window.addEventListener('scroll', () => {
    btn.classList.toggle('visible', window.scrollY > window.innerHeight * 0.8);
  });
}

// ── RSVP ──
let attendChoice = '';
function selectAttend(val) {
  attendChoice = val;
  document.getElementById('btnYes').classList.toggle('selected', val==='yes');
  document.getElementById('btnNo').classList.toggle('selected', val==='no');
  document.getElementById('paxGroup').style.display = val==='yes' ? 'block' : 'none';
}

function submitRSVP() {
  const name = document.getElementById('rsvpName').value.trim();
  if (!name) { alert(currentLang==='en' ? 'Please enter your name' : 'Sila masukkan nama anda'); return; }
  if (!attendChoice) { alert(currentLang==='en' ? 'Please select attendance' : 'Sila pilih kehadiran'); return; }
  alert(currentLang==='en' ? `Thank you ${name}! Your RSVP has been received 💌` : `Terima kasih ${name}! RSVP anda telah diterima 💌`);
}

// ── Wishes ──
function submitWish() {
  const name = document.getElementById('wishName').value.trim();
  const text = document.getElementById('wishText').value.trim();
  if (!name||!text) { alert(currentLang==='en' ? 'Please fill in all fields' : 'Sila isi semua ruangan'); return; }
  const item = document.createElement('div');
  item.className = 'wish-item';
  item.innerHTML = `<div class="wish-name">${name}</div><div class="wish-text">${text}</div>`;
  document.getElementById('wishesList').prepend(item);
  document.getElementById('wishName').value = '';
  document.getElementById('wishText').value = '';
}

// ── Copy ──
function copyText(text, btn) {
  navigator.clipboard.writeText(text).then(() => {
    const orig = btn.textContent;
    btn.textContent = currentLang==='en' ? '✓ Copied!' : '✓ Disalin!';
    btn.style.background='var(--green)'; btn.style.color='white';
    setTimeout(() => { btn.textContent=orig; btn.style.background=''; btn.style.color=''; }, 2000);
  });
}
</script>
</body>
</html>