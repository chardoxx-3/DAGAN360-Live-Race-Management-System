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

    /* ── LOCK THE ENTIRE SCROLL CHAIN on mobile ──
       body → .shell → .main-area → .content-area
       Every ancestor must be overflow:hidden + fixed height,
       otherwise any one of them can scroll. */
    @media (max-width: 767px) {
        html, body {
            overflow: hidden !important;
            height: 100% !important;
        }
        .shell {
            overflow: hidden !important;
            height: 100% !important;
        }
        .main-area {
            overflow: hidden !important;
            height: 100% !important;
            min-height: unset !important;
        }
        .content-area {
            overflow: hidden !important;
            padding-bottom: 0 !important;
            /* Fill from topbar bottom to bottom-nav top */
            height: calc(100dvh - 58px - 64px) !important;
        }
    }

    /* ── SCAN WRAP ──
       Fills the content-area exactly, with the 22px top padding already applied. */
    .scan-wrap {
        max-width: 440px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    @media (max-width: 767px) {
        .scan-wrap {
            /* content-area has 22px top padding, so subtract that */
            height: calc(100dvh - 58px - 64px - 22px);
            min-height: 0;
            overflow: hidden;
        }
    }

    @media (min-width: 768px) {
        .scan-wrap {
            height: auto;
            padding: 8px 0;
        }
    }

    /* ── CHECKPOINT HERO ── */
    .cp-hero {
        background: linear-gradient(155deg, var(--maroon-lite) 0%, var(--maroon-deep) 100%);
        border-radius: 20px;
        padding: 22px 24px 20px;
        text-align: center;
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
        animation: heroIn 0.5s cubic-bezier(0.22,1,0.36,1) both;
        box-shadow: 0 4px 20px rgba(123,13,30,0.28);
    }
    @keyframes heroIn {
        from { opacity: 0; transform: translateY(-14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .cp-hero::before {
        content: '';
        position: absolute; inset: 0;
        background-image: repeating-linear-gradient(
            -45deg,
            rgba(255,255,255,0.04) 0px, rgba(255,255,255,0.04) 1px,
            transparent 1px, transparent 14px
        );
        pointer-events: none;
    }

    .cp-eyebrow {
        font-size: 0.56rem;
        font-weight: 800;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.6);
        margin-bottom: 6px;
        font-family: 'Montserrat', sans-serif;
    }
    .cp-number {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 4.2rem;
        letter-spacing: 4px;
        color: #fff;
        line-height: 1;
        text-shadow: 0 2px 18px rgba(0,0,0,0.25);
        animation: cpPop 0.6s cubic-bezier(0.22,1,0.36,1) 0.1s both;
    }
    @keyframes cpPop {
        from { opacity: 0; transform: scale(0.88); }
        to   { opacity: 1; transform: scale(1); }
    }
    .cp-label {
        font-size: 0.6rem;
        font-weight: 700;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.55);
        margin-top: 4px;
        font-family: 'Montserrat', sans-serif;
    }
    .live-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(255,255,255,0.14);
        border: 1px solid rgba(255,255,255,0.22);
        border-radius: 100px;
        padding: 5px 13px;
        font-size: 0.56rem; font-weight: 800;
        letter-spacing: 0.16em; text-transform: uppercase;
        color: #fff; margin-top: 12px;
        font-family: 'Montserrat', sans-serif;
        animation: livePillBeat 2s ease-in-out infinite;
    }
    @keyframes livePillBeat {
        0%,100% { box-shadow: none; }
        50%      { box-shadow: 0 0 12px 2px rgba(255,255,255,0.12); }
    }
    .live-dot {
        width: 6px; height: 6px; background: #fff;
        border-radius: 50%; flex-shrink: 0;
        animation: blink 1.4s ease-in-out infinite;
    }
    @keyframes blink {
        0%,100% { opacity: 1; transform: scale(1); }
        50%      { opacity: 0.4; transform: scale(0.6); }
    }

    /* ── FLASH MESSAGES ── */
    .flash-ok, .flash-err {
        display: flex; align-items: center; gap: 10px;
        padding: 11px 15px; border-radius: 12px;
        font-size: 0.78rem; font-weight: 700;
        animation: slideIn 0.35s ease both;
        flex-shrink: 0;
        font-family: 'Montserrat', sans-serif;
    }
    .flash-ok { background: #F0FDF4; border: 1px solid #BBF7D0; color: #15803D; }

    /* ── ERROR: loud, impossible-to-miss ── */
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
        animation: slideIn 0.35s ease both, errPulse 1.6s ease-in-out 0.35s 3;
    }
    @keyframes errPulse {
        0%,100% { box-shadow: 0 4px 24px rgba(123,13,30,0.45); }
        50%      { box-shadow: 0 4px 36px rgba(185,28,53,0.75); }
    }
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(-6px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── SCAN CARD ── */
    .scan-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 22px;
        padding: 24px 22px 20px;
        box-shadow: 0 1px 4px rgba(123,13,30,0.05), 0 6px 20px rgba(123,13,30,0.07);
        position: relative; overflow: hidden;
        animation: cardIn 0.5s cubic-bezier(0.22,1,0.36,1) 0.12s both;
        flex: 1;
        display: flex; flex-direction: column; justify-content: center;
        min-height: 0;
    }
    @media (min-width: 768px) {
        .scan-card { flex: unset; }
    }
    .scan-card::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, var(--maroon), var(--maroon-lite));
    }
    @keyframes cardIn {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .field-label {
        display: block;
        font-size: 0.58rem; font-weight: 800;
        letter-spacing: 0.24em; text-transform: uppercase;
        color: var(--text-muted);
        text-align: center;
        margin-bottom: 14px;
        font-family: 'Montserrat', sans-serif;
    }

    .bib-input {
        width: 100%; text-align: center;
        font-family: 'Bebas Neue', sans-serif;
        font-size: 5rem; letter-spacing: 10px;
        padding: 16px 12px;
        background: var(--bg-tint);
        border: 1.5px solid var(--border);
        border-radius: 16px;
        color: var(--text);
        outline: none;
        transition: border-color 0.18s, box-shadow 0.18s, background 0.18s, transform 0.15s;
        -moz-appearance: textfield;
        box-sizing: border-box;
    }
    .bib-input::-webkit-inner-spin-button,
    .bib-input::-webkit-outer-spin-button { -webkit-appearance: none; }
    .bib-input::placeholder { color: rgba(155,104,114,0.35); letter-spacing: 8px; }
    .bib-input:focus {
        border-color: var(--maroon);
        background: var(--surface);
        box-shadow: 0 0 0 3px rgba(123,13,30,0.10);
        transform: translateY(-1px);
    }

    .btn-submit {
        width: 100%; margin-top: 14px;
        padding: 15px;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.82rem; font-weight: 800;
        letter-spacing: 0.1em; text-transform: uppercase;
        color: #fff; background: var(--maroon);
        border: none; border-radius: 14px; cursor: pointer;
        position: relative; overflow: hidden;
        transition: background 0.18s, transform 0.15s, box-shadow 0.18s;
        box-shadow: 0 4px 16px rgba(123,13,30,0.30);
    }
    .btn-submit::after {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.09) 0%, transparent 60%);
    }
    .btn-submit:hover {
        background: var(--maroon-deep);
        transform: translateY(-1px);
        box-shadow: 0 6px 22px rgba(123,13,30,0.38);
    }
    .btn-submit:active { transform: translateY(1px); box-shadow: 0 2px 8px rgba(123,13,30,0.2); }

    /* ── TIP ── */
    .scan-tip {
        text-align: center;
        font-size: 0.65rem; font-weight: 600;
        color: var(--text-muted);
        font-family: 'Montserrat', sans-serif;
        flex-shrink: 0;
        letter-spacing: 0.04em;
    }

    /* ── FEEDBACK ANIMATIONS ── */
    @keyframes successRipple {
        0%   { box-shadow: 0 0 0 0 rgba(21,128,61,0.35); }
        70%  { box-shadow: 0 0 0 18px rgba(21,128,61,0); }
        100% { box-shadow: 0 0 0 0 rgba(21,128,61,0); }
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
    .flash-ok  { animation: slideIn 0.35s ease both, successRipple 0.7s ease 0.35s !important; }
    .flash-err { animation: slideIn 0.35s ease both, errPulse 1.6s ease-in-out 0.35s 3, errorShake 0.55s ease 0.1s !important; }

    /* ── GRACEFUL SCALE-DOWN on very short screens ── */
    @media (max-height: 640px) {
        .scan-tip { display: none; }
        .cp-hero { padding: 14px 20px 12px; }
        .cp-number { font-size: 3rem; }
        .live-badge { margin-top: 7px; padding: 3px 10px; }
        .scan-card { padding: 16px 18px 14px; }
        .bib-input { font-size: 3.8rem; padding: 10px 12px; }
        .btn-submit { padding: 12px; margin-top: 10px; }
        .scan-wrap { gap: 10px; }
    }
</style>

<div class="scan-wrap">

    <!-- Checkpoint Hero -->
    <div class="cp-hero">
        <div class="cp-eyebrow">Checkpoint Active</div>
        <div class="cp-number">CP #<?= $checkpoint_id ?></div>
        <div class="cp-label">Recorded Passages</div>
        <div class="live-badge"><span class="live-dot"></span>Scanning Active</div>
    </div>

    <!-- Flash messages -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="flash-ok">✓ <?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
        <div class="flash-err">🚫 <?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <!-- Scan Form -->
    <div class="scan-card">
        <form action="/watcher/submitEntry" method="POST">
            <label class="field-label">Enter Bib Number</label>
            <input
                type="number"
                name="bib_number"
                autofocus
                class="bib-input"
                placeholder="000"
                inputmode="numeric"
                required>
            <button type="submit" class="btn-submit">⚡ Record Passage</button>
        </form>
    </div>

    <p class="scan-tip"></p>

</div>

<script>
(function () {
    // ── Detect flash type from rendered DOM ──
    var hasSuccess = document.querySelector('.flash-ok')  !== null;
    var hasError   = document.querySelector('.flash-err') !== null;

    // ── SUCCESS: pleasant two-tone chime via Web Audio API ──
    if (hasSuccess) {
        try {
            var ctx = new (window.AudioContext || window.webkitAudioContext)();

            function playTone(freq, startTime, duration, gainPeak) {
                var osc  = ctx.createOscillator();
                var gain = ctx.createGain();
                osc.connect(gain);
                gain.connect(ctx.destination);
                osc.type = 'sine';
                osc.frequency.setValueAtTime(freq, startTime);
                gain.gain.setValueAtTime(0, startTime);
                gain.gain.linearRampToValueAtTime(gainPeak, startTime + 0.02);
                gain.gain.exponentialRampToValueAtTime(0.001, startTime + duration);
                osc.start(startTime);
                osc.stop(startTime + duration);
            }

            // Short ascending two-note chime
            playTone(880, ctx.currentTime,        0.18, 0.18);
            playTone(1320, ctx.currentTime + 0.13, 0.28, 0.14);
        } catch (e) { /* Audio not available — silent fallback */ }
    }

    // ── ERROR: vibration pattern via Vibration API ──
    if (hasError) {
        try {
            if (navigator.vibrate) {
                // Three short sharp pulses: buzz–pause–buzz–pause–buzz
                navigator.vibrate([80, 60, 80, 60, 100]);
            }
        } catch (e) { /* Vibration not available — silent fallback */ }
    }
})();
</script>

<?= $this->endSection() ?>