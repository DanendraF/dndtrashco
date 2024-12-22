@extends('layouts.app')

@section('title', 'TrashCo - Market')

@section('content')
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Market Content -->
    <div class="slider-container">
        <div class="slide active">
            <div class="slide-content">
                <p class="subtitle">clean environment healthy society</p>
                <h2>Welcome to Market</h2>
                <p class="description">
                    Welcome to TrashCo Market, your sustainable trading hub! Here,
                    we facilitate the exchange of recyclable materials, connecting
                    waste collectors with recycling industries while promoting circular
                    economy principles through our innovative marketplace platform.
                </p>
                <button class="cta-button" onclick="window.location.href='/marketsection'">STARTED NOW</button>
            </div>
        </div>

        <!-- Slider Arrows -->
        <button class="slider-arrow prev">&#8592;</button>
        <button class="slider-arrow next">&#8594;</button>

        <!-- Slider Dots -->
        <div class="slider-dots">
            <span class="dot active"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </div>
@endsection
