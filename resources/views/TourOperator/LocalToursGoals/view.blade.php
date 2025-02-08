@extends('layouts.main', ['title' => __("Goal - " . $tourOperatorLocalTourGoal->goal_description), 'header' => __('Yearly Goal')])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12" >
            <div class="pull-left" style="margin-bottom: 10px" >
                <a class ='btn btn-primary btn-sm'  href="{{route('tourCompanyLocalToursGoals.edit',$tourOperatorLocalTourGoal->uuid)}}">Edit information</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">
                            <tr>
                                <th>Goal Description</th>
                                <td>{{$tourOperatorLocalTourGoal->goal_description}}</td>
                            </tr>
                            <tr>
                                <th>Targeted Year</th>
                                <td>{{$years[$tourOperatorLocalTourGoal->year]}}</td>
                            </tr>
                            <tr>
                                <th>Number of tours made</th>
                                <td>{{$tourOperatorLocalTourGoal->number_of_tours_to_be_made}}</td>
                            </tr>
                            <tr>
                                <th>Total number of travellers</th>
                                <td>{{$tourOperatorLocalTourGoal->number_of_travellers}}</td>
                            </tr>
                            <tr>
                                <th>Total mail subscribers you have targeted</th>
                                <td>{{$tourOperatorLocalTourGoal->number_of_mail_subscribers}}</td>
                            </tr>
                            <tr>
                                <th>Total number of tour reviewers</th>
                                <td>{{$tourOperatorLocalTourGoal->number_of_tour_reviewers}}</td>
                            </tr>
                            <tr>
                                <th>Projected Revenue</th>
                                <td>{{$tourOperatorLocalTourGoal->projected_revenue}}</td>
                            </tr>
                            <tr style="text-decoration: bolder">
                                <th>Revenue Month</th>
                                <th>Revenue Breakdown</th>
                            </tr>
                            @forelse($existingRevenueBreakdown as $breakdown)
                            <tr style="color: dodgerblue">
                                <td>{{$breakdown->month}}</td>
                                <td>{{$breakdown->revenue_breakdown}}</td>
                            </tr>
                            @empty
                            <span>Whoops! Sorry, It seems you haven't added the monthly revenue breakdown</span>
                            @endforelse

                            <tr style="text-decoration: bolder">
                                <th>Package Type</th>
                                <th>Total tours related to the group</th>
                                <th>Total travellers in that group</th>
                            </tr>
                            @forelse($existingPackageTypeSegmentations as $segmentation)
                            <tr style="color: dodgerblue">
                                <td>{{$segmentation->package_type}}</td>
                                <td>{{$segmentation->total_tours}}</td>
                                <td>{{$segmentation->total_travellers}}</td>
                            </tr>
                            @empty
                            <span>Whoops! Sorry, It seems you haven't added the package segmentations</span>
                            @endforelse

                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


