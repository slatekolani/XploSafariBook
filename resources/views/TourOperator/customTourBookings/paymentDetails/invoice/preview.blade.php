@extends('layouts.main', ['title' => __("Invoice"), 'header' => __('Invoice')])
@include('includes.validate_assets')
@section('content')
    <div class="invoice-container">
        <div style="text-align: center;padding-bottom: 10px">
            <a href="{{route('customTourBookings.printInvoice',$customTourBooking->uuid)}}" class="btn btn-primary"><i class="fas fa-print"></i>Print</a>
            <a href="{{route('customTourBookings.edit',$customTourBooking->uuid)}}" class="btn btn-primary"><i class="fas fa-edit"></i>Edit</a>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="invoice-header">
                    <h1>Invoice</h1>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="invoice-info">
                                <img src="{{'/public/TourOperatorsLogos/'.$customTourBooking->tourOperator->company_logo}}" style="width: 300px;height: 70px">
                                <h3 style="font-weight: bolder">{{$customTourBooking->tourOperator->company_name}}</h3>
                                <p style="font-weight: bolder">Bank Information</p>
                                <p><a href="mailto:{{$customTourBooking->tourOperator->email_address}}">{{$customTourBooking->tourOperator->email_address}}</a></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pull-right">
                                <h5>INVOICE</h5>
                                <p style="color: dodgerblue">{{$customTourBooking->reference_number}}</p>
                                <h5>DATE</h5>
                                <p style="color: dodgerblue">{{date('jS-M-Y')}}</p>
                                <h5>DUE PAYMENT DATE</h5>
                                <p style="color: dodgerblue">{{date('jS M Y',strtotime($customTourBooking->due_payment_time))}}</p>
                                <h5>DUE</h5>
                                <p style="color: dodgerblue">On Receipt</p>
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
                                    <p>{{$customTourBooking->tourist_name}}</p>
                                    <p>{{$customTourBooking->phone_number}}</p>
                                    <p><a href="mailto:{{$customTourBooking->tourist_email_address}}">{{$customTourBooking->tourist_email_address}}</a></p>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <thead>
                        <tr>
                            <th>PARTICULAR</th>
                            <th>Category</th>
                            <th>No of travellers</th>
                            <th>AMOUNT EACH</th>
                            <th>TOTAL AMOUNT PER CATEGORY</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $totalBillForAllAttractions = 0;
                            $totalBillForAllReservations = 0;
                        @endphp

                        @forelse ($customTourBooking->CustomTourBookingTouristAttractionLabel as $attraction)
                            @php
                                $attractionTotal = 0;
                                $tourPricesForAttraction = $customTourBookingTourPrices->where('attraction_id', $attraction['id']);
                            @endphp

                            @foreach ($tourPricesForAttraction as $customTourBookingTourPrice)
                                @if ($customTourBookingTourPrice)
                                    <tr>
                                        <td rowspan="4">{{ $attraction['attraction_name'] }}</td>
                                        <td>Resident Child</td>
                                        <td>{{ $customTourBooking->total_children_residents }}</td>
                                        <td>Tsh {{ number_format($customTourBookingTourPrice->resident_child_price) }}</td>
                                        @php
                                            $residentChildPrice = ($customTourBooking->total_children_residents) * ($customTourBookingTourPrice->resident_child_price);
                                        @endphp
                                        <td>Tsh {{ number_format($residentChildPrice) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Non Resident Child</td>
                                        <td>{{ $customTourBooking->total_children_foreigners }}</td>
                                        <td>Tsh {{ number_format($customTourBookingTourPrice->foreigner_child_price) }}</td>
                                        @php
                                            $nonResidentChildPrice = ($customTourBooking->total_children_foreigners) * ($customTourBookingTourPrice->foreigner_child_price);
                                        @endphp
                                        <td>TSh {{ number_format($nonResidentChildPrice) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Resident Adult</td>
                                        <td>{{ $customTourBooking->total_adult_residents }}</td>
                                        <td>Tsh {{ number_format($customTourBookingTourPrice->resident_adult_price) }}</td>
                                        @php
                                            $residentAdultPrice = ($customTourBooking->total_adult_residents) * ($customTourBookingTourPrice->resident_adult_price);
                                        @endphp
                                        <td>Tsh {{ number_format($residentAdultPrice) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Non Resident Adult</td>
                                        <td>{{ $customTourBooking->total_adult_foreigners }}</td>
                                        <td>TSh {{ number_format($customTourBookingTourPrice->foreigner_adult_price) }}</td>
                                        @php
                                            $nonResidentAdultsPrice = ($customTourBooking->total_adult_foreigners) * ($customTourBookingTourPrice->foreigner_adult_price);
                                        @endphp
                                        <td> Tsh {{ number_format($nonResidentAdultsPrice) }}</td>
                                    </tr>
                                    <tr style="background-color: dodgerblue;color: white;border: 2px solid white">
                                        <td colspan="4">Total bill for visiting {{ $attraction['attraction_name'] }}</td>
                                        @php
                                            $totalBillForAnAttraction = $residentChildPrice + $nonResidentChildPrice + $residentAdultPrice + $nonResidentAdultsPrice;
                                            $attractionTotal += $totalBillForAnAttraction;
                                        @endphp
                                        <td> Tsh {{ number_format($totalBillForAnAttraction) }}</td>
                                    </tr>
                                @endif
                            @endforeach

                            @php
                                $totalBillForAllAttractions += $attractionTotal;
                            @endphp
                        @empty
                        @endforelse

                        @if ($customTourBooking->reservation_needed == 1)
                            @foreach ($attractionReservations as $reservation)
                                <tr>
                                    <td rowspan="4" style="width: 30%">{{$reservation->touristicAttraction->attraction_name}} - {{$reservation->tourOperatorReservation->reservation_name}} (Reservation)</td>
                                    <td>Resident Child</td>
                                    <td>{{$customTourBooking->total_children_residents}}</td>
                                    <td>Tsh {{number_format($reservation->tourOperatorReservation->resident_child_price_reservation)}}</td>
                                    @php
                                        $residentChildReservationPrice=($customTourBooking->total_children_residents) * ($reservation->tourOperatorReservation->resident_child_price_reservation);
                                    @endphp
                                    <td>Tsh {{number_format($residentChildReservationPrice)}}</td>
                                </tr>
                                <tr>
                                    <td>Non Resident Child</td>
                                    <td>{{$customTourBooking->total_children_foreigners}}</td>
                                    <td>Tsh {{number_format($reservation->tourOperatorReservation->foreigner_child_price_reservation)}}</td>
                                    @php
                                        $nonResidentChildReservationPrice=($customTourBooking->total_children_foreigners) * ($reservation->tourOperatorReservation->foreigner_child_price_reservation);
                                    @endphp
                                    <td>Tsh {{number_format($nonResidentChildReservationPrice)}}</td>
                                </tr>
                                <tr>
                                    <td>Resident Adult</td>
                                    <td>{{$customTourBooking->total_adult_residents}}</td>
                                    <td>Tsh {{number_format($reservation->tourOperatorReservation->resident_adult_price_reservation)}}</td>
                                    @php
                                        $residentAdultReservationPrice=($customTourBooking->total_adult_residents) * ($reservation->tourOperatorReservation->resident_adult_price_reservation);
                                    @endphp
                                    <td>Tsh {{number_format($residentAdultReservationPrice)}}</td>
                                </tr>
                                <tr>
                                    <td>Non Resident Adult</td>
                                    <td>{{$customTourBooking->total_adult_foreigners}}</td>
                                    <td>Tsh {{number_format($reservation->tourOperatorReservation->foreigner_adult_price_reservation)}}</td>
                                    @php
                                        $nonResidentAdultReservationPrice=($customTourBooking->total_adult_foreigners) * ($reservation->tourOperatorReservation->foreigner_adult_price_reservation);
                                    @endphp
                                    <td>Tsh {{number_format($nonResidentAdultReservationPrice)}}</td>
                                </tr>
                                <tr style="background-color: dodgerblue;color: white;border: 2px solid white">
                                    <td colspan="4">Total bill for {{$reservation->tourOperatorReservation->reservation_name}} (Reservation) - safari to  {{$reservation->touristicAttraction->attraction_name}}</td>
                                    @php
                                        $totalBillForReservation=$residentAdultReservationPrice + $nonResidentAdultReservationPrice + $nonResidentChildReservationPrice + $residentChildReservationPrice;
                                        $totalBillForAllReservations += $totalBillForReservation;
                                    @endphp
                                    <td>Tsh {{number_format($totalBillForReservation)}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" style="text-align: center">No reservation was selected</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="footer">
                    <div class="invoice-total pull-right">
                        <p><strong style="color: dodgerblue">TOTAL</strong> Tsh {{number_format($totalBillForAllAttractions + $totalBillForAllReservations)}}</p>
                        <p><strong style="color: dodgerblue">Discount</strong> {{$customTourBooking->discount}}%</p>
                        <p><strong style="color: dodgerblue">VAT</strong> Inclusive</p>
                        <p>
                            @php
                                $balanceDue = $totalBillForAllAttractions + $totalBillForAllReservations - ($totalBillForAllAttractions + $totalBillForAllReservations) * ($customTourBooking->discount / 100);
                            @endphp
                            <strong style="color: dodgerblue">BALANCE DUE</strong> TZS {{number_format($balanceDue)}}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
