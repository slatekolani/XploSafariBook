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
                <br>
                @foreach($searchedTourPackage as $tourPackage)
                <p class="card-title">&image;Exploring searched item "{{$tourPackage}}"</p>
                @endforeach


                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            @if(!empty($tourPackages) && $tourPackages->count())
                                @foreach($tourPackages as $tourPackage)

                                    <div class="col-md-4" style="margin-top: 15px">
                                        <div class="card">
                                            <a href="{{route('tourPackages.publicView',$tourPackage->uuid)}}"
                                               style="text-decoration: none">
                                                <img class="card-img-top"
                                                     src="{{asset('public/blogImages/'.$tourPackage->safari_poster)}}"
                                                     style="height: auto;width: 100%">
                                                <div class="card-body"
                                                     style="background-color: rgba(255,255,255,0.85);color:black">
                                                    <p class="card-title"
                                                       style="font-family: sans-serif, Verdana">{{$tourPackage->safari_package_description}}</p>
                                                    <p class="card-text"><b>Main
                                                            Safari</b>: {{\App\Models\TouristicAttractions\touristicAttractions::find($tourPackage->main_safari_name)->attraction_name}}
                                                    </p>
                                                    <p class="card-text"><b>Foreigner</b>:
                                                        ${{number_format($tourPackage->trip_price_adult_foreigner)}}
                                                        /Adult -
                                                        ${{number_format($tourPackage->trip_price_child_foreigner)}}
                                                        /child</p>
                                                    <p class="card-text"><b>Tanzanian</b>:
                                                        Shs{{number_format($tourPackage->trip_price_adult_tanzanian)}}
                                                        /Adult -
                                                        Shs{{number_format($tourPackage->trip_price_child_tanzanian)}}
                                                        /Child</p>
                                                    <p class="card-text"><b>Tour
                                                            Types</b>: {{App\Models\TourTypes\tourTypes::find(DB::table('tour_package_tour_type')->where('tour_package_id',$tourPackage->id)->pluck('tour_type_id'))->pluck('tour_type_name')->implode('-')}}</p>
                                                    <div style="display: flex">
                                                        <p class="card-text"><b>Start
                                                                date</b>:{{date('jS M Y',strtotime($tourPackage->safari_start_date))}}
                                                        </p>
                                                        <p class="card-text" style="padding-left: 10px"><b>End
                                                                date</b>:{{date('jS M Y',strtotime($tourPackage->safari_end_date))}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                @endforeach
                            @else
                                <p style="padding-left: 20px;background-color: rgba(30,144,255,0.2);border-left: 2px solid dodgerblue">I'm sorry, but it seems that neither the safari package you're looking for nor a tour operator operating in that attraction is available on our platform. However, we can assist you in finding a suitable tour operator. Please don't hesitate to contact us via WhatsApp or email. We highly prioritize your privacy and assure you that your contact information will not be shared with any third parties. For more details, please review our comprehensive terms and conditions, which explain how we handle your data </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endguest
@endsection
