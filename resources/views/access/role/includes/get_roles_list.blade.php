

<table class="display" cellspacing="0" width="100%" id ="roles-table">
    <thead>
    <tr>
        <th>@lang('label.sn')</th>
        <th>@lang('label.name')</th>
        <th>@lang('label.description')</th>
        {{--<th>@lang('label.free')</th>--}}
        <th>@lang('label.administrative')</th>
        <th>@lang('label.action')</th>
    </tr>
    </thead>

</table>







@push('after-scripts')
    <script  type="text/javascript">
            $(function () {
                var url = "{{ url("/") }}";
                $('#roles-table').DataTable({
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    searching: true,
                    paging: true,
                    info: false,
                    stateSaveCallback: function (settings, data) {
                        localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data));
                    },
                    stateLoadCallback: function (settings) {
                        return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance));
                    },
                    ajax: {
                        url: '{{ route('access.role.get_for_datatable') }}',
                        type: 'get'
                    },
                    columns: [
                        {data: 'DT_Row_Index', name: 'DT_Row_Index', orderable: false, searchable: false},
                        {data: 'name', name: 'name', orderable: true, searchable: true},
                        {data: 'description', name: 'description', orderable: false, searchable: true},
                        // {data: 'isfree', name: 'isfree', orderable: false, searchable: false},
                        {data: 'isadmin', name: 'isadmin', orderable: false, searchable: false},
                        {data: 'actions', name: 'actions', orderable: false, searchable: false},
//
                    ],
                    // "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    //     $(nRow).click(function () {
                    //         document.location.href = url + "/business/tender/details/" + aData['id'] + '/edit';
                    //     }).hover(function () {
                    //         $(this).css('cursor', 'pointer');
                    //     }, function () {
                    //         $(this).css('cursor', 'auto');
                    //     });
                    // }


                });

        });
    </script>

@endpush
