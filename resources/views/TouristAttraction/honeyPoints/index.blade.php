@extends('layouts.main', ['title' => trans('Manage Honey points - ' . $touristicAttraction->attraction_name), 'header' => trans('Manage Honey Points - ' . $touristicAttraction->attraction_name)])

@include('includes.datatable_assets')
@push('after-styles')
    {{ Html::style(url('vendor/sweetalert/sweetalert.css')) }}

    <style>

    </style>
@endpush
@section('content')
    <div class="row" style="overflow-x: scroll">
        <div class="col-md-12" >
            <div class="pull-right" style="margin-bottom: 10px">
                <a class ='btn btn-primary btn-sm'  href="{{ route('touristicAttractionHoneyPoint.create',$touristicAttraction->uuid) }}">Add honey point</a>
            </div>
        </div>
        <div class="col-md-12">
            <section class="card card-primary mb-4" style="width:100%;background-color:rgba(255,255,255,0.85)">
                <div class="card-actions">
                    {{--Action Links--}}

                </div>
                @include('TouristAttraction.honeyPoints.getHoneyPoints')
            </section>
        </div>

    </div>





@endsection

@push('after-scripts')
    {{ Html::script(url('vendor/sweetalert/sweetalert.min.js')) }}
@endpush
