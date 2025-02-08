<table class="table table-hover table-responsive-md" id="custom_tour_bookings-table">
    <thead>
    <tr>
        <th>@lang('Booking Date and Time ')</th>
        <th>@lang('Company Booked')</th>
        <th>@lang('Tourist name')</th>
        <th>@lang('Email address')</th>
        <th>@lang('Phone Number')</th>
        <th>@lang('Tour Duration (Days)')</th>
        <th>@lang('Countdown Days')</th>
        <th>@lang('Start Date')</th>
        <th>@lang('End Date')</th>
        <th>@lang('Is Expired?')</th>
        <th>@lang('Visit Places')</th>
        <th>@lang('Status')</th>
        <th>@lang('Actions')</th>
    </tr>
    </thead>
</table>

@push('after-scripts')

    <script  type="text/javascript">

        $(function() {
            var url = "{{ url("/") }}";
            var table= $('#custom_tour_bookings-table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: true,
                paging: true,
                info: true,
                buttons:['reload','colvis'],
                initComplete : function () {
                    table.buttons().container().insertBefore('#custom_tour_bookings-table');
                    $("#custom_tour_bookings-table").css("width","100%");
                },
                stateSaveCallback: function (settings, data) {
                    localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data));
                },
                stateSaveCallback: function (settings, data) {
                    localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data));
                },
                stateLoadCallback: function (settings) {
                    return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance));
                },
                ajax: '{{ route('customTourBookings.getExpiredCustomTourBookings',$tourOperator->id) }}',
                columns: [
                    { data: 'booking_date_and_time', name: 'booking_date_and_time', orderable: true, searchable: true},
                    { data: 'company_booked', name: 'company_booked', orderable: true, searchable: true},
                    { data: 'tourist_name', name: 'tourist_name', orderable: true, searchable: true},
                    { data: 'tourist_email_address', name: 'tourist_email_address', orderable: true, searchable: false},
                    { data: 'tourist_phone_number', name: 'tourist_phone_number', orderable: true, searchable: false},
                    { data: 'tourDuration', name: 'tourDuration', orderable: true, searchable: false},
                    { data: 'countDownDaysForCustomTour', name: 'countDownDaysForCustomTour', orderable: true, searchable: false},
                    { data: 'start_date', name: 'start_date', orderable: true, searchable: true},
                    { data: 'end_date', name: 'end_date', orderable: true, searchable: true},
                    { data: 'isSafariExpired', name: 'isSafariExpired', orderable: true, searchable: false},
                    { data: 'tourist_visit_areas', name: 'tourist_visit_areas', orderable: true, searchable: true},
                    { data: 'booking_status', name: 'booking_status', orderable: false, searchable: false},
                    { data: 'actions', name: 'actions', orderable: false, searchable: false},
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $(nRow).click(function () {
                        // document.location.href = url + "/customTourBookings/view/" + aData['uuid'] ;
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
                        text: "Are you sure to delete this custom booking?",
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
