@extends('layouts.main', ['title' => 'FAQ-'.$touristicAttraction->attraction_name, 'header' => 'FAQ-'.$touristicAttraction->attraction_name])

@include('includes.datatable_assets')
@push('after-styles')
    {{ Html::style(url('vendor/sweetalert/sweetalert.css')) }}

    <style>

    </style>
@endpush
@section('content')
    <div id="notify" style="display: none"></div>
    <div class="row" style="overflow-x: scroll">
        <div class="col-md-12" style="margin-bottom: 20px">
            <div class="pull-right" >
                <a class ='btn btn-primary btn-sm'  href="{{ route('touristicAttraction.touristAttractionFAQ',$touristicAttraction->uuid) }}"  >{{ 'Add Attraction FAQ' }}</a>&nbsp;&nbsp;
            </div>
        </div>
        <div class="col-md-12">
            <section class="card card-primary mb-4" style="width:180%;background-color:rgba(255,255,255,0.85)">
                <div class="card-actions">
                    {{--Action Links--}}
                </div>
                @include('TouristAttraction.touristAttractionFAQ.getTouristAttractionFAQ')
            </section>
        </div>

    </div>





@endsection

@push('after-scripts')
    {{ Html::script(url('vendor/sweetalert/sweetalert.min.js')) }}
@endpush
