<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;500;600;700;800&display=swap');

    /* ── TOKENS ── */
    :root {
        --maroon:       #7B0D1E;
        --maroon-mid:   #9C1429;
        --maroon-lite:  #B91C35;
        --maroon-deep:  #560A15;
        --maroon-soft:  #FFF0F2;
        --maroon-border:rgba(123,13,30,0.14);
        --gold:         #F5C842;
        --silver:       #8FA9BA;
        --bronze:       #C07B55;
        --text:         #0F0608;
        --text-mid:     #4B2531;
        --text-muted:   #9B6872;
        --border:       #EDE0E2;
        --surface:      #FFFFFF;
        --bg-tint:      #FDF6F7;
        --shadow-sm:    0 1px 3px rgba(123,13,30,0.06), 0 4px 12px rgba(123,13,30,0.06);
        --shadow-md:    0 2px 8px rgba(123,13,30,0.08), 0 8px 24px rgba(123,13,30,0.09);
    }

    /* ── STAT CARDS ── */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 28px;
        animation: statsIn 0.5s cubic-bezier(0.22,1,0.36,1) both;
    }
    @media (max-width: 640px) { .stats-row { grid-template-columns: 1fr; gap: 10px; } }
    @keyframes statsIn {
        from { opacity: 0; transform: translateY(-12px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .stat-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 22px 22px 20px;
        box-shadow: var(--shadow-sm);
        position: relative;
        overflow: hidden;
        transition: transform 0.18s, box-shadow 0.18s;
    }
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }
    /* accent stripe top */
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        border-radius: 18px 18px 0 0;
        background: linear-gradient(90deg, var(--maroon), var(--maroon-lite));
        opacity: 0;
        transition: opacity 0.2s;
    }
    .stat-card:hover::before { opacity: 1; }
    .stat-card.card-accent::before { opacity: 1; }

    .stat-eyebrow {
        font-size: 0.58rem;
        font-weight: 800;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: var(--text-muted);
        margin-bottom: 10px;
        font-family: 'Montserrat', sans-serif;
    }
    .stat-value {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 3.2rem;
        letter-spacing: 2px;
        line-height: 1;
        color: var(--text);
    }
    .stat-value.accent { color: var(--maroon); }
    .stat-value.live-val {
        color: #15803D;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .stat-icon {
        position: absolute;
        right: 18px; top: 18px;
        width: 38px; height: 38px;
        border-radius: 11px;
        background: var(--maroon-soft);
        border: 1px solid var(--maroon-border);
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem;
    }

    /* ── LIVE PULSE (reused from leaderboard) ── */
    .live-dot {
        display: inline-block;
        width: 8px; height: 8px;
        background: #15803D;
        border-radius: 50%;
        animation: livePulse 1.4s infinite;
        flex-shrink: 0;
    }
    @keyframes livePulse {
        0%,100% { opacity:1; transform: scale(1); box-shadow: 0 0 0 0 rgba(21,128,61,0.5); }
        50%      { opacity:.8; transform: scale(.75); box-shadow: 0 0 0 4px rgba(21,128,61,0); }
    }

    /* ── ACTIVITY TABLE CARD ── */
    .activity-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        animation: cardIn 0.55s cubic-bezier(0.22,1,0.36,1) 0.1s both;
    }
    @keyframes cardIn {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .card-header {
        padding: 20px 22px 16px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        background: var(--bg-tint);
    }
    .card-title-block { display: flex; align-items: center; gap: 11px; }
    .card-title-icon {
        width: 34px; height: 34px;
        border-radius: 10px;
        background: var(--maroon-soft);
        border: 1px solid var(--maroon-border);
        display: flex; align-items: center; justify-content: center;
        font-size: 0.95rem;
        flex-shrink: 0;
    }
    .card-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.25rem;
        letter-spacing: 2px;
        color: var(--text);
        line-height: 1;
    }
    .card-subtitle {
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--text-muted);
        font-family: 'Montserrat', sans-serif;
        margin-top: 2px;
    }
    .entry-count-pill {
        display: inline-flex; align-items: center; gap: 5px;
        background: var(--maroon-soft);
        border: 1px solid var(--maroon-border);
        border-radius: 100px;
        padding: 5px 12px;
        font-size: 0.62rem;
        font-weight: 800;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--maroon);
        font-family: 'Montserrat', sans-serif;
        white-space: nowrap;
    }

    /* ── TABLE ── */
    .table-scroll { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    table.activity-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 540px;
        font-family: 'Montserrat', sans-serif;
    }
    table.activity-table thead {
        background: var(--bg-tint);
        border-bottom: 1px solid var(--border);
    }
    table.activity-table th {
        padding: 12px 18px;
        text-align: left;
        font-size: 0.58rem;
        font-weight: 800;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: var(--text-muted);
        white-space: nowrap;
    }
    table.activity-table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background 0.14s, transform 0.14s;
        animation: rowIn 0.4s cubic-bezier(0.22,1,0.36,1) both;
    }
    table.activity-table tbody tr:last-child { border-bottom: none; }
    table.activity-table tbody tr:hover {
        background: var(--bg-tint);
    }
    table.activity-table td {
        padding: 13px 18px;
        vertical-align: middle;
    }

    /* staggered row animation */
    table.activity-table tbody tr:nth-child(1)  { animation-delay: 0.05s; }
    table.activity-table tbody tr:nth-child(2)  { animation-delay: 0.10s; }
    table.activity-table tbody tr:nth-child(3)  { animation-delay: 0.15s; }
    table.activity-table tbody tr:nth-child(4)  { animation-delay: 0.20s; }
    table.activity-table tbody tr:nth-child(5)  { animation-delay: 0.25s; }
    table.activity-table tbody tr:nth-child(6)  { animation-delay: 0.30s; }
    table.activity-table tbody tr:nth-child(7)  { animation-delay: 0.35s; }
    @keyframes rowIn {
        from { opacity: 0; transform: translateX(-10px); }
        to   { opacity: 1; transform: translateX(0); }
    }

    .td-time {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--text-muted);
        white-space: nowrap;
        font-variant-numeric: tabular-nums;
        letter-spacing: 0.04em;
    }

    .td-name {
        font-size: 0.86rem;
        font-weight: 700;
        color: var(--text);
    }

    .bib-chip {
        display: inline-flex; align-items: center;
        padding: 4px 10px;
        background: var(--maroon-soft);
        border: 1px solid var(--maroon-border);
        border-radius: 8px;
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.05rem;
        letter-spacing: 1.5px;
        color: var(--maroon);
    }

    .checkpoint-pill {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 5px 11px;
        background: var(--bg-tint);
        border: 1px solid var(--border);
        border-radius: 100px;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        color: var(--text-mid);
    }
    .checkpoint-dot {
        width: 5px; height: 5px;
        border-radius: 50%;
        background: var(--maroon-lite);
        flex-shrink: 0;
    }

    .watcher-cell {
        display: flex;
        align-items: center;
        gap: 7px;
    }
    .watcher-name {
        font-size: 0.80rem;
        font-weight: 600;
        color: var(--text-mid);
    }
    .btn-eye {
        display: inline-flex; align-items: center; justify-content: center;
        width: 28px; height: 28px;
        border-radius: 8px;
        background: var(--maroon-soft);
        border: 1px solid var(--maroon-border);
        color: var(--maroon);
        cursor: pointer;
        transition: background 0.14s, transform 0.12s;
        flex-shrink: 0;
    }
    .btn-eye:hover {
        background: #FECDD3;
        transform: scale(1.08);
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 52px 20px;
        color: var(--text-muted);
        font-family: 'Montserrat', sans-serif;
    }
    .empty-icon { font-size: 2.4rem; display: block; margin-bottom: 12px; opacity: 0.45; }
    .empty-text {
        font-size: 0.82rem;
        font-weight: 600;
        font-family: 'Bebas Neue', sans-serif;
        letter-spacing: 2px;
        color: var(--text-muted);
    }

    /* ── CARD FOOTER ── */
    .card-footer {
        padding: 14px 22px;
        border-top: 1px solid var(--border);
        background: var(--bg-tint);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }
    .footer-link {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--maroon);
        text-decoration: none;
        font-family: 'Montserrat', sans-serif;
        transition: gap 0.15s, color 0.15s;
    }
    .footer-link:hover { color: var(--maroon-deep); gap: 8px; }
    .footer-link svg { flex-shrink: 0; }

    /* ── SECTION DIVIDER (from leaderboard) ── */
    .section-divider {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 18px;
        animation: statsIn 0.4s ease both;
    }
    .section-divider::before,
    .section-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--maroon-border), transparent);
    }
    .section-label {
        font-size: 0.58rem;
        font-weight: 800;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--text-muted);
        white-space: nowrap;
        font-family: 'Montserrat', sans-serif;
    }

    /* ── WATCHER MODAL ── */
    #watcherModal {
        font-family: 'Montserrat', sans-serif;
    }
    #watcherModal .modal-inner {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 22px;
        box-shadow: 0 24px 64px rgba(123,13,30,0.18);
        max-width: 560px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
    }
    #watcherModal .modal-head {
        position: sticky; top: 0;
        background: var(--bg-tint);
        border-bottom: 1px solid var(--border);
        padding: 18px 22px;
        display: flex; align-items: center; justify-content: space-between;
        border-radius: 22px 22px 0 0;
        z-index: 2;
    }
    #watcherModal .modal-head-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.3rem;
        letter-spacing: 3px;
        color: var(--text);
    }
    #watcherModal .modal-close {
        width: 32px; height: 32px; border-radius: 9px;
        background: var(--maroon-soft); border: 1px solid var(--maroon-border);
        color: var(--maroon); cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        transition: background 0.14s;
    }
    #watcherModal .modal-close:hover { background: #FECDD3; }
    #watcherModal .modal-body { padding: 22px; }
    #watcherModal .modal-avatar-row {
        display: flex; align-items: center; gap: 14px; margin-bottom: 20px;
    }
    #watcherModal .modal-avatar-wrap img {
        width: 66px; height: 66px; border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--maroon-border);
    }
    #watcherModal .modal-full-name {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.4rem; letter-spacing: 2px; color: var(--text); line-height: 1;
    }
    #watcherModal .modal-username {
        font-size: 0.72rem; font-weight: 600;
        color: var(--text-muted); margin-top: 3px;
    }
    #watcherModal .modal-grid {
        display: grid; grid-template-columns: 1fr 1fr; gap: 14px;
    }
    @media (max-width: 480px) { #watcherModal .modal-grid { grid-template-columns: 1fr; } }
    #watcherModal .modal-field label {
        font-size: 0.56rem; font-weight: 800;
        letter-spacing: 0.2em; text-transform: uppercase;
        color: var(--text-muted); display: block; margin-bottom: 3px;
    }
    #watcherModal .modal-field p {
        font-size: 0.82rem; font-weight: 600; color: var(--text);
    }
    #watcherModal .modal-field p.highlight { color: var(--maroon); }
    #watcherModal .modal-foot {
        position: sticky; bottom: 0;
        background: var(--bg-tint);
        border-top: 1px solid var(--border);
        padding: 14px 22px;
        display: flex; justify-content: flex-end;
        border-radius: 0 0 22px 22px;
    }
    #watcherModal .btn-close-modal {
        padding: 9px 20px;
        background: var(--maroon-soft);
        border: 1px solid var(--maroon-border);
        border-radius: 10px;
        font-size: 0.76rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--maroon);
        cursor: pointer;
        transition: background 0.14s, transform 0.12s;
    }
    #watcherModal .btn-close-modal:hover { background: #FECDD3; transform: translateY(-1px); }
</style>

<!-- ── SECTION LABEL ── -->
<div class="section-divider">
    <span class="section-label">Race Overview</span>
</div>

<!-- ── STAT CARDS ── -->
<div class="stats-row">

    <div class="stat-card card-accent">
        <div class="stat-icon">🏃</div>
        <div class="stat-eyebrow">Total Registered</div>
        <div class="stat-value accent"><?= $total_runners ?></div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">📍</div>
        <div class="stat-eyebrow">Active Checkpoints</div>
        <div class="stat-value">10</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">⚡</div>
        <div class="stat-eyebrow">System Status</div>
        <div class="stat-value live-val">
            <span class="live-dot"></span>Live
        </div>
    </div>

</div>

<!-- ── SECTION LABEL ── -->
<div class="section-divider">
    <span class="section-label">Recent Race Activity</span>
</div>

<!-- ── ACTIVITY TABLE ── -->
<div class="activity-card">

    <div class="card-header">
        <div class="card-title-block">
            <div class="card-title-icon">🏁</div>
            <div>
                <div class="card-title">Race Activity</div>
                <div class="card-subtitle">Live passage log</div>
            </div>
        </div>
        <div class="entry-count-pill">
            <span class="live-dot" style="background:var(--maroon);animation:none;"></span>
            <?= count($recent_logs) ?> latest
        </div>
    </div>

    <div class="table-scroll">
        <table class="activity-table">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Runner</th>
                    <th>Bib #</th>
                    <th>Checkpoint</th>
                    <th>Scanned By</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($recent_logs)): ?>
                <tr>
                    <td colspan="5" style="padding:0">
                        <div class="empty-state">
                            <span class="empty-icon">🏁</span>
                            <span class="empty-text">No Activity Logs Yet</span>
                        </div>
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach($recent_logs as $log): ?>
                    <tr>
                        <td>
                            <span class="td-time"><?= date('H:i:s', strtotime($log['recorded_at'])) ?></span>
                        </td>
                        <td>
                            <span class="td-name"><?= $log['name'] ?></span>
                        </td>
                        <td>
                            <span class="bib-chip">#<?= $log['bib_number'] ?></span>
                        </td>
                        <td>
                            <span class="checkpoint-pill">
                                <span class="checkpoint-dot"></span>
                                CP <?= $log['checkpoint_id'] ?? 'N/A' ?>
                            </span>
                        </td>
                        <td>
                            <div class="watcher-cell">
                                <span class="watcher-name"><?= $log['watcher_name'] ?? 'System' ?></span>
                                <?php if(isset($log['watcher_id']) && $log['watcher_id']): ?>
                                <button type="button"
                                        onclick="showWatcherModal(<?= $log['watcher_id'] ?>)"
                                        class="btn-eye"
                                        title="View Watcher Details">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        <a href="/" target="_blank" class="footer-link">
            Live Leaderboard
            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
            </svg>
        </a>
    </div>
</div>

<!-- ── WATCHER MODAL ── -->
<div id="watcherModal" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden items-center justify-center p-4"
     style="backdrop-filter:blur(4px);">
    <div class="modal-inner">
        <div class="modal-head">
            <span class="modal-head-title">Watcher Profile</span>
            <button onclick="closeWatcherModal()" class="modal-close">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="modal-body">
            <div class="modal-avatar-row">
                <div class="modal-avatar-wrap">
                    <img id="modalAvatar" src="" alt="Watcher">
                </div>
                <div>
                    <div id="modalFullName" class="modal-full-name"></div>
                    <div id="modalUsername" class="modal-username"></div>
                </div>
            </div>

            <div class="modal-grid">
                <div class="modal-field">
                    <label>Email</label>
                    <p id="modalEmail"></p>
                </div>
                <div class="modal-field">
                    <label>Phone</label>
                    <p id="modalPhone"></p>
                </div>
                <div class="modal-field">
                    <label>Checkpoint</label>
                    <p id="modalCheckpoint" class="highlight"></p>
                </div>
                <div class="modal-field">
                    <label>Role</label>
                    <p id="modalRole"></p>
                </div>
                <div class="modal-field">
                    <label>Member Since</label>
                    <p id="modalCreated"></p>
                </div>
                <div class="modal-field">
                    <label>Last Login</label>
                    <p id="modalLastLogin"></p>
                </div>
            </div>

            <div id="modalAddress" class="modal-field" style="margin-top:14px;">
                <label>Address</label>
                <p></p>
            </div>
            <div id="modalLocation" class="modal-field" style="margin-top:14px;">
                <label>Coordinates</label>
                <p></p>
            </div>
        </div>

        <div class="modal-foot">
            <button onclick="closeWatcherModal()" class="btn-close-modal">Close</button>
        </div>
    </div>
</div>

<script>
function showWatcherModal(watcherId) {
    document.getElementById('modalFullName').textContent = 'Loading…';
    document.getElementById('watcherModal').classList.remove('hidden');
    document.getElementById('watcherModal').classList.add('flex');

    fetch(`/admin/getWatcherDetails/${watcherId}`)
        .then(r => r.json())
        .then(data => {
            if (data.error) throw new Error(data.error);
            document.getElementById('modalAvatar').src       = data.profile_image;
            document.getElementById('modalFullName').textContent  = data.full_name || data.username;
            document.getElementById('modalUsername').textContent  = '@' + data.username;
            document.getElementById('modalEmail').textContent     = data.email || 'Not provided';
            document.getElementById('modalPhone').textContent     = data.phone_number || 'Not provided';
            document.getElementById('modalCheckpoint').textContent= data.checkpoint_name;
            document.getElementById('modalRole').textContent      = data.role.charAt(0).toUpperCase() + data.role.slice(1);
            document.getElementById('modalCreated').textContent   = formatDate(data.created_at);
            document.getElementById('modalLastLogin').textContent = data.last_login ? formatDateTime(data.last_login) : 'Never';

            const addrDiv = document.getElementById('modalAddress');
            if (data.address) { addrDiv.querySelector('p').textContent = data.address; addrDiv.classList.remove('hidden'); }
            else addrDiv.classList.add('hidden');

            const locDiv = document.getElementById('modalLocation');
            if (data.latitude && data.longitude) { locDiv.querySelector('p').textContent = `${data.latitude}, ${data.longitude}`; locDiv.classList.remove('hidden'); }
            else locDiv.classList.add('hidden');
        })
        .catch(() => {
            document.getElementById('modalFullName').textContent = 'Error loading data';
        });
}

function closeWatcherModal() {
    document.getElementById('watcherModal').classList.add('hidden');
    document.getElementById('watcherModal').classList.remove('flex');
}

function formatDate(d) {
    if (!d) return 'N/A';
    return new Date(d).toLocaleDateString('en-US', { year:'numeric', month:'long', day:'numeric' });
}
function formatDateTime(d) {
    if (!d) return 'N/A';
    return new Date(d).toLocaleString('en-US', { year:'numeric', month:'short', day:'numeric', hour:'2-digit', minute:'2-digit' });
}

document.getElementById('watcherModal').addEventListener('click', function(e) {
    if (e.target === this) closeWatcherModal();
});
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeWatcherModal(); });
</script>

<?= $this->endSection() ?>