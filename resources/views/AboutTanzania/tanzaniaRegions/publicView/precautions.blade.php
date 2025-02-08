<div class="tab-pane fade " id="nav-precautions" role="tabpanel" aria-labelledby="nav-precautions-tab">

    <div class="row">
        <div class="col-md-12">
            @forelse($tanzaniaRegionPrecautions as $tanzaniaRegionPrecaution)
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-light d-flex align-items-center border-bottom-0 rounded-top">
                        <h5 class="mb-0 text-primary">&bullet; {{ $tanzaniaRegionPrecaution->precaution_title }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-0" style="font-size: 15px;">
                            {{ $tanzaniaRegionPrecaution->precaution_description }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="alert alert-info text-center" role="alert">
                    Whoops! We have yet to publish the precautions, or we might be experiencing an error. Please wait while our personnel is working on it.
                </div>
            @endforelse
        </div>
    </div>
    
</div>
