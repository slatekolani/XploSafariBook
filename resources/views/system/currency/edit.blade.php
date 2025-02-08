@extends('layouts.main', ['title' => __("label.crud.create"), 'header' => __("label.crud.create")])

@push('after-styles')
    {{ Html::style(url('vendor/select2/css/select2.min.css')) }}
    {{ Html::style(url('vendor/select2-bootstrap-theme/select2-bootstrap.min.css')) }}

@endpush

@section('content')

    <div class="row">


        <div class="col">

            <div class="row">
                <div class="col-lg-12">
                    <section class="card">

                        <header class="card-header">


                            <h2 class="card-title">@lang('label.crud.edit')</h2>
                        </header>

                        <div class="card-body">

                            {{ Form::open(['route' => ['currency.update', $currency->id],'class' => 'form-horizontal form-bordered', 'id'=>'manifest-form', 'novalidate']) }}


                            <div class="form-group row mx-auto">
                                {{--<label class="col-lg-3 control-label text-lg-right pt-2 required_asterik">@lang('label.manifest.upload')</label>--}}
                                {{ Form::label('currency_name', trans("label.currencies.name"), ['class' => 'col-lg-3 control-label text-lg-right pt-2 required_asterik'] ) }}
                                <div class="col-lg-6">
                                    <div class="input-group"><br>
                                        {{ Form::text('currency_name', $currency->name,['class' => 'form-control col-6','id' => 'currency_name', 'required']) }}
                                    </div>
    {!! $errors->first('currency_name', '<span class="badge badge-danger">:message</span>') !!}
 </div>
</div>
<div class="form-group row mx-auto">
 {{--<label class="col-lg-3 control-label text-lg-right pt-2 required_asterik">@lang('label.manifest.upload')</label>--}}
 {{ Form::label('currency_name', trans("label.currencies.symbol"), ['class' => 'col-lg-3 control-label text-lg-right pt-2 required_asterik'] ) }}
 <div class="col-lg-6">
     <div class="input-group"><br>
         {{ Form::text('currency_symbol', $currency->display_symbol,['class' => 'form-control col-6','id' => 'currency_name', 'required']) }}
     </div>
    {!! $errors->first('currency_symbol', '<span class="badge badge-danger">:message</span>') }!!}
</div>
</div>
<div class="form-group row mx-auto">
{{--<label class="col-lg-3 control-label text-lg-right pt-2 required_asterik">@lang('label.manifest.upload')</label>--}}
{{ Form::label('currency_name', trans("label.currencies.code"), ['class' => 'col-lg-3 control-label text-lg-right pt-2 required_asterik'] ) }}
<div class="col-lg-6">
    <div class="input-group"><br>
        {{ Form::text('currency_code', $currency->code,['class' => 'form-control col-6','id' => 'currency_name', 'required']) }}
    </div>
    {!!  $errors->first('currency_code', '<span class="badge badge-danger">:message</span>') !!}
</div>
</div>


<hr/>

<div class="form-group row">
<div class="col-lg-12">
   <div class="input-group">
       {{ Form::submit(__('buttons.general.crud.update'),['class' => 'col-lg-3 btn btn-primary mx-auto', 'id'=>'manifest-submit']) }}
   </div>
</div>
</div>
</div>
{{ Form::close() }}
</section>
</div>
</div>


</div>

</div>

@endsection