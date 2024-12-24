<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrashCo - TPS Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/tps/tpsdetails.css') }}">
</head>
<body>
    @include('partials.navbar') <!-- Include Navbar -->
    <div class="main-container">
        <div class="tps-details">
            <h1>{{ $tps->name }}</h1>
            <img src="{{ asset('storage/' . $tps->image) }}" alt="{{ $tps->name }}" class="featured-image">
            <div class="tps-info">
                <p><strong>Location:</strong> {{ $tps->location }}</p>
                <p><strong>Open Time:</strong> {{ \Carbon\Carbon::parse($tps->open_time)->format('H:i') }}</p>
                <p><strong>Close Time:</strong> {{ \Carbon\Carbon::parse($tps->close_time)->format('H:i') }}</p>
                <p><strong>Rating:</strong> {{ $tps->rating }}</p>
            </div>
            <div class="tps-description">
                <p>{{ $tps->description }}</p>
            </div>
            <button></button>
        </div>
        <div class="map-container">
            <h2>Location Map</h2>
            <iframe src="{{ $tps->link_maps }}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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
