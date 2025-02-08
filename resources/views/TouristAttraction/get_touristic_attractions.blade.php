<table class="table table-hover table-responsive-md" id="tourist_attractions-table">
    <thead>
    <tr>
        <th>@lang('Attraction name')</th>
        <th>@lang('Attraction description')</th>
        <th>@lang('Attraction category')</th>
        <th>@lang('Activate/Deactivate attraction')</th>
        <th>@lang('Status')</th>
        <th>@lang('Actions')</th>
    </tr>
    </thead>
</table>

@push('after-scripts')

    <script  type="text/javascript">

        $(function() {
            var url = "{{ url("/") }}";
            var table= $('#tourist_attractions-table').DataTable({
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

                ajax: '{{ route('touristicAttraction.getTouristicAttractions') }}',
                columns: [
                    { data: 'attraction_name', name: 'attraction_name', orderable: true, searchable: true},
                    { data: 'attraction_description', name: 'attraction_description', orderable: true, searchable: false},
                    { data: 'attraction_category', name: 'attraction_category', orderable: true, searchable: false},
                    { data : "activate_attraction", "className": "text-center",
                        render: function(data, type, row, meta){
                            return  `
                           <div class="btn-group flex-wrap pull-right">

                            ${(row.status == 1) ?
                                `   <label class="switch">
                                <input type="checkbox" id="activate_attraction" checked>
                            <span class="slider round"></span>
                            </label>` :
                                `   <label class="switch">
                                <input type="checkbox" id="activate_attraction">
                            <span class="slider round"></span>
                            </label>`}
&nbsp; &nbsp;
        </div>`
                        }
                    },
                    { data: 'attraction_status', name: 'attraction_status', orderable: false, searchable: false},
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
            $(document).on('click','#activate_attraction',function(){
                var data = table.row( $(this).parents('tr') ).data();
                var status  = data.status
                var id = data.id
                $.ajax({
                    type: "GET",
                    dataType: "JSON",
                    url: '{{route('touristicAttraction.activateAttraction')}}',
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
