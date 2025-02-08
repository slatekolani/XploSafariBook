    <h2 class="mb-4 text-2xl font-bold text-center text-gray-800">
        <i class="fas fa-plane-departure me-2"></i>Completed Safari's
    </h2>
    
    @forelse ($completedTrips as $completedTrip)
        <div class="booking-card p-4 mb-4">
            <div class="booking-details flex justify-between items-start">
                <!-- Trip Details -->
                <div class="flex-grow">
                    <h3>
                        <a href="{{route('touristicAttraction.show',$completedTrip->localTourPackages->touristicAttraction->uuid)}}"> {{ $completedTrip->localTourPackages->touristicAttraction->attraction_name }} &rAarr; </a>
                    </h3>
                    <p>Travelled with ~ <a href="{{route('tourOperator.publicView',$completedTrip->localTourPackages->tourOperator->uuid)}}">{{$completedTrip->localTourPackages->tourOperator->company_name}}</a></p>
                    <div class="flex items-center gap-2">
                        <p>Booked as: <span class="text-gray-600">
                            {{$completedTrip->tourist_name}}
                        </span>
                    </p>
                        
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div class="flex items-center gap-2">
                            <p>Travel Dates: <span class="text-gray-600">
                                {{ date('D, jS M Y', strtotime($completedTrip->localTourPackages->safari_start_date)) }}
                                -
                                {{ date('D, jS M Y', strtotime($completedTrip->localTourPackages->safari_end_date)) }}
                            </span>
                        </p>
                            
                        </div>
                        
                        
                        <div class="flex items-center gap-2">
                            <p>Time left : <span class="text-gray-600">
                                @php
                                    $startDate = Carbon\Carbon::parse($completedTrip->localTourPackages->safari_start_date);
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
                            <p>Total Travellers: <span class="text-gray-600">{{ $completedTrip->total_tourists_label ?? 0 }} Travellers</span></p>
                        </div>
                        <div class="flex items-center gap-2">         
                            <p>Pick Up Stop: <span class="text-gray-600">{{ $completedTrip->collectionStop->collection_stop_name }}</span></p>
                        </div>
                        <div class="flex items-center gap-2">
                            @php                        
                                $pickUpTime = Carbon\Carbon::parse($completedTrip->collectionStop->pick_up_time);
                                $formattedTime = $pickUpTime->format('h:i A');
                            @endphp
                            <p>Pick Up Time: <span class="text-gray-600">{{ $formattedTime }}</span></p>
                        </div>
                        
                        
                        <div class="flex items-center gap-2">
                            @if($completedTrip->reservation_id == NULL)         
                            <p>Reservation: <span class="text-gray-600">You did not select any reservation provided by <a href="{{route('tourOperator.publicView',$completedTrip->localTourPackages->tourOperator->uuid)}}">{{$completedTrip->localTourPackages->tourOperator->company_name}}</a></span></p>
                                @else
                                <p>Reservation: <a href="{{$completedTrip->tourOperatorReservation->reservation_url}}">{{$completedTrip->tourOperatorReservation->reservation_name}}</a></p>
                                @endif
                        </div>


                        
                        <div class="flex items-center gap-2">
                            <p>Bill before Discount: <span class="text-gray-600">{{ number_format($completedTrip->TourPriceLabel, 2) }} TZS</span></p>
                            
                        </div>
                        <div class="flex items-center gap-2">
                            <p>Bill after Discount: <span class="text-gray-600">{{ number_format($completedTrip->DiscountedTourPriceLabel, 2) }} TZS</span></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <p>Discount Percent: <span class="text-gray-600">{{ number_format($completedTrip->localTourPackages->discount_offered) }} %</span></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <p>Payment Mode: <span class="text-gray-600">{!! ($completedTrip->PaymentModeLabel) !!} </span></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <p>Amount Paid: <span class="text-gray-600">{{ ($completedTrip->amountPaid) ?? 0 }} TZS</span></p>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <p>Payment Status: <span class="text-gray-600">{{ ($completedTrip->amountPaid) ?? 0 }} </span></p>   
                        </div>
                    </div>

                    <div class="mt-3 text-gray-600">
                        @if ($completedTrip->status == 1)
                            <em class="text-blue-500">
                                <i class="fas fa-check-circle me-1"></i>
                                Approved by <a href="{{route('tourOperator.publicView',$completedTrip->localTourPackages->tourOperator->uuid)}}">{{$completedTrip->localTourPackages->tourOperator->company_name}}</a>
                            </em>
                        @else
                            <em class="text-yellow-500">
                                <i class="fas fa-clock me-1"></i>
                                Pending approval from <a href="{{route('tourOperator.publicView',$completedTrip->localTourPackages->tourOperator->uuid)}}">{{$completedTrip->localTourPackages->tourOperator->company_name}}</a> 
                            </em>
                        @endif
                    </div>
                </div>
                <br>
                
                <!-- Actions -->
                <div class="action-buttons">
                   
                    @php
                        $todayDate=Carbon\Carbon::now();
                        $tripStartDate=$completedTrip->localTourPackages->safari_start_date;
                        $tripEndDate=$completedTrip->localTourPackages->safari_end_date;
                    @endphp
                    
                    
                        @if($tripEndDate <= $todayDate && $completedTrip->status == 1)
                            <a href="{{ route('localTouristReview.review', $completedTrip->uuid) }}" class="my-2">
                                <button class="btn btn-warning">
                                    <i class="fas fa-star"></i> Rate Trip
                                </button> 
                            </a>                       
                            <a href="{{ route('localTourPackage.view', $completedTrip->localTourPackages->uuid) }}" class="my-2">
                                <button class="btn btn-primary">
                                    <i class="fas fa-star"></i> Trip Details
                                </button> 
                            </a>                       
                        @else
                            <button @click="reminderNote({{ $completedTrip->uuid }})" class="btn btn-warning my-2">
                                <i class="fas fa-filter"></i> Get Related Safari's
                            </button>
                            <a href="{{ route('localTourPackage.view', $completedTrip->localTourPackages->uuid) }}" class="my-2">
                                <button class="btn btn-primary">
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
            <p class="text-gray-500">No completed trips scheduled.</p>
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
        {!! $completedTrips->links() !!}
    </div>
