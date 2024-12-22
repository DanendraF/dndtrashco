<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Nearest TPS - TrashCo</title>
   <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('css/tps/tpssection.css') }}">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
   @include('partials.navbar')

   <div class="bg-decoration"></div>
   <div class="bg-decoration-2"></div>

   <div class="container">
       <h2>Nearest TPS</h2>
       <p>Clean trash, peaceful life, maintain cleanliness by throwing trash in its place.</p>

       <!-- Card Container -->
    <div class="card-container">
        @foreach($tpsList as $tps)
        <div class="card" onclick="location.href='{{ route('tps.tpsdetails', $tps->slug) }}'">
            <img src="{{ asset('storage/' . $tps->image) }}" alt="{{ $tps->name }}">
            <h3>{{ $tps->name }}</h3>
            <p>{{ $tps->location }}</p>
            <div class="rating">
                @for($i = 0; $i < 5; $i++)
                    @if($i < floor(4.5))
                        <i class="fas fa-star"></i>
                    @else
                        <i class="far fa-star"></i>
                    @endif
                @endfor
            </div>
        </div>
        @endforeach
    </div>

   </div>
</body>
</html>
