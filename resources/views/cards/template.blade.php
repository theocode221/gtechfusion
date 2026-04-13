<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="theme-color" content="#f5e6e0">
<title>{{ $card->groom_name }} & {{ $card->bride_name }} — Wedding Invitation</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,700;1,400;1,500&family=Great+Vibes&family=Jost:wght@200;300;400;500&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
:root{
  --rose:#c8667a;--rose-light:#e8a4b0;--rose-deep:#8b3a4a;
  --sage:#7a9e7e;--sage-light:#b8d4bb;
  --gold:#c9a84c;--gold-light:#e8d4a0;
  --cream:#fdf6ef;--dark:#1a0a14;
  --text:#2d1a22;--text-mid:#6b4a55;--text-light:#9b7a85;
  --font-display:'Playfair Display',serif;
  --font-script:'Great Vibes',cursive;
  --font-body:'Jost',sans-serif;
}
html{height:100%;overflow:hidden;}
body{height:100%;font-family:var(--font-body);color:var(--text);background:#f5e6e0;overflow:hidden;}

#petals-canvas{position:fixed;inset:0;pointer-events:none;z-index:9998;}

.toast{position:fixed;bottom:5rem;left:50%;transform:translateX(-50%) translateY(20px);background:rgba(26,10,20,0.88);color:white;padding:0.75rem 1.4rem;border-radius:999px;font-size:0.75rem;letter-spacing:0.08em;z-index:9000;opacity:0;transition:all 0.35s ease;pointer-events:none;border:1px solid rgba(201,168,76,0.3);backdrop-filter:blur(10px);}
.toast.show{opacity:1;transform:translateX(-50%) translateY(0);}

/* ── LANG TOGGLE ── */
.lang-toggle{position:fixed;top:1.2rem;right:1rem;bottom:auto;z-index:3000;display:flex;align-items:center;background:rgba(255,255,255,0.82);backdrop-filter:blur(16px);border:1px solid rgba(200,102,122,0.2);border-radius:999px;padding:0.2rem;box-shadow:0 4px 16px rgba(0,0,0,0.1);opacity:0;transition:opacity 0.5s ease;}
.lang-toggle.show{opacity:1;}
.lang-btn{padding:0.28rem 0.85rem;font-size:0.58rem;font-weight:500;letter-spacing:0.15em;text-transform:uppercase;border:none;background:none;cursor:pointer;border-radius:999px;color:var(--text-mid);transition:all 0.3s ease;font-family:var(--font-body);}
.lang-btn.active{background:var(--rose);color:white;box-shadow:0 2px 8px rgba(200,102,122,0.4);}

/* ── BURGER BTN ── */
.burger-btn{position:fixed;top:1.2rem;left:1rem;z-index:3000;width:44px;height:44px;border-radius:14px;background:rgba(255,255,255,0.82);backdrop-filter:blur(16px);border:1px solid rgba(200,102,122,0.2);display:flex;align-items:center;justify-content:center;flex-direction:column;gap:5px;cursor:pointer;box-shadow:0 4px 16px rgba(0,0,0,0.1);transition:all 0.3s ease;opacity:0;pointer-events:none;}
.burger-btn.show{opacity:1;pointer-events:all;}
.burger-btn:hover{background:var(--rose);}
.burger-btn:hover .burger-line{background:white;}
.burger-line{width:18px;height:1.5px;background:var(--rose-deep);border-radius:2px;transition:all 0.38s cubic-bezier(0.68,-0.55,0.265,1.55);transform-origin:center;}
.burger-btn.open{background:var(--rose);}
.burger-btn.open .burger-line{background:white;}
.burger-btn.open .burger-line:nth-child(1){transform:translateY(6.5px) rotate(45deg);}
.burger-btn.open .burger-line:nth-child(2){opacity:0;transform:scaleX(0);}
.burger-btn.open .burger-line:nth-child(3){transform:translateY(-6.5px) rotate(-45deg);}

/* ── NAV DRAWER ── */
.nav-overlay{position:fixed;inset:0;z-index:2400;background:rgba(26,10,20,0);pointer-events:none;transition:background 0.4s ease;}
.nav-overlay.show{background:rgba(26,10,20,0.35);pointer-events:all;}
.nav-drawer{position:fixed;top:0;left:0;bottom:0;width:285px;z-index:2500;background:rgba(253,246,239,0.97);backdrop-filter:blur(24px);border-right:1px solid rgba(200,102,122,0.12);box-shadow:8px 0 48px rgba(0,0,0,0.14);transform:translateX(-100%);transition:transform 0.46s cubic-bezier(0.34,1.56,0.64,1);display:flex;flex-direction:column;overflow:hidden;}
.nav-drawer.open{transform:translateX(0);}
.nav-header{padding:5rem 1.8rem 1.5rem;background:linear-gradient(160deg,rgba(200,102,122,0.07),rgba(122,158,126,0.05));border-bottom:1px solid rgba(200,102,122,0.1);}
.nav-header-names{font-family:var(--font-script);font-size:2.1rem;color:var(--rose-deep);line-height:1;}
.nav-header-date{font-size:0.57rem;letter-spacing:0.32em;text-transform:uppercase;color:var(--text-light);margin-top:0.3rem;}
.nav-items{flex:1;padding:0.8rem 0;overflow-y:auto;}
.nav-item{display:flex;align-items:center;gap:0.9rem;padding:0.85rem 1.6rem;cursor:pointer;position:relative;opacity:0;transform:translateX(-22px);transition:opacity 0.38s ease,transform 0.38s ease,background 0.2s ease;}
.nav-drawer.open .nav-item{opacity:1;transform:translateX(0);}
.nav-drawer.open .nav-item:nth-child(1){transition-delay:0.04s;}
.nav-drawer.open .nav-item:nth-child(2){transition-delay:0.09s;}
.nav-drawer.open .nav-item:nth-child(3){transition-delay:0.14s;}
.nav-drawer.open .nav-item:nth-child(4){transition-delay:0.19s;}
.nav-drawer.open .nav-item:nth-child(5){transition-delay:0.24s;}
.nav-drawer.open .nav-item:nth-child(6){transition-delay:0.29s;}
.nav-drawer.open .nav-item:nth-child(7){transition-delay:0.34s;}
.nav-item:hover{background:rgba(200,102,122,0.06);}
.nav-item::before{content:'';position:absolute;left:0;top:18%;bottom:18%;width:3px;border-radius:3px;background:linear-gradient(to bottom,var(--rose),var(--rose-light));opacity:0;transition:opacity 0.2s;}
.nav-item:hover::before{opacity:1;}
.nav-icon-wrap{width:40px;height:40px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0;}
.nav-label{font-size:0.83rem;font-weight:400;color:var(--text);}
.nav-desc{font-size:0.61rem;color:var(--text-light);margin-top:0.08rem;}
.nav-arrow{margin-left:auto;color:var(--rose-light);font-size:0.8rem;opacity:0;transition:opacity 0.2s,transform 0.2s;}
.nav-item:hover .nav-arrow{opacity:1;transform:translateX(3px);}
.nav-footer{padding:1.1rem 1.6rem;border-top:1px solid rgba(200,102,122,0.09);font-size:0.58rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--text-light);}

/* ── MUSIC & BACK-TO-TOP ── */
.music-btn{position:fixed;bottom:1.5rem;right:1.5rem;width:44px;height:44px;background:rgba(255,255,255,0.9);backdrop-filter:blur(12px);border:1px solid rgba(200,102,122,0.25);border-radius:50%;color:var(--rose);display:none;align-items:center;justify-content:center;cursor:pointer;z-index:2000;font-size:1.1rem;box-shadow:0 4px 16px rgba(0,0,0,0.1);transition:all 0.25s ease;}
.music-btn.show{display:flex;}
.music-btn:hover,.music-btn.playing{background:var(--rose);color:white;}
.music-btn.playing{animation:mPulse 1.5s ease-in-out infinite;}
@keyframes mPulse{0%,100%{box-shadow:0 4px 16px rgba(200,102,122,0.3);}50%{box-shadow:0 4px 28px rgba(200,102,122,0.6);}}
.back-to-top{position:fixed;bottom:5.5rem;right:1.5rem;width:44px;height:44px;background:rgba(255,255,255,0.9);backdrop-filter:blur(12px);border:1px solid rgba(200,102,122,0.25);border-radius:50%;color:var(--rose);display:flex;align-items:center;justify-content:center;cursor:pointer;z-index:2000;opacity:0;transform:translateY(20px);pointer-events:none;transition:all 0.4s ease;box-shadow:0 4px 16px rgba(0,0,0,0.1);}
.back-to-top.visible{opacity:1;transform:translateY(0);pointer-events:all;}
.back-to-top:hover{background:var(--rose);color:white;}

/* ── REVEAL OVERLAY ── */
.reveal-overlay{position:fixed;inset:0;background:rgba(255,255,255,0);z-index:700;pointer-events:none;transition:none;}
.reveal-overlay.reveal-in{transition:background 1s ease;background:rgba(255,255,255,1);}
.reveal-overlay.reveal-out{transition:background 1.2s ease;background:rgba(255,255,255,0);}

/* ── PROGRESS BAR ── */
.scroll-progress{position:fixed;top:0;left:0;height:2.5px;background:linear-gradient(to right,var(--rose-light),var(--gold),var(--sage-light));z-index:3500;width:0%;transition:width 0.1s linear;border-radius:0 2px 2px 0;}

/* ════════════════════════════
   ENVELOPE PAGE
════════════════════════════ */
#envelopePage{position:fixed;inset:0;z-index:500;overflow:hidden;background:linear-gradient(170deg,#f5d8c8 0%,#f2cfc8 30%,#e8ccd8 60%,#cfe0e8 100%);}
.star-field{position:absolute;inset:0;overflow:hidden;pointer-events:none;}
.star{position:absolute;border-radius:50%;opacity:0;animation:sTwinkle var(--dur,3s) ease-in-out infinite var(--delay,0s);}
@keyframes sTwinkle{0%,100%{opacity:0;transform:scale(0.5);}50%{opacity:var(--mop,0.5);transform:scale(1);}}
.envelope-wrap{position:absolute;inset:0;cursor:pointer;}
.env-frame{position:absolute;inset:0;opacity:0;transition:opacity 0.6s ease;pointer-events:none;}
.env-frame img{width:100%;height:100%;object-fit:cover;object-position:center top;display:block;}
.env-frame.active{opacity:1;pointer-events:all;}
.env-top-text{position:absolute;top:8%;left:8%;text-align:left;z-index:20;pointer-events:none;}
.env-invited-script{font-family:var(--font-script);font-size:clamp(2.4rem,9vw,3.6rem);color:rgba(92,40,55,0.75);text-shadow:0 2px 12px rgba(255,255,255,0.5);line-height:1.2;}
.env-invited-sub{font-size:0.57rem;letter-spacing:0.45em;text-transform:uppercase;color:rgba(92,40,55,0.38);margin-top:0.4rem;}
.tap-hint-wrap{position:absolute;bottom:8%;left:50%;transform:translateX(-50%);z-index:20;display:flex;flex-direction:column;align-items:center;gap:0.5rem;animation:hintFloat 2.5s ease-in-out infinite;}
@keyframes hintFloat{0%,100%{transform:translateX(-50%) translateY(0);}50%{transform:translateX(-50%) translateY(-7px);}}
.tap-hint-bubble{background:rgba(255,255,255,0.65);backdrop-filter:blur(10px);border:1.5px solid rgba(200,102,122,0.22);border-radius:999px;padding:0.6rem 1.5rem;display:flex;align-items:center;gap:0.6rem;box-shadow:0 4px 20px rgba(200,102,122,0.14),0 1px 0 rgba(255,255,255,0.8) inset;position:relative;}
.tap-hint-bubble::after{content:'';position:absolute;bottom:-7px;left:50%;transform:translateX(-50%);width:0;height:0;border-left:6px solid transparent;border-right:6px solid transparent;border-top:7px solid rgba(255,255,255,0.65);}
.tap-hint-emoji{font-size:1rem;animation:eWiggle 1.5s ease-in-out infinite;}
@keyframes eWiggle{0%,100%{transform:rotate(-10deg);}50%{transform:rotate(10deg);}}
.tap-hint-text{font-family:var(--font-display);font-style:italic;font-size:0.82rem;letter-spacing:0.05em;color:rgba(92,40,55,0.7);}
.tap-hint-dots{display:flex;gap:5px;margin-top:0.1rem;}
.tap-hint-dots span{width:5px;height:5px;border-radius:50%;background:rgba(200,102,122,0.45);animation:dBounce 1.2s ease-in-out infinite;}
.tap-hint-dots span:nth-child(2){animation-delay:0.15s;}.tap-hint-dots span:nth-child(3){animation-delay:0.3s;}
@keyframes dBounce{0%,100%{transform:translateY(0);opacity:0.4;}50%{transform:translateY(-5px);opacity:1;}}

/* ════════════════════════════
   CARD PAGE
════════════════════════════ */
#cardPage{display:none;position:fixed;inset:0;overflow-y:auto;overflow-x:hidden;background:var(--cream);scroll-behavior:smooth;}
#cardPage.visible{display:block;}

/* COVER */
.card-cover{position:relative;min-height:100vh;display:flex;align-items:center;justify-content:center;overflow:hidden;}
.cover-bg{position:absolute;inset:0;background:radial-gradient(ellipse at 20% 20%,rgba(200,102,122,0.13) 0%,transparent 50%),radial-gradient(ellipse at 80% 80%,rgba(122,158,126,0.13) 0%,transparent 50%),linear-gradient(160deg,#fdf0f4 0%,#fdf8f0 40%,#f0f7f2 100%);}
.cover-deco{position:absolute;border-radius:50%;border:1px solid rgba(201,168,76,0.11);animation:cRot var(--d,20s) linear infinite var(--dir,normal);}
@keyframes cRot{to{transform:rotate(360deg);}}
.cover-content{position:relative;z-index:5;text-align:center;padding:4rem 2rem;max-width:440px;width:100%;}
.cover-tag{font-size:0.55rem;letter-spacing:0.4em;text-transform:uppercase;color:var(--sage);display:flex;align-items:center;justify-content:center;gap:1rem;margin-bottom:1.2rem;opacity:0;animation:sDown 1s 0.2s ease forwards;}
.cover-tag::before,.cover-tag::after{content:'';width:28px;height:1px;background:linear-gradient(to right,transparent,var(--sage));}
.cover-tag::after{background:linear-gradient(to left,transparent,var(--sage));}
.cover-bismillah{font-family:var(--font-display);font-size:0.9rem;font-style:italic;color:var(--text-mid);margin-bottom:0.9rem;opacity:0;animation:sDown 1s 0.4s ease forwards;}
.cover-ornament{font-size:0.85rem;color:var(--gold);letter-spacing:0.5em;margin-bottom:0.6rem;opacity:0;animation:sDown 1s 0.5s ease forwards;}
.cover-names{font-family:var(--font-script);font-size:clamp(3rem,12vw,4.8rem);color:var(--text);line-height:1.05;position:relative;display:inline-block;opacity:0;animation:sDown 1.2s 0.6s ease forwards;}
.cover-names::after{content:'';position:absolute;left:50%;bottom:-6px;transform:translateX(-50%);width:0;height:1px;background:var(--gold);animation:lExp 1.5s 1.8s ease forwards;}
@keyframes lExp{to{width:80%;}}
.cover-amp{color:var(--rose);display:block;font-size:0.5em;animation:aFloat 3s ease-in-out infinite;}
@keyframes aFloat{0%,100%{transform:translateY(0);}50%{transform:translateY(-4px);}}
.cover-divider{display:flex;align-items:center;justify-content:center;gap:0.8rem;margin:1.6rem 0 1rem;opacity:0;animation:sDown 1s 0.9s ease forwards;}
.cover-divider::before,.cover-divider::after{content:'';flex:1;max-width:55px;height:1px;background:linear-gradient(to right,transparent,var(--gold));}
.cover-divider::after{background:linear-gradient(to left,transparent,var(--gold));}
.cover-divider span{color:var(--gold);font-size:0.7rem;animation:sStar 8s linear infinite;}
@keyframes sStar{to{transform:rotate(360deg);}}
.cover-subtitle{font-family:var(--font-display);font-size:0.92rem;font-style:italic;color:var(--text-mid);line-height:1.8;margin-bottom:2rem;opacity:0;animation:sDown 1s 1.1s ease forwards;}
.countdown{display:flex;gap:0.7rem;justify-content:center;margin-bottom:2rem;opacity:0;animation:sDown 1s 1.3s ease forwards;}
.cd-item{display:flex;flex-direction:column;align-items:center;gap:0.35rem;}
.cd-num{font-family:var(--font-display);font-size:1.55rem;font-weight:500;color:var(--text);background:rgba(255,255,255,0.88);border:1px solid rgba(201,168,76,0.22);border-radius:12px;width:52px;height:52px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 14px rgba(0,0,0,0.06),inset 0 1px 0 rgba(255,255,255,0.8);position:relative;overflow:hidden;}
.cd-num::before{content:'';position:absolute;top:0;left:0;right:0;height:50%;background:rgba(255,255,255,0.35);border-radius:12px 12px 0 0;}
.cd-num.flip{animation:nFlip 0.3s ease;}
@keyframes nFlip{0%{transform:scaleY(1);}50%{transform:scaleY(0.85);}100%{transform:scaleY(1);}}
.cd-label{font-size:0.48rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--text-light);}
.cd-sep{font-family:var(--font-display);font-size:1.6rem;color:var(--rose-light);align-self:center;margin-bottom:1.1rem;animation:sBlink 1s step-end infinite;}
@keyframes sBlink{0%,100%{opacity:1;}50%{opacity:0.2;}}
.scroll-hint{display:flex;flex-direction:column;align-items:center;gap:0.5rem;opacity:0;animation:fadeIn 1s 2s ease forwards;}
.scroll-hint span{font-size:0.54rem;letter-spacing:0.25em;text-transform:uppercase;color:var(--text-light);}
.sarrow span{display:block;width:1.5px;background:var(--rose-light);border-radius:1px;animation:dDown var(--d,.6s) ease-in-out infinite alternate var(--dl,0s);}
@keyframes dDown{0%{opacity:0.2;transform:scaleY(0.5);}100%{opacity:0.8;transform:scaleY(1);}}

/* SHARED SECTION */
.card-section{padding:5rem 1.5rem;max-width:520px;margin:0 auto;}
.section-tag{font-size:0.53rem;letter-spacing:0.4em;text-transform:uppercase;color:var(--text-light);text-align:center;margin-bottom:0.45rem;}
.section-ornament{text-align:center;margin-bottom:0.75rem;font-size:0.85rem;color:var(--rose-light);letter-spacing:0.4em;}
.section-heading{font-family:var(--font-display);font-size:clamp(1.7rem,5.5vw,2.3rem);font-weight:400;font-style:italic;color:var(--text);text-align:center;margin-bottom:0.45rem;}
.section-sub{font-size:0.78rem;font-weight:300;color:var(--text-light);text-align:center;line-height:1.9;margin-bottom:1.7rem;}
.floral-div{display:flex;align-items:center;justify-content:center;gap:0.8rem;margin:1.4rem 0;}
.floral-div::before,.floral-div::after{content:'';flex:1;height:1px;background:linear-gradient(to right,transparent,rgba(201,168,76,0.26));}
.floral-div::after{background:linear-gradient(to left,transparent,rgba(201,168,76,0.26));}
.s1{background:linear-gradient(160deg,#fdf8fc,#f8fcf9);}
.s2{background:linear-gradient(160deg,#fdf4f7,#f8fdf9);}
.s3{background:linear-gradient(160deg,#fdf0f5,#fdf8f0);}
.s4{background:linear-gradient(160deg,#f0f8f2,#fdf8f5);}
.s5{background:linear-gradient(160deg,#fdf8f5,#fdf0f6);}

/* INVITE CARD */
.invite-card{background:rgba(255,255,255,0.9);border:1px solid rgba(201,168,76,0.17);border-radius:20px;padding:2.2rem 1.8rem;text-align:center;box-shadow:0 8px 36px rgba(0,0,0,0.05);position:relative;overflow:hidden;}
.invite-card::before{content:'';position:absolute;top:-40px;left:-40px;width:110px;height:110px;border-radius:50%;background:radial-gradient(circle,rgba(232,164,176,0.1),transparent 70%);}
.invite-card::after{content:'';position:absolute;bottom:-40px;right:-40px;width:110px;height:110px;border-radius:50%;background:radial-gradient(circle,rgba(184,212,187,0.1),transparent 70%);}
.invite-from{font-size:0.56rem;letter-spacing:0.3em;text-transform:uppercase;color:var(--text-light);margin-bottom:0.9rem;}
.invite-parents{font-family:var(--font-display);font-size:0.93rem;color:var(--text);line-height:2;}
.invite-connector{font-size:0.7rem;color:var(--text-light);font-style:italic;margin:0.4rem 0;}
.invite-body{font-size:0.8rem;font-weight:300;color:var(--text-mid);line-height:1.9;margin-top:0.8rem;}

/* DETAIL CARDS */
.detail-cards{display:flex;flex-direction:column;gap:0.8rem;}
.detail-card{background:rgba(255,255,255,0.85);border:1px solid rgba(184,212,187,0.28);border-radius:16px;padding:1.1rem 1.3rem;display:flex;align-items:center;gap:1rem;box-shadow:0 2px 10px rgba(0,0,0,0.03);position:relative;overflow:hidden;transition:transform 0.3s,box-shadow 0.3s;}
.detail-card::before{content:'';position:absolute;left:0;top:15%;bottom:15%;width:3px;border-radius:3px;background:linear-gradient(to bottom,var(--rose-light),var(--sage-light));opacity:0;transition:opacity 0.3s;}
.detail-card:hover{transform:translateX(4px);box-shadow:0 6px 22px rgba(0,0,0,0.07);}
.detail-card:hover::before{opacity:1;}
.d-icon{width:44px;height:44px;background:linear-gradient(135deg,#e8f3e9,#fdf0f2);border-radius:13px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0;box-shadow:0 2px 8px rgba(0,0,0,0.05);}
.d-info{flex:1;}
.d-label{font-size:0.52rem;letter-spacing:0.25em;text-transform:uppercase;color:var(--text-light);margin-bottom:0.25rem;}
.d-value{font-family:var(--font-display);font-size:0.97rem;color:var(--text);}
.d-sub{font-size:0.7rem;color:var(--text-light);margin-top:0.1rem;}
.map-btn{display:flex;align-items:center;justify-content:center;gap:0.6rem;width:100%;padding:0.95rem;margin-top:1.1rem;background:linear-gradient(135deg,var(--sage),#5a8a60);color:white;border:none;border-radius:13px;cursor:pointer;font-family:var(--font-body);font-size:0.7rem;letter-spacing:0.15em;text-transform:uppercase;text-decoration:none;transition:all 0.3s;box-shadow:0 6px 18px rgba(90,138,96,0.3);}
.map-btn:hover{transform:translateY(-2px);box-shadow:0 10px 26px rgba(90,138,96,0.38);}

/* STORY TIMELINE */
.story-timeline{margin-top:1.5rem;}
.story-item{display:flex;gap:1rem;padding-bottom:1.8rem;position:relative;}
.story-item:last-child{padding-bottom:0;}
.story-dot-col{display:flex;flex-direction:column;align-items:center;width:32px;flex-shrink:0;}
.story-dot{width:12px;height:12px;border-radius:50%;border:2px solid white;flex-shrink:0;margin-top:3px;}
.story-line{flex:1;width:1.5px;background:linear-gradient(to bottom,var(--rose-light),var(--sage-light));margin-top:4px;}
.story-item:last-child .story-line{display:none;}
.story-year{font-size:0.57rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--rose);font-weight:500;margin-bottom:0.15rem;}
.story-title{font-family:var(--font-display);font-size:0.97rem;font-style:italic;color:var(--text);margin-bottom:0.2rem;}
.story-desc{font-size:0.76rem;color:var(--text-light);line-height:1.7;}

/* GALLERY */
.gallery-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:0.8rem;margin-top:1rem;}
.g-full{grid-column:span 2;aspect-ratio:16/9;}
.g-half{aspect-ratio:3/4;}
.gallery-item{border-radius:15px;border:1px solid rgba(201,168,76,0.12);display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative;transition:transform 0.4s;}
.gallery-item:hover{transform:scale(1.02);}
.g-bg{position:absolute;inset:0;}
.g-ph{position:relative;z-index:1;display:flex;flex-direction:column;align-items:center;gap:0.5rem;font-size:0.58rem;letter-spacing:0.18em;text-transform:uppercase;color:var(--text-light);opacity:0.55;}
.g-ph span:first-child{font-size:1.8rem;opacity:0.5;}
.gallery-img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;}

/* RSVP */
.rsvp-form{background:rgba(255,255,255,0.9);border:1px solid rgba(201,168,76,0.17);border-radius:20px;padding:1.8rem 1.6rem;box-shadow:0 8px 36px rgba(0,0,0,0.05);}
.form-group{margin-bottom:1.2rem;}
.form-label{display:block;font-size:0.56rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--text-light);margin-bottom:0.45rem;}
.form-input{width:100%;padding:0.8rem 1rem;background:rgba(255,255,255,0.9);border:1px solid rgba(184,212,187,0.38);border-radius:11px;font-family:var(--font-body);font-size:0.83rem;color:var(--text);outline:none;transition:border-color 0.25s,box-shadow 0.25s;}
.form-input:focus{border-color:var(--sage);box-shadow:0 0 0 3px rgba(122,158,126,0.1);}
.attend-btns{display:flex;gap:0.7rem;}
.attend-btn{flex:1;padding:0.75rem;border:1.5px solid rgba(184,212,187,0.33);background:transparent;border-radius:11px;font-family:var(--font-body);font-size:0.76rem;color:var(--text-mid);cursor:pointer;transition:all 0.25s;}
.attend-btn.selected{background:var(--sage);color:white;border-color:var(--sage);box-shadow:0 4px 12px rgba(122,158,126,0.3);}
.submit-btn{width:100%;padding:1rem;background:linear-gradient(135deg,var(--rose),var(--rose-deep));color:white;border:none;border-radius:13px;cursor:pointer;font-family:var(--font-body);font-size:0.73rem;letter-spacing:0.15em;text-transform:uppercase;margin-top:0.5rem;transition:all 0.3s;box-shadow:0 6px 18px rgba(200,102,122,0.32);}
.submit-btn:hover{transform:translateY(-2px);box-shadow:0 10px 26px rgba(200,102,122,0.4);}

/* RSVP STATS */
.rsvp-stats{display:flex;gap:0.8rem;margin-top:1.1rem;}
.stat-card{flex:1;background:rgba(255,255,255,0.8);border-radius:14px;padding:1rem;text-align:center;}
.stat-num{font-family:var(--font-display);font-size:1.75rem;font-weight:500;}
.stat-label{font-size:0.55rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--text-light);margin-top:0.2rem;}

/* WISHES */
.wishes-scroll{max-height:280px;overflow-y:auto;margin-bottom:1.3rem;scrollbar-width:thin;scrollbar-color:rgba(232,164,176,0.3) transparent;}
.wish-item{background:rgba(255,255,255,0.8);border:1px solid rgba(232,164,176,0.17);border-radius:13px;padding:1rem 1.2rem;margin-bottom:0.7rem;animation:wishIn 0.5s ease;}
@keyframes wishIn{from{opacity:0;transform:translateY(10px);}to{opacity:1;transform:translateY(0);}}
.wish-name{font-size:0.7rem;font-weight:500;color:var(--sage);margin-bottom:0.3rem;}
.wish-text{font-family:var(--font-display);font-style:italic;font-size:0.88rem;color:var(--text);line-height:1.7;}
.wish-form{background:rgba(255,255,255,0.9);border:1px solid rgba(201,168,76,0.17);border-radius:18px;padding:1.6rem 1.4rem;box-shadow:0 4px 18px rgba(0,0,0,0.04);}

/* ANG PAU */
.angpau-hero{background:linear-gradient(135deg,#8b3a4a,#c8667a);border-radius:20px;padding:1.8rem;text-align:center;color:white;margin-bottom:1.1rem;position:relative;overflow:hidden;}
.angpau-hero::before{content:'💝';position:absolute;font-size:5rem;opacity:0.09;top:-10px;right:-10px;}
.angpau-hero::after{content:'🌸';position:absolute;font-size:4rem;opacity:0.09;bottom:-10px;left:-10px;}
.ap-title{font-family:var(--font-script);font-size:1.9rem;margin-bottom:0.25rem;}
.ap-sub{font-size:0.68rem;letter-spacing:0.18em;opacity:0.72;}
.angpau-cards{display:flex;flex-direction:column;gap:0.85rem;}
.angpau-card{background:rgba(255,255,255,0.88);border:1px solid rgba(201,168,76,0.17);border-radius:15px;padding:1.2rem 1.4rem;display:flex;align-items:center;gap:1rem;transition:all 0.3s;box-shadow:0 2px 10px rgba(0,0,0,0.04);}
.angpau-card:hover{transform:translateY(-3px);box-shadow:0 10px 26px rgba(0,0,0,0.08);}
.ap-icon{width:44px;height:44px;border-radius:13px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0;}
.ap-info{flex:1;}
.ap-name{font-size:0.86rem;color:var(--text);}
.ap-num{font-size:0.7rem;color:var(--text-light);margin-top:0.15rem;}
.copy-btn{font-size:0.56rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--sage);border:1.5px solid rgba(122,158,126,0.28);background:none;border-radius:8px;padding:0.38rem 0.75rem;cursor:pointer;transition:all 0.25s;font-family:var(--font-body);}
.copy-btn:hover,.copy-btn.copied{background:var(--sage);color:white;border-color:var(--sage);}

/* CLOSING */
.card-closing{padding:6rem 2rem;text-align:center;position:relative;overflow:hidden;background:linear-gradient(160deg,#3d1a28 0%,#2a1020 50%,#3d1a28 100%);}
.closing-bg{position:absolute;inset:0;background:radial-gradient(ellipse at 30% 50%,rgba(200,102,122,0.18),transparent 50%),radial-gradient(ellipse at 70% 50%,rgba(201,168,76,0.1),transparent 50%);}
.closing-sparkles{position:absolute;inset:0;overflow:hidden;}
.csp{position:absolute;border-radius:50%;background:white;opacity:0;animation:spkFloat var(--dur,4s) ease-in-out infinite var(--dl,0s);}
@keyframes spkFloat{0%{opacity:0;transform:translateY(0) scale(0);}30%{opacity:var(--op,.8);}70%{opacity:var(--op,.8);}100%{opacity:0;transform:translateY(-80px) scale(0.5);}}
.closing-content{position:relative;z-index:5;}
.closing-quote{font-family:var(--font-display);font-style:italic;font-size:clamp(0.82rem,2.3vw,1rem);color:rgba(255,255,255,0.57);line-height:1.9;margin:0 auto 2.5rem;max-width:360px;border-left:2px solid rgba(201,168,76,0.3);padding-left:1.2rem;text-align:left;}
.closing-names{font-family:var(--font-script);font-size:clamp(2.5rem,8vw,3.4rem);color:white;margin-bottom:0.8rem;text-shadow:0 0 40px rgba(201,168,76,0.25);}
.closing-div{display:flex;align-items:center;justify-content:center;gap:0.8rem;margin:1rem 0;}
.closing-div::before,.closing-div::after{content:'';flex:1;max-width:55px;height:1px;background:linear-gradient(to right,transparent,rgba(201,168,76,0.4));}
.closing-div::after{background:linear-gradient(to left,transparent,rgba(201,168,76,0.4));}
.closing-div span{color:var(--gold);font-size:0.7rem;}
.closing-thank{font-size:0.72rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.3);}

/* SCROLL REVEAL */
.reveal{opacity:0;transform:translateY(36px);transition:opacity 0.85s ease,transform 0.85s ease;}
.reveal.visible{opacity:1;transform:translateY(0);}
.rd1{transition-delay:0.1s;}.rd2{transition-delay:0.2s;}.rd3{transition-delay:0.3s;}

@keyframes sDown{from{opacity:0;transform:translateY(-18px);}to{opacity:1;transform:translateY(0);}}
@keyframes fadeIn{from{opacity:0;}to{opacity:1;}}
@media(max-width:480px){.cd-num{width:46px;height:46px;font-size:1.35rem;}.card-section{padding:3.5rem 1.1rem;}.nav-drawer{width:265px;}}
</style>
</head>
<body>

{{-- Pass card data to JS --}}
<script>
const CARD = {
    slug:        "{{ $card->slug }}",
    groomName:   "{{ $card->groom_name }}",
    brideName:   "{{ $card->bride_name }}",
    weddingDate: "{{ $card->wedding_date->format('Y-m-d') }}",
    weddingTime: "{{ $card->wedding_time }}",
    rsvpUrl:     "{{ route('cards.rsvp.store', $card->slug) }}",
    wishUrl:     "{{ route('cards.wish.store', $card->slug) }}",
    csrfToken:   "{{ csrf_token() }}",
    attending:   {{ $attending }},
    declined:    {{ $declined }},
};
</script>

<canvas id="petals-canvas"></canvas>
<div class="toast" id="toast"></div>
<div class="scroll-progress" id="scrollProgress"></div>

<!-- Lang toggle -->
<div class="lang-toggle" id="langToggle">
  <button class="lang-btn active" onclick="setLang('en')">EN</button>
  <button class="lang-btn" onclick="setLang('my')">BM</button>
</div>

<!-- Burger -->
<button class="burger-btn" id="burgerBtn" onclick="toggleNav()">
  <div class="burger-line"></div>
  <div class="burger-line"></div>
  <div class="burger-line"></div>
</button>

<!-- Nav overlay + drawer -->
<div class="nav-overlay" id="navOverlay" onclick="closeNav()"></div>
<div class="nav-drawer" id="navDrawer">
  <div class="nav-header">
    <div class="nav-header-names">{{ $card->groom_name_card ?: $card->groom_name }} & {{ $card->bride_name_card ?: $card->bride_name }}</div>
    <div class="nav-header-date">✦ {{ $card->wedding_date->format('d F Y') }} ✦</div>
  </div>
  <div class="nav-items">
    <div class="nav-item" onclick="goTo('sec-cover')">
      <div class="nav-icon-wrap" style="background:linear-gradient(135deg,#fde8ef,#fdf5e8);">🏡</div>
      <div><div class="nav-label">Home</div><div class="nav-desc">Countdown & cover</div></div>
      <span class="nav-arrow">›</span>
    </div>
    <div class="nav-item" onclick="goTo('sec-invite')">
      <div class="nav-icon-wrap" style="background:linear-gradient(135deg,#fce8f2,#fde8fc);">💌</div>
      <div><div class="nav-label">Invitation</div><div class="nav-desc">From both families</div></div>
      <span class="nav-arrow">›</span>
    </div>
    <div class="nav-item" onclick="goTo('sec-details')">
      <div class="nav-icon-wrap" style="background:linear-gradient(135deg,#e8f3e9,#e8f0fe);">📅</div>
      <div><div class="nav-label">Wedding Details</div><div class="nav-desc">Date, time & venue</div></div>
      <span class="nav-arrow">›</span>
    </div>
    <div class="nav-item" onclick="goTo('sec-story')">
      <div class="nav-icon-wrap" style="background:linear-gradient(135deg,#fdf0e8,#fce8f0);">💕</div>
      <div><div class="nav-label">Our Story</div><div class="nav-desc">How we found each other</div></div>
      <span class="nav-arrow">›</span>
    </div>
    <div class="nav-item" onclick="goTo('sec-rsvp')">
      <div class="nav-icon-wrap" style="background:linear-gradient(135deg,#e8f5e9,#f0fee8);">✅</div>
      <div><div class="nav-label">RSVP</div><div class="nav-desc">Confirm your attendance</div></div>
      <span class="nav-arrow">›</span>
    </div>
    <div class="nav-item" onclick="goTo('sec-wishes')">
      <div class="nav-icon-wrap" style="background:linear-gradient(135deg,#fde8fc,#fce8e8);">🌸</div>
      <div><div class="nav-label">Wishes Wall</div><div class="nav-desc">Send your love & wishes</div></div>
      <span class="nav-arrow">›</span>
    </div>
    <div class="nav-item" onclick="goTo('sec-gift')">
      <div class="nav-icon-wrap" style="background:linear-gradient(135deg,#fdf5e8,#fde8e8);">🎁</div>
      <div><div class="nav-label">Digital Gift</div><div class="nav-desc">Ang pau & e-wallet</div></div>
      <span class="nav-arrow">›</span>
    </div>
  </div>
  <div class="nav-footer">{{ $card->groom_name_card ?: $card->groom_name }} & {{ $card->bride_name_card ?: $card->bride_name }} Wedding · {{ $card->wedding_date->format('Y') }}</div>
</div>

<div class="reveal-overlay" id="revealOverlay"></div>

<!-- ════════════ ENVELOPE PAGE ════════════ -->
<div id="envelopePage">
  <div class="star-field" id="starField"></div>
  <div class="envelope-wrap" id="envelopeWrap" onclick="openEnvelope()">
    <div class="env-frame active" id="envFrame1"><img src="/public/images/env-1.png" alt=""></div>
    <div class="env-frame" id="envFrame2"><img src="/public/images/env-2.png" alt=""></div>
    <div class="env-frame" id="envFrame3"><img src="/public/images/env-3.png" alt=""></div>
    <div class="env-top-text">
      <div class="env-invited-script lang-el" data-en="You're<br>Invited" data-my="Anda<br>Dijemput">You're<br>Invited</div>
      <div class="env-invited-sub">✦ {{ $card->groom_name_card ?: $card->groom_name }} &amp; {{ $card->bride_name_card ?: $card->bride_name }} ✦</div>
    </div>
    <div class="tap-hint-wrap" id="tapHint">
      <div class="tap-hint-bubble">
        <span class="tap-hint-emoji">💌</span>
        <span class="tap-hint-text lang-el" data-en="tap to open" data-my="ketuk untuk buka">tap to open</span>
        <span class="tap-hint-emoji">✨</span>
      </div>
      <div class="tap-hint-dots"><span></span><span></span><span></span></div>
    </div>
  </div>
</div>

<!-- ════════════ CARD PAGE ════════════ -->
<div id="cardPage">

  <!-- 1. HOME / COVER -->
  <div id="sec-cover" class="card-cover">
    <div class="cover-bg"></div>
    <div class="cover-deco" style="width:380px;height:380px;top:-110px;right:-110px;--d:28s;opacity:0.22;"></div>
    <div class="cover-deco" style="width:260px;height:260px;bottom:-80px;left:-80px;--d:22s;--dir:reverse;opacity:0.16;"></div>
    <div class="cover-content">
      <div class="cover-tag lang-el" data-en="Wedding Invitation" data-my="Jemputan Perkahwinan">Wedding Invitation</div>
      <div class="cover-bismillah">Bismillahirrahmanirrahim</div>
      <div class="cover-ornament">✦ ✦ ✦</div>
<div class="cover-names">
        {{ $card->groom_name_card ?: $card->groom_name }} <span class="cover-amp">&</span> {{ $card->bride_name_card ?: $card->bride_name }}
      </div>
      <div class="cover-divider"><span>✦</span></div>
      <div class="cover-subtitle lang-el"
        data-en="Together with their families,<br>invite you to celebrate their union"
        data-my="Bersama keluarga menjemput anda<br>meraikan perkahwinan mereka">
        Together with their families,<br>invite you to celebrate their union
      </div>
      <div class="countdown">
        <div class="cd-item"><div class="cd-num" id="cdDays">--</div><div class="cd-label lang-el" data-en="Days" data-my="Hari">Days</div></div>
        <div class="cd-sep">:</div>
        <div class="cd-item"><div class="cd-num" id="cdHours">--</div><div class="cd-label lang-el" data-en="Hours" data-my="Jam">Hours</div></div>
        <div class="cd-sep">:</div>
        <div class="cd-item"><div class="cd-num" id="cdMins">--</div><div class="cd-label lang-el" data-en="Mins" data-my="Minit">Mins</div></div>
        <div class="cd-sep">:</div>
        <div class="cd-item"><div class="cd-num" id="cdSecs">--</div><div class="cd-label lang-el" data-en="Secs" data-my="Saat">Secs</div></div>
      </div>
      <div class="scroll-hint">
        <span class="lang-el" data-en="scroll to explore" data-my="tatal untuk lihat">scroll to explore</span>
        <div class="sarrow" style="display:flex;flex-direction:column;align-items:center;gap:2px;">
          <span style="height:20px;--d:.5s;--dl:0s;"></span>
          <span style="height:16px;--d:.5s;--dl:.15s;"></span>
          <span style="height:12px;--d:.5s;--dl:.3s;"></span>
        </div>
      </div>
    </div>
  </div>

  <!-- 2. INVITATION -->
  <div id="sec-invite" class="card-section s1 reveal">
    <div class="section-ornament">✿ ✦ ✿</div>
    <div class="section-tag">With Love from Both Families</div>
    <h2 class="section-heading lang-el" data-en="You Are Warmly Invited" data-my="Anda Dijemput Hadir">You Are Warmly Invited</h2>
    <div class="floral-div"><span>🌸</span></div>
    <div class="invite-card reveal rd1">
      <div class="invite-from lang-el" data-en="With love from both families" data-my="Dengan penuh kasih dari kedua keluarga">With love from both families</div>
      @if($card->groom_father || $card->groom_mother)
      <div class="invite-parents">
        {{ $card->groom_father ?? '' }}@if($card->groom_father && $card->groom_mother)<br>&amp; @endif{{ $card->groom_mother ?? '' }}
      </div>
      @endif
      <div class="invite-connector lang-el" data-en="— together with —" data-my="— berserta —">— together with —</div>
      @if($card->bride_father || $card->bride_mother)
      <div class="invite-parents">
        {{ $card->bride_father ?? '' }}@if($card->bride_father && $card->bride_mother)<br>&amp; @endif{{ $card->bride_mother ?? '' }}
      </div>
      @endif
      <div class="floral-div" style="margin:1rem 0;"><span>🌿</span></div>
      <div class="invite-body lang-el"
        data-en="cordially invite you to the wedding reception of their beloved children"
        data-my="dengan penuh hormat menjemput anda ke majlis perkahwinan anak-anak mereka yang dikasihi">
        cordially invite you to the wedding reception of their beloved children
      </div>
    </div>
  </div>

  <!-- 3. WEDDING DETAILS -->
  <div id="sec-details" class="card-section s2 reveal">
    <div class="section-ornament">✦</div>
    <div class="section-tag">Mark Your Calendar</div>
    <h2 class="section-heading lang-el" data-en="Wedding Details" data-my="Butiran Majlis">Wedding Details</h2>
    <div class="floral-div"><span>🌿</span></div>
    <div class="detail-cards">
      <div class="detail-card reveal rd1">
        <div class="d-icon">📅</div>
        <div class="d-info">
          <div class="d-label">Date</div>
          <div class="d-value">{{ $card->wedding_date->format('l, d F Y') }}</div>
          @if($card->hijri_date)
          <div class="d-sub">{{ $card->hijri_date }}</div>
          @endif
        </div>
      </div>
      <div class="detail-card reveal rd2">
        <div class="d-icon">🕐</div>
        <div class="d-info">
          <div class="d-label">Time</div>
          <div class="d-value">{{ $card->wedding_time }}</div>
          <div class="d-sub">Lunch Reception</div>
        </div>
      </div>
      <div class="detail-card reveal rd3">
        <div class="d-icon">🏛️</div>
        <div class="d-info">
          <div class="d-label">Venue</div>
          <div class="d-value">{{ $card->venue_name }}</div>
          <div class="d-sub">{{ $card->venue_address }}</div>
        </div>
      </div>
      @if($card->dress_code)
      <div class="detail-card reveal">
        <div class="d-icon">👗</div>
        <div class="d-info">
          <div class="d-label">Dress Code</div>
          <div class="d-value">{{ $card->dress_code }}</div>
        </div>
      </div>
      @endif
    </div>
    @if($card->maps_url)
    <a href="{{ $card->maps_url }}" target="_blank" class="map-btn reveal">
      📍 &nbsp;<span>Get Directions on Google Maps</span>
    </a>
    @endif
  </div>

  <!-- 4. OUR STORY + GALLERY -->
  <div id="sec-story" class="card-section s3 reveal">
    <div class="section-ornament">✿</div>
    <div class="section-tag">Our Journey Together</div>
    <h2 class="section-heading lang-el" data-en="Our Story" data-my="Kisah Kami">Our Story</h2>
    <p class="section-sub">Every love story is beautiful, but ours is our favourite ♡</p>
    <div class="floral-div"><span>💕</span></div>

{{-- Story timeline — dynamic from DB --}}
    @php
      $stories = [];
      for ($i = 1; $i <= 4; $i++) {
        if ($card->{"story_{$i}_title"}) {
          $stories[] = [
            'year'  => $card->{"story_{$i}_year"} ?? '',
            'title' => $card->{"story_{$i}_title"},
            'desc'  => $card->{"story_{$i}_desc"} ?? '',
          ];
        }
      }
      if (empty($stories)) {
        $stories = [
          ['year'=>'First Chapter',    'title'=>'How It All Began ✨',     'desc'=>'Two hearts finding each other, a story written in the stars. Every moment together was a step towards forever.'],
          ['year'=>'Growing Together', 'title'=>'Through Every Season 🌿', 'desc'=>'Through challenges and joy, laughter and tears, they stood by each other, growing stronger with every passing day.'],
          ['year'=>'The Proposal',     'title'=>'A Promise Made 💍',       'desc'=>'Under a sky full of stars, with flowers all around, came a question that changed everything. The answer was always yes.'],
          ['year'=>$card->wedding_date->format('Y'), 'title'=>'Forever Begins 🌸', 'desc'=>'And now, we invite you to witness the beginning of our forever. Thank you for being part of this beautiful chapter.'],
        ];
      }
      $dotColors = ['var(--rose-light)','var(--sage-light)','var(--gold-light)','var(--rose)'];
    @endphp
<div class="story-timeline reveal rd1">
      @foreach($stories as $i => $story)
      <div class="story-item">
        <div class="story-dot-col">
          <div class="story-dot" style="background:{{ $dotColors[$i] ?? 'var(--rose)' }};box-shadow:0 0 0 2px {{ $dotColors[$i] ?? 'var(--rose)' }};"></div>
          @if(!$loop->last)<div class="story-line"></div>@endif
        </div>
        <div>
          <div class="story-year">{{ $story['year'] }}</div>
          <div class="story-title">{{ $story['title'] }}</div>
          <div class="story-desc">{{ $story['desc'] }}</div>
        </div>
      </div>
      @endforeach
    </div>

    {{-- Photo Gallery --}}
    <div style="margin-top:2rem;">
      <div class="section-tag" style="margin-bottom:0.8rem;">📸 Prewedding Photos</div>
      <div class="gallery-grid">
        <div class="gallery-item g-full reveal">
          @if($card->photo_1)
            <img class="gallery-img" src="{{ Storage::url($card->photo_1) }}" alt="Prewedding Photo 1">
          @else
            <div class="g-bg" style="background:linear-gradient(135deg,#f5e0e8,#e8eff5);"></div>
            <div class="g-ph"><span>🌸</span><span>Photo coming soon</span></div>
          @endif
        </div>
        <div class="gallery-item g-half reveal rd1">
          @if($card->photo_2)
            <img class="gallery-img" src="{{ Storage::url($card->photo_2) }}" alt="Prewedding Photo 2">
          @else
            <div class="g-bg" style="background:linear-gradient(135deg,#e8f2e9,#f5e8ef);"></div>
            <div class="g-ph"><span>🌿</span></div>
          @endif
        </div>
        <div class="gallery-item g-half reveal rd2">
          @if($card->photo_3)
            <img class="gallery-img" src="{{ Storage::url($card->photo_3) }}" alt="Prewedding Photo 3">
          @else
            <div class="g-bg" style="background:linear-gradient(135deg,#fdf0e8,#f5e8ef);"></div>
            <div class="g-ph"><span>💐</span></div>
          @endif
        </div>
      </div>
    </div>

  </div>{{-- end sec-story --}}

  <!-- 5. RSVP -->
  <div id="sec-rsvp" class="card-section s4 reveal">
    <div class="section-ornament">✦</div>
    <div class="section-tag">Let Us Know You're Coming</div>
    <h2 class="section-heading lang-el" data-en="Will You Join Us?" data-my="Adakah Anda Hadir?">Will You Join Us?</h2>
    @if($card->rsvp_deadline)
    <p class="section-sub">
      Kindly RSVP by {{ $card->rsvp_deadline->format('d F Y') }}
    </p>
    @endif
    <div class="floral-div"><span>✉️</span></div>
    <div class="rsvp-form reveal rd1">
      <div class="form-group">
        <label class="form-label">Your Full Name</label>
        <input type="text" class="form-input" id="rsvpName" placeholder="e.g. Ahmad bin Hassan">
      </div>
      <div class="form-group">
        <label class="form-label">Phone Number</label>
        <input type="tel" class="form-input" id="rsvpPhone" placeholder="e.g. 012-345 6789">
      </div>
      <div class="form-group">
        <label class="form-label">Attendance</label>
        <div class="attend-btns">
          <button class="attend-btn" id="btnYes" onclick="selectAttend('yes')">✓ Yes, I'll be there!</button>
          <button class="attend-btn" id="btnNo" onclick="selectAttend('no')">✗ Regretfully no</button>
        </div>
      </div>
      <div class="form-group" id="paxGroup" style="display:none;">
        <label class="form-label">Number of Guests (including yourself)</label>
        <input type="number" class="form-input" id="rsvpPax" min="1" max="20" placeholder="1">
      </div>
      <button class="submit-btn" onclick="submitRSVP()">Send RSVP 💌</button>
    </div>
    <div class="rsvp-stats reveal rd2">
      <div class="stat-card" style="border:1px solid rgba(122,158,126,0.22);">
        <div class="stat-num" style="color:var(--sage);" id="statAttending">{{ $attending }}</div>
        <div class="stat-label">Attending</div>
      </div>
      <div class="stat-card" style="border:1px solid rgba(200,102,122,0.18);">
        <div class="stat-num" style="color:var(--rose);" id="statDeclined">{{ $declined }}</div>
        <div class="stat-label">Declined</div>
      </div>
    </div>
  </div>

  <!-- 6. WISHES WALL -->
  <div id="sec-wishes" class="card-section s5 reveal">
    <div class="section-ornament">💌</div>
    <div class="section-tag">Leave A Message</div>
    <h2 class="section-heading lang-el" data-en="Wishes Wall" data-my="Dinding Ucapan">Wishes Wall</h2>
    <p class="section-sub">Your heartfelt wishes mean the world to us 🌸</p>
    <div class="floral-div"><span>🌸</span></div>
    <div class="wishes-scroll" id="wishesList">
      @forelse($wishes as $wish)
      <div class="wish-item">
        <div class="wish-name">{{ $wish->guest_name }}</div>
        <div class="wish-text">{{ $wish->message }}</div>
      </div>
      @empty
      <div style="text-align:center;padding:2rem;color:var(--text-light);font-size:0.8rem;">
        Be the first to send your wishes 🌸
      </div>
      @endforelse
    </div>
    <div class="wish-form reveal rd1">
      <div class="form-group">
        <label class="form-label">Your Name</label>
        <input type="text" class="form-input" id="wishName" placeholder="Your name">
      </div>
      <div class="form-group">
        <label class="form-label">Your Wish</label>
        <textarea class="form-input" id="wishText" rows="3" placeholder="Write your wish here..."></textarea>
      </div>
      <button class="submit-btn" onclick="submitWish()">Send Wish 💕</button>
    </div>
  </div>

  <!-- 7. DIGITAL GIFT -->
  <div id="sec-gift" class="card-section s1 reveal">
    <div class="section-ornament">🎁</div>
    <div class="section-tag">Token of Love</div>
    <h2 class="section-heading lang-el" data-en="Digital Gift" data-my="Hadiah Digital">Digital Gift</h2>
    <p class="section-sub">Your presence is the greatest gift of all.<br>But if you wish to send a little token of love:</p>
    <div class="floral-div"><span>💝</span></div>
    <div class="angpau-hero reveal rd1">
      <div class="ap-title">Ang Pau Digital</div>
      <div class="ap-sub">✦ Safe · Fast · Cashless ✦</div>
    </div>
    <div class="angpau-cards">
      @if($card->tng_number)
      <div class="angpau-card reveal rd1">
        <div class="ap-icon" style="background:rgba(0,180,100,0.1);">💚</div>
        <div class="ap-info">
          <div class="ap-name">Touch 'n Go eWallet</div>
          <div class="ap-num">{{ $card->tng_number }} · {{ $card->groom_name }}</div>
        </div>
        <button class="copy-btn" onclick="copyNum('{{ $card->tng_number }}',this)">Copy</button>
      </div>
      @endif
      @if($card->bank_number)
      <div class="angpau-card reveal rd2">
        <div class="ap-icon" style="background:rgba(255,180,0,0.1);">🏦</div>
        <div class="ap-info">
          <div class="ap-name">{{ $card->bank_name ?? 'Bank Transfer' }}</div>
          <div class="ap-num">{{ $card->bank_number }} · {{ $card->bank_holder ?? $card->groom_name }}</div>
        </div>
        <button class="copy-btn" onclick="copyNum('{{ $card->bank_number }}',this)">Copy</button>
      </div>
      @endif
@if($card->qr_image)
      <div class="angpau-card reveal rd3">
        <div style="width:100%;text-align:center;padding:0.5rem 0;">
          <div style="font-size:0.58rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--text-light);margin-bottom:0.8rem;">
            📱 DuitNow / QR Pay — All banks supported
          </div>
          <img src="{{ Storage::url($card->qr_image) }}"
            alt="QR Code"
            id="qrThumb"
            onclick="openQR()"
            style="width:180px;height:180px;object-fit:contain;border-radius:12px;border:1px solid rgba(201,168,76,0.17);background:white;padding:8px;cursor:zoom-in;transition:transform 0.2s;">
          <div style="font-size:0.65rem;color:var(--text-light);margin-top:0.6rem;">
            Tap to enlarge · Scan with any banking app
          </div>
        </div>
      </div>
      @endif

      @if(!$card->tng_number && !$card->bank_number && !$card->qr_image)
      <div style="text-align:center;padding:1.5rem;color:var(--text-light);font-size:0.8rem;">
        Payment info coming soon 💝
      </div>
      @endif
    </div>
  </div>

  <!-- CLOSING -->
  <div class="card-closing reveal">
    <div class="closing-bg"></div>
    <div class="closing-sparkles" id="closingSparkles"></div>
    <div class="closing-content">
      <div class="closing-quote">"And of His signs is that He created for you from yourselves mates that you may find tranquility in them, and He placed between you affection and mercy."<br><br>— Ar-Rum 30:21</div>
      <div class="closing-names">{{ $card->groom_name_card ?: $card->groom_name }} &amp; {{ $card->bride_name_card ?: $card->bride_name }}</div>
      <div class="closing-div"><span>✦</span></div>
      <div class="closing-thank lang-el"
        data-en="Thank you for being part of our special day 🌸"
        data-my="Terima kasih kerana menjadi sebahagian daripada hari istimewa kami 🌸">
        Thank you for being part of our special day 🌸
      </div>
    </div>
  </div>

</div><!-- end cardPage -->

<button class="music-btn" id="musicBtn" onclick="toggleMusic()">♪</button>
<button class="back-to-top" id="backToTop" onclick="document.getElementById('cardPage').scrollTo({top:0,behavior:'smooth'})">
  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
</button>

{{-- QR Lightbox --}}
<div id="qrLightbox" onclick="closeQR()"
  style="display:none;position:fixed;inset:0;z-index:9500;background:rgba(0,0,0,0.85);backdrop-filter:blur(8px);align-items:center;justify-content:center;flex-direction:column;gap:1rem;">
  <img src="{{ Storage::url($card->qr_image ?? '') }}"
    style="width:min(85vw,380px);height:min(85vw,380px);object-fit:contain;background:white;border-radius:20px;padding:16px;box-shadow:0 20px 60px rgba(0,0,0,0.5);">
  <div style="font-size:0.65rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.4);">
    Tap anywhere to close
  </div>
</div>

<script>
// ══ BOKEH
(function(){
  const sf=document.getElementById('starField');
  const c=['rgba(255,200,180,.5)','rgba(255,230,210,.4)','rgba(200,220,240,.3)','rgba(255,255,255,.5)'];
  for(let i=0;i<25;i++){const s=document.createElement('div');s.className='star';const z=4+Math.random()*14;s.style.cssText=`width:${z}px;height:${z}px;left:${Math.random()*100}%;top:${Math.random()*100}%;--dur:${3+Math.random()*5}s;--delay:${Math.random()*5}s;--mop:${.2+Math.random()*.4};background:${c[Math.floor(Math.random()*c.length)]};filter:blur(${2+Math.random()*5}px);`;sf.appendChild(s);}
})();

// ══ PETALS
(function(){
  const cv=document.getElementById('petals-canvas'),ctx=cv.getContext('2d');
  let pts=[],W,H,on=false;
  function rs(){W=cv.width=innerWidth;H=cv.height=innerHeight;}rs();addEventListener('resize',rs);
  const cl=['#e8a4b0','#f5c8d2','#b8d4bb','#c8e8ca','#fde8c0','#f9d4e0'];
  function mk(){return{x:Math.random()*W,y:-20,sz:4+Math.random()*8,c:cl[Math.floor(Math.random()*cl.length)],vy:.8+Math.random()*1.5,vx:(Math.random()-.5)*.8,r:Math.random()*360,rs:(Math.random()-.5)*2,op:.4+Math.random()*.4,w:Math.random()*Math.PI*2,ws:.02+Math.random()*.02};}
  window._spawnPetals=function(n){for(let i=0;i<n;i++)pts.push(mk());on=true;};
  function dp(p){ctx.save();ctx.translate(p.x,p.y);ctx.rotate(p.r*Math.PI/180);ctx.globalAlpha=p.op;ctx.fillStyle=p.c;ctx.beginPath();ctx.ellipse(0,0,p.sz,p.sz*.6,0,0,Math.PI*2);ctx.fill();ctx.restore();}
  (function lp(){if(on){ctx.clearRect(0,0,W,H);if(Math.random()<.12)pts.push(mk());pts=pts.filter(p=>p.y<H+30);pts.forEach(p=>{p.y+=p.vy;p.w+=p.ws;p.x+=p.vx+Math.sin(p.w)*.5;p.r+=p.rs;dp(p);});}requestAnimationFrame(lp);})();
})();

// ══ LANGUAGE
let lang='en';
function setLang(l){lang=l;document.querySelectorAll('.lang-btn').forEach((b,i)=>b.classList.toggle('active',(i===0&&l==='en')||(i===1&&l==='my')));document.querySelectorAll('.lang-el').forEach(el=>{const v=el.getAttribute('data-'+l);if(v)el.innerHTML=v;});}

// ══ NAV
let navOpen=false;
function toggleNav(){navOpen?closeNav():openNav();}
function openNav(){navOpen=true;document.getElementById('burgerBtn').classList.add('open');document.getElementById('navDrawer').classList.add('open');document.getElementById('navOverlay').classList.add('show');}
function closeNav(){navOpen=false;document.getElementById('burgerBtn').classList.remove('open');document.getElementById('navDrawer').classList.remove('open');document.getElementById('navOverlay').classList.remove('show');}
function goTo(id){
  closeNav();
  setTimeout(()=>{
    const el=document.getElementById(id);
    const cp=document.getElementById('cardPage');
    if(el&&cp){cp.scrollTo({top:el.offsetTop,behavior:'smooth'});}
  },380);
}

// ══ ENVELOPE
let opened=false;
function openEnvelope(){
  if(opened)return;opened=true;
  const hint=document.getElementById('tapHint');
  if(hint){hint.style.transition='opacity .3s';hint.style.opacity='0';}
  if(window._spawnPetals)window._spawnPetals(12);
  setTimeout(()=>{document.getElementById('envFrame1').classList.remove('active');document.getElementById('envFrame2').classList.add('active');},300);
  setTimeout(()=>{document.getElementById('envFrame2').classList.remove('active');document.getElementById('envFrame3').classList.add('active');},1300);
  setTimeout(()=>document.getElementById('revealOverlay').classList.add('reveal-in'),2100);
  setTimeout(()=>{
    document.getElementById('envelopePage').style.display='none';
    const cp=document.getElementById('cardPage');cp.classList.add('visible');
    document.getElementById('burgerBtn').classList.add('show');
    document.getElementById('langToggle').classList.add('show');
    document.getElementById('musicBtn').classList.add('show');
    startCountdown();initCard();buildSparkles();
    setTimeout(()=>{
      document.getElementById('revealOverlay').classList.remove('reveal-in');
      document.getElementById('revealOverlay').classList.add('reveal-out');
      setTimeout(()=>document.getElementById('revealOverlay').classList.remove('reveal-out'),1200);
      if(window._spawnPetals)window._spawnPetals(28);
    },200);
  },2900);
}

// ══ COUNTDOWN — uses CARD.weddingDate from PHP
function startCountdown(){
  const wd = new Date(CARD.weddingDate + 'T' + CARD.weddingTime.substring(0,5));
  const ids=['cdDays','cdHours','cdMins','cdSecs'];const prev={};
  function upd(){
    const diff=wd-new Date();
    if(diff<=0){ids.forEach(id=>document.getElementById(id).textContent='00');return;}
    const v=[Math.floor(diff/86400000),Math.floor((diff%86400000)/3600000),Math.floor((diff%3600000)/60000),Math.floor((diff%60000)/1000)];
    ids.forEach((id,i)=>{const el=document.getElementById(id);const s=String(v[i]).padStart(2,'0');if(prev[id]!==s){el.classList.remove('flip');void el.offsetWidth;el.classList.add('flip');el.textContent=s;prev[id]=s;}});
  }
  upd();setInterval(upd,1000);
}

// ══ INIT CARD
function initCard(){
  const cp=document.getElementById('cardPage');
  const obs=new IntersectionObserver(e=>{e.forEach(x=>{if(x.isIntersecting)x.target.classList.add('visible');});},{threshold:.08,rootMargin:'0px 0px -20px 0px',root:cp});
  document.querySelectorAll('.reveal').forEach(el=>obs.observe(el));
  const prog=document.getElementById('scrollProgress');
  const btn=document.getElementById('backToTop');
  cp.addEventListener('scroll',()=>{
    prog.style.width=(cp.scrollTop/(cp.scrollHeight-cp.clientHeight)*100)+'%';
    btn.classList.toggle('visible',cp.scrollTop>innerHeight*.5);
  });
}

// ══ SPARKLES
function buildSparkles(){
  const c=document.getElementById('closingSparkles');
  for(let i=0;i<30;i++){const s=document.createElement('div');s.className='csp';s.style.cssText=`left:${Math.random()*100}%;bottom:${Math.random()*100}%;--dur:${3+Math.random()*4}s;--dl:${Math.random()*5}s;--op:${.4+Math.random()*.6};width:${1+Math.random()*2}px;height:${1+Math.random()*2}px;`;c.appendChild(s);}
}

// ══ RSVP — submits via AJAX to Laravel
let aChoice='';
function selectAttend(v){
  aChoice=v;
  document.getElementById('btnYes').classList.toggle('selected',v==='yes');
  document.getElementById('btnNo').classList.toggle('selected',v==='no');
  document.getElementById('paxGroup').style.display=v==='yes'?'block':'none';
}
async function submitRSVP(){
  const name=document.getElementById('rsvpName').value.trim();
  const phone=document.getElementById('rsvpPhone').value.trim();
  const pax=document.getElementById('rsvpPax').value||1;
  if(!name){showToast('Please enter your name');return;}
  if(!aChoice){showToast('Please select attendance');return;}
  try{
    const res=await fetch(CARD.rsvpUrl,{
      method:'POST',
      headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CARD.csrfToken},
      body:JSON.stringify({guest_name:name,phone:phone,attendance:aChoice,pax:parseInt(pax)})
    });
    const data=await res.json();
    if(data.success){
      showToast(`Thank you, ${name}! 💌 RSVP received!`);
      document.getElementById('statAttending').textContent=data.attending;
      document.getElementById('statDeclined').textContent=data.declined;
      document.getElementById('rsvpName').value='';
      document.getElementById('rsvpPhone').value='';
      document.getElementById('rsvpPax').value='';
      aChoice='';
      document.getElementById('btnYes').classList.remove('selected');
      document.getElementById('btnNo').classList.remove('selected');
      document.getElementById('paxGroup').style.display='none';
    }else{
      showToast('Something went wrong. Please try again.');
    }
  }catch(e){
    showToast('Something went wrong. Please try again.');
  }
}

// ══ WISHES — submits via AJAX to Laravel
async function submitWish(){
  const name=document.getElementById('wishName').value.trim();
  const text=document.getElementById('wishText').value.trim();
  if(!name||!text){showToast('Please fill in all fields');return;}
  try{
    const res=await fetch(CARD.wishUrl,{
      method:'POST',
      headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CARD.csrfToken},
      body:JSON.stringify({guest_name:name,message:text})
    });
    const data=await res.json();
    if(data.success){
      const it=document.createElement('div');it.className='wish-item';
      it.innerHTML=`<div class="wish-name">${esc(data.wish.name)}</div><div class="wish-text">${esc(data.wish.message)}</div>`;
      document.getElementById('wishesList').prepend(it);
      document.getElementById('wishName').value='';
      document.getElementById('wishText').value='';
      showToast('Wish sent! 💕');
    }
  }catch(e){
    showToast('Something went wrong. Please try again.');
  }
}

function esc(t){
  const d=document.createElement('div');d.textContent=t;return d.innerHTML;
}

// ══ COPY
function copyNum(t,btn){
  navigator.clipboard.writeText(t).then(()=>{
    const o=btn.textContent;btn.textContent='✓';btn.classList.add('copied');
    setTimeout(()=>{btn.textContent=o;btn.classList.remove('copied');},2000);
    showToast('Copied! 📋');
  });
}

// ══ TOAST
let tT;function showToast(m){const t=document.getElementById('toast');t.textContent=m;t.classList.add('show');clearTimeout(tT);tT=setTimeout(()=>t.classList.remove('show'),3000);}

// ══ MUSIC
let mOn=false;
function toggleMusic(){
  mOn=!mOn;
  const b=document.getElementById('musicBtn');
  b.textContent=mOn?'♫':'♪';
  b.classList.toggle('playing',mOn);
  showToast(mOn?'Music on 🎵':'Music off');
  @if($card->music_url)
  if(!window._audio){
    window._audio=new Audio('{{ $card->music_url }}');
    window._audio.loop=true;
  }
  mOn?window._audio.play():window._audio.pause();
  @endif
}


// ══ QR LIGHTBOX
function openQR(){
  const lb = document.getElementById('qrLightbox');
  lb.style.display = 'flex';
  document.body.style.overflow = 'hidden';
}
function closeQR(){
  const lb = document.getElementById('qrLightbox');
  lb.style.display = 'none';
  document.body.style.overflow = '';
}
</script>
</body>
</html>