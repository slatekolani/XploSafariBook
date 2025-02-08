<table class="table table-hover table-responsive-md" id="expired_tours-table" style="background-color: rgba(255,255,255,0.6);color: black">
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
        <th>@lang('Status')</th>
        <th>@lang('Actions')</th>
    </tr>
    </thead>
</table>

@push('after-scripts')

    <script  type="text/javascript">

        $(function() {
            var url = "{{ url("/") }}";
            var table=$('#expired_tours-table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: true,
                paging: true,
                info: true,
                buttons:['reload','colvis'],
                initComplete : function () {
                    table.buttons().container().insertBefore('#expired_tours-table');
                    $("#expired_tours-table").css("width","100%");
                },
                stateSaveCallback: function (settings, data) {
                    localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data));
                },
                stateLoadCallback: function (settings) {
                    return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance));
                },

                ajax: '{{ route('localTourPackages.getExpiredLocalPackages',$tourOperator->id) }}',
                columns: [
                    { data: 'id', name: 'id', orderable: true, searchable: true},
                    { data: 'localTourPackagePostedTime', name: 'localTourPackagePostedTime', orderable: true, searchable: false},
                    { data: 'companyPostedLocalTourPackage', name: 'companyPostedLocalTourPackage', orderable: true, searchable: true},
                    { data: 'localTourPackageCountDownDays', name: 'localTourPackageCountDownDays', orderable: true, searchable: false},
                    { data: 'localTourPackageExpired', name: 'localTourPackageExpired', orderable: true, searchable: false},
                    { data: 'safari_name', name: 'safari_name', orderable: true, searchable: true},
                    { data: 'safari_start_date', name: 'safari_start_date', orderable: true, searchable: true},
                    { data: 'safari_end_date', name: 'safari_end_date', orderable: true, searchable: true},
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

            $(document).on('change', '.action_select', function () {
                var uid = $(this).find(':selected').data('route');

                if($(this).val() == 1){
                    swal({
                        title: "Warning",
                        text: "Are you sure you want to reuse this expired tour package?",
                        icon: "warning",
                        buttons: {
                            cancel: "Cancel",
                            confirm: {
                                value: true,
                                text: "Yes",
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
                        text: "Are you sure you want to delete permanently this expired tour package?",
                        icon: "warning",
                        buttons: {
                            cancel: "Cancel",
                            confirm: {
                                value: true,
                                text: "Yes",
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
