@extends('layouts.main', [
    'title' => __('Safari to ' . $localTourPackage->touristicAttraction->attraction_name),
    'header' => __('Safari to ' . $localTourPackage->touristicAttraction->attraction_name),
])
@include('includes.validate_assets')
<style>
    /* Heart Icon Styling */
    .heart-icon {
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 24px;
        color: #ff4d4f;
        background-color: #fff;
        border-radius: 50%;
        padding: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .heart-icon:hover {
        transform: scale(1.2);
        color: #e60023;
    }

    /* Callout Responsiveness */
    #callout {
        max-width: 90%;
        width: auto;
        padding: 10px;
    }

    .nav-container {
        position: relative;
        margin-bottom: 2rem;
        background: white;
        z-index: 100;
    }

    /* Make nav sticky when has-sticky class */
    .nav-container.has-sticky {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        padding: 0.5rem 2rem;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(8px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transform: translateY(0);
        transition: all 0.3s ease;
        animation: slideDown 0.3s ease;
    }


    @keyframes slideDown {
        from {
            transform: translateY(-100%);
        }

        to {
            transform: translateY(0);
        }
    }

    /* Navigation tabs styling */
    .nav-tabs {
        border: none;
        display: flex;
        gap: 0.5rem;
        padding: 0.5rem;
        overflow-x: auto;
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* IE and Edge */
    }

    .nav-tabs::-webkit-scrollbar {
        display: none;
    }

    .nav-tabs .nav-item {
        margin: 0;
    }

    .nav-tabs .nav-link {
        border: none;
        color: #64748b !important;
        padding: 0.75rem 1.25rem;
        font-weight: 500;
        border-radius: 8px;
        white-space: nowrap;
        transition: all 0.3s ease;
    }

    .nav-tabs .nav-link:hover {
        color: dodgerblue !important;
        background: rgba(30, 144, 255, 0.1);
    }

    .nav-tabs .nav-link.active {
        color: dodgerblue !important;
        background: transparent;
        border: none;
    }

    /* Scroll arrows for navigation */
    .nav-scroll {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 32px;
        height: 32px;
        background: white;
        border-radius: 50%;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 1;
        transition: all 0.3s ease;
    }

    .nav-scroll:hover {
        background: #f8f9fa;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .nav-scroll.left {
        left: 0.5rem;
    }

    .nav-scroll.right {
        right: 0.5rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .nav-container.has-sticky {
            padding: 0.5rem 1rem;
        }

        .nav-tabs {
            padding: 0.25rem;
        }

        .nav-tabs .nav-link {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
    }

    .tab-pane.active {
        display: block !important;
        opacity: 1 !important;
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
</style>
@section('content')
    <div class="card" style="margin-top: 30px">
        <div class="card-body">
            <div class="col-md-12 my-4 position-relative">
                <div class="row align-items-center">
                    <div class="col-md-6 position-relative">
                        <img src="{{ asset('public/localSafariBlogImages/' . $localTourPackage->safari_poster) }}"
                            alt="Safari Poster"
                            style="height: 100%; width: 100%; object-fit: cover; object-position: center; border-radius: 12px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5); transition: transform 0.3s ease;"
                            loading="lazy">
                        <a href="#" title="Add to Favorites" class="heart-icon">
                            <i class="fas fa-heart"></i>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <h3 class="mb-3" style="font-weight: 700; font-size: 28px; color: #2b3e50;">Safari to
                            {{ $localTourPackage->touristicAttraction->attraction_name }}</h3>
                        <p class="card-text" style="font-size: 15px; line-height: 1.6;color:dodgerblue">
                            {{ $localTourPackage->touristicAttraction->attraction_description }}
                        </p>
                        <p class="card-text text-muted" style="font-size: 15px; line-height: 1.6;">
                            {{ $localTourPackage->touristicAttraction->basic_information }}
                        </p>
                        <p class="badge badge-success py-2 px-3" style="font-size: 15px;">
                            {{ $localTourPackage->tourPackageType->tour_package_type_name }} special for
                            {{ $localTourPackage->tanzaniaAndWorldEvent->event_name }}
                        </p>
                        <div class="text-center mt-4">
                            <a href="{{ route('touristicAttraction.show', $localTourPackage->touristicAttraction->uuid) }}">
                                Learn more about {{ $localTourPackage->touristicAttraction->attraction_name }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 5px">
                <div class="col-md-12">
                    <div class="tab-pane" id="pills-touristAttraction" role="tabpanel"
                        aria-labelledby="pills-touristAttraction-tab">
                        <div class="nav-container" id="stickyNav">
                            <div class="nav-scroll left" onclick="scrollTabs('left')">←</div>
                            <ul class="nav nav-tabs flex-nowrap" id="nav-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                                        role="tab">Tour overview</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="nav-requestSpace-tab" data-toggle="tab" href="#nav-requestSpace"
                                        role="tab">Book/Request space</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="nav-honeyPoints-tab" data-toggle="tab" href="#nav-honeyPoints"
                                        role="tab">Honey points</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="nav-Transport-tab" data-toggle="tab" href="#nav-Transport"
                                        role="tab">Transport used</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="nav-Reservation-tab" data-toggle="tab"
                                        href="#nav-Reservation" role="tab">Reservation to be used</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="nav-tourOperator-tab" data-toggle="tab"
                                        href="#nav-tourOperator" role="tab">Tour Operator</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="nav-similarSafaris-tab" data-toggle="tab"
                                        href="#nav-similarSafaris" role="tab">Similar Safari's</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="nav-games-tab" data-toggle="tab" href="#nav-games"
                                        role="tab">Touristic Games</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="nav-gallery-tab" data-toggle="tab" href="#nav-gallery"
                                        role="tab">Tour Gallery</a>
                                </li>
                            </ul>
                            <div class="nav-scroll right" onclick="scrollTabs('right')">→</div>
                        </div>
                    </div>

                    <div class="tab-content" id="nav-tabContent">
                        @include('TourOperator.TourPackages.localTourPackages.publicView.overview')
                        @include('TourOperator.TourPackages.localTourPackages.publicView.honeyPoints')
                        @include('TourOperator.TourPackages.localTourPackages.publicView.transport')
                        @include('TourOperator.TourPackages.localTourPackages.publicView.tourOperator')
                        @include('TourOperator.TourPackages.localTourPackages.publicView.similarSafaris')
                        @include('TourOperator.TourPackages.localTourPackages.publicView.gallery')
                        @include('TourOperator.TourPackages.localTourPackages.publicView.games')
                        @include('TourOperator.TourPackages.localTourPackages.publicView.requestSpace')
                        @include('TourOperator.TourPackages.localTourPackages.publicView.reservation')
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const nav = document.getElementById('stickyNav');
                    const navTop = nav.offsetTop;
                    const navHeight = nav.offsetHeight;

                    // Sticky navigation handling
                    function handleScroll() {
                        if (window.pageYOffset >= navTop) {
                            nav.classList.add('has-sticky');
                            document.body.style.paddingTop = nav.offsetHeight + 'px';
                        } else {
                            nav.classList.remove('has-sticky');
                            document.body.style.paddingTop = 0;
                        }
                    }

                    window.addEventListener('scroll', handleScroll);

                    // Enhanced tab click handling with scroll
                    const navLinks = document.querySelectorAll('.nav-tabs .nav-link');
                    navLinks.forEach(link => {
                        link.addEventListener('click', function(e) {
                            e.preventDefault();

                            // First handle the tab switching
                            const targetTabId = this.getAttribute('href');
                            const targetTab = document.querySelector(targetTabId);

                            // Remove active class from all tabs and content
                            document.querySelectorAll('.nav-link').forEach(tab => tab.classList.remove(
                                'active'));
                            document.querySelectorAll('.tab-pane').forEach(content => content.classList
                                .remove('show', 'active'));

                            // Add active class to clicked tab and its content
                            this.classList.add('active');
                            targetTab.classList.add('show', 'active');

                            // Then scroll to the content
                            const scrollOffset = nav.classList.contains('has-sticky') ? navHeight + 20 :
                                navHeight * 2;
                            const targetPosition = targetTab.getBoundingClientRect().top + window
                                .pageYOffset - scrollOffset;

                            window.scrollTo({
                                top: targetPosition,
                                behavior: 'smooth'
                            });
                        });
                    });

                    // Horizontal scroll functionality
                    window.scrollTabs = function(direction) {
                        const tabsList = document.querySelector('.nav-tabs');
                        const scrollAmount = 200;
                        if (direction === 'left') {
                            tabsList.scrollLeft -= scrollAmount;
                        } else {
                            tabsList.scrollLeft += scrollAmount;
                        }
                    };

                    // Show/hide scroll buttons
                    const tabsList = document.querySelector('.nav-tabs');
                    const leftScroll = document.querySelector('.nav-scroll.left');
                    const rightScroll = document.querySelector('.nav-scroll.right');

                    function updateScrollButtons() {
                        const isAtStart = tabsList.scrollLeft <= 0;
                        const isAtEnd = tabsList.scrollLeft >= (tabsList.scrollWidth - tabsList.clientWidth);

                        leftScroll.style.display = isAtStart ? 'none' : 'flex';
                        rightScroll.style.display = isAtEnd ? 'none' : 'flex';
                    }

                    tabsList.addEventListener('scroll', updateScrollButtons);
                    window.addEventListener('resize', updateScrollButtons);
                    updateScrollButtons();
                });
            </script>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        $(function() {
            $(".select2").select2();


        });
    </script>
@endpush
@push('after-scripts')
    <script>
        $(document).ready(function() {
            $('[data-fancybox="gallery"]').fancybox({
                // Options here
            });
        });
    </script>
@endpush

@push('after-scripts')
    <script>
        function updateReservationId() {
            var checkbox = document.getElementById('reservation_id_checkbox');
            var hiddenInput = document.getElementById('reservation_id_hidden');

            // If checkbox is checked, use reservation ID value
            if (checkbox.checked) {

            } else {
                // If checkbox is not checked, set value to 0
                hiddenInput.value = "0";
            }
        }
    </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
