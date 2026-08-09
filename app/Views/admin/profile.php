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

    /* ── PROFILE CARD ── */
    .profile-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 22px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        margin-bottom: 24px;
        animation: fadeUp 0.5s cubic-bezier(0.22,1,0.36,1) 0.06s both;
        position: relative;
    }
    .profile-card::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, var(--maroon), var(--maroon-lite));
    }

    /* card header */
    .pcard-head {
        padding: 20px 24px 18px;
        border-bottom: 1px solid var(--border);
        background: var(--bg-tint);
        display: flex; align-items: center; gap: 12px;
    }
    .pcard-head-icon {
        width: 36px; height: 36px; border-radius: 10px;
        background: var(--maroon-soft); border: 1px solid var(--maroon-border);
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem; flex-shrink: 0;
    }
    .pcard-head-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.25rem; letter-spacing: 2.5px; color: var(--text); line-height: 1;
    }
    .pcard-head-sub {
        font-size: 0.6rem; font-weight: 700;
        letter-spacing: 0.15em; text-transform: uppercase;
        color: var(--text-muted); margin-top: 3px;
    }

    /* card body */
    .pcard-body { padding: 26px 24px; }

    /* ── AVATAR BLOCK ── */
    .avatar-section {
        display: flex; gap: 28px; align-items: flex-start;
        margin-bottom: 28px;
        flex-wrap: wrap;
    }
    .avatar-wrap {
        position: relative; flex-shrink: 0;
    }
    .avatar-img {
        width: 110px; height: 110px;
        border-radius: 50%; object-fit: cover;
        border: 3px solid var(--maroon-border);
        box-shadow: 0 4px 18px rgba(123,13,30,0.14);
        display: block;
        transition: border-color 0.2s;
    }
    .avatar-wrap:hover .avatar-img { border-color: var(--maroon-lite); }

    .avatar-upload-btn {
        position: absolute; bottom: 4px; right: 4px;
        width: 30px; height: 30px; border-radius: 50%;
        background: var(--maroon); border: 2px solid var(--surface);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(123,13,30,0.3);
        transition: background 0.14s, transform 0.13s;
    }
    .avatar-upload-btn:hover { background: var(--maroon-deep); transform: scale(1.08); }
    .avatar-upload-btn svg { color: #fff; }

    .avatar-meta {
        display: flex; flex-direction: column; gap: 8px; padding-top: 4px;
    }
    .avatar-remove-label {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 0.68rem; font-weight: 700;
        color: #EF4444; cursor: pointer;
        letter-spacing: 0.05em;
    }
    .avatar-remove-label input { accent-color: #EF4444; }
    .avatar-hint {
        font-size: 0.62rem; font-weight: 600;
        color: var(--text-muted); letter-spacing: 0.06em;
    }

    /* readonly info pills beside avatar */
    .readonly-row {
        display: flex; gap: 10px; flex-wrap: wrap;
        margin-top: 2px;
    }
    .readonly-pill {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--bg-tint); border: 1px solid var(--border);
        border-radius: 100px; padding: 6px 14px;
        font-size: 0.70rem; font-weight: 700;
        color: var(--text-mid);
    }
    .readonly-pill .pill-label {
        font-size: 0.56rem; font-weight: 800;
        letter-spacing: 0.18em; text-transform: uppercase;
        color: var(--text-muted);
    }
    .readonly-pill .pill-sep { color: var(--border); }

    /* right side fields in avatar row */
    .avatar-fields { flex: 1; min-width: 220px; display: flex; flex-direction: column; gap: 14px; }

    /* ── FORM FIELDS ── */
    .fields-grid-3 {
        display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px;
        margin-bottom: 14px;
    }
    @media (max-width: 640px) { .fields-grid-3 { grid-template-columns: 1fr; } }

    .fields-grid-2 {
        display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px;
        margin-bottom: 14px;
    }
    @media (max-width: 640px) { .fields-grid-2 { grid-template-columns: 1fr; } }

    .form-field { display: flex; flex-direction: column; gap: 6px; }

    .field-label {
        font-size: 0.58rem; font-weight: 800;
        letter-spacing: 0.18em; text-transform: uppercase;
        color: var(--text-muted);
    }
    .field-req { color: var(--maroon-lite); margin-left: 2px; }

    .field-input {
        padding: 11px 14px;
        background: var(--bg-tint); border: 1.5px solid var(--border);
        border-radius: 12px;
        font-size: 0.84rem; font-weight: 600; color: var(--text);
        outline: none;
        transition: border-color 0.18s, box-shadow 0.18s, background 0.18s;
        font-family: 'Montserrat', sans-serif;
        width: 100%;
    }
    .field-input::placeholder { color: #C9A8AF; font-weight: 500; }
    .field-input:focus {
        border-color: var(--maroon);
        background: var(--surface);
        box-shadow: 0 0 0 3px rgba(123,13,30,0.09);
    }
    .field-input[readonly] {
        background: var(--bg-tint); color: var(--text-muted);
        cursor: not-allowed; border-style: dashed;
    }
    .field-input[type="password"] { letter-spacing: 0.1em; }

    /* ── PASSWORD SECTION ── */
    .password-divider {
        display: flex; align-items: center; gap: 14px;
        margin: 24px 0 20px;
    }
    .password-divider::before,
    .password-divider::after {
        content: ''; flex: 1; height: 1px;
        background: var(--border);
    }
    .password-divider-label {
        display: flex; align-items: center; gap: 7px;
        font-size: 0.62rem; font-weight: 800;
        letter-spacing: 0.2em; text-transform: uppercase;
        color: var(--text-muted); white-space: nowrap;
    }
    .password-divider-label span { font-size: 0.9rem; }

    .pw-hint {
        font-size: 0.62rem; font-weight: 600;
        color: var(--text-muted); margin-top: 6px;
        letter-spacing: 0.04em;
    }

    /* ── FORM FOOTER ── */
    .pcard-footer {
        padding: 16px 24px;
        border-top: 1px solid var(--border);
        background: var(--bg-tint);
        display: flex; justify-content: flex-end;
    }
    .btn-save {
        padding: 12px 28px;
        background: var(--maroon); border: none;
        border-radius: 12px;
        font-size: 0.78rem; font-weight: 800;
        letter-spacing: 0.1em; text-transform: uppercase;
        color: #fff; cursor: pointer;
        box-shadow: 0 4px 14px rgba(123,13,30,0.28);
        transition: background 0.16s, transform 0.13s, box-shadow 0.16s;
        font-family: 'Montserrat', sans-serif;
    }
    .btn-save:hover {
        background: var(--maroon-deep);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(123,13,30,0.36);
    }
    .btn-save:active { transform: translateY(1px); }

    /* ── ACCOUNT INFO CARD ── */
    .info-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px; overflow: hidden;
        box-shadow: var(--shadow-sm);
        animation: fadeUp 0.5s cubic-bezier(0.22,1,0.36,1) 0.14s both;
    }
    .info-card-head {
        padding: 18px 24px 16px;
        border-bottom: 1px solid var(--border);
        background: var(--bg-tint);
        display: flex; align-items: center; gap: 11px;
    }
    .info-card-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.15rem; letter-spacing: 2.5px; color: var(--text); line-height: 1;
    }
    .info-card-body {
        padding: 22px 24px;
        display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;
    }
    @media (max-width: 480px) { .info-card-body { grid-template-columns: 1fr; } }
    .info-item label {
        font-size: 0.58rem; font-weight: 800;
        letter-spacing: 0.2em; text-transform: uppercase;
        color: var(--text-muted); display: block; margin-bottom: 5px;
    }
    .info-item p {
        font-size: 0.84rem; font-weight: 700; color: var(--text);
    }
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

<!-- ── PROFILE SECTION ── -->
<div class="section-divider"><span class="section-label">My Profile</span></div>

<div class="profile-card">

    <div class="pcard-head">
        <div class="pcard-head-icon">👤</div>
        <div>
            <div class="pcard-head-title">Account Settings</div>
            <div class="pcard-head-sub">Update your personal information and password</div>
        </div>
    </div>

    <form action="/admin/updateProfile" method="post" enctype="multipart/form-data">
        <div class="pcard-body">

            <!-- ── AVATAR + READONLY BADGES + EMAIL ── -->
            <div class="avatar-section">

                <!-- Avatar -->
                <div>
                    <div class="avatar-wrap">
                        <?php
                            $userModel = new \App\Models\UserModel();
                            $profileImage = $userModel->getProfileImage($admin);
                        ?>
                        <img src="<?= $profileImage ?>" alt="Profile" class="avatar-img" id="avatarPreview">
                        <label for="profile_image" class="avatar-upload-btn" title="Upload photo">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                                      d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </label>
                        <input type="file" id="profile_image" name="profile_image" accept="image/*" class="hidden" style="display:none">
                    </div>

                    <div style="margin-top:10px; display:flex; flex-direction:column; gap:6px; align-items:center;">
                        <?php if(!empty($admin['profile_image'])): ?>
                        <label class="avatar-remove-label">
                            <input type="checkbox" name="remove_image" value="1">
                            Remove photo
                        </label>
                        <?php endif; ?>
                        <span class="avatar-hint">JPG, PNG or GIF · Max 2MB</span>
                    </div>
                </div>

                <!-- Right side: readonly pills + email -->
                <div class="avatar-fields">
                    <div class="readonly-row">
                        <div class="readonly-pill">
                            <span class="pill-label">Username</span>
                            <span class="pill-sep">·</span>
                            <span><?= esc($admin['username']) ?></span>
                        </div>
                        <div class="readonly-pill">
                            <span class="pill-label">Role</span>
                            <span class="pill-sep">·</span>
                            <span>Administrator</span>
                        </div>
                    </div>

                    <div class="form-field">
                        <label class="field-label">Email Address <span class="field-req">*</span></label>
                        <input type="email" name="email" value="<?= esc($admin['email'] ?? '') ?>"
                               required class="field-input" placeholder="you@example.com">
                    </div>

                    <div class="form-field">
                        <label class="field-label">Phone Number</label>
                        <input type="tel" name="phone_number" value="<?= esc($admin['phone_number'] ?? '') ?>"
                               class="field-input" placeholder="+63 9XX XXX XXXX">
                    </div>
                </div>
            </div>

            <!-- ── NAME FIELDS ── -->
            <div class="fields-grid-3">
                <div class="form-field">
                    <label class="field-label">First Name <span class="field-req">*</span></label>
                    <input type="text" name="first_name" value="<?= esc($admin['first_name'] ?? '') ?>"
                           required class="field-input" placeholder="Juan">
                </div>
                <div class="form-field">
                    <label class="field-label">Middle Name</label>
                    <input type="text" name="middle_name" value="<?= esc($admin['middle_name'] ?? '') ?>"
                           class="field-input" placeholder="Optional">
                </div>
                <div class="form-field">
                    <label class="field-label">Last Name <span class="field-req">*</span></label>
                    <input type="text" name="last_name" value="<?= esc($admin['last_name'] ?? '') ?>"
                           required class="field-input" placeholder="dela Cruz">
                </div>
            </div>

            <!-- ── PASSWORD SECTION ── -->
            <div class="password-divider">
                <span class="password-divider-label"><span>🔒</span> Change Password</span>
            </div>

            <div class="fields-grid-3">
                <div class="form-field">
                    <label class="field-label">Current Password</label>
                    <input type="password" name="current_password"
                           class="field-input" placeholder="••••••••">
                </div>
                <div class="form-field">
                    <label class="field-label">New Password</label>
                    <input type="password" name="new_password"
                           class="field-input" placeholder="••••••••">
                </div>
                <div class="form-field">
                    <label class="field-label">Confirm Password</label>
                    <input type="password" name="confirm_password"
                           class="field-input" placeholder="••••••••">
                </div>
            </div>
            <p class="pw-hint">Leave password fields empty to keep your current password.</p>

        </div>

        <div class="pcard-footer">
            <button type="submit" class="btn-save">💾 Save Changes</button>
        </div>
    </form>
</div>

<!-- ── ACCOUNT INFO CARD ── -->
<?php if(isset($admin['created_at']) || isset($admin['last_login'])): ?>

<div class="section-divider"><span class="section-label">Account Info</span></div>

<div class="info-card">
    <div class="info-card-head">
        <div class="pcard-head-icon">📅</div>
        <div>
            <div class="info-card-title">Account Details</div>
        </div>
    </div>
    <div class="info-card-body">
        <?php if(isset($admin['created_at'])): ?>
        <div class="info-item">
            <label>Member Since</label>
            <p><?= date('F j, Y · g:i A', strtotime($admin['created_at'])) ?></p>
        </div>
        <?php endif; ?>
        <?php if(isset($admin['last_login'])): ?>
        <div class="info-item">
            <label>Last Login</label>
            <p><?= date('F j, Y · g:i A', strtotime($admin['last_login'])) ?></p>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php endif; ?>

<script>
document.getElementById('profile_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatarPreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>

<?= $this->endSection() ?>