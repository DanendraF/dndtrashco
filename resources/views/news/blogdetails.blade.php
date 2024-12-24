<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrashCo - Blog</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/news/blogdetails.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <!-- Navbar -->
    @include('partials.navbar')

    <div class="main-container">
        <div class="latest-post">
            <h2>Latest Post</h2>
            @foreach ($latestposts as $beritaterbaru)
                <div class="post-item">
                    <img src="{{ $beritaterbaru->cover_image ? asset('storage/' . $beritaterbaru->cover_image) : asset('assets/bgloginkanan.jpg') }}" alt="Post thumbnail">
                    <div class="post-info">
                        <h3>{{ $beritaterbaru->title }}</h3>
                        <span class="post-date">{{ $beritaterbaru->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="news-section">
            <img src="{{ $blog->cover_image ? asset('storage/' . $blog->cover_image) : asset('assets/bgloginkanan.jpg') }}" alt="Featured news" class="featured-image">
            <div class="news-date">
                <i class="bi bi-calendar3"></i>
                <span>{{ $blog->created_at->format('M d, Y') }}</span>
            </div>

            <h1 class="news-title">{{ $blog->title }}</h1>
            <div class="news-content">
                <p>{{ $blog->content }}</p>
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
