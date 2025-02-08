<div class="container-fluid cultures-section">
    <div class="row">
        <div class="col-md-12">
            <div class="section-header mb-4">
                <h3 class="section-title">Cultures in Tanzania</h3>
                <p class="section-subtitle">Explore the rich cultures of Tanzania and be amazed by their unique beauty
                </p>
            </div>
            <div class="row">
                @forelse($cultures as $culture)
                    <div class="col-md-4" style="margin-top: 15px">
                        <a href="{{ route('tanzaniaRegion.publicView', $culture->tanzaniaRegion->uuid) }}"
                            style="text-decoration: none; position: relative; display: block;">
                            <div class="card h-100 border-primary card-with-gradient">
                                <div id="AttractionsIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        @forelse(explode(',', $culture->culture_image) as $index => $image)
                                            <li data-target="#AttractionsIndicators" data-slide-to="{{ $index }}"
                                                @if ($index === 0) class="active" @endif></li>
                                        @empty
                                            <p>No image found!</p>
                                        @endforelse
                                    </ol>
                                    <div class="carousel-inner">
                                        @forelse(explode(',', $culture->culture_image) as $index => $image)
                                            <div class="carousel-item @if ($index === 0) active @endif">
                                                <img src="{{ asset('public/' . $image) }}"
                                                    style="width: 100%; height: 200px; object-fit: cover; filter: contrast(120%);"
                                                    loading="lazy">
                                            </div>
                                        @empty
                                            <p>No image found!</p>
                                        @endforelse
                                    </div>
                                </div>

                                <div class="card-img-overlay">
                                    <p class="card-text card-text-white"
                                        style="font-size: 1.5rem; font-weight: bold; position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem;">
                                        {{ $culture->culture_name }}<br>
                                        <span
                                            style="font-family: 'Montserrat', sans-serif;font-weight: normal;font-size: 1rem">{{ $culture->basic_information }}</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p>Whoops! No Culture has been published yet. Our personnel are working on it</P>
                @endforelse
            </div>
                
            <div class="discover-more-section">
                <a href="{{ route('Tanzania.show',$nation->uuid) }}" class="btn btn-discover-more">
                    Discover More Cultures
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
    .cultures-section{
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
</style>
