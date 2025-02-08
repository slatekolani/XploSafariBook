<table class="table table-hover table-responsive-md" id="local_cancelled_tour_bookings-table">
    <thead>
    <tr>
        <th>@lang('Cancellation Date and Time ')</th>
        <th>@lang('Cancellation Type')</th>
        <th>@lang('Cancellation Reason')</th>
        <th>@lang('Accept or Reject Cancellation')</th>
        <th>@lang('Cancellation Status')</th>
        <th>@lang('Actions')</th>
    </tr>
    </thead>
</table>

@push('after-scripts')

    <script type="text/javascript">

        $(function() {
            var url = "{{ url("/") }}";
            var table= $('#local_cancelled_tour_bookings-table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: true,
                paging: true,
                info: true,
                buttons:['reload','colvis'],
                initComplete : function () {
                    table.buttons().container().insertBefore('#local_cancelled_tour_bookings-table');
                    $("#local_cancelled_tour_bookings-table").css("width","100%");
                },
                stateSaveCallback: function (settings, data) {
                    localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data));
                },
                stateLoadCallback: function (settings) {
                    return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance));
                },
                ajax: '{{ route('localTripCancellation.getApprovedLocalTourPackageCancellationRequests',$localTourPackageBooking->uuid) }}',
                columns: [
                    { data: 'cancellation_date_and_time', name: 'cancellation_date_and_time', orderable: true, searchable: true},
                    { data: 'cancellation_type', name: 'cancellation_type', orderable: true, searchable: true},
                    { data: 'cancellation_reason', name: 'cancellation_reason', orderable: true, searchable: true},
                    
                    { data : "approve_or_un_approve_cancellationRequest", "className": "text-center",
                        render: function(data, type, row, meta){
                            return  `
                           <div class="btn-group flex-wrap pull-right">
                            ${(row.cancellation_status == 1) ?
                                `   <label class="switch">
                                <input type="checkbox" id="approve_or_un_approve_cancellationRequest" checked>
                            <span class="slider round"></span>
                            </label>` :
                                `   <label class="switch">
                                <input type="checkbox" id="approve_or_un_approve_cancellationRequest">
                            <span class="slider round"></span>
                            </label>`}
&nbsp; &nbsp;
        </div>`
                        }
                    },
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
            $(document).on('click','#approve_or_un_approve_cancellationRequest',function(){
                var data = table.row( $(this).parents('tr') ).data();
                var status  = data.cancellation_status
                var id = data.id
                $.ajax({
                    type: "GET",
                    dataType: "JSON",
                    url: '{{route('localTripCancellation.activateOrDeactivateLocalTripCancelRequest')}}',
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
            

        });

    </script>

@endpush
