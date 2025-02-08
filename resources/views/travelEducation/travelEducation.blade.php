@extends('layouts.main', ['title' => __('Travel Education'), 'header' => __('Travel Education')])
@include('includes.validate_assets')
<style>
    .heading {
        display: none;
    }

    .nav-container {
        position: relative;
        margin-bottom: 2rem;
        background: dodgerblue;
        z-index: 100;
    }

    .nav-container.sticky {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        padding: 0.5rem 2rem;
        background: dodgerblue;
        backdrop-filter: blur(8px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .nav-pills {
        border: none;
        display: flex;
        gap: 0.5rem;
        padding: 0.5rem;
        overflow-x: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .nav-pills::-webkit-scrollbar {
        display: none;
    }

    .nav-pills .nav-item {
        margin: 0;
    }

    .nav-pills .nav-link {
        border: none;
        color: #64748b;
        padding: 0.75rem 1.25rem;
        font-weight: 500;
        border-radius: 8px;
        white-space: nowrap;
        transition: all 0.3s ease;
    }

    .nav-pills .nav-link:hover {
        color: white;
        background: rgba(30, 144, 255, 0.1);
    }

    .nav-pills .nav-link.active {
        color: white;
        background: dodgerblue;
    }

    .scroll-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 32px;
        height: 32px;
        background: white;
        border: none;
        border-radius: 50%;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 1;
        transition: all 0.3s ease;
    }

    .scroll-button:hover {
        background: #f8f9fa;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .scroll-button.left { left: 0.5rem; }
    .scroll-button.right { right: 0.5rem; }

    .tab-content {
        padding: 1rem;
    }

    .tab-pane {
        display: none;
    }

    .tab-pane.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @media (max-width: 768px) {
        .nav-container.sticky {
            padding: 0.5rem 1rem;
        }
        
        .nav-pills .nav-link {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
    }
</style>

@section('content')
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body bg-white bg-opacity-85">
                <div class="heading text-center">
                    <h3 class="text-primary fs-1">Travel Education</h3>
                    <p class="text-dark">Get to know what key things you should consider while using our platform</p>
                </div>

                <div class="nav-container" id="stickyNav">
                    <button class="scroll-button left" onclick="scrollTabs('left')">&lt;</button>
                    <button class="scroll-button right" onclick="scrollTabs('right')">&gt;</button>
                    <ul class="nav nav-pills flex-nowrap" id="regionTabs" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link active" style="color: white;width: auto" id="nav-overview-tab"data-toggle="tab" href="#nav-overview" role="tab" aria-controls="nav-overview"aria-selected="true">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color: white" id="nav-tourTypes-tab"
                                data-toggle="tab" href="#nav-tourTypes" role="tab"
                                aria-controls="nav-tourTypes" aria-selected="false">Tour Types</a>
                        </li>

                        <li class="nav-item">
                                    <a class="nav-link" style="color: white" id="nav-tourPackageTypes-tab" data-toggle="tab"
                                        href="#nav-tourPackageTypes" role="tab" aria-controls="nav-tourPackageTypes"
                                        aria-selected="false">Tour Package Types</a>
                                </li>


                       <li class="nav-item">
                                    <a class="nav-link" style="color: white" id="nav-events-tab" data-toggle="tab"
                                        href="#nav-events" role="tab" aria-controls="nav-events"
                                        aria-selected="false">Events</a>
                                </li>


                        <li class="nav-item">
                                    <a class="nav-link" style="color: white" id="nav-customerExperiences-tab" data-toggle="tab"
                                        href="#nav-customerExperiences" role="tab" aria-controls="nav-customerExperiences"
                                        aria-selected="false">Customer Experiences</a>
                                </li>

                        <li class="nav-item">
                                    <a class="nav-link" style="color: white" id="nav-travelInsurances-tab"
                                        data-toggle="tab" href="#nav-travelInsurances" role="tab"
                                        aria-controls="nav-travelInsurances" aria-selected="false">Travel Insurances</a>
                                </li>

                       <li class="nav-item">
                                    <a class="nav-link" style="color: white" id="nav-adventurePaymentTimeframe-tab" data-toggle="tab"
                                        href="#nav-adventurePaymentTimeframe" role="tab" aria-controls="nav-adventurePaymentTimeframe"
                                        aria-selected="false">Adventure Payment Timeframe</a>
                                </li>
                    </ul>
                </div>

                <div class="tab-content" id="regionTabContent">
                        @include('travelEducation.education.overview')
                        @include('travelEducation.education.adventureDuration')
                        @include('travelEducation.education.customerExperience')
                        @include('travelEducation.education.events')
                        @include('travelEducation.education.tourPackageTypes')
                        @include('travelEducation.education.tourTypes')
                        @include('travelEducation.education.travelInsurance')
                       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const nav = document.getElementById('stickyNav');
    const navPills = document.querySelector('.nav-pills');
    const scrollButtons = document.querySelectorAll('.scroll-button');
    
    // Sticky navigation
    let navTop = nav.offsetTop;
    let navHeight = nav.offsetHeight;
    
    function updateNavPosition() {
        navTop = nav.offsetTop;
        navHeight = nav.offsetHeight;
    }
    
    function handleScroll() {
        if (window.pageYOffset >= navTop) {
            nav.classList.add('sticky');
            document.body.style.paddingTop = navHeight + 'px';
        } else {
            nav.classList.remove('sticky');
            document.body.style.paddingTop = '0';
        }
        updateScrollButtons();
    }
    
    // Scroll buttons visibility
    function updateScrollButtons() {
        const isScrollable = navPills.scrollWidth > navPills.clientWidth;
        scrollButtons.forEach(button => {
            button.style.display = isScrollable ? 'flex' : 'none';
        });
        
        if (isScrollable) {
            const isAtStart = navPills.scrollLeft <= 0;
            const isAtEnd = navPills.scrollLeft >= (navPills.scrollWidth - navPills.clientWidth);
            
            document.querySelector('.scroll-button.left').style.display = isAtStart ? 'none' : 'flex';
            document.querySelector('.scroll-button.right').style.display = isAtEnd ? 'none' : 'flex';
        }
    }
    
    // Tab scrolling
    window.scrollTabs = function(direction) {
        const scrollAmount = navPills.clientWidth / 2;
        navPills.scrollBy({
            left: direction === 'left' ? -scrollAmount : scrollAmount,
            behavior: 'smooth'
        });
    };
    
    // Initialize
    updateNavPosition();
    updateScrollButtons();
    
    // Event listeners
    window.addEventListener('scroll', handleScroll);
    window.addEventListener('resize', () => {
        updateNavPosition();
        updateScrollButtons();
    });
    navPills.addEventListener('scroll', updateScrollButtons);
    
    // Handle tab clicks with smooth scroll
    const tabLinks = document.querySelectorAll('.nav-link');
    tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all tabs
            tabLinks.forEach(tab => {
                tab.classList.remove('active');
                const target = document.querySelector(tab.getAttribute('href'));
                if (target) {
                    target.classList.remove('show', 'active');
                }
            });
            
            // Add active class to clicked tab
            this.classList.add('active');
            const targetPane = document.querySelector(this.getAttribute('href'));
            if (targetPane) {
                targetPane.classList.add('show', 'active');
            }
            
            // Smooth scroll to content
            const scrollOffset = nav.classList.contains('sticky') ? navHeight : navHeight * 2;
            const targetPosition = targetPane.getBoundingClientRect().top + window.pageYOffset - scrollOffset;
            
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        });
    });
});
</script>
@endpush
