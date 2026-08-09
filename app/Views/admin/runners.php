<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;500;600;700;800&display=swap');

    :root {
        --maroon:       #7B0D1E;
        --maroon-mid:   #9C1429;
        --maroon-lite:  #B91C35;
        --maroon-deep:  #560A15;
        --maroon-soft:  #FFF0F2;
        --maroon-border:rgba(123,13,30,0.14);
        --text:         #0F0608;
        --text-mid:     #4B2531;
        --text-muted:   #9B6872;
        --border:       #EDE0E2;
        --surface:      #FFFFFF;
        --bg-tint:      #FDF6F7;
        --shadow-sm:    0 1px 3px rgba(123,13,30,0.06), 0 4px 12px rgba(123,13,30,0.06);
        --shadow-md:    0 2px 8px rgba(123,13,30,0.08), 0 8px 24px rgba(123,13,30,0.09);
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

    /* ── REGISTER CARD ── */
    .register-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 24px 24px 22px;
        box-shadow: var(--shadow-sm);
        margin-bottom: 24px;
        animation: fadeUp 0.45s cubic-bezier(0.22,1,0.36,1) 0.05s both;
        position: relative;
        overflow: hidden;
    }
    /* accent top stripe */
    .register-card::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, var(--maroon), var(--maroon-lite));
        border-radius: 20px 20px 0 0;
    }

    .card-head {
        display: flex; align-items: center; gap: 11px;
        margin-bottom: 20px;
    }
    .card-head-icon {
        width: 36px; height: 36px; border-radius: 10px;
        background: var(--maroon-soft); border: 1px solid var(--maroon-border);
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem; flex-shrink: 0;
    }
    .card-head-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.3rem; letter-spacing: 2.5px; color: var(--text); line-height: 1;
    }
    .card-head-sub {
        font-size: 0.6rem; font-weight: 700;
        letter-spacing: 0.16em; text-transform: uppercase;
        color: var(--text-muted); margin-top: 2px;
    }

    .form-row {
        display: flex; gap: 12px; flex-wrap: wrap; align-items: flex-end;
    }
    .form-field { display: flex; flex-direction: column; gap: 6px; }
    .form-field.grow { flex: 1; min-width: 180px; }
    .form-field.fixed { width: 150px; }

    .field-label {
        font-size: 0.58rem; font-weight: 800;
        letter-spacing: 0.18em; text-transform: uppercase;
        color: var(--text-muted);
    }
    .field-input {
        padding: 11px 14px;
        background: var(--bg-tint);
        border: 1.5px solid var(--border);
        border-radius: 12px;
        font-size: 0.85rem; font-weight: 600;
        color: var(--text);
        outline: none;
        transition: border-color 0.18s, box-shadow 0.18s, background 0.18s;
        font-family: 'Montserrat', sans-serif;
    }
    .field-input::placeholder { color: #C9A8AF; font-weight: 500; }
    .field-input:focus {
        border-color: var(--maroon);
        background: var(--surface);
        box-shadow: 0 0 0 3px rgba(123,13,30,0.09);
    }

    /* Bib input uses Bebas for the big-number feel */
    .field-input.bib-input {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.4rem; letter-spacing: 3px;
        text-align: center; padding: 8px 14px;
        -moz-appearance: textfield;
    }
    .field-input.bib-input::-webkit-inner-spin-button,
    .field-input.bib-input::-webkit-outer-spin-button { -webkit-appearance: none; }

    .btn-register {
        padding: 12px 26px;
        background: var(--maroon);
        color: #fff; border: none;
        border-radius: 12px;
        font-size: 0.78rem; font-weight: 800;
        letter-spacing: 0.1em; text-transform: uppercase;
        cursor: pointer; white-space: nowrap;
        box-shadow: 0 4px 14px rgba(123,13,30,0.28);
        transition: background 0.16s, transform 0.13s, box-shadow 0.16s;
        align-self: flex-end;
        font-family: 'Montserrat', sans-serif;
    }
    .btn-register:hover {
        background: var(--maroon-deep);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(123,13,30,0.36);
    }
    .btn-register:active { transform: translateY(1px); }

    /* ── FLASH MESSAGES ── */
    .flash-ok, .flash-err {
        display: flex; align-items: center; gap: 10px;
        padding: 12px 16px; border-radius: 12px;
        font-size: 0.80rem; font-weight: 700;
        margin-bottom: 18px;
        animation: fadeUp 0.35s ease both;
    }
    .flash-ok  { background: #F0FDF4; border: 1px solid #BBF7D0; color: #15803D; }
    .flash-err { background: var(--maroon-soft); border: 1px solid var(--maroon-border); color: var(--maroon); }

    /* ── RUNNER COUNT BADGE ── */
    .runner-count-pill {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--maroon-soft); border: 1px solid var(--maroon-border);
        border-radius: 100px; padding: 5px 13px;
        font-size: 0.62rem; font-weight: 800;
        letter-spacing: 0.12em; text-transform: uppercase;
        color: var(--maroon); white-space: nowrap;
    }
    .count-dot {
        width: 5px; height: 5px; border-radius: 50%;
        background: var(--maroon-lite); flex-shrink: 0;
    }

    /* ── TABLE CARD ── */
    .table-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px; overflow: hidden;
        box-shadow: var(--shadow-sm);
        animation: fadeUp 0.5s cubic-bezier(0.22,1,0.36,1) 0.12s both;
    }
    .table-card-head {
        padding: 18px 22px 16px;
        border-bottom: 1px solid var(--border);
        background: var(--bg-tint);
        display: flex; align-items: center; justify-content: space-between; gap: 12px;
    }
    .table-card-title-block { display: flex; align-items: center; gap: 10px; }
    .table-card-icon {
        width: 34px; height: 34px; border-radius: 10px;
        background: var(--maroon-soft); border: 1px solid var(--maroon-border);
        display: flex; align-items: center; justify-content: center;
        font-size: 0.95rem; flex-shrink: 0;
    }
    .table-card-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.2rem; letter-spacing: 2.5px; color: var(--text); line-height: 1;
    }
    .table-card-sub {
        font-size: 0.6rem; font-weight: 700;
        letter-spacing: 0.16em; text-transform: uppercase;
        color: var(--text-muted); margin-top: 2px;
    }

    .table-scroll { overflow-x: auto; -webkit-overflow-scrolling: touch; }

    table.runners-table {
        width: 100%; border-collapse: collapse;
        min-width: 420px;
    }
    table.runners-table thead {
        background: var(--bg-tint);
        border-bottom: 1px solid var(--border);
    }
    table.runners-table th {
        padding: 12px 18px; text-align: left;
        font-size: 0.58rem; font-weight: 800;
        letter-spacing: 0.22em; text-transform: uppercase;
        color: var(--text-muted); white-space: nowrap;
    }
    table.runners-table th.center { text-align: center; }
    table.runners-table th.right  { text-align: right; }

    table.runners-table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background 0.13s;
        animation: rowIn 0.4s cubic-bezier(0.22,1,0.36,1) both;
    }
    table.runners-table tbody tr:last-child { border-bottom: none; }
    table.runners-table tbody tr:hover { background: var(--bg-tint); }

    /* stagger */
    table.runners-table tbody tr:nth-child(1) { animation-delay:.04s; }
    table.runners-table tbody tr:nth-child(2) { animation-delay:.08s; }
    table.runners-table tbody tr:nth-child(3) { animation-delay:.12s; }
    table.runners-table tbody tr:nth-child(4) { animation-delay:.16s; }
    table.runners-table tbody tr:nth-child(5) { animation-delay:.20s; }
    table.runners-table tbody tr:nth-child(6) { animation-delay:.24s; }
    table.runners-table tbody tr:nth-child(7) { animation-delay:.28s; }
    table.runners-table tbody tr:nth-child(8) { animation-delay:.32s; }
    @keyframes rowIn {
        from { opacity: 0; transform: translateX(-10px); }
        to   { opacity: 1; transform: translateX(0); }
    }

    table.runners-table td {
        padding: 13px 18px; vertical-align: middle;
    }

    .bib-chip {
        display: inline-flex; align-items: center;
        padding: 5px 12px;
        background: var(--maroon-soft); border: 1px solid var(--maroon-border);
        border-radius: 9px;
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.15rem; letter-spacing: 2px; color: var(--maroon);
    }

    .runner-row-name {
        font-size: 0.88rem; font-weight: 700; color: var(--text);
    }

    /* action buttons */
    .action-cell { display: flex; align-items: center; justify-content: flex-end; gap: 7px; }

    .btn-edit {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 7px 14px;
        background: var(--bg-tint); border: 1px solid var(--border);
        border-radius: 9px;
        font-size: 0.7rem; font-weight: 800;
        letter-spacing: 0.07em; text-transform: uppercase;
        color: var(--text-mid); cursor: pointer;
        transition: background 0.14s, border-color 0.14s, transform 0.12s;
        font-family: 'Montserrat', sans-serif;
        white-space: nowrap;
    }
    .btn-edit:hover {
        background: #fff; border-color: var(--maroon-border);
        color: var(--maroon); transform: translateY(-1px);
    }

    .btn-delete {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 7px 14px;
        background: transparent; border: 1px solid #FECDD3;
        border-radius: 9px;
        font-size: 0.7rem; font-weight: 800;
        letter-spacing: 0.07em; text-transform: uppercase;
        color: #EF4444; cursor: pointer; text-decoration: none;
        transition: background 0.14s, border-color 0.14s, transform 0.12s;
        font-family: 'Montserrat', sans-serif;
        white-space: nowrap;
    }
    .btn-delete:hover {
        background: #FFF1F2; border-color: #FCA5A5;
        transform: translateY(-1px);
    }

    /* empty state */
    .empty-state {
        text-align: center; padding: 52px 20px;
        color: var(--text-muted);
    }
    .empty-icon { font-size: 2.4rem; display: block; margin-bottom: 12px; opacity: 0.45; }
    .empty-text {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1rem; letter-spacing: 2.5px; color: var(--text-muted);
    }

    /* ── EDIT MODAL ── */
    .modal-overlay {
        position: fixed; inset: 0;
        background: rgba(15,6,8,0.35);
        backdrop-filter: blur(4px);
        z-index: 9999;
        display: none; align-items: center; justify-content: center;
        padding: 20px;
    }
    .modal-overlay.open { display: flex; animation: overlayIn 0.2s ease both; }
    @keyframes overlayIn { from { opacity: 0; } to { opacity: 1; } }

    .modal-box {
        background: var(--surface); border: 1px solid var(--border);
        border-radius: 22px; padding: 0;
        max-width: 400px; width: 100%;
        box-shadow: 0 24px 64px rgba(123,13,30,0.18);
        animation: modalPop 0.32s cubic-bezier(0.22,1,0.36,1) both;
        overflow: hidden;
        position: relative;
    }
    /* top accent stripe on modal too */
    .modal-box::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, var(--maroon), var(--maroon-lite));
    }
    @keyframes modalPop {
        from { opacity: 0; transform: scale(0.93) translateY(14px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .modal-head {
        padding: 20px 22px 16px;
        border-bottom: 1px solid var(--border);
        background: var(--bg-tint);
        display: flex; align-items: center; justify-content: space-between;
    }
    .modal-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.3rem; letter-spacing: 3px; color: var(--text);
    }
    .modal-close-btn {
        width: 30px; height: 30px; border-radius: 8px;
        background: var(--maroon-soft); border: 1px solid var(--maroon-border);
        color: var(--maroon); cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        transition: background 0.13s;
        font-size: 1rem; line-height: 1;
    }
    .modal-close-btn:hover { background: #FECDD3; }

    .modal-body { padding: 22px; display: flex; flex-direction: column; gap: 14px; }
    .modal-foot {
        padding: 16px 22px;
        border-top: 1px solid var(--border);
        background: var(--bg-tint);
        display: flex; justify-content: flex-end; gap: 10px;
    }
    .btn-modal-cancel {
        padding: 10px 20px;
        background: var(--bg-tint); border: 1px solid var(--border);
        border-radius: 10px; font-size: 0.75rem; font-weight: 800;
        letter-spacing: 0.08em; text-transform: uppercase;
        color: var(--text-mid); cursor: pointer;
        transition: background 0.13s;
        font-family: 'Montserrat', sans-serif;
    }
    .btn-modal-cancel:hover { background: var(--border); }
    .btn-modal-save {
        padding: 10px 22px;
        background: var(--maroon); border: none;
        border-radius: 10px; font-size: 0.75rem; font-weight: 800;
        letter-spacing: 0.08em; text-transform: uppercase;
        color: #fff; cursor: pointer;
        box-shadow: 0 3px 10px rgba(123,13,30,0.28);
        transition: background 0.14s, transform 0.12s;
        font-family: 'Montserrat', sans-serif;
    }
    .btn-modal-save:hover { background: var(--maroon-deep); transform: translateY(-1px); }

    /* ── DELETE CONFIRM MODAL ── */
    .del-modal-overlay {
        position: fixed; inset: 0;
        background: rgba(15,6,8,0.35);
        backdrop-filter: blur(4px);
        z-index: 9999;
        display: none; align-items: center; justify-content: center;
        padding: 20px;
    }
    .del-modal-overlay.open { display: flex; animation: overlayIn 0.2s ease both; }
    .del-modal-box {
        background: var(--surface); border: 1px solid var(--border);
        border-radius: 22px; max-width: 360px; width: 100%;
        box-shadow: 0 24px 64px rgba(123,13,30,0.18);
        overflow: hidden; text-align: center;
        animation: modalPop 0.32s cubic-bezier(0.22,1,0.36,1) both;
    }
    .del-modal-inner { padding: 32px 28px 24px; }
    .del-modal-icon {
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
    .del-modal-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.55rem; letter-spacing: 2.5px; color: var(--text); margin-bottom: 8px;
    }
    .del-modal-body {
        font-size: 0.80rem; font-weight: 500; color: #6B7280;
        line-height: 1.65; margin-bottom: 22px;
    }
    .del-modal-bib { color: var(--maroon); font-weight: 800; }
    .del-modal-warn { color: #EF4444; font-size: 0.7rem; }
    .del-modal-foot {
        padding: 0 28px 24px;
        display: flex; gap: 10px;
    }
    .btn-del-cancel {
        flex: 1; padding: 12px;
        background: var(--bg-tint); border: 1px solid var(--border);
        border-radius: 11px; font-size: 0.78rem; font-weight: 800;
        color: var(--text-mid); cursor: pointer;
        transition: background 0.13s;
        font-family: 'Montserrat', sans-serif;
    }
    .btn-del-cancel:hover { background: var(--border); }
    .btn-del-confirm {
        flex: 1; padding: 12px;
        background: #EF4444; border: none;
        border-radius: 11px; font-size: 0.78rem; font-weight: 800;
        color: #fff; cursor: pointer; text-decoration: none;
        display: block; text-align: center;
        box-shadow: 0 3px 10px rgba(239,68,68,0.28);
        transition: background 0.14s, transform 0.12s;
        font-family: 'Montserrat', sans-serif;
    }
    .btn-del-confirm:hover { background: #DC2626; transform: translateY(-1px); }
</style>

<!-- ── REGISTER SECTION ── -->
<div class="section-divider"><span class="section-label">Register Runner</span></div>

<div class="register-card">
    <div class="card-head">
        <div class="card-head-icon">🏃</div>
        <div>
            <div class="card-head-title">Add New Runner</div>
            <div class="card-head-sub">Enter name and bib number to register</div>
        </div>
    </div>

    <!-- Flash messages -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="flash-ok">✓ <?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
        <div class="flash-err">⚠ <?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="/admin/saveRunner" method="POST">
        <div class="form-row">
            <div class="form-field grow">
                <label class="field-label">Full Name</label>
                <input type="text" name="name" placeholder="e.g. Juan dela Cruz"
                       class="field-input" required>
            </div>
            <div class="form-field fixed">
                <label class="field-label">Bib Number</label>
                <input type="text" name="bib_number" placeholder="001"
                       class="field-input bib-input" required>
            </div>
            <button type="submit" class="btn-register">⚡ Register</button>
        </div>
    </form>
</div>

<!-- ── RUNNER DATABASE SECTION ── -->
<div class="section-divider"><span class="section-label">Runner Database</span></div>

<div class="table-card">
    <div class="table-card-head">
        <div class="table-card-title-block">
            <div class="table-card-icon">📋</div>
            <div>
                <div class="table-card-title">All Runners</div>
                <div class="table-card-sub">Registered participants</div>
            </div>
        </div>
        <div class="runner-count-pill">
            <span class="count-dot"></span>
            <?= count($runners) ?> registered
        </div>
    </div>

    <div class="table-scroll">
        <table class="runners-table">
            <thead>
                <tr>
                    <th class="center">Bib #</th>
                    <th>Runner Name</th>
                    <th class="right">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($runners)): ?>
                    <tr>
                        <td colspan="3" style="padding:0">
                            <div class="empty-state">
                                <span class="empty-icon">🏁</span>
                                <span class="empty-text">No Runners Registered Yet</span>
                            </div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach($runners as $runner): ?>
                    <tr>
                        <td style="text-align:center">
                            <span class="bib-chip">#<?= $runner['bib_number'] ?></span>
                        </td>
                        <td>
                            <span class="runner-row-name"><?= esc($runner['name']) ?></span>
                        </td>
                        <td>
                            <div class="action-cell">
                                <button type="button"
                                        class="btn-edit"
                                        onclick="openEditModal(<?= $runner['id'] ?>, '<?= esc(addslashes($runner['name'])) ?>', '<?= esc($runner['bib_number']) ?>')">
                                    ✎ Edit
                                </button>
                                <button type="button"
                                        class="btn-delete"
                                        onclick="openDeleteModal(<?= $runner['id'] ?>, '<?= esc($runner['bib_number']) ?>', '<?= esc(addslashes($runner['name'])) ?>')">
                                    ✕ Delete
                                </button>
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
            <span class="modal-title">Edit Runner</span>
            <button onclick="closeEditModal()" class="modal-close-btn">✕</button>
        </div>
        <form id="editForm" action="/admin/updateRunner" method="POST">
            <input type="hidden" name="id" id="editRunnerId">
            <div class="modal-body">
                <div class="form-field">
                    <label class="field-label">Full Name</label>
                    <input type="text" name="name" id="editName"
                           class="field-input" required>
                </div>
                <div class="form-field">
                    <label class="field-label">Bib Number</label>
                    <input type="text" name="bib_number" id="editBib"
                           class="field-input bib-input" required>
                </div>
            </div>
            <div class="modal-foot">
                <button type="button" onclick="closeEditModal()" class="btn-modal-cancel">Cancel</button>
                <button type="submit" class="btn-modal-save">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- ── DELETE CONFIRM MODAL ── -->
<div id="deleteModal" class="del-modal-overlay">
    <div class="del-modal-box">
        <div class="del-modal-inner">
            <div class="del-modal-icon">⚠️</div>
            <div class="del-modal-title">Confirm Delete</div>
            <div class="del-modal-body" id="deleteModalBody">Remove this runner?</div>
        </div>
        <div class="del-modal-foot">
            <button onclick="closeDeleteModal()" class="btn-del-cancel">Cancel</button>
            <a href="#" id="deleteConfirmBtn" class="btn-del-confirm">Delete</a>
        </div>
    </div>
</div>

<script>
// ── EDIT MODAL ──
function openEditModal(id, name, bib) {
    document.getElementById('editRunnerId').value = id;
    document.getElementById('editName').value     = name;
    document.getElementById('editBib').value      = bib;
    document.getElementById('editModal').classList.add('open');
}
function closeEditModal() {
    document.getElementById('editModal').classList.remove('open');
}

// ── DELETE MODAL ──
function openDeleteModal(id, bib, name) {
    document.getElementById('deleteModalBody').innerHTML =
        `Remove <span class="del-modal-bib">Runner #${bib}</span><br>
         <span style="color:#374151;font-weight:700">${name}</span><br><br>
         <span class="del-modal-warn">This action cannot be undone.</span>`;
    document.getElementById('deleteConfirmBtn').href = `/admin/deleteRunner/${id}`;
    document.getElementById('deleteModal').classList.add('open');
}
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('open');
}

// Close on backdrop click
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) closeEditModal();
});
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});

// Close on Escape
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') { closeEditModal(); closeDeleteModal(); }
});
</script>

<?= $this->endSection() ?>