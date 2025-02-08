@extends('layouts.main', ['title' => __('Manage Categories'), 'header' => __('Manage Categories')])

@include('includes.datatable_assets')

@section('content')

    {{--1--}}
    <div class="row">

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{ route('admin.user_manage.system_users') }}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('label.administrator.users.system_users') }}</h5>
                        <p class="list-group-item-text">@lang('label.administrator.users.manage_users')</p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('nation.index')}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Nations') }}</h5>
                        <p class="list-group-item-text">@lang('Manage Nations')</p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tanzaniaRegion.index')}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Tanzania regions') }}</h5>
                        <p class="list-group-item-text">@lang('Manage Tanzania regions')</p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('touristicActivity.index')}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Touristic Activities') }}</h5>
                        <p class="list-group-item-text">@lang('Manage Touristic Activities')</p>
                    </a>
                </ul>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('touristicAttractionCategory.index')}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Touristic attraction category') }}</h5>
                        <p class="list-group-item-text">@lang('Manage category')</p>
                    </a>
                </ul>
            </div>
        </div>


        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('touristicAttraction.index')}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Touristic Attractions') }}</h5>
                        <p class="list-group-item-text">@lang('Manage Touristic Attractions')</p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('specialNeed.index')}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Special needs') }}</h5>
                        <p class="list-group-item-text">@lang('Manage Special needs')</p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('transport.index')}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Transports') }}</h5>
                        <p class="list-group-item-text">@lang('Manage Transport')</p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourType.index')}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Tour Types') }}</h5>
                        <p class="list-group-item-text">@lang('Manage Tour Types')</p>
                    </a>
                </ul>
            </div>
        </div>

        

{{--        <div class="col-md-4">--}}
{{--            <div class="list-group">--}}
{{--                <ul class="list-unstyled">--}}
{{--                    <a href="{{route('news.index')}}"--}}
{{--                       class="list-group-item list-group-item-action">--}}
{{--                        <h5 class="list-group-item-heading"><i--}}
{{--                                class="fas fa-clipboard"></i> {{ __('News') }}</h5>--}}
{{--                        <p class="list-group-item-text">@lang('Manage News')</p>--}}
{{--                    </a>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('platformFaq.index')}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Platform FAQ') }}</h5>
                        <p class="list-group-item-text">@lang('Manage Platform FAQ')</p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('event.index')}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('TZ and World Events') }}</h5>
                        <p class="list-group-item-text">@lang('Manage Events')</p>
                    </a>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourPackageType.index')}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Tour package types') }}</h5>
                        <p class="list-group-item-text">@lang('Manage tour package types')</p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('tourInsuranceType.index')}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Tour insurance types') }}</h5>
                        <p class="list-group-item-text">@lang('Manage Tour insurance types')</p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('customerSatisfactionCategory.index')}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Customer satisfaction categories') }}</h5>
                        <p class="list-group-item-text">@lang('Manage Customer satisfaction categories ')</p>
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <ul class="list-unstyled">
                    <a href="{{route('touristicGame.index')}}"
                       class="list-group-item list-group-item-action">
                        <h5 class="list-group-item-heading"><i
                                class="fas fa-clipboard"></i> {{ __('Touristic games') }}</h5>
                        <p class="list-group-item-text">@lang('Manage Touristic games ')</p>
                    </a>
                </ul>
            </div>
        </div>

    </div>
@endsection
