@extends('layouts.main', ['title' => __("Invoice"), 'header' => __('Invoice')])
@include('includes.validate_assets')
@section('content')
    <div class="invoice-container">
        <div style="text-align: center;padding-bottom: 10px">
            <a href="{{route('localTourBooking.printInvoice',$localTourPackageBooking->uuid)}}" class="btn btn-primary" target="_blank"><i class="fas fa-print"></i>Print</a>
            @if(Auth::user()->role == 2)
            <a href="{{route('localTourBooking.edit',$localTourPackageBooking->uuid)}}" class="btn btn-primary"><i class="fas fa-edit"></i>Edit</a>
            @endif
        </div>
        <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 style="text-align: center">Invoice</h1>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="invoice-info" style="line-height: 1px">
                                        <img src="{{'/public/TourOperatorsLogos/'.$localTourPackageBooking->tourOperator->company_logo}}" style="width: 300px;height: auto">
                                        <h3 style="font-weight: bolder">{{$localTourPackageBooking->tourOperator->company_name}}</h3>
                                        <p>P.O BOX {{$localTourPackageBooking->tourOperator->postal_code}}</p>
                                        <p>{{$localTourPackageBooking->tourOperator->physical_location}}</p>
                                        <p>{{$tanzaniaRegions[$localTourPackageBooking->tourOperator->region]}}</p>
                                        <p>PHONE: {{$localTourPackageBooking->tourOperator->phone_number}}</p>
                                        <p><a href="{{$localTourPackageBooking->tourOperator->website_url}}">{{$localTourPackageBooking->tourOperator->website_url}}</a></p>
                                        <p><a href="mailto:{{$localTourPackageBooking->tourOperator->email_address}}">{{$localTourPackageBooking->tourOperator->email_address}}</a></p>
                                        <p>TIN NUMBER: {{$localTourPackageBooking->tourOperator->tin_number}}</p>
                                    
        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="pull-right">
                                        <h5>INVOICE</h5>
                                        <p style="color: dodgerblue">{{$localTourPackageBooking->reference_number}}</p>
                                        <h5>Trip name</h5>
                                        <p style="color: dodgerblue">{{$localTourPackageBooking->localTourPackages->touristicAttraction->attraction_name}}</p>
                                        <h5>Trip Id</h5>
                                        <p style="color: dodgerblue">{{$localTourPackageBooking->localTourPackages->package_reference_number}}</p>
                                        <h5>Travel Date</h5>
                                        <p style="color: dodgerblue">{{date('jS M Y',strtotime($localTourPackageBooking->localTourPackages->safari_start_date))}}</p>
                                        <h5>DATE</h5>
                                        <p style="color: dodgerblue">{{date('jS-M-Y')}}</p>
                                        <h5>DUE</h5>
                                        <p style="color: dodgerblue">On Receipt</p>
                                        <h5>PAYMENT MODE</h5>
                                        @if ($localTourPackageBooking->payment_mode == 'fullPayment')
                                            <span class="badge badge-success">Full Payment</span>
                                        @elseif ($localTourPackageBooking->payment_mode == 'partialPayment')
                                            <span class="badge badge-info">Partial Payment</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <div class="invoice-table">
                            <table>
                                <tr>
                                    <td>
                                        <div class="invoice-bill-to">
                                            <h4>BILL TO</h4>
                                            <p>{{$localTourPackageBooking->tourist_name}}</p>
                                            <p>{{$localTourPackageBooking->phone_number}}</p>
                                            <p><a href="mailto:{{$localTourPackageBooking->email_address}}">{{$localTourPackageBooking->email_address}}</a></p>
                                            <p>&checkmark;To be picked up at <span style="color: dodgerblue"> {{$localTourPackageBooking->collectionStop->collection_stop_name}}</span> where each traveller has an increment of price by <span style="color: dodgerblue"> Tsh {{number_format($localTourPackageBooking->collectionStop->collection_stop_price)}}</span></p>
                                            <p>Total Children below age of {{$localTourPackageBooking->localTourPackages->free_of_charge_age}} (Free pass) - {{$localTourPackageBooking->total_free_of_charge_children}} Children registered</p>
        
                                            @if(is_null($localTourPackageBooking->reservation_id))
                                            <div class="alert alert-danger rounded-lg shadow-sm" role="alert">
                                                <p>{{$localTourPackageBooking->tourist_name}} did not select a reservation for this safari.</p>
                                            </div>
                                            @else
                                            <div class="alert alert-success rounded-lg shadow-sm" role="alert">
                                                <p>{{$localTourPackageBooking->tourist_name}} selected <a href="{{$localTourPackageBooking->tourOperatorReservation->reservation_url}}">{{$localTourPackageBooking->tourOperatorReservation->reservation_name}}</a> for this safari.</p>
                                            </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <thead>
                                <tr>
                                    <th>Particular</th>
                                    <th>Category</th>
                                    <th>No of Travellers</th>
                                    <th>Amount Each</th>
                                    <th>Pickup Amount</th>
                                    <th>Total Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td rowspan="4">{{ $localTourPackageBooking->localTourPackages->touristicAttraction->attraction_name }}</td>
                                    <td>Resident Child</td>
                                    <td>{{ $localTourPackageBooking->total_number_local_child }}</td>
                                    <td>&commat;Tsh {{ number_format($localTourPackageBooking->localTourPackages->trip_price_child_tanzanian) }}</td>
                                    @php
                                        $residentChildPrice = (($localTourPackageBooking->total_number_local_child) * ($localTourPackageBooking->localTourPackages->trip_price_child_tanzanian) + ($localTourPackageBooking->collectionStop->collection_stop_price) * ($localTourPackageBooking->total_number_local_child));
                                    @endphp
                                    <td>&commat;Tsh {{number_format($localTourPackageBooking->collectionStop->collection_stop_price)}}</td>
                                    <td>Tsh {{ number_format($residentChildPrice) }}</td>
                                </tr>
                                <tr>
                                    <td>Non Resident Child</td>
                                    <td>{{ $localTourPackageBooking->total_number_foreigner_child }}</td>
                                    <td>&commat;Tsh {{ number_format($localTourPackageBooking->localTourPackages->trip_price_child_foreigner) }}</td>
                                    @php
                                        $nonResidentChildPrice = (($localTourPackageBooking->total_number_foreigner_child) * ($localTourPackageBooking->localTourPackages->trip_price_child_foreigner) + ($localTourPackageBooking->collectionStop->collection_stop_price) * ($localTourPackageBooking->total_number_foreigner_child));
                                    @endphp
                                    <td>&commat;Tsh {{number_format($localTourPackageBooking->collectionStop->collection_stop_price)}}</td>
                                    <td>TSh {{ number_format($nonResidentChildPrice) }}</td>
                                </tr>
                                <tr>
                                    <td>Resident Adult</td>
                                    <td>{{ $localTourPackageBooking->total_number_local_adult }}</td>
                                    <td>&commat;Tsh {{ number_format($localTourPackageBooking->localTourPackages->trip_price_adult_tanzanian) }}</td>
                                    @php
                                        $residentAdultPrice = (($localTourPackageBooking->total_number_local_adult) * ($localTourPackageBooking->localTourPackages->trip_price_adult_tanzanian) + (($localTourPackageBooking->collectionStop->collection_stop_price) * ($localTourPackageBooking->total_number_local_adult)));
                                    @endphp
                                    <td>&commat;Tsh {{number_format($localTourPackageBooking->collectionStop->collection_stop_price)}}</td>
                                    <td>Tsh {{ number_format($residentAdultPrice) }}</td>
                                </tr>
                                <tr>
                                    <td>Non Resident Adult</td>
                                    <td>{{ $localTourPackageBooking->total_number_foreigner_adult }}</td>
                                    <td>&commat;TSh {{ number_format($localTourPackageBooking->localTourPackages->trip_price_adult_foreigner) }}</td>
                                    @php
                                        $nonResidentAdultsPrice = (($localTourPackageBooking->total_number_foreigner_adult) * ($localTourPackageBooking->localTourPackages->trip_price_adult_foreigner) + (($localTourPackageBooking->collectionStop->collection_stop_price) * ($localTourPackageBooking->total_number_foreigner_adult)));
                                    @endphp
                                    <td>&commat;Tsh {{number_format($localTourPackageBooking->collectionStop->collection_stop_price)}}</td>
                                    <td> Tsh {{ number_format($nonResidentAdultsPrice) }}</td>
                                </tr>
                                <tr style="background-color: dodgerblue;color: white;border: 2px solid white">
                                    <td colspan="5">Amount for visiting {{$localTourPackageBooking->localTourPackages->touristicAttraction->attraction_name}}</td>
                                    <?php $totalBillForAnAttraction=$residentChildPrice + $nonResidentChildPrice + $residentAdultPrice + $nonResidentAdultsPrice; ?>
                                    <td> Tsh {{ number_format($totalBillForAnAttraction) }}</td>
                                </tr>
        
                                {{-- Reservations --}}
                                @php
                                    $totalBillForAReservation = 0; // Initialize the variable
                                @endphp
                                @if(!is_null($localTourPackageBooking->reservation_id))
                                    <tr>
                                        <td rowspan="4">{{$localTourPackageBooking->tourOperatorReservation->reservation_name}}</td>
                                        <td>Resident Child</td>
                                        <td>{{$localTourPackageBooking->total_number_local_child }}</td>
                                        <td>&commat;Tsh {{number_format($localTourPackageBooking->tourOperatorReservation->resident_child_price_reservation) }}</td>
                                        @php
                                            $residentChildReservationPrice = (($localTourPackageBooking->total_number_local_child ) * ($localTourPackageBooking->tourOperatorReservation->resident_child_price_reservation));
                                        @endphp
                                        <td>&commat; Tsh 0.00</td>
                                        <td>Tsh {{number_format($residentChildReservationPrice)}}</td>
                                    </tr>
                                    <tr>
                                        <td>Non Resident Child</td>
                                        <td>{{$localTourPackageBooking->total_number_foreigner_child }}</td>
                                        <td>&commat;Tsh {{number_format($localTourPackageBooking->tourOperatorReservation->foreigner_child_price_reservation) }}</td>
                                        @php
                                            $nonResidentChildReservationPrice = (($localTourPackageBooking->total_number_foreigner_child ) * ($localTourPackageBooking->tourOperatorReservation->foreigner_child_price_reservation));
                                        @endphp
                                        <td>&commat; Tsh 0.00</td>
                                        <td>Tsh {{number_format($nonResidentChildReservationPrice)}}</td>
                                    </tr>
                                    <tr>
                                        <td>Resident Adult</td>
                                        <td>{{$localTourPackageBooking->total_number_local_adult }}</td>
                                        <td>&commat;Tsh {{number_format($localTourPackageBooking->tourOperatorReservation->resident_adult_price_reservation) }}</td>
                                        @php
                                            $residentAdultReservationPrice = (($localTourPackageBooking->total_number_local_adult ) * ($localTourPackageBooking->tourOperatorReservation->resident_adult_price_reservation));
                                        @endphp
                                        <td>&commat; Tsh 0.00</td>
                                        <td>Tsh {{number_format($residentAdultReservationPrice)}}</td>
                                    </tr>
                                    <tr>
                                        <td>Non Resident Adult</td>
                                        <td>{{$localTourPackageBooking->total_number_foreigner_adult }}</td>
                                        <td>&commat;Tsh {{number_format($localTourPackageBooking->tourOperatorReservation->foreigner_adult_price_reservation) }}</td>
                                        @php
                                            $nonResidentAdultReservationPrice = (($localTourPackageBooking->total_number_foreigner_adult ) * ($localTourPackageBooking->tourOperatorReservation->foreigner_adult_price_reservation));
                                        @endphp
                                        <td>&commat; Tsh 0.00</td>
                                        <td>Tsh {{number_format($nonResidentAdultReservationPrice)}}</td>
                                    </tr>
                                    <tr style="background-color: dodgerblue; color: white; border: 2px solid white;">
                                        <td colspan="5">Amount for using {{$localTourPackageBooking->tourOperatorReservation->reservation_name}} reservation while visiting {{$localTourPackageBooking->localTourPackages->touristicAttraction->attraction_name}}</td>
                                            <?php
                                            $totalBillForAReservation = $residentChildReservationPrice + $nonResidentChildReservationPrice + $residentAdultReservationPrice + $nonResidentAdultReservationPrice;
                                            ?>
                                        <td> Tsh {{ number_format($totalBillForAReservation) }}</td>
                                    </tr>
        
                                @else
                                    <tr>
                                        
                                        <td colspan="6" style="background-color: navajowhite">No reservation was selected either</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        @php
                        // Initialize traveler counts
                        $residentAdultTravellers = $localTourPackageBooking->total_number_local_adult;
                        $residentChildrenTravellers = $localTourPackageBooking->total_number_local_child;
                        $foreignerChildrenTravellers = $localTourPackageBooking->total_number_foreigner_child;
                        $foreignerAdultTravellers = $localTourPackageBooking->total_number_foreigner_adult;
                        $totalTravellers = ($residentAdultTravellers + $residentChildrenTravellers + $foreignerChildrenTravellers + $foreignerAdultTravellers);
                        $minNumberOfTravellersForDiscount = $localTourPackageBooking->localTourPackages->number_of_people_for_discount;
                        
                        // Determine if discount is applicable
                        $isDiscountEligible = $totalTravellers >= $minNumberOfTravellersForDiscount;
                        
                        // Calculate balance due with or without discount
                        $totalAmount = $totalBillForAnAttraction + $totalBillForAReservation;
                        $balanceDue = $isDiscountEligible
                            ? $totalAmount * (1 - $localTourPackageBooking->localTourPackages->discount_offered / 100)
                            : $totalAmount;
                    
                    @endphp
                    
                    <div class="footer">
                        <div class="invoice-total pull-right">
                            <p><strong style="color: dodgerblue">TOTAL</strong> Tsh {{ number_format($totalAmount) }}</p>
                    
                            <p><strong style="color: dodgerblue">Discount</strong> 
                                @if($isDiscountEligible)
                                    {{ $localTourPackageBooking->localTourPackages->discount_offered }}% (applied)
                                @else
                                    No discount (minimum number of travelers not met)
                                @endif
                            </p>
                    
                            <p><strong style="color: dodgerblue">VAT</strong> Inclusive</p>
                    
                            <p><strong style="color: dodgerblue">BALANCE DUE</strong> TZS {{ number_format($balanceDue) }}</p>
                    
                            <p><strong style="color: dodgerblue">Payment Status</strong> <span class="badge badge-warning">Pending</span></p>
                        </div>
                    </div>
                    
                        
                    </div>
                    <br><br>
                <div class="invoice-footer" style="color: white">
                    <p style="color: white">&copy; {{ date('Y') }} {{ $localTourPackageBooking->tourOperator->company_name }}. All rights reserved.</p>
                    <p style="color: white">Powered by Xplo Safari Book</p>
                  </div>
            </div>
        </div>

        </div>
        
    </div>
@endsection
