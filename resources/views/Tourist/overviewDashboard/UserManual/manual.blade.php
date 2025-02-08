@extends('layouts.main', ['title' => __('User Manual'), 'header' => __('User Manual')])
@include('includes.datatable_assets')
@push('after-styles')
    {{ Html::style(url('vendor/select2/css/select2.min.css')) }}
    {{ Html::style(url('vendor/magnific-popup/magnific-popup.css')) }}
    {{ Html::style(url('vendor/animate/animate.css')) }}

    <style>
        .manual-container {
            background-color: white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .nav-pills .nav-link.active {
            background-color: #007bff;
            color: white;
        }
        .sidebar {
            position: sticky;
            top: 20px;
            max-height: 90vh;
            overflow-y: auto;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="row manual-container rounded">
        <!-- Sidebar Navigation -->
        <div class="col-md-3 bg-light p-3 sidebar">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-start-tab" data-bs-toggle="pill" href="#v-pills-start" role="tab">Getting Started</a>
                <a class="nav-link" id="v-pills-packages-tab" data-bs-toggle="pill" href="#v-pills-packages" role="tab">Exploring Packages</a>
                <a class="nav-link" id="v-pills-booking-tab" data-bs-toggle="pill" href="#v-pills-booking" role="tab">Booking Process</a>
                <a class="nav-link" id="v-pills-payments-tab" data-bs-toggle="pill" href="#v-pills-payments" role="tab">Installment Payments</a>
                <a class="nav-link" id="v-pills-account-tab" data-bs-toggle="pill" href="#v-pills-account" role="tab">Account Management</a>
                <a class="nav-link" id="v-pills-support-tab" data-bs-toggle="pill" href="#v-pills-support" role="tab">Support & Help</a>
            </div>
        </div>
        
        <!-- Content Area -->
        <div class="col-md-9 p-4">
            <div class="tab-content" id="v-pills-tabContent">
                <!-- Getting Started Content -->
                <div class="tab-pane fade show active" id="v-pills-start" role="tabpanel">
                    <h2>Getting Started</h2>
                    <p>Welcome to our travel platform! This section will guide you through account creation and login.</p>
                    <!-- More detailed content -->
                </div>
                
                <!-- Other Tab Panels Similar to Getting Started -->
                <div class="tab-pane fade" id="v-pills-packages" role="tabpanel">
                    <h2>Exploring Travel Packages</h2>
                    <p>Discover amazing travel experiences tailored to your preferences.</p>
                </div>

                <div class="tab-pane fade" id="v-pills-booking" role="tabpanel">
                    <h2>Booking Process</h2>
                    <p>Step-by-step guide to selecting and booking your perfect trip.</p>
                </div>

                <div class="tab-pane fade" id="v-pills-payments" role="tabpanel">
                    <h2>Installment Payments</h2>
                    <p>Flexible payment options to make your dream trip affordable.</p>
                </div>

                <div class="tab-pane fade" id="v-pills-account" role="tabpanel">
                    <h2>Account Management</h2>
                    <p>Control your profile, bookings, and preferences.</p>
                </div>

                <div class="tab-pane fade" id="v-pills-support" role="tabpanel">
                    <h2>Support & Help</h2>
                    <p>We're here to assist you with any questions or issues.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection