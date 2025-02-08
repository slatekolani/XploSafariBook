




@push('after-scripts')

    {{ Html::script(url('assets/nextbyte/plugins/maskmoney/js/maskmoney.min.js')) }}

    <script>
        $(function() {

            /* start ----Maskmoney -----*/

            /* start : mask all money input */
            $('.money').maskMoney({
                precision : 2,
                allowZero : false,
                affixesStay : false
            });

            $('.money0').maskMoney({
                precision : 0,
                allowZero : true,
                affixesStay : false
            });

            /*--End ----Maskmoney---------*/

        });
    </script>
@endpush