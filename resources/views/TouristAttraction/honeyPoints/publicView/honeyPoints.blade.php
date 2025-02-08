<div class="tab-pane fade show" id="nav-honeyPoints" role="tabpanel" aria-labelledby="nav-honeyPoints-tab">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h3 class="text-primary">Honey Points</h3>
                <p class="text-muted">Explore unique highlights of this <span style="color: dodgerblue">{{$touristicAttraction->attraction_name}}</span>.</p>
            </div>
        </div>
        
        <div class="row g-4">
            @forelse($touristicAttractionHoneyPoints as $touristicAttractionHoneyPoint)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <a href="{{ asset('public/honeyPointImage/' . $touristicAttractionHoneyPoint->honey_point_image) }}" 
                           data-fancybox="gallery" 
                           data-caption="{{ $touristicAttractionHoneyPoint->honey_point_name }} - {{ $touristicAttractionHoneyPoint->honey_point_description }}">
                            <img src="{{ asset('public/honeyPointImage/' . $touristicAttractionHoneyPoint->honey_point_image) }}" 
                                 alt="{{ $touristicAttractionHoneyPoint->honey_point_name }}" 
                                 class="card-img-top rounded-top honey-point-image">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $touristicAttractionHoneyPoint->honey_point_name }}</h5>
                            <p class="card-text text-muted">{{ $touristicAttractionHoneyPoint->honey_point_description }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">No Honey points have been listed yet.</p>
                </div>
            @endforelse
        </div>
    </div>
    
    
</div>
