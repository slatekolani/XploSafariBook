<div class="tab-pane active" id="nav-allRegions" role="tabpanel" aria-labelledby="nav-allRegions-tab">
<div class="row">
    <div class="col-md-12">
        <div class="row">
            @forelse($regions as $region)
                <div class="col-md-4" style="margin-top: 15px">
                    <a href="{{route('tanzaniaRegion.publicView',$region->uuid)}}" style="text-decoration: none; position: relative; display: block;">
                        <div class="card h-100 border-primary card-with-gradient">
                            <div id="AttractionsIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @forelse(explode(',', $region->region_icon_image) as $index => $image)
                                        <li data-target="#AttractionsIndicators" data-slide-to="{{ $index }}" @if($index === 0) class="active" @endif></li>
                                    @empty
                                        <p>No image found!</p>
                                    @endforelse
                                </ol>
                                <div class="carousel-inner">
                                    @forelse(explode(',', $region->region_icon_image) as $index => $image)
                                        <div class="carousel-item @if($index === 0) active @endif">
                                            <img src="{{ asset('public/'.$image) }}" style="height: 200px;width: 100%; filter: contrast(120%);" loading="lazy">
                                        </div>
                                    @empty
                                        <p>No image found!</p>
                                    @endforelse
                                </div>
                            </div>

                            <div class="card-img-overlay">
                                <p class="card-text card-text-white" style="font-size: 1.5rem; font-weight: bold; position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem;">
                                    {{$region->region_name}}<br>
                                    <span style="font-family: 'Montserrat', sans-serif;font-weight: normal;font-size: 1rem">{{$region->region_description}}</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <p>Whoops! No Region has been published yet. Our personnel are working on it</P>
            @endforelse
        </div>
        @if(!empty($regions) && $regions->count())
        <div class="row">
            <div class="col-md-12">
                <div class="text-center mt-3">
                    <a href="#" class="btn btn-primary btn-sm">
                        Discover More of Tanzania <span class="ml-1">&blacktriangledown;</span>
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
</div>
