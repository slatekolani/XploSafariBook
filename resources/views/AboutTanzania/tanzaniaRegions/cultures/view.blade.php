@extends('layouts.main', ['title' => __("Tanzania Region - " . $regionCulture->culture_name), 'header' => __('Tanzania Region - ' . $regionCulture->culture_name)])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12" >
            <div class="pull-left" style="margin-bottom: 10px" >
                <a class ='btn btn-primary btn-sm'  href="{{route('regionCulture.edit',$regionCulture->uuid)}}">Edit information</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">

                            <tr>
                                <th>Culture name</th>
                                <td>{{$regionCulture->culture_name}}</td>
                            </tr>
                            <tr>
                                <th>Basic information</th>
                                <td>{{$regionCulture->basic_information}}</td>
                            </tr>
                            <tr>
                                <th>Traditional language</th>
                                <td>{{$regionCulture->traditional_language}}</td>
                            </tr>
                            <tr>
                                <th>Traditional dance</th>
                                <td>{{$regionCulture->traditional_dance}}</td>
                            </tr>
                            <tr>
                                <th>Traditional dance description</th>
                                <td>{{$regionCulture->traditional_dance_description}}</td>
                            </tr>
                            <tr>
                                <th>Traditional food</th>
                                <td>{{$regionCulture->traditional_food}}</td>
                            </tr>
                            <tr>
                                <th>Traditional food description</th>
                                <td>{{$regionCulture->traditional_food_description}}</td>
                            </tr>
                            <tr>
                                <th>Culture history</th>
                                <td>{{$regionCulture->culture_history}}</td>
                            </tr>
                            <tr>
                                <th>Culture characteristics</th>
                                <th>Culture description</th>
                            </tr>
                            @if($regionCultureCharacteristics->isNotEmpty())
                                @foreach($regionCultureCharacteristics as $regionCultureCharacteristic)
                                    <tr>
                                        <td>{{$regionCultureCharacteristic->characteristic_title}}</td>
                                        <td>{{$regionCultureCharacteristic->characteristic_description}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2">No characteristics available</td>
                                </tr>
                            @endif
                            
                            <tr>
                                <th>Activities to appreciate culture</th>
                            </tr>
                            @if($cultureAppreciationActivities->isNotEmpty())
                                @foreach($cultureAppreciationActivities as $cultureAppreciationActivity)
                                    <tr>
                                        <td>{{$cultureAppreciationActivity->appreciation_activity_detail}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2">No Activity available</td>
                                </tr>
                            @endif

                            <tr>
                                <th>Culture Challenges</th>
                            </tr>
                            @if($cultureChallenges->isNotEmpty())
                                @foreach($cultureChallenges as $cultureChallenge)
                                    <tr>
                                        <td>{{$cultureChallenge->culture_challenges_detailed}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2">No Challenge available</td>
                                </tr>
                            @endif
                            <tr>
                                <th>Culture images</th>
                                <td>
                                    @forelse(explode(',', $regionCulture->culture_image) as $index => $image)
                                        <div class="gallery-item">
                                            <a data-fancybox="gallery" data-caption="{{$regionCulture->culture_name}}, {{ $regionCulture->basic_information }}" href="{{ asset('public/'.$image) }}">
                                                <img src="{{ asset('public/'.$image) }}" loading="lazy" alt="Gallery Image">
                                            </a>
                                        </div>
                                    @empty
                                        <p>No image found!</p>
                                    @endforelse
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


