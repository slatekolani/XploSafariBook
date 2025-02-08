@push('after-styles')
    {{ Html::style(url("vendor/pnotify/pnotify.custom.css")) }}
    <style>

    </style>

@endpush

@push('after-scripts')
    {{ Html::script(url("vendor/pnotify/pnotify.custom.js")) }}
    <script>


    </script>
@endpush
