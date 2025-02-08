<div class="tab-pane fade" id="nav-gallery" role="tabpanel" aria-labelledby="nav-gallery-tab">
    <div class="row" style="margin-top: 30px">
        <div class="col-md-12">
            <div class="col-md-10" style="margin-top: 10px">
                <div class="col-md-12">
                    <div class="gallery-row">
                        @forelse(explode(',', $localTourPackage->touristicAttraction->attraction_image) as $image)
                            <div class="gallery-item">
                                <a data-fancybox="gallery" data-caption="{{$localTourPackage->safari_description}}" href="{{ asset('public/'.$image) }}">
                                    <img src="{{ asset('public/'.$image) }}" loading="lazy" alt="Gallery Image">
                                </a>
                            </div>
                        @empty
                            <p>No image found!</p>
                        @endforelse
                        @forelse($attractionHoneyPoints as $attractionHoneyPoint)
                            <a href="{{ asset('public/honeyPointImage/'. $attractionHoneyPoint->honey_point_image) }}" data-fancybox="gallery" data-caption="{{ $attractionHoneyPoint->honey_point_name }} - {{ $attractionHoneyPoint->honey_point_description }}">
                                <img src="{{ asset('public/honeyPointImage/'. $attractionHoneyPoint->honey_point_image) }}" alt="{{ $attractionHoneyPoint->honey_point_name }}" class="honey-point-image">
                            </a>
                            @empty
                            @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@push('after-scripts')
    <script>
        $(document).ready(function() {
            $("[data-fancybox]").fancybox();
        });
    </script>

@endpush
