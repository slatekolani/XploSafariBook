@extends('layouts.main', ['title' => __("label.currency"), 'header' => __("label.currency")])

@push('after-styles')
    {{ Html::style(url('vendor/select2/css/select2.min.css')) }}
    <style>

    </style>
@endpush

@section('content')

    <div class="row">


        <div class="col">

            <section class="card">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="{{ route('currency.edit', $currency->id) }}"><i class="fas fa-dollar-sign"></i> Edit details</a>

                    </div>

                    <h2 class="card-title"><i class="fas fa-dollar-sign">  </i> {{ $currency->name, $currency->display_symbol }}</h2>
                </header>

                <div class="card-body">

                    <div class="col-sm-12">
                        <div class="row">

                            <div class="col-xs-3 col-lg-4 col-md-3 col-sm-3 col-xs-12">
                                <h5><b>@lang('label.currencies.name')</b></h5>
                                <p>
                                    {{ $currency->name }}
                                </p>
                            </div>

                            <div class="col-xs-3 col-lg-4 col-md-3 col-sm-3 col-xs-12">
                                <h5><b>@lang('label.currencies.code')</b></h5>
                                <p>
                                    {{ $currency->code }}
                                </p>
                            </div>

                            <div class="col-xs-3 col-lg-4 col-md-3 col-sm-3 col-xs-12">
                                <h5><b>@lang('label.currencies.symbol')</b></h5>
                                <p>
                                    {{ $currency->display_symbol }}
                                </p>
                            </div>
                        </div>
                    </div>


                </div>
            </section>
        </div>
    </div>

@endsection
