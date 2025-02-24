<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$localTourPackageBooking->tourist_name}} Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .page {
            width: 180mm;
            box-sizing: border-box;
            overflow-x: auto;
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
        .invoice-info h3 {
            margin-top: 0;
            font-size: 20px;
            margin-bottom: 5px;
        }
        .pull-right {
            text-align: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 2px solid black;
            padding: 8px;
            text-align: left;
            font-size: 13px;
        }
        th {
            background-color: #f2f2f2;
            font-size: 12px;
        }
        .footer {
            text-align: right;
            margin-top: 20px; 
        }
        .footer p {
            margin: 5px 0;
        }
        a {
            text-decoration: none;
            color: dodgerblue;
        }
        @media print {
            .page {
                width: auto;
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body>
<?php
$imageData = base64_encode(file_get_contents(base_path('public/public/TourOperatorsLogos/'.$localTourPackageBooking->tourOperator->company_logo)));
$dataUrl = 'data:image/png;base64,' . $imageData;
?>
<table style="width: 100%">
    <tr>
        <td style="width: 10%;">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-info">
                        <img src="<?php echo $dataUrl; ?>" style="width: 300px; height: auto">
                    </div>
                </div>
            </div>
        </td>
        <td style="width: 40%">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-info">
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
            </div>
        </td>
        <td style="width: 10%;">
            <div class="card">
                <div class="card-body">
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
        </td>
    </tr>
</table>

<div class="card">
    <div class="card-body">
            <div>
                <table>
                    <tr>
                        <td>
                            <div class="invoice-bill-to">
                                <h4>BILL TO</h4>
                                    <p>{{$localTourPackageBooking->tourist_name}}</p>
                                    <p>{{$localTourPackageBooking->phone_number}}</p>
                                    <p><a href="mailto:{{$localTourPackageBooking->email_address}}">{{$localTourPackageBooking->email_address}}</a></p>
                                    <p>To be picked up at <span style="color: dodgerblue"> {{$localTourPackageBooking->collectionStop->collection_stop_name}}</span> where each traveller has an increment of price by <span style="color: dodgerblue"> Tsh {{number_format($localTourPackageBooking->collectionStop->collection_stop_price)}}</span></p>
                                    <p>Total Children below age of {{$localTourPackageBooking->localTourPackages->free_of_charge_age}} (Free pass) - {{$localTourPackageBooking->total_free_of_charge_children}} Children registered</p>

                                @if(is_null($localTourPackageBooking->reservation_id))
                                    <div class="alert alert-danger rounded-lg shadow-sm" role="alert">
                                        <p style="background-color: navajowhite">{{$localTourPackageBooking->tourist_name}} did not select a reservation for this safari.</p>
                                    </div>
                                    @else
                                    <div class="alert alert-success rounded-lg shadow-sm" role="alert">
                                        <p style="background-color: navajowhite">{{$localTourPackageBooking->tourist_name}} selected <a href="{{$localTourPackageBooking->tourOperatorReservation->reservation_url}}">{{$localTourPackageBooking->tourOperatorReservation->reservation_name}}</a> for this safari.</p>
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
                        <th>Travellers</th>
                        <th>Amount Each</th>
                        <th>Pickup Amount</th>
                        <th>Total Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $localTourPackageBooking->localTourPackages->touristicAttraction->attraction_name }}</td>
                        <td>Resident Child</td>
                        <td>{{number_format($localTourPackageBooking->total_number_local_child) }}</td>
                        <td>@ Tsh {{ number_format($localTourPackageBooking->localTourPackages->trip_price_child_tanzanian) }}</td>
                        <?php
                        $residentChildPrice = (($localTourPackageBooking->total_number_local_child) * ($localTourPackageBooking->localTourPackages->trip_price_child_tanzanian) + ($localTourPackageBooking->collectionStop->collection_stop_price) * ($localTourPackageBooking->total_number_local_child));
                        ?>
                        <td>@ Tsh {{number_format($localTourPackageBooking->collectionStop->collection_stop_price)}}</td>
                        <td>Tsh {{ number_format($residentChildPrice) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Non Resident Child</td>
                        <td>{{number_format( $localTourPackageBooking->total_number_foreigner_child) }}</td>
                        <td>@ Tsh {{ number_format($localTourPackageBooking->localTourPackages->trip_price_child_foreigner) }}</td>
                        <?php
                        $nonResidentChildPrice = (($localTourPackageBooking->total_number_foreigner_child) * ($localTourPackageBooking->localTourPackages->trip_price_child_foreigner) + ($localTourPackageBooking->collectionStop->collection_stop_price) * ($localTourPackageBooking->total_number_foreigner_child));
                        ?>
                        <td>@ Tsh {{number_format($localTourPackageBooking->collectionStop->collection_stop_price)}}</td>
                        <td>TSh {{ number_format($nonResidentChildPrice) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Resident Adult</td>
                        <td>{{number_format($localTourPackageBooking->total_number_local_adult) }}</td>
                        <td>@ Tsh {{ number_format($localTourPackageBooking->localTourPackages->trip_price_adult_tanzanian) }}</td>
                        <?php
                        $residentAdultPrice = (($localTourPackageBooking->total_number_local_adult) * ($localTourPackageBooking->localTourPackages->trip_price_adult_tanzanian) + (($localTourPackageBooking->collectionStop->collection_stop_price) * ($localTourPackageBooking->total_number_local_adult)));
                        ?>
                        <td>@ Tsh {{number_format($localTourPackageBooking->collectionStop->collection_stop_price)}}</td>
                        <td>Tsh {{ number_format($residentAdultPrice) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Non Resident Adult</td>
                        <td>{{number_format($localTourPackageBooking->total_number_foreigner_adult) }}</td>
                        <td>@ TSh {{ number_format($localTourPackageBooking->localTourPackages->trip_price_adult_foreigner) }}</td>
                        <?php
                        $nonResidentAdultsPrice = (($localTourPackageBooking->total_number_foreigner_adult) * ($localTourPackageBooking->localTourPackages->trip_price_adult_foreigner) + (($localTourPackageBooking->collectionStop->collection_stop_price) * ($localTourPackageBooking->total_number_foreigner_adult)));
                        ?>
                        <td>@ Tsh {{number_format($localTourPackageBooking->collectionStop->collection_stop_price)}}</td>
                        <td> Tsh {{ number_format($nonResidentAdultsPrice) }}</td>
                    </tr>
                    <tr style="background-color: dodgerblue;color: white;border: 2px solid white">
                        <td colspan="5">Amount for visiting {{$localTourPackageBooking->localTourPackages->touristicAttraction->attraction_name}}</td>
                        <?php $totalBillForAnAttraction=$residentChildPrice + $nonResidentChildPrice + $residentAdultPrice + $nonResidentAdultsPrice; ?>
                        <td> Tsh {{ number_format($totalBillForAnAttraction) }}</td>
                    </tr>
                    <?php
                    $totalBillForAReservation = 0;
                    ?>
                        @if(!is_null($localTourPackageBooking->reservation_id))
                        <tr>
                            <td>{{$localTourPackageBooking->tourOperatorReservation->reservation_name}}</td>
                            <td>Resident Child</td>
                            <td>{{number_format($localTourPackageBooking->total_number_local_child) }}</td>
                            <td>@ Tsh {{number_format($localTourPackageBooking->tourOperatorReservation->resident_child_price_reservation) }}</td>
                                <?php
                                $residentChildReservationPrice = (($localTourPackageBooking->total_number_local_child ) * ($localTourPackageBooking->tourOperatorReservation->resident_child_price_reservation));
                                ?>
                            <td>@ Tsh 0.00</td>
                            <td>Tsh {{number_format($residentChildReservationPrice)}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Non Resident Child</td>
                            <td>{{number_format($localTourPackageBooking->total_number_foreigner_child) }}</td>
                            <td>@ Tsh {{number_format($localTourPackageBooking->tourOperatorReservation->foreigner_child_price_reservation) }}</td>
                                <?php
                                $nonResidentChildReservationPrice = (($localTourPackageBooking->total_number_foreigner_child ) * ($localTourPackageBooking->tourOperatorReservation->foreigner_child_price_reservation));
                                ?>
                            <td>@ Tsh 0.00</td>
                            <td>Tsh {{number_format($nonResidentChildReservationPrice)}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Resident Adult</td>
                            <td>{{number_format($localTourPackageBooking->total_number_local_adult) }}</td>
                            <td>@ Tsh {{number_format($localTourPackageBooking->tourOperatorReservation->resident_adult_price_reservation) }}</td>
                                <?php
                                $residentAdultReservationPrice = (($localTourPackageBooking->total_number_local_adult ) * ($localTourPackageBooking->tourOperatorReservation->resident_adult_price_reservation));
                                ?>
                            <td>@ Tsh 0.00</td>
                            <td>Tsh {{number_format($residentAdultReservationPrice)}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Non Resident Adult</td>
                            <td>{{number_format($localTourPackageBooking->total_number_foreigner_adult) }}</td>
                            <td>@ Tsh {{number_format($localTourPackageBooking->tourOperatorReservation->foreigner_adult_price_reservation) }}</td>
                                <?php
                                $nonResidentAdultReservationPrice = (($localTourPackageBooking->total_number_foreigner_adult ) * ($localTourPackageBooking->tourOperatorReservation->foreigner_adult_price_reservation));
                                ?>
                            <td>@ Tsh 0.00</td>
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
        <p><strong style="color: dodgerblue">TOTAL:</strong> Tsh {{ number_format($totalAmount) }}</p>

        <p><strong style="color: dodgerblue">Discount:</strong>
            @if($isDiscountEligible)
                {{ $localTourPackageBooking->localTourPackages->discount_offered }}% (applied)
            @else
                No discount (minimum number of travelers not met)
            @endif
        </p>

        <p><strong style="color: dodgerblue">VAT:</strong> Inclusive</p>

        <p><strong style="color: dodgerblue">BALANCE DUE:</strong> TZS {{ number_format($balanceDue) }}</p>


        <p><strong style="color: dodgerblue">Payment Status:</strong> <span class="badge badge-warning">Pending</span></p>
    </div>
</div>

        <br><br>
        <div class="invoice-footer">
            <p>&copy; {{ date('Y') }} {{ $localTourPackageBooking->tourOperator->company_name }}. All rights reserved.</p>
            <p>Powered by Xplo Safari Book</p>
          </div>
        </div>
    </div>
</body>
</html>
