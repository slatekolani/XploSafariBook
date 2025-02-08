@extends('layouts.main', ['title' => __("Search Results"), 'header' => __("Search Results")])

@push('after-styles')
    {{ Html::style(url('vendor/select2/css/select2.min.css')) }}
    <style>

    </style>
@endpush

@section('content')
    @guest

        <div class="card">
            <div class="card-body">
                <div class="row" style="padding-top: 5px">
                    <p class="card-title">&image;Exploring searched item "{{$term}}"</p>

                    <div class="col-md-12">
                        <form class="search-bar" type="get" action="{{route('tourPackages.search')}}" style="padding-top: 20px;position: relative">
                            <div class="input-group">
                                <div class="form-outline">
                                    <input type="search" id="form1" name="search" class="form-control"
                                           style="width: 400px;" placeholder="Search place you want to explore"/>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search" style="width: 40px"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="col-md-12" style="padding-top: 10px">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <p style="padding-left: 20px;background-color: rgba(30,144,255,0.2);border-left: 2px solid dodgerblue">Unfortunately, it appears that our tour operators have not yet posted the package you are looking for. However, here is a list of tour operators operating in the region. Please check their profiles to choose the one that can take you to your desired attraction</p>

                                @if(!empty($tourOperatorsOperatingAround) && $tourOperatorsOperatingAround->count())
                                        @foreach($tourOperatorsOperatingAround as $tourOperatorOperatingAround)
                                            <div style="border: 2px solid gainsboro;margin-top: 10px">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <img src="{{url('public/CompaniesTeamImage/',$tourOperatorOperatingAround->company_team_image)}}" style="width: 100%;height: auto;padding: 0 10px 10px 10px;filter: contrast(120%)">
                                                </div>
                                                <div class="col-md-8">
                                                    <p class="card-title">{{$tourOperatorOperatingAround->company_name}}</p>
                                                    <p>"{{$tourOperatorOperatingAround->about_company}}"</p>
                                                    <p style="font-size: 15px"><b>Safari Preferences</b>: {{$tourOperatorOperatingAround->TourOperatorSafariPreferencesLabel}}</p>
                                                    <p style="font-size: 15px"><b>Company nation</b>: {{\App\Models\Nations\nations::find($tourOperatorOperatingAround->company_nation)->nation_name}} - <img src="{{url('public/nationFlags/',\App\Models\Nations\nations::find($tourOperatorOperatingAround->company_nation)->nation_flag)}}" style="width: 20px;height: 20px;border-radius: 50%"></p>
                                                    @if($tourOperatorOperatingAround->status==1)
                                                        <p style="font-size: 15px"><b>Company Status</b>: <span class="badge badge-primary">Verified</span></p>
                                                    @else
                                                        <span>Unverified</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="{{route('tourOperator.publicView',$tourOperatorOperatingAround->uuid)}}" style="float: right" class="btn btn-primary btn-sm">{{$tourOperatorOperatingAround->company_name}} &blacktriangleright;</a>
                                            </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p style="padding-left: 20px;background-color: rgba(30,144,255,0.2);border-left: 2px solid red">Error</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endguest
@endsection
