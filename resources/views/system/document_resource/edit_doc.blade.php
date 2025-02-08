@extends('layouts.main', ['title' => trans('label.administrator.system.document.edit_doc'), 'header' => trans('label.administrator.system.document.edit_doc')])

@include('includes.validate_assets')
@include('includes.sweetalert_assets')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <section class="card card-featured card-featured-primary mb-4">

                <div class="card-body">
                    {{ Form::open(['route' => ['system.document_resource.update'], 'autocomplete' => 'off','method'=> 'put', 'id' => 'store', 'class' => 'needs-validation', 'novalidate', 'enctype'=>"multipart/form-data"]) }}
                    {{ Form::hidden('doc_pivot_id', $document_resource->id, ['class' =>'']) }}
                    {{ Form::hidden('document_id', $document_resource->document_id, ['class' =>'']) }}
                    {{ Form::hidden('resource_id', $document_resource->resource_id, ['class' =>'']) }}
                    {{ Form::hidden('return_url', $return_url, ['class' =>'']) }}
                    {{ Form::hidden('allowed_exts', (isset($allowed_exts) ? $allowed_exts : null), ['class' =>'']) }}
                    {{ Form::hidden('allowed_formats', (isset($allowed_formats) ? $allowed_formats : null), ['class' =>'']) }}
                    {{ Form::hidden('action_type', 2, ['class' =>'']) }}

                    <p>{{ getLanguageBlock('lang.auth.mandatory-field') }}</p>

                    <div class="form-group">

                        <div class="pull-right">
                            <div class="btn-group">
                                {{--<a href="{{ route('system.job.delete', $job->id) }}"   class="btn btn-xs  btn-danger">{{ __('label.crud.delete') }}</a>--}}
                                {!!  HTML::decode(link_to_route('system.document_resource.delete', trans('label.crud.delete'), [$document_resource->id, $return_url], ['data-method' => 'delete', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('label.warning'), 'data-trans-text' => trans('alert.general.alert.delete'), 'class' => 'btn btn-danger btn-xs'])) !!}
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                {{ Form::label('name', trans('label.document'), ['class' => '']) }}:
                                {{ $document->name . ' - ' .  $document_resource->name}}
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>

                        {{--<div class="row form-group" id="doc_title_div">--}}
                        {{--<div class="col-md-6 text_content">--}}
                        {{--{{ Form::label('document_title', trans('label.administrator.system.document.title')) }}--}}
                        {{--{{ Form::input( 'text','document_title', null, ['class' => 'form-control option_input', 'id' => 'document_title']) }}--}}
                        {{--{{ $errors->first('document_title', '<span class="help-block label label-danger">:message</span>') }}--}}
                        {{--</div>--}}
                        {{--</div>--}}

                        <div class="row form-group">
                            <div class="col-md-6 text_content">
                                {{ Form::label('attach_doc', trans('label.administrator.system.document.attach_doc') , ['class' => 'required_asterik']) }}
                                {{ Form::file('document_file') }}
                                {!!   $errors->first('document_file', '<span class="help-block label label-danger">:message</span>')!!}
                                @if(isset($allowed_formats) || isset($allowed_exts))
                                    <br/>
                                    <small> {{   __('label.administrator.system.document.allowed_formats') . ' - ' .  (isset($allowed_exts) ?   implode(', ',unserialize($allowed_exts)) :  implode(', ',unserialize($allowed_formats))) }}</small>
                                @endif
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
            var document_type = '{{ $document_resource->document_id }}';
            $(".search-select").select2({});

            $('.text_content').on( 'change keyup keydown paste cut', 'textarea', function (){
                $(this).height(0).height(this.scrollHeight);
            }).find( 'textarea' ).change();

            /*------------Start Date Process ---------*/
            var today_date = new Date;
            var dd = today_date.getDate();
            var mm = today_date.getMonth() + 1; //January is 0!
            var yyyy = today_date.getFullYear();

            today_date = yyyy + '/' + mm + '/' + dd;

            jQuery('.datepicker1').datetimepicker({
                timepicker:false,
                format:'d-M-Y',
                weeks: false,
                dayOfWeekStart: 1,
                lazyInit: true,
                scrollInput: false,
                // maxDate: today_date,
            });
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
                $(".option_input").prop('disabled', true);
                switch (choice){

                    default:

                        break;
                }

            }
        });



    </script>



@endpush