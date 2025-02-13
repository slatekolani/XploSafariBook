<div class="container-fluid tourOperators-section">
    <div class="row">
        <div class="col-md-12">
            <div class="section-header mb-4">
                <h3 class="section-title">Tour Operators</h3>
                <p class="section-subtitle">Trusted tour operators offering exceptional travel experiences</p>
            </div>
            <div class="row">
                @forelse($tourOperators as $operator)
                    @if ($operator->status == 1)
                        <div class="col-md-4" style="margin-top: 15px">
                            <div class="card h-100 border-primary card-with-gradient">
                                <a href="{{ route('tourOperator.publicView', $operator->uuid) }}" 
                                   style="text-decoration: none; position: relative; display: block;">
                                    <img class="card-img-top"
                                         src="{{ asset('public/CompaniesTeamImage/' . $operator->company_team_image) }}"
                                         style="width: 100%; height: 200px; object-fit: cover;"
                                         loading="lazy">
                                    <div class="card-img-overlay">
                                        <p class="card-text card-text-white"
                                           style="font-size: 1.5rem; font-weight: bold; position: absolute; top: 0; right: 0; padding: 1rem;">
                                            @if ($operator->status == 1)
                                                <span class="badge badge-success badge-pill badge-sm">Verified</span>
                                            @endif
                                        </p>
                                    </div>
                                </a>
                                <div class="card-body" style="position: relative; z-index: 2;">
                                    <h5 class="card-title">{{ $operator->company_name }}</h5>
                                    {{-- <div class="operator-stats">
                                        <span class="rating">
                                            <i class="fas fa-star"></i> {{ number_format($operator->average_rating, 1) }}
                                        </span>
                                        <span class="tours-count">
                                            <i class="fas fa-route"></i> {{ $operator->total_tours }} Tours
                                        </span>
                                        <span class="experience">
                                            <i class="fas fa-calendar-alt"></i> {{ $operator->years_of_experience }} Years
                                        </span>
                                    </div> --}}
                                    <p class="card-text">{{ $operator->about_company }}</p>
                                    
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <a href="{{ route('tourOperator.publicView', $operator->uuid) }}" 
                                           class="btn btn-primary">View Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="col-md-12">
                        <p style="padding-left: 20px">No tour operators available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    @if (!empty($tourOperators) && $tourOperators->count())
        <div class="discover-more-section">
            <a href="{{route('tourOperator.allTourOperators')}}" class="btn btn-explore-group">
                View All Tour Operators
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="feather feather-arrow-right">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    @endif
</div>

<style>
    .tourOperators-section {
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

    .operator-stats {
        display: flex;
        gap: 1rem;
        margin: 1rem 0;
        font-size: 0.9rem;
        color: #666;
    }

    .operator-stats span {
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .operator-stats i {
        color: #f1c40f;
    }

    .operator-specialties {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .specialty-badge {
        background-color: #e9ecef;
        padding: 0.3rem 0.8rem;
        border-radius: 50px;
        font-size: 0.8rem;
        color: #495057;
    }

    .card-with-gradient {
        transition: transform 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-with-gradient:hover {
        transform: translateY(-5px);
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

    .discover-more-section {
        text-align: center;
        margin-top: 3rem;
    }
</style>