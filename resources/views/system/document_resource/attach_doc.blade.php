@extends('layouts.main', ['title' => trans('label.administrator.system.document.attach_doc'), 'header' => trans('label.administrator.system.document.attach_doc')])

@include('includes.validate_assets')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <section class="card card-featured card-featured-primary mb-4">

                <div class="card-body">
                    {{ Form::open(['route' => ['system.document_resource.store'], 'autocomplete' => 'off','method'=> 'Post', 'id' => 'store', 'class' => 'needs-validation', 'novalidate', 'enctype'=>"multipart/form-data"]) }}

                    {{ Form::hidden('resource_id', $resource_id, ['class' =>'']) }}
                    {{ Form::hidden('return_url', $return_url, ['class' =>'']) }}
                    {{ Form::hidden('allowed_exts', isset($allowed_exts) ? $allowed_exts : null, ['class' =>'']) }}
                    {{ Form::hidden('allowed_formats', isset($allowed_formats) ? $allowed_formats : null, [], ['class' =>'']) }}
                    {{ Form::hidden('action_type', 1, ['class' =>'']) }}

                    <p>{{ getLanguageBlock('lang.auth.mandatory-field') }}</p>

                    <div class="form-group">
                        <div class="row form-group">
                            <div class="col-md-6">
                                {{ Form::label('name', trans('label.document'), ['class' => 'required_asterik']) }}
                                {{ Form::select('document_id', $document_types, null, ['style' => 'width:100%', 'placeholder' => '','class' => 'form-control search-select', 'id'=> 'document_type']) }}
    {!! $errors->first('document_id','<span class="badge badge-danger">:message</span>') !!}
 </div>
 <div class="col-md-6">

 </div>
</div>

<div class="row form-group" id="doc_title_div">
 <div class="col-md-6 text_content">
     {{ Form::label('document_title', trans('label.administrator.system.document.title')) }}
     {{ Form::input( 'text','document_title', null, ['class' => 'form-control option_input', 'id' => 'document_title']) }}
    {!! $errors->first('document_title', '<span class="badge badge-danger">:message</span>') !!}
</div>
</div>

<div class="row form-group">
<div class="col-md-6 text_content">
    {{ Form::label('attach_doc', trans('label.administrator.system.document.attach_doc') , ['class' => 'required_asterik']) }}
    {{ Form::file('document_file') }}
    {!!  $errors->first('document_file', '<span class="badge badge-danger">:message</span>') !!}

    @if(isset($allowed_formats) || isset($allowed_exts))
        <br/>
                                  <small> {{   __('label.administrator.system.document.allowed_formats') . ' - ' .  (isset($allowed_exts) ?   implode(', ',unserialize($allowed_exts)) :  implode(', ',unserialize($allowed_formats))) }}</small>
    @endif
</div>
</div>


<div class="row form-group">
<div class="col-md-6 text_content">
    {{ Form::checkbox('return_page', '1', false, ['id' => 'return_page', 'class' => 'return_page']) }}  {{ trans('label.return_page')  }}
</div>
</div>


</div>


<div class="col-md-6">
<div class="form-group text-center">
{{ link_to($return_url,trans('buttons.general.cancel'),['id'=> 'cancel', 'class' => 'btn btn-primary site-btn cancel_button', ]) }}
{{ Form::button(trans('buttons.general.submit'), ['class' => 'btn btn-primary','id' => 'submit_btn', 'type'=>'submit']) }}
</div>
</div>
{{ Form::close() }}
</div>
</section>
</div>
</div>

@endsection
@push('after-scripts')

<script>

$(function () {
var document_type = '{{ null }}';
$(".search-select").select2({});

$('.text_content').on( 'change keyup keydown paste cut', 'textarea', function (){
$(this).height(0).height(this.scrollHeight);
}).find( 'textarea' ).change();

/*------------Start Date Process ---------*/
// var today_date = new Date;
// var dd = today_date.getDate();
// var mm = today_date.getMonth() + 1; //January is 0!
// var yyyy = today_date.getFullYear();
//
// today_date = yyyy + '/' + mm + '/' + dd;
//
// jQuery('.datepicker1').datetimepicker({
//     timepicker:false,
//     format:'d-M-Y',
//     weeks: false,
//     dayOfWeekStart: 1,
//     lazyInit: true,
//     scrollInput: false,
//     // maxDate: today_date,
// });
/*-----------End Date Process------------*/

documentOption();
$("#document_type").on("change", function (e) {
documentOption();
});





//Document type option
function documentOption() {

var choice = document_type;

/*Hide and disable all*/
$(".option_div").hide();
// $(".option_input").prop('disabled', true);
switch (choice){

default:

break;
}

}
});



</script>



@endpush