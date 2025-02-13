@extends('layouts.main', [
    'title' => __('Category - ' . $touristicAttractionCategory->attraction_category),
    'header' => __('Category - ' . $touristicAttractionCategory->attraction_category),
])

@include('includes.validate_assets')

@section('content')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-body bg-white bg-opacity-85">
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card-header bg-primary text-white py-3">
                                    <h2 class="mb-2 fs-3">
                                        {{ $touristicAttractionCategory->attraction_category }}
                                    </h2>
                                    <p class="text-warning fst-italic mb-0 fs-6">
                                        "{{ $touristicAttractionCategory->attraction_category_description }}"
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card shadow-sm p-3">
                                    <img src="{{ asset('public/TouristicAttractionCategoryIconicImages/' . $touristicAttractionCategory->attraction_category_iconic_image) }}"
                                        alt="{{ $touristicAttractionCategory->attraction_category }}"
                                        class="card-img-top group-travel-image" loading="lazy">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card shadow-sm p-3">
                                    <h4 class="mb-2 text-primary" style="font-size: 20px">
                                        {{ $touristicAttractionCategory->attraction_category }} Overview</h4>
                                    <p class="text-muted">{{ $touristicAttractionCategory->attraction_category_description }}</p>
                                    <span>{{ $touristicAttractionCategory->attraction_category_basic_information }}</span>
                                </div>
                            </div>
                        </div>


                        @include('homeIncludes.touristicAttractions')

                        {{-- Local tour packages section --}}
                        @include('homeIncludes.localSafaris')

                        {{-- Tour Operators section --}}
                        @include('homeIncludes.tourOperators')
                    </div>
                </div>
            </div>
        </div>

        <style>
            .destinations-section {
                background-color: #f8f9fa;
                padding: 3rem 0;
            }

            .section-header {
                text-align: center;
                margin-bottom: 2rem;
            }

            .section-title {
                font-weight: 700;
                color: #2c3e50;
                font-size: 2.5rem;
                margin-bottom: 0.5rem;
            }

            .section-subtitle {
                color: #7f8c8d;
                font-size: 1.1rem;
            }

            .destinations-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
                gap: 1.5rem;
                margin-bottom: 2rem;
            }

            .destination-card {
                perspective: 1000px;
            }

            .destination-card-inner {
                transition: all 0.3s ease-in-out;
                border: none;
                border-radius: 12px;
                overflow: hidden;
                position: relative;
            }

            .destination-card-inner:hover {
                transform: translateY(-10px) rotateX(5deg);
                box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
            }

            .destination-carousel {
                position: relative;
            }

            .destination-image {
                width: 100%;
                height: 300px;
                object-fit: cover;
                transition: transform 0.3s ease;
            }

            .destination-card-inner:hover .destination-image {
                transform: scale(1.1);
            }

            .carousel-indicators li {
                background-color: rgba(255, 255, 255, 0.5);
                width: 10px;
                height: 10px;
                border-radius: 50%;
            }

            .carousel-indicators .active {
                background-color: white;
            }

            .carousel-control-prev,
            .carousel-control-next {
                width: 5%;
                opacity: 0.7;
                transition: opacity 0.3s ease;
            }

            .carousel-control-prev:hover,
            .carousel-control-next:hover {
                opacity: 1;
            }

            .destination-overlay {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.7));
                padding: 1rem;
            }

            .destination-content {
                color: white;
            }

            .destination-title {
                font-size: 1.5rem;
                font-weight: bold;
                margin-bottom: 0.5rem;
            }

            .destination-description {
                font-size: 1rem;
                font-weight: normal;
                opacity: 0.9;
            }

            .no-destinations-message {
                text-align: center;
                color: #6c757d;
                padding: 2rem;
                background-color: #f1f3f5;
                border-radius: 12px;
                grid-column: 1 / -1;
            }

            .discover-more-section {
                display: flex;
                justify-content: center;
                margin-top: 2rem;
            }

            .btn-discover-more {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.75rem 1.5rem;
                background-color: #3498db;
                color: white;
                text-decoration: none;
                border-radius: 50px;
                transition: all 0.3s ease;
                font-weight: 600;
                box-shadow: 0 10px 20px rgba(41, 128, 185, 0.2);
            }

            .btn-discover-more:hover {
                background-color: #3498db;
                transform: translateY(-5px);
                box-shadow: 0 15px 25px rgba(41, 128, 185, 0.3);
            }

            .btn-discover-more svg {
                transition: transform 0.3s ease;
            }

            .btn-discover-more:hover svg {
                transform: translateX(5px);
            }

            .localSafari-section {
        background-color: #f8f9f0;
        padding: 3rem 0;
    }

    .section-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .section-title {
        font-weight: 700;
        color: #2c3e50;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }

    .section-subtitle {
        color: #7f8c8d;
        font-size: 1.1rem;
    }

    .btn-explore-group {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background-color: #2ecc71;
        color: white;
        text-decoration: none;
        border-radius: 50px;
        transition: all 0.3s ease;
        font-weight: 600;
        box-shadow: 0 10px 20px rgba(46, 204, 113, 0.2);
    }

    .btn-explore-group:hover {
        background-color: #27ae60;
        transform: translateY(-5px);
        box-shadow: 0 15px 25px rgba(46, 204, 113, 0.3);
    }

            @media (max-width: 768px) {
                .destinations-grid {
                    grid-template-columns: 1fr 1fr;
                }
            }

            @media (max-width: 480px) {
                .destinations-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    @endsection
