<table class="table table-hover table-responsive-md" id="tourist_review-table">
    <thead>
    <tr>
        <th>@lang('Review Posted Time')</th>
        <th>@lang('Posted By')</th>
        <th>@lang('Review Title')</th>
        <th>@lang('Review Message')</th>
        <th>@lang('Approve/ Un-Approve Review')</th>
        <th>@lang('Status')</th>
        <th>@lang('Actions')</th>
    </tr>
    </thead>
</table>

@push('after-scripts')

    <script  type="text/javascript">

        $(function() {
            var url = "{{ url("/") }}";
            var table= $('#tourist_review-table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: true,
                paging: true,
                info: true,
                buttons:['reload','colvis'],
                initComplete : function () {
                    table.buttons().container().insertBefore('#tourist_review-table');
                    $("#tourist_review-table").css("width","100%");
                },
                stateSaveCallback: function (settings, data) {
                    localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data));
                },
                stateLoadCallback: function (settings) {
                    return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance));
                },
                ajax: '{{ route('touristReview.getApprovedTouristReviews',$tourPackageBooking->id) }}',
                columns: [
                    { data: 'review_posted_time', name: 'review_posted_time', orderable: true, searchable: true},
                    { data: 'tourist_posted_review', name: 'tourist_posted_review', orderable: true, searchable: true},
                    { data: 'review_title', name: 'review_title', orderable: true, searchable: true},
                    { data: 'review_message', name: 'review_message', orderable: true, searchable: false},
                    { data : "approve_or_un_approve_review", "className": "text-center",
                        render: function(data, type, row, meta){
                            return  `
                           <div class="btn-group flex-wrap pull-right">

                            ${(row.status == 1) ?
                                `   <label class="switch">
                                <input type="checkbox" id="approve_or_un_approve_review" checked>
                            <span class="slider round"></span>
                            </label>` :
                                `   <label class="switch">
                                <input type="checkbox" id="approve_or_un_approve_review">
                            <span class="slider round"></span>
                            </label>`}
&nbsp; &nbsp;
        </div>`
                        }
                    },
                    { data: 'review_status', name: 'review_status', orderable: false, searchable: false},
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
            $(document).on('click','#approve_or_un_approve_review',function(){
                var data = table.row( $(this).parents('tr') ).data();
                var status  = data.status
                var id = data.id
                $.ajax({
                    type: "GET",
                    dataType: "JSON",
                    url: '{{route('touristReview.approveOrUnApproveReview')}}',
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
        });

    </script>

@endpush
