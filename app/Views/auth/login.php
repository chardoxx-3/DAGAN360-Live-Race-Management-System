<?= $this->extend('templates/auth') ?>
<?= $this->section('content') ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;500;600;700;800&display=swap');

    :root {
        --maroon:      #7B0D1E;
        --maroon-deep: #560A15;
        --maroon-mid:  #9C1429;
        --maroon-lite: #B91C35;
        --maroon-pale: #F9E8EB;
        --maroon-tint: #FDF2F4;
        --gold:        #F5C842;
        --gold-light:  #FDF3C0;
        --silver:      #C8D6E0;
        --white:       #FFFFFF;
        --off-white:   #FDF6F7;
        --text-dark:   #1A0208;
        --text-mid:    #5A2030;
        --text-muted:  rgba(90,32,48,0.55);
        --border:      rgba(123,13,30,0.14);
        --border-focus:rgba(123,13,30,0.55);
        --shadow-sm:   0 2px 12px rgba(123,13,30,0.08);
        --muted:       #c08090;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    /* ── BODY ── */
    body {
        font-family: 'Montserrat', sans-serif;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: #0d0005;
        background-image:
            radial-gradient(ellipse 80% 55% at 50% -5%, rgba(123,13,30,0.72) 0%, transparent 68%),
            radial-gradient(ellipse 45% 35% at 85% 85%, rgba(86,10,21,0.35) 0%, transparent 60%),
            radial-gradient(ellipse 35% 30% at 10% 90%, rgba(123,13,30,0.18) 0%, transparent 60%);
        overflow: hidden;
        position: relative;
    }

    /* ── BLOBS ── */
    .blob {
        position: fixed;
        border-radius: 50%;
        pointer-events: none;
        z-index: 1;
        filter: blur(56px);
        will-change: transform;
    }
    .blob-1 {
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(123,13,30,0.28) 0%, transparent 70%);
        top: -180px; left: -180px;
        animation: blob1 18s ease-in-out infinite;
    }
    .blob-2 {
        width: 360px; height: 360px;
        background: radial-gradient(circle, rgba(156,20,41,0.18) 0%, transparent 70%);
        bottom: -100px; right: -80px;
        animation: blob2 22s ease-in-out infinite;
    }
    .blob-3 {
        width: 280px; height: 280px;
        background: radial-gradient(circle, rgba(185,28,53,0.14) 0%, transparent 70%);
        top: 45%; left: 55%;
        animation: blob3 16s ease-in-out infinite;
    }
    @keyframes blob1 {
        0%,100% { transform: translate(0px,0px) scale(1); }
        33%     { transform: translate(40px,-30px) scale(1.08); }
        66%     { transform: translate(-20px,50px) scale(0.94); }
    }
    @keyframes blob2 {
        0%,100% { transform: translate(0px,0px) scale(1); }
        33%     { transform: translate(-50px,30px) scale(1.1); }
        66%     { transform: translate(30px,-40px) scale(0.92); }
    }
    @keyframes blob3 {
        0%,100% { transform: translate(0px,0px) scale(1); }
        50%     { transform: translate(-35px,-45px) scale(1.12); }
    }

    /* ── PARTICLES ── */
    #particle-canvas {
        position: fixed;
        inset: 0;
        z-index: 2;
        pointer-events: none;
        opacity: 0.45;
    }

    /* ── DIAGONAL SPEED LINES (sporty accent) ── */
    .speed-lines {
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 2;
        overflow: hidden;
    }
    .speed-line {
        position: absolute;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(185,28,53,0.18), transparent);
        transform-origin: left center;
        transform: rotate(-28deg);
        animation: speedLineSlide 4s ease-in-out infinite;
    }
    .speed-line:nth-child(1) { width: 60%; top: 18%; left: -10%; animation-delay: 0s; }
    .speed-line:nth-child(2) { width: 40%; top: 35%; left: 30%; animation-delay: 1.2s; opacity: 0.6; }
    .speed-line:nth-child(3) { width: 55%; top: 62%; left: -5%; animation-delay: 2.4s; opacity: 0.45; }
    .speed-line:nth-child(4) { width: 35%; top: 80%; left: 40%; animation-delay: 0.7s; opacity: 0.5; }
    @keyframes speedLineSlide {
        0%   { opacity: 0; transform: rotate(-28deg) translateX(-20px); }
        20%  { opacity: 1; }
        80%  { opacity: 1; }
        100% { opacity: 0; transform: rotate(-28deg) translateX(20px); }
    }

    /* ── MAIN WRAPPER ── */
    .login-wrapper {
        position: relative;
        z-index: 10;
        width: 100%;
        max-width: 400px;
        padding: 32px 28px;
        display: flex;
        flex-direction: column;
        align-items: center;
        animation: slideUp 0.65s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(28px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── LOGO SECTION ── */
    .logo-section {
        text-align: center;
        margin-bottom: 10px;
        animation: fadeInDown 0.5s cubic-bezier(0.22,1,0.36,1) 0.15s both;
    }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-12px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* Sport number accent above logo */
    .sport-accent {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
    }
    .sport-line {
        width: 32px; height: 2px;
        background: linear-gradient(90deg, transparent, var(--maroon-lite));
        border-radius: 2px;
    }
    .sport-line.right {
        background: linear-gradient(90deg, var(--maroon-lite), transparent);
    }
    .sport-tag {
        font-size: 0.52rem;
        font-weight: 800;
        letter-spacing: 0.35em;
        text-transform: uppercase;
        color: var(--maroon-lite);
        opacity: 0.9;
    }

    .logo {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 4.2rem;
        letter-spacing: 4px;
        line-height: 1;
        color: var(--white);
    }
    .logo .num {
        color: var(--maroon-lite);
        text-shadow: 0 0 24px rgba(185,28,53,0.5);
    }
    .logo-sub {
        font-size: 0.52rem;
        font-weight: 800;
        letter-spacing: 0.35em;
        text-transform: uppercase;
        color: #e8c0c8;
        margin-top: 6px;
    }

    /* Medal decorations */
    .medal-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 18px;
        margin-bottom: 32px;
        animation: fadeIn 0.5s ease 0.4s both;
    }
    .medal-dot {
        width: 8px; height: 8px;
        border-radius: 50%;
        background: rgba(255,255,255,0.12);
    }
    .medal-item {
        font-size: 1.25rem;
        filter: drop-shadow(0 2px 6px rgba(0,0,0,0.5));
    }
    .medal-rule {
        flex: 1;
        max-width: 60px;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.12), transparent);
    }

    /* ── SECTION DIVIDER ── */
    .section-divider {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 0 0 24px;
        width: 100%;
    }
    .section-divider::before,
    .section-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
    }
    .section-label {
        font-size: 0.58rem;
        font-weight: 800;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: #d4a0aa;
        white-space: nowrap;
    }

    /* ── FLASH ERROR ── */
    .flash-error {
        width: 100%;
        margin-bottom: 20px;
        padding: 12px 16px;
        background: rgba(185,28,53,0.18);
        border: 1px solid rgba(185,28,53,0.35);
        border-left: 3px solid var(--maroon-lite);
        border-radius: 10px;
        color: #ffb3be;
        font-size: 0.8rem;
        font-weight: 600;
        animation: shakeIn 0.4s ease both;
    }
    @keyframes shakeIn {
        0%   { transform: translateX(-6px); opacity: 0; }
        40%  { transform: translateX(4px); }
        70%  { transform: translateX(-2px); }
        100% { transform: translateX(0); opacity: 1; }
    }

    /* ── FORM ── */
    form {
        width: 100%;
    }

    .field-group {
        width: 100%;
        margin-bottom: 18px;
        animation: fadeSlideUp 0.45s cubic-bezier(0.22,1,0.36,1) both;
    }
    .field-group:nth-child(2) { animation-delay: 0.5s; }
    .field-group:nth-child(3) { animation-delay: 0.62s; }
    @keyframes fadeSlideUp {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    label {
        display: block;
        font-size: 0.65rem;
        font-weight: 800;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: #f0d0d8;
        margin-bottom: 8px;
    }

    .input-wrap {
        position: relative;
    }
    .input-icon {
        position: absolute;
        left: 14px;
        top: 50%; transform: translateY(-50%);
        color: #c08090;
        pointer-events: none;
        transition: color 0.2s;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 14px 44px 14px 42px;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.88rem;
        font-weight: 500;
        color: #ffffff;
        background: rgba(255,255,255,0.08);
        border: 1.5px solid rgba(185,28,53,0.50);
        border-radius: 12px;
        outline: none;
        transition:
            border-color 0.22s ease,
            background   0.22s ease,
            box-shadow   0.22s ease,
            transform    0.15s ease;
    }
    input[type="text"]::placeholder,
    input[type="password"]::placeholder {
        color: #b07080;
        font-weight: 500;
    }
    input[type="text"]:focus,
    input[type="password"]:focus {
        border-color: var(--maroon-lite);
        background: rgba(255,255,255,0.11);
        box-shadow: 0 0 0 3px rgba(123,13,30,0.30),
                    0 2px 16px rgba(123,13,30,0.35);
        transform: translateY(-1px);
    }
    .input-wrap:focus-within .input-icon {
        color: #f0c0cc;
    }

    /* ── PASSWORD TOGGLE ── */
    .toggle-pw {
        position: absolute;
        right: 13px;
        top: 50%; transform: translateY(-50%);
        background: none;
        border: none;
        padding: 4px;
        cursor: pointer;
        color: #c08090;
        transition: color 0.2s, transform 0.15s;
        display: flex;
        align-items: center;
        border-radius: 6px;
    }
    .toggle-pw:hover {
        color: #ffffff;
        transform: translateY(-50%) scale(1.1);
    }
    .toggle-pw:active {
        transform: translateY(-50%) scale(0.92);
    }
    .toggle-pw .icon-hide { display: none; }
    .toggle-pw.visible .icon-show { display: none; }
    .toggle-pw.visible .icon-hide { display: block; }
    .toggle-pw.visible { color: #f0c0cc; }

    /* ── SUBMIT BUTTON ── */
    .btn-submit {
        width: 100%;
        margin-top: 28px;
        padding: 16px 20px;
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.2rem;
        letter-spacing: 0.25em;
        color: var(--white);
        background: linear-gradient(135deg, var(--maroon-deep) 0%, var(--maroon-mid) 55%, var(--maroon-lite) 100%);
        border: none;
        border-radius: 12px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        transition:
            transform    0.18s cubic-bezier(0.34,1.56,0.64,1),
            box-shadow   0.22s ease;
        box-shadow: 0 4px 24px rgba(123,13,30,0.5),
                    0 1px 0 rgba(255,255,255,0.10) inset;
        animation: fadeSlideUp 0.45s cubic-bezier(0.22,1,0.36,1) 0.75s both;
    }
    .btn-submit::before {
        content: '';
        position: absolute;
        top: 0; left: -75%;
        width: 50%; height: 100%;
        background: linear-gradient(105deg, transparent 30%, rgba(255,255,255,0.12) 50%, transparent 70%);
        transform: skewX(-15deg);
        transition: left 0.55s ease;
    }
    .btn-submit:hover::before { left: 125%; }
    .btn-submit:hover {
        transform: translateY(-2px) scale(1.012);
        box-shadow: 0 8px 32px rgba(123,13,30,0.6),
                    0 1px 0 rgba(255,255,255,0.10) inset;
    }
    .btn-submit:active {
        transform: translateY(1px) scale(0.98);
        box-shadow: 0 2px 10px rgba(123,13,30,0.35);
    }

    /* maroon accent bar below button */
    .gold-bar {
        margin: 22px auto 0;
        width: 48px; height: 2px;
        background: linear-gradient(90deg, transparent, var(--maroon-lite), transparent);
        border-radius: 2px;
        opacity: 0.6;
        animation: fadeIn 0.5s ease 0.9s both;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    /* ── FOOTER ── */
    .footer {
        position: relative;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 20px 0 28px;
        border-top: 1px solid rgba(255,255,255,0.07);
        width: 100%;
        max-width: 400px;
        animation: fadeIn 0.5s ease 1s both;
    }

    .footer-text {
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: #c08090;
    }

    .internix-logo {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(185,28,53,0.15);
        border: 1px solid rgba(185,28,53,0.45);
        border-radius: 8px;
        padding: 5px 10px 5px 7px;
    }

    .internix-icon {
        width: 20px; height: 20px;
        border-radius: 5px;
        background: linear-gradient(135deg, var(--maroon-lite), var(--maroon-deep));
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .internix-icon svg {
        width: 12px; height: 12px;
    }

    .internix-wordmark {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 0.95rem;
        letter-spacing: 2px;
        color: var(--white);
        line-height: 1;
    }
    .internix-wordmark span {
        color: var(--maroon-lite);
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 480px) {
        .login-wrapper  { padding: 28px 20px; }
        .logo           { font-size: 3.2rem; letter-spacing: 3px; }
        .logo-sub       { font-size: 0.46rem; letter-spacing: 0.28em; }
        label           { font-size: 0.62rem; }
        input[type="text"],
        input[type="password"] { font-size: 0.82rem; padding: 12px 42px 12px 40px; }
        .btn-submit     { font-size: 1.05rem; padding: 14px 16px; }
        .flash-error    { font-size: 0.74rem; }
        .footer         { max-width: 100%; padding: 18px 20px 24px; }
        .footer-text    { font-size: 0.52rem; }
        .internix-wordmark { font-size: 0.8rem; }
        .internix-icon  { width: 16px; height: 16px; }
    }

    @media (max-width: 360px) {
        .logo           { font-size: 2.8rem; }
        input[type="text"],
        input[type="password"] { font-size: 0.76rem; }
        .btn-submit     { font-size: 0.95rem; }
    }
</style>

<!-- Background layers -->
<div class="blob blob-1"></div>
<div class="blob blob-2"></div>
<div class="blob blob-3"></div>
<canvas id="particle-canvas"></canvas>
<div class="speed-lines">
    <div class="speed-line"></div>
    <div class="speed-line"></div>
    <div class="speed-line"></div>
    <div class="speed-line"></div>
</div>

<!-- ── LOGIN WRAPPER (no card) ── -->
<div class="login-wrapper">

    <!-- LOGO -->
    <div class="logo-section">
        <div class="sport-accent">
            <div class="sport-line"></div>
            <span class="sport-tag">Live Race System</span>
            <div class="sport-line right"></div>
        </div>
        <div class="logo">DAGAN<span class="num">360</span></div>
        <div class="logo-sub">Live Race Management System</div>
    </div>

    <!-- Decorative medals -->
    <div class="medal-row">
        <div class="medal-rule"></div>
        <div class="medal-dot"></div>
        <div class="medal-item">🥇</div>
        <div class="medal-item">🥈</div>
        <div class="medal-item">🥉</div>
        <div class="medal-dot"></div>
        <div class="medal-rule"></div>
    </div>

    <div class="section-divider">
        <span class="section-label">Secure Access</span>
    </div>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="flash-error"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="/auth/login" method="POST">

        <div class="field-group">
            <label for="username">Username</label>
            <div class="input-wrap">
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
                <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Enter username"
                    required
                    autocomplete="username"
                >
            </div>
        </div>

        <div class="field-group">
            <label for="password">Password</label>
            <div class="input-wrap">
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter password"
                    required
                    autocomplete="current-password"
                >
                <button type="button" class="toggle-pw" id="togglePw" aria-label="Show password">
                    <svg class="icon-show" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                    </svg>
                    <svg class="icon-hide" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                </button>
            </div>
        </div>

        <button type="submit" class="btn-submit">Sign In to the Race</button>

    </form>

    <div class="gold-bar"></div>

</div><!-- /login-wrapper -->

<!-- ── FOOTER ── -->
<footer class="footer">
    <span class="footer-text">Powered by</span>
    <div class="internix-logo">
        <div class="internix-icon">
            <svg viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 2H5.5V5.5H2V2Z" fill="white" opacity="0.9"/>
                <path d="M6.5 2H10V5.5H6.5V2Z" fill="white" opacity="0.5"/>
                <path d="M2 6.5H5.5V10H2V6.5Z" fill="white" opacity="0.5"/>
                <path d="M6.5 6.5H10V10H6.5V6.5Z" fill="white" opacity="0.9"/>
            </svg>
        </div>
        <span class="internix-wordmark">INTER<span>N</span>IX</span>
    </div>
</footer>

<script>
    (function () {
        var btn   = document.getElementById('togglePw');
        var input = document.getElementById('password');
        if (!btn || !input) return;
        btn.addEventListener('click', function () {
            var isHidden = input.type === 'password';
            input.type   = isHidden ? 'text' : 'password';
            btn.classList.toggle('visible', isHidden);
            btn.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
            input.focus();
        });
    })();

    /* ── PARTICLE CANVAS ── */
    (function () {
        var canvas = document.getElementById('particle-canvas');
        var ctx    = canvas.getContext('2d');
        var W, H, particles = [];

        var COLORS = [
            'rgba(123,13,30,',
            'rgba(185,28,53,',
            'rgba(156,20,41,',
            'rgba(86,10,21,',
        ];

        function resize() {
            W = canvas.width  = window.innerWidth;
            H = canvas.height = window.innerHeight;
        }

        function Particle() {
            this.reset(true);
        }
        Particle.prototype.reset = function (init) {
            this.x    = Math.random() * W;
            this.y    = init ? Math.random() * H : H + 10;
            this.r    = 1.0 + Math.random() * 2.2;
            this.vx   = (Math.random() - 0.5) * 0.3;
            this.vy   = -(0.15 + Math.random() * 0.4);
            this.life = 0;
            this.maxLife = 180 + Math.random() * 260;
            this.color = COLORS[Math.floor(Math.random() * COLORS.length)];
        };
        Particle.prototype.update = function () {
            this.x   += this.vx;
            this.y   += this.vy;
            this.life++;
            if (this.life > this.maxLife || this.y < -10) this.reset(false);
        };
        Particle.prototype.draw = function () {
            var prog  = this.life / this.maxLife;
            var alpha = prog < 0.15
                ? prog / 0.15
                : prog > 0.75
                    ? 1 - (prog - 0.75) / 0.25
                    : 1;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
            ctx.fillStyle = this.color + (alpha * 0.5) + ')';
            ctx.fill();
        };

        resize();
        for (var i = 0; i < 55; i++) particles.push(new Particle());

        function loop() {
            ctx.clearRect(0, 0, W, H);
            particles.forEach(function (p) { p.update(); p.draw(); });
            requestAnimationFrame(loop);
        }

        window.addEventListener('resize', resize);
        loop();
    })();
</script>

<?= $this->endSection() ?>