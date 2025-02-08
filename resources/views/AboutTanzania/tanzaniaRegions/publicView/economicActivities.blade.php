<div class="tab-pane fade" id="nav-economicActivities" role="tabpanel" aria-labelledby="nav-economicActivities-tab">
    <div class="row">
        <div class="col-md-12">
            <h4>
                Dominant Economic Activity: <span style="color: dodgerblue;">{{ $tanzaniaRegion->regionEconomicActivity->economic_activity_title }}</span>
            </h4>
            <span style="cursor: pointer;color:dodgerblue" data-toggle="collapse" data-target="#economicActivities" aria-expanded="false" aria-controls="economicActivities">
                Other activities around &blacktriangledown;
            </span>
            <div class="row collapse" id="economicActivities">
                @foreach ($tanzaniaRegion->RegionEconomicActivitiesLabel as $economicActivity)
                    <div class="col-md-12 mb-3">
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-light d-flex align-items-center border-bottom-0 rounded-top">
                                <h5 class="mb-0 text-primary">&star; {{ $economicActivity['title'] }}</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted" style="font-size: 15px;">{{ $economicActivity['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
</div>
