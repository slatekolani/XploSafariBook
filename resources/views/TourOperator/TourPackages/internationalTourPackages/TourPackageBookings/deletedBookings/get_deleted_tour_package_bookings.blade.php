<table class="table table-hover table-responsive-md" id="deleted_tour_package_bookings-table">
    <thead>
    <tr>
        <th>@lang('Booking at ')</th>
        <th>@lang('Deleted at ')</th>
        <th>@lang('Tourist name')</th>
        <th>@lang('Email address')</th>
        <th>@lang('Phone number')</th>
        <th>@lang('Tourist nation')</th>
        <th>@lang('Total adult travellers')</th>
        <th>@lang('Total children travellers')</th>
        <th>@lang('Message')</th>
        <th>@lang('Status')</th>
        <th>@lang('Actions')</th>
    </tr>
    </thead>
</table>

@push('after-scripts')

    <script  type="text/javascript">

        $(function() {
            var url = "{{ url("/") }}";
            var table= $('#deleted_tour_package_bookings-table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: true,
                paging: true,
                info: true,
                buttons:['reload','colvis'],
                initComplete : function () {
                    table.buttons().container().insertBefore('#deleted_tour_package_bookings-table');
                    $("#deleted_tour_package_bookings-table").css("width","100%");
                },
                stateSaveCallback: function (settings, data) {
                    localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data));
                },
                stateLoadCallback: function (settings) {
                    return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance));
                },
                ajax: '{{ route('tourPackageBookings.getDeletedTourPackageBookings',$tourPackage->id) }}',
                columns: [
                    { data: 'booking_date_and_time', name: 'booking_date_and_time', orderable: true, searchable: true},
                    { data: 'deleted_date_and_time', name: 'deleted_date_and_time', orderable: true, searchable: true},
                    { data: 'tourist_name', name: 'tourist_name', orderable: true, searchable: true},
                    { data: 'tourist_email_address', name: 'tourist_email_address', orderable: true, searchable: false},
                    { data: 'tourist_phone_number', name: 'tourist_phone_number', orderable: true, searchable: false},
                    { data: 'tourist_country', name: 'tourist_country', orderable: false, searchable: true},
                    { data: 'total_adult_travellers', name: 'total_adult_travellers', orderable: true, searchable: false},
                    { data: 'total_children_travellers', name: 'total_children_travellers', orderable: false, searchable: false},
                    { data: 'message', name: 'message', orderable: false, searchable: false},
                    { data: 'booking_status', name: 'booking_status', orderable: false, searchable: false},
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
            $(document).on('change', '.action_select', function () {
                var uid = $(this).find(':selected').data('route');

                if($(this).val() == 1){
                    swal({
                        title: "Warning",
                        text: "Are you sure to restore this tour booking?",
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
                    swal({
                        title: "Warning",
                        text: "Are you sure you want to delete completely this tour booking? You wont be able to restore it back!",
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
                    document.location.href=uid
                }

            });

        });

    </script>

@endpush
