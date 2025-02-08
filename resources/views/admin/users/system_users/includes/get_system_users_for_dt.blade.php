<table class="table table-hover table-responsive-md" id="system_users-table">
    <thead>
    <tr>
        <th>@lang('label.name')</th>
        <th>@lang('label.email')</th>
        <th>@lang('label.created_at')</th>
        <th>@lang('label.administrator.system.access_control.roles')</th>
        <th>@lang('label.activate_user')</th>
        <th>@lang('label.status')</th>
        <th>@lang('label.actions')</th>
    </tr>
    </thead>
</table>

@push('after-scripts')

    <script  type="text/javascript">

        $(function() {
            var url = "{{ url("/") }}";
            var table=$('#system_users-table').DataTable({
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

                ajax: '{{ route('admin.user_manage.get_system_users_for_dt') }}',
                columns: [
                    { data: 'username', name: 'username', orderable: true, searchable: true},
                    { data: 'email', name: 'email', orderable: true, searchable: true},
                    { data: 'created_date', name: 'created_date', orderable: true, searchable: true},
                    { data: 'role_label', name: 'role_label', orderable: true, searchable: true},
                    { data : "activateUserStatus", "className": "text-center",
                        render: function(data, type, row, meta){
                            return  `
                           <div class="btn-group flex-wrap pull-right">

                            ${(row.status == 1) ?
                                `   <label class="switch">
                                <input type="checkbox" id="activateUserStatus" checked>
                            <span class="slider round"></span>
                            </label>` :
                                `   <label class="switch">
                                <input type="checkbox" id="activateUserStatus">
                            <span class="slider round"></span>
                            </label>`}
                        &nbsp; &nbsp;
                        </div>`
                        }
                    },
                    { data: 'userStatus', name: 'userStatus', orderable: true, searchable: true},
                    { data: 'actions', name: 'actions', orderable: true, searchable: false},
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $(nRow).click(function () {
                        // document.location.href = url + "/admin/user_manage/edit_system_user/" + aData['uuid'] ;
                    }).hover(function () {
                        $(this).css('cursor', 'pointer');
                    }, function () {
                        $(this).css('cursor', 'auto');
                    });
                }


            });
            $(document).on('click','#activateUserStatus',function(){
                var data = table.row( $(this).parents('tr') ).data();
                var status  = data.status
                var id = data.id
                $.ajax({
                    type: "GET",
                    dataType: "JSON",
                    url: '{{route('admin.user_manage.activateUserStatus')}}',
                    data: {'status': status,'id':id},
                    success: function (response) {
                        if (response.success)
                        {
                        
                            showNotification(response,'Status updated successfully');
                        }
                        else
                        {
                            showNotification(response,'Failed to update status');
                        }
                    },
                    error: function ()
                    {
                        showNotification({success:false});
                    }
                })
            })
            function showNotification(response,message)
            {
                var notify=$('#notify')
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
                setTimeout(function (){
                    notify.fadeOut();
                }, 3000);
            }
        });

    </script>

@endpush
