<table class="table table-hover table-responsive-md" id="verified_local_tour_packages-table" style="background-color: rgba(255,255,255,0.6);color: black">
    <thead>
    <tr>
        <th>@lang('#')</th>
        <th>@lang('Posted Time')</th>
        <th>@lang('Company Posted')</th>
        <th>@lang('Countdown Days')</th>
        <th>@lang('Is Expired?')</th>
        <th>@lang('Safari Name')</th>
        <th>@lang('Safari Start Date')</th>
        <th>@lang('Safari End Date')</th>
        <th>@lang('Active or Deactivate')</th>
        <th>@lang('Status')</th>
        <th>@lang('Actions')</th>
    </tr>
    </thead>
</table>

@push('after-scripts')

    <script  type="text/javascript">

        $(function() {
            var url = "{{ url("/") }}";
            var table=$('#verified_local_tour_packages-table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: true,
                paging: true,
                info: true,
                buttons:['reload','colvis'],
                initComplete : function () {
                    table.buttons().container().insertBefore('#verified_local_tour_packages-table');
                    $("#verified_local_tour_packages-table").css("width","100%");
                },
                stateSaveCallback: function (settings, data) {
                    localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data));
                },
                stateLoadCallback: function (settings) {
                    return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance));
                },

                ajax: '{{ route('localTourPackages.getVerifiedLocalTourPackages',$tourOperator->id) }}',
                columns: [
                    { data: 'id', name: 'id', orderable: true, searchable: true},
                    { data: 'localTourPackagePostedTime', name: 'localTourPackagePostedTime', orderable: true, searchable: false},
                    { data: 'companyPostedLocalTourPackage', name: 'companyPostedLocalTourPackage', orderable: true, searchable: true},
                    { data: 'localTourPackageCountDownDays', name: 'localTourPackageCountDownDays', orderable: true, searchable: false},
                    { data: 'localTourPackageExpired', name: 'localTourPackageExpired', orderable: true, searchable: false},
                    { data: 'safari_name', name: 'safari_name', orderable: true, searchable: true},
                    { data: 'safari_start_date', name: 'safari_start_date', orderable: true, searchable: true},
                    { data: 'safari_end_date', name: 'safari_end_date', orderable: true, searchable: true},
                    { data : "activate_or_deactivate_local_tourPackage", "className": "text-center",
                        render: function(data, type, row, meta){
                            return  `
                           <div class="btn-group flex-wrap pull-right">

                            ${(row.status == 1) ?
                                `   <label class="switch">
                                <input type="checkbox" id="activate_or_deactivate_local_tourPackage" checked>
                            <span class="slider round"></span>
                            </label>` :
                                `   <label class="switch">
                                <input type="checkbox" id="activate_or_deactivate_local_tourPackage">
                            <span class="slider round"></span>
                            </label>`}
&nbsp; &nbsp;
        </div>`
                        }
                    },
                    { data: 'localTourPackageStatus', name: 'localTourPackageStatus', orderable: false, searchable: false},
                    { data: 'actions', name: 'actions', orderable: false, searchable: false},
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $(nRow).click(function () {
                        // document.location.href = url + "/tourPackages/show/" + aData['uuid'] ;
                    }).hover(function () {
                        $(this).css('cursor', 'pointer');
                    }, function () {
                        $(this).css('cursor', 'auto');
                    });
                }


            });
            $(document).on('click','#activate_or_deactivate_local_tourPackage',function(){
                var data = table.row( $(this).parents('tr') ).data();
                var status  = data.status
                var id = data.id
                $.ajax({
                    type: "GET",
                    dataType: "JSON",
                    url: '{{route('localTourPackages.ActivateOrDeactivateLocalTourPackage')}}',
                    data: {'status': status,'id':id},
                    success: function (response) {
                        if (response.success)
                        {
                            showNotification(response,'Tour package updated successfully');
                        }
                        else{
                            showNotification(response,'Tour package failed to update');
                        }
                    },
                    error:function()
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
            $(document).on('change', '.action_select', function () {
                var uid = $(this).find(':selected').data('route');

                if($(this).val() == 1){
                    swal({
                        title: "Warning",
                        text: "Are you sure to delete this tour package?",
                        icon: "warning",
                        buttons: {
                            cancel: "Cancel",
                            confirm: {
                                value: true,
                                text: "Confirm",
                                className: "btn-danger",
                            },
                        },
                    })
                        .then((result) => {
                            if (result) {
                                document.location.href=uid
                            }
                        });
                }
                if($(this).val() == 3){
                    swal({
                        title: "Warning",
                        text: "Are you sure to duplicate this tour package?",
                        icon: "warning",
                        buttons: {
                            cancel: "Cancel",
                            confirm: {
                                value: true,
                                text: "Confirm",
                                className: "btn-danger",
                            },
                        },
                    })
                        .then((result) => {
                            if (result) {
                                document.location.href=uid
                            }
                        });
                }

                if($(this).val() == 2){
                    document.location.href=uid
                }

            });

        });

    </script>

@endpush
