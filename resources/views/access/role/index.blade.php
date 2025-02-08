@extends('layouts.main', ['title' => __('label.administrator.system.access_control.roles_permissions'), 'header' => __('label.administrator.system.access_control.roles_permissions')])

@include('includes.datatable_assets')

@push('after-styles')

@endpush

@section('content')
    <section class="card card-featured card-featured-primary mb-4">
        <header class="card-header">
            <div class="float-right">
                <a href="{{ route('access.role.create') }}"  class="btn btn-primary save_button" ><i class="icon fa fa-plus-circle"></i>&nbsp;@lang('buttons.general.add')</a>
            </div>

        </header>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                  @include('access/role/includes/get_roles_list')
                </div>
            </div>
        </div>
    </section>

@endsection

@push('after-scripts')

    <script  type="text/javascript">
        $(function () {
            $(".search-select").select2();


        });
    </script>

@endpush
