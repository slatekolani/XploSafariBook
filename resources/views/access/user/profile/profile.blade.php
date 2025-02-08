@extends('layouts.main', ['title' => __('label.my_profile'), 'header' => __('label.my_profile')])
@include('includes.datatable_assets')
@push('after-styles')
    {{ Html::style(url('vendor/select2/css/select2.min.css')) }}
    {{ Html::style(url('vendor/magnific-popup/magnific-popup.css')) }}
    {{ Html::style(url('vendor/animate/animate.css')) }}

    <style>
        a{
            color: red;
            text-decoration: none;
        }
    </style>
@endpush

@section('content')

    <div class="row">

        {{--MAIN CONTENT--}}
        <div class="col-md-12">

            {{--Contact Person Info--}}
            @include('access/user/profile/includes/user_details')


        </div>

        {{-- SIDEBAR SUMMARY --}}
        {{-- <div class="col-md-3"> --}}
            {{--Sideabar sumary--}}
            {{-- @include('access/user/profile/includes/sidebar_summary') --}}


        {{-- </div> --}}


    </div>







@endsection


@push('after-scripts')
    {{ Html::script(url('vendor/select2/js/select2.min.js')) }}
    {{ Html::script(url('js/examples/examples.modals.js')) }}
    <script>
        $(function() {
            $(".select2").select2();

            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var tab = $(e.target).attr('href').substr(1);
                if (history.pushState) {
                    history.pushState(null, null, '#' + tab);
                    //var id = this.id;
                    //alert(id);
                } else {
                    location.hash = '#' + tab;
                }
            });


        });
    </script>
@endpush
