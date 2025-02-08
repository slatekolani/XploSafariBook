<div class="tab-pane fade" id="nav-attractionRules" role="tabpanel" aria-labelledby="nav-attractionRules-tab">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="col-md-10 offset-md-1 mt-3">
                @forelse($touristicAttractionRules as $touristicAttractionRule)
                    <div class="card mb-4 shadow-sm border-0">
                        <div class="card-header bg-light d-flex align-items-center border-bottom-0 rounded-top">
                            <i class="fas fa-gavel text-danger me-2" style="font-size: 1.5rem;"></i>
                            <h5 class="mb-0 text-primary">{{ $touristicAttractionRule->rule_title }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-0">
                                <i class="fas fa-chevron-right text-secondary me-1"></i>
                                {{ $touristicAttractionRule->rule_description }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info text-center" role="alert">
                        No rules have been listed yet.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
