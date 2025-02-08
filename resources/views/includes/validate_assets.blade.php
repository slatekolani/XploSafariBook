@push('after-styles')

    <style>

    </style>

@endpush

@push('after-scripts')
    {{ Html::script(url('vendor/jquery-validation/jquery.validate.js')) }}
    <script>
        $(function () {
            $('.btn').prop('disabled', false);
            {{--on keyup on field, enable button--}}
            $('.needs-validation .form-control').on('keyup blur', function () {
                $('.btn').prop('disabled', false);
            });
            {{--when a submit button is clicked second function if to disable button--}}
            $(':submit').not('.cancel_button').not('.no_submit').click(function () {
                if ($('.needs-validation .form-control').valid()) {
                    $('.btn').prop('disabled', false);
                }
            });
            {{--$(':submit').not('.cancel_button').not('.no_submit').click(function () {
                if ($('.needs-validation .form-control').valid()) {
                    $('.btn').prop('disabled', false);
                } else {
                    $('.btn').prop('disabled', 'disabled');
                }
            });--}}
            {{--for select2 plugin--}}
            $('.select2').on('change', function() {
                $('.btn').prop('disabled', false);
            });
            {{--for file inputs--}}
            $('input[type=file]').on('change', function() {
                $('.btn').prop('disabled', false);
            });
            {{--for checlboxes--}}
            $('input[type=checkbox]').on('change', function() {
                $('.btn').prop('disabled', false);
            });
        })
    </script>
@endpush
