@extends('layouts.main', ['title' => __("Attraction rules"), 'header' => __('Attraction rules')])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12" >
            <div class="pull-left" style="margin-bottom: 10px" >
                <a class ='btn btn-primary btn-sm'  href="{{route('touristicAttractionRule.edit',$touristicAttractionRule->uuid)}}">Edit information</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">
                            <tr>
                                <th style="width: 20%">Rule title</th>
                                <td>{{$touristicAttractionRule->rule_title}}</td>
                            </tr>
                            <tr>
                                <th>Rule description</th>
                                <td>{{$touristicAttractionRule->rule_description}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


