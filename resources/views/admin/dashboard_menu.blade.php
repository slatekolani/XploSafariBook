@extends('layouts.main', ['title' => __('label.administrator.admin_center'), 'header' => __('label.administrator.admin_center')])

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="tabs tabs-quaternary">
                        <ul class="nav nav-tabs tabs-primary">
                            <li class="nav-item active">
                                <a class="nav-link" href="#system" data-toggle="tab">@lang('label.system')</a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <div id="system" class="tab-pane active">
                                @include('admin/system/menu')
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



@endsection
