@push('after-styles')

{{ Html::style(url('vendor/flag-icon-css/css/flag-icon.min.css')) }}

<style>

</style>
@endpush

<span class="flag-icon flag-icon-{{ strtolower($country_code) }}"></span>

@push('after-scripts')

@endpush

