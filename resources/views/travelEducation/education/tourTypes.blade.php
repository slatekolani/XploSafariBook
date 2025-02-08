<div class="tab-pane fade show" id="nav-tourTypes" role="tabpanel" aria-labelledby="nav-tourTypes-tab">
    @forelse ($tourTypes as $tourType)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-primary fw-bold">{{ $tourType->tour_type_name }}</h5>
                <p class="card-text">
                    <small class="text-muted">
                        Explore the unique experiences offered by this type of tour. 
                        Click below to discover more safaris and share this experience with others.
                    </small>
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{route('tourType.spotLocalSafaris',$tourType->uuid)}}">
                        <button class="btn btn-outline-primary btn-sm">
                            Explore Local Safaris Offering This Service
                        </button>
                    </a>
                    
                    <button class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                        <i class="bi bi-share me-1"></i> Share
                    </button>
                </div>
            </div>
        </div>
    @empty
        <p class="text-center text-muted">No tour types available at the moment. Please check back later.</p>
    @endforelse
</div>
