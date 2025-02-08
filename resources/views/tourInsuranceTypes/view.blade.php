@extends('layouts.main', ['title' => __("Tour Insurance Type - " . $tourInsuranceType->tour_insurance_name), 'header' => __('Tour Insurance Type - ' . $tourInsuranceType->tour_insurance_name)])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12" >
            <div class="pull-left" style="margin-bottom: 10px" >
                <a class ='btn btn-primary btn-sm'  href="{{route('tourInsuranceType.edit',$tourInsuranceType->uuid)}}">Edit information</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">

                            <tr>
                                <th>Insurance name</th>
                                <td>{{$tourInsuranceType->tour_insurance_name}}</td>
                            </tr>
                            <tr>
                                <th>Insurance description</th>
                                <td>{{$tourInsuranceType->tour_insurance_description}}</td>
                            </tr>

                            <tr>
                                <th>Insurance status</th>
                                @if($tourInsuranceType->status==1)
                                    <td><span class="badge badge-success badge-pill">Active</span></td>
                                @else
                                    <td><span class="badge badge-danger badge-pill">Inactive</span></td>
                                @endif
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


