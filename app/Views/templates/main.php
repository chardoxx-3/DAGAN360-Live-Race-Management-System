<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?> | Dagan360</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --maroon:        #7B0D1E;
            --maroon-mid:    #9C1429;
            --maroon-lite:   #B91C35;
            --maroon-deep:   #560A15;
            --maroon-soft:   #FFF0F2;
            --maroon-border: rgba(123,13,30,0.14);
            --white:         #FFFFFF;
            --bg:            #F7F1F2;
            --surface:       #FFFFFF;
            --border:        #EDE0E2;
            --text:          #0F0608;
            --text-mid:      #4B2531;
            --text-muted:    #9B6872;
            --sidebar-w:     236px;
            --topbar-h:      58px;
            --botnav-h:      64px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        .shell { display: flex; min-height: 100vh; }

        /* ═══════════════════════════════
           SIDEBAR
        ═══════════════════════════════ */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: none;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            height: 100vh;
            z-index: 100;
            box-shadow: 2px 0 16px rgba(123,13,30,0.05);
        }
        @media (min-width: 768px) { .sidebar { display: flex; } }

        /* Logo */
        .sidebar-logo {
            padding: 22px 20px 18px;
            border-bottom: 1px solid var(--border);
            position: relative;
            overflow: hidden;
        }
        /* subtle maroon glow behind logo */
        .sidebar-logo::before {
            content: '';
            position: absolute;
            top: -20px; left: -20px;
            width: 100px; height: 100px;
            background: radial-gradient(circle, rgba(123,13,30,0.08) 0%, transparent 70%);
            pointer-events: none;
        }
        .logo-mark {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.75rem;
            letter-spacing: 4px;
            line-height: 1;
            color: var(--text);
        }
        .logo-mark span { color: var(--maroon-lite); }
        .logo-tagline {
            font-size: 0.55rem;
            font-weight: 800;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-top: 4px;
        }

        /* Nav */
        .sidebar-nav {
            flex: 1;
            padding: 14px 10px;
            overflow-y: auto;
        }
        .nav-label {
            font-size: 0.54rem;
            font-weight: 800;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 8px 12px 6px;
        }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 11px;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--text-mid);
            text-decoration: none;
            margin-bottom: 2px;
            transition: background 0.15s, color 0.15s, transform 0.14s;
            position: relative;
        }
        .sidebar-nav a:hover {
            background: var(--bg);
            color: var(--text);
            transform: translateX(3px);
        }
        .sidebar-nav a.active {
            background: var(--maroon-soft);
            color: var(--maroon);
        }
        /* left accent bar on active */
        .sidebar-nav a.active::before {
            content: '';
            position: absolute;
            left: 0; top: 20%; bottom: 20%;
            width: 3px;
            background: var(--maroon-lite);
            border-radius: 0 3px 3px 0;
        }

        .nav-ico {
            width: 30px; height: 30px;
            border-radius: 8px;
            background: var(--bg);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.85rem;
            flex-shrink: 0;
            transition: background 0.15s;
        }
        .sidebar-nav a.active .nav-ico { background: rgba(123,13,30,0.10); }
        .sidebar-nav a:hover .nav-ico  { background: var(--maroon-soft); }

        .nav-divider {
            margin: 10px 2px;
            border: none;
            border-top: 1px solid var(--border);
        }

        .sidebar-nav a.logout-link { color: #C0392B; }
        .sidebar-nav a.logout-link:hover { background: #FFF1F2; color: #991B1B; }
        .sidebar-nav a.logout-link .nav-ico { background: #FFF1F2; }

        /* ── SIDEBAR FOOTER ── */
        .sidebar-footer {
            padding: 14px 18px 18px;
            border-top: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .live-chip {
            display: inline-flex; align-items: center; gap: 7px;
            background: var(--maroon-soft);
            border: 1px solid var(--maroon-border);
            border-radius: 100px;
            padding: 6px 13px;
            font-size: 0.58rem;
            font-weight: 800;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--maroon);
            width: fit-content;
        }
        .live-dot {
            width: 6px; height: 6px;
            background: var(--maroon-lite);
            border-radius: 50%;
            flex-shrink: 0;
            animation: blink 1.5s ease-in-out infinite;
        }
        @keyframes blink {
            0%,100% { opacity: 1; transform: scale(1); }
            50%      { opacity: 0.35; transform: scale(0.6); }
        }

        /* Powered-by block */
        .powered-by {
            display: flex;
            align-items: center;
            gap: 7px;
        }
        .powered-label {
            font-size: 0.52rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--text-muted);
            white-space: nowrap;
        }
        .internix-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 7px;
            padding: 4px 8px 4px 6px;
        }
        .internix-icon {
            width: 18px; height: 18px;
            border-radius: 4px;
            background: linear-gradient(135deg, var(--maroon-lite), var(--maroon-deep));
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .internix-icon svg { width: 10px; height: 10px; }
        .internix-wordmark {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 0.85rem;
            letter-spacing: 2px;
            color: var(--text);
            line-height: 1;
        }
        .internix-wordmark span { color: var(--maroon-lite); }

        /* ═══════════════════════════════
           MAIN AREA
        ═══════════════════════════════ */
        .main-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        @media (min-width: 768px) { .main-area { margin-left: var(--sidebar-w); } }

        /* ── TOPBAR ── */
        .topbar {
            height: var(--topbar-h);
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 1px 8px rgba(123,13,30,0.05);
        }

        .topbar-left { display: flex; align-items: center; gap: 12px; }

        /* Mobile logo (hidden on desktop) */
        .mobile-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.35rem;
            letter-spacing: 3px;
            color: var(--text);
            line-height: 1;
        }
        .mobile-logo span { color: var(--maroon-lite); }
        @media (min-width: 768px) { .mobile-logo { display: none; } }

        /* breadcrumb-style page title */
        .topbar-page-title {
            display: none;
            align-items: center;
            gap: 8px;
        }
        @media (min-width: 768px) { .topbar-page-title { display: flex; } }

        .topbar-page-eyebrow {
            font-size: 0.56rem;
            font-weight: 800;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--text-muted);
        }
        .topbar-page-sep { color: var(--border); font-size: 0.8rem; }
        .topbar-page-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.1rem;
            letter-spacing: 2px;
            color: var(--text);
            line-height: 1;
        }

        .topbar-right { display: flex; align-items: center; gap: 8px; }

        .role-pill {
            padding: 5px 12px;
            background: var(--maroon-soft);
            border: 1px solid var(--maroon-border);
            border-radius: 100px;
            font-size: 0.62rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            color: var(--maroon);
            text-transform: uppercase;
        }
        .user-name {
            font-size: 0.74rem;
            font-weight: 700;
            color: var(--text-muted);
        }
        @media (max-width: 480px) { .user-name { display: none; } }

        /* ── CONTENT ── */
        .content-area {
            flex: 1;
            padding: 22px 16px 90px;
        }
        @media (min-width: 768px) { .content-area { padding: 26px 28px 40px; } }

        /* ═══════════════════════════════
           BOTTOM NAV — mobile only
        ═══════════════════════════════ */
        .bottom-nav {
            display: none;
            position: fixed;
            bottom: 0; left: 0; right: 0;
            height: var(--botnav-h);
            background: var(--surface);
            border-top: 1px solid var(--border);
            z-index: 100;
            box-shadow: 0 -3px 16px rgba(123,13,30,0.08);
        }
        @media (max-width: 767px) { .bottom-nav { display: flex; } }

        .bnav-list {
            display: flex;
            width: 100%;
            align-items: stretch;
        }
        .bnav-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 3px;
            text-decoration: none;
            color: var(--text-muted);
            font-size: 0.54rem;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 6px 4px;
            position: relative;
            -webkit-tap-highlight-color: transparent;
            transition: color 0.14s;
        }
        /* top indicator bar */
        .bnav-item::after {
            content: '';
            position: absolute;
            top: 0; left: 20%; right: 20%;
            height: 2.5px;
            background: var(--maroon-lite);
            border-radius: 0 0 4px 4px;
            opacity: 0;
            transition: opacity 0.15s;
        }
        .bnav-item.active { color: var(--maroon); }
        .bnav-item.active::after { opacity: 1; }
        .bnav-icon { font-size: 1.18rem; line-height: 1; }
        .bnav-item.logout-link { color: #EF4444; }
        .bnav-item.logout-link.active::after { background: #EF4444; }
    </style>
</head>
<body>
<div class="shell">

    <!-- ══ SIDEBAR ══ -->
    <aside class="sidebar">

        <div class="sidebar-logo">
            <div class="logo-mark">DAGAN<span>360</span></div>
            <div class="logo-tagline">Marathon Management</div>
        </div>

        <nav class="sidebar-nav">
            <?php if(session()->get('role') == 'admin'): ?>
                <div class="nav-label">Admin</div>
                <a href="/admin"><span class="nav-ico">◈</span>Dashboard</a>
                <a href="/admin/runners"><span class="nav-ico">🏃</span>Runner Database</a>
                <a href="/admin/profile"><span class="nav-ico">👤</span>Profile</a>
                <a href="/admin/watchers"><span class="nav-ico">👁</span>Manage Watchers</a>
                <a href="/admin/reports"><span class="nav-ico">📊</span>Final Reports</a>
            <?php else: ?>
                <div class="nav-label">Watcher</div>
                <a href="/watcher"><span class="nav-ico">⚡</span>Quick Scan</a>
                <a href="/watcher/entries"><span class="nav-ico">📋</span>My Entries</a>
            <?php endif; ?>
            <hr class="nav-divider">
            <a href="/auth/logout" class="logout-link"><span class="nav-ico">→</span>Logout</a>
        </nav>

        <div class="sidebar-footer">

            <div class="powered-by">
                <span class="powered-label">Powered by</span>
                <div class="internix-badge">
                    <div class="internix-icon">
                        <svg viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 2H5.5V5.5H2V2Z"     fill="white" opacity="0.9"/>
                            <path d="M6.5 2H10V5.5H6.5V2Z"  fill="white" opacity="0.5"/>
                            <path d="M2 6.5H5.5V10H2V6.5Z"  fill="white" opacity="0.5"/>
                            <path d="M6.5 6.5H10V10H6.5V6.5Z" fill="white" opacity="0.9"/>
                        </svg>
                    </div>
                    <span class="internix-wordmark">INTER<span>N</span>IX</span>
                </div>
            </div>
        </div>

    </aside>

    <!-- ══ MAIN ══ -->
    <div class="main-area">

        <header class="topbar">
            <div class="topbar-left">
                <span class="mobile-logo">DAGAN<span>360</span></span>
                <div class="topbar-page-title">
                    <span class="topbar-page-eyebrow">Dagan360</span>
                    <span class="topbar-page-sep">/</span>
                    <span class="topbar-page-name"><?= $title ?? 'Overview' ?></span>
                </div>
            </div>
            <div class="topbar-right">
                <span class="role-pill"><?= session()->get('role') ?></span>
                <span class="user-name"><?= session()->get('username') ?></span>
            </div>
        </header>

        <div class="content-area">
            <?= $this->renderSection('content') ?>
        </div>

    </div>
</div>

<!-- ══ BOTTOM NAV — mobile only ══ -->
<nav class="bottom-nav">
    <div class="bnav-list">
        <?php if(session()->get('role') == 'admin'): ?>
            <a href="/admin"           class="bnav-item"><span class="bnav-icon">◈</span>Home</a>
            <a href="/admin/runners"   class="bnav-item"><span class="bnav-icon">🏃</span>Runners</a>
            <a href="/admin/watchers"  class="bnav-item"><span class="bnav-icon">👁</span>Watchers</a>
            <a href="/auth/logout"     class="bnav-item logout-link"><span class="bnav-icon">→</span>Logout</a>
        <?php else: ?>
            <a href="/watcher"         class="bnav-item"><span class="bnav-icon">⚡</span>Scan</a>
            <a href="/watcher/entries" class="bnav-item"><span class="bnav-icon">📋</span>Entries</a>
            <a href="/auth/logout"     class="bnav-item logout-link"><span class="bnav-icon">→</span>Logout</a>
        <?php endif; ?>
    </div>
</nav>

<script>
    const path = window.location.pathname;
    document.querySelectorAll('.sidebar-nav a, .bnav-item').forEach(a => {
        if (a.getAttribute('href') === path) a.classList.add('active');
    });
</script>
</body>
</html>