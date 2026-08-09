<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<!-- Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;500;600;700;800&display=swap');

    :root {
        --maroon:        #7B0D1E;
        --maroon-mid:    #9C1429;
        --maroon-lite:   #B91C35;
        --maroon-deep:   #560A15;
        --maroon-soft:   #FFF0F2;
        --maroon-border: rgba(123,13,30,0.14);
        --text:          #0F0608;
        --text-mid:      #4B2531;
        --text-muted:    #9B6872;
        --border:        #EDE0E2;
        --surface:       #FFFFFF;
        --bg-tint:       #FDF6F7;
        --shadow-sm:     0 1px 3px rgba(123,13,30,0.06), 0 4px 12px rgba(123,13,30,0.06);
        --shadow-md:     0 2px 8px rgba(123,13,30,0.08), 0 8px 24px rgba(123,13,30,0.09);
    }

    * { font-family: 'Montserrat', sans-serif; box-sizing: border-box; }

    /* ── SECTION DIVIDER ── */
    .section-divider {
        display: flex; align-items: center; gap: 14px;
        margin-bottom: 18px;
        animation: fadeUp 0.4s ease both;
    }
    .section-divider::before,
    .section-divider::after {
        content: ''; flex: 1; height: 1px;
        background: linear-gradient(90deg, transparent, var(--maroon-border), transparent);
    }
    .section-label {
        font-size: 0.58rem; font-weight: 800;
        letter-spacing: 0.3em; text-transform: uppercase;
        color: var(--text-muted); white-space: nowrap;
    }
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(-8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── FLASH MESSAGES ── */
    .flash-ok, .flash-err {
        display: flex; align-items: flex-start; gap: 10px;
        padding: 13px 16px; border-radius: 13px;
        font-size: 0.80rem; font-weight: 700;
        margin-bottom: 20px;
        animation: fadeUp 0.35s ease both;
        line-height: 1.55;
    }
    .flash-ok  { background: #F0FDF4; border: 1px solid #BBF7D0; color: #15803D; }
    .flash-err { background: var(--maroon-soft); border: 1px solid var(--maroon-border); color: var(--maroon); }
    .flash-err ul { margin: 0; padding-left: 16px; }
    .flash-err ul li { margin-bottom: 2px; }

    /* ── TABLE CARD ── */
    .table-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 22px; overflow: hidden;
        box-shadow: var(--shadow-sm);
        animation: fadeUp 0.5s cubic-bezier(0.22,1,0.36,1) 0.06s both;
        margin-bottom: 24px;
        position: relative;
    }
    .table-card::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, var(--maroon), var(--maroon-lite));
    }

    .card-head {
        padding: 20px 24px 18px;
        border-bottom: 1px solid var(--border);
        background: var(--bg-tint);
        display: flex; align-items: center; justify-content: space-between; gap: 12px;
        flex-wrap: wrap;
    }
    .card-head-left { display: flex; align-items: center; gap: 12px; }
    .card-head-icon {
        width: 36px; height: 36px; border-radius: 10px;
        background: var(--maroon-soft); border: 1px solid var(--maroon-border);
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem; flex-shrink: 0;
    }
    .card-head-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.25rem; letter-spacing: 2.5px; color: var(--text); line-height: 1;
    }
    .card-head-sub {
        font-size: 0.6rem; font-weight: 700;
        letter-spacing: 0.15em; text-transform: uppercase;
        color: var(--text-muted); margin-top: 3px;
    }

    .count-pill {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--maroon-soft); border: 1px solid var(--maroon-border);
        border-radius: 100px; padding: 5px 13px;
        font-size: 0.62rem; font-weight: 800;
        letter-spacing: 0.12em; text-transform: uppercase;
        color: var(--maroon); white-space: nowrap;
    }
    .count-dot { width: 5px; height: 5px; border-radius: 50%; background: var(--maroon-lite); flex-shrink: 0; }

    .btn-add {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 10px 18px;
        background: var(--maroon); color: #fff; border: none;
        border-radius: 11px; font-size: 0.75rem; font-weight: 800;
        letter-spacing: 0.08em; text-transform: uppercase;
        cursor: pointer; white-space: nowrap;
        box-shadow: 0 4px 14px rgba(123,13,30,0.28);
        transition: background 0.16s, transform 0.13s, box-shadow 0.16s;
        font-family: 'Montserrat', sans-serif;
    }
    .btn-add:hover { background: var(--maroon-deep); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(123,13,30,0.36); }
    .btn-add:active { transform: translateY(1px); }

    /* ── ADD FORM PANEL ── */
    .add-panel {
        display: none;
        border-bottom: 1px solid var(--border);
        background: var(--bg-tint);
        animation: panelSlide 0.35s cubic-bezier(0.22,1,0.36,1) both;
    }
    .add-panel.open { display: block; }
    @keyframes panelSlide {
        from { opacity: 0; transform: translateY(-10px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .add-panel-inner { padding: 24px; }

    /* ── SHARED FORM STYLES ── */
    .form-section-label {
        display: flex; align-items: center; gap: 8px;
        font-size: 0.6rem; font-weight: 800;
        letter-spacing: 0.22em; text-transform: uppercase;
        color: var(--text-muted);
        padding-bottom: 10px;
        border-bottom: 1px solid var(--border);
        margin-bottom: 16px; margin-top: 4px;
    }

    .fields-grid-2 {
        display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px;
        margin-bottom: 16px;
    }
    @media (max-width: 600px) { .fields-grid-2 { grid-template-columns: 1fr; } }

    .fields-grid-3 {
        display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px;
        margin-bottom: 16px;
    }
    @media (max-width: 640px) { .fields-grid-3 { grid-template-columns: 1fr; } }

    .form-field { display: flex; flex-direction: column; gap: 6px; }
    .form-field.span-2 { grid-column: span 2; }
    @media (max-width: 600px) { .form-field.span-2 { grid-column: span 1; } }

    .field-label {
        font-size: 0.58rem; font-weight: 800;
        letter-spacing: 0.18em; text-transform: uppercase;
        color: var(--text-muted);
    }
    .field-req { color: var(--maroon-lite); margin-left: 2px; }

    .field-input, .field-select, .field-textarea {
        padding: 11px 14px;
        background: var(--surface); border: 1.5px solid var(--border);
        border-radius: 12px;
        font-size: 0.84rem; font-weight: 600; color: var(--text);
        outline: none;
        transition: border-color 0.18s, box-shadow 0.18s;
        font-family: 'Montserrat', sans-serif;
        width: 100%;
    }
    .field-input::placeholder, .field-textarea::placeholder { color: #C9A8AF; font-weight: 500; }
    .field-input:focus, .field-select:focus, .field-textarea:focus {
        border-color: var(--maroon);
        box-shadow: 0 0 0 3px rgba(123,13,30,0.09);
    }
    .field-textarea { resize: vertical; min-height: 72px; }
    .field-select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%239B6872' stroke-width='2.5'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 14px center; padding-right: 36px; }
    .field-hint { font-size: 0.6rem; font-weight: 600; color: var(--text-muted); letter-spacing: 0.04em; }
    .field-input[type="password"] { letter-spacing: 0.1em; }
    .field-input[type="file"] { padding: 9px 14px; font-size: 0.78rem; font-weight: 500; }

    /* Map container */
    .map-box {
        height: 260px; width: 100%;
        border-radius: 12px;
        border: 1.5px solid var(--border);
        overflow: hidden;
        z-index: 1;
    }

    /* Form action row */
    .form-actions {
        display: flex; justify-content: flex-end; gap: 10px;
        padding-top: 8px; margin-top: 4px;
        border-top: 1px solid var(--border);
    }
    .btn-cancel {
        padding: 10px 20px;
        background: var(--bg-tint); border: 1px solid var(--border);
        border-radius: 11px; font-size: 0.75rem; font-weight: 800;
        letter-spacing: 0.08em; text-transform: uppercase;
        color: var(--text-mid); cursor: pointer;
        transition: background 0.14s;
        font-family: 'Montserrat', sans-serif;
    }
    .btn-cancel:hover { background: var(--border); }
    .btn-submit {
        padding: 10px 22px;
        background: var(--maroon); border: none;
        border-radius: 11px; font-size: 0.75rem; font-weight: 800;
        letter-spacing: 0.08em; text-transform: uppercase;
        color: #fff; cursor: pointer;
        box-shadow: 0 3px 10px rgba(123,13,30,0.28);
        transition: background 0.14s, transform 0.12s;
        font-family: 'Montserrat', sans-serif;
    }
    .btn-submit:hover { background: var(--maroon-deep); transform: translateY(-1px); }

    /* ── WATCHER TABLE ── */
    .table-scroll { overflow-x: auto; -webkit-overflow-scrolling: touch; }

    table.watchers-table {
        width: 100%; border-collapse: collapse; min-width: 680px;
    }
    table.watchers-table thead {
        background: var(--bg-tint); border-bottom: 1px solid var(--border);
    }
    table.watchers-table th {
        padding: 12px 18px; text-align: left;
        font-size: 0.58rem; font-weight: 800;
        letter-spacing: 0.22em; text-transform: uppercase;
        color: var(--text-muted); white-space: nowrap;
    }
    table.watchers-table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background 0.13s;
        animation: rowIn 0.4s cubic-bezier(0.22,1,0.36,1) both;
    }
    table.watchers-table tbody tr:last-child { border-bottom: none; }
    table.watchers-table tbody tr:hover { background: var(--bg-tint); }

    table.watchers-table tbody tr:nth-child(1) { animation-delay:.04s; }
    table.watchers-table tbody tr:nth-child(2) { animation-delay:.08s; }
    table.watchers-table tbody tr:nth-child(3) { animation-delay:.12s; }
    table.watchers-table tbody tr:nth-child(4) { animation-delay:.16s; }
    table.watchers-table tbody tr:nth-child(5) { animation-delay:.20s; }
    table.watchers-table tbody tr:nth-child(6) { animation-delay:.24s; }
    @keyframes rowIn {
        from { opacity: 0; transform: translateX(-10px); }
        to   { opacity: 1; transform: translateX(0); }
    }
    table.watchers-table td { padding: 14px 18px; vertical-align: middle; }

    /* watcher identity cell */
    .watcher-identity { display: flex; align-items: center; gap: 12px; }
    .watcher-avatar {
        width: 42px; height: 42px; border-radius: 50%;
        object-fit: cover; flex-shrink: 0;
        border: 2px solid var(--maroon-border);
    }
    .watcher-username {
        font-size: 0.86rem; font-weight: 700; color: var(--text);
    }
    .watcher-fullname {
        font-size: 0.72rem; font-weight: 600; color: var(--text-muted); margin-top: 1px;
    }
    .watcher-email {
        font-size: 0.65rem; font-weight: 500; color: var(--text-muted); margin-top: 1px;
    }

    .contact-cell { font-size: 0.78rem; font-weight: 600; color: var(--text-mid); }

    /* checkpoint pill */
    .cp-pill {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 5px 11px;
        background: var(--maroon-soft); border: 1px solid var(--maroon-border);
        border-radius: 100px;
        font-size: 0.68rem; font-weight: 800;
        letter-spacing: 0.06em; color: var(--maroon);
    }
    .cp-dot { width: 5px; height: 5px; border-radius: 50%; background: var(--maroon-lite); flex-shrink: 0; }
    .cp-address { font-size: 0.65rem; font-weight: 600; color: var(--text-muted); margin-top: 5px; }
    .cp-coords  { font-size: 0.6rem;  font-weight: 500; color: var(--text-muted); margin-top: 2px; }

    .login-date { font-size: 0.76rem; font-weight: 600; color: var(--text-mid); }
    .created-date { font-size: 0.62rem; font-weight: 500; color: var(--text-muted); margin-top: 2px; }

    /* action buttons */
    .action-cell { display: flex; align-items: center; gap: 7px; }
    .btn-edit {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 7px 13px;
        background: var(--bg-tint); border: 1px solid var(--border);
        border-radius: 9px; font-size: 0.68rem; font-weight: 800;
        letter-spacing: 0.07em; text-transform: uppercase;
        color: var(--text-mid); cursor: pointer;
        transition: background 0.14s, border-color 0.14s, transform 0.12s;
        font-family: 'Montserrat', sans-serif; white-space: nowrap;
    }
    .btn-edit:hover { background: #fff; border-color: var(--maroon-border); color: var(--maroon); transform: translateY(-1px); }

    .btn-delete {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 7px 13px;
        background: transparent; border: 1px solid #FECDD3;
        border-radius: 9px; font-size: 0.68rem; font-weight: 800;
        letter-spacing: 0.07em; text-transform: uppercase;
        color: #EF4444; cursor: pointer; text-decoration: none;
        transition: background 0.14s, border-color 0.14s, transform 0.12s;
        font-family: 'Montserrat', sans-serif; white-space: nowrap;
    }
    .btn-delete:hover { background: #FFF1F2; border-color: #FCA5A5; transform: translateY(-1px); }

    /* empty state */
    .empty-state {
        text-align: center; padding: 52px 20px; color: var(--text-muted);
    }
    .empty-icon { font-size: 2.4rem; display: block; margin-bottom: 12px; opacity: 0.45; }
    .empty-text {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1rem; letter-spacing: 2.5px; color: var(--text-muted);
    }

    /* ── EDIT MODAL ── */
    .modal-overlay {
        position: fixed; inset: 0;
        background: rgba(15,6,8,0.38);
        backdrop-filter: blur(4px);
        z-index: 9999;
        display: none; align-items: flex-start; justify-content: center;
        padding: 24px 16px;
        overflow-y: auto;
    }
    .modal-overlay.open { display: flex; animation: overlayIn 0.2s ease both; }
    @keyframes overlayIn { from { opacity: 0; } to { opacity: 1; } }

    .modal-box {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 22px;
        width: 100%; max-width: 680px;
        box-shadow: 0 24px 64px rgba(123,13,30,0.18);
        overflow: hidden;
        position: relative;
        animation: modalPop 0.32s cubic-bezier(0.22,1,0.36,1) both;
        margin: auto;
    }
    .modal-box::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, var(--maroon), var(--maroon-lite));
    }
    @keyframes modalPop {
        from { opacity: 0; transform: scale(0.95) translateY(16px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }

    .modal-head {
        padding: 20px 24px 18px;
        border-bottom: 1px solid var(--border);
        background: var(--bg-tint);
        display: flex; align-items: center; justify-content: space-between;
    }
    .modal-title {
        display: flex; align-items: center; gap: 10px;
    }
    .modal-title-text {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.25rem; letter-spacing: 2.5px; color: var(--text);
    }
    .modal-close-btn {
        width: 30px; height: 30px; border-radius: 8px;
        background: var(--maroon-soft); border: 1px solid var(--maroon-border);
        color: var(--maroon); cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        transition: background 0.13s; font-size: 1rem; line-height: 1;
    }
    .modal-close-btn:hover { background: #FECDD3; }

    .modal-body { padding: 24px; }
    .modal-foot {
        padding: 16px 24px; border-top: 1px solid var(--border);
        background: var(--bg-tint);
        display: flex; justify-content: flex-end; gap: 10px;
    }

    /* ── DELETE CONFIRM MODAL ── */
    .del-overlay {
        position: fixed; inset: 0;
        background: rgba(15,6,8,0.38);
        backdrop-filter: blur(4px);
        z-index: 10000;
        display: none; align-items: center; justify-content: center;
        padding: 20px;
    }
    .del-overlay.open { display: flex; animation: overlayIn 0.2s ease both; }
    .del-box {
        background: var(--surface); border: 1px solid var(--border);
        border-radius: 22px; max-width: 360px; width: 100%;
        overflow: hidden; text-align: center;
        box-shadow: 0 24px 64px rgba(123,13,30,0.18);
        animation: modalPop 0.32s cubic-bezier(0.22,1,0.36,1) both;
    }
    .del-inner { padding: 32px 28px 22px; }
    .del-icon {
        width: 54px; height: 54px; border-radius: 50%;
        background: #FFF1F2; border: 1px solid #FECDD3;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem; margin: 0 auto 16px;
        animation: iconWiggle 0.4s ease 0.08s both;
    }
    @keyframes iconWiggle {
        0%  { transform: rotate(-10deg) scale(0.8); opacity: 0; }
        55% { transform: rotate(5deg) scale(1.05); opacity: 1; }
        100%{ transform: rotate(0) scale(1); }
    }
    .del-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.55rem; letter-spacing: 2.5px; color: var(--text); margin-bottom: 8px;
    }
    .del-body { font-size: 0.80rem; font-weight: 500; color: #6B7280; line-height: 1.65; margin-bottom: 22px; }
    .del-name { color: var(--maroon); font-weight: 800; }
    .del-warn { color: #EF4444; font-size: 0.7rem; }
    .del-foot { padding: 0 28px 24px; display: flex; gap: 10px; }
    .btn-del-cancel {
        flex: 1; padding: 12px;
        background: var(--bg-tint); border: 1px solid var(--border);
        border-radius: 11px; font-size: 0.78rem; font-weight: 800;
        color: var(--text-mid); cursor: pointer;
        font-family: 'Montserrat', sans-serif;
        transition: background 0.13s;
    }
    .btn-del-cancel:hover { background: var(--border); }
    .btn-del-confirm {
        flex: 1; padding: 12px;
        background: #EF4444; border: none;
        border-radius: 11px; font-size: 0.78rem; font-weight: 800;
        color: #fff; text-decoration: none; display: block; text-align: center;
        box-shadow: 0 3px 10px rgba(239,68,68,0.28);
        transition: background 0.14s, transform 0.12s;
        font-family: 'Montserrat', sans-serif;
    }
    .btn-del-confirm:hover { background: #DC2626; transform: translateY(-1px); }

    /* Leaflet override — ensure it renders inside modals */
    .leaflet-container { font-family: 'Montserrat', sans-serif !important; }
</style>

<!-- Flash messages -->
<?php if(session()->getFlashdata('success')): ?>
    <div class="flash-ok">✓ <?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if(session()->getFlashdata('error')): ?>
    <div class="flash-err">⚠ <?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<?php if(session()->getFlashdata('errors')): ?>
    <div class="flash-err">
        ⚠
        <ul>
            <?php foreach(session()->getFlashdata('errors') as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- ── WATCHERS SECTION ── -->
<div class="section-divider"><span class="section-label">Checkpoint Watchers</span></div>

<div class="table-card">

    <!-- Card Header -->
    <div class="card-head">
        <div class="card-head-left">
            <div class="card-head-icon">👁</div>
            <div>
                <div class="card-head-title">Watcher Accounts</div>
                <div class="card-head-sub">Manage checkpoint assignments & credentials</div>
            </div>
        </div>
        <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
            <div class="count-pill">
                <span class="count-dot"></span>
                <?= count($watchers) ?> watcher<?= count($watchers) !== 1 ? 's' : '' ?>
            </div>
            <button onclick="toggleAddForm()" class="btn-add">
                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                Add Watcher
            </button>
        </div>
    </div>

    <!-- ── ADD WATCHER PANEL ── -->
    <div id="addWatcherForm" class="add-panel">
        <div class="add-panel-inner">
            <form action="/admin/addWatcher" method="post" enctype="multipart/form-data">

                <!-- Auth -->
                <div class="form-section-label">🔑 Basic Authentication</div>
                <div class="fields-grid-2">
                    <div class="form-field">
                        <label class="field-label">Username <span class="field-req">*</span></label>
                        <input type="text" name="username" value="<?= old('username') ?>" required class="field-input" placeholder="e.g. watcher01">
                    </div>
                    <div class="form-field">
                        <label class="field-label">Email</label>
                        <input type="email" name="email" value="<?= old('email') ?>" class="field-input" placeholder="Optional">
                    </div>
                    <div class="form-field">
                        <label class="field-label">Password <span class="field-req">*</span></label>
                        <input type="password" name="password" required class="field-input" placeholder="••••••••">
                    </div>
                    <div class="form-field">
                        <label class="field-label">Profile Image</label>
                        <input type="file" name="profile_image" accept="image/*" class="field-input">
                        <span class="field-hint">JPG, PNG or GIF · Max 2MB</span>
                    </div>
                </div>

                <!-- Personal -->
                <div class="form-section-label">👤 Personal Information</div>
                <div class="fields-grid-3">
                    <div class="form-field">
                        <label class="field-label">First Name</label>
                        <input type="text" name="first_name" value="<?= old('first_name') ?>" class="field-input" placeholder="Juan">
                    </div>
                    <div class="form-field">
                        <label class="field-label">Middle Name</label>
                        <input type="text" name="middle_name" value="<?= old('middle_name') ?>" class="field-input" placeholder="Optional">
                    </div>
                    <div class="form-field">
                        <label class="field-label">Last Name</label>
                        <input type="text" name="last_name" value="<?= old('last_name') ?>" class="field-input" placeholder="dela Cruz">
                    </div>
                </div>
                <div class="fields-grid-2" style="margin-bottom:16px;">
                    <div class="form-field">
                        <label class="field-label">Contact Number</label>
                        <input type="text" name="phone_number" value="<?= old('phone_number') ?>" class="field-input" placeholder="+63 9XX XXX XXXX">
                    </div>
                </div>

                <!-- Checkpoint -->
                <div class="form-section-label">📍 Checkpoint Assignment</div>
                <div class="fields-grid-2">
                    <div class="form-field">
                        <label class="field-label">Checkpoint <span class="field-req">*</span></label>
                        <select name="checkpoint_id" id="add_checkpoint_id" required class="field-select" onchange="updateCheckpointName(this.value,'add')">
                            <option value="">Select Checkpoint</option>
                            <?php for($i=1;$i<=10;$i++): ?>
                            <option value="<?=$i?>"><?="Checkpoint $i"?></option>
                            <?php endfor; ?>
                        </select>
                        <span class="field-hint">Assign this watcher to a checkpoint number</span>
                    </div>
                    <div class="form-field">
                        <label class="field-label">Address</label>
                        <textarea name="address" class="field-textarea" placeholder="Street, city, etc."><?= old('address') ?></textarea>
                    </div>
                </div>
                <div class="form-field" style="margin-bottom:16px;">
                    <label class="field-label">Pin Location on Map</label>
                    <div id="addMap" class="map-box"></div>
                    <input type="hidden" name="latitude"  id="add_latitude"  value="<?= old('latitude',  '14.5995') ?>">
                    <input type="hidden" name="longitude" id="add_longitude" value="<?= old('longitude', '120.9842') ?>">
                    <span class="field-hint" style="margin-top:6px;">Click the map or drag the marker to set exact location</span>
                </div>

                <div class="form-actions">
                    <button type="button" onclick="toggleAddForm()" class="btn-cancel">Cancel</button>
                    <button type="submit" class="btn-submit">⚡ Create Watcher</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ── WATCHER TABLE ── -->
    <div class="table-scroll">
        <table class="watchers-table">
            <thead>
                <tr>
                    <th>Watcher</th>
                    <th>Contact</th>
                    <th>Checkpoint / Location</th>
                    <th>Activity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($watchers)): ?>
                    <tr>
                        <td colspan="5" style="padding:0">
                            <div class="empty-state">
                                <span class="empty-icon">👁</span>
                                <span class="empty-text">No Watchers Yet — Add Your First</span>
                            </div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach($watchers as $watcher):
                        $userModel    = new \App\Models\UserModel();
                        $fullName     = $userModel->getFullName($watcher);
                        $profileImage = $userModel->getProfileImage($watcher);
                    ?>
                    <tr>
                        <td>
                            <div class="watcher-identity">
                                <img src="<?= $profileImage ?>" alt="" class="watcher-avatar">
                                <div>
                                    <div class="watcher-username"><?= esc($watcher['username']) ?></div>
                                    <?php if($fullName): ?>
                                        <div class="watcher-fullname"><?= esc($fullName) ?></div>
                                    <?php endif; ?>
                                    <?php if($watcher['email']): ?>
                                        <div class="watcher-email"><?= esc($watcher['email']) ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php if($watcher['phone_number']): ?>
                                <span class="contact-cell">📞 <?= esc($watcher['phone_number']) ?></span>
                            <?php else: ?>
                                <span style="color:var(--text-muted);font-size:0.72rem;font-weight:600;">—</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="cp-pill">
                                <span class="cp-dot"></span>
                                CP <?= $watcher['checkpoint_id'] ?? 'Unassigned' ?>
                            </span>
                            <?php if($watcher['address']): ?>
                                <div class="cp-address">📍 <?= esc($watcher['address']) ?></div>
                            <?php endif; ?>
                            <?php if($watcher['latitude'] && $watcher['longitude']): ?>
                                <div class="cp-coords"><?= number_format($watcher['latitude'],4) ?>, <?= number_format($watcher['longitude'],4) ?></div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="login-date"><?= $watcher['last_login'] ? date('M d, Y · g:i A', strtotime($watcher['last_login'])) : 'Never logged in' ?></div>
                            <div class="created-date">Since <?= date('M d, Y', strtotime($watcher['created_at'])) ?></div>
                        </td>
                        <td>
                            <div class="action-cell">
                                <button type="button"
                                        onclick="editWatcher(<?= htmlspecialchars(json_encode($watcher)) ?>)"
                                        class="btn-edit">✎ Edit</button>
                                <button type="button"
                                        onclick="openDeleteModal(<?= $watcher['id'] ?>, '<?= esc(addslashes($watcher['username'])) ?>')"
                                        class="btn-delete">✕ Delete</button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ── EDIT MODAL ── -->
<div id="editModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-head">
            <div class="modal-title">
                <div class="card-head-icon">✎</div>
                <span class="modal-title-text">Edit Watcher</span>
            </div>
            <button onclick="closeEditModal()" class="modal-close-btn">✕</button>
        </div>

        <form id="editWatcherForm" method="post" enctype="multipart/form-data">
            <div class="modal-body">

                <!-- Auth -->
                <div class="form-section-label">🔑 Basic Authentication</div>
                <div class="fields-grid-2">
                    <div class="form-field">
                        <label class="field-label">Username <span class="field-req">*</span></label>
                        <input type="text" name="username" id="edit_username" required class="field-input">
                    </div>
                    <div class="form-field">
                        <label class="field-label">Email</label>
                        <input type="email" name="email" id="edit_email" class="field-input" placeholder="Optional">
                    </div>
                    <div class="form-field">
                        <label class="field-label">New Password <span style="font-weight:500;text-transform:none;letter-spacing:0;font-size:0.6rem;color:var(--text-muted)">(blank = keep current)</span></label>
                        <input type="password" name="password" id="edit_password" class="field-input" placeholder="••••••••">
                    </div>
                    <div class="form-field">
                        <label class="field-label">Profile Image</label>
                        <input type="file" name="profile_image" accept="image/*" class="field-input">
                        <span class="field-hint">JPG, PNG or GIF · Max 2MB</span>
                    </div>
                </div>
                <div id="removeImageWrap" class="form-field" style="display:none;margin-bottom:16px;">
                    <label style="display:inline-flex;align-items:center;gap:6px;font-size:0.68rem;font-weight:700;color:#EF4444;cursor:pointer;">
                        <input type="checkbox" name="remove_image" value="1" style="accent-color:#EF4444;">
                        Remove current photo
                    </label>
                </div>

                <!-- Personal -->
                <div class="form-section-label">👤 Personal Information</div>
                <div class="fields-grid-3">
                    <div class="form-field">
                        <label class="field-label">First Name</label>
                        <input type="text" name="first_name" id="edit_first_name" class="field-input" placeholder="Juan">
                    </div>
                    <div class="form-field">
                        <label class="field-label">Middle Name</label>
                        <input type="text" name="middle_name" id="edit_middle_name" class="field-input" placeholder="Optional">
                    </div>
                    <div class="form-field">
                        <label class="field-label">Last Name</label>
                        <input type="text" name="last_name" id="edit_last_name" class="field-input" placeholder="dela Cruz">
                    </div>
                </div>
                <div class="fields-grid-2" style="margin-bottom:16px;">
                    <div class="form-field">
                        <label class="field-label">Contact Number</label>
                        <input type="text" name="phone_number" id="edit_phone_number" class="field-input" placeholder="+63 9XX XXX XXXX">
                    </div>
                </div>

                <!-- Checkpoint -->
                <div class="form-section-label">📍 Checkpoint Assignment</div>
                <div class="fields-grid-2">
                    <div class="form-field">
                        <label class="field-label">Checkpoint <span class="field-req">*</span></label>
                        <select name="checkpoint_id" id="edit_checkpoint_id" required class="field-select" onchange="updateCheckpointName(this.value,'edit')">
                            <option value="">Select Checkpoint</option>
                            <?php for($i=1;$i<=10;$i++): ?>
                            <option value="<?=$i?>"><?="Checkpoint $i"?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="form-field">
                        <label class="field-label">Address</label>
                        <textarea name="address" id="edit_address" class="field-textarea" placeholder="Street, city, etc."></textarea>
                    </div>
                </div>
                <div class="form-field" style="margin-bottom:4px;">
                    <label class="field-label">Pin Location on Map</label>
                    <div id="editMap" class="map-box"></div>
                    <input type="hidden" name="latitude"  id="edit_latitude">
                    <input type="hidden" name="longitude" id="edit_longitude">
                    <span class="field-hint" style="margin-top:6px;">Click the map or drag the marker to update location</span>
                </div>

            </div>
            <div class="modal-foot">
                <button type="button" onclick="closeEditModal()" class="btn-cancel">Cancel</button>
                <button type="submit" class="btn-submit">💾 Save Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- ── DELETE CONFIRM MODAL ── -->
<div id="deleteModal" class="del-overlay">
    <div class="del-box">
        <div class="del-inner">
            <div class="del-icon">⚠️</div>
            <div class="del-title">Confirm Delete</div>
            <div class="del-body" id="deleteModalBody">Remove this watcher?</div>
        </div>
        <div class="del-foot">
            <button onclick="closeDeleteModal()" class="btn-del-cancel">Cancel</button>
            <a href="#" id="deleteConfirmBtn" class="btn-del-confirm">Delete</a>
        </div>
    </div>
</div>

<script>
let addMap, editMap, addMarker, editMarker;

/* ── ADD FORM TOGGLE ── */
function toggleAddForm() {
    const panel = document.getElementById('addWatcherForm');
    const isOpen = panel.classList.contains('open');
    panel.classList.toggle('open');

    if (!isOpen && !addMap) {
        setTimeout(initAddMap, 120);
    }
}

/* ── ADD MAP ── */
function initAddMap() {
    const lat = parseFloat(document.getElementById('add_latitude').value)  || 14.5995;
    const lng = parseFloat(document.getElementById('add_longitude').value) || 120.9842;

    addMap    = L.map('addMap').setView([lat, lng], 13);
    addMarker = L.marker([lat, lng], { draggable: true }).addTo(addMap);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(addMap);

    addMap.on('click',         e => updateAddMarker(e.latlng));
    addMarker.on('dragend',    e => updateAddMarker(e.target.getLatLng()));
}

function updateAddMarker(latlng) {
    addMarker.setLatLng(latlng);
    document.getElementById('add_latitude').value  = latlng.lat;
    document.getElementById('add_longitude').value = latlng.lng;
    reverseGeocode(latlng.lat, latlng.lng, 'add');
}

/* ── EDIT WATCHER ── */
function editWatcher(w) {
    document.getElementById('edit_username').value     = w.username      || '';
    document.getElementById('edit_email').value        = w.email         || '';
    document.getElementById('edit_first_name').value  = w.first_name    || '';
    document.getElementById('edit_middle_name').value = w.middle_name   || '';
    document.getElementById('edit_last_name').value   = w.last_name     || '';
    document.getElementById('edit_phone_number').value= w.phone_number  || '';
    document.getElementById('edit_address').value     = w.address       || '';
    document.getElementById('edit_password').value    = '';
    document.getElementById('edit_checkpoint_id').value = w.checkpoint_id || '';

    const lat = parseFloat(w.latitude)  || 14.5995;
    const lng = parseFloat(w.longitude) || 120.9842;
    document.getElementById('edit_latitude').value  = lat;
    document.getElementById('edit_longitude').value = lng;

    // show remove-image checkbox only if profile image exists
    document.getElementById('removeImageWrap').style.display = w.profile_image ? 'block' : 'none';

    document.getElementById('editWatcherForm').action = '/admin/updateWatcher/' + w.id;

    document.getElementById('editModal').classList.add('open');

    setTimeout(() => {
        if (!editMap) {
            initEditMap(lat, lng);
        } else {
            editMap.invalidateSize();
            editMarker.setLatLng([lat, lng]);
            editMap.setView([lat, lng], 13);
        }
    }, 220);
}

function initEditMap(lat, lng) {
    editMap    = L.map('editMap').setView([lat, lng], 13);
    editMarker = L.marker([lat, lng], { draggable: true }).addTo(editMap);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(editMap);

    editMap.on('click',        e => updateEditMarker(e.latlng));
    editMarker.on('dragend',   e => updateEditMarker(e.target.getLatLng()));
}

function updateEditMarker(latlng) {
    editMarker.setLatLng(latlng);
    document.getElementById('edit_latitude').value  = latlng.lat;
    document.getElementById('edit_longitude').value = latlng.lng;
    reverseGeocode(latlng.lat, latlng.lng, 'edit');
}

function closeEditModal() {
    document.getElementById('editModal').classList.remove('open');
}

/* ── DELETE MODAL ── */
function openDeleteModal(id, username) {
    document.getElementById('deleteModalBody').innerHTML =
        `Remove watcher <span class="del-name">@${username}</span>?<br><br>
         <span class="del-warn">This cannot be undone.</span>`;
    document.getElementById('deleteConfirmBtn').href = `/admin/deleteWatcher/${id}`;
    document.getElementById('deleteModal').classList.add('open');
}
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('open');
}

/* ── REVERSE GEOCODE ── */
async function reverseGeocode(lat, lng, target) {
    try {
        const res  = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`);
        const data = await res.json();
        if (data?.display_name) {
            if (target === 'add') {
                document.querySelector('textarea[name="address"]').value = data.display_name;
            } else {
                document.getElementById('edit_address').value = data.display_name;
            }
        }
    } catch(e) { console.error('Reverse geocode failed:', e); }
}

/* ── CHECKPOINT HANDLER ── */
function updateCheckpointName(id, formType) {
    // controller handles name generation; just log for debug
    console.log(`Checkpoint ${id} selected for ${formType}`);
}

/* ── CLOSE ON BACKDROP ── */
document.getElementById('editModal').addEventListener('click',  function(e) { if(e.target===this) closeEditModal(); });
document.getElementById('deleteModal').addEventListener('click', function(e) { if(e.target===this) closeDeleteModal(); });
document.addEventListener('keydown', e => { if(e.key==='Escape') { closeEditModal(); closeDeleteModal(); } });
</script>

<?= $this->endSection() ?>