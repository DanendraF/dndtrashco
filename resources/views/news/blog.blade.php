<!-- resources/views/blog.blade.php -->
@extends('layouts.app')

@section('title', 'TrashCo - Blog')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/news/blog.css') }}">
@endpush

@section('content')

    @include('partials.navbar')

    <div class="slider-container">
        <div class="slide active">
            <div class="slide-content">
                <p class="subtitle">clean environment healthy society</p>
                <h2>Welcome to Blog</h2>
                <p class="description">
                    Welcome to our blog, where information and inspiration meet! Here,
                    you will find interesting articles covering current topics, practical tips,
                    and in-depth insights into waste management, green technology, and
                    innovation in public services.
                </p>
                <button class="cta-button" onclick="window.location.href='/blogsection'">STARTED NOW</button>

            </div>
        </div>
    </div>
@endsection
