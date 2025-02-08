{{--Service type parent child script control--}}
{{--This should be used when cv category and cv sub categpry are used on the blade--}}
{{--PARAMETERS--}}
{{--child_value' => (Value of the child element i.e. when editing, null when creating),
'parent_id' => 'element id of the parent element',
'child_id' => 'elemnt id of the child element',
'child_hideable' => flag to imply if child element should be hidden when NA i.e you need to add id = child_div on the div container of child element--}}


@push('after-styles')

    <style>

    </style>

@endpush

@push('after-scripts')

    <script>
        $(function () {

            var $parent_id = '{{ $parent_id }}';
            var $child_id = '{{ $child_id }}';
            var $child_hideable = '{{ $child_hideable }}';

            fillChildSelect(0);


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


                if (load_type == 1)
                {
                    getCodeValueOnChange(code_value_id);

                }else{

                    getCodeValueOnLoad(code_value_id);
                }

                // $("#spin2").hide();

            }

            /*Get code values on change of parent category*/
            function getCodeValueOnChange(code_value_id){
                $.get("{{ url('/') }}/getCodeValues?cv_id=" + code_value_id, function (data) {
                    $('#' + $child_id).empty();
                    $("#" + $child_id).select2("val", "");
                    $('#' + $child_id).html(data);

                    amendChildElement();
                });

            }


            /*Get code value when page load*/
            function getCodeValueOnLoad(code_value_id){
                $.get("{{ url('/') }}/getCodeValues?cv_id=" + code_value_id, function (data) {
                    $('#' + $child_id).empty();
                    $("#" + $child_id).select2("val", "");
                    $('#' + $child_id).html(data);
                    amendChildElement();
                    $('#' + $child_id).val({{  $child_value }}).change();
                });

            }
            /*Activate deactivate child element i.e enable, disable / hide*/
            function amendChildElement(){
                if($('.code_values_option').length){
                    // alert(data);
                    $("#" + $child_id).attr("disabled", false);
                    if($child_hideable == 1){
                        $("#child_div").show();
                    }
                }else{
                    // alert('');
                    $("#" + $child_id).attr("disabled", true);
                    if($child_hideable == 1){
                        $("#child_div").hide();
                    }
                }
            }


        })
    </script>
@endpush
