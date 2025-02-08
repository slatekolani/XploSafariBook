<div class="tab-pane fade show" id="nav-adventurePaymentTimeframe" role="tabpanel" aria-labelledby="nav-adventurePaymentTimeframe-tab">
    @forelse ($package_ranges as $package_range)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-primary fw-bold">{{ $package_range}}</h5>
                <p class="card-text">
                    <small class="text-muted">
                        The above refers to the duration from when the tour was posted until the date of the safari. It serves as a timeframe for you to prepare for the trip and complete your payment.
                    </small>
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{route('localTourPackage.adventurePaymentTimeFramePlan',$package_range)}}">
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
        <p class="text-center text-muted">No adventure payment timeframe available at the moment. Please check back later.</p>
    @endforelse
</div>
