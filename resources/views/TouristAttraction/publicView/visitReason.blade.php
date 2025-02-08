<div class="tab-pane fade" id="nav-visitReason" role="tabpanel" aria-labelledby="nav-visitReason-tab">
    @forelse($touristicAttractionVisitReasons as $touristicAttractionVisitReason)
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-light d-flex align-items-center border-bottom-0 rounded-top">
                <h5 class="mb-0 text-primary">&bullet;{{ $touristicAttractionVisitReason->reason_title }}</h5>
            </div>
            <div class="card-body">
                <p class="text-muted mb-0">
                    <i class="fas fa-angle-right text-secondary me-1"></i>
                    {{ $touristicAttractionVisitReason->reason_description }}
                </p>
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center" role="alert">
            No reasons have been listed yet.
        </div>
    @endforelse
</div>
