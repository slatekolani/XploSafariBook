@extends('layouts.main', ['title' => __("Tanzania visit advices"), 'header' => __('Tanzania visit advice')])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12" >
            <div class="pull-left" style="margin-bottom: 10px" >
                <a class ='btn btn-primary btn-sm'  href="{{route('tanzaniaVisitAdvice.edit',$tanzaniaVisitAdvice->uuid)}}">Edit information</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">
                            <tr>
                                <th style="width: 40%">Advice title</th>
                                <td>{{$tanzaniaVisitAdvice->advice_title}}</td>
                            </tr>
                            <tr>
                                <th>Advice description</th>
                                <td>{{$tanzaniaVisitAdvice->advice_description}}</td>
                            </tr>
                            <tr>
                                <th>Directory url</th>
                                <td><a href="{{$tanzaniaVisitAdvice->directory_url}}">{{$tanzaniaVisitAdvice->directory_url}}</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


