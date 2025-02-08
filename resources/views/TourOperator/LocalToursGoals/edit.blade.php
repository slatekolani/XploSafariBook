@extends('layouts.main', ['title' => __("Edit Local Tour Goal"), 'header' => __("Edit Local Tour Goal")])

@include('includes.validate_assets')
@section('content')

{{ Form::model($tourOperatorLocalTourGoal,['route' => ['tourCompanyLocalToursGoals.update', $tourOperatorLocalTourGoal->uuid], 'method'=>'put','autocomplete' => 'off',
'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate']) }}
{{ Form::hidden('user_id', $tourOperatorLocalTourGoal->id, []) }}
@csrf
    <section>
        <div class="row" style="margin: auto">
            <div class="col-md-12">
                <div class="card" style="margin: auto">
                    <div class="card-body">
                        <div class="col-md-12">
                            <p>{{ getLanguageBlock('lang.auth.mandatory-field') }}</p>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('goal_description', __("Goal Description"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('goal_description', $tourOperatorLocalTourGoal->goal_description, ['class' => 'form-control','placeholder'=>'This is my Year!!!','maxLength'=>'100', 'autocomplete' => 'off', 'id' => 'goal_description', 'required']) }}
                                        {!! $errors->first('goal_description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>  
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('year', __("Goal setting Year"), ['class' => 'required_asterik']) }}
                                        {{ Form::select('year',$years, $tourOperatorLocalTourGoal->year, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'year', 'required']) }}
                                        {!! $errors->first('year', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>  
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('number_of_tours_to_be_made', __("Number of tours to be made"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('number_of_tours_to_be_made', $tourOperatorLocalTourGoal->number_of_tours_to_be_made, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'number_of_tours_to_be_made', 'required']) }}
                                        {!! $errors->first('number_of_tours_to_be_made', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>  
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('number_of_travellers', __("Total number of travellers"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('number_of_travellers', $tourOperatorLocalTourGoal->number_of_travellers, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'number_of_travellers', 'required']) }}
                                        {!! $errors->first('number_of_travellers', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>  
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('number_of_mail_subscribers', __("Total mail subscribers you want"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('number_of_mail_subscribers', $tourOperatorLocalTourGoal->number_of_mail_subscribers, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'number_of_mail_subscribers', 'required']) }}
                                        {!! $errors->first('number_of_mail_subscribers', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>  
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('number_of_tour_reviewers', __("Total number of tour reviewers"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('number_of_tour_reviewers', $tourOperatorLocalTourGoal->number_of_tour_reviewers, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'number_of_tour_reviewers', 'required']) }}
                                        {!! $errors->first('number_of_tour_reviewers', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>  
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('projected_revenue', __("Projected Revenue"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('projected_revenue', $tourOperatorLocalTourGoal->projected_revenue, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'projected_revenue', 'required']) }}
                                        {!! $errors->first('projected_revenue', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>  
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Revenue Breakdown</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Month</th>
                                                <th>Projected Revenue</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="revenueBreakdown">
                                            @foreach ($existingRevenueBreakdown as $breakdown)
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="breakdown_id[]" value="{{ $breakdown->id }}">
                                                    <select name="month[]" class="form-control month-select" required>
                                                        <option value="">Select Month</option>
                                                        <option value="January" {{ $breakdown->month == 'January' ? 'selected' : '' }}>January</option>
                                                        <option value="February" {{ $breakdown->month == 'February' ? 'selected' : '' }}>February</option>
                                                        <option value="March" {{ $breakdown->month == 'March' ? 'selected' : '' }}>March</option>
                                                        <option value="April" {{ $breakdown->month == 'April' ? 'selected' : '' }}>April</option>
                                                        <option value="May" {{ $breakdown->month == 'May' ? 'selected' : '' }}>May</option>
                                                        <option value="June" {{ $breakdown->month == 'June' ? 'selected' : '' }}>June</option>
                                                        <option value="July" {{ $breakdown->month == 'July' ? 'selected' : '' }}>July</option>
                                                        <option value="August" {{ $breakdown->month == 'August' ? 'selected' : '' }}>August</option>
                                                        <option value="September" {{ $breakdown->month == 'September' ? 'selected' : '' }}>September</option>
                                                        <option value="October" {{ $breakdown->month == 'October' ? 'selected' : '' }}>October</option>
                                                        <option value="November" {{ $breakdown->month == 'November' ? 'selected' : '' }}>November</option>
                                                        <option value="December" {{ $breakdown->month == 'December' ? 'selected' : '' }}>December</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="revenue_breakdown[]" class="form-control" value="{{ $breakdown->revenue_breakdown }}" required>
                                                </td>
                                                <td>
                                                    @if ($loop->first)
                                                    <button type="button" class="btn btn-primary btn-sm addMonthBreakdown">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                    
                                                    @else
                                                    <button type="button" class="btn btn-danger btn-sm removeMonthBreakdown">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <a href="{{route('tourCompanyLocalToursGoals.deleteMonthBreakdown',$breakdown->uuid)}}" type="button" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>Delete
                                                    </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Package Type Segmentation</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Package Type</th>
                                                <th>Total tours related to the group</th>
                                                <th>Total travellers in that group</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="packageTypeSegmentation">
                                            @forelse ($existingPackageTypeSegmentations as $segmentation)
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="segmentation_id[]" value="{{ $segmentation->id }}">
                                                    <select name="package_type[]" class="form-control select2 package-type-select" required>
                                                        <option value="">Select Package Type</option>
                                                        @foreach ($packageTypes as $type)
                                                            <option value="{{ $type }}" {{ $segmentation->package_type == $type ? 'selected' : '' }}>
                                                                {{ $type }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="total_tours[]" class="form-control" value="{{ $segmentation->total_tours }}" required>
                                                </td>
                                                <td>
                                                    <input type="number" name="total_travellers[]" class="form-control" value="{{ $segmentation->total_travellers }}" required>
                                                </td>
                                                <td>
                                                    @if ($loop->first)
                                                    <button type="button" class="btn btn-primary btn-sm addPackageSegmentation">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                    @else
                                                    <button type="button" class="btn btn-danger btn-sm removePackageSegmentation">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <a href="{{route('tourCompanyLocalToursGoals.deletePackageSegmentation',$segmentation->uuid)}}" type="button" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>Delete
                                                    </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <input name="tour_operator_id" value="{{$tourOperatorLocalTourGoal->tour_operator_id}}" hidden>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="element-form">
                                        <div class="form-group pull-left">
                                            {{ Form::button(trans('Update'), ['class' => 'btn btn-primary', 'type'=>'submit','style' => 'border-radius: 5px;']) }}
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
@endpush
@push('after-scripts')
<script>
$(document).ready(function() {
    // Keep track of selected months
    let selectedMonths = new Set();

    // Function to get available months
    function getAvailableMonths() {
        const months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        return months.filter(month => !selectedMonths.has(month));
    }

    // Function to update dropdown options
    function updateDropdowns() {
        selectedMonths.clear();
        $('.month-select').each(function() {
            const selectedValue = $(this).val();
            if (selectedValue) {
                selectedMonths.add(selectedValue);
            }
        });

        $('.month-select').each(function() {
            const currentValue = $(this).val();
            const availableMonths = getAvailableMonths();
            
            // Store current selection
            const currentSelection = $(this).val();
            
            // Clear and rebuild dropdown
            $(this).find('option:not(:first)').remove();
            
            // Add back the current selection if it exists
            if (currentSelection) {
                $(this).append(`<option value="${currentSelection}" selected>${currentSelection}</option>`);
            }
            
            // Add available months
            availableMonths.forEach(month => {
                if (month !== currentSelection) {
                    $(this).append(`<option value="${month}">${month}</option>`);
                }
            });
        });
    }

    // Handle adding new row
    $('.addMonthBreakdown').click(function() {
        const newRow = `
            <tr>
                <td>
                    <select name="month[]" class="form-control month-select" required>
                        <option value="">Select Month</option>
                    </select>
                </td>
                <td>
                    <input type="number" name="revenue_breakdown[]" class="form-control" placeholder="Enter revenue breakdown" required>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm removeMonthBreakdown">
                        <i class="fas fa-minus"></i>
                    </button>
                </td>
            </tr>
        `;
        
        $('#revenueBreakdown').append(newRow);
        updateDropdowns();
    });

    // Handle removing row
    $(document).on('click', '.removeMonthBreakdown', function() {
        $(this).closest('tr').remove();
        updateDropdowns();
    });

    // Handle month selection change
    $(document).on('change', '.month-select', function() {
        updateDropdowns();
    });

    // Initial update
    updateDropdowns();
});
</script>
@endpush


{{-- Segments Scripts --}}
@push('after-scripts')
<script>
$(document).ready(function() {
    // Initialize select2 for existing and future selects
    function initializeSelect2(element) {
        $(element).select2({
            width: '100%',
            dropdownParent: $(element).closest('.card-body')
        });
    }

    // Initialize existing select2
    $('.package-type-select').each(function() {
        initializeSelect2(this);
    });

    // Keep track of selected package types
    let selectedTypes = new Set();

    // Function to update available package types
    function updatePackageTypes() {
        selectedTypes.clear();
        $('.package-type-select').each(function() {
            const selectedValue = $(this).val();
            if (selectedValue) {
                selectedTypes.add(selectedValue);
            }
        });

        $('.package-type-select').each(function() {
            const currentValue = $(this).val();
            $(this).find('option:not(:first)').each(function() {
                const optionValue = $(this).val();
                if (optionValue !== currentValue) {
                    $(this).prop('disabled', selectedTypes.has(optionValue));
                }
            });
        });
    }

    // Handle adding new row
    $('.addPackageSegmentation').click(function() {
        const newRow = `
            <tr>
                <td>
                    <select name="package_type[]" class="form-control select2 package-type-select" required>
                        <option value="">Select Package Type</option>
                        @foreach($packageTypes as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="total_tours[]" class="form-control" placeholder="Enter total tours" required>
                </td>
                <td>
                    <input type="number" name="total_travellers[]" class="form-control" placeholder="Enter total travellers" required>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm removePackageSegmentation">
                        <i class="fas fa-minus"></i>
                    </button>
                </td>
            </tr>
        `;
        
        $('#packageTypeSegmentation').append(newRow);
        
        // Initialize select2 for new row
        initializeSelect2($('#packageTypeSegmentation tr:last-child .package-type-select'));
        updatePackageTypes();
    });

    // Handle removing row
    $(document).on('click', '.removePackageSegmentation', function() {
        $(this).closest('tr').remove();
        updatePackageTypes();
    });

    // Handle package type selection change
    $(document).on('change', '.package-type-select', function() {
        updatePackageTypes();
    });

    // Initial update
    updatePackageTypes();
});
</script>
@endpush




