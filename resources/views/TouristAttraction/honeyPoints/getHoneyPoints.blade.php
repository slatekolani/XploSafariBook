<table class="table table-hover table-responsive-md" id="honeyPoints-table">
    <thead>
    <tr>
        <th>@lang('Honey point name')</th>
        <th>@lang('Honey point description')</th>
        <th>@lang('Action')</th>
    </tr>
    </thead>
</table>

@push('after-scripts')

    <script  type="text/javascript">

        $(function() {
            var url = "{{ url("/") }}";
            $('#honeyPoints-table').DataTable({
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

                ajax: '{{ route('touristicAttractionHoneyPoint.getHoneyPoints',$touristicAttraction->uuid) }}',
                columns: [
                    { data: 'honey_point_name', name: 'honey_point_name', orderable: true, searchable: true, width: '20%'},
                    { data: 'honey_point_description', name: 'honey_point_description', orderable: false, searchable: false, width: '40%'},
                    { data: 'actions', name: 'actions', orderable: false, searchable: false, width: '20%'},
                ],

                columnDefs: [
                    {
                        targets: 1,
                        render: function (data,type,row){
                            var maxLength=70;
                            if(data.length>maxLength){
                                return data.substr(0,maxLength) + '...';
                            }
                            return data;
                        }
                    },
                    {
                        targets: 0,
                        render: function (data,type,row){
                            var maxLength=20;
                            if(data.length>maxLength)
                            {
                                return data.substr(0,maxLength)+ '...';
                            }
                            return data;
                        }
                    }
                ],

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
