@extends('layouts.main', ['title' => __('Touristic Activity'), 'header' => __('Touristic Activity')])
@include('includes.validate_assets')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="pull-left" style="margin-bottom: 10px">
                <a class ='btn btn-primary btn-sm' href="{{ route('touristicActivity.edit', $touristicActivity->uuid) }}">Edit
                    Touristic Activity &blacktriangleright;</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">
                            <tr>
                                <th>Touristic Activity Name</th>
                                <td>{{ $touristicActivity->activity_name }}</td>
                            </tr>
                            <tr>
                                <th>Touristic Activity Description</th>
                                <td>{{ $touristicActivity->activity_description }}</td>
                            </tr>
                            <tr>
                                <th>Touristic Activity Best Period</th>
                                <td>{{ $touristicActivity->best_activity_period }}</td>
                            </tr>
                            <tr>
                                <th>Touristic Activity Basic Information</th>
                                <td>{{ $touristicActivity->basic_information }}</td>
                            </tr>
                            <tr>
                                <th>Conduct Tip Title</th>
                                <th>Conduct Tip Description</th>
                            </tr>
                            @forelse ($touristicActivityConductTips as $touristicActivityConductTip)
                                <tr>
                                    <td>{{ $touristicActivityConductTip->tip_name }}</td>
                                    <td>{{ $touristicActivityConductTip->tip_description }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">No available tips</td>
                                </tr>
                            @endforelse
                            

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
