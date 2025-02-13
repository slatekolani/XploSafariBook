<div class="container-fluid group-travels-section">
    <div class="row">
        <div class="col-md-12">
            <div class="section-header mb-4">
                <h3 class="section-title" style="text-align: center; font-size: 2rem; font-weight: bold;">National Tourism Treasure</h3>
                <p class="section-subtitle" style="text-align: center; font-size: 1.1rem; color: #777;">Explore tourism attractions in various categories</p>

            </div>

            <div class="group-travels-grid">
                @forelse($touristicAttractionCategories as $touristicAttractionCategory)
                    <div class="group-travel-card">
                        <div class="card group-travel-card-inner h-100 shadow-hover">
                            <a href="{{route('touristicAttractionCategory.publicView',$touristicAttractionCategory->uuid)}}" class="group-travel-card-link">
                                <div class="card-image-wrapper">
                                    <img 
                                        src="{{ asset('public/TouristicAttractionCategoryIconicImages/' . $touristicAttractionCategory->attraction_category_iconic_image) }}"
                                        alt="{{ $touristicAttractionCategory->attraction_category_iconic_image }}"
                                        class="card-img-top group-travel-image"
                                        loading="lazy"
                                    >
                                    <div class="card-image-overlay">
                                        <h5 class="group-travel-title">{{ $touristicAttractionCategory->attraction_category }}</h5>
                                        <span style="color: white">{{strlen($touristicAttractionCategory->attraction_category_description) > 38 ? substr($touristicAttractionCategory->attraction_category_description,0,38) .'...' : $touristicAttractionCategory->attraction_category_description  }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="no-group-travels-message">
                        <p>Whoops! No national tourism treasures have been added yet. Our team is thriving to serve!</p>
                    </div>
                @endforelse
            </div>

            <div class="see-more-section">
                <a href="#" class="btn btn-explore-group">
                    Explore More National Tourism Treasures 
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
.group-travels-section {
    background-color: #f0f4f8;
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

.group-travels-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.group-travel-card {
    perspective: 1000px;
}

.group-travel-card-inner {
    transition: all 0.3s ease-in-out;
    border: none;
    border-radius: 12px;
    overflow: hidden;
}

.group-travel-card-inner:hover {
    transform: translateY(-10px) rotateX(5deg);
    box-shadow: 0 20px 30px rgba(0,0,0,0.1);
}

.card-image-wrapper {
    position: relative;
    overflow: hidden;
}

.group-travel-image {
    width: 100%;
    height: 300px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.group-travel-card-inner:hover .group-travel-image {
    transform: scale(1.1);
}

.card-image-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.7));
    padding: 1rem;
}

.group-travel-title {
    color: white;
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0;
}

.no-group-travels-message {
    text-align: center;
    color: #6c757d;
    padding: 2rem;
    background-color: #e9ecef;
    border-radius: 12px;
}

.see-more-section {
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

.btn-explore-group svg {
    transition: transform 0.3s ease;
}

.btn-explore-group:hover svg {
    transform: translateX(5px);
}

@media (max-width: 768px) {
    .group-travels-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 480px) {
    .group-travels-grid {
        grid-template-columns: 1fr;
    }
}
</style>