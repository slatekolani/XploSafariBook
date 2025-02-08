@extends('layouts.main', ['title' => 'Tanzanian News and Updates', 'header' => 'Tanzanian News and Updates'])
@include('includes.validate_assets')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
@section('content')

    <div class="col-md-12">
        <div class="row" style="margin-top: 5px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="background-color: rgba(255,255,255,0.85)">
                        <h4 style="border-left:5px solid dodgerblue;padding-left:10px">News & Updates</h4>
                    @if(!empty($news) && $news->count())
                            @foreach($news as $tanzaniaNews)
                                <div class="panel-group">
                                    <div class="panel panel-default">
                                        <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{asset('public/newsImage/'. $tanzaniaNews->news_image)}}" style="height: auto;width: 100%;filter: contrast(120%);border-radius: 5px;padding-top: 10px">
                                        </div>
                                        <div class="col-md-8">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">{{$tanzaniaNews->news_title}}</h4>
                                        </div>
                                        <div class="panel-body">
                                            {{$tanzaniaNews->news_description}}
                                            <p>Uploaded on, {{date('jS M Y H:m a',strtotime($tanzaniaNews->created_at))}}</p>

                                        </div>
                                    </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p style="padding-left: 20px">No news have been published yet.</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


