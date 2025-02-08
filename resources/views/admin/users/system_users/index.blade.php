@extends('layouts.main', ['title' => trans('label.administrator.users.manage_users'), 'header' => trans('label.administrator.users.manage_users')])

@include('includes.datatable_assets')
@push('after-styles')
    {{ Html::style(url('vendor/sweetalert/sweetalert.css')) }}

    <style>

    </style>
@endpush
@section('content')

<div id="notify" style="display: none"></div>
    <div class="row" style="overflow-x: scroll">
        <div class="col-md-12">
            <section class="card card-primary mb-4" style="width:150%;background-color:rgba(255,255,255,0.85)">
                <header class="card-header card-header-custom">
                    <div class="card-actions">
                        {{--Action Links--}}
                        <div class="row">
                            <div class="col-md-12" >
                                <div class="pull-right" >
                                    <a class =''  href="{{ route('admin.user_manage.create_system_user') }}"  ><i class="fas fa-pencil-alt"></i>&nbsp;{{ trans('label.crud.add') }}</a>&nbsp;&nbsp;
                                    <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h2 class="card-title">{{ trans('label.administrator.users.system_users') }}</h2>
                </header>

                @include('admin/users/system_users/includes/get_system_users_for_dt')
            </section>
        </div>

    </div>





@endsection

@push('after-scripts')
    {{ Html::script(url('vendor/sweetalert/sweetalert.min.js')) }}
@endpush