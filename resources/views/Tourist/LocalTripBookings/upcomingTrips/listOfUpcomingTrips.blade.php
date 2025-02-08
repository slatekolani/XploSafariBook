    <h2 class="mb-4 text-2xl font-bold text-center text-gray-800">
        <i class="fas fa-plane-departure me-2"></i>Upcoming Safari's
    </h2>
    
    @forelse ($upcomingTrips as $upcomingTrip)
        <div class="booking-card p-4 mb-4">
            <div class="booking-details flex justify-between items-start">
                <!-- Trip Details -->
                <div class="flex-grow">
                    <h3>
                        <a href="{{route('touristicAttraction.show',$upcomingTrip->localTourPackages->touristicAttraction->uuid)}}"> {{ $upcomingTrip->localTourPackages->touristicAttraction->attraction_name }} &rAarr; </a>
                    </h3>
                    <p>Travelled with ~ <a href="{{route('tourOperator.publicView',$upcomingTrip->localTourPackages->tourOperator->uuid)}}">{{$upcomingTrip->localTourPackages->tourOperator->company_name}}</a></p>
                    <div class="flex items-center gap-2">
                        <p>Booked as: <span class="text-gray-600">
                            {{$upcomingTrip->tourist_name}}
                        </span>
                    </p>
                        
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div class="flex items-center gap-2">
                            <p>Travel Dates: <span class="text-gray-600">
                                {{ date('D, jS M Y', strtotime($upcomingTrip->localTourPackages->safari_start_date)) }}
                                -
                                {{ date('D, jS M Y', strtotime($upcomingTrip->localTourPackages->safari_end_date)) }}
                            </span>
                        </p>
                            
                        </div>
                        
                        
                        <div class="flex items-center gap-2">
                            <p>Time left : <span class="text-gray-600">
                                @php
                                    $startDate = Carbon\Carbon::parse($upcomingTrip->localTourPackages->safari_start_date);
                                    $currentDate = Carbon\Carbon::now();
                                    $daysDifference = $currentDate -> diffInDays($startDate, false); // The 'false' flag makes the difference signed
                                @endphp
                            
                                @if ($daysDifference > 0)
                                    {{ $daysDifference }} days until departure
                                @elseif ($daysDifference < 0)
                                    {{ abs($daysDifference) }} days passed since departure
                                @else
                                    The trip starts today!
                                @endif
                            </span>
                        </p>
                            
                            
                        </div>
                        
                        <div class="flex items-center gap-2">         
                            <p>Total Travellers: <span class="text-gray-600">{{ $upcomingTrip->total_tourists_label ?? 0 }} Travellers</span></p>
                        </div>
                        <div class="flex items-center gap-2">         
                            <p>Pick Up Stop: <span class="text-gray-600">{{ $upcomingTrip->collectionStop->collection_stop_name }}</span></p>
                        </div>
                        <div class="flex items-center gap-2">
                            @php                        
                                $pickUpTime = Carbon\Carbon::parse($upcomingTrip->collectionStop->pick_up_time);
                                $formattedTime = $pickUpTime->format('h:i A');
                            @endphp
                            <p>Pick Up Time: <span class="text-gray-600">{{ $formattedTime }}</span></p>
                        </div>
                        
                        
                        <div class="flex items-center gap-2">
                            @if($upcomingTrip->reservation_id == NULL)         
                            <p>Reservation: <span class="text-gray-600">You did not select any reservation provided by <a href="{{route('tourOperator.publicView',$upcomingTrip->localTourPackages->tourOperator->uuid)}}">{{$upcomingTrip->localTourPackages->tourOperator->company_name}}</a></span></p>
                                @else
                                <p>Reservation: <a href="{{$upcomingTrip->tourOperatorReservation->reservation_url}}">{{$upcomingTrip->tourOperatorReservation->reservation_name}}</a></p>
                                @endif
                        </div>


                        
                        <div class="flex items-center gap-2">
                            <p>Bill before Discount: <span class="text-gray-600">{{ number_format($upcomingTrip->TourPriceLabel, 2) }} TZS</span></p>
                            
                        </div>
                        <div class="flex items-center gap-2">
                            <p>Bill after Discount: <span class="text-gray-600">{{ number_format($upcomingTrip->DiscountedTourPriceLabel, 2) }} TZS</span></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <p>Discount Percent: <span class="text-gray-600">{{ number_format($upcomingTrip->localTourPackages->discount_offered) }} %</span></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <p>Payment Mode: <span class="text-gray-600">{!! ($upcomingTrip->PaymentModeLabel) !!} </span></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <p>Amount Paid: <span class="text-gray-600">{{ ($upcomingTrip->amountPaid) ?? 0 }} TZS</span></p>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <p>Payment Status: <span class="text-gray-600">{{ ($upcomingTrip->amountPaid) ?? 0 }} </span></p>   
                        </div>
                    </div>

                    <div class="mt-3 text-gray-600">
                        @if ($upcomingTrip->status == 1)
                            <em class="text-blue-500">
                                <i class="fas fa-check-circle me-1"></i>
                                Approved by <a href="{{route('tourOperator.publicView',$upcomingTrip->localTourPackages->tourOperator->uuid)}}">{{$upcomingTrip->localTourPackages->tourOperator->company_name}}</a>
                            </em>
                        @else
                            <em class="text-yellow-500">
                                <i class="fas fa-clock me-1"></i>
                                Pending approval from <a href="{{route('tourOperator.publicView',$upcomingTrip->localTourPackages->tourOperator->uuid)}}">{{$upcomingTrip->localTourPackages->tourOperator->company_name}}</a> 
                            </em>
                        @endif
                    </div>
                    @if ($upcomingTrip->TotalLocalCancelledTripBookingsLabel == 0)
                    <div class="mt-3 text-gray-600">
                            <em class="text-blue-500" style="color: dodgerblue">
                                <i class="fas fa-check-circle me-1"></i>
                                No cancellation request
                            </em>

                        
                    </div>

                    @else
                    <div class="mt-3 text-gray-600">
                        @if (optional($upcomingTrip->localTourPackageCancelledBookings)->cancellation_status == 1)
                            <em class="text-blue-500" style="color: red">
                                <i class="fas fa-check-circle me-1"></i>
                                Cancellation was approved by 
                                <a href="{{ route('tourOperator.publicView', $upcomingTrip->localTourPackages->tourOperator->uuid) }}">
                                    {{ $upcomingTrip->localTourPackages->tourOperator->company_name }}
                                </a>
                            </em>
                        @elseif (optional($upcomingTrip->localTourPackageCancelledBookings)->cancellation_status == 0)
                            <em class="text-yellow-500">
                                <i class="fas fa-clock me-1"></i>
                                Cancellation was requested but not yet approved by 
                                <a href="{{ route('tourOperator.publicView', $upcomingTrip->localTourPackages->tourOperator->uuid) }}">
                                    {{ $upcomingTrip->localTourPackages->tourOperator->company_name }}
                                </a>
                            </em>
                        @else

                        @endif
                    </div>
                    @endif
                    
                </div>
                <br>
                
                <!-- Actions -->
                <div class="action-buttons">
                    @php
                        $todayDate = Carbon\Carbon::now();
                        $tripStartDate = $upcomingTrip->localTourPackages->safari_start_date;
                        $tripEndDate = $upcomingTrip->localTourPackages->safari_end_date;
                    @endphp
                
                <div class="action-buttons">
                    @php
                        $todayDate = Carbon\Carbon::now();
                        $tripStartDate = $upcomingTrip->localTourPackages->safari_start_date;
                        $tripEndDate = $upcomingTrip->localTourPackages->safari_end_date;
                    @endphp
                
                    @if($tripEndDate >= $todayDate && $upcomingTrip->status == 0)
                        <a href="#">
                            <button class="btn btn-warning my-2">
                                <i class="fas fa-bell"></i> Send Reminder
                            </button> 
                        </a>                       
                        <a href="{{ route('localTourPackage.view', $upcomingTrip->localTourPackages->uuid) }}">
                            <button class="btn btn-primary my-2">
                                <i class="fas fa-star"></i> Trip Details
                            </button> 
                        </a>
                    @elseif ($tripEndDate >= $todayDate && $upcomingTrip->status == 1)
                    @if ($upcomingTrip->TotalLocalCancelledTripBookingsLabel == 0)
                        <a href="#">
                            <button class="btn btn-warning my-2">
                                <i class="fas fa-money-bill"></i> Pay for Trip
                            </button> 
                        </a>  
                        @else
                        <a href="#" onclick="alert('Trip was cancelled. You have no access to proceed with payment. Wait for the approval from the tour company.')">
                            <button class="btn btn-warning my-2">
                                <i class="fas fa-money-bill"></i> Pay for Trip
                            </button> 
                        </a>  
                    @endif                     
                        <a href="{{route('localTourBooking.previewInvoice',$upcomingTrip->uuid)}}">
                            <button class="btn btn-warning my-2">
                                <i class="fas fa-file"></i> Invoice
                            </button> 
                        </a>   
                        @if ($upcomingTrip->TotalLocalCancelledTripBookingsLabel == 0)                    
                        <a href="{{route('localTripCancellation.create',$upcomingTrip->uuid)}}">
                            <button class="btn btn-warning my-2">
                                <i class="fas fa-ban"></i> Cancel Trip
                            </button> 
                        </a>  
                        @else
                        <a href="{{route('localTripCancellation.show', $upcomingTrip->localTourPackageCancelledBookings->uuid)}}">
                            <button class="btn btn-warning my-2">
                                <i class="fas fa-briefcase"></i>Cancelled Request
                            </button> 
                        </a> 
                        @endif                     
                        <a href="{{ route('localTourPackage.view', $upcomingTrip->localTourPackages->uuid) }}">
                            <button class="btn btn-primary my-2">
                                <i class="fas fa-star"></i> Trip Details
                            </button> 
                        </a>
                    @else
                        <button @click="reminderNote({{ $upcomingTrip->uuid }})" class="btn btn-warning my-2">
                            <i class="fas fa-filter"></i> Get Related Safari's
                        </button>
                        <a href="{{ route('localTourPackage.view', $upcomingTrip->localTourPackages->uuid) }}">
                            <button class="btn btn-primary my-2">
                                <i class="fas fa-star"></i> Trip Details
                            </button> 
                        </a>
                    @endif
                </div>
                
                </div>
                
            </div>
        </div>
       
    @empty
        <div class="text-center py-8">
            <i class="fas fa-plane-slash text-gray-400 text-5xl mb-3"></i>
            <p class="text-gray-500">No upcoming trips scheduled.</p>
            <a href="#" onclick="alert('Feature coming soon')" class="btn btn-primary mt-3">
                <i class="fas fa-briefcase"></i> Create Safari Goals
            </a>
        </div>
        <div class="text-center py-8">
            <a href="{{route('localTourPackage.allLocalTourPackages')}}" class="btn btn-primary mt-3">
                <i class="fas fa-car"></i> See Local Tour Packages
            </a>
        </div>
    @endforelse
    <div class="pagination">
        {!! $upcomingTrips->links() !!}
    </div>
