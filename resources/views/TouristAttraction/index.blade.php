@extends('layouts.main', ['title' => trans('Manage Touristic Attractions'), 'header' => trans('Manage Touristic Attractions')])

@include('includes.datatable_assets')
@push('after-styles')
    {{ Html::style(url('vendor/sweetalert/sweetalert.css')) }}

    <style>

    </style>
@endpush
@section('content')
    <div id="notify" style="display:none;"></div>
    <div class="row" style="overflow-x: scroll">
        <div class="col-md-12" >
            <div class="pull-left">
                <a class ='btn btn-primary btn-sm'  href="{{ route('touristicAttraction.create') }}" style="margin-bottom: 10px">Add attraction &blacktriangleright;</a>
            </div>
        </div>
        <div class="col-md-12">
            <section class="card card-primary mb-4" style="width:150%;background-color:rgba(255,255,255,0.85)">
                <div class="card-actions">
                    {{--Action Links--}}

                </div>
                @include('TouristAttraction.get_touristic_attractions')
            </section>
        </div>

    </div>





@endsection

@push('after-scripts')
    {{ Html::script(url('vendor/sweetalert/sweetalert.min.js')) }}
@endpush
