
<div class = col-md-12>
    <div class="form-group pull-right">
        <div class="btn-group">
            <button id="select_all" type="button" class="btn btn-xs btn-primary">{{ __('label.select_all') }}</button>
            <button id="deselect_all"  style="background-color: red; border-color: red; "   type="button" class="btn btn-xs  btn-primary">{{ __('label.deselect_all') }}</button>
        </div>
    </div>

    <div class="row" style="margin-top: -20px">
        <div class="col-md-6">
            <div class=" row input-group text_content">
                <h4 class='' >{{ __('label.administrator.system.access_control.permission')}}:</h4>&nbsp;
                <h4 id="permission_group_title"   style="font-weight: bold;" ><b>  {{ $first_permission_group->name }}</b></h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <ul class="list-unstyled">
                @foreach($permission_groups as $permission_group)
                    <li >
                        <a id="{{ 'permission_group'. $permission_group->id }}" href="#" >{{ $permission_group->name }}</a>
                        <p  hidden="true" id="{{ 'permission_group_name'. $permission_group->id }}">{{ $permission_group->name }}</p>
                        {{--<p id="{{ 'permission_groups'. $permission_group->id }}">This is some <b>bold</b> text in a paragraph.</p>--}}
                    </li>
                @endforeach
            </ul>

        </div>


        <div class="col-md-9">
            <ul class="list-unstyled">
                @foreach($permissions as $permission)
                    <li>
                        <div class="permissions {{ 'permission_group'. $permission->permission_group_id }}">
                            {{ Form::checkbox('permission'. $permission->id, 'permissions', ($role->permissions()->where('permission_id', $permission->id)->count() > 0) ? 1 : 0 , ['class' => 'permission_group'. $permission->permission_group_id, 'id' => 'permission'. $permission->id ,   'aria-describedby' => '']) }}
                            {{ Form::label('permission', $permission->display_name) }}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>


    </div>

</div>





@push('after-scripts')

    <script>

        $(function () {

            /*Class of the active permission group*/
            var $permission_group_class_global = '{{ 'permission_group' . $first_permission_group->id }}' ;

            onLoadSetup();

            /*Start Triggers*/
            $("a").click(function(event) {
                $element_id = event.target.id;
                onPermissionGroupClick($element_id);
            });


            /*select all on click*/
            $("#select_all").click(function(event) {
                selectAll($permission_group_class_global);
            });

            /*deselect all on click*/
            $("#deselect_all").click(function(event) {
                deselectAll($permission_group_class_global);
            });

            /*end triggers*/




            /*Hide Permissions on page load*/
            function onLoadSetup()
            {

                $(".permissions").hide();
                $(".permission_group" + '{{ $first_permission_group->id }}').show();

            }

            /*Show permissions On click of the permission group*/
            function onPermissionGroupClick($element_id)
            {
                var $group_id = null;
                $group_id = $element_id.substring(16);
                $(".permissions").hide();
                $(".permission_group" +  $group_id).show();

                $("#permission_group_title").text($('#permission_group_name'+ $group_id).text());

                $permission_group_class_global = "permission_group" + $group_id;
                // alert();
            }

            /*Select all permissions*/
            function selectAll($element_class_id)
            {
                $("." + $element_class_id). prop("checked", true);
            }

            /*Deselect all permissions*/
            function deselectAll($element_class_id)
            {
                $("." + $element_class_id). prop("checked", false);
            }
        });



    </script>

@endpush


