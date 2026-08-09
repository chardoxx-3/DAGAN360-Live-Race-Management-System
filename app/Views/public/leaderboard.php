<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dagan360 | Live Leaderboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --maroon:      #7B0D1E;
            --maroon-deep: #560A15;
            --maroon-mid:  #9C1429;
            --maroon-lite: #B91C35;
            --maroon-glow: rgba(123,13,30,0.45);
            --gold:        #F5C842;
            --silver:      #C8D6E0;
            --bronze:      #D4845A;
            --white:       #FFFFFF;
            --off-white:   #F0E8E8;
            --muted:       rgba(255,255,255,0.45);
            --card:        rgba(255,255,255,0.06);
            --border:      rgba(255,255,255,0.10);
            --bg:          #1A0208;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: var(--bg);
            background-image:
                radial-gradient(ellipse 80% 50% at 50% -10%, rgba(123,13,30,0.55) 0%, transparent 70%),
                radial-gradient(ellipse 40% 30% at 80% 80%, rgba(86,10,21,0.3) 0%, transparent 60%);
            color: var(--white);
            font-family: 'Montserrat', sans-serif;
            min-height: 100vh;
            padding: 28px 20px 0;
            display: flex;
            flex-direction: column;
        }

        /* ── HEADER ── */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 860px;
            margin: 0 auto 32px;
            width: 100%;
        }

        .logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.8rem;
            letter-spacing: 2px;
            line-height: 1;
        }
        .logo .dagan { color: var(--white); }
        .logo .num   { color: var(--maroon-lite); }

        .logo-sub {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: var(--muted);
            margin-top: 3px;
        }

        .live-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.15);
            color: #FF6B6B;
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            padding: 7px 14px;
            border-radius: 100px;
            backdrop-filter: blur(8px);
        }
        .live-dot {
            width: 7px; height: 7px;
            background: #FF6B6B;
            border-radius: 50%;
            animation: pulse 1.4s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); box-shadow: 0 0 0 0 rgba(255,107,107,0.6); }
            50%       { opacity: 0.8; transform: scale(0.75); box-shadow: 0 0 0 4px rgba(255,107,107,0); }
        }

        /* ── PODIUM ── */
        .podium-section {
            max-width: 860px;
            margin: 0 auto 0;
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .section-divider {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 28px;
        }
        .section-divider::before,
        .section-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        }
        .section-label {
            font-size: 0.62rem;
            font-weight: 800;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--muted);
            white-space: nowrap;
        }

        /* Podium stage — app style: avatars float above bars */
        .podium-stage {
            display: grid;
            grid-template-columns: 1fr 1.15fr 1fr;
            align-items: flex-end;
            gap: 10px;
            padding-bottom: 0;
        }

        .podium-col {
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Let the grid's align-items:flex-end handle vertical alignment.
               Each col is only as tall as its content, so bars sit flush at the bottom. */
            height: auto;
            align-self: flex-end;
        }

        .runner-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            padding-bottom: 14px;
            gap: 5px;
        }

        /* Avatar circle */
        .avatar-wrap {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 4px;
        }

        .avatar {
            width: 52px; height: 52px;
            border-radius: 50%;
            background: var(--maroon-mid);
            border: 3px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.4rem;
            color: rgba(255,255,255,0.8);
            position: relative;
        }
        .col-gold   .avatar { border-color: var(--gold);   width: 60px; height: 60px; font-size: 1.6rem; }
        .col-silver .avatar { border-color: var(--silver); }
        .col-bronze .avatar { border-color: var(--bronze); }

        .crown {
            display: block;
            font-size: 1.1rem;
            margin-bottom: 2px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.5));
        }

        .runner-name {
            font-weight: 700;
            font-size: 0.82rem;
            text-align: center;
            color: var(--white);
            line-height: 1.2;
        }
        .col-gold .runner-name { font-size: 0.9rem; }

        .runner-bib {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.1em;
        }
        .col-gold   .runner-bib { color: var(--gold); }
        .col-silver .runner-bib { color: var(--silver); }
        .col-bronze .runner-bib { color: var(--bronze); }

        .checkpoint-tag {
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            padding: 4px 8px;
            font-size: 0.6rem;
            color: var(--muted);
            text-align: center;
            line-height: 1.4;
            max-width: 90px;
        }
        .checkpoint-tag strong {
            display: block;
            font-size: 0.65rem;
            color: var(--white);
            font-weight: 600;
        }

        /* Podium bars */
        .bar-wrap {
            width: 100%;
            border-radius: 14px 14px 0 0;
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .col-gold   .bar-wrap { height: 200px; background: linear-gradient(170deg, var(--maroon-lite) 0%, var(--maroon-deep) 100%); }
        .col-silver .bar-wrap { height: 150px; background: linear-gradient(170deg, #3D0610 0%, #1F0308 100%); border: 1px solid rgba(255,255,255,0.08); border-bottom: none; }
        .col-bronze .bar-wrap { height: 110px;  background: linear-gradient(170deg, #2A040D 0%, #150206 100%); border: 1px solid rgba(255,255,255,0.06); border-bottom: none; }

        /* Shine */
        .bar-wrap::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.12) 0%, transparent 55%);
            pointer-events: none;
        }

        .rank-label {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.4rem;
            letter-spacing: 1px;
        }
        .col-gold   .rank-label { color: var(--gold);   font-size: 1.6rem; }
        .col-silver .rank-label { color: var(--silver); }
        .col-bronze .rank-label { color: var(--bronze); }

        .laurel {
            font-size: 0.9rem;
            opacity: 0.6;
            margin: 0 3px;
        }
        .col-gold .laurel { font-size: 1.1rem; opacity: 0.9; }

        /* Podium floor line */
        .podium-floor {
            max-width: 100%;
            margin: 0 0 48px;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--maroon-mid), var(--maroon-lite), var(--maroon-mid), transparent);
            border-radius: 2px;
            display: block;
            margin-top: -1px; /* close any sub-pixel gap between bars and floor */
        }

        .podium-stage {
            margin-bottom: 0;
        }

        /* Empty state */
        .runner-info.empty .runner-name { color: var(--muted); font-style: italic; font-size: 0.75rem; }

        /* ── RANKS LIST ── */
        .list-section {
            max-width: 860px;
            margin: 0 auto;
            width: 100%;
            padding-bottom: 32px;
        }

        .list-rows {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .list-row {
            display: grid;
            grid-template-columns: 44px 1fr auto;
            align-items: center;
            gap: 14px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 14px 18px;
            transition: background 0.15s, transform 0.15s;
            backdrop-filter: blur(4px);
        }
        .list-row:hover {
            background: rgba(255,255,255,0.09);
            transform: translateX(3px);
        }

        .rank-badge {
            width: 44px; height: 44px;
            border-radius: 12px;
            background: var(--maroon);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.3rem;
            color: rgba(255,255,255,0.85);
            flex-shrink: 0;
        }

        .row-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
            min-width: 0;
        }
        .row-name {
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--white);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .row-bib {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            color: rgba(245,200,66,0.75);
        }

        .row-cp {
            text-align: right;
            flex-shrink: 0;
        }
        .row-cp-name {
            font-size: 0.78rem;
            color: var(--off-white);
            font-weight: 600;
        }
        .row-cp-time {
            font-size: 0.65rem;
            color: var(--muted);
            margin-top: 2px;
        }

        .empty-row {
            text-align: center;
            color: var(--muted);
            font-style: italic;
            font-size: 0.85rem;
            padding: 32px;
        }

        /* ── FOOTER ── */
        .footer {
            max-width: 860px;
            margin: auto auto 0;
            width: 100%;
            padding: 20px 0 28px;
            border-top: 1px solid rgba(255,255,255,0.07);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .footer-text {
            font-size: 0.62rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--muted);
        }

        /* Internix logo — text-based badge */
        .internix-logo {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.12);
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

        /* Shimmer for loading */
        .shimmer {
            background: linear-gradient(90deg, var(--card) 25%, rgba(255,255,255,0.08) 50%, var(--card) 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
            border-radius: 6px;
            height: 14px;
        }
        @keyframes shimmer { from { background-position: 200% 0; } to { background-position: -200% 0; } }

        /* ── MARATHON ANIMATIONS ── */

        /* Animated road/track lines running across the background */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image:
                repeating-linear-gradient(
                    90deg,
                    transparent 0px,
                    transparent 48px,
                    rgba(255,255,255,0.025) 48px,
                    rgba(255,255,255,0.025) 50px
                );
            animation: roadLinesScroll 4s linear infinite;
            z-index: 0;
        }
        body > * { position: relative; z-index: 1; }
        @keyframes roadLinesScroll {
            from { background-position-x: 0; }
            to   { background-position-x: 50px; }
        }

        /* Floating distance marker particles */
        .marathon-particles {
            position: fixed;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
            z-index: 0;
        }
        .particle {
            position: absolute;
            border-radius: 50%;
            opacity: 0;
            animation: particleFloat linear infinite;
        }
        @keyframes particleFloat {
            0%   { transform: translateY(100vh) translateX(0) scale(0.4); opacity: 0; }
            10%  { opacity: 0.5; }
            90%  { opacity: 0.3; }
            100% { transform: translateY(-10vh) translateX(30px) scale(1); opacity: 0; }
        }

        /* Crown bounce loop */
        .crown {
            display: block;
            animation: crownBounce 2.4s ease-in-out infinite;
        }
        @keyframes crownBounce {
            0%, 100% { transform: translateY(0) rotate(-5deg); }
            50%       { transform: translateY(-4px) rotate(5deg); }
        }

        /* Gold avatar pulse glow — like a finish-line spotlight */
        .col-gold .avatar {
            animation: goldGlow 2.5s ease-in-out infinite;
        }
        @keyframes goldGlow {
            0%, 100% { box-shadow: 0 0 10px 2px rgba(245,200,66,0.35); }
            50%       { box-shadow: 0 0 22px 6px rgba(245,200,66,0.65); }
        }

        /* Rank badge heartbeat — like a runner's pulse */
        .rank-badge {
            animation: rankPulse 3s ease-in-out infinite;
        }
        @keyframes rankPulse {
            0%, 100% { transform: scale(1); }
            45%       { transform: scale(1.06); }
            55%       { transform: scale(1.06); }
            60%       { transform: scale(1); }
        }

        /* Podium floor shimmer — finish line tape */
        .podium-floor {
            animation: finishLinePulse 2s ease-in-out infinite;
            position: relative;
            overflow: hidden;
        }
        .podium-floor::after {
            content: '';
            position: absolute;
            top: 0; left: -60%;
            width: 40%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);
            animation: finishLineSweep 3s ease-in-out infinite;
        }
        @keyframes finishLinePulse {
            0%, 100% { opacity: 0.8; }
            50%       { opacity: 1; }
        }
        @keyframes finishLineSweep {
            0%   { left: -60%; }
            100% { left: 120%; }
        }

        /* Live pill extra heartbeat */
        .live-pill {
            animation: livePillBeat 2s ease-in-out infinite;
        }
        @keyframes livePillBeat {
            0%, 100% { box-shadow: none; }
            50%       { box-shadow: 0 0 12px 2px rgba(255,107,107,0.25); }
        }

        /* Section label — stable, no entry animation */
        .section-label {
            opacity: 1;
            letter-spacing: 0.3em;
        }

        /* Laurel leaves sway */
        .laurel {
            display: inline-block;
            animation: laurelSway 2.8s ease-in-out infinite;
        }
        .laurel:first-child { animation-direction: alternate; }
        .laurel:last-child  { animation-direction: alternate-reverse; }
        @keyframes laurelSway {
            0%, 100% { transform: rotate(-8deg) scale(1); }
            50%       { transform: rotate(8deg) scale(1.1); }
        }

        /* Checkpoint tag subtle tick — like a timing chip beep */
        .checkpoint-tag {
            animation: cpTick 4s ease-in-out infinite;
        }
        @keyframes cpTick {
            0%, 90%, 100% { border-color: rgba(255,255,255,0.1); }
            95%            { border-color: rgba(245,200,66,0.45); }
        }
        /* ── CHANGE DETECTION ANIMATIONS ── */

        /* Rank-up flash: green surge when a runner climbs */
        @keyframes rankUp {
            0%   { background: rgba(34,197,94,0.35); transform: translateX(-8px); box-shadow: inset 0 0 0 1px rgba(34,197,94,0.6); }
            40%  { background: rgba(34,197,94,0.15); transform: translateX(0); }
            100% { background: var(--card); box-shadow: none; }
        }
        .anim-rank-up { animation: rankUp 1.2s ease forwards !important; }

        /* Rank-down flash: red dim when overtaken */
        @keyframes rankDown {
            0%   { background: rgba(239,68,68,0.3); transform: translateX(6px); box-shadow: inset 0 0 0 1px rgba(239,68,68,0.5); }
            40%  { background: rgba(239,68,68,0.12); transform: translateX(0); }
            100% { background: var(--card); box-shadow: none; }
        }
        .anim-rank-down { animation: rankDown 1.2s ease forwards !important; }

        /* New entry: row expands from zero height then slides in */
        .anim-new-entry {
            overflow: hidden;
            animation: newEntryExpand 0.55s cubic-bezier(0.22,1,0.36,1) forwards !important;
        }
        @keyframes newEntryExpand {
            0%   { max-height: 0; opacity: 0; transform: translateX(-32px) scale(0.96);
                   background: rgba(245,200,66,0.22); box-shadow: inset 0 0 0 1px rgba(245,200,66,0.55);
                   margin-bottom: 0; padding-top: 0; padding-bottom: 0; }
            55%  { max-height: 80px; opacity: 1; transform: translateX(4px) scale(1.01);
                   background: rgba(245,200,66,0.18); }
            100% { max-height: 80px; opacity: 1; transform: translateX(0) scale(1);
                   background: var(--card); box-shadow: none; }
        }

        /* Checkpoint update: same runner, new checkpoint scanned */
        @keyframes cpUpdate {
            0%   { background: rgba(99,179,237,0.25); box-shadow: inset 0 0 0 1px rgba(99,179,237,0.45); }
            100% { background: var(--card); box-shadow: none; }
        }
        .anim-cp-update { animation: cpUpdate 1.4s ease forwards !important; }

        /* Podium takeover: new runner enters top 3 */
        @keyframes podiumTakeover {
            0%   { filter: brightness(2.2) saturate(1.8); transform: scale(1.04); }
            30%  { filter: brightness(1.3) saturate(1.3); transform: scale(1.01); }
            100% { filter: brightness(1) saturate(1); transform: scale(1); }
        }
        .anim-podium-takeover { animation: podiumTakeover 1.1s ease forwards !important; }

        /* Podium checkpoint update: existing top-3 runner advances */
        @keyframes podiumCpFlash {
            0%   { filter: brightness(1.6) saturate(1.4); }
            100% { filter: brightness(1) saturate(1); }
        }
        .anim-podium-cp { animation: podiumCpFlash 0.9s ease forwards !important; }

        /* Toast notification */
        .change-toast {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(-80px);
            background: rgba(20, 4, 10, 0.92);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 14px;
            padding: 10px 18px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--white);
            backdrop-filter: blur(12px);
            z-index: 999;
            white-space: nowrap;
            box-shadow: 0 8px 32px rgba(0,0,0,0.5);
            transition: transform 0.4s cubic-bezier(0.22,1,0.36,1), opacity 0.3s ease;
            opacity: 0;
            pointer-events: none;
        }
        .change-toast.visible {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }
        .change-toast.hiding {
            transform: translateX(-50%) translateY(-80px);
            opacity: 0;
        }
        .toast-icon { font-size: 1rem; }
        .toast-rank-up   { border-color: rgba(34,197,94,0.5);  }
        .toast-rank-down { border-color: rgba(239,68,68,0.4);  }
        .toast-new       { border-color: rgba(245,200,66,0.5); }
        .toast-cp        { border-color: rgba(99,179,237,0.4); }

        /* ── FIRST-LOAD INTRO (applied once via JS, then removed) ── */
        .intro-active .podium-col .bar-wrap {
            animation: barRise 0.9s cubic-bezier(0.22, 1, 0.36, 1) both;
            transform-origin: bottom center;
        }
        .intro-active .col-gold   .bar-wrap { animation-delay: 0.1s; }
        .intro-active .col-silver .bar-wrap { animation-delay: 0.25s; }
        .intro-active .col-bronze .bar-wrap { animation-delay: 0.4s; }
        @keyframes barRise {
            from { transform: scaleY(0); opacity: 0; }
            to   { transform: scaleY(1); opacity: 1; }
        }
        .intro-active .runner-info {
            animation: infoSlideDown 0.7s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        .intro-active .col-gold   .runner-info { animation-delay: 0.35s; }
        .intro-active .col-silver .runner-info { animation-delay: 0.5s; }
        .intro-active .col-bronze .runner-info { animation-delay: 0.65s; }
        @keyframes infoSlideDown {
            from { opacity: 0; transform: translateY(-16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .intro-active .list-row {
            animation: rowSweepIn 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        .intro-active .list-row:nth-child(1) { animation-delay: 0.05s; }
        .intro-active .list-row:nth-child(2) { animation-delay: 0.12s; }
        .intro-active .list-row:nth-child(3) { animation-delay: 0.19s; }
        .intro-active .list-row:nth-child(4) { animation-delay: 0.26s; }
        .intro-active .list-row:nth-child(5) { animation-delay: 0.33s; }
        .intro-active .list-row:nth-child(6) { animation-delay: 0.40s; }
        .intro-active .list-row:nth-child(7) { animation-delay: 0.47s; }
        @keyframes rowSweepIn {
            from { opacity: 0; transform: translateX(-24px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        /* ── MOBILE RESPONSIVE ── */
        @media (max-width: 480px) {
            body {
                padding: 16px 12px 0;
            }

            /* Header */
            .header {
                margin-bottom: 20px;
            }
            .logo {
                font-size: 1.9rem;
                letter-spacing: 1px;
            }
            .logo-sub {
                font-size: 0.5rem;
                letter-spacing: 0.18em;
            }
            .live-pill {
                font-size: 0.55rem;
                padding: 5px 10px;
                gap: 5px;
            }
            .live-dot {
                width: 6px; height: 6px;
            }

            /* Section divider labels */
            .section-label {
                font-size: 0.5rem;
                letter-spacing: 0.2em;
            }

            /* Podium stage — no fixed height so floor sits flush */
            .podium-stage {
                height: auto;
                gap: 6px;
            }

            /* Podium bars — shorter */
            .col-gold   .bar-wrap { height: 130px; }
            .col-silver .bar-wrap { height: 95px; }
            .col-bronze .bar-wrap { height: 70px; }

            /* Runner info spacing */
            .runner-info {
                padding-bottom: 8px;
                gap: 3px;
            }

            /* Avatars — smaller */
            .avatar {
                width: 38px; height: 38px;
                font-size: 1rem;
                border-width: 2px;
            }
            .col-gold .avatar {
                width: 44px; height: 44px;
                font-size: 1.1rem;
            }

            /* Crown */
            .crown {
                font-size: 0.85rem;
            }

            /* Runner name & bib */
            .runner-name {
                font-size: 0.62rem;
            }
            .col-gold .runner-name {
                font-size: 0.68rem;
            }
            .runner-bib {
                font-size: 0.52rem;
                letter-spacing: 0.05em;
            }

            /* Checkpoint tag */
            .checkpoint-tag {
                font-size: 0.5rem;
                padding: 3px 5px;
                max-width: 72px;
            }
            .checkpoint-tag strong {
                font-size: 0.52rem;
            }

            /* Rank label inside bar */
            .rank-label {
                font-size: 1rem;
            }
            .col-gold .rank-label {
                font-size: 1.15rem;
            }
            .laurel {
                font-size: 0.7rem;
            }
            .col-gold .laurel {
                font-size: 0.85rem;
            }

            /* Podium floor spacing */
            .podium-floor {
                margin-bottom: 28px;
            }

            /* List rows — tighter padding, smaller text */
            .list-row {
                grid-template-columns: 36px 1fr auto;
                gap: 10px;
                padding: 10px 12px;
                border-radius: 10px;
            }
            .rank-badge {
                width: 36px; height: 36px;
                border-radius: 9px;
                font-size: 1rem;
            }
            .row-name {
                font-size: 0.75rem;
            }
            .row-bib {
                font-size: 0.58rem;
                letter-spacing: 0.04em;
            }
            .row-cp-name {
                font-size: 0.65rem;
            }
            .row-cp-time {
                font-size: 0.55rem;
            }

            /* Toast */
            .change-toast {
                font-size: 0.68rem;
                padding: 8px 14px;
                border-radius: 10px;
                max-width: 88vw;
                white-space: normal;
                text-align: center;
            }
            .toast-icon {
                font-size: 0.85rem;
            }

            /* Footer */
            .footer {
                padding: 16px 0 20px;
                gap: 7px;
            }
            .footer-text {
                font-size: 0.52rem;
            }
            .internix-wordmark {
                font-size: 0.78rem;
            }
            .internix-icon {
                width: 16px; height: 16px;
            }

            /* List section bottom padding */
            .list-section {
                padding-bottom: 20px;
            }
            .list-rows {
                gap: 6px;
            }
        }

        /* ── TABLET (481px – 640px) — slight scale-down ── */
        @media (min-width: 481px) and (max-width: 640px) {
            body {
                padding: 20px 16px 0;
            }
            .logo {
                font-size: 2.2rem;
            }
            .podium-stage {
                height: auto;
                gap: 8px;
            }
            .col-gold   .bar-wrap { height: 160px; }
            .col-silver .bar-wrap { height: 118px; }
            .col-bronze .bar-wrap { height: 88px; }
            .avatar {
                width: 44px; height: 44px;
                font-size: 1.1rem;
            }
            .col-gold .avatar {
                width: 52px; height: 52px;
                font-size: 1.3rem;
            }
            .runner-name     { font-size: 0.72rem; }
            .col-gold .runner-name { font-size: 0.8rem; }
            .runner-bib      { font-size: 0.58rem; }
            .checkpoint-tag  { font-size: 0.54rem; max-width: 80px; }
            .list-row        { padding: 12px 14px; gap: 12px; }
            .rank-badge      { width: 40px; height: 40px; font-size: 1.1rem; }
            .row-name        { font-size: 0.82rem; }
            .row-bib         { font-size: 0.64rem; }
            .row-cp-name     { font-size: 0.7rem; }
            .row-cp-time     { font-size: 0.6rem; }
        }
    </style>
</head>
<body>

    <!-- MARATHON ATMOSPHERE PARTICLES -->
    <div class="marathon-particles" id="marathonParticles"></div>

    <!-- CHANGE TOAST -->
    <div class="change-toast" id="changeToast">
        <span class="toast-icon" id="toastIcon"></span>
        <span id="toastMsg"></span>
    </div>

    <!-- HEADER -->
    <div class="header">
        <div>
            <div class="logo">
                <span class="dagan">DAGAN</span><span class="num">360</span>
            </div>
            <div class="logo-sub">Live Marathon Standings</div>
        </div>
        <div class="live-pill">
            <span class="live-dot"></span> Live
        </div>
    </div>

    <!-- PODIUM TOP 3 -->
    <div class="podium-section">
        <div class="section-divider">
            <span class="section-label">Current Leaders</span>
        </div>
        <div class="podium-stage" id="podium">
            <!-- Populated by JS -->
        </div>
        <div class="podium-floor"></div>
    </div>

    <!-- RANKS 4–10 -->
    <div class="list-section">
        <div class="section-divider" style="margin-bottom:18px;">
            <span class="section-label">Rising Competitors</span>
        </div>
        <div class="list-rows" id="others-list">
            <!-- Populated by JS -->
        </div>
    </div>

    <!-- FOOTER -->
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
    /* ── MARATHON PARTICLES (sweat drops / dust motes) ── */
    (function() {
        const container = document.getElementById('marathonParticles');
        const COLORS = [
            'rgba(245,200,66,0.55)',
            'rgba(185,28,53,0.5)',
            'rgba(200,214,224,0.45)',
            'rgba(255,255,255,0.3)',
        ];
        for (let i = 0; i < 22; i++) {
            const el = document.createElement('div');
            el.className = 'particle';
            const size = 2 + Math.random() * 5;
            el.style.cssText = `
                width:${size}px; height:${size}px;
                left:${Math.random() * 100}%;
                background:${COLORS[Math.floor(Math.random() * COLORS.length)]};
                animation-duration:${6 + Math.random() * 10}s;
                animation-delay:${Math.random() * 10}s;
            `;
            container.appendChild(el);
        }
    })();
    </script>

    <script>
    const MEDALS     = ['🥇', '🥈', '🥉'];
    const RANK_ORDER = [2, 1, 3]; // 2nd left, 1st center, 3rd right

    // ── State tracking for change detection ──
    let prevTop3   = [];   // array of {bib_number, checkpoint_name, recorded_at} indexed by rank (0=1st)
    let prevOthers = [];   // array of {bib_number, rank} for 4th–10th
    let isFirstRender = true;
    let toastTimer = null;

    function initials(name) {
        if (!name) return '?';
        return name.trim().split(/\s+/).map(w => w[0]).join('').substring(0, 2).toUpperCase();
    }

    function formatTime(recorded_at) {
        if (!recorded_at) return '';
        const d = new Date(recorded_at);
        return d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    }

    // ── Toast ──
    function showToast(icon, msg, type) {
        const toast = document.getElementById('changeToast');
        document.getElementById('toastIcon').textContent = icon;
        document.getElementById('toastMsg').textContent  = msg;
        toast.className = `change-toast toast-${type}`;
        // force reflow so transition fires
        toast.offsetHeight;
        toast.classList.add('visible');
        if (toastTimer) clearTimeout(toastTimer);
        toastTimer = setTimeout(() => {
            toast.classList.add('hiding');
            setTimeout(() => { toast.className = 'change-toast'; }, 400);
        }, 3200);
    }

    // Apply a CSS animation class, then remove it so it can re-trigger later
    function flashEl(el, cls) {
        if (!el) return;
        el.classList.remove(cls);
        el.offsetHeight; // reflow
        el.classList.add(cls);
        el.addEventListener('animationend', () => el.classList.remove(cls), { once: true });
    }

    // ── Sound Engine (MP3 Files) ──
    // Place your MP3 files in the same folder as this PHP file and update the paths below.
    const SOUNDS = {
        fanfare_1st:  '/sounds/top3.mp3',   // 🥇 Gold podium takeover / new entry
        fanfare_2nd:  '/sounds/top3.mp3',   // 🥈 Silver podium takeover / new entry
        fanfare_3rd:  '/sounds/top3.mp3',   // 🥉 Bronze podium takeover / new entry
        list_new:     '/sounds/fanfare.mp3',       // New runner joins the list
        list_rank_up: '/sounds/fanfare.mp3',  // Runner climbs in the list
        list_cp:      '/sounds/fanfare.mp3',        // Checkpoint update in the list
    };

    // Pre-load all audio objects so they're ready to fire instantly
    const _audioCache = {};
    Object.entries(SOUNDS).forEach(([key, src]) => {
        const audio = new Audio(src);
        audio.preload = 'auto';
        _audioCache[key] = audio;
    });

    function playSound(key) {
        try {
            const audio = _audioCache[key];
            if (!audio) return;
            audio.currentTime = 0;  // rewind so rapid re-triggers work
            audio.play().catch(() => {}); // silence autoplay-policy errors
        } catch (e) { /* audio blocked */ }
    }

    // Fanfare for top-3 podium events — uses rank-specific MP3
    function playPodiumFanfare(rank) {
        const keyMap = { 1: 'fanfare_1st', 2: 'fanfare_2nd', 3: 'fanfare_3rd' };
        playSound(keyMap[rank] || 'fanfare_3rd');
    }

    // Short stab sounds for ranks 4+ list events
    function playListBeep(type) {
        const keyMap = {
            'new':     'list_new',
            'rank-up': 'list_rank_up',
            'cp':      'list_cp',
        };
        playSound(keyMap[type] || 'list_cp');
    }

    // Unlock audio on first user interaction (browser autoplay policy)
    document.addEventListener('click', () => {
        Object.values(_audioCache).forEach(a => { a.play().then(() => a.pause()).catch(() => {}); });
    }, { once: true });

    // ── Podium render with change detection ──
    function renderPodium(top3) {
        const podium = document.getElementById('podium');

        // colMeta is indexed by SLOT position (0=left, 1=center, 2=right)
        // RANK_ORDER = [2, 1, 3] so: slot0=2nd(silver), slot1=1st(gold), slot2=3rd(bronze)
        const colMeta = [
            { cls: 'col-silver', rankLabel: '2nd' }, // slot 0 — left
            { cls: 'col-gold',   rankLabel: '1st' }, // slot 1 — center (tallest)
            { cls: 'col-bronze', rankLabel: '3rd' }, // slot 2 — right
        ];

        // slots[slotIdx] = the runner who belongs in that visual column
        // RANK_ORDER[slotIdx] tells us which actual rank (1/2/3) sits in that slot
        const slots = RANK_ORDER.map(rank => top3[rank - 1] || null);

        podium.innerHTML = slots.map((r, slotIdx) => {
            const actualRank = RANK_ORDER[slotIdx]; // 1, 2, or 3 — the TRUE race position
            const meta       = colMeta[slotIdx];    // visual style for this column

            if (!r) {
                return `
                    <div class="podium-col ${meta.cls}">
                        <div class="runner-info empty">
                            <div class="avatar">—</div>
                            <div class="runner-name">Empty</div>
                        </div>
                        <div class="bar-wrap">
                            <span class="rank-label">${meta.rankLabel}</span>
                        </div>
                    </div>`;
            }

            const cp    = r.checkpoint_name || r.location_name || 'Unknown';
            const time  = formatTime(r.recorded_at);
            const crown = actualRank === 1 ? '<span class="crown">👑</span>' : '';

            // prevTop3 is indexed by rank (0 = 1st place, 1 = 2nd, 2 = 3rd)
            const prev = prevTop3[actualRank - 1];
            let changeClass = '';
            if (!isFirstRender) {
                if (!prev) {
                    changeClass = 'anim-podium-takeover';
                    showToast('🚀', `${r.name} enters the podium at #${actualRank}!`, 'new');
                    playPodiumFanfare(actualRank);
                } else if (prev.bib_number !== r.bib_number) {
                    changeClass = 'anim-podium-takeover';
                    showToast('⚡', `${r.name} takes #${actualRank} spot!`, 'rank-up');
                    playPodiumFanfare(actualRank);
                } else if (prev.checkpoint_name !== cp || prev.recorded_at !== r.recorded_at) {
                    changeClass = 'anim-podium-cp';
                    showToast('📍', `${r.name} hits a new checkpoint!`, 'cp');
                    playPodiumFanfare(actualRank);
                }
            }

            return `
                <div class="podium-col ${meta.cls} ${changeClass}" data-bib="${r.bib_number}">
                    <div class="runner-info">
                        <div class="avatar-wrap">
                            ${crown}<div class="avatar">${initials(r.name)}</div>
                        </div>
                        <div class="runner-name">${r.name}</div>
                        <div class="runner-bib">BIB #${r.bib_number}</div>
                        <div class="checkpoint-tag">
                            <strong>${cp}</strong>
                            ${time}
                        </div>
                    </div>
                    <div class="bar-wrap">
                        <span class="laurel">🌿</span>
                        <span class="rank-label">${meta.rankLabel}</span>
                        <span class="laurel">🌿</span>
                    </div>
                </div>`;
        }).join('');

        // Save snapshot indexed by rank (index 0 = 1st place, 1 = 2nd, 2 = 3rd)
        prevTop3 = [0, 1, 2].map(rankIdx => {
            const r = top3[rankIdx];
            return r ? {
                bib_number:      r.bib_number,
                checkpoint_name: r.checkpoint_name || r.location_name || 'Unknown',
                recorded_at:     r.recorded_at
            } : null;
        });
    }

    // ── Others list render with DOM-diffing (smooth entry for new rows) ──
    function renderOthers(others) {
        const container = document.getElementById('others-list');
        if (!others || others.length === 0) {
            container.innerHTML = '';
            prevOthers = [];
            return;
        }

        // Build lookup of previous state: bib → {rank, checkpoint, recorded_at}
        const prevMap = {};
        prevOthers.forEach(p => { prevMap[p.bib_number] = p; });

        // Build set of previous bibs in top3 (for detecting promotion from others)
        const prevTop3Bibs = new Set(prevTop3.filter(Boolean).map(p => p.bib_number));

        // Index existing DOM rows by bib so we can reuse them
        const existingRows = {};
        container.querySelectorAll('.list-row[data-bib]').forEach(el => {
            existingRows[el.dataset.bib] = el;
        });

        // Build the desired row elements in order
        const newRowEls = others.map((r, i) => {
            const rank  = i + 4;
            const cp    = r.checkpoint_name || r.location_name || 'Unknown';
            const time  = formatTime(r.recorded_at);
            const prev  = prevMap[r.bib_number];
            const bib   = String(r.bib_number);

            let changeClass = '';
            if (!isFirstRender) {
                if (!prev && !prevTop3Bibs.has(r.bib_number)) {
                    changeClass = 'anim-new-entry';
                    showToast('🏃', `${r.name} joins the race at #${rank}!`, 'new');
                    playListBeep('new');
                } else if (prev && prev.rank > rank) {
                    changeClass = 'anim-rank-up';
                    showToast('⬆️', `${r.name} rises to #${rank}!`, 'rank-up');
                    playListBeep('rank-up');
                } else if (prev && prev.rank < rank) {
                    changeClass = 'anim-rank-down';
                } else if (prev && (prev.checkpoint !== cp || prev.recorded_at !== r.recorded_at)) {
                    changeClass = 'anim-cp-update';
                    playListBeep('cp');
                }
            }

            const innerHTML = `
                    <div class="rank-badge">#${rank}</div>
                    <div class="row-info">
                        <div class="row-name">${r.name}</div>
                        <div class="row-bib">BIB #${r.bib_number}</div>
                    </div>
                    <div class="row-cp">
                        <div class="row-cp-name">${cp}</div>
                        <div class="row-cp-time">${time}</div>
                    </div>`;

            let el = existingRows[bib];
            if (el) {
                el.innerHTML = innerHTML;
                if (changeClass) {
                    el.classList.remove(changeClass);
                    el.offsetHeight;
                    el.classList.add(changeClass);
                    el.addEventListener('animationend', () => el.classList.remove(changeClass), { once: true });
                }
            } else {
                el = document.createElement('div');
                el.className = 'list-row' + (changeClass ? ' ' + changeClass : '');
                el.dataset.bib = bib;
                el.innerHTML = innerHTML;
                if (changeClass) {
                    el.addEventListener('animationend', () => el.classList.remove(changeClass), { once: true });
                }
            }
            return el;
        });

        // Remove rows that no longer exist
        const newBibs = new Set(others.map(r => String(r.bib_number)));
        Object.keys(existingRows).forEach(bib => {
            if (!newBibs.has(bib)) existingRows[bib].remove();
        });

        // Re-order / append rows without touching ones already in the right place
        newRowEls.forEach((el, idx) => {
            const current = container.children[idx];
            if (current !== el) container.insertBefore(el, current || null);
        });

        // Save snapshot
        prevOthers = others.map((r, i) => ({
            bib_number:  r.bib_number,
            rank:        i + 4,
            checkpoint:  r.checkpoint_name || r.location_name || 'Unknown',
            recorded_at: r.recorded_at
        }));
    }

    // ── Main update loop ──
    async function updateLeaderboard() {
        try {
            const res  = await fetch('/home/getLiveUpdate');
            const data = await res.json();
            if (isFirstRender) document.body.classList.add('intro-active');
            renderPodium(data.top_three);
            renderOthers(data.others);
            if (isFirstRender) {
                isFirstRender = false;
                setTimeout(() => document.body.classList.remove('intro-active'), 1800);
            }
        } catch (e) {
            console.error('Leaderboard fetch failed:', e);
        }
    }

    renderPodium([]);
    renderOthers([]);
    setInterval(updateLeaderboard, 3000);
    updateLeaderboard();
    </script>
</body>
</html>