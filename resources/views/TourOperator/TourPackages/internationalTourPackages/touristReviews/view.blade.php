@extends('layouts.main', ['title' => __("Tourist Review"), 'header' => __('Tourist Review')])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">
                            <tr>
                                <th>Review title</th>
                                <td>{{$touristReview->review_title}}</td>
                            </tr>
                            <tr>
                                <th>Review Message</th>
                                <td>{{$touristReview->review_message}}</td>
                            </tr>
                            <tr>
                                <th>Review Status</th>
                                <td>
                                    @if($touristReview->status==0)
                                        <span class="badge badge-info">Un Approved</span>
                                    @elseif($touristReview->status==1)
                                        <span class="badge badge-success">Approved + public</span>
                                    @else
                                        <span class="badge badge-info">Un Approved</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


