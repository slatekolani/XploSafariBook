{{--Asset for controling auto filling of select for subcategories when category is selected e.g. Bank and branches, Country and regions and districts--}}
{{--This should be used when cv category and cv sub categpry are used on the blade--}}
{{--PARAMETERS--}}
{{--child_value' => (Value of the child element i.e. when editing, null when creating),
'parent_id' => 'element id of the parent element',
'child_id' => 'elemnt id of the child element',
'child_hideable' => flag to imply if child element should be hidden when NA i.e you need to add id = child_div on the div container of child element
'get_url' - get url to retrieve child values based on the parent id provided
'isedit'- imply if the page/form is for creating new / editing existing entry i.e. 1 => is edit page, 0 => creating new page
''append_child_value' - imply child value should be appended after reloading new values--}}


@push('after-styles')

    <style>

    </style>

@endpush

@push('after-scripts')

    <script>
        $(function () {
            /*Parameters*/
            var $parent_id = '{{ $parent_id }}';
            var $child_id = '{{ $child_id }}';
            var $child_hideable = '{{ $child_hideable }}';
            var $get_url = '{{ $get_url }}';
            var $isedit = '{{ $isedit }}';
            var $append_child_value = '{{ $append_child_value ?? null }}';

            /*end parameters*/

            if($isedit == '0'){
                /*When is creating new entry*/
                fillChildSelect(0);
            }else{
                /*When is edit page*/
                fillChildSelect(1);
            }



            $('#' + $parent_id).on('change', function (e) {
                fillChildSelect(1);


            });

            /**
             *
             * Fill service type sub based on service type selected
             * load_type; 1 = on parent change, 0 on page load
             */
            function fillChildSelect(load_type){
                // $("#spin2").show();
                var code_value_id =  $('#' + $parent_id).val();
                // var code_id = 0;
                // $("#" + $child_id).attr('disabled',false);


                if (load_type == '1')
                {
                    getCodeValueOnChange(code_value_id);
                }else{

                    getCodeValueOnLoad(code_value_id);
                }

                // $("#spin2").hide();

            }

            /*Get code values on change of parent category*/
            function getCodeValueOnChange(code_value_id){

                if(code_value_id != null  && code_value_id != ''){
                    $.get("{{ url('/') }}/"+ $get_url  + code_value_id + '&isedit=' + $isedit, function (data) {
                        $("#spin2").show();
                        $('#' + $child_id).empty();
                        $("#" + $child_id).select2("val", "");
                        $('#' + $child_id).html(data);
                        $("#spin2").hide();

                        if($append_child_value == '1'){
                            $('#' + $child_id).val('{{  $child_value }}').change();
                        }

                    });

                }


            }


            /*Get code value when page load*/
            function getCodeValueOnLoad(code_value_id){
                {{--$.get("{{ url('/') }}/getCodeValues?cv_id=" + code_value_id, function (data) {--}}
                if(code_value_id != null && code_value_id != ''){
                    $.get("{{ url('/') }}/"+ $get_url + code_value_id, function (data) {
                        $("#spin2").show();
                        $('#' + $child_id).empty();
                        $("#" + $child_id).select2("val", "");
                        $('#' + $child_id).html(data);
                        $("#spin2").hide();
                        $('#' + $child_id).val('{{  $child_value }}').change();

                    });
                }

            }
            /*Activate deactivate child element i.e enable, disable / hide*/
            function amendChildElement(){
                // if($('.code_values_option').length){
                //     // alert(data);
                //     $("#" + $child_id).attr("disabled", false);
                //     if($child_hideable == 1){
                //         $("#child_div").show();
                //     }
                // }else{
                //     // alert('');
                //     $("#" + $child_id).attr("disabled", true);
                //     if($child_hideable == 1){
                //         $("#child_div").hide();
                //     }
                // }
            }


        })
    </script>
@endpush
