<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;500;600;700;800&display=swap');

    :root {
        --maroon:        #7B0D1E;
        --maroon-mid:    #9C1429;
        --maroon-lite:   #B91C35;
        --maroon-deep:   #560A15;
        --maroon-soft:   #FFF0F2;
        --maroon-border: rgba(123,13,30,0.14);
        --border:        #EDE0E2;
        --surface:       #FFFFFF;
        --bg-tint:       #FDF6F7;
        --text:          #0F0608;
        --text-muted:    #9B6872;
    }

    /* ── MOBILE SCROLL CHAIN ── */
    @media (max-width: 767px) {
        html, body { overflow: hidden !important; height: 100% !important; }
        .shell      { overflow: hidden !important; height: 100% !important; }
        .main-area  { overflow: hidden !important; height: 100% !important; min-height: unset !important; }
        .content-area {
            overflow: hidden !important;
            padding-bottom: 0 !important;
            height: calc(100dvh - 58px - 64px) !important;
        }
    }

    /* ── PAGE WRAP ── */
    .entries-wrap {
        max-width: 480px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }
    @media (max-width: 767px) {
        .entries-wrap {
            height: calc(100dvh - 58px - 64px - 22px);
            min-height: 0;
            overflow: hidden;
        }
    }
    @media (min-width: 768px) {
        .entries-wrap { height: auto; padding: 8px 0; }
    }

    /* ── HEADER HERO ── */
    .entries-hero {
        background: linear-gradient(155deg, var(--maroon-lite) 0%, var(--maroon-deep) 100%);
        border-radius: 20px;
        padding: 18px 22px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
        box-shadow: 0 4px 20px rgba(123,13,30,0.28);
        animation: heroIn 0.5s cubic-bezier(0.22,1,0.36,1) both;
    }
    @keyframes heroIn {
        from { opacity: 0; transform: translateY(-14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .entries-hero::before {
        content: '';
        position: absolute; inset: 0;
        background-image: repeating-linear-gradient(
            -45deg,
            rgba(255,255,255,0.04) 0px, rgba(255,255,255,0.04) 1px,
            transparent 1px, transparent 14px
        );
        pointer-events: none;
    }
    .hero-left { position: relative; }
    .hero-eyebrow {
        font-size: 0.55rem;
        font-weight: 800;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.6);
        margin-bottom: 4px;
        font-family: 'Montserrat', sans-serif;
    }
    .hero-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 2.2rem;
        letter-spacing: 3px;
        color: #fff;
        line-height: 1;
        text-shadow: 0 2px 12px rgba(0,0,0,0.2);
    }
    .hero-sub {
        font-size: 0.6rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        color: rgba(255,255,255,0.5);
        margin-top: 5px;
        font-family: 'Montserrat', sans-serif;
    }
    .hero-count {
        position: relative;
        text-align: right;
    }
    .count-number {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 3rem;
        letter-spacing: 2px;
        color: #fff;
        line-height: 1;
        text-shadow: 0 2px 14px rgba(0,0,0,0.2);
    }
    .count-label {
        font-size: 0.52rem;
        font-weight: 700;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.5);
        font-family: 'Montserrat', sans-serif;
    }

    /* ── FLASH MESSAGES ── */
    .flash-ok, .flash-err {
        display: flex; align-items: center; gap: 10px;
        border-radius: 12px;
        font-weight: 700;
        flex-shrink: 0;
        font-family: 'Montserrat', sans-serif;
        animation: slideIn 0.35s ease both;
    }
    .flash-ok {
        padding: 11px 15px;
        font-size: 0.78rem;
        background: #F0FDF4;
        border: 1px solid #BBF7D0;
        color: #15803D;
        animation: slideIn 0.35s ease both, successRipple 0.7s ease 0.35s;
    }
    .flash-err {
        background: var(--maroon);
        border: 2px solid var(--maroon-lite);
        color: #fff;
        font-size: 0.85rem;
        font-weight: 800;
        letter-spacing: 0.04em;
        padding: 15px 18px;
        border-radius: 14px;
        box-shadow: 0 4px 24px rgba(123,13,30,0.45);
        animation: slideIn 0.35s ease both, errPulse 1.6s ease-in-out 0.35s 3, errorShake 0.55s ease 0.1s;
    }
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(-6px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes successRipple {
        0%   { box-shadow: 0 0 0 0 rgba(21,128,61,0.35); }
        70%  { box-shadow: 0 0 0 18px rgba(21,128,61,0); }
        100% { box-shadow: 0 0 0 0 rgba(21,128,61,0); }
    }
    @keyframes errPulse {
        0%,100% { box-shadow: 0 4px 24px rgba(123,13,30,0.45); }
        50%      { box-shadow: 0 4px 36px rgba(185,28,53,0.75); }
    }
    @keyframes errorShake {
        0%,100% { transform: translateX(0); }
        15%      { transform: translateX(-7px); }
        30%      { transform: translateX(7px); }
        45%      { transform: translateX(-5px); }
        60%      { transform: translateX(5px); }
        75%      { transform: translateX(-3px); }
        90%      { transform: translateX(3px); }
    }

    /* ── ENTRIES LIST (scrollable) ── */
    .entries-list {
        flex: 1;
        min-height: 0;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        display: flex;
        flex-direction: column;
        gap: 10px;
        /* hide scrollbar but keep scroll */
        scrollbar-width: none;
    }
    .entries-list::-webkit-scrollbar { display: none; }

    /* ── ENTRY CARD ── */
    .entry-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        gap: 14px;
        box-shadow: 0 1px 4px rgba(123,13,30,0.04), 0 3px 12px rgba(123,13,30,0.06);
        position: relative;
        overflow: hidden;
        animation: cardIn 0.4s cubic-bezier(0.22,1,0.36,1) both;
        flex-shrink: 0;
    }
    .entry-card::before {
        content: '';
        position: absolute; left: 0; top: 0; bottom: 0;
        width: 3px;
        background: linear-gradient(180deg, var(--maroon), var(--maroon-lite));
        border-radius: 3px 0 0 3px;
    }
    @keyframes cardIn {
        from { opacity: 0; transform: translateX(-14px); }
        to   { opacity: 1; transform: translateX(0); }
    }
    /* staggered delay */
    .entry-card:nth-child(1)  { animation-delay: 0.04s; }
    .entry-card:nth-child(2)  { animation-delay: 0.08s; }
    .entry-card:nth-child(3)  { animation-delay: 0.12s; }
    .entry-card:nth-child(4)  { animation-delay: 0.16s; }
    .entry-card:nth-child(5)  { animation-delay: 0.20s; }
    .entry-card:nth-child(6)  { animation-delay: 0.24s; }
    .entry-card:nth-child(7)  { animation-delay: 0.28s; }
    .entry-card:nth-child(8)  { animation-delay: 0.32s; }
    .entry-card:nth-child(n+9){ animation-delay: 0.36s; }

    .bib-badge {
        flex-shrink: 0;
        background: var(--maroon-soft);
        border: 1px solid var(--maroon-border);
        border-radius: 10px;
        padding: 8px 12px;
        text-align: center;
        min-width: 58px;
    }
    .bib-badge-num {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.6rem;
        letter-spacing: 2px;
        color: var(--maroon);
        line-height: 1;
    }
    .bib-badge-lbl {
        font-size: 0.46rem;
        font-weight: 800;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--text-muted);
        font-family: 'Montserrat', sans-serif;
        display: block;
        margin-top: 2px;
    }

    .entry-info {
        flex: 1;
        min-width: 0;
    }
    .entry-name {
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--text);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-family: 'Montserrat', sans-serif;
        margin-bottom: 4px;
    }
    .entry-time {
        font-size: 0.66rem;
        font-weight: 600;
        color: var(--text-muted);
        font-family: 'Montserrat', sans-serif;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .entry-time::before {
        content: '';
        display: inline-block;
        width: 5px; height: 5px;
        border-radius: 50%;
        background: var(--maroon-border);
        flex-shrink: 0;
    }

    .btn-remove {
        flex-shrink: 0;
        width: 34px; height: 34px;
        border-radius: 10px;
        border: 1px solid var(--border);
        background: transparent;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.9rem;
        color: var(--text-muted);
        cursor: pointer;
        transition: background 0.14s, border-color 0.14s, color 0.14s, transform 0.12s;
    }
    .btn-remove:hover {
        background: var(--maroon-soft);
        border-color: var(--maroon-border);
        color: var(--maroon);
        transform: scale(1.08);
    }
    .btn-remove:active { transform: scale(0.94); }

    /* ── EMPTY STATE ── */
    .empty-state {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 40px 20px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        box-shadow: 0 1px 4px rgba(123,13,30,0.04);
        animation: cardIn 0.45s cubic-bezier(0.22,1,0.36,1) 0.1s both;
    }
    .empty-icon { font-size: 2.8rem; margin-bottom: 14px; opacity: 0.45; }
    .empty-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.4rem;
        letter-spacing: 2px;
        color: var(--text-muted);
        margin-bottom: 6px;
    }
    .empty-sub {
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--text-muted);
        font-family: 'Montserrat', sans-serif;
        opacity: 0.7;
    }

    /* ── DELETE MODAL ── */
    .modal-overlay {
        position: fixed; inset: 0;
        background: rgba(15,6,8,0.55);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        z-index: 9999;
        display: none;
        align-items: flex-end;
        justify-content: center;
        padding: 0;
    }
    @media (min-width: 480px) {
        .modal-overlay { align-items: center; padding: 20px; }
    }
    .modal-overlay.open { display: flex; animation: overlayIn 0.22s ease both; }
    @keyframes overlayIn { from { opacity: 0; } to { opacity: 1; } }

    .modal-box {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 24px 24px 0 0;
        padding: 10px 24px 36px;
        width: 100%;
        max-width: 420px;
        text-align: center;
        box-shadow: 0 -8px 40px rgba(123,13,30,0.18);
        animation: sheetUp 0.36s cubic-bezier(0.22,1,0.36,1) both;
        position: relative;
    }
    @media (min-width: 480px) {
        .modal-box { border-radius: 22px; padding: 28px 26px 26px; animation: modalPop 0.32s cubic-bezier(0.22,1,0.36,1) both; }
    }
    @keyframes sheetUp {
        from { opacity: 0; transform: translateY(100%); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes modalPop {
        from { opacity: 0; transform: scale(0.93) translateY(12px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .modal-handle {
        width: 36px; height: 4px;
        background: var(--border);
        border-radius: 4px;
        margin: 0 auto 20px;
    }
    @media (min-width: 480px) { .modal-handle { display: none; } }

    .modal-icon {
        width: 54px; height: 54px;
        border-radius: 16px;
        background: var(--maroon-soft);
        border: 1px solid var(--maroon-border);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem;
        margin: 0 auto 14px;
        animation: iconWiggle 0.4s ease 0.1s both;
    }
    @keyframes iconWiggle {
        0%  { transform: rotate(-10deg) scale(0.8); opacity: 0; }
        55% { transform: rotate(5deg) scale(1.05); opacity: 1; }
        100%{ transform: rotate(0) scale(1); }
    }
    .modal-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.55rem;
        letter-spacing: 2px;
        color: var(--text);
        margin-bottom: 8px;
    }
    .modal-body {
        font-size: 0.8rem;
        font-weight: 500;
        color: var(--text-muted);
        line-height: 1.65;
        margin-bottom: 22px;
        font-family: 'Montserrat', sans-serif;
    }
    .modal-bib { color: var(--maroon); font-weight: 800; }
    .modal-warn { color: var(--maroon-lite); font-size: 0.72rem; font-weight: 700; }
    .modal-actions { display: flex; gap: 10px; }

    .btn-modal-cancel {
        flex: 1; padding: 13px;
        background: var(--bg-tint);
        border: 1px solid var(--border);
        border-radius: 13px;
        font-size: 0.8rem; font-weight: 800;
        color: var(--text-muted);
        cursor: pointer;
        font-family: 'Montserrat', sans-serif;
        letter-spacing: 0.06em;
        transition: background 0.14s;
    }
    .btn-modal-cancel:hover { background: var(--border); }

    .btn-modal-delete {
        flex: 1; padding: 13px;
        background: var(--maroon);
        border: none; border-radius: 13px;
        font-size: 0.8rem; font-weight: 800;
        color: #fff; cursor: pointer;
        text-decoration: none; display: block; text-align: center;
        font-family: 'Montserrat', sans-serif;
        letter-spacing: 0.06em;
        box-shadow: 0 4px 14px rgba(123,13,30,0.32);
        transition: background 0.14s, transform 0.12s, box-shadow 0.14s;
    }
    .btn-modal-delete:hover { background: var(--maroon-deep); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(123,13,30,0.4); }
    .btn-modal-delete:active { transform: translateY(1px); }

    /* ── SHORT SCREEN ── */
    @media (max-height: 640px) {
        .entries-hero { padding: 12px 18px 10px; }
        .hero-title { font-size: 1.7rem; }
        .count-number { font-size: 2.2rem; }
        .entries-wrap { gap: 8px; }
    }
</style>

<div class="entries-wrap">

    <!-- Hero Header -->
    <div class="entries-hero">
        <div class="hero-left">
            <div class="hero-eyebrow">Checkpoint #<?= $checkpoint_id ?></div>
            <div class="hero-title">My Entries</div>
            <div class="hero-sub">Recorded passages at this checkpoint</div>
        </div>
        <div class="hero-count">
            <div class="count-number"><?= count($entries) ?></div>
            <div class="count-label">Total</div>
        </div>
    </div>

    <!-- Flash messages -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="flash-ok">✓ <?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
        <div class="flash-err">🚫 <?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <!-- Entries List -->
    <?php if(empty($entries)): ?>
        <div class="empty-state">
            <div class="empty-icon">🏁</div>
            <div class="empty-title">No Entries Yet</div>
            <div class="empty-sub">Passages recorded here will appear below</div>
        </div>
    <?php else: ?>
        <div class="entries-list">
            <?php foreach($entries as $entry): ?>
                <div class="entry-card">
                    <div class="bib-badge">
                        <div class="bib-badge-num"><?= $entry['bib_number'] ?></div>
                        <span class="bib-badge-lbl">Bib</span>
                    </div>
                    <div class="entry-info">
                        <div class="entry-name"><?= esc($entry['name']) ?></div>
                        <div class="entry-time"><?= date('M d · h:i A', strtotime($entry['recorded_at'])) ?></div>
                    </div>
                    <button
                        onclick="openModal(<?= $entry['id'] ?>, '<?= esc($entry['bib_number']) ?>', '<?= esc(addslashes($entry['name'])) ?>')"
                        class="btn-remove"
                        aria-label="Remove entry">
                        ✕
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

<!-- Delete Modal — bottom sheet on mobile, centered on desktop -->
<div id="deleteModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-handle"></div>
        <div class="modal-icon">🗑️</div>
        <div class="modal-title">Remove Entry</div>
        <div class="modal-body" id="modalBody">Remove this entry?</div>
        <div class="modal-actions">
            <button onclick="closeModal()" class="btn-modal-cancel">Cancel</button>
            <a href="#" id="deleteBtn" class="btn-modal-delete">Delete</a>
        </div>
    </div>
</div>

<script>
function openModal(id, bib, name) {
    document.getElementById('modalBody').innerHTML =
        `Remove the entry for <span class="modal-bib">Runner #${bib}</span><br>
        <span style="color:var(--text);font-weight:700">${name}</span><br><br>
        <span class="modal-warn">This cannot be undone.</span>`;
    document.getElementById('deleteBtn').href = `/watcher/deleteEntry/${id}`;
    document.getElementById('deleteModal').classList.add('open');
}
function closeModal() {
    document.getElementById('deleteModal').classList.remove('open');
}
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

// ── Haptic/audio feedback (mirrors scan.php) ──
(function () {
    var hasSuccess = document.querySelector('.flash-ok')  !== null;
    var hasError   = document.querySelector('.flash-err') !== null;
    if (hasSuccess) {
        try {
            var ctx = new (window.AudioContext || window.webkitAudioContext)();
            function playTone(freq, startTime, duration, gainPeak) {
                var osc  = ctx.createOscillator();
                var gain = ctx.createGain();
                osc.connect(gain); gain.connect(ctx.destination);
                osc.type = 'sine';
                osc.frequency.setValueAtTime(freq, startTime);
                gain.gain.setValueAtTime(0, startTime);
                gain.gain.linearRampToValueAtTime(gainPeak, startTime + 0.02);
                gain.gain.exponentialRampToValueAtTime(0.001, startTime + duration);
                osc.start(startTime); osc.stop(startTime + duration);
            }
            playTone(880,  ctx.currentTime,        0.18, 0.18);
            playTone(1320, ctx.currentTime + 0.13, 0.28, 0.14);
        } catch(e) {}
    }
    if (hasError) {
        try { if (navigator.vibrate) navigator.vibrate([80,60,80,60,100]); } catch(e) {}
    }
})();
</script>

<?= $this->endSection() ?>