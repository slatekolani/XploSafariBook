@extends('layouts.main', ['title' => __("Event"), 'header' => __('Event')])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12" >
            <div class="pull-left" style="margin-bottom: 10px" >
                <a class ='btn btn-primary btn-sm'  href="{{route('event.edit',$event->uuid)}}">Edit event &blacktriangleright;</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">
                            <tr>
                                <th>Event name</th>
                                <td>{{$event->event_name}}</td>
                            </tr>
                            <tr>
                                <th>Event date</th>
                                <td>{{$event->event_date}}</td>
                            </tr>
                            <tr>
                                <th>Event description</th>
                                <td>{{$event->event_description}}</td>
                            </tr>
                            <tr>
                                <th>Event status</th>
                                @if($event->status==0)
                                    <td><span class="badge badge-danger">Inactive</span></td>
                                @else
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


