@extends('layouts.main', ['title' => __("Touristic game - " . $touristicGame->game_name), 'header' => __('Touristic game - ' . $touristicGame->game_name)])
@include('includes.validate_assets')
@section('content')

    <div class="row">
        <div class="col-md-12" >
            <div class="pull-left" style="margin-bottom: 10px" >
                <a class ='btn btn-primary btn-sm'  href="{{route('touristicGame.edit',$touristicGame->uuid)}}">Edit information</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-md">
                            <tr>
                                <th>Game name</th>
                                <td>{{$touristicGame->game_name}}</td>
                            </tr>
                            <tr>
                                <th>Game category</th>
                                <td>{{$touristicGame->game_category}}</td>
                            </tr>
                            <tr>
                                <th>Game theme</th>
                                <td>{{$touristicGame->game_theme}}</td>
                            </tr>
                            <tr>
                                <th>Total players</th>
                                <td>{{$touristicGame->total_players}}</td>
                            </tr>
                            <tr>
                                <th>Age</th>
                                <td>{{$touristicGame->age}}</td>
                            </tr>
                            <tr>
                                <th>Tutorial directory link</th>
                                <td><a href="{{$touristicGame->tutorial_directory_link}}">Tutorial link</a></td>
                            </tr>
                            <tr>
                                <th>Game price</th>
                                <td>{{$touristicGame->game_price}}</td>
                            </tr>
                            <tr>
                                <th>Mode of play</th>
                                <td>{{$touristicGame->mode_of_play}}</td>
                            </tr>
                            <tr>
                                <th>Development inspiration</th>
                                <td>{{$touristicGame->development_inspiration}}</td>
                            </tr>
                            <tr>
                                <th>Game images</th>
                                <td>
                                    @forelse(explode(',', $touristicGame->game_images) as $index => $image)
                                        <div class="gallery-item">
                                            <a data-fancybox="gallery" data-caption="{{$touristicGame->game_name}}, {{ $touristicGame->game_theme }}" href="{{ asset('public/'.$image) }}">
                                                <img src="{{ asset('public/'.$image) }}" loading="lazy" alt="Gallery Image">
                                            </a>
                                        </div>
                                    @empty
                                        <p>No image found!</p>
                                    @endforelse
                                </td>
                            </tr>
                            <tr>
                                <th>Game status</th>
                                @if($touristicGame->status==1)
                                    <td><span class="badge badge-success">Active</span></td>
                                @else
                                    <td><span class="badge badge-danger">Inactive</span></td>
                                @endif
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


