@extends('layouts.main', ['title' => __('label.home'), 'header' => __('label.home')])

@push('after-styles')
    {{ Html::style(url('vendor/select2/css/select2.min.css')) }}

    <style>
        .section-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .section-content {
            font-size: 1.1rem;
            color: #555;
            line-height: 1.8;
        }

        .info-card {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .info-card img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .info-card p {
            margin: 0;
            font-size: 1rem;
            color: #555;
        }

        .info-card b {
            font-weight: bold;
        }

        /* Hero Section */
        #background-container {
            position: relative;
            height: 100vh;
            background-position: center;
            background-size: cover;
            transition: background 1s ease-in-out;
        }

        .hero-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-align: center;
        }

        .hero-text h1 {
            font-size: 3rem;
            font-weight: bold;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
        }

        .hero-text p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.7);
        }


        @media (max-width: 767px) {
            .hero-text h1 {
                font-size: 2rem;
            }

            .hero-text p {
                font-size: 1rem;
            }

            .hero-btn {
                font-size: 1rem;
                padding: 8px 20px;
            }
        }
    </style>
@endpush

@section('content')
    @guest
        <div class="card">
            <div class="card-body">

                <div class="text-center mb-4">
                    <h3 style="color: gray; font-size: 30px;">
                        {{ $nation->nation_name }} ~
                        <span style="font-size: 25px; color: dodgerblue;">{{ $nation->nation_description }}</span>
                    </h3>
                    <p style="color: gray;font-size:1rem">
                        Welcome to Tanzania, where a diverse array of captivating attractions awaits. From the iconic Serengeti
                        with its Great Migration to the enchanting Zanzibar Archipelago, our country offers an unforgettable
                        blend of wildlife, landscapes, and cultural heritage. Join us for an experience that leaves a lasting
                        impression on your heart.
                    </p>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card info-card">
                            <div class="card-body d-flex align-items-center">
                                <img src="{{ url('/public/HomeImages/Calender icon.jpeg') }}" alt="Calendar Icon">
                                <p>
                                    <b>Best Time To Come</b><br>
                                    June to October (Migration from June to July and January to February)
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card info-card">
                            <div class="card-body d-flex align-items-center">
                                <img src="{{ url('/public/HomeImages/Clock icon.jpeg') }}" alt="Clock Icon">
                                <p>
                                    <b>High Season</b><br>
                                    July to March (Northern circuit parks get crowded)
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card info-card">
                            <div class="card-body d-flex align-items-center">
                                <img src="{{ url('/public/HomeImages/Tanzania map.jpeg') }}" alt="Tanzania Map"
                                    style="width: 70px; height: 70px;">
                                <p>
                                    <a href="{{ route('Tanzania.show', $nation->uuid) }}">
                                        Wanna know more about Tanzania? &blacktriangleright;&blacktriangleright;
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                @include('homeIncludes.touristicAttractionCategories')
                @include('homeIncludes.events')
                @include('homeIncludes.travelGroups')
                @include('homeIncludes.touristicActivities')
                @include('homeIncludes.touristicAttractions')
                @include('homeIncludes.regions')
                @include('homeIncludes.cultures')
                @include('homeIncludes.localSafaris')
                @include('homeIncludes.localSafarisReservations')
            </div>
        </div>
    @endguest
    @auth
        @if (Auth::user()->role == 3)
            <div class="card">
                <div class="card-body">

                    <div class="text-center mb-4">
                        <h3 style="color: gray; font-size: 30px;">
                            {{ $nation->nation_name }} ~
                            <span style="font-size: 25px; color: dodgerblue;">{{ $nation->nation_description }}</span>
                        </h3>
                        <p style="color: gray;font-size:1rem">
                            Welcome to Tanzania, where a diverse array of captivating attractions awaits. From the iconic
                            Serengeti
                            with its Great Migration to the enchanting Zanzibar Archipelago, our country offers an unforgettable
                            blend of wildlife, landscapes, and cultural heritage. Join us for an experience that leaves a
                            lasting
                            impression on your heart.
                        </p>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card info-card">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ url('/public/HomeImages/Calender icon.jpeg') }}" alt="Calendar Icon">
                                    <p>
                                        <b>Best Time To Come</b><br>
                                        June to October (Migration from June to July and January to February)
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card info-card">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ url('/public/HomeImages/Clock icon.jpeg') }}" alt="Clock Icon">
                                    <p>
                                        <b>High Season</b><br>
                                        July to March (Northern circuit parks get crowded)
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card info-card">
                                <div class="card-body d-flex align-items-center">
                                    <img src="{{ url('/public/HomeImages/Tanzania map.jpeg') }}" alt="Tanzania Map"
                                        style="width: 70px; height: 70px;">
                                    <p>
                                        <a href="{{ route('Tanzania.show', $nation->uuid) }}">
                                            Wanna know more about Tanzania? &blacktriangleright;&blacktriangleright;
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                    @include('homeIncludes.events')
                    @include('homeIncludes.travelGroups')
                    @include('homeIncludes.touristicAttractions')
                    @include('homeIncludes.regions')
                    @include('homeIncludes.cultures')
                    @include('homeIncludes.localSafaris')
                    @include('homeIncludes.localSafarisReservations')
                </div>
            </div>
        @endif

    @endauth

    @auth
        @if (Auth::user()->role == 2)
            @include('TourOperator.overviewDashboard.view')
        @elseif(Auth::user()->role == 3)
            @include('Tourist.overviewDashboard.view')
        @endif
    @endauth
@endsection

@push('scripts')
    <script>
        function navigationScrollHandler() {
            return {
                isScrollingUp: false,
                lastScrollTop: 0,
                init() {
                    window.addEventListener('scroll', () => {
                        let currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;
                        this.isScrollingUp = currentScrollTop < this.lastScrollTop;
                        this.lastScrollTop = currentScrollTop;
                    });
                }
            }
        }
    </script>
@endpush
