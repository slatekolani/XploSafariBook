@extends('layouts.main', ['title' => __("Tanzania Region - " . $tanzaniaRegion->region_name), 'header' => __('Tanzania Region - ' . $tanzaniaRegion->region_name)])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12" >
            <div class="pull-left" style="margin-bottom: 10px" >
                <a class ='btn btn-primary btn-sm'  href="{{route('tanzaniaRegion.edit',$tanzaniaRegion->uuid)}}">Edit information</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">

                            <tr>
                                <th>Region name</th>
                                <td>{{$tanzaniaRegion->region_name}}</td>
                            </tr>
                            <tr>
                                <th>Region description</th>
                                <td>{{$tanzaniaRegion->region_description}}</td>
                            </tr>
                            <tr>
                                <th>Region economic activity</th>
                                <td>{{$tanzaniaRegion->regionEconomicActivity->economic_activity_title}}</td>
                            </tr>
                            <tr>
                                <th>Region size</th>
                                <td>{{$tanzaniaRegion->region_size}}</td>
                            </tr>
                            <tr>
                                <th>Population </th>
                                <td>{{$tanzaniaRegion->population}}</td>
                            </tr>
                            <tr>
                                <th>Climatic condition </th>
                                <td>{{$tanzaniaRegion->climatic_condition}}</td>
                            </tr>
                            <tr>
                                <th>Region history </th>
                                <td>{{$tanzaniaRegion->region_history}}</td>
                            </tr>
                            <tr>
                                <th>Region images</th>
                                <td>
                                    @forelse(explode(',', $tanzaniaRegion->region_icon_image) as $index => $image)
                                        <div class="gallery-item">
                                            <a data-fancybox="gallery" data-caption="{{$tanzaniaRegion->region_name}}, {{ $tanzaniaRegion->region_description }}" href="{{ asset('public/'.$image) }}">
                                                <img src="{{ asset('public/'.$image) }}" loading="lazy" alt="Gallery Image">
                                            </a>
                                        </div>
                                    @empty
                                        <p>No image found!</p>
                                    @endforelse
                                </td>
                            </tr>

                            <tr>
                                <th>Region status</th>
                                @if($tanzaniaRegion->status==1)
                                    <td><span class="badge badge-success">Active</span></td>
                                @else
                                    <td><span class="badge badge-danger">Inactive</span></td>
                                @endif
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


