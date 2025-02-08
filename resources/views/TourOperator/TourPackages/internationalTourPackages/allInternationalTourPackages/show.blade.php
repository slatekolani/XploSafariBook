@extends('layouts.main', ['title' => __("All International Tour Packages"), 'header' => __("All International Tour Packages")])

@push('after-styles')
    {{ Html::style(url('vendor/select2/css/select2.min.css')) }}
    <style>

    </style>
@endpush

@section('content')
    @guest
        <div class="card" style="padding-top: 10px">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p style="border-left: 5px solid dodgerblue;padding-left:5px;font-size: 20px;margin:10px 10px 10px 10px"> International Safari Packages</p>
                        <div class="row">
                            @if(!empty($internationalTourPackages) && $internationalTourPackages->count())
                                @foreach($internationalTourPackages as $internationalTourPackage)

                                    <div class="col-md-4" style="margin-top: 15px">
                                        <div class="card">
                                            <a href="{{route('tourPackages.publicView',$internationalTourPackage->uuid)}}"
                                               style="text-decoration: none">
                                                <img class="card-img-top"
                                                     src="{{asset('public/blogImages/'.$internationalTourPackage->safari_poster)}}"
                                                     style="height: auto;width: 100%;filter: contrast(120%)" loading="lazy">
                                                <div class="card-body"
                                                     style="background-color: rgba(255,255,255,0.85);color:black">
                                                    <p class="card-title"
                                                       style="font-family: sans-serif, Verdana">{{$internationalTourPackage->safari_package_description}}</p>
                                                    <p class="card-text"><b>Main
                                                            Safari</b>: {{\App\Models\TouristicAttractions\touristicAttractions::find($internationalTourPackage->main_safari_name)->attraction_name}}
                                                    </p>
                                                    <p class="card-text"><b>Foreigner</b>:
                                                        ${{number_format($internationalTourPackage->trip_price_adult_foreigner)}}
                                                        /Adult -
                                                        ${{number_format($internationalTourPackage->trip_price_child_foreigner)}}
                                                        /child</p>
                                                    <p class="card-text"><b>Tanzanian</b>:
                                                        Shs{{number_format($internationalTourPackage->trip_price_adult_tanzanian)}}
                                                        /Adult -
                                                        Shs{{number_format($internationalTourPackage->trip_price_child_tanzanian)}}
                                                        /Child</p>
                                                    <p class="card-text"><b>Tour
                                                            Types</b>: {{$internationalTourPackage->TourPackagesTourTypesLabel}}</p>
                                                    <div style="display: flex">
                                                        <p class="card-text"><b>Start
                                                                date</b>:{{date('jS M Y',strtotime($internationalTourPackage->safari_start_date))}}
                                                        </p>
                                                        <p class="card-text" style="padding-left: 10px"><b>End
                                                                date</b>:{{date('jS M Y',strtotime($internationalTourPackage->safari_end_date))}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                @endforeach
                            @else
                                <p style="padding-left: 20px">No packages posted yet</p>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endguest
    @auth
        @if(Auth::user()->role==2)
            @include('TourOperator.overviewDashboard.view')
        @endif
    @endauth
@endsection
