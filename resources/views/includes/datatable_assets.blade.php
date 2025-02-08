@push('after-styles')

    {{ Html::style(url("/assets/nextbyte/plugins/datatables/css/dataTables.jqueryui.min.css")) }}
    {{--{{ Html::style(asset_url() . "/nextbyte/plugins/datatables/css/buttons/buttons.dataTables.min.css") }}--}}
    {{--{{ Html::style(url("/assets/nextbyte/plugins/datatables/css/buttons/buttons.jqueryui.min.css")) }}--}}

    {{--Added--}}
    {{ Html::style(url("/assets/nextbyte/plugins/datatables/css/jquery.dataTables.min.css")) }}
    {{--{{ Html::style(url("/assets/nextbyte/plugins/datatables/css/dataTables.bootstrap4.min.css")) }}--}}
    {{--{{ Html::style(asset_url() . "/nextbyte/plugins/datatables/css/dataTables.bootstrap.min.css") }}--}}
    {{ Html::style(url("/assets/nextbyte/plugins/datatables/css/buttons.dataTables.min.css") ) }}



    <style>
    div.dataTables_filter input { width: 380px !important }
    tr.odd:hover {
        background-color: #edefff;
    }
    tr.even:hover {
        background-color: #d5dcd1;

    }
</style>
@endpush

@push('after-scripts')
    {{ Html::script(url("/assets/nextbyte/plugins/datatables/js/jquery.dataTables.min.js")) }}
    {{--{{ Html::script(asset_url() . "/nextbyte/plugins/datatables/js/dataTables.bootstrap4.min.js") }}--}}
    {{ Html::script(url("/assets/nextbyte/plugins/datatables/js/dataTables.jqueryui.min.js")) }}
    {{ Html::script(url("/assets/nextbyte/plugins/datatables/js/dataTables.buttons.min.js")) }}
    {{ Html::script(url("/assets/nextbyte/plugins/datatables/js/buttons/buttons.jqueryui.min.js")) }}
    {{ Html::script(url("/assets/nextbyte/plugins/datatables/js/buttons/buttons.html5.min.js")) }}
    {{ Html::script(url("/assets/nextbyte/plugins/datatables/js/buttons/buttons.print.min.js")) }}
    {{ Html::script(url("/assets/nextbyte/plugins/datatables/js/buttons/buttons.colVis.min.js")) }}
    {{ Html::script(url("/vendor/datatables/buttons.server-side.js"))}}
@endpush
