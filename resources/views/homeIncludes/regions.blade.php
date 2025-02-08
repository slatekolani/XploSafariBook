<div class="container-fluid regions-section">
    <div class="row">
        <div class="col-md-12">
            <div class="section-header mb-4">
                <h3 class="section-title">Regions in Tanzania</h3>
                <p class="section-subtitle">Discover the regions and marvel at their beauty</p>
            </div>
            <div class="row">
                @forelse($regions as $region)
                <div class="col-md-4" style="margin-top: 15px">
                    <a href="{{route('tanzaniaRegion.publicView',$region->uuid)}}" style="text-decoration: none; position: relative; display: block;">
                        <div class="card h-100 border-primary card-with-gradient">
                            <div id="AttractionsIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @forelse(explode(',', $region->region_icon_image) as $index => $image)
                                        <li data-target="#AttractionsIndicators" data-slide-to="{{ $index }}" @if($index === 0) class="active" @endif></li>
                                    @empty
                                        <p>No image found!</p>
                                    @endforelse
                                </ol>
                                <div class="carousel-inner">
                                    @forelse(explode(',', $region->region_icon_image) as $index => $image)
                                        <div class="carousel-item @if($index === 0) active @endif">
                                            <img src="{{ asset('public/'.$image) }}" style="width: 100%; height: 200px; object-fit: cover; filter: contrast(120%);" loading="lazy">
                                        </div>
                                    @empty
                                        <p>No image found!</p>
                                    @endforelse
                                </div>
                            </div>

                            <div class="card-img-overlay">
                                <p class="card-text card-text-white" style="font-size: 1.5rem; font-weight: bold; position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem;">
                                    {{$region->region_name}}<br>
                                    <span style="font-family: 'Montserrat', sans-serif;font-weight: normal;font-size: 1rem">{{$region->region_description}}</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                    <div class="no-regions-message">
                        <p>Whoops! No Region has been published yet. Our personnel are working on it.</p>
                    </div>
                @endforelse
            </div>
                
            <div class="discover-more-section">
                <a href="{{ route('Tanzania.show', $nation->uuid) }}" class="btn btn-explore-group">
                    Discover More Tanzania Regions
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.regions-section {
    background-color: #f8f9fa;
    padding: 3rem 0;
}

/* Reuse most styles from destinations section with region-specific modifications */
.regions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.region-card {
    perspective: 1000px;
}

.region-card-inner {
    transition: all 0.3s ease-in-out;
    border: none;
    border-radius: 12px;
    overflow: hidden;
    position: relative;
}

.region-card-inner:hover {
    transform: translateY(-10px) rotateX(5deg);
    box-shadow: 0 20px 30px rgba(0,0,0,0.1);
}

.region-image-container {
    position: relative;
    width: 100%;
    height: 300px;
    overflow: hidden;
}

.region-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.region-card-inner:hover .region-image {
    transform: scale(1.1);
}

.no-image-placeholder {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
    background-color: #e9ecef;
    color: #6c757d;
}

.region-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.7));
    padding: 1rem;
}

.region-content {
    color: white;
}

.region-title {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.region-description {
    font-size: 1rem;
    font-weight: normal;
    opacity: 0.9;
    color: white;
}

.no-regions-message {
    text-align: center;
    color: #6c757d;
    padding: 2rem;
    background-color: #f1f3f5;
    border-radius: 12px;
    grid-column: 1 / -1;
}

/* Reuse discover more button styles from destinations section */
.discover-more-section {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

.btn-explore-group {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background-color: #2ecc71;
    color: white;
    text-decoration: none;
    border-radius: 50px;
    transition: all 0.3s ease;
    font-weight: 600;
    box-shadow: 0 10px 20px rgba(46, 204, 113, 0.2);
}

.btn-explore-group:hover {
    background-color: #27ae60;
    transform: translateY(-5px);
    box-shadow: 0 15px 25px rgba(46, 204, 113, 0.3);
}

.btn-discover-more svg {
    transition: transform 0.3s ease;
}

.btn-discover-more:hover svg {
    transform: translateX(5px);
}

@media (max-width: 768px) {
    .regions-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 480px) {
    .regions-grid {
        grid-template-columns: 1fr;
    }
}
</style>