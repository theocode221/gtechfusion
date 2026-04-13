<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="theme-color" content="#0a0a0a">
<title>@yield('title', 'Admin') — GTechFusion</title>
<link rel="icon" type="image/png" href="/public/images/gtech-icon.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Outfit:wght@200;300;400;500&display=swap" rel="stylesheet">

<style>
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
:root{
  --white:#ffffff;
  --accent:#c8a96e;
  --accent-dim:rgba(200,169,110,0.12);
  --accent-border:rgba(200,169,110,0.22);
  --danger:#e05c5c;
  --danger-dim:rgba(224,92,92,0.1);
  --success:#4caf82;
  --success-dim:rgba(76,175,130,0.1);
  --warn:#e0a84c;
  --warn-dim:rgba(224,168,76,0.1);
  --sidebar-w:260px;
  --topbar-h:64px;
  --bg-card:rgba(255,255,255,0.03);
  --bg-card-hover:rgba(255,255,255,0.05);
  --border:rgba(255,255,255,0.06);
  --font-display:'Cormorant Garamond',serif;
  --font-body:'Outfit',sans-serif;
}
html,body{height:100%;background:#0a0a0a;color:var(--white);font-family:var(--font-body);font-weight:300;overflow:hidden;}

/* ── Background ── */
.bg{position:fixed;inset:-60px;background-image:url('/public/images/welcome-bg.jpg');background-size:cover;background-position:center;will-change:transform;z-index:0;}
.bg-overlay{position:fixed;inset:0;background:linear-gradient(135deg,rgba(0,0,0,0.88) 0%,rgba(0,0,0,0.75) 50%,rgba(0,0,0,0.85) 100%);pointer-events:none;z-index:1;}
.bg-vignette{position:fixed;inset:0;background:radial-gradient(ellipse at center,transparent 30%,rgba(0,0,0,0.7) 100%);pointer-events:none;z-index:1;}
.bg-grain{position:fixed;inset:0;opacity:0.025;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");background-size:200px 200px;pointer-events:none;z-index:1;}

/* ── Cursor ── */
.cursor{position:fixed;width:8px;height:8px;background:var(--accent);border-radius:50%;pointer-events:none;z-index:9999;transform:translate(-50%,-50%);transition:width 0.3s,height 0.3s;}
.cursor-ring{position:fixed;width:32px;height:32px;border:1px solid rgba(200,169,110,0.4);border-radius:50%;pointer-events:none;z-index:9998;transform:translate(-50%,-50%);transition:width 0.3s,height 0.3s,opacity 0.3s;}
.cursor.hover{width:12px;height:12px;}
.cursor-ring.hover{width:44px;height:44px;opacity:0.5;}

/* ── Layout ── */
.layout{display:flex;height:100vh;overflow:hidden;position:relative;z-index:10;}

/* ── Sidebar ── */
.sidebar{width:var(--sidebar-w);flex-shrink:0;height:100vh;background:rgba(6,6,6,0.75);backdrop-filter:blur(24px);-webkit-backdrop-filter:blur(24px);border-right:1px solid var(--border);display:flex;flex-direction:column;position:relative;z-index:200;transition:transform 0.4s cubic-bezier(0.34,1.56,0.64,1);}
.sidebar::before{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(to right,transparent,var(--accent),transparent);opacity:0.5;}
.sidebar-logo{padding:1.5rem 1.6rem 1.2rem;border-bottom:1px solid var(--border);}
.logo-link{display:inline-flex;align-items:center;gap:0;font-family:var(--font-display);font-size:1.35rem;font-weight:600;letter-spacing:0.04em;color:var(--white);text-decoration:none;}
.logo-link img{width:34px;height:34px;object-fit:contain;}
.logo-text{color:var(--white);}
.logo-accent{color:var(--accent);}
.sidebar-badge{display:inline-block;margin-top:0.4rem;font-size:0.58rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.2);padding-left:34px;}
.sidebar-nav{flex:1;padding:1rem 0;overflow-y:auto;scrollbar-width:none;}
.sidebar-nav::-webkit-scrollbar{display:none;}
.nav-section-label{font-size:0.55rem;letter-spacing:0.3em;text-transform:uppercase;color:rgba(255,255,255,0.2);padding:0.8rem 1.6rem 0.4rem;}
.nav-item{display:flex;align-items:center;gap:0.85rem;padding:0.75rem 1.6rem;cursor:pointer;font-size:0.82rem;font-weight:300;color:rgba(255,255,255,0.4);text-decoration:none;border:none;background:none;width:100%;position:relative;transition:color 0.2s,background 0.2s;border-left:2px solid transparent;}
.nav-item:hover{background:var(--bg-card-hover);color:rgba(255,255,255,0.7);}
.nav-item.active{color:var(--white);background:var(--accent-dim);border-left-color:var(--accent);}
.nav-item.active .nav-icon{color:var(--accent);}
.nav-icon{width:18px;height:18px;flex-shrink:0;opacity:0.6;transition:opacity 0.2s;}
.nav-item:hover .nav-icon,.nav-item.active .nav-icon{opacity:1;}
.nav-badge-count{margin-left:auto;background:var(--accent);color:#0a0a0a;font-size:0.6rem;font-weight:500;padding:0.15rem 0.5rem;border-radius:999px;}
.nav-badge-count.green{background:var(--success);color:white;}
.nav-badge-count.red{background:var(--danger);color:white;}
.sidebar-footer{padding:1.2rem 1.6rem;border-top:1px solid var(--border);}
.admin-info{display:flex;align-items:center;gap:0.8rem;}
.admin-avatar{width:34px;height:34px;border-radius:50%;flex-shrink:0;background:linear-gradient(135deg,#8b1a1a,var(--accent));display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:1rem;font-weight:600;}
.admin-name{font-size:0.78rem;font-weight:400;color:var(--white);}
.admin-role{font-size:0.6rem;color:rgba(255,255,255,0.25);letter-spacing:0.1em;}
.logout-btn{margin-left:auto;background:none;border:none;cursor:pointer;color:rgba(255,255,255,0.2);transition:color 0.2s;padding:0.3rem;}
.logout-btn:hover{color:var(--danger);}

/* ── Main ── */
.main{flex:1;display:flex;flex-direction:column;overflow:hidden;min-width:0;}

/* ── Topbar ── */
.topbar{height:var(--topbar-h);flex-shrink:0;display:flex;align-items:center;justify-content:space-between;padding:0 2rem;background:rgba(6,6,6,0.6);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);border-bottom:1px solid var(--border);position:relative;z-index:100;}
.topbar-left{display:flex;align-items:center;gap:1rem;}
.mobile-sidebar-btn{display:none;background:none;border:none;cursor:pointer;color:rgba(255,255,255,0.4);padding:0.3rem;}
.topbar-title{font-family:var(--font-display);font-size:1.3rem;font-weight:400;font-style:italic;color:var(--white);}
.topbar-breadcrumb{font-size:0.68rem;color:rgba(255,255,255,0.25);display:flex;align-items:center;gap:0.4rem;}
.topbar-breadcrumb a{color:rgba(255,255,255,0.35);text-decoration:none;transition:color 0.2s;}
.topbar-breadcrumb a:hover{color:var(--accent);}
.topbar-right{display:flex;align-items:center;gap:0.8rem;}
.topbar-btn{display:flex;align-items:center;gap:0.5rem;padding:0.5rem 1.1rem;background:var(--accent);color:#0a0a0a;font-family:var(--font-body);font-size:0.72rem;font-weight:400;letter-spacing:0.12em;text-transform:uppercase;border:none;cursor:pointer;clip-path:polygon(0 0,calc(100% - 8px) 0,100% 8px,100% 100%,8px 100%,0 calc(100% - 8px));transition:all 0.25s;text-decoration:none;}
.topbar-btn:hover{background:#d4b87a;transform:translateY(-1px);}
.topbar-btn-ghost{display:flex;align-items:center;gap:0.5rem;padding:0.5rem 1rem;background:var(--bg-card);color:rgba(255,255,255,0.4);font-family:var(--font-body);font-size:0.72rem;font-weight:300;letter-spacing:0.1em;text-transform:uppercase;border:1px solid var(--border);border-radius:8px;cursor:pointer;transition:all 0.25s;text-decoration:none;}
.topbar-btn-ghost:hover{background:var(--bg-card-hover);color:var(--white);}

/* ── Content ── */
.content{flex:1;overflow-y:auto;padding:1.8rem 2rem 2rem;scrollbar-width:thin;scrollbar-color:rgba(255,255,255,0.06) transparent;}
.content::-webkit-scrollbar{width:4px;}
.content::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.06);border-radius:2px;}

/* ── Cards / Panels ── */
.panel{background:var(--bg-card);border:1px solid var(--border);border-radius:16px;overflow:hidden;}
.panel-header{padding:1.2rem 1.6rem;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;}
.panel-title{font-family:var(--font-display);font-size:1.1rem;font-style:italic;color:var(--white);}
.panel-body{padding:1.6rem;}

/* ── Form ── */
.form-section-label{font-size:0.6rem;letter-spacing:0.25em;text-transform:uppercase;color:rgba(200,169,110,0.5);margin:1.4rem 0 0.8rem;display:flex;align-items:center;gap:0.8rem;}
.form-section-label::after{content:'';flex:1;height:1px;background:rgba(255,255,255,0.05);}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;}
.form-grid.cols-1{grid-template-columns:1fr;}
.form-grid.cols-3{grid-template-columns:1fr 1fr 1fr;}
.form-group{display:flex;flex-direction:column;gap:0.4rem;}
.form-label{font-size:0.58rem;font-weight:400;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.25);}
.form-label span{color:var(--danger);margin-left:2px;}
.form-input,.form-select,.form-textarea{background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.07);border-radius:10px;padding:0.78rem 1rem;font-family:var(--font-body);font-size:0.82rem;font-weight:300;color:var(--white);outline:none;transition:border-color 0.2s,box-shadow 0.2s;width:100%;}
.form-input::placeholder,.form-textarea::placeholder{color:rgba(255,255,255,0.15);}
.form-input:focus,.form-select:focus,.form-textarea:focus{border-color:var(--accent-border);box-shadow:0 0 0 3px rgba(200,169,110,0.06);}
.form-select option{background:#1a1a1a;color:var(--white);}
.form-textarea{resize:vertical;min-height:80px;}
.form-hint{font-size:0.6rem;color:rgba(255,255,255,0.2);margin-top:0.2rem;}

/* ── Buttons ── */
.btn{display:inline-flex;align-items:center;gap:0.5rem;padding:0.75rem 1.4rem;font-family:var(--font-body);font-size:0.75rem;font-weight:400;letter-spacing:0.1em;text-transform:uppercase;border:none;cursor:pointer;transition:all 0.25s;text-decoration:none;}
.btn-primary{background:var(--accent);color:#0a0a0a;clip-path:polygon(0 0,calc(100% - 8px) 0,100% 8px,100% 100%,8px 100%,0 calc(100% - 8px));}
.btn-primary:hover{background:#d4b87a;transform:translateY(-1px);}
.btn-ghost{background:transparent;color:rgba(255,255,255,0.35);border:1px solid var(--border);border-radius:10px;}
.btn-ghost:hover{background:var(--bg-card-hover);color:rgba(255,255,255,0.6);}
.btn-danger{background:var(--danger-dim);color:var(--danger);border:1px solid rgba(224,92,92,0.2);border-radius:10px;}
.btn-danger:hover{background:rgba(224,92,92,0.2);}
.btn-success{background:var(--success-dim);color:var(--success);border:1px solid rgba(76,175,130,0.2);border-radius:10px;}
.btn-success:hover{background:rgba(76,175,130,0.2);}
.btn-sm{padding:0.45rem 0.9rem;font-size:0.65rem;}

/* ── Table ── */
.table-wrap{background:var(--bg-card);border:1px solid var(--border);border-radius:16px;overflow:hidden;}
table{width:100%;border-collapse:collapse;}
thead{background:rgba(255,255,255,0.02);border-bottom:1px solid var(--border);}
th{padding:0.85rem 1.2rem;font-size:0.58rem;font-weight:400;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.25);text-align:left;white-space:nowrap;}
td{padding:1rem 1.2rem;font-size:0.8rem;font-weight:300;color:rgba(255,255,255,0.7);border-bottom:1px solid rgba(255,255,255,0.03);vertical-align:middle;}
tr:last-child td{border-bottom:none;}
tbody tr{transition:background 0.2s;}
tbody tr:hover{background:var(--bg-card-hover);}

/* ── Status badges ── */
.badge{display:inline-flex;align-items:center;gap:0.35rem;padding:0.25rem 0.7rem;border-radius:999px;font-size:0.62rem;font-weight:400;}
.badge-dot{width:5px;height:5px;border-radius:50%;background:currentColor;}
.badge-active{background:var(--success-dim);color:var(--success);border:1px solid rgba(76,175,130,0.2);}
.badge-inactive{background:var(--danger-dim);color:var(--danger);border:1px solid rgba(224,92,92,0.2);}
.badge-draft{background:var(--warn-dim);color:var(--warn);border:1px solid rgba(224,168,76,0.2);}

/* ── Action buttons ── */
.action-btns{display:flex;align-items:center;gap:0.4rem;}
.action-btn{width:30px;height:30px;border-radius:8px;display:flex;align-items:center;justify-content:center;background:none;border:1px solid var(--border);cursor:pointer;color:rgba(255,255,255,0.3);transition:all 0.2s;text-decoration:none;}
.action-btn:hover.v{background:var(--accent-dim);border-color:var(--accent-border);color:var(--accent);}
.action-btn:hover.e{background:rgba(76,130,175,0.1);border-color:rgba(76,130,175,0.3);color:#4c82af;}
.action-btn:hover.c{background:var(--success-dim);border-color:rgba(76,175,130,0.3);color:var(--success);}
.action-btn:hover.d{background:var(--danger-dim);border-color:rgba(224,92,92,0.3);color:var(--danger);}

/* ── Alert ── */
.alert{display:flex;align-items:center;gap:0.7rem;padding:1rem 1.2rem;border-radius:12px;font-size:0.8rem;margin-bottom:1.2rem;}
.alert-success{background:var(--success-dim);border:1px solid rgba(76,175,130,0.2);color:var(--success);}
.alert-error{background:var(--danger-dim);border:1px solid rgba(224,92,92,0.2);color:var(--danger);}

/* ── Toast ── */
.toast-wrap{position:fixed;bottom:2rem;right:2rem;z-index:2000;display:flex;flex-direction:column;gap:0.6rem;}
.toast-item{display:flex;align-items:center;gap:0.7rem;padding:0.85rem 1.2rem;background:rgba(15,15,15,0.95);border:1px solid var(--border);border-radius:12px;font-size:0.78rem;color:var(--white);box-shadow:0 8px 32px rgba(0,0,0,0.4);animation:toastIn 0.4s cubic-bezier(0.34,1.56,0.64,1);min-width:260px;}
@keyframes toastIn{from{opacity:0;transform:translateX(20px);}to{opacity:1;transform:translateX(0);}}

/* ── Modal ── */
.modal-overlay{position:fixed;inset:0;z-index:1000;background:rgba(0,0,0,0.7);backdrop-filter:blur(8px);display:none;align-items:center;justify-content:center;padding:1rem;}
.modal-overlay.show{display:flex;}
.modal{background:#0f0f0f;border:1px solid rgba(255,255,255,0.08);border-radius:20px;width:100%;max-width:460px;box-shadow:0 40px 100px rgba(0,0,0,0.6);animation:modalIn 0.4s cubic-bezier(0.34,1.56,0.64,1);position:relative;}
.modal::before{content:'';position:absolute;top:0;left:10%;right:10%;height:1px;background:linear-gradient(to right,transparent,var(--accent),transparent);opacity:0.5;}
@keyframes modalIn{from{opacity:0;transform:scale(0.95) translateY(10px);}to{opacity:1;transform:scale(1) translateY(0);}}
.modal-header{display:flex;align-items:center;justify-content:space-between;padding:1.4rem 1.6rem 1.1rem;border-bottom:1px solid var(--border);}
.modal-title{font-family:var(--font-display);font-size:1.3rem;font-style:italic;color:var(--white);}
.modal-close{background:none;border:none;cursor:pointer;color:rgba(255,255,255,0.25);font-size:1.2rem;transition:color 0.2s;padding:0.3rem;}
.modal-close:hover{color:var(--danger);}
.modal-body{padding:1.4rem 1.6rem;}
.modal-footer{padding:1.1rem 1.6rem;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:flex-end;gap:0.8rem;}

/* ── Mobile ── */
.sidebar-overlay{display:none;position:fixed;inset:0;z-index:190;background:rgba(0,0,0,0.6);backdrop-filter:blur(4px);}
@media(max-width:768px){
  .sidebar{position:fixed;top:0;left:0;bottom:0;transform:translateX(-100%);z-index:200;}
  .sidebar.open{transform:translateX(0);}
  .mobile-sidebar-btn{display:flex;}
  .form-grid{grid-template-columns:1fr;}
  .form-grid.cols-3{grid-template-columns:1fr;}
  body{cursor:auto;}
  .cursor,.cursor-ring{display:none;}
}
@media(max-width:480px){.content{padding:1.2rem;}}

::-webkit-scrollbar{width:4px;height:4px;}
::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.06);border-radius:2px;}
</style>

@yield('extra-styles')
</head>
<body>
<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>

<div class="bg" id="bg"></div>
<div class="bg-overlay"></div>
<div class="bg-vignette"></div>
<div class="bg-grain"></div>

<div class="toast-wrap" id="toastWrap"></div>

<div class="layout">

  <!-- SIDEBAR -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
      <a href="/" class="logo-link">
        <img src="/public/images/gtech-icon.png" alt="GTechFusion">
        <span class="logo-text">-Tech<span class="logo-accent">Fusion</span></span>
      </a>
      <div class="sidebar-badge">Admin Panel</div>
    </div>
    <nav class="sidebar-nav">
      <div class="nav-section-label">Main</div>
      <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
        Dashboard
      </a>
      <a href="{{ route('admin.cards.index') }}" class="nav-item {{ request()->routeIs('admin.cards.*') ? 'active' : '' }}">
        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 8V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-2"/><path d="M3 8h18"/></svg>
        Wedding Cards
      </a>
      <a href="{{ route('admin.rsvp.index') }}" class="nav-item {{ request()->routeIs('admin.rsvp.*') ? 'active' : '' }}">
        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        RSVP Responses
      </a>
      <a href="{{ route('admin.wishes.index') }}" class="nav-item {{ request()->routeIs('admin.wishes.*') ? 'active' : '' }}">
        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        Wishes Wall
      </a>
    </nav>
    <div class="sidebar-footer">
      <div class="admin-info">
        <div class="admin-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
        <div>
          <div class="admin-name">{{ Auth::user()->name }}</div>
          <div class="admin-role">{{ Auth::user()->role ?? 'admin' }}</div>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}" style="margin-left:auto;">
          @csrf
          <button type="submit" class="logout-btn" title="Logout">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
          </button>
        </form>
      </div>
    </div>
  </aside>

  <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()" style="display:none;"></div>

  <!-- MAIN -->
  <div class="main">
    <!-- TOPBAR -->
    <header class="topbar">
      <div class="topbar-left">
        <button class="mobile-sidebar-btn" onclick="openSidebar()">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
        <div>
          <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
          @hasSection('breadcrumb')
          <div class="topbar-breadcrumb">@yield('breadcrumb')</div>
          @endif
        </div>
      </div>
      <div class="topbar-right">
        @yield('topbar-actions')
        <a href="{{ route('admin.cards.create') }}" class="topbar-btn">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          New Card
        </a>
      </div>
    </header>

    <!-- PAGE CONTENT -->
    <div class="content">

      @if(session('success'))
      <div class="alert alert-success">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
        {{ session('success') }}
      </div>
      @endif

      @if(session('error'))
      <div class="alert alert-error">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        {{ session('error') }}
      </div>
      @endif

      @yield('content')
    </div>
  </div>
</div>

<script>
// ── Parallax bg ──
const bg=document.getElementById('bg');
let bgTX=0,bgTY=0,bgOX=0,bgOY=0,bgS=null;
function lp(a,b,t){return a+(b-a)*t;}
function eo(t){return 1-Math.pow(1-t,3);}
document.addEventListener('mousemove',e=>{bgTX=((e.clientX/innerWidth)-.5)*14;bgTY=((e.clientY/innerHeight)-.5)*14;});
(function ab(ts){if(!bgS)bgS=ts;const p=Math.min((ts-bgS)/2000,1);const sc=1.04-(1.04-1)*eo(p);bgOX=lp(bgOX,bgTX,.05);bgOY=lp(bgOY,bgTY,.05);if(bg)bg.style.transform=`scale(${sc}) translate(${bgOX/sc}px,${bgOY/sc}px)`;requestAnimationFrame(ab);})();

// ── Cursor ──
const cur=document.getElementById('cursor'),ring=document.getElementById('cursorRing');
let rx=0,ry=0;
document.addEventListener('mousemove',e=>{cur.style.left=e.clientX+'px';cur.style.top=e.clientY+'px';});
(function ar(){rx=rx+(parseFloat(cur.style.left)||0-rx)*.12;ry=ry+(parseFloat(cur.style.top)||0-ry)*.12;ring.style.left=rx+'px';ring.style.top=ry+'px';requestAnimationFrame(ar);})();
document.querySelectorAll('a,button,input,select,textarea,.panel,.action-btn').forEach(el=>{
  el.addEventListener('mouseenter',()=>{cur.classList.add('hover');ring.classList.add('hover');});
  el.addEventListener('mouseleave',()=>{cur.classList.remove('hover');ring.classList.remove('hover');});
});

// ── Sidebar ──
function openSidebar(){document.getElementById('sidebar').classList.add('open');document.getElementById('sidebarOverlay').style.display='block';}
function closeSidebar(){document.getElementById('sidebar').classList.remove('open');document.getElementById('sidebarOverlay').style.display='none';}

// ── Toast ──
function showToast(msg,type='success'){
  const w=document.getElementById('toastWrap');
  const t=document.createElement('div');t.className='toast-item';
  const icons={success:'✅',error:'⚠️',info:'💡'};
  t.innerHTML=`<span>${icons[type]||'ℹ️'}</span><span>${msg}</span>`;
  w.appendChild(t);
  setTimeout(()=>{t.style.transition='opacity .4s,transform .4s';t.style.opacity='0';t.style.transform='translateX(20px)';setTimeout(()=>t.remove(),400);},3000);
}

// ── Modal helpers ──
function openModal(id){document.getElementById(id).classList.add('show');}
function closeModal(id){document.getElementById(id).classList.remove('show');}
document.querySelectorAll('.modal-overlay').forEach(o=>{o.addEventListener('click',e=>{if(e.target===o)o.classList.remove('show');});});
</script>

@yield('scripts')
</body>
</html>