<div class="tab-pane fade show" id="nav-travelInsurances" role="tabpanel" aria-labelledby="nav-travelInsurances-tab">
    @forelse ($travelInsurances as $travelInsurance)
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-primary fw-bold">{{ $travelInsurance->tour_insurance_name }}</h5>
            <p class="card-text">
                <small class="text-muted">
                    {{$travelInsurance->tour_insurance_description}}
                </small>
            </p>
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{route('tourInsuranceType.spotTourOperator',$travelInsurance->uuid)}}">
                    <button class="btn btn-outline-primary btn-sm">
                        Explore Tour Operators Offering This Service
                    </button>
                </a>
                <button class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                    <i class="bi bi-share me-1"></i> Share
                </button>
            </div>
        </div>
    </div>
@empty
    <p class="text-center text-muted">No travel Insurances available at the moment. Please check back later.</p>
@endforelse
</div>