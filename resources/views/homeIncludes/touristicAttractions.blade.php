<div class="container-fluid destinations-section">
    <div class="row">
        <div class="col-md-12">
            <div class="section-header mb-4">
                <h3 class="section-title">Top Destinations in Tanzania</h3>
                <p class="section-subtitle">Discover Tanzania, embrace wonder</p>
            </div>
            <div class="row">
                @forelse($touristicAttractions as $touristicAttraction)
                <div class="col-md-4" style="margin-top: 15px">
                    <a href="{{ route('touristicAttraction.show', $touristicAttraction->uuid) }}" style="text-decoration: none; position: relative; display: block;">
                        <div class="card h-100 border-primary card-with-gradient">
                            @php
                                $images = explode(',', $touristicAttraction->attraction_image);
                            @endphp
                            <div id="AttractionsIndicators-{{ $touristicAttraction->uuid }}" class="carousel slide" data-ride="carousel">
                                {{-- Unique carousel indicators with dynamic ID --}}
                                <ol class="carousel-indicators">
                                    @forelse($images as $index => $image)
                                        <li data-target="#AttractionsIndicators-{{ $touristicAttraction->uuid }}" data-slide-to="{{ $index }}" @if($index === 0) class="active" @endif></li>
                                    @empty
                                        <p>No image found!</p>
                                    @endforelse
                                </ol>

                                {{-- Carousel Images --}}
                                <div class="carousel-inner">
                                    @forelse($images as $index => $image)
                                        <div class="carousel-item @if($index === 0) active @endif">
                                            <img 
                                                src="{{ asset('public/'.$image) }}" 
                                                style="width: 100%; height: 200px; object-fit: cover; filter: contrast(120%);" 
                                                loading="lazy"
                                                alt="{{ $touristicAttraction->attraction_name }}"
                                            >
                                        </div>
                                    @empty
                                        <p>No image found!</p>
                                    @endforelse
                                </div>
                            </div>

                            {{-- Overlay Text --}}
                            <div class="card-img-overlay">
                                <p class="card-text card-text-white" style="font-size: 1.5rem; font-weight: bold; position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem;">
                                    {{$touristicAttraction->attraction_name}}<br>
                                    <span style="font-family: 'Montserrat', sans-serif;font-weight: normal;font-size: 1rem">
                                        {{ strlen($touristicAttraction->attraction_description) > 50 ? 
                                           substr($touristicAttraction->attraction_description, 0, 50) . '...' : 
                                           $touristicAttraction->attraction_description 
                                        }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                    <div class="no-destinations-message">
                        <p>Whoops! No Tanzanian attraction has been published yet. Our personnel are working on it.</p>
                    </div>
                @endforelse
            </div>    

            <div class="discover-more-section">
                <a href="{{ route('Tanzania.show',$nation->uuid) }}" class="btn btn-discover-more">
                    Discover More Destinations
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
.destinations-section {
    background-color: #f8f9fa;
    padding: 3rem 0;
}

.section-header {
    text-align: center;
    margin-bottom: 2rem;
}

.section-title {
    font-weight: 700;
    color: #2c3e50;
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
}

.section-subtitle {
    color: #7f8c8d;
    font-size: 1.1rem;
}

.destinations-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.destination-card {
    perspective: 1000px;
}

.destination-card-inner {
    transition: all 0.3s ease-in-out;
    border: none;
    border-radius: 12px;
    overflow: hidden;
    position: relative;
}

.destination-card-inner:hover {
    transform: translateY(-10px) rotateX(5deg);
    box-shadow: 0 20px 30px rgba(0,0,0,0.1);
}

.destination-carousel {
    position: relative;
}

.destination-image {
    width: 100%;
    height: 300px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.destination-card-inner:hover .destination-image {
    transform: scale(1.1);
}

.carousel-indicators li {
    background-color: rgba(255,255,255,0.5);
    width: 10px;
    height: 10px;
    border-radius: 50%;
}

.carousel-indicators .active {
    background-color: white;
}

.carousel-control-prev,
.carousel-control-next {
    width: 5%;
    opacity: 0.7;
    transition: opacity 0.3s ease;
}

.carousel-control-prev:hover,
.carousel-control-next:hover {
    opacity: 1;
}

.destination-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.7));
    padding: 1rem;
}

.destination-content {
    color: white;
}

.destination-title {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.destination-description {
    font-size: 1rem;
    font-weight: normal;
    opacity: 0.9;
}

.no-destinations-message {
    text-align: center;
    color: #6c757d;
    padding: 2rem;
    background-color: #f1f3f5;
    border-radius: 12px;
    grid-column: 1 / -1;
}

.discover-more-section {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

.btn-discover-more {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background-color: #3498db;
    color: white;
    text-decoration: none;
    border-radius: 50px;
    transition: all 0.3s ease;
    font-weight: 600;
    box-shadow: 0 10px 20px rgba(41, 128, 185, 0.2);
}

.btn-discover-more:hover {
    background-color: #3498db;
    transform: translateY(-5px);
    box-shadow: 0 15px 25px rgba(41, 128, 185, 0.3);
}

.btn-discover-more svg {
    transition: transform 0.3s ease;
}

.btn-discover-more:hover svg {
    transform: translateX(5px);
}

@media (max-width: 768px) {
    .destinations-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 480px) {
    .destinations-grid {
        grid-template-columns: 1fr;
    }
}
</style>