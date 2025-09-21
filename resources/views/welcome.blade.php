<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Always Update</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background-color: #2d6cdf;
            color: #fff;
            padding: 40px 20px;
            position: relative;
            text-align: center;
        }
        .admin-login {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .admin-login a {
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background 0.3s ease;
        }
        .admin-login a:hover {
            background: rgba(255, 255, 255, 0.35);
        }
        header h1 {
            font-size: 2.5rem;
        }
        header p {
            font-size: 1.2rem;
            margin-top: 10px;
        }
        .download-buttons {
            margin-top: 20px;
        }
        .download-buttons a {
            display: inline-block;
            background-color: transparent;
            color: #2d6cdf;
            padding: 10px 20px;
            margin: 10px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s ease;
        }
        .download-buttons a:hover {
            background-color: #e5e5e5;
        }
        .sections {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card h2 {
            color: #2d6cdf;
            margin-bottom: 10px;
        }
        .card p {
            font-size: 0.95rem;
            color: #555;
        }

        main{
            flex: 1;
        }
        footer {
            text-align: center;
            padding: 20px;
            background: #f1f1f1;
            font-size: 0.9rem;
            color: #777;
        }
        @media (max-width: 600px) {
            header h1 {
                font-size: 2rem;
            }
            .admin-login {
                position: static;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="admin-login">
        <a href="{{route('loginPage')}}">Login</a>
    </div>
    <h1>Always Update</h1>
    <p>Get the latest suggestions, scholarships, results, and notices — all in one place!</p>
    <div class="download-buttons">
        <a href="#" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Get it on Google Play" style="height: 60px;">
        </a>
{{--        <a href="#" target="_blank">--}}
{{--            <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg" alt="Download on the App Store" style="height: 60px;">--}}
{{--        </a>--}}
    </div>

</header>

<main>
    <section class="sections">
        <div class="card">
            <h2>Suggestion</h2>
            <p>Get updated exam suggestions based on your class level — SSC, HSC, and more.</p>
        </div>
        <div class="card">
            <h2>Scholarship</h2>
            <p>Never miss an opportunity! Find national and private scholarships quickly.</p>
        </div>
        <div class="card">
            <h2>Result</h2>
            <p>Track your academic results and get notified the moment they're released.</p>
        </div>
        <div class="card">
            <h2>Notice</h2>
            <p>Stay informed about admission news, exam dates, and institutional updates.</p>
        </div>
    </section>
</main>
<footer>
    &copy; 2025{{ date('Y') != 2025 ? ' - ' . date('Y') : '' }} Always Update. All rights reserved.
</footer>

</body>
</html>
