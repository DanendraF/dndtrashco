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

    <!-- Main Content -->
    <div class="main-container">
        <!-- Latest Post Section -->
        <div class="latest-post">
            <h2>Latest Post</h2>
            @foreach ([1, 2, 3] as $post)
                <div class="post-item">
                    <img src="{{ asset('assets/bgloginkanan.jpg') }}" alt="Post thumbnail">
                    <div class="post-info">
                        <h3>The 1975 - Madison Square Garden Concert so amazed</h3>
                        <span class="post-date">Sept 17, 2024</span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- News Section -->
        <div class="news-section">
            <img src="{{ asset('assets/bgloginkanan.jpg') }}" alt="Featured news" class="featured-image">
            <div class="news-date">
                <i class="bi bi-calendar3"></i>
                <span>Nov 19, 2005</span>
            </div>
            <h1 class="news-title">Do you think I have forgotten? About You</h1>
            <div class="news-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse tincidunt sagittis sagittis. Aliquam vel dolor rhoncus, consectetur vel velit, mollis nisi. Duis non mi condimentum dui finibus feugiat in eu velit. Ut et tellus at turpis volutpat ultricies. Proin in laoreet odio. Cras eu nibh lacus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae. Aliquam at amet lacus est.</p>
                <p>Nullam augue nisi, aliquam ullamcorper est vitae, rhoncus dignissim libero. Duis vel justo augue. Sed sed leo placerat, pellentesque nisi in, fermentum quam. In malesuada, pretium velit, ac sodales velit consectetur. Nullam a lacus ut erat suscipit imperdiet eget a nibh. Quisque nec orci elit. Donec ipsum massa, dignissim nec viverra vitae, varius a tellus. Donec cursus ornare nunc nec molestie.</p>
                <p>Nullam augue nisi, aliquam ullamcorper est vitae, rhoncus dignissim libero. Duis vel justo augue. Sed sed leo placerat, pellentesque nisi in, fermentum quam. In malesuada, pretium velit, ac sodales velit consectetur. Nullam a lacus ut erat suscipit imperdiet eget a nibh. Quisque nec orci elit. Donec ipsum massa, dignissim nec viverra vitae, varius a tellus. Donec cursus ornare nunc nec molestie.</p>
                <p>Etiam ullamcorper imperdiet massa, at ultrices mauris tincidunt ut. Sed dui neque, convallis vel nulla eleifend, lacinia pretium arcu. Praesent euismod, leo at lobortis porta, massa diam molestie ante, id elementum nulla libero vitae est. Pellentesque ultricies purus eget blandit lacinia, ac blandit sem viverra. Proin in ipsum ut tellus volutpat. Etiam et metus ut felis scelerisque aliquam. Duis sollicitudin, quam quis tincidunt tincidunt, nulla sem venenatis nibh, vitae pellentesque dolor in turpis.</p>
            </div>
        </div>
    </div>
</body>
</html>
