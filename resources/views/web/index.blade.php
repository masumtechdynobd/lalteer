@extends('web.layouts.master')

@php
    $header = \App\Models\PageSetup::page('home');
@endphp
@if (isset($header))

    @section('title', $header->meta_title)

    @section('top_meta_tags')
        @if (isset($header->meta_description))
            <meta name="description" content="{!! str_limit(strip_tags($header->meta_description), 160, ' ...') !!}">
        @else
            <meta name="description" content="{!! str_limit(strip_tags($setting->description), 160, ' ...') !!}">
        @endif

        @if (isset($header->meta_keywords))
            <meta name="keywords" content="{!! strip_tags($header->meta_keywords) !!}">
        @else
            <meta name="keywords" content="{!! strip_tags($setting->keywords) !!}">
        @endif
    @endsection

@endif

@section('social_meta_tags')
    @if (isset($setting))
        <meta property="og:type" content="website">
        <meta property='og:site_name' content="{{ $setting->title }}" />
        <meta property='og:title' content="{{ $setting->title }}" />
        <meta property='og:description' content="{!! str_limit(strip_tags($setting->description), 160, ' ...') !!}" />
        <meta property='og:url' content="{{ route('home') }}" />
        <meta property='og:image' content="{{ asset('/uploads/setting/' . $setting->logo_path) }}" />


        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="{!! '@' . str_replace(' ', '', $setting->title) !!}" />
        <meta name="twitter:creator" content="@HiTechParks" />
        <meta name="twitter:url" content="{{ route('home') }}" />
        <meta name="twitter:title" content="{{ $setting->title }}" />
        <meta name="twitter:description" content="{!! str_limit(strip_tags($setting->description), 160, ' ...') !!}" />
        <meta name="twitter:image" content="{{ asset('/uploads/setting/' . $setting->logo_path) }}" />
    @endif
@endsection
@section('content')
    <div class="header-carousel owl-carousel">
        <div class="header-carousel-item position-relative">
            <!-- Video Section -->
            <video src="video/4225165-uhd_3840_2160_24fps.mp4" autoplay muted loop
                class="w-100 h-100 position-absolute top-0 start-0" style="object-fit: cover;">
            </video>

            <!-- Overlay Content -->
            @include('web.slider_video')
        </div>
    </div>
    <!-- CARESOUL ITEMS -->
    @include('web.slider')
    @include('web.about_company')
    @include('web.chairman_message')
    @include('web.our_crops')
    @include('web.catalogue')
    @include('web.newsletter')
    @include('web.map')
@endsection
