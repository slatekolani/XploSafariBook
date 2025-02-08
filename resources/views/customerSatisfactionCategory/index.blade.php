@extends('layouts.main', ['title' => trans('Manage CSC'), 'header' => trans('Manage CSC')])

@include('includes.datatable_assets')
@push('after-styles')
    {{ Html::style(url('vendor/sweetalert/sweetalert.css')) }}

    <style>

    </style>
@endpush
@section('content')
    <div class="row" style="overflow-x: scroll">
        <div class="col-md-12" >
            <div class="pull-right" >
                <a class ='btn btn-primary btn-sm'  href="{{ route('customerSatisfactionCategory.create') }}" style="margin-bottom: 10px" >Add customer satisfaction category</a>
            </div>
        </div>
        <div class="col-md-12">
            <section class="card card-primary mb-4" style="width:120%;background-color:rgba(255,255,255,0.85)">
                <div class="card-actions">
                    {{--Action Links--}}

                </div>
                @include('customerSatisfactionCategory.getCustomerSatisfactionCategory')
            </section>
        </div>

    </div>





@endsection

@push('after-scripts')
    {{ Html::script(url('vendor/sweetalert/sweetalert.min.js')) }}
@endpush
