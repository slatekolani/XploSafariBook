<table class="table table-hover table-responsive-md" id="verified_tour_operators_companies-admin-table">
    <thead>
    <tr>
        <th>@lang('Id')</th>
        <th>@lang('Registration date')</th>
        <th>@lang('Company name')</th>
        <th>@lang('Company nation')</th>
        <th>@lang('Activate/Deactivate Company')</th>
        <th>@lang('Status')</th>
        <th>@lang('Actions')</th>
    </tr>
    </thead>
</table>

@push('after-scripts')

    <script  type="text/javascript">

        $(function() {
            var url = "{{ url("/") }}";
            var table=$('#verified_tour_operators_companies-admin-table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: true,
                paging: true,
                info: true,
                buttons:['reload','colvis'],
                initComplete : function () {
                    table.buttons().container().insertBefore('#verified_tour_operators_companies-admin-table');
                    $("#verified_tour_operators_companies-admin-table").css("width","100%");
                },
                stateSaveCallback: function (settings, data) {
                    localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data));
                },
                stateLoadCallback: function (settings) {
                    return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance));
                },

                ajax: '{{ route('tourOperatorCompaniesManagement.getVerifiedTourOperatorsCompanies') }}',
                columns: [
                    { data: 'id', name: 'id', orderable: true, searchable: true},
                    { data: 'registrationDate', name: 'registrationDate', orderable: true, searchable: true},
                    { data: 'company_name', name: 'company_name', orderable: true, searchable: true},
                    { data: 'company_nation', name: 'company_nation', orderable: false, searchable: false},
                    { data : "activate_or_deactivate_company", "className": "text-center",
                        render: function(data, type, row, meta){
                            return  `
                           <div class="btn-group flex-wrap pull-right">

                            ${(row.status == 1) ?
                                `   <label class="switch">
                                <input type="checkbox" id="activate_or_deactivate_company" checked>
                            <span class="slider round"></span>
                            </label>` :
                                `   <label class="switch">
                                <input type="checkbox" id="activate_or_deactivate_company">
                            <span class="slider round"></span>
                            </label>`}
&nbsp; &nbsp;
        </div>`
                        }
                    },
                    { data: 'company_status', name: 'status', orderable: false, searchable: false},
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
            $(document).on('click','#activate_or_deactivate_company',function(){
                var data = table.row( $(this).parents('tr') ).data();
                var status  = data.status
                var id = data.id
                $.ajax({
                    type: "GET",
                    dataType: "JSON",
                    url: '{{route('tourOperatorCompaniesManagement.ActivateOrDeactivateCompany')}}',
                    data: {'status': status,'id':id},
                    success: function (response) {
                        if (response.success)
                        {
                            showNotification(response,'Tour operator activated successfully');
                        }
                        else{
                            showNotification(response,'Tour operator activation failed');
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
                if($(this).val() == 2){
                    document.location.href=uid
                }
            });


        });

    </script>

@endpush
