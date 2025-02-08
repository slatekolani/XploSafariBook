<div class="tab-pane fade" id="nav-honeyPoints" role="tabpanel" aria-labelledby="nav-honeyPoints-tab">
    <div class="row" style="margin-top: 10px">
        <div class="card">
            <div class="card-body" style="background-color: rgba(255,255,255,0.85)">
                <div class="row">

                    @forelse($attractionHoneyPoints as $attractionHoneyPoint)
                        <div class="col-md-6">
                            <div class="row">
                                <div class="gallery-row">
                                    <div class="honey-point">
                                        <div class="honey-point-header">
                                            <a href="{{ asset('public/honeyPointImage/'. $attractionHoneyPoint->honey_point_image) }}" data-fancybox="gallery" data-caption="{{ $attractionHoneyPoint->honey_point_name }} - {{ $attractionHoneyPoint->honey_point_description }}">
                                                <img src="{{ asset('public/honeyPointImage/'. $attractionHoneyPoint->honey_point_image) }}" alt="{{ $attractionHoneyPoint->honey_point_name }}" class="honey-point-image">
                                            </a>
                                            <div class="honey-point-title">{{ $attractionHoneyPoint->honey_point_name }}</div>
                                        </div>
                                        <div class="honey-point-description">{{ $attractionHoneyPoint->honey_point_description }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>





                    @empty
                        <p>Whoops! No honey points were added for this attraction. We are working on getting it done! </p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>

