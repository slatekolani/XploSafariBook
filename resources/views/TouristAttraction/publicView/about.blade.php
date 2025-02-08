<div class="tab-pane fade show active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
    <div class="container-fluid attraction-details">
        <div class="card shadow-lg mb-4">
            <!-- Header Section -->
            <div class="card-header bg-primary text-white py-3">
                <h2 class="mb-2 fs-3">{{ $touristicAttraction->attraction_name }}</h2>
                <p class="text-warning fst-italic mb-0 fs-6">{{ $touristicAttraction->attraction_description }}</p>
            </div>
            
            <!-- Featured Image Section -->
            <div class="card-body p-4">
                <div class="row mb-4">
                    <div class="col-12">
                        @php
                            $images = explode(',', $touristicAttraction->attraction_image);
                            $featuredImage = $images[0] ?? null;
                        @endphp
                        @if($featuredImage)
                            <div class="featured-image-wrapper">
                                <img src="{{ asset('public/'.$featuredImage) }}" 
                                     class="img-fluid rounded shadow-lg w-100" 
                                     alt="{{ $touristicAttraction->attraction_name }} Featured Image" 
                                     style="max-height: 400px; object-fit: cover;">
                            </div>
                        @else
                            <div class="alert alert-info fs-6">No featured image available for this attraction</div>
                        @endif
                    </div>
                </div>

                <!-- Information Cards -->
                <div class="information-section mb-4">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h4 class="text-primary border-bottom pb-2 fs-4">Basic Information</h4>
                                    <p class="mt-3 fs-6">{{ $touristicAttraction->basic_information }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h4 class="text-primary border-bottom pb-2 fs-4">Seasonal Variation</h4>
                                    <p class="mt-3 fs-6">{{ $touristicAttraction->seasonal_variation }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h4 class="text-primary border-bottom pb-2 fs-4">Flora & Fauna</h4>
                                    <p class="mt-3 fs-6">{{ $touristicAttraction->flora_fauna }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Gallery -->
                <div class="gallery-section mb-4">
                    <h4 class="text-primary border-bottom pb-2 fs-4 mb-3">Image Gallery</h4>
                    <div class="row g-3">
                        @forelse($images as $image)
                            <div class="col-md-6 col-sm-6">
                                <a href="{{ asset('public/'.$image) }}" 
                                   data-fancybox="gallery" 
                                   data-caption="{{ $touristicAttraction->attraction_name }}"
                                   class="d-block">
                                    <img src="{{ asset('public/'.$image) }}" 
                                         class="img-fluid rounded shadow-sm w-100" 
                                         loading="lazy" 
                                         alt="{{ $touristicAttraction->attraction_name }} Gallery Image"
                                         style="height: 300px; object-fit: cover;">
                                </a>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info fs-6">No images available for this attraction</div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Details Table -->
                <div class="details-section mb-4">
                    <h4 class="text-primary border-bottom pb-2 fs-4 mb-3">Attraction Details</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody class="fs-6">
                                <tr>
                                    <th class="bg-light w-25">Attraction Category</th>
                                    <td><p>{{ $touristicAttraction->touristicAttractionCategory->attraction_category }}</p></td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Region</th>
                                    <td>
                                        <a href="{{ route('tanzaniaRegion.publicView', $touristicAttraction->tanzaniaRegion->uuid) }}" 
                                           class="text-primary text-decoration-none">
                                            {{ $touristicAttraction->tanzaniaRegion->region_name }} &#8594;
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Governing Body</th>
                                    <td>
                                        <a href="{{ $touristicAttraction->website_link }}" 
                                           target="_blank" 
                                           class="text-primary text-decoration-none">
                                            {{ $touristicAttraction->governing_body }} &#8594;
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Year</th>
                                    <td><p>Established in {{ $year }}</p></td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Best Visit Month</th>
                                    <td><p>{{ $touristicAttraction->attraction_visit_month }}</p></td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Entry Fee (Foreign Adult)</th>
                                    <td><p>Tshs {{ number_format($touristicAttraction->entry_fee_adult_foreigner) }}</p></td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Entry Fee (Foreign Child)</th>
                                    <td><p>Tshs {{ number_format($touristicAttraction->entry_fee_child_foreigner) }}</p></td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Entry Fee (Local Adult)</th>
                                    <td><p>Tshs {{ number_format($touristicAttraction->entry_fee_adult_local) }}</p></td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Entry Fee (Local Child)</th>
                                    <td><p>Less than Tshs {{ number_format($touristicAttraction->entry_fee_child_local) }}</p></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Personal Experience -->
                <div class="experience-section">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h4 class="text-primary border-bottom pb-2 fs-4">Personal Experience</h4>
                            <p class="mt-3 fs-6">{{ $touristicAttraction->personal_experience }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>