@extends('layouts.main', ['title' => trans('label.administrator.system.access_control.add_role'), 'header' => trans('label.administrator.system.access_control.add_role')])

@include('includes.validate_assets')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <section class="card card-featured card-featured-primary mb-4">

                <div class="card-body">
                    {{ Form::open(['route' => ['access.role.store'], 'autocomplete' => 'off','method'=> 'Post', 'id' => 'store', 'class' => 'needs-validation', 'novalidate', 'enctype'=>"multipart/form-data"]) }}
                    <p>{{ getLanguageBlock('lang.auth.mandatory-field') }}</p>
                    <div class="form-group">
                        <div class="row form-group">
                            <div class="col-md-6">
                                {{ Form::label('name', trans('label.name'), ['class' => 'required_asterik']) }}
                                {{ Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'name', 'aria-describedby' => '', 'required']) }}
    {!!  $errors->first('name', '<span class="badge badge-danger">:message</span>')!!}
 </div>
 <div class="col-md-6">

 </div>
</div>
<div class="row form-group">
 <div class="col-md-6 text_content">
     {{ Form::label('description', trans('label.description')) }}
     {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '4', 'autocomplete' => 'off', 'id' => 'editor', 'aria-describedby' => 'contentHelp']) }}
    {!! $errors->first('description', '<span class="badge badge-danger">:message</span>') !!}
</div>
</div>

<div class="row form-group">
<div class="col-md-6 text_content">
    {{ Form::label('isadmin', trans('label.is_admin') , ['class' => 'required_asterik']) }}
    {{ Form::select('isadmin', ['1' => __('label.yes'), '0' => __('label.no') ],[], ['class' => 'form-control select2', 'placeholder' => '', 'autocomplete' => 'off', '' , 'id' => 'isadmin', 'aria-describedby' => '', 'required']) }}
    {!!  $errors->first('isadmin', '<span class="badge badge-danger">:message</span>') !!}
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group text-center">
{{ link_to_route('access.role.index',trans('buttons.general.cancel'),[],['id'=> 'cancel', 'class' => 'btn btn-primary cancel_button', ]) }}
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
$('.text_content').on( 'change keyup keydown paste cut', 'textarea', function (){
$(this).height(0).height(this.scrollHeight);
}).find( 'textarea' ).change();

$(".select2").select2();
});



</script>








@endpush