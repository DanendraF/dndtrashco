<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrashCo - Market</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/market/marketsection.css') }}">
</head>

<body class="market-page">
    @include('partials.navbar')

    <div class="bg-decoration"></div>
    <div class="bg-decoration-2"></div>

    <div class="market-container">
        <div class="market-header">
            <h1>Market</h1>
            <p>Buy goods here, even though they are second-hand, they are still of good quality!</p>
        </div>

        <div class="market-content">
            <div class="market-grid">
                @foreach($marketItems as $item)
                <div class="market-card">
                    <!-- Displaying the first image in the array, or fallback to a default image -->
                    <img src="{{ !empty($item->images[0]) ? asset('storage/' . $item->images[0]) : asset('images/default-product.jpg') }}" alt="{{ $item->item_name }}">
                    <div class="card-content">
                        <h3>IDR {{ number_format($item->price, 0, ',', '.') }}</h3>
                        <p>{{ $item->item_name }}</p>
                        <p>{{ $item->address }}</p>
                        <p>📍 {{ $item->status == 'available' ? 'Available' : 'Sold' }}</p>
                        <a href="{{ route('shop.marketdetails', $item->slug) }}" class="view-details">View Details</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
