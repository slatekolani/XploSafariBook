@extends('layouts.main', [
    'title' => __("Touristic game - " . $touristicGame->game_name),
    'header' => __('Touristic game - ' . $touristicGame->game_name)
])

@include('includes.validate_assets')

@section('content')
    <div class="col-md-12">
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="background-color: rgba(255,255,255,0.85)">
                        <h2>
                            Exploration enthusiasts, Play {{$touristicGame->game_name}} today.
                        </h2>
                        <div class="row">
                                @forelse(explode(',', $touristicGame->game_images) as $image)
                                    <div class="col-md-6 mb-3">
                                        <div class="zoom-effect">
                                            <img src="{{ asset('public/'.$image) }}" class="zoom-img" loading="lazy" style="width: 100%; height: auto;">
                                        </div>
                                    </div>
                                @empty
                                    <p>No image found!</p>
                                @endforelse

                            <div class="col-md-6">
                                {{-- Game Details --}}
                                <div class="card h-100 border-primary card-with-gradient">
                                    <h3 style="font-weight: bold; margin-left: 20px; margin-top: 5px" class="card-title">
                                        &star;{{$touristicGame->game_name}}
                                    </h3>
                                    <span style="margin-left: 20px; color: black; margin-top: 5px">
                                        Category : {{$touristicGame->game_category}}
                                    </span>
                                    <span style="margin-left: 20px; color: black; margin-top: 5px">
                                        Theme : {{$touristicGame->game_theme}}
                                    </span>
                                    <span style="margin-left: 20px; color: black; margin-top: 5px">
                                        Age group : {{$touristicGame->age}}
                                    </span>
                                    <span style="margin-left: 20px; color: black; margin-top: 5px">
                                        Total gamers : {{$touristicGame->total_players}} players
                                    </span>
                                    <span style="margin-left: 20px; color: black; margin-top: 5px">
                                        Game Price : T Shs {{number_format($touristicGame->game_price)}}
                                    </span>

                                    {{-- Mode of Play and Development Inspiration --}}
                                    <div class="row">
                                        <div class="col-md-12" style="margin-left: 10px; margin-top: 10px">
                                            <h4 style="font-weight: bold; margin-left: 20px; margin-top: 5px"
                                                class="card-title">&star;Mode of play</h4>
                                            <span style="margin-left: 20px; color: black; margin-top: 10px">
                                                {{$touristicGame->mode_of_play}}
                                             </span>

                                            <h3 style="font-weight: bold; margin-left: 20px; margin-top: 25px"
                                                class="card-title">&star;Inspiration of development</h3>
                                            <span style="margin-left: 20px; color: black;">
                                                {{$touristicGame->development_inspiration}}
                                             </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12" style="margin-left: 10px; margin-top: 10px">
                                            <h3 style="font-weight: bold; margin-left: 20px; margin-top: 5px" class="card-title">&star;Game components</h3>
                                            <ul>
                                                @forelse($touristicGameComponents as $touristicGameComponent)
                                                    <li style="margin-left: 20px; color: dodgerblue; margin-top: 5px">{{$touristicGameComponent->game_component}} - {{$touristicGameComponent->component_description}}</li>
                                                @empty
                                                    <!-- If there are no game components -->
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>

                                    {{-- Action Buttons --}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="text-center mt-3">
                                                <a href="{{$touristicGame->tutorial_directory_link}}" class="btn btn-primary btn-sm">
                                                    Learn how to play <span class="ml-1">&blacktriangleright;</span>
                                                </a>

                                                <a href="{{$touristicGame->tutorial_directory_link}}" class="btn btn-primary btn-sm">
                                                    Place your Order <span class="ml-1">&blacktriangleright;</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        $(document).ready(function () {
            $(".zoom-effect").on("mousemove", function (event) {
                var image = $(this).find(".zoom-img");
                var offsetX = event.pageX - $(this).offset().left;
                var offsetY = event.pageY - $(this).offset().top;
                var centerX = $(this).width() / 2;
                var centerY = $(this).height() / 2;
                var moveX = (offsetX - centerX) / centerX * 10;
                var moveY = (offsetY - centerY) / centerY * 10;

                image.css({
                    "transform-origin": offsetX + "px " + offsetY + "px",
                    "transform": "scale(3) translate(" + moveX + "px, " + moveY + "px)"
                });
            });

            $(".zoom-effect").on("mouseleave", function () {
                var image = $(this).find(".zoom-img");
                image.css({
                    "transform-origin": "center",
                    "transform": "scale(1) translate(0, 0)"
                });
            });
        });
    </script>
@endpush
