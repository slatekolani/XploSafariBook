<div class="tab-pane fade" id="nav-advice" role="tabpanel" aria-labelledby="nav-advice-tab">
   
            @forelse($touristicAttractionVisitAdvices as $touristicAttractionVisitAdvice)
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-light d-flex align-items-center border-bottom-0 rounded-top">
                        <h5 class="mb-0 text-primary">&bullet; {{ $touristicAttractionVisitAdvice->advice_title }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-0">
                            <i class="fas fa-info-circle text-secondary me-1"></i>
                            {{ $touristicAttractionVisitAdvice->advice_description }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="alert alert-info text-center" role="alert">
                    No advice has been listed yet.
                </div>
            @endforelse
</div>
