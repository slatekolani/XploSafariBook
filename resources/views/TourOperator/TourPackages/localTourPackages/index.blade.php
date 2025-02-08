@extends('layouts.main', ['title' => trans('Local Tour Packages'), 'header' => trans('Local Tour Packages')])

@include('includes.datatable_assets')
@push('after-styles')
    {{ Html::style(url('vendor/sweetalert/sweetalert.css')) }}
    <style>

    </style>
@endpush

@section('content')
    <div class="row" style="padding-top: 13px">
        <div id="notify" style="display: none"></div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('localTourPackages.index',$tourOperator->uuid)}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('All Posted packages') }} ~
                            <badge class="badge badge-primary badge-lg"
                                   style="font-size:15px">{{$tourOperator->TotalLocalTourPackagesPostedLabel}}</badge>
                        </h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('localTourPackages.recentLocalPackagesIndex',$tourOperator->uuid)}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Recent Posted packages') }} ~
                            <badge class="badge badge-primary badge-lg"
                                   style="font-size:15px">{{$tourOperator->TotalRecentLocalTourPackagesPostedLabel}}</badge>
                        </h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('localTourPackages.verifiedLocalPackagesIndex',$tourOperator->uuid)}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Verified Packages') }} ~
                            <badge class="badge badge-primary badge-lg"
                                   style="font-size:15px">{{$tourOperator->TotalVerifiedLocalTourPackagesPostedLabel}}</badge>
                        </h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('localTourPackages.unverifiedLocalPackagesIndex',$tourOperator->uuid)}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Unverified Packages') }} ~
                            <badge class="badge badge-primary badge-lg"
                                   style="font-size:15px">{{$tourOperator->TotalUnVerifiedLocalTourPackagesPostedLabel}}</badge>
                        </h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('localTourPackages.nearLocalToursIndex',$tourOperator->uuid)}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ __('Near Tours') }} ~
                            <badge class="badge badge-info badge-lg"
                                   style="font-size:15px">{{$tourOperator->TotalLocalNearToursLabel}}</badge>
                        </h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('localTourPackages.expiredLocalToursIndex',$tourOperator->uuid)}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Expired Packages') }} ~
                            <badge class="badge badge-danger badge-lg"
                                   style="font-size:15px">{{$tourOperator->TotalLocalExpiredTourPackagesLabel}}</badge>
                        </h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('localTourPackages.deletedLocalToursIndex',$tourOperator->uuid)}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Deleted Tour Packages') }} ~
                            <badge class="badge badge-danger badge-lg"
                                   style="font-size:15px">{{$tourOperator->TotalLocalDeletedTourPackagesLabel}}</badge>
                        </h5>
                        <p class="list-group-item-text"></p>
                    </a>
                </ul>
            </div>
        </div>

    </div>

    <div class="row">
        @if(Auth::user()->role==2)
            <div class="col-md-12">
                <div class="pull-left">
                    <a href="{{route('localTourPackages.create',$tourOperator->uuid)}}" class="btn btn-primary" style="font-size: 15px;margin-bottom: 10px">Add Package &blacktriangleright;</a>&nbsp;&nbsp;
                </div>
            </div>
        @endif
        <div class="col-md-12" style="overflow-x: scroll">
            <section class="card card-primary mb-4" style="width:180%;background-color:rgba(255,255,255,0.85)">
                <div class="card-actions">
                    {{--Action Links--}}

                </div>
                @include('TourOperator.TourPackages.localTourPackages.get_company_local_tour_packages')
            </section>
        </div>

    </div>

@endsection

@push('after-scripts')
    {{ Html::script(url('vendor/sweetalert/sweetalert.min.js')) }}
@endpush
