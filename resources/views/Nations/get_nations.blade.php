<table class="table table-hover table-responsive-md" id="nations-table">
    <thead>
    <tr>
        <th>@lang('Nation name')</th>
        <th>@lang('Nation flag')</th>
        <th>@lang('Activate/Deactivate nation')</th>
        <th>@lang('Status')</th>
        <th>@lang('Action')</th>
    </tr>
    </thead>
</table>

@push('after-scripts')

    <script  type="text/javascript">

        $(function() {
            var url = "{{ url("/") }}";
            var table= $('#nations-table').DataTable({
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

                ajax: '{{ route('nation.getNations') }}',
                columns: [
                    { data: 'nation_name', name: 'nation_name', orderable: true, searchable: true},
                    {
                        // "data": ["image","file"],
                        "render": function (data,type,row) {
                            return`
    ${'<img src="'+row.nation_flag+'" class="avatar" width="30" height="30" style="border-radius:50%"/>'}
            `
                        },
                    },
                    { data : "activate_nation", "className": "text-center",
                        render: function(data, type, row, meta){
                            return  `
                           <div class="btn-group flex-wrap pull-right">

                            ${(row.status == 1) ?
                                `   <label class="switch">
                                <input type="checkbox" id="activate_nation" checked>
                            <span class="slider round"></span>
                            </label>` :
                                `   <label class="switch">
                                <input type="checkbox" id="activate_nation">
                            <span class="slider round"></span>
                            </label>`}
&nbsp; &nbsp;
        </div>`
                        }
                    },
                    { data: 'nation_status', name: 'nation_status', orderable: false, searchable: false},
                    { data: 'actions', name: 'actions', orderable: false, searchable: false},
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
            $(document).on('click','#activate_nation',function(){
                var data = table.row( $(this).parents('tr') ).data();
                var status  = data.status
                var id = data.id
                $.ajax({
                    type: "GET",
                    dataType: "JSON",
                    url: '{{route('nation.activateNation')}}',
                    data: {'status': status,'id':id},
                    success: function (response) {
                       if(response.success)
                       {
                           showNotification(response,'Status updated successfully');
                       }
                       else{
                           showNotification(response,'Failed to update status');
                       }
                    },
                    error: function()
                    {
                        showNotification({success:false});
                    }
                })
            })
            function showNotification(response, message) {
                var notify = $('#notify');
                notify.css({
                    'background': response.success ? '#4CAF50' : '#F44336',  // Green for success, red for error
                    'color': '#FFFFFF',
                    'width': '300px',
                    'padding': '15px',
                    'border-radius': '5px',
                    'text-align': 'center',
                    'position': 'fixed',
                    'top': '50%',
                    'left': '50%',
                    'transform': 'translate(-50%, -50%)',
                    'z-index': '1000'
                });
                notify.text(message);
                notify.fadeIn();
                setTimeout(function () {
                    notify.fadeOut();
                }, 3000);
            }
        });

    </script>

@endpush
