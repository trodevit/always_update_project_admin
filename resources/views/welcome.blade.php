<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Always Update</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        :root {
            --brand: #2d6cdf;
            --brand-600: #1f56c1;
            --accent: #6dd5ed; /* used in gradient */
            --bg: #f7f8fb;
            --card: #ffffff;
            --text: #1f2937;
            --muted: #6b7280;
            --ring: rgba(45,108,223,.35);
            --radius: 14px;
            --shadow: 0 10px 25px rgba(0,0,0,.08);
        }

        /* Dark mode (respects system setting) */
        @media (prefers-color-scheme: dark) {
            :root {
                --bg: #0b1220;
                --card: #111827;
                --text: #e5e7eb;
                --muted: #9ca3af;
                --shadow: 0 10px 25px rgba(0,0,0,.35);
            }
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            font-family: "Poppins", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
            display: flex;
            min-height: 100svh;
            flex-direction: column;
        }

        /* Header / hero */
        header {
            position: relative;
            overflow: clip;
            isolation: isolate; /* ensure z-index stacking */
            background: radial-gradient(1200px 600px at 10% -10%, rgba(109,213,237,.25), transparent 60%),
            radial-gradient(1200px 600px at 90% -10%, rgba(45,108,223,.35), transparent 60%),
            linear-gradient(120deg, var(--brand) 0%, var(--brand-600) 50%, #203b88 100%);
            color: #fff;
        }

        .hero {
            max-width: 1200px;
            margin-inline: auto;
            padding: clamp(24px, 4vw, 40px) 20px 72px;
            text-align: center;
        }

        .admin-login {
            position: absolute;
            inset: 20px 20px auto auto;
            z-index: 2;
        }
        .admin-login a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #fff;
            background: rgba(255, 255, 255, 0.16);
            padding: 9px 14px;
            border-radius: 999px;
            text-decoration: none;
            font-size: .9rem;
            backdrop-filter: blur(6px);
            transition: transform .18s ease, background .18s ease;
            outline: none;
        }
        .admin-login a:focus-visible { box-shadow: 0 0 0 3px white, 0 0 0 6px rgba(255,255,255,.35); }
        .admin-login a:hover { transform: translateY(-1px); background: rgba(255,255,255,.25); }

        h1.hero-title {
            font-size: clamp(2rem, 5vw, 3rem);
            letter-spacing: -.02em;
            margin: 18px 0 8px;
        }
        p.hero-subtitle {
            font-size: clamp(1rem, 2.5vw, 1.25rem);
            opacity: .95;
            max-width: 55ch;
            margin-inline: auto;
        }

        /* Store badges */
        .download-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
            justify-content: center;
            margin-top: 22px;
        }
        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 56px;
            padding: 0 6px;
            border-radius: 12px;
            background: rgba(255,255,255,.08);
            box-shadow: inset 0 0 0 1px rgba(255,255,255,.15);
            transition: transform .15s ease, box-shadow .2s ease, background .2s ease;
            outline: none;
        }
        .badge:hover { transform: translateY(-2px); background: rgba(255,255,255,.14); }
        .badge:focus-visible { box-shadow: 0 0 0 3px white, 0 0 0 6px var(--ring); }
        .badge img { height: 44px; display: block; }

        /* Decorative wave */
        .wave {
            position: absolute;
            inset: auto 0 -1px 0;
            width: 100%;
            height: 80px;
            color: var(--bg);
        }

        /* Main */
        main { flex: 1; }

        .container {
            max-width: 1200px;
            margin-inline: auto;
            padding: 28px 20px 64px;
        }

        .section-head {
            display: grid;
            gap: 8px;
            place-items: center;
            text-align: center;
            margin-top: -24px;
            margin-bottom: 8px;
        }
        .section-head h2 {
            font-size: clamp(1.125rem, 2.5vw, 1.5rem);
            color: var(--muted);
            font-weight: 600;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: clamp(14px, 2vw, 20px);
            margin-top: 10px;
        }

        .card {
            grid-column: span 12;
            background: linear-gradient(180deg, var(--card), var(--card)) padding-box,
            radial-gradient(120% 120% at 0% 0%, rgba(45,108,223,.25), transparent 65%) border-box;
            border: 1px solid rgba(45,108,223,.15);
            border-radius: var(--radius);
            padding: clamp(16px, 2.3vw, 22px);
            box-shadow: var(--shadow);
            transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
            position: relative;
            overflow: hidden;
        }
        .card::after {
            content: "";
            position: absolute;
            inset: -40% auto auto -40%;
            width: 80%;
            aspect-ratio: 1 / 1;
            background: radial-gradient(closest-side, rgba(45,108,223,.08), transparent 70%);
            transform: rotate(15deg);
            pointer-events: none;
        }
        .card:hover { transform: translateY(-4px); box-shadow: 0 18px 38px rgba(0,0,0,.12); }

        .card h3 { color: var(--brand); margin: 0 0 8px; font-size: clamp(1.05rem, 2.2vw, 1.25rem); }
        .card p { color: var(--muted); margin: 0; font-size: clamp(.95rem, 2vw, 1rem); }

        /* Responsive columns */
        @media (min-width: 520px) {
            .card { grid-column: span 6; }
        }
        @media (min-width: 900px) {
            .card { grid-column: span 3; }
        }

        /* Motion-reduced users */
        @media (prefers-reduced-motion: reduce) {
            * { transition: none !important; animation: none !important; }
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 22px 16px 32px;
            color: var(--muted);
            font-size: .95rem;
        }

        /* Utility */
        .visually-hidden { position: absolute !important; width:1px; height:1px; padding:0; margin:-1px; overflow:hidden; clip:rect(0,0,0,0); white-space:nowrap; border:0; }
    </style>
</head>
<body>
<header>
    <div class="admin-login">
        <a href="{{route('loginPage')}}" aria-label="Admin login">Login</a>
    </div>
    <div class="hero">
        <h1 class="hero-title">Always Update</h1>
        <p class="hero-subtitle">Get the latest suggestions, scholarships, results, and notices — all in one place.</p>
        <div class="download-buttons" aria-label="Download app">
            <a class="badge" href="#" target="_blank" rel="noopener">
                <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Get it on Google Play">
            </a>
            <!--
            <a class="badge" href="#" target="_blank" rel="noopener">
              <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg" alt="Download on the App Store">
            </a>
            -->
        </div>
    </div>

    <!-- Decorative wave -->
    <svg class="wave" viewBox="0 0 1440 100" preserveAspectRatio="none" aria-hidden="true">
        <path d="M0,64L60,69.3C120,75,240,85,360,85.3C480,85,600,75,720,58.7C840,43,960,21,1080,21.3C1200,21,1320,43,1380,53.3L1440,64V100H0Z" fill="currentColor"></path>
    </svg>
</header>

<main>
    <div class="container">
        <div class="section-head">
            <h2>Everything you need, beautifully organized</h2>
            <span class="visually-hidden">Feature list</span>
        </div>

        <section class="cards" aria-label="Feature cards">
            <article class="card">
                <h3>Suggestion</h3>
                <p>Updated exam suggestions tailored to your class level — SSC, HSC, and more.</p>
            </article>
            <article class="card">
                <h3>Scholarship</h3>
                <p>Never miss an opportunity. Discover national and private scholarships fast.</p>
            </article>
            <article class="card">
                <h3>Result</h3>
                <p>Track results and get notified the moment they’re released.</p>
            </article>
            <article class="card">
                <h3>Notice</h3>
                <p>Stay informed about admissions, exam dates, and institutional updates.</p>
            </article>
        </section>
    </div>
</main>

<footer>
    &copy; <span id="year"></span> Always Update. All rights reserved.
</footer>

<script>
    const startYear = 2025;
    const currentYear = new Date().getFullYear();
    document.getElementById('year').textContent =
        startYear === currentYear ? startYear : `${startYear} - ${currentYear}`;
</script>

</body>
</html>
