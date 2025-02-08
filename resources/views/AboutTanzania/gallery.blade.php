    <div class="row" style="margin-top: 30px">
                <div class="col-md-12">
                    <div class="gallery-row">
                        @forelse($regions as $region)
                            @forelse(explode(',', $region->region_icon_image) as $index => $image)
                                <div class="col-md-4">
                                    <div class="gallery-item">
                                        <a data-fancybox="gallery" data-caption="{{$region->region_name}}, {{ $region->region_description }}" href="{{ asset('public/'.$image) }}">
                                            <img src="{{ asset('public/'.$image) }}" loading="lazy" alt="Gallery Image">
                                            <div class="card-img-overlay">
                                                <p class="card-text card-text-white" style="font-size: 1.5rem; font-weight: bold; position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem;">
                                                    {{$region->region_name}}<br>
                                                    <span style="font-family: 'Montserrat', sans-serif;font-weight: normal;font-size: 1rem">{{$region->region_description}}</span>
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            @empty
                                <p>No image found!</p>
                            @endforelse
                            @empty
                        @endforelse

                        @forelse($cultures as $culture)
                            @forelse(explode(',', $culture->culture_image) as $index => $image)
                                <div class="col-md-4">
                                    <div class="gallery-item">
                                        <a data-fancybox="gallery" data-caption="{{$culture->culture_name}}, {{$culture->basic_information}}" href="{{ asset('public/'.$image) }}">
                                            <img src="{{ asset('public/'.$image) }}" loading="lazy" alt="Gallery Image">
                                            <div class="card-img-overlay">
                                                <p class="card-text card-text-white" style="font-size: 1.5rem; font-weight: bold; position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem;">
                                                    {{$culture->culture_name}}<br>
                                                    <span style="font-family: 'Montserrat', sans-serif;font-weight: normal;font-size: 1rem">{{$culture->basic_information}}</span>
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <p>No image found!</p>
                            @endforelse
                        @empty
                        @endforelse
                            @forelse($touristicAttractions as $touristicAttraction)
                            @forelse(explode(',', $touristicAttraction->attraction_image) as $index => $image)
                                <div class="col-md-4">
                                    <div class="gallery-item">
                                        <a data-fancybox="gallery" data-caption="{{$touristicAttraction->attraction_name}}, {{$touristicAttraction->attraction_description}}" href="{{ asset('public/'.$image) }}">
                                            <img src="{{ asset('public/'.$image) }}" loading="lazy" alt="Gallery Image">
                                            <div class="card-img-overlay">
                                                <p class="card-text card-text-white" style="font-size: 1.5rem; font-weight: bold; position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem;">
                                                    {{$touristicAttraction->attraction_name}}<br>
                                                    <span style="font-family: 'Montserrat', sans-serif;font-weight: normal;font-size: 1rem">{{$touristicAttraction->attraction_description}}</span>
                                                </p>
                                            </div>
                                        </a>
                                    </div>
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

@push('after-scripts')
    <script>
        $(document).ready(function () {
            $("[data-fancybox]").fancybox();
        });
    </script>

@endpush
