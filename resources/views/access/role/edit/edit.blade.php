@extends('layouts.main', ['title' => $role->name, 'header' => trans('label.administrator.system.access_control.edit_role')])


@section('content')

    <div class="row">
        <div class="col-md-12">
            <section class="card card-featured card-featured-primary mb-4">

                <div class="card-body">
                    {{ Form::model($role,['route' => ['access.role.update', $role->id], 'method'=>'put','autocomplete' => 'off',
    'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate']) }}

                    {{ Form::hidden('role_id', $role->id, []) }}

                    <div class="row form-group">
                        <div class="col-md-6">
                            <div class="input-group ">
                                <label class="col-lg-3 required_asterik" >{{ __('label.name')}}:</label>
                                {{ Form::text('name', null, ['class' => 'form-control col-lg-9', 'autocomplete' => 'off', 'id' => 'name', 'required']) }}
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6">
                            <div class="input-group text_content">
                                <label class="col-lg-3" >{{ __('label.description')}}:</label>
                                {{ Form::textarea('description',null,['class'=>'form-control col-lg-9', 'placeholder'=>'', '']) }}
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6">
                            <div class="input-group text_content">
                                <label class="col-lg-3 required_asterik" >{{ __('label.is_admin')}}:</label>
                                {{ Form::select('isadmin', ['1' => __('label.yes'), '0' => __('label.no') ],$role->isadmin, ['class' => 'form-control select2', 'placeholder' => '', 'autocomplete' => 'off', '' , 'id' => 'isadmin', 'aria-describedby' => '', 'required']) }}
    {!! $errors->first('isadmin', '<span class="badge badge-danger">:message</span>') !!}
</div>
</div>
</div>


<hr class="hr-custom">

@if(isset($first_permission_group))
@include('access/role/edit/includes/permissions')
@endif
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
