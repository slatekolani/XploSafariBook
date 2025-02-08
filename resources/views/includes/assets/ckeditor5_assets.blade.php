



@push('after-scripts')

    {{ Html::script(url('vendor/ckeditor5/ckeditor.js')) }}

    <script>
        $(function() {

            ClassicEditor.create( document.querySelector('.ckeditor') );

        });
    </script>
@endpush