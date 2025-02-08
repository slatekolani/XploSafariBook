    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <a href="{{ route('touristicAttraction.show', $localTourPackage->touristicAttraction->uuid) }}"
            class="attraction-link" data-toggle="tooltip" data-placement="top"
            data-attraction-id="{{ $localTourPackage->touristicAttraction->id }}"
            style="color: dodgerblue; font-weight: bold; font-size: 15px"
            title="{{ $localTourPackage->touristicAttraction->attraction_description }}">
            <i class="fas fa-map-marker-alt"></i> {{ $localTourPackage->touristicAttraction->attraction_name }}
            &rightsquigarrow;
        </a>
        <h5 class="card-title" style="font-size: 14px;font-weight: bold"></h5>
        <p>{{ $localTourPackage->safari_description }}</p>
        @switch($localTourPackage->trip_kind)
            @case('dayAdventure')
                <p><a href="{{route('localTourPackage.TripKind',$localTourPackage->trip_kind)}}" title="Trip conducted normal days">Day Adventure</a></p>
            @break

            @case('weekendGateway')
                <p><a href="{{route('localTourPackage.TripKind',$localTourPackage->trip_kind)}}" title="Trip to be conducted on weekend">Weekend Gateway</a></p>
            @break

            @case('weekLongAdventure')
                <p><a href="{{route('localTourPackage.TripKind',$localTourPackage->trip_kind)}}" title="Trip to be conducted in a weekly timeframe">Week Long Adventure</a></p>
            @break
        @endswitch



        <h5 class="card-title"
            style="font-size: 14px; font-weight: bold; border-bottom: 2px solid gainsboro; border-bottom-style: dotted">
            <i class="fas fa-bullseye" style="color: dodgerblue; margin-right: 8px;"></i>
            Safari targeted audience & event
        </h5>

        <p>An <a href="{{ route('tourPackageType.spotLocalSafaris', $localTourPackage->tourPackageType->uuid) }}"
                class="event-link" data-toggle="tooltip" data-placement="top"
                data-attraction-id="{{ $localTourPackage->tourPackageType->id }}" style="color: dodgerblue"
                title="{{ $localTourPackage->tourPackageType->tour_package_type_description }}">{{ $localTourPackage->tourPackageType->tour_package_type_name }}</a>
            special for <a href="{{ route('event.spotLocalSafaris', $localTourPackage->tanzaniaAndWorldEvent->uuid) }}"
                class="event-link" data-toggle="tooltip" data-placement="top"
                data-attraction-id="{{ $localTourPackage->tanzaniaAndWorldEvent->id }}" style="color: dodgerblue"
                title="{{ $localTourPackage->tanzaniaAndWorldEvent->event_description }}">{{ $localTourPackage->tanzaniaAndWorldEvent->event_name }}
            </a> ... (<a
                href="{{ route('tourType.spotLocalSafaris', $localTourPackage->tourType->uuid) }}">{{ $localTourPackage->tourType->tour_type_name }}</a>)
        </p>
        <p>Children below the age of <b style="color: dodgerblue">{{ $localTourPackage->free_of_charge_age }}</b> are
            not charged for this safari.</p>
        <p>The age range for this safari is <b style="color: dodgerblue">{{ $localTourPackage->travel_age_range }}</b>,
            except for children under {{ $localTourPackage->free_of_charge_age }}, who require intensive care and are
            free of charge.</p>

        <h5 class="card-title"
            style="font-size: 14px; font-weight: bold; border-bottom: 2px solid gainsboro; border-bottom-style: dotted">
            <i class="fas fa-cogs" style="color: green; margin-right: 8px;"></i>
            Safari capability
        </h5>

        <p>This safari can accommodate only <span
                class="badge badge-success badge-pill">{{ number_format($localTourPackage->maximum_travellers) }}
                travellers</span></p>
        <div class="d-inline">
            <p class="d-inline mr-2">Seats Booked: <span
                    class="badge badge-info badge-pill">{{ number_format($localTourPackage->NumberOfBookedSpacesLabel) }}
                    seats booked </span></p>
            <p class="d-inline">Seats Left: <span
                    class="badge badge-danger badge-pill">{{ number_format($localTourPackage->TotalSpacesRemainedLabel) }}
                    seats left</span></p>
        </div><br><br>


        <h5 class="card-title"
            style="font-size: 14px; font-weight: bold; border-bottom: 2px solid gainsboro; border-bottom-style: dotted">
            <i class="fas fa-calendar" style="color: dodgerblue; margin-right: 8px;"></i>
            Safari Dates
        </h5>

        <p>Starts from <b>{{ date('jS M Y', strtotime($localTourPackage->safari_start_date)) }}</b> to
            <b>{{ date('jS M Y', strtotime($localTourPackage->safari_end_date)) }}</b>
        </p>
        @if ($localTourPackage->CountDownDaysForLocalTourPackageTripLabel >= 0)
            <p>{!! $localTourPackage->CountDownDaysForLocalTourPackageTripLabel !!} ~ Book Now! A lifetime experience awaits...</p>
        @else
            <span class="badge badge-danger badge-pill">Expired</span>
        @endif
        <div style="display: flex">
            <p>Payment Deadline <b
                    style="color: red">{{ date('jS M Y', strtotime($localTourPackage->payment_deadline)) }}</b> ~
                @if ($localTourPackage->CountDownDaysForLocalTourPackagePaymentLabel >= 0)
                    <p>{!! $localTourPackage->CountDownDaysForLocalTourPackagePaymentLabel !!} to payment deadline</p>
                @endif
            </p>

        </div>
        <p>You have to pay first <span style="color: dodgerblue">{{ $localTourPackage->payment_start_percent }}%</span>
            of the whole amount for the this tour agent to get confident with your safari to get conducted </p>
        <p> <b>Tour till conducted Plan</b> ~
            <a
                href="{{ route('localTourPackage.spotLocalTourPackagePlans', $localTourPackage->package_range) }}">{{ $localTourPackagePackageRangeName }}</a>
        </p>

        <h5 class="card-title"
            style="font-size: 14px; font-weight: bold; border-bottom: 2px solid gainsboro; border-bottom-style: dotted">
            <i class="fas fa-bicycle" style="color: green; margin-right: 8px;"></i>
            Activities
        </h5>

        <p>These are the activities that will be included in this tour</p>
        <div class="table-responsive">
            <table class="table" style="min-width: 600px;overflow-x: scroll;font-size:13px">
                <tr>
                    <th>Activity name</th>
                    <th>Activity description</th>
                </tr>
                @forelse($localTourActivities as $localTourActivity)
                    <tr>
                        <td><p>{{ $localTourActivity->activity_name }}</p></td>
                        <td><p>{{ $localTourActivity->activity_description }}</p></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">It appears that tour activities are yet to be added. Please wait!</td>
                    </tr>
                @endforelse
            </table>
        </div>
        <br>
        <h5 class="card-title"
            style="font-size: 14px; font-weight: bold; border-bottom: 2px solid gainsboro; border-bottom-style: dotted">
            <i class="fas fa-dollar-sign" style="color: #28a745; margin-right: 8px;"></i>
            Tour prices
        </h5>

        <p>These are the tour prices for <a
                href="{{ route('touristicAttraction.show', $localTourPackage->touristicAttraction->uuid) }}"
                class="attraction-link" data-toggle="tooltip" data-placement="top"
                data-attraction-id="{{ $localTourPackage->touristicAttraction->id }}" style="color: dodgerblue"
                title="{{ $localTourPackage->touristicAttraction->attraction_description }}">{{ $localTourPackage->touristicAttraction->attraction_name }}</a>
        </p>

        <div class="table-responsive">
            <table class="table" style="min-width: 600px;font-size:13px">
                <tr>
                    <th>Resident child</th>
                    <th>Resident adult</th>
                    <th>Non resident child</th>
                    <th>Non resident adult</th>
                </tr>
                <tr>
                    <td><p>T shs {{ number_format($localTourPackage->trip_price_child_tanzanian) }}</p></td>
                    <td><p>T shs {{ number_format($localTourPackage->trip_price_adult_tanzanian) }}</p></td>
                    <td><p>T shs {{ number_format($localTourPackage->trip_price_child_foreigner) }}</p></td>
                    <td><p>T shs {{ number_format($localTourPackage->trip_price_adult_foreigner) }}</p></td>
                </tr>
            </table>
        </div>
        <h5 class="card-title"
            style="font-size: 14px;font-weight: bold;border-bottom:2px solid gainsboro;border-bottom-style: dotted">
            <i class="fas fa-percent" style="margin-right: 8px;"></i>
            Discount of <span style="color: dodgerblue">{{$localTourPackage->discount_offered}}%</span> are offered when the total number of travelers you have booked for reaches <span style="color: dodgerblue">{{$localTourPackage->number_of_people_for_discount}} people</span> or more.

        </h5>
        <br>
        <h5 class="card-title"
            style="font-size: 14px; font-weight: bold; border-bottom: 2px solid gainsboro; border-bottom-style: dotted">
            <i class="fas fa-map-marker-alt" style="color: #007bff; margin-right: 8px;"></i>
            Collection Stations and Their Additional Prices
        </h5>

        <p>These amounts will be added to your tour price</p>
        <div class="table-responsive">
            <table class="table" style="min-width: 600px;font-size:13px">
                <tr>
                    <th>Collection stop</th>
                    <th>Pick up time</th>
                    <th>Added amount</th>
                </tr>
                @forelse($localTourCollectionStations as $localTourCollectionStation)
                    <tr>
                        <td><i
                                class="fas fa-map-marker-alt"></i><p>{{ $localTourCollectionStation->collection_stop_name }}</p>
                        </td>
                        <td><i
                                class="fas fa-clock"></i><p>{{ date('H:i a', strtotime($localTourCollectionStation->pick_up_time)) }}</p>
                        </td>
                        <td><p>T shs {{ number_format($localTourCollectionStation->collection_stop_price) }}</p></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2"><p>It seems that collection stops are yet to be added. Please wait!</p></td>
                    </tr>
                @endforelse
            </table>
        </div>
        <br>
        <div style="display: flex;">
            <!-- First Table - Transports used -->
            <div class="table-responsive">
                <table style="margin-right: 20px;min-width: 600px;font-size:13px" class="table">
                    <thead>
                        <tr>
                            <th>
                                <i class="fas fa-bus" style="color: #007bff; margin-right: 8px;"></i>
                                Transports used
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($localTourPackage->LocalTourPackageTransportsLabel as $transports)
                            <tr>
                                <td style="list-style: none;margin-left: 0;"> <i
                                        class="{{ $transports['transport_icon'] }}"
                                        style="font-size:20px;color:dodgerblue"></i>
                                    <p>{{ $transports['transport_name'] }}</p></td>
                            </tr>
                        @empty
                        @endforelse

                    </tbody>
                </table>
            </div>

            <!-- Second Table - Special attention capability -->

            <div class="table-responsive">
                <table style="margin-right: 20px;min-width: 600px;font-size:13px" class="table">
                    <thead>
                        <tr>
                            <th>
                                <i class="fas fa-exclamation-circle" style="color: #ff5733; margin-right: 8px;"></i>
                                Safari Special Attention
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($localTourPackage->LocalTourPackageSpecialNeedsLabel as $specialNeeds)
                            <tr>
                                <td style="list-style: none;margin-left: 0;"><i
                                        class="{{ $specialNeeds['special_need_icon'] }}"
                                        style="font-size:20px;color:dodgerblue"></i>
                                    <p>{{ $specialNeeds['special_need_name'] }}</p> </td>
                            </tr>
                        @empty
                            <tr>
                                <td><p>No special needs added</p></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div style="display: flex;">
            <div class="table-responsive">
                <table style="margin-right: 20px;min-width: 600px;font-size:13px" class="table">
                    <thead>
                        <tr>
                            <th>
                                <i class="fas fa-tags" style="color: #007bff; margin-right: 8px;"></i>
                                Tour Price Inclusive Items
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($localTourPackagePriceInclusiveItems as $localTourPackagePriceInclusiveItem)
                            <tr>
                                <td><p>{{ $localTourPackagePriceInclusiveItem->item }}</p></td>
                            </tr>
                        @empty
                            <tr>
                                <td><p>No price inclusive item added</p></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Second Table - Price Exclusive items-->
            <div class="table-responsive">
                <table style="margin-right: 20px;min-width: 600px;font-size:13px" class="table">
                    <thead>
                        <tr>
                            <th>
                                <i class="fas fa-times-circle" style="color: #dc3545; margin-right: 8px;"></i>
                                Tour Price Exclusive Items
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($localTourPackagePriceExclusiveItems as $localTourPackagePriceExclusiveItem)
                            <tr>
                                <td><p>{{ $localTourPackagePriceExclusiveItem->item }}</p></td>
                            </tr>
                        @empty
                            <tr>
                                <td><p>No price exclusive items added</p></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <h5 class="card-title"
            style="font-size: 14px;font-weight: bold;border-bottom:2px solid gainsboro;border-bottom-style: dotted">
            <i class="fas fa-briefcase" style="margin-right: 8px;"></i>
            What to bring on this tour?
        </h5>

        <div class="table-responsive">
            <table style="margin-right: 20px;min-width: 600px;font-size:13px" class="table">
                <thead>
                    <tr>
                        <th>Requirement</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($localTourPackageRequirements as $localTourPackageRequirement)
                        <tr>
                            <td><p>{{ $localTourPackageRequirement->requirement_name }}</p></td>
                            <td><p>{{ $localTourPackageRequirement->requirement_description }}</p></td>
                        </tr>
                    @empty
                        <tr>
                            <td><p>No Requirement added</p></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <br>

        <h5 class="card-title"
            style="font-size: 14px;font-weight: bold;border-bottom:2px solid gainsboro;border-bottom-style: dotted">
            <i class="fas fa-file-alt" style="margin-right: 8px;color:dodgerblue"></i>
            Cancellation policy
        </h5>

        <p>{{ $localTourPackage->cancellation_policy }}</p>
        <p>Read more on <a
                href="{{ asset('public/companyTermsAndConditions/' . $localTourPackage->tourOperator->terms_and_conditions) }}"
                target="_blank">terms and conditions</a> of <a
                href="{{ route('tourOperator.publicView', $localTourPackage->tourOperator->uuid) }}">{{ $localTourPackage->tourOperator->company_name }}</a>
        </p>
        <p>This trip cancellation deadline - <span
                style="color:red;font-weight:bolder">{{ date('jS M Y', strtotime($localTourPackage->cancellation_due_date)) }}</span>
        </p>
        <br>
        <h5 class="card-title"
            style="font-size: 14px;font-weight: bold;border-bottom:2px solid gainsboro;border-bottom-style: dotted">
            <i class="fas fa-exclamation-triangle" style="margin-right: 8px;color:red"></i>
            How we handle emergencies
        </h5>

        <p>{{ $localTourPackage->emergency_handling }}</p>
        <br>
        <h5 class="card-title"
            style="font-size: 14px;font-weight: bold;border-bottom:2px solid gainsboro;border-bottom-style: dotted">
            <i class="fas fa-smile" style="margin-right: 8px;color:#ffd700"></i>
            Customer satisfaction offered
        </h5>

        @forelse($localTourPackageCustomerSatisfactions as $localTourPackageCustomerSatisfaction)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <span style="font-weight: bold;font-size:15px">
                            &check;{{ $localTourPackageCustomerSatisfaction->customer_satisfaction_name }}</span>
                    </div>
                </div>
                <div class="panel-body">
                    <p>{{ $localTourPackageCustomerSatisfaction->customer_satisfaction_description }}</p>
                    <a href="{{ route('customerSatisfactionCategory.spotLocalSafaris', $localTourPackageCustomerSatisfaction->uuid) }}"
                        class="btn btn-primary btn-sm">See local safari's offering
                        {{ $localTourPackageCustomerSatisfaction->customer_satisfaction_name }}</a>
                </div>

            </div>
        @empty
            <p>Whoops! No customer experience has been published yet. Please wait while our personnel work on it</p>
        @endforelse
    </div>
