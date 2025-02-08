@push('after-styles')
    {{ Html::style(url('assets/nextbyte/plugins/datatables/css/dataTables.bootstrap4.min.css')) }}
    {{ Html::style(url('assets/nextbyte/plugins/datatables/css/jquery.dataTables.min.css')) }}
    {{ Html::style(url('assets/nextbyte/plugins/datatables/css/buttons.dataTables.min.css')) }}
    {{ Html::style(url('assets/nextbyte/plugins/datatables/css/buttons/buttons.dataTables.min.css')) }}
    {{ Html::style(url('assets/nextbyte/plugins/datatables/css/checkboxes/dataTables.checkboxes.css')) }}
@endpush
{{--@if($staffs->count() == 0)--}}
    {{--<section class="call-to-action call-to-action-primary">--}}
        {{--<div class="container container-with-sidebar">--}}
            {{--<div class="row">--}}
                {{--<div class="col-xl-8">--}}
                    {{--<div class="call-to-action-content">--}}
                        {{--<h2 class="text-color-light mb-0 mt-4">@lang('alert.admin.welcome') <strong>@lang('alert.admin.staff')</strong></h2>--}}
                        {{--<p class="lead">@lang('alert.admin.click')</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-xl-4">--}}
                    {{--<div class="call-to-action-btn float-right-xl mt-1 pt-1 mt-xl-4 pt-xl-4">--}}
                        {{--<a href="{{ route('admin.register.staff.form') }}" class="btn btn-primary-scale-2 btn-lg">Register Now!</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}

{{--@else--}}

    <section class="card">
        <header class="card-header">
            <div class="card-actions">
                <a href="{{ route('currency.create') }}" class="card-action"><span class="btn btn-primary">@lang('label.crud.add_new')</span></a>
            </div>

            <h2 class="card-title">@lang('label.currency') {{--( {{ $staffs->count() }} )--}}</h2>

        </header>
        <div class="card-body">

            <table class="table table-bordered table-responsive-lg" id="staffs-table">
                <thead>
                <tr>
                    <th>NO</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Display Symbol</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>

        </div>

    </section>
{{--@endif--}}

@push('after-scripts')

    <script>
        $(function() {
            $('#staffs-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('currency.all.datatable') }}',
                columns: [
                    { data: 'DT_Row_Index', name: 'DT_Row_Index' },
                    { data: 'name', name: 'name' },
                    { data: 'code', name: 'code' },
                    { data: 'display_symbol', name: 'display_symbol' },
                    { data: 'action', name: 'action', searchable: false }
                ]
            });
        });
    </script>
    {{ Html::script(url('assets/nextbyte/plugins/datatables/js/dataTables.bootstrap4.min.js')) }}
    {{ Html::script(url('assets/nextbyte/plugins/datatables/js/jquery.dataTables.min.js')) }}
    {{ Html::script(url('assets/nextbyte/plugins/datatables/js/buttons/buttons.bootstrap4.min.js')) }}
    {{ Html::script(url('assets/nextbyte/plugins/datatables/js/buttons/dataTables.buttons.min.js')) }}

@endpush