<div class="tab-pane fade" id="nav-Culture" role="tabpanel" aria-labelledby="nav-Culture-tab">
    <div class="container-fluid culture-details">
        <!-- Header Section -->
        <div class="row mb-5">
            <div class="col-12">
                @if($tanzaniaRegionCultures->isNotEmpty())
                    @php
                        $firstCultureImage = explode(',', $tanzaniaRegionCultures[0]->culture_image)[0] ?? '';
                    @endphp
                    @if($firstCultureImage)
                        <div class="hero-image-container position-relative mb-4">
                            <img src="{{ asset('public/'.$firstCultureImage) }}" 
                                 class="img-fluid w-100 rounded shadow" 
                                 alt="Landing Image" 
                                 style="max-height: 400px; object-fit: cover;">
                            <h2 class="text-primary position-absolute bottom-0 start-0 bg-white bg-opacity-75 p-3 mb-0 rounded-top">
                                Cultures in {{$tanzaniaRegion->region_name}}
                            </h2>
                        </div>
                    @else
                        <h2 class="text-primary border-bottom pb-3">Cultures in {{$tanzaniaRegion->region_name}}</h2>
                    @endif
                @endif
            </div>
        </div>

        <!-- Culture Cards Section -->
        <div class="row">
            @forelse($tanzaniaRegionCultures as $tanzaniaRegionCulture)
                <div class="col-12 mb-5">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-primary py-3">
                            <h3 class="text-white mb-2">{{ $tanzaniaRegionCulture->culture_name }}</h3>
                            <p class="text-warning fst-italic mb-0">{{$tanzaniaRegionCulture->basic_information }}</p>
                        </div>
                        
                        <div class="card-body p-4">
                            <!-- Image Gallery -->
                            <div class="gallery-section mb-5">
                                <div class="row g-3">
                                    @forelse(explode(',', $tanzaniaRegionCulture->culture_image) as $image)
                                        <div class="col-md-3 col-sm-6">
                                            <a data-fancybox="gallery" href="{{ asset('public/'.$image) }}" 
                               class="gallery-item d-block">
                                                <img src="{{ asset('public/'.$image) }}" 
                                                     class="img-fluid rounded shadow-sm" 
                                                     loading="lazy" 
                                                     alt="Cultural Image">
                                            </a>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="alert alert-info">No images available</div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <!-- History Section -->
                            <div class="history-section mb-5">
                                <h4 class="text-primary border-bottom pb-2">History</h4>
                                <p class="mt-3">{{ $tanzaniaRegionCulture->culture_history }}</p>
                            </div>

                            <!-- Video Section -->
                            <div class="video-section mb-5">
                                <h4 class="text-primary border-bottom pb-2">Traditional Video</h4>
                                <div class="video-container mt-3">
                                    {!! $tanzaniaRegionCulture->cultural_video !!}
                                </div>
                            </div>

                            <!-- Characteristics Section -->
                            <div class="characteristics-section mb-5">
                                <h4 class="text-primary border-bottom pb-2">Characteristics</h4>
                                <div class="mt-3">
                                    @forelse($regionCultureCharacteristics as $characteristic)
                                        <div class="characteristic-item mb-3">
                                            <h2 class="fw-bold">{{ $characteristic->characteristic_title }}</h2>
                                            <p class="ms-3 mb-0">
                                                <i class="fas fa-chevron-right text-secondary me-2"></i>
                                                {{ $characteristic->characteristic_description }}
                                            </p>
                                        </div>
                                    @empty
                                        <div class="alert alert-info">
                                            Characteristics are being compiled by our team.
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Culture Details Section -->
                            <div class="details-section">
                                <h4 class="text-primary border-bottom pb-2">Culture Details</h4>
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th class="bg-light w-25">Traditional Language</th>
                                                <td><p>{{ $tanzaniaRegionCulture->traditional_language }}</p></td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light">Traditional Dance</th>
                                                <td><p>{{ $tanzaniaRegionCulture->traditional_dance }}</p></td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light">Dance Description</th>
                                                <td><p>{{ $tanzaniaRegionCulture->traditional_dance_description }}</p></td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light">Traditional Food</th>
                                                <td><p>{{ $tanzaniaRegionCulture->traditional_food_description }}</p></td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light">Food Description</th>
                                                <td><p>{{ $tanzaniaRegionCulture->traditional_food_description }}</p></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="characteristics-section mb-5">
                                <h4 class="text-primary border-bottom pb-2">Activities to do to appreciate the {{$tanzaniaRegionCulture->culture_name}} culture</h4>
                                <div class="mt-3">
                                    @forelse($cultureAppreciationActivities as $cultureAppreciationActivity)
                                        <div class="characteristic-item mb-3">
                                            <p class="ms-3 mb-0">
                                                <i class="fas fa-chevron-right text-secondary me-2"></i>
                                                {{ $cultureAppreciationActivity->appreciation_activity_detail }}
                                            </p>
                                        </div>
                                    @empty
                                        <div class="alert alert-info">
                                            Appreciation activity are being compiled by our team.
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <div class="characteristics-section mb-5">
                                <h4 class="text-primary border-bottom pb-2">Challenges facing {{$tanzaniaRegionCulture->culture_name}}</h4>
                                <div class="mt-3">
                                    @forelse($cultureChallenges as $cultureChallenge)
                                        <div class="characteristic-item mb-3">
                                            <p class="ms-3 mb-0">
                                                <i class="fas fa-chevron-right text-secondary me-2"></i>
                                                {{ $cultureChallenge->culture_challenges_detailed }}
                                            </p>
                                        </div>
                                    @empty
                                        <div class="alert alert-info">
                                            {{$tanzaniaRegionCulture->culture_name}} Challenges are being compiled by our team.
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <div class="history-section mb-5">
                                <h4 class="text-primary border-bottom pb-2">Summary</h4>
                                <p class="mt-3">{{ $tanzaniaRegionCulture->conclusion }}</p>
                            </div>


                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        Cultural information is currently being compiled by our team.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>