

<option   value="" disabled="disabled" selected="selected"></option>

{{--Placeholder--}}
@if(isset($placeholder))
    <option   value=""></option>
@endif

@foreach ($options as $value)

    @if(isset($custom_name) && isset($custom_id))
        {{--Default--}}
        <option   class="options" value="{{ $value->$custom_id }}">{{ $value->$custom_name }}</option>

    @elseif(isset($custom_name))
        {{--Custom--}}
        <option  class="options" value="{{ $value->id }}">{{ $value->$custom_name }}</option>

    @elseif(isset($custom_id))
        {{--Custom--}}
        <option class="options" value="{{ $value->$custom_id }}">{{ $value->name }}</option>
    @else
        {{--Custom--}}
        <option  class="options" value="{{ $value->id }}">{{ $value->name }}</option>
    @endif


@endforeach
