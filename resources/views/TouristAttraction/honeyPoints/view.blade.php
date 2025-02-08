@extends('layouts.main', ['title' => __("Honey point"), 'header' => __('Honey point')])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12" >
            <div class="pull-left" style="margin-bottom: 10px" >
                <a class ='btn btn-primary btn-sm'  href="{{route('touristicAttractionHoneyPoint.edit',$honeyPoint->uuid)}}">Edit information</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">
                            <tr>
                                <th>Honey point name</th>
                                <td>{{$honeyPoint->honey_point_name}}</td>
                            </tr>
                            <tr>
                                <th>Honey point description</th>
                                <td>{{$honeyPoint->honey_point_description}}</td>
                            </tr>
                            <tr>
                                <th>Honey point image</th>
                                <td><a href="{{asset('public/honeyPointImage/'.$honeyPoint->honey_point_image)}}">Previous image</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


