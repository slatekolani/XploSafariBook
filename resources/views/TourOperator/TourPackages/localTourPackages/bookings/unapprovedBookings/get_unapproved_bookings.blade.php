<table class="table table-hover table-responsive-md" id="unapproved_local_tour_bookings-table">
    <thead>
    <tr>
        <th>@lang('Booking Date and Time ')</th>
        <th>@lang('Tourist name')</th>
        <th>@lang('Email address')</th>
        <th>@lang('Phone number')</th>
        <th>@lang('Pick up station')</th>
        <th>@lang('Total tourists')</th>
        <th>@lang('Tour Price Before Discount(T shs)')</th>
        <th>@lang('Discount')</th>
        <th>@lang('Eligible For Discount?')</th>
        <th>@lang('Tour Price After Discount(T shs)')</th>
        <th>@lang('Payment Mode')</th>
        <th>@lang('Amount Paid')</th>
        <th>@lang('Payment Progress')</th>
        <th>@lang('Accept or Reject Booking')</th>
        <th>@lang('Status')</th>
        <th>@lang('Cancellation Request')</th>
        <th>@lang('Cancellation Status')</th>
        <th>@lang('Actions')</th>
    </tr>
    </thead>
</table>

@push('after-scripts')

    <script  type="text/javascript">

        $(function() {
            var url = "{{ url("/") }}";
            var table= $('#unapproved_local_tour_bookings-table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: true,
                paging: true,
                info: true,
                buttons:['reload','colvis'],
                initComplete : function () {
                    table.buttons().container().insertBefore('#unapproved_local_tour_bookings-table');
                    $("#unapproved_local_tour_bookings-table").css("width","100%");
                },
                stateSaveCallback: function (settings, data) {
                    localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data));
                },
                stateLoadCallback: function (settings) {
                    return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance));
                },
                ajax: '{{ route('localTourBooking.getUnapprovedLocalTourBookings',$localTourPackage->id) }}',
                columns: [
                    { data: 'booking_date_and_time', name: 'booking_date_and_time', orderable: true, searchable: true},
                    { data: 'tourist_name', name: 'tourist_name', orderable: true, searchable: true},
                    { data: 'email_address', name: 'tourist_email_address', orderable: true, searchable: false},
                    { data: 'phone_number', name: 'tourist_phone_number', orderable: true, searchable: false},
                    { data: 'collection_station', name: 'collection_station', orderable: true, searchable: false},
                    { data: 'total_tourists', name: 'total_tourists', orderable: true, searchable: false},
                    { data: 'tour_price', name: 'tour_price', orderable: true, searchable: false},
                    { data: 'discount_offered', name: 'discount_offered', orderable: true, searchable: false},
                    { data: 'discount_eligibility', name: 'discount_eligibility', orderable: true, searchable: false},
                    { data: 'tour_price_after_discount', name: 'tour_price_after_discount', orderable: true, searchable: false},
                    { data: 'payment_mode', name: 'payment_mode', orderable: true, searchable: true},
                    { data: 'amount_paid', name: 'amount_paid', orderable: true, searchable: true},
                    { data: 'payment_progress', name: 'payment_progress', orderable: true, searchable: false},
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
                    { data: 'tripCancellationRequest', name: 'tripCancellationRequest', orderable: false, searchable: false},
                    { data: 'tripCancellationStatus', name: 'tripCancellationStatus', orderable: false, searchable: false},
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
                    url: '{{route('localTourBooking.approveOrUnApproveBooking')}}',
                    data: {'status': status,'id':id},
                    success: function (response) {
                        if (response.success)
                        {
                            showNotification(response,'Status updated successfully');
                        }
                        else{
                            showNotification(response,'Failed to update status');
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
