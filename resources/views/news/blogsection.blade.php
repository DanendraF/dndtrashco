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
                @foreach($blogs as $blog)
                <div class="blog-card">
                    <img src="{{ $blog->cover_image ? asset('storage/' . $blog->cover_image) : asset('') }}" alt="Blog Image">
                    <div class="card-content">
                        <div class="date">{{ $blog->created_at->format('F d, Y') }}</div>
                        <h3>{{$blog->title}}</h3>
                        <a href="{{ route('news.blogdetails', $blog->slug) }}" class="read-more">Read More</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
<script>
    function toggleMenu() {
        const navLinks = document.querySelector('.nav-links');
        navLinks.classList.toggle('show');
    }
</script>
</html>
