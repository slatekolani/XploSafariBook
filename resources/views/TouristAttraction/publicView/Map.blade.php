<div class="tab-pane fade" id="nav-Map" role="tabpanel" aria-labelledby="nav-Map-tab">
    <div class="card-body">
        <div class="row mb-4 justify-content-center">
                @if($touristicAttraction->attraction_map)
                    <div class="featured-image-wrapper text-center">
                        <img src="{{ asset('public/attractionMaps/'.$touristicAttraction->attraction_map) }}" 
                             class="img-fluid rounded shadow-lg" 
                             alt="{{ $touristicAttraction->attraction_name }} Featured Image" 
                             style="max-height: 1000px; object-fit: cover; width: 100%;">
                    </div>
                @else
                    <p class="alert alert-info">No featured map available for this attraction</p>
                @endif
        </div>
    </div>
</div>