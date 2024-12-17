@extends('layouts.app')

@section('title', 'TrashCo - TPS')

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/tps/tps.css') }}">
@endpush

@section('content')
    @include('partials.navbar') <!-- Memanggil navbar -->

    <div class="slider-container">
        <div class="slide active">
            <div class="slide-content">
                <p class="subtitle">clean environment healthy society</p>
                <h2>Welcome to TPS</h2>
                <p class="description">
                    The waste collection vehicle tracking feature aims to improve efficiency and
                    transparency in waste management. From temporary disposal sites to final
                    disposal sites, this system provides real-time location updates. Through mobile
                    based application, this system allows real-time monitoring of the location and
                    route taken by waste collection vehicles.
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

        <div class="wave-bottom"></div>
    </div>
@endsection
