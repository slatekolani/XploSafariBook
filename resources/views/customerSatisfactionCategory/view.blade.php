@extends('layouts.main', ['title' => __("CSC"), 'header' => __('CSC')])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12" >
            <div class="pull-left" style="margin-bottom: 10px" >
                <a class ='btn btn-primary btn-sm'  href="{{route('customerSatisfactionCategory.edit',$satisfactionCategory->uuid)}}">Edit information</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">
                            <tr>
                                <th>Customer satisfaction name</th>
                                <td>{{$satisfactionCategory->customer_satisfaction_name}}</td>
                            </tr>
                            <tr>
                                <th>Customer satisfaction description</th>
                                <td>{{$satisfactionCategory->customer_satisfaction_description}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


