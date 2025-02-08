@push('after-styles')
    {{ Html::style(url("assets/nextbyte/plugins/xdan/css/jquery.datetimepicker.min.css")) }}
@endpush

@push('after-scripts')
    {{ Html::script(url("assets/nextbyte/plugins/xdan/js/jquery.datetimepicker.full.min.js")) }}
    <script>
        $(function () {
            jQuery('.datepicker1').datetimepicker({
                timepicker:false,
                format:'Y-m-d',
                weeks: true,
                dayOfWeekStart: 1,
                lazyInit: true,
                scrollInput: false
            });


            jQuery('.datepicker2').datetimepicker({
                timepicker:false,
                format:'d-M-Y',
                weeks: true,
                dayOfWeekStart: 1,
                lazyInit: true,
                scrollInput: false
            });
        });
    </script>
@endpush
