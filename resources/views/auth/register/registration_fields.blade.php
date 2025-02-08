{{-- 
<div class="row">
    <div class="col-sm-12" >
        <div class="row" style="justify-content: center">
            <div class="col-md-11">
                    <div class="form-group">
                        {{ Form::label('username', __("label.username"), ['class' => 'required_asterik']) }}
                        {{ Form::text('username', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'username', 'required']) }}
                        {!! $errors->first('username', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12" >
        <div class="row" style="justify-content: center">
            <div class="col-md-11">
                <div class="form-group">
                    {{ Form::label('email', __("label.email"), ['class' => 'required_asterik']) }}
                    {{ Form::email('email', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'email', 'aria-describedby' => 'emailHelp', 'required']) }}
                    {!! $errors->first('email', '<span class="badge badge-danger">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12" >
        <div class="row" style="justify-content: center">
            <div class="col-md-11">
                <div class="form-group">
                    {{ Form::label('phone', __("label.phone"), ['class' => 'required_asterik']) }}
                    {{ Form::tel('phone', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'phone', 'aria-describedby' => 'phoneHelp', 'required']) }}
                    {!! $errors->first('phone', '<span class="badge badge-danger">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12" >
        <div class="row" style="justify-content: center">
            <div class="col-md-11">
                <div class="form-group">
                    {{ Form::label('password', __("label.password"), ['class' => 'required_asterik']) }}
                    {{ Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'password', 'required']) }}
                    {!! $errors->first('password', '<span class="badge badge-danger">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12" >
        <div class="row" style="justify-content: center">
            <div class="col-md-11">
                <div class="form-group">
                    {{ Form::label('password_confirmation', __("label.password_confirmation"), ['class' => 'required_asterik']) }}
                    {{ Form::password('password_confirmation', ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'password_confirmation', 'required']) }}
                    {!! $errors->first('password_confirmation', '<span class="badge badge-danger">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="form-group">
                    {{ Form::label('role', __("Register as?"), ['class' => 'required_asterik']) }}
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="role" id="TourOperator" value="2">
                        <label for="TourOperator" class="form-check-label">Tour Operator</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="role" id="Tourist" value="3">
                        <label for="Tourist" class="form-check-label">Tourist</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('after-scripts')

    <script>
        $(function () {
            $(".select2").select2();
        });
    </script>
@endpush --}}
