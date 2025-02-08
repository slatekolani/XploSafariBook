@extends('layouts.main', ['title' => __("Tanzania FAQ"), 'header' => __('Tanzania FAQ')])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12" >
            <div class="pull-left" style="margin-bottom: 10px" >
                <a class ='btn btn-primary btn-sm'  href="{{route('tanzaniaFAQ.edit',$tanzaniaFAQ->uuid)}}">Edit information</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">
                            <tr>
                                <th style="width: 20%">Question title</th>
                                <td>{{$tanzaniaFAQ->question_title}}</td>
                            </tr>
                            <tr>
                                <th>Question answer</th>
                                <td>{{$tanzaniaFAQ->question_answer}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


