@extends('layouts.app')

@section('title', 'TrashCo - Home')

@section('content')

    @include('partials.navbar')

    <div class="slider-container">
        <div class="slide active">
            <div class="slide-content">
                <p class="subtitle">clean environment healthy society</p>
                <h2>Welcome to Trash.co</h2>
                <p class="description">
                    The waste management website is a platform that aims to raise public awareness about
                    the importance of effective waste management. Here, users can find information about
                    types of waste, sorting techniques, and environmentally-friendly recycling practices. In
                    addition, the website provides a real-time tracking feature for waste collection vehicles
                    to ensure timely delivery. With an interactive and educational approach, the website
                    encourages active community participation in maintaining environmental cleanliness
                    and sustainability.
                </p>
                <button class="cta-button">STARTED NOW</button>
            </div>
        </div>

        <button class="slider-arrow prev">&#8592;</button>
        <button class="slider-arrow next">&#8594;</button>

        <div class="slider-dots">
            <span class="dot active"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </div>
</body>
@endsection
