@extends('layouts.main', ['title' => __("Tour package type"), 'header' => __('Tour package type')])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12" >
            <div class="pull-left" style="margin-bottom: 10px" >
                <a class ='btn btn-primary btn-sm'  href="{{route('tourPackageType.edit',$tourPackageType->uuid)}}">Edit tour package type &blacktriangleright;</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">
                            <tr>
                                <th>Tour package type name</th>
                                <td>{{$tourPackageType->tour_package_type_name}}</td>
                            </tr>
                            <tr>
                                <th>Tour package type description</th>
                                <td>{{$tourPackageType->tour_package_type_description}}</td>
                            </tr>
                            <tr>
                                <th>Tour package type status</th>
                                @if($tourPackageType->status=0)
                                    <td><span class="badge badge-danger">Inactive</span></td>
                                @elseif($tourPackageType->status=1)
                                    <td><span class="badge badge-success">Active</span></td>
                                @endif
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


