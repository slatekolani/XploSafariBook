<div class="tab-pane fade" id="nav-Gallery" role="tabpanel" aria-labelledby="nav-Gallery-tab">
    <div class="row" style="margin-top: 30px">
            <div class="col-md-10" style="margin-top: 10px">
                <div class="col-md-12">
                    <div class="gallery-row">
                        @forelse(explode(',', $touristicAttraction->attraction_image) as $image)
                                <div class="gallery-item">
                                    <a data-fancybox="gallery" href="{{ asset('public/'.$image) }}">
                                        <img src="{{ asset('public/'.$image) }}" loading="lazy" alt="Gallery Image">
                                    </a>
                            </div>
                        @empty
                            <p>No image found!</p>
                        @endforelse
                            @forelse($touristicAttractionHoneyPoints as $touristicAttractionHoneyPoint)
                                @forelse(explode(',', $touristicAttractionHoneyPoint->honey_point_image) as $image)
                                    <div class="gallery-item">
                                        <a data-fancybox="gallery" href="{{ asset('public/honeyPointImage/'.$image) }}">
                                            <img src="{{ asset('public/honeyPointImage/'.$image) }}" loading="lazy" alt="Gallery Image">
                                        </a>
                                    </div>
                                @empty
                                    <p>No image found!</p>
                                @endforelse
                            @empty
                            @endforelse
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
