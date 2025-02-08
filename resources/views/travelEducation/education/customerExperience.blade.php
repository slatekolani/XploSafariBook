<div class="tab-pane fade show" id="nav-customerExperiences" role="tabpanel" aria-labelledby="nav-customerExperiences-tab">
    @forelse ($customerExperiences as $customerExperience)
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-primary fw-bold">{{ $customerExperience->customer_satisfaction_name }}</h5>
            <p class="card-text">
                <small class="text-muted">
                    {{$customerExperience->customer_satisfaction_description}}
                </small>
            </p>
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{route('customerSatisfactionCategory.spotLocalSafaris',$customerExperience->uuid)}}">
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
    <p class="text-center text-muted">No customer experience available at the moment. Please check back later.</p>
@endforelse
</div>