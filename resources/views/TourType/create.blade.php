@extends('layouts.main', ['title' => __("Add Tour Type"), 'header' => __('Add Tour Type')])

@include('includes.validate_assets')
<style>
    .star-rating {
        direction: rtl;
        display: inline-flex;
        font-size: 1.5rem;
    }
    .star-rating input[type="radio"] {
        display: none;
    }
    .star-rating label {
        color: #ccc;
        cursor: pointer;
        padding: 0 5px;
    }
    .star-rating input[type="radio"]:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #ffc107;
    }
</style>
@section('content')

    {{ Form::open(['route'=>'tourType.store', 'autocomplete' => 'off','method' => 'post', 'class' => 'needs-validation', 'novalidate']) }}
    @csrf
    <section>
        <div class="row" style="margin: auto">
            <div class="col-md-12">
                <div class="card" style="margin: auto">
                    <div class="card-body">
                        <div class="col-md-12">
                            <p>{{ getLanguageBlock('lang.auth.mandatory-field') }}</p>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body" style="background-color: rgba(255,255,255,0.85); margin-top: 3px">
                                        <div class="col-md-12">
                                            <p class="text-info"><strong>Rate the Experience</strong></p>
                                            <div class="star-rating">
                                                @for ($i = 10; $i >= 1; $i--)
                                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required />
                                                    <label for="star{{ $i }}" title="{{ $i }} stars">&#9733;</label>
                                                @endfor
                                                {!! $errors->first('rating', '<span class="badge badge-danger">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tour_type_name', __("Tour type name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('tour_type_name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tour_type_name', 'required']) }}
                                        {!! $errors->first('tour_type_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-8 col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tour_type_description', __("Tour type description"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('tour_type_description', null, ['class' => 'form-control','maxLength'=>'200','style'=>'height:100px', 'autocomplete' => 'off', 'id' => 'tour_type_description', 'required']) }}
                                        {!! $errors->first('tour_type_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="element-form">
                                        <div class="form-group pull-left">
                                            {{ Form::button(trans('Add'), ['class' => 'btn btn-primary', 'type'=>'submit','style' => 'border-radius: 5px;']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br/>

    {{ Form::close() }}
@endsection
@push('after-scripts')

    <script>
        $(function () {
            $(".select2").select2();


        });

    </script>
<script>
    $(function () {
        $(".select2").select2();

        // Optionally, you could add JavaScript to highlight selected stars
        $('.star-rating input[type="radio"]').change(function() {
            let rating = $(this).val();
            console.log("Selected Rating: ", rating);
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    document.querySelector('form').addEventListener('submit', function(event) {
        if (!document.querySelector('input[name="rating"]:checked')) {
            event.preventDefault();
            alert("Please select a star rating.");
        }
    });
});
</script>
@endpush
