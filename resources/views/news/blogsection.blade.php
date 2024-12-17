<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrashCo - Blog</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/news/blogsection.css') }}">
</head>

<body class="blog-page">
    <!-- Navbar -->
    @include('partials.navbar')

    <div class="bg-decoration"></div>
    <div class="bg-decoration-2"></div>

    <div class="blog-container">
        <div class="blog-header">
            <h1>Today News</h1>
            <p>Read the news every day so you don't miss the latest news about garbage</p>
        </div>

        <div class="blog-content">
            <div class="blog-grid">
                <div class="blog-card">
                    <img src="{{ asset('assets/bghome.jpg') }}" alt="Blog Image">
                    <div class="card-content">
                        <div class="date">May 19, 2005</div>
                        <h3>Do you think I have forgotten? About You</h3>
                        <a href="#" class="read-more">Read More</a>
                    </div>
                </div>
                <div class="blog-card">
                    <img src="{{ asset('assets/bghome.jpg') }}" alt="Blog Image">
                    <div class="card-content">
                        <div class="date">May 19, 2005</div>
                        <h3>Do you think I have forgotten? About You</h3>
                        <a href="#" class="read-more">Read More</a>
                    </div>
                </div>
                <div class="blog-card">
                    <img src="{{ asset('assets/bghome.jpg') }}" alt="Blog Image">
                    <div class="card-content">
                        <div class="date">May 19, 2005</div>
                        <h3>Do you think I have forgotten? About You</h3>
                        <a href="#" class="read-more">Read More</a>
                    </div>
                </div>
                <div class="blog-card">
                    <img src="{{ asset('assets/bghome.jpg') }}" alt="Blog Image">
                    <div class="card-content">
                        <div class="date">May 19, 2005</div>
                        <h3>Do you think I have forgotten? About You</h3>
                        <a href="#" class="read-more">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
