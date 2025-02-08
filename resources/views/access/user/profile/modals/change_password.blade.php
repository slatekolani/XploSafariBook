@include('includes.validate_assets')
{{ Form::model($user,['route' => ['user.change_password', $user->uuid], 'method'=>'put','autocomplete' => 'off', 'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate']) }}
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content col-md-9">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('label.change_password') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-xs-12col-lg-12 col-md-12 col-sm-612 col-xs-12">
                                <div class="form-group">
                                    {{ Form::label('old_password', __("label.old_password"), ['class' => 'required_asterik']) }}
                                    {{ Form::password('old_password', ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'old_password', 'required']) }}
{!!  $errors->first('old_password', '<span class="badge badge-danger">:message</span>')!!}
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="row">
<div class="col-xs-12col-lg-12 col-md-12 col-sm-612 col-xs-12">
<div class="form-group">
  {{ Form::label('password', __("label.new_password"), ['class' => 'required_asterik']) }}
  {{ Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'new_password', 'required']) }}
{!! $errors->first('password', '<span class="badge badge-danger">:message</span>') !!}
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="row">
<div class="col-xs-12col-lg-12 col-md-12 col-sm-612 col-xs-12">
<div class="form-group">
{{ Form::label('password', __("label.password_confirmation"), ['class' => 'required_asterik']) }}
{{ Form::password('password_confirmation', ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'password_confirmation', 'required']) }}
{!! $errors->first('password_confirmation', '<span class="badge badge-danger">:message</span>')!!}
</div>
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default"
data-dismiss="modal">{{ __('buttons.general.cancel') }}</button>
{{ Form::button(trans('label.submit'), ['class' => 'btn btn-primary', 'type'=>'submit', 'style' => 'border-radius: 5px;']) }}
</div>
</div>
</div>
</div>
{{ Form::close() }}
