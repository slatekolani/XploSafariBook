<div class="container-fluid event-travels-section">
    <div class="row">
        <div class="col-md-12">
            <div class="section-header mb-4">
                <h3 class="section-title">Event Travels</h3>
                <p class="section-subtitle">Craft extraordinary memories on extraordinary occasions</p>
            </div>

            <div class="events-grid">
                @forelse($events as $tanzaniaEvent)
                    <div class="event-card">
                        <div class="card event-card-inner h-100 shadow-hover">
                            <a href="{{ route('event.spotLocalSafaris', $tanzaniaEvent->uuid) }}" class="event-card-link">
                                <div class="card-image-wrapper">
                                    <img 
                                        src="{{ asset('public/eventImages/' . $tanzaniaEvent->event_image) }}"
                                        alt="{{ $tanzaniaEvent->event_name }}"
                                        class="card-img-top event-image"
                                        loading="lazy"
                                    >
                                    <div class="card-image-overlay">
                                        <h5 class="event-title">{{ $tanzaniaEvent->event_name }}</h5>
                                        <span style="color: white">{{strlen($tanzaniaEvent->event_description) > 38 ? substr($tanzaniaEvent->event_description, 0, 38) . '...' : $tanzaniaEvent->event_description }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="no-events-message">
                        <p>Whoops! No events have been added yet. Our team is crafting something special!</p>
                    </div>
                @endforelse
            </div>

            <div class="see-more-section">
                <a href="#" class="btn btn-explore">
                    Explore More Adventures
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
.event-travels-section {
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

.events-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.event-card {
    perspective: 1000px;
}

.event-card-inner {
    transition: all 0.3s ease-in-out;
    border: none;
    border-radius: 12px;
    overflow: hidden;
}

.event-card-inner:hover {
    transform: translateY(-10px) rotateX(5deg);
    box-shadow: 0 20px 30px rgba(0,0,0,0.1);
}

.card-image-wrapper {
    position: relative;
    overflow: hidden;
}

.event-image {
    width: 100%;
    height: 300px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.event-card-inner:hover .event-image {
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

.event-title {
    color: white;
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0;
}

.no-events-message {
    text-align: center;
    color: #6c757d;
    padding: 2rem;
    background-color: #f1f3f5;
    border-radius: 12px;
}

.see-more-section {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

.btn-explore {
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
    box-shadow: 0 10px 20px rgba(52, 152, 219, 0.2);
}

.btn-explore:hover {
    background-color: #2980b9;
    transform: translateY(-5px);
    box-shadow: 0 15px 25px rgba(52, 152, 219, 0.3);
}

.btn-explore svg {
    transition: transform 0.3s ease;
}

.btn-explore:hover svg {
    transform: translateX(5px);
}
</style>