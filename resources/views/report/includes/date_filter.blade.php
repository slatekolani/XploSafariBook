


{{--DATE RANGE TO BE USED IN SEARCH IN THE REPORT--}}
{{--Date Filter Type: 1 => Date Range, 2 => Monthly, 3 => Daily date--}}

@include('includes.datetimepicker')

{{ Form::hidden('today', getTodayDate(), ['class' =>'']) }}

<br/>
{{--1. Date Range--}}
@if($date_filter_type == 1)
    <div class="row">
        <div class="col-sm-12">
            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-lg-4" >{{  __('label.from_date')}}:</label>
                        <div class="form-group input-group">
						          <span class="input-group-prepend">
						             <span class="input-group-text">
						            	<i class="fas fa-calendar-alt"></i>
						              </span>
						           </span>
                            {{ Form::text('from_date',(isset($request['from_date']) ? short_date_format($request['from_date']) : null) , ['placeholder' => 'From Date'  ,'id'=>'from_date', 'class' => 'form-control datepicker1','required', 'autocomplete'=>"off",
                            'style'
                             =>
                            'background-color:
                            white;']) }}
                        </div>
    {!! $errors->first('from_date', '<span class="badge badge-danger">:message</span>') !!}

</div>
</div>

<div class="col-md-3">
<div class="form-group ">
    <label class="col-lg-4" >{{ __('label.to_date') }}:</label>
    <div class="form-group input-group">
              <span class="input-group-prepend">
                 <span class="input-group-text">
                    <i class="fas fa-calendar-alt"></i>
                  </span>
               </span>
        {{ Form::text('to_date',(isset($request['to_date']) ? short_date_format($request['to_date']) : null)  , ['placeholder' => 'To Date'  ,'id'=>'to_date', 'class' => 'form-control datepicker1',  'autocomplete'=>"off",   'required','style' => 'background-color:
        white;']) }}
    </div>
    {!! $errors->first('to_date', '<span class="badge badge-danger">:message</span>')  !!}
</div>
</div>

</div>
</div>
</div>

@endif


{{--2. Monthly--}}
@if($date_filter_type == 2)
<div class="row">
<div class="col-sm-12">
<div class="row">

<div class="col-md-3">

<div class="form-group">
    <label class="col-lg-4" >{{ __('label.month')}}:</label>
    <div class="form-group input-group">

        {{  Form::selectMonth('search_month',isset($request['search_month']) ? $request['search_month'] : null, ['style' => 'width:100%','class' => 'form-control select2','width' => '100%', 'placeholder' =>
    trans('label.month') ,'id'=> 'contrib_month']) }}
    </div>
{!! $errors->first('search_month', '<span class="badge badge-danger">:message</span>') !!}

</div>
</div>

<div class="col-md-3">
<div class="form-group ">
<label class="col-lg-4" >{{ __('label.year')}}:</label>
<div class="form-group input-group">

    {{  Form::selectRange('search_year',Carbon\Carbon::now()->format('Y'),Carbon\Carbon::parse(getLaunchDate())->format('Y'),isset($request['search_year']) ? $request['search_year'] : null, ['style' => 'width:100%','class' => 'form-control select2 ','placeholder' =>
  trans('label.year'), 'id'=> 'search_year']) }}
</div>
    {!!  $errors->first('search_year', '<span class="badge badge-danger">:message</span>') !!}
   </div>
   </div>

   </div>

   </div>
   </div>

   @endif

   {{--3. Daily--}}
   @if($date_filter_type == 3)
   <div class="row">
   <div class="col-sm-12">
   <div class="row">
   <div class="col-md-3">
   <div class="form-group">
   <label class="col-lg-4" >{{ __('label.search_date')}}:</label>
   <div class="form-group input-group">
             <span class="input-group-prepend">
                <span class="input-group-text">
                   <i class="fas fa-calendar-alt"></i>
                 </span>
              </span>
       {{ Form::text('search_date',(isset($request['search_date']) ? short_date_format($request['search_date']) : null) , ['placeholder' => 'From Date'  ,'id'=>'search_date', 'class' => 'form-control datepicker1','required', 'autocomplete'=>"off",
       'style'
        =>
       'background-color:
       white;']) }}
   </div>
   {{  $errors->first('search_date', '<span class="badge badge-danger">:message</span>')   }}

   </div>
   </div>
   </div>
   </div>
   </div>

   @endif

   {{--4. Yearly--}}
   @if($date_filter_type == 4)
   <div class="row">
   <div class="col-sm-12">
   <div class="row">
   <div class="col-md-3">
   <div class="form-group ">
   <label class="col-lg-4" >{{ __('label.year')}}:</label>
   <div class="form-group input-group">

       {{  Form::selectRange('search_year',Carbon\Carbon::now()->format('Y'),getLaunchDate(),isset($request['search_year']) ? $request['search_year'] : null, ['style' => 'width:100%','class' => 'form-control select2 ','placeholder' =>
     trans('label.year'), 'id'=> 'search_year']) }}
   </div>
   {!! $errors->first('search_year', '<span class="badge badge-danger">:message</span>') !!}
</div>
</div>
</div>
</div>
</div>

@endif








@push('after-scripts')



<script >
$(function (){

jQuery('.select2-container').css('width','100%');



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
// minDate: today_date,
});


/*-----------End Date Process------------*/

});

</script>
@endpush
