<div class="row">
    <div class="col-md-12">
        <h3>Tangible touristic games</h3>
        <div class="row">
            @forelse($touristicGames as $touristicGame)
                <div class="col-md-4" style="margin-top: 15px">
                    <a href="{{route('touristicGame.publicView',$touristicGame->uuid)}}" style="text-decoration: none; position: relative; display: block;">
                        <div class="card h-100 border-primary card-with-gradient">
                            <div id="GameIndicator" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @forelse(explode(',', $touristicGame->game_images) as $index => $image)
                                        <li data-target="#GameIndicator" data-slide-to="{{ $index }}" @if($index === 0) class="active" @endif></li>
                                    @empty
                                        <p>No image found!</p>
                                    @endforelse
                                </ol>
                                <div class="carousel-inner">
                                    @forelse(explode(',', $touristicGame->game_images) as $index => $image)
                                        <div class="carousel-item @if($index === 0) active @endif">
                                            <img src="{{ asset('public/'.$image) }}" style="width: 100%; height: 350px; object-fit: cover; filter: contrast(120%);" loading="lazy">
                                        </div>
                                    @empty
                                        <p>No image found!</p>
                                    @endforelse
                                </div>
                            </div>

                            <div class="card-img-overlay">
                                <p class="card-text card-text-white" style="font-size: 1.5rem; font-weight: bold; position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem;">
                                    {{$touristicGame->game_name}}<br>
                                    <span style="font-family: 'Montserrat', sans-serif;font-weight: normal;font-size: 1rem">{{$touristicGame->game_category}}</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <p>Whoops! No Game has been published yet. Our personnel are working on it</P>
            @endforelse
        </div>
        @if(!empty($touristicGames) && $touristicGames->count())
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-right mt-3">
                            <a href="{{ route('touristicGame.allTouristicGames') }}" class="btn btn-primary btn-sm">
                                See More <span class="ml-1">&#9654;</span>
                            </a>
                        </div>
                    </div>
                </div>
        @endif
    </div>
</div>