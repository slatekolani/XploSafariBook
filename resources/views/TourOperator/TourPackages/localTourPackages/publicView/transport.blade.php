<div class="tab-pane fade" id="nav-Transport" role="tabpanel" aria-labelledby="nav-Transport-tab">
    <div class="row" style="margin-top: 30px">
        <div class="col-md-12">
            <div class="col-md-10" style="margin-top: 10px">
                <div class="col-md-12">
                    <div class="gallery-row">
                        @forelse(explode(',', $localTourPackage->transport_used_images) as $image)
                            <div class="gallery-item">
                                <a data-fancybox="gallery" data-caption="{{$localTourPackage->safari_description}}" href="{{ asset('public/'.$image) }}">
                                    <img src="{{ asset('public/'.$image) }}" loading="lazy" alt="Gallery Image">
                                </a>
                            </div>
                        @empty
                            <p>No image found!</p>
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
