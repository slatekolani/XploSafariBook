

/* start ---Enable - Disable attributes of elements*/

/*Work for element id*/
function enable_disable(action_type, element_id)
{
    switch (action_type) {
        case 'enable_id':
            $("#"+element_id).prop("disabled", false);
            break;
        case 'disable_id':
            $("#"+element_id).prop("disabled", true);
            break;
        case 'enable_class':
            $("."+element_id).prop("disabled", false);
            break;
        case 'disable_class':
            $("."+element_id).prop("disabled", true);
            break;
    }
}

/*End - Enable_Disable*/

/* start ---HIDE - SHOW attributes of elements*/

/*Work for element id*/
function hide_show(action_type, element_id)
{
    switch (action_type) {
        case 'hide_id':
            $("#" + element_id).hide();
            break;
        case 'show_id':
            $("#"+ element_id).show();
            break;
        case 'hide_class':
            $("." + element_id).hide();
            break;
        case 'show_class':
            $("."+ element_id).show();
            break;
    }
}

/*End - hide_show*/




/* start ---CHECKED - UNCHECKED attributes of elements*/

/*Work for element id*/
function checker(action_type, element_id)
{
    switch (action_type) {
        case 'check_id':
            $("#"+element_id).prop("checked", true);
            break;
        case 'uncheck_id':
            $("#"+element_id).prop("checked", false);
            break;
        case 'check_class':
            $("."+element_id).prop("checked", true);
            break;
        case 'uncheck_class':
            $("."+element_id).prop("checked", false);
            break;
    }
}

/*End - checker*/




/**
 * INITIALIZE VALUES FOR PLUGINS ---=========Start=========----
 */


/* start ----Maskmoney -----*/


/*------Start------Number Only ------*/



/*------End--------Number only---------*/

/*Text area - Text content*/
$('.text_content').on( 'change keyup keydown paste cut', 'textarea', function (){
    $(this).height(0).height(this.scrollHeight);
}).find( 'textarea' ).change();

/*End initialize values -----===========-----------*/

/*Thousand separator*/
function thousandSeparator(num) {
    if(num){
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
}

/*Remove thousands separator*/
function removeThousandSeparator(num) {
    if(num){
        return num.replace(/,/g, "");
    }
}

/*Please wait submit button - Presq - empty label to substitute submit button when hidden*/
//action type i.e. 1 => hide button, 2 = reshow button
function pleaseWaitSubmitButton(submit_button_id,label_wait_id, please_wait_text, action_type)
{
    if(action_type == 1){
        /*hide button*/
        $('#'+ submit_button_id).prop('hidden', true);
        $('#' + label_wait_id).text(please_wait_text).change();
    }else{
        /*show button*/

        $('#'+ submit_button_id).prop('hidden', false);
        $('#' + label_wait_id).text('').change();

    }

}


/*Get value of element id on form*/
function element_id_value(element_id)
{
    return $('#' + element_id).val();
}



/*Get value of element class on form*/
function element_class_value(class_id)
{
    return $('.' + class_id).val();
}