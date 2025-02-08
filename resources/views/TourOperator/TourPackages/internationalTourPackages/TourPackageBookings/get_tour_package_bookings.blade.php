<table class="table table-hover table-responsive-md" id="tour_package_bookings-table">
    <thead>
    <tr>
        <th>@lang('Booking Date and Time ')</th>
        <th>@lang('Tourist name')</th>
        <th>@lang('Email address')</th>
        <th>@lang('Phone number')</th>
        <th>@lang('Tourist nation')</th>
        <th>@lang('Total adult travellers')</th>
        <th>@lang('Total children travellers')</th>
        <th>@lang('Tour Price')</th>
        <th>@lang('Tour Duration (Days)')</th>
        <th>@lang('Message')</th>
        <th>@lang('Accept or Reject Booking')</th>
        <th>@lang('Status')</th>
        <th>@lang('Actions')</th>
    </tr>
    </thead>
</table>

@push('after-scripts')

    <script  type="text/javascript">

        $(function() {
            var url = "{{ url("/") }}";
            var table= $('#tour_package_bookings-table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: true,
                paging: true,
                info: true,
                buttons:['reload','colvis'],
                initComplete : function () {
                    table.buttons().container().insertBefore('#tour_package_bookings-table');
                    $("#tour_package_bookings-table").css("width","100%");
                },
                stateSaveCallback: function (settings, data) {
                    localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data));
                },
                stateLoadCallback: function (settings) {
                    return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance));
                },
                ajax: '{{ route('tourPackageBookings.getTourPackageBookings',$tourPackage->id) }}',
                columns: [
                    { data: 'booking_date_and_time', name: 'booking_date_and_time', orderable: true, searchable: true},
                    { data: 'tourist_name', name: 'tourist_name', orderable: true, searchable: true},
                    { data: 'tourist_email_address', name: 'tourist_email_address', orderable: true, searchable: false},
                    { data: 'tourist_phone_number', name: 'tourist_phone_number', orderable: true, searchable: false},
                    { data: 'tourist_country', name: 'tourist_country', orderable: false, searchable: true},
                    { data: 'total_adult_travellers', name: 'total_adult_travellers', orderable: true, searchable: false},
                    { data: 'total_children_travellers', name: 'total_children_travellers', orderable: false, searchable: false},
                    { data: 'tour_price', name: 'tour_price', orderable: false, searchable: false},
                    { data: 'tour_duration', name: 'tour_duration', orderable: false, searchable: false},
                    { data: 'message', name: 'message', orderable: false, searchable: false},
                    { data : "approve_or_un_approve_booking", "className": "text-center",
                        render: function(data, type, row, meta){
                            return  `
                           <div class="btn-group flex-wrap pull-right">
                            ${(row.status == 1) ?
                                `   <label class="switch">
                                <input type="checkbox" id="approve_or_un_approve_booking" checked>
                            <span class="slider round"></span>
                            </label>` :
                                `   <label class="switch">
                                <input type="checkbox" id="approve_or_un_approve_booking">
                            <span class="slider round"></span>
                            </label>`}
&nbsp; &nbsp;
        </div>`
                        }
                    },
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
            $(document).on('click','#approve_or_un_approve_booking',function(){
                var data = table.row( $(this).parents('tr') ).data();
                var status  = data.status
                var id = data.id
                $.ajax({
                    type: "GET",
                    dataType: "JSON",
                    url: '{{route('tourPackageBookings.approveOrUnApproveBooking')}}',
                    data: {'status': status,'id':id},
                    success: function (data) {
                        // $('#notify').fadeIn();
                        // $('#notify').css('background','green');
                        // $('#notify').text('status updated successfully');
                        // // SetTimeout(()=>{
                        // //     $('#notify').fadeOut();
                        // // });
                    }
                })
            })
            $(document).on('change', '.action_select', function () {
                var uid = $(this).find(':selected').data('route');

                if($(this).val() == 1){
                    swal({
                        title: "Warning",
                        text: "Are you sure to delete this tour booking?",
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
