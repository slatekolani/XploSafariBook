<div class="container mx-auto px-2 sm:px-4">
    <h2 class="mb-4 text-2xl font-bold text-center text-gray-800">
        <i class="fas fa-plane-departure mr-2"></i> Approved Custom Safari's
    </h2>

    @php
        $approvedTrips = $customTourBookings->where('status', 1);
    @endphp

    @if ($approvedTrips->isNotEmpty())
        @foreach ($approvedTrips as $customTourBooking)
            <div class="booking-card p-2 sm:p-4 mb-4 bg-white rounded-lg shadow-md">
                <div class="booking-details flex flex-col md:flex-row justify-between items-start">
                    <!-- Trip Details -->
                    <div class="flex-grow space-y-2 text-sm sm:text-base">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-building text-gray-500"></i>
                            <p>Booked company ~ <a href="{{ route('tourOperator.publicView', $customTourBooking->tourOperator->uuid) }}" class="text-blue-500 hover:underline">
                                {{ $customTourBooking->tourOperator->company_name }}</a>
                            </p>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <i class="fas fa-user text-gray-500"></i>
                            <p>Booked as: <span class="text-gray-600">{{ $customTourBooking->tourist_name }}</span></p>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <i class="fas fa-envelope text-gray-500"></i>
                            <p>Email address: <span class="text-gray-600">{{ $customTourBooking->tourist_email_address }}</span></p>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <i class="fas fa-map text-gray-500"></i>
                            <p>Tour type: <span class="text-gray-600">{{ $customTourBooking->tourPackageType->tour_package_type_name }}</span></p>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <i class="fas fa-star text-gray-500"></i>
                            <p>Tour quality: <span class="text-gray-600">{{ $customTourBooking->tourType->tour_type_name }}</span></p>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <i class="fas fa-landmark text-gray-500"></i>
                            <p>Attractions selected: 
                                <span class="text-gray-600">
                                    @foreach ($customTourBooking->CustomTourBookingTouristAttractionLabel as $attraction)
                                    <a href="{{route('touristicAttraction.show',$attraction['uuid'])}}">{{ $attraction['attraction_name'] }}</a>
                                    @endforeach
                                </span>
                            </p>
                        </div>

                        <div class="flex items-center gap-2">
                            <i class="fas fa-clock text-gray-500"></i>
                            <p>Count down days: 
                                <span class="text-gray-600">
                                    @if ($customTourBooking->CountDownDaysForACustomTourLabel > 0)
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">{{abs($customTourBooking->CountDownDaysForACustomTourLabel)}} days left</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">{{abs($customTourBooking->CountDownDaysForACustomTourLabel)}} days expired</span>
                                    @endif
                                </span>
                            </p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 sm:gap-3">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-calendar-alt text-gray-500"></i>
                                <p>Travel Dates: <span class="text-gray-600">
                                    {{ date('D, jS M Y', strtotime($customTourBooking->start_date)) }} -
                                    {{ date('D, jS M Y', strtotime($customTourBooking->end_date)) }}
                                </span></p>
                            </div>
                            
                            <div class="flex items-center gap-2">
                                <i class="fas fa-hourglass-half text-gray-500"></i>
                                <p>Time left: <span class="text-gray-600">
                                    @php
                                        $startDate = Carbon\Carbon::parse($customTourBooking->start_date);
                                        $currentDate = Carbon\Carbon::now();
                                        $daysDifference = $currentDate->diffInDays($startDate, false);
                                    @endphp
                                    
                                    @if ($daysDifference > 0)
                                        {{ $daysDifference }} days until departure
                                    @elseif ($daysDifference < 0)
                                        {{ abs($daysDifference) }} days passed since departure
                                    @else
                                        The trip starts today!
                                    @endif
                                </span></p>
                            </div>
                            
                            <div class="flex items-center gap-2">
                                <i class="fas fa-bus text-gray-500"></i>
                                <p>Transport selected: <span class="text-gray-600">{{ $customTourBooking->transportType->transport_name }}</span></p>
                            </div>
                            
                            <div class="flex items-center gap-2">
                                <i class="fas fa-globe text-gray-500"></i>
                                <p>Region: <span class="text-gray-600">{{ $customTourBooking->region->region_name }}</span></p>
                            </div>
                            
                            <div class="flex items-center gap-2">
                                <i class="fas fa-wheelchair text-gray-500"></i>
                                <p>Special need request: <span class="text-gray-600">{{ $customTourBooking->special_need_description ?? 'None' }}</span></p>
                            </div>

                            <div class="flex items-center gap-2">
                                <i class="fas fa-users text-gray-500"></i>
                                <p>Total adult foreigners: <span class="text-gray-600">{{number_format($customTourBooking->total_adult_foreigners)}}</span></p>
                            </div>

                            <div class="flex items-center gap-2">
                                <i class="fas fa-child text-gray-500"></i>
                                <p>Total children foreigners: <span class="text-gray-600">{{number_format($customTourBooking->total_children_foreigners)}}</span></p>
                            </div>

                            <div class="flex items-center gap-2">
                                <i class="fas fa-users text-gray-500"></i>
                                <p>Total adult residents: <span class="text-gray-600">{{number_format($customTourBooking->total_adult_residents)}}</span></p>
                            </div>

                            <div class="flex items-center gap-2">
                                <i class="fas fa-child text-gray-500"></i>
                                <p>Total children residents: <span class="text-gray-600">{{number_format($customTourBooking->total_children_residents)}}</span></p>
                            </div>

                            <div class="flex items-center gap-2">
                                <i class="fas fa-hotel text-gray-500"></i>
                                @if($customTourBooking->reservation_needed==0)
                                    <p>Reservation use: <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">No</span></p>
                                @else
                                    <p>Reservation use: <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Yes</span></p>
                                @endif
                            </div>

                            <div class="flex items-center gap-2">
                                <i class="fas fa-users text-gray-500"></i>
                                <p>Total Travellers: <span class="text-gray-600">{{ $customTourBooking->TotalNumberOfTravellersLabel ?? 0 }} Travellers</span></p>
                            </div>
                            
                            <div class="flex items-center gap-2">
                                <i class="fas fa-money-bill-wave text-gray-500"></i>
                                <p>Tour bill: 
                                    @if ($customTourBooking->TotalCustomTourPriceLabel <= 0)
                                        <span class="text-blue-500 font-semibold">Tour is billed at approval. Wait for approval</span>
                                    @else
                                        <span class="text-gray-600 font-semibold">{{ number_format($customTourBooking->TotalCustomTourPriceLabel, 2) }} TZS</span>
                                    @endif
                                </p>
                            </div>
                            
                            <div class="flex items-center gap-2">
                                <i class="fas fa-wallet text-gray-500"></i>
                                @if ($customTourBooking->status == 0)
                                    <p>Amount Paid: <span class="text-blue-500 font-semibold">Payments will count when the tour is approved</span></p>
                                @else
                                    <p>Amount Paid: <span class="text-gray-600 font-semibold">{{ $customTourBooking->amountPaid ?? 0 }} TZS</span></p>  
                                @endif
                            </div>
                            
                            <div class="flex items-center gap-2">
                                <i class="fas fa-chart-line text-gray-500"></i>
                                @if ($customTourBooking->status == 0)
                                    <p>Payment progress: <span class="text-blue-500 font-semibold">Progress can't be tracked until your tour is approved</span></p>
                                @else
                                    <p>Payment progress: <span class="text-gray-600 font-semibold">{{ $customTourBooking->amountPaid ?? 0 }}</span></p>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <i class="fas fa-comment text-gray-500"></i>
                            <p>Message: <span class="text-gray-600">{{ $customTourBooking->message }}</span></p>
                        </div>
                        
                        <div class="mt-3 text-gray-600">
                            @if ($customTourBooking->status == 1)
                                <em class="text-green-500 font-semibold">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Approved by <a href="{{ route('tourOperator.publicView', $customTourBooking->tourOperator->uuid) }}" class="text-blue-500 hover:underline">
                                        {{ $customTourBooking->tourOperator->company_name }}</a>
                                </em>
                            @else
                                <em class="text-yellow-500 font-semibold">
                                    <i class="fas fa-clock mr-1"></i>
                                    Pending approval from <a href="{{ route('tourOperator.publicView', $customTourBooking->tourOperator->uuid) }}" class="text-blue-500 hover:underline">
                                        {{ $customTourBooking->tourOperator->company_name }}</a>
                                </em>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons flex flex-col space-y-1 md:flex-row md:space-y-0 md:space-x-2 mt-4 md:mt-0">
                        @php
                            $todayDate = Carbon\Carbon::now();
                            $tripEndDate = $customTourBooking->end_date;
                        @endphp

                        @if($tripEndDate >= $todayDate)
                            <a href="#">
                                <button class="btn btn-warning flex items-center justify-center px-4 py-2 transition duration-300 ease-in-out hover:scale-105">
                                    <i class="fas fa-bell mr-2"></i> Send Trip Reminder
                                </button> 
                            </a>                       
                        @endif

                        <a href="{{route('customTourBookings.invoicePreview',$customTourBooking->uuid)}}">
                            <button class="btn btn-primary flex items-center justify-center px-4 py-2 transition duration-300 ease-in-out hover:scale-105">
                                <i class="fas fa-briefcase mr-2"></i> Invoice
                            </button> 
                        </a> 

                        <a href="#">
                            <button class="btn btn-primary flex items-center justify-center px-4 py-2 transition duration-300 ease-in-out hover:scale-105">
                                <i class="fas fa-dollar-sign mr-2"></i> Pay
                            </button> 
                        </a> 
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="text-center py-8 bg-gray-100 rounded-lg">
            <i class="fas fa-plane-slash text-gray-400 text-5xl mb-3"></i>
            <p class="text-gray-500">No approved trips.</p>
        </div>
    @endif

    <div class="mt-4 flex justify-center">
        {!! $customTourBookings->links() !!}
    </div>
</div>