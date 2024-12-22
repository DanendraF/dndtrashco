<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TrashCo - Market Details</title>
   <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('css/market/marketdetails.css') }}">
</head>
<body>
   <!-- Navbar -->
    @include('partials.navbar')

   <!-- Main Content -->
   <div class="main-container">
       <div class="product-details">
           <!-- Main Image -->
           <div class="main-image">
               <img src="{{ asset('storage/' . json_decode($marketItem->images)[0]) }}" alt="{{ $marketItem->item_name }}" class="main-image-container">
           </div>

           <!-- Gallery Section -->
           <div class="image-gallery">
               <h3>Image Gallery</h3>
               <div class="gallery-container">
                   @foreach(json_decode($marketItem->images) as $image)
                       <img src="{{ asset('storage/' . $image) }}" alt="Product Image" class="gallery-image">
                   @endforeach
               </div>
           </div>

           <!-- Product Info -->
           <h2>{{ $marketItem->item_name }}</h2>
           <p class="condition">{{ $marketItem->status }}</p>
           <p class="price">IDR {{ number_format($marketItem->price, 0, ',', '.') }}</p>
           <p class="description">{{ $marketItem->description }}</p>
           <button class="contact-seller">Contact Seller</button>
       </div>


        <div class="recommendation-section">
            <h2>Other Items</h2>
            <div class="card-container">
                @foreach($otherItems as $item)
                <div class="card">
                    <!-- Link ke halaman detail produk -->
                    <a href="{{ route('shop.marketdetails', $item->slug) }}" class="card-link">
                        <h3>{{ $item->item_name }}</h3>
                        <img src="{{ asset('storage/' . json_decode($item->images)[0]) }}" alt="{{ $item->item_name }}" class="card-image">
                        <div class="card-info">
                            <h4>IDR {{ number_format($item->price, 0, ',', '.') }}</h4>
                            <p>{{ $item->description }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

   </div>
</body>
</html>
