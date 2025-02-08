<table class="table table-hover table-responsive-md" id="regionCulture-table">
    <thead>
    <tr>
        <th>@lang('Culture name')</th>
        <th>@lang('Basic information')</th>
        <th>@lang('Traditional language')</th>
        <th>@lang('Traditional dance')</th>
        <th>@lang('Traditional food')</th>
        <th>@lang('Actions')</th>
    </tr>
    </thead>
</table>

@push('after-scripts')

    <script  type="text/javascript">

        $(function() {
            var url = "{{ url("/") }}";
            $('#regionCulture-table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: true,
                paging: true,
                info: true,
                stateSaveCallback: function (settings, data) {
                    localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data));
                },
                stateLoadCallback: function (settings) {
                    return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance));
                },
                ajax: '{{ route('regionCulture.getRegionCultures',$tanzaniaRegion->uuid) }}',
                columns: [
                    { data: 'culture_name', name: 'culture_name', orderable: true, searchable: true},
                    { data: 'basic_information', name: 'basic_information', orderable: false, searchable: false},
                    { data: 'traditional_language', name: 'traditional_language', orderable: false, searchable: false},
                    { data: 'traditional_dance', name: 'traditional_dance', orderable: false, searchable: false},
                    { data: 'traditional_food', name: 'traditional_food', orderable: false, searchable: false},
                    { data: 'actions', name: 'actions', orderable: false, searchable: false},
                ],

                columnDefs: [{
                    targets:1,
                    render:function (data,type,row){
                        var maxLength=30;
                        if(data.length>maxLength){
                            return data.substr(0,maxLength)+ '...';
                        }
                        return data;
                    }
                }],
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $(nRow).click(function () {
                        // document.location.href = url + "/tourOperator/edit/" + aData['uuid'] ;
                    }).hover(function () {
                        $(this).css('cursor', 'pointer');
                    }, function () {
                        $(this).css('cursor', 'auto');
                    });
                }


            });
        });

    </script>

@endpush
