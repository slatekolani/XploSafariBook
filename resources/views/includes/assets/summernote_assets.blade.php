
@push('after-styles')
    {{ Html::style(url('vendor/summernote/summernote-bs4.css')) }}
    <style>
    </style>
@endpush




@push('after-scripts')

    {{ Html::script(url('vendor/summernote/summernote-bs4.js')) }}

    <script>
        $(function() {

            $('.summernote').summernote();

        });
    </script>
@endpush