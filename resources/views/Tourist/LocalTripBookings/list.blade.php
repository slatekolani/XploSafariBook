@extends('layouts.main', ['title' => __('User Booking Information'), 'header' => __('User Booking Information')])

@include('includes.datatable_assets')

@push('after-styles')
    {{ Html::style(url('vendor/select2/css/select2.min.css')) }}
    {{ Html::style(url('vendor/magnific-popup/magnific-popup.css')) }}
    {{ Html::style(url('vendor/animate/animate.css')) }}

    <style>
        /* Base styles */
        h3 a {
            font-size: 20px;
        }

        /* Container styles */
        .manual-container {
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 0;
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        /* Navigation styles */
        .nav-pills {
            width: 100%;
            border-right: 1px solid #dee2e6;
            height: 100%;
            min-height: 500px;
        }

        .nav-pills .nav-link2 {
            text-align: left;
            padding: 1rem 1.5rem;
            margin: 0.25rem 0;
            border-radius: 0.25rem;
            transition: all 0.3s ease;
            color: #495057;
        }

        .nav-pills .nav-link2.active {
            background-color: #007bff;
            color: white;
        }

        .nav-pills .nav-link2:hover:not(.active) {
            background-color: #f8f9fa;
        }

        /* Content styles */
        .tab-content {
            width: 100%;
            overflow: hidden;
            background: #fff;
            min-height: 500px;
        }

        .tab-pane {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
            padding: 1.5rem;
            display: none;
        }

        .tab-pane.active {
            display: block;
        }

        .tab-pane.show {
            opacity: 1;
        }

        /* Action buttons */
        .action-buttons {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        .action-buttons a {
            flex: 1;
            text-align: center;
        }

        /* Additional utilities */
        .sidebar {
            position: sticky;
            top: 20px;
            height: 100%;
        }

        /* Card styles */
        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 1rem;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #eee;
            padding: 1rem;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            h3 a {
                font-size: 15px;
            }

            .manual-container {
                flex-direction: column;
            }

            .nav-pills {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #dee2e6;
                min-height: auto;
            }

            .nav-pills .nav-link2 {
                text-align: center;
                padding: 0.75rem;
            }

            .col-md-3,
            .col-md-9 {
                padding: 0;
            }

            .tab-pane {
                padding: 1rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .action-buttons a {
                width: 100%;
            }
        }

        /* Fix for tab content height */
        .tab-content>.active {
            display: block;
            visibility: visible;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4">
        <div class="row manual-container rounded g-0">
            <!-- Navigation Pills -->
            <div class="col-md-3 p-0">
                <div class="sidebar">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link2 active" id="v-pills-upcoming-tab" data-bs-toggle="pill"
                            href="#v-pills-upcoming-content" role="tab" aria-controls="v-pills-upcoming-content"
                            aria-selected="true">
                            Upcoming Safari's
                        </a>
                        <a class="nav-link2" id="v-pills-completed-tab" data-bs-toggle="pill"
                            href="#v-pills-completed-content" role="tab" aria-controls="v-pills-completed-content"
                            aria-selected="false">
                            Completed Safari's
                        </a>
                        
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="col-md-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-upcoming-content" role="tabpanel"
                        aria-labelledby="v-pills-upcoming-tab">
                        <div class="px-3 py-2">
                            @include('Tourist.LocalTripBookings.upcomingTrips.listOfUpcomingTrips')
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-completed-content" role="tabpanel"
                        aria-labelledby="v-pills-completed-tab">
                        <div class="px-3 py-2">
                            @include('Tourist.LocalTripBookings.completedTrips.listOfCompletedTrips')
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    @push('after-scripts')
        <script>
            $(document).ready(function() {
                // Initialize Bootstrap tabs
                var triggerTabList = [].slice.call(document.querySelectorAll('#v-pills-tab a'))
                triggerTabList.forEach(function(triggerEl) {
                    var tabTrigger = new bootstrap.Tab(triggerEl)
                    triggerEl.addEventListener('click', function(event) {
                        event.preventDefault()
                        tabTrigger.show()
                    })
                })

                // Handle URL with hash for direct tab access
                var hash = window.location.hash;
                if (hash) {
                    var activeTab = document.querySelector('#v-pills-tab a[href="' + hash + '"]')
                    if (activeTab) {
                        new bootstrap.Tab(activeTab).show()
                    }
                }

                // Update URL hash when tab changes
                $('.nav-link2').on('shown.bs.tab', function(e) {
                    if (history.pushState) {
                        history.pushState(null, null, e.target.hash);
                    } else {
                        window.location.hash = e.target.hash;
                    }
                });

                // Fix for tab content visibility
                $('.nav-link2').on('click', function() {
                    $('.tab-pane').removeClass('active show');
                    $($(this).attr('href')).addClass('active show');
                });
            });
        </script>
    @endpush
@endsection
