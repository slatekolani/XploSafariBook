@extends('layouts.main', ['title' => __('Travel List Destinations'), 'header' => __('Travel List Destinations')])
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
                <a class="nav-link active" id="v-pills-start-tab" data-bs-toggle="pill" href="#v-pills-start" role="tab">Recent Destinations</a>
                <a class="nav-link" id="v-pills-packages-tab" data-bs-toggle="pill" href="#v-pills-packages" role="tab">All Destinations</a>
            </div>
        </div>
        
        <!-- Content Area -->
        <div class="col-md-9 p-4">
            <span>Though a person can only get confirmed for travel after completing hte payment, for now we have referenced with the status of activeness of the request.</span>
            <div class="tab-content" id="v-pills-tabContent">
                <!-- Getting Started Content -->
                <div class="tab-pane fade show active" id="v-pills-start" role="tabpanel">
                    <h2 class="mb-6 font-extrabold text-3xl text-center text-blue-700">
                        Recent Destinations Travelled
                    </h2>
                
                    @if($recentDestinationsTravelled->isEmpty())
                        <p class="text-center text-gray-500 mt-8 text-lg">
                            No recent destinations travelled.
                        </p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-blue-100 text-blue-900">
                                        <th class="py-4 px-6 text-left text-md border border-gray-300">
                                            #
                                        </th>
                                        <th class="py-4 px-6 text-left text-md border border-gray-300">
                                            Destination Name
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentDestinationsTravelled as $index => $recentDestinationTravelled)
                                        <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                                            <td class="py-4 px-6 border border-gray-300 text-gray-800">
                                                {{ $index + 1 }}
                                            </td>
                                            <td class="py-4 px-6 border border-gray-300 text-gray-800">
                                              <a href="{{route('touristicAttraction.show',$recentDestinationTravelled->uuid)}}">{{ $recentDestinationTravelled->attraction_name }}</a>  
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                
                
                
                
                <!-- Other Tab Panels Similar to Getting Started -->
                <div class="tab-pane fade" id="v-pills-packages" role="tabpanel">
                    <h2 class="mb-6 font-extrabold text-3xl text-center text-blue-700">
                        All Destinations Travelled
                    </h2>
                
                    @if($allDestinationsTravelled->isEmpty())
                        <p class="text-center text-gray-500 mt-8 text-lg">
                            No attractions travelled.
                        </p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full border-collapse border border-gray-300">
                                <thead>
                                    <tr class="bg-blue-50 text-blue-300">
                                        <th class="py-4 px-6 text-left text-md border border-gray-300">
                                            #
                                        </th>
                                        <th class="py-4 px-6 text-left text-md border border-gray-300">
                                            Destination Name
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allDestinationsTravelled as $index => $destinationTravelled)
                                        <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                                            <td class="py-4 px-6 border border-gray-300 text-gray-800">
                                                {{ $index + 1 }}
                                            </td>
                                            <td class="py-4 px-6 border border-gray-300 text-gray-800">
                                                <a href="{{route('touristicAttraction.show',$destinationTravelled->uuid)}}">{{ $destinationTravelled->attraction_name }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                

                <div class="tab-pane fade" id="v-pills-booking" role="tabpanel">
                    <h2>Booking Process</h2>
                    <p>Step-by-step guide to selecting and booking your perfect trip.</p>
                </div>

                {{-- <div class="tab-pane fade" id="v-pills-payments" role="tabpanel">
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
                </div> --}}
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection