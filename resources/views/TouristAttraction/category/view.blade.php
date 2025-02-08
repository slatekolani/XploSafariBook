@extends('layouts.main', ['title' => __("Attraction categories"), 'header' => __('Attraction categories')])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12" >
            <div class="pull-left" style="margin-bottom: 10px" >
                <a class ='btn btn-primary btn-sm'  href="{{route('touristicAttractionCategory.edit',$touristicAttractionCategory->uuid)}}">Edit information</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">
                            <tr>
                                <th>Attraction Category Iconic Image</th>
                                <td>
                                    <a href="{{ asset('public/TouristicAttractionCategoryIconicImages/'.$touristicAttractionCategory->attraction_category_iconic_image) }}" target="_blank">
                                    <img src="{{ asset('public/TouristicAttractionCategoryIconicImages/'.$touristicAttractionCategory->attraction_category_iconic_image) }}" alt="iconic image" style="width: 100px; height: 100px;"></a>
                                </td>
                            </tr>
                                <th>Attraction category</th>
                                <td>{{$touristicAttractionCategory->attraction_category}}</td>
                            </tr>
                            <tr>
                                <th>Attraction category description</th>
                                <td>{{$touristicAttractionCategory->attraction_category_description}}</td>
                            </tr>
                            <tr>
                                <th>Attraction category basic information</th>
                                <td>{{$touristicAttractionCategory->attraction_category_basic_information}}</td>
                            <tr>
                            <tr>
                                    <th>Activities that can be conducted in this attraction category</th>
                                    <td>
                                        @forelse($touristicAttractionCategory->TouristicAttractionCategoryActivitiesLabel as $touristicAttractionCategoryActivity)
                                        <a href="#" target="_blank"
                                            class="region-link" data-toggle="tooltip" data-placement="top"
                                            data-attraction-id="{{ $touristicAttractionCategoryActivity['name'] }}" style="color: dodgerblue"
                                            title="{{ $touristicAttractionCategoryActivity['description'] }}">{{ $touristicAttractionCategoryActivity['name'] }}</a>,
                                    @empty
                                    @endforelse
                                    </td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


