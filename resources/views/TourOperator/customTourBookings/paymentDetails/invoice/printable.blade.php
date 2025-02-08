<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$customTourBooking->tourist_name}} Invoice</title>
    <style>
        .page {
            width: 180mm;
            box-sizing: border-box;
            overflow-x: auto;
            font-family: lato, sans-serif;
            page-break-inside: avoid;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #333;
            font-size: 24px;
            margin: 0;
            padding: 0;
        }
        .invoice-info {
            flex-grow: 1;
        }
        .invoice-info h3 {
            margin-top: 0;
            font-size: 20px;
            margin-bottom: 5px;
        }
        .pull-right {
            text-align: right;
            flex-shrink: 0;
        }
        .content {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border-bottom:2px solid gainsboro ;
            padding: 8px;
            text-align: left;
            font-size: 14px;
        }
        th {
            background-color: #f2f2f2;
            font-size: 12px;
        }
        .footer {
            text-align: right;
            font-weight: bold;
            border-top: 1px solid #ddd; /* Add top border */
            margin-top: 20px; /* Increase margin */
        }
        .footer p {
            margin: 5px 0;
        }
        a{
            text-decoration: none;
        }

        @media print {
            .page {
                width: auto;
                margin: 0;
                padding: 0;
            }
            .header {
                margin-bottom: 10px;
            }
            .footer {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
<div class="card">
    <div class="card-body">
        <div class="page">
            <div class="invoice-header" style="text-align: center">
            </div>
            <?php
            $imageData = base64_encode(file_get_contents(base_path('public/public/TourOperatorsLogos/'.$customTourBooking->tourOperator->company_logo)));
            $dataUrl = 'data:image/png;base64,' . $imageData;
            ?>
            <table style="width: 100%">
                <tr>
                    <td style="width: 50%">
                        <div class="card">
                            <div class="card-body">
                                <div class="invoice-info">
                                    <img src="<?php echo $dataUrl; ?>" style="width: 400px; height: 100px">
                                    <h1>{{$customTourBooking->tourOperator->company_name}}</h1>
                                    <p style="font-size: 15px">{{$customTourBooking->tourOperator->region}}</p>
                                    <p style="font-size: 15px">{{$customTourBooking->tourOperator->postal_code}}</p>
                                    <p style="font-size: 15px">{{$customTourBooking->tourOperator->phone_number}}</p>
                                    <p style="font-size: 15px"><a href="{{$customTourBooking->tourOperator->website_url}}">{{$customTourBooking->tourOperator->website_url}}</a></p>
                                    <p style="font-size: 15px"><a href="mailto:{{$customTourBooking->tourOperator->email_address}}">{{$customTourBooking->tourOperator->email_address}}</a></p>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="width: 50%;">
                        <div class="card">
                            <div class="card-body">
                                <div class="pull-right">
                                    <h3>INVOICE</h3>
                                    <p style="font-size: 15px">{{$customTourBooking->reference_number}}</p><br>
                                    <h3>Travel Date</h3>
                                    <p style="font-size: 15px">{{date('jS M Y',strtotime($customTourBooking->start_date))}}</p><br>
                                    <h3>DUE PAYMENT DATE</h3>
                                    <p style="font-size: 15px">{{date('jS M Y',strtotime($customTourBooking->due_payment_time))}}</p>
                                    <br>
                                    <h3>DATE</h3>
                                    <p style="font-size: 15px">{{date('jS-M-Y')}}</p><br>
                                    <h3>DUE</h3>
                                    <p style="font-size: 15px">On Receipt</p><br>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>


            <div class="content">
                <div>
                    <table>
                        <tr>
                            <td>
                                <div class="invoice-bill-to">
                                    <h4>BILL TO</h4>
                                    <p>{{$customTourBooking->tourist_name}}</p>
                                    <p>{{$customTourBooking->tourist_phone_number}}</p>
                                    <p><a href="mailto:{{$customTourBooking->tourist_email_address}}">{{$customTourBooking->tourist_email_address}}</a></p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div>
                    <table>
                        <thead>
                        <tr>
                            <th>PARTICULAR</th>
                            <th>Category</th>
                            <th>No of travellers</th>
                            <th>AMOUNT EACH</th>
                            <th>AMOUNT PER CATEGORY</th>
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
                                        <td>{{ $attraction['attraction_name'] }}</td>
                                        <td>Resident Child</td>
                                        <td>{{ $customTourBooking->total_children_residents }}</td>
                                        <td>Tsh {{ number_format($customTourBookingTourPrice->resident_child_price) }}</td>
                                        @php
                                            $residentChildPrice = ($customTourBooking->total_children_residents) * ($customTourBookingTourPrice->resident_child_price);
                                        @endphp
                                        <td>Tsh {{ number_format($residentChildPrice) }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Non Resident Child</td>
                                        <td>{{ $customTourBooking->total_children_foreigners }}</td>
                                        <td>Tsh {{ number_format($customTourBookingTourPrice->foreigner_child_price) }}</td>
                                        @php
                                            $nonResidentChildPrice = ($customTourBooking->total_children_foreigners) * ($customTourBookingTourPrice->foreigner_child_price);
                                        @endphp
                                        <td>TSh {{ number_format($nonResidentChildPrice) }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Resident Adult</td>
                                        <td>{{ $customTourBooking->total_adult_residents }}</td>
                                        <td>Tsh {{ number_format($customTourBookingTourPrice->resident_adult_price) }}</td>
                                        @php
                                            $residentAdultPrice = ($customTourBooking->total_adult_residents) * ($customTourBookingTourPrice->resident_adult_price);
                                        @endphp
                                        <td>Tsh {{ number_format($residentAdultPrice) }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
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
                                    <td style="width: 30%">{{$reservation->touristicAttraction->attraction_name}} - {{$reservation->tourOperatorReservation->reservation_name}} (Reservation)</td>
                                    <td>Resident Child</td>
                                    <td>{{$customTourBooking->total_children_residents}}</td>
                                    <td>Tsh {{number_format($reservation->tourOperatorReservation->resident_child_price_reservation)}}</td>
                                    @php
                                        $residentChildReservationPrice=($customTourBooking->total_children_residents) * ($reservation->tourOperatorReservation->resident_child_price_reservation);
                                    @endphp
                                    <td>Tsh {{number_format($residentChildReservationPrice)}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Non Resident Child</td>
                                    <td>{{$customTourBooking->total_children_foreigners}}</td>
                                    <td>Tsh {{number_format($reservation->tourOperatorReservation->foreigner_child_price_reservation)}}</td>
                                    @php
                                        $nonResidentChildReservationPrice=($customTourBooking->total_children_foreigners) * ($reservation->tourOperatorReservation->foreigner_child_price_reservation);
                                    @endphp
                                    <td>Tsh {{number_format($nonResidentChildReservationPrice)}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Resident Adult</td>
                                    <td>{{$customTourBooking->total_adult_residents}}</td>
                                    <td>Tsh {{number_format($reservation->tourOperatorReservation->resident_adult_price_reservation)}}</td>
                                    @php
                                        $residentAdultReservationPrice=($customTourBooking->total_adult_residents) * ($reservation->tourOperatorReservation->resident_adult_price_reservation);
                                    @endphp
                                    <td>Tsh {{number_format($residentAdultReservationPrice)}}</td>
                                </tr>
                                <tr>
                                    <td></td>
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
                                <td colspan="5" style="text-align: center">No reservation was selected</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="footer">
                <div class="invoice-total">
                    <p style="font-size: 14px"><strong style="color: dodgerblue">TOTAL</strong> Tsh {{number_format($totalBillForAllAttractions + $totalBillForAllReservations)}}</p>
                    <p style="font-size: 14px"><strong style="color: dodgerblue">Discount</strong> {{$customTourBooking->discount}}%</p>
                    <p style="font-size: 14px"><strong style="color: dodgerblue">VAT</strong> Inclusive</p>
                    <p style="font-size: 14px">
                        @php
                            $balanceDue = $totalBillForAllAttractions + $totalBillForAllReservations - ($totalBillForAllAttractions + $totalBillForAllReservations) * ($customTourBooking->discount / 100);
                        @endphp
                        <strong style="color: dodgerblue">BALANCE DUE</strong> TZS {{number_format($balanceDue)}}
                    </p>
                </div>
                <br><br>
                <p style="text-align: center;">"Thanks for using Xafari Explore. We are just being useful by thinking differently" <br> &copy;{{date('Y')}}</p>

            </div>
        </div>
    </div>
</div>
</body>
</html>
