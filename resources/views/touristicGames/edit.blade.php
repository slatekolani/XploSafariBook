@extends('layouts.main', ['title' => __("Edit Touristic game - " . $touristicGame->game_name), 'header' => __('Edit Touristic game - ' . $touristicGame->game_name)])

@include('includes.validate_assets')
@section('content')

    {{ Form::model($touristicGame,['route' => ['touristicGame.update', $touristicGame->uuid], 'method'=>'put','autocomplete' => 'off',
     'id' => 'update','class' => 'form-horizontal  needs-validation', 'novalidate','files' => true, 'enctype' => 'multipart/form-data']) }}
    {{ Form::hidden('user_id', $touristicGame->id, []) }}
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
                                        {{ Form::label('game_name', __("Game name"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('game_name',$touristicGame->game_name, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'game_name', 'required']) }}
                                        {!! $errors->first('game_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('game_category', __("Game category"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('game_category',$touristicGame->game_category, ['class' => 'form-control','autocomplete' => 'off', 'id' => 'game_category', 'required']) }}
                                        {!! $errors->first('game_category', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('game_theme', __("Game theme"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('game_theme',$touristicGame->game_theme, ['class' => 'form-control','autocomplete' => 'off', 'id' => 'game_theme', 'required']) }}
                                        {!! $errors->first('game_theme', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('total_players', __("Total number of  players"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('total_players',$touristicGame->total_players, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'total_players', 'required']) }}
                                        {!! $errors->first('total_players', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('age', __("Age rank"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('age', $touristicGame->age, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'age', 'required']) }}
                                        {!! $errors->first('age', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tutorial_directory_link', __("Tutorial directory link"), ['class' => 'required_asterik']) }}
                                        {{ Form::url('tutorial_directory_link', $touristicGame->tutorial_directory_link, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tutorial_directory_link', 'required']) }}
                                        {!! $errors->first('tutorial_directory_link', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('game_images', __("Game images"), ['class' => 'required_asterik']) }}
                                        {{ Form::file('game_images[]', ['class' => 'form-control', 'multiple'=>true,'autocomplete' => 'off', 'id' => 'game_images']) }}
                                        {!! $errors->first('game_images', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('game_price', __("Game price"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('game_price', $touristicGame->game_price, ['class' => 'form-control', 'autocomplete' => 'off','id' => 'game_price', 'required']) }}
                                        {!! $errors->first('game_price', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('mode_of_play', __("Mode of play"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('mode_of_play', $touristicGame->mode_of_play, ['class' => 'form-control', 'autocomplete' => 'off','maxLength'=>'200', 'style'=>'height:100px', 'id' => 'mode_of_play', 'required']) }}
                                        {!! $errors->first('mode_of_play', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('development_inspiration', __("Development inspiration"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('development_inspiration', $touristicGame->development_inspiration, ['class' => 'form-control', 'autocomplete' => 'off', 'maxlength'=>'200','style'=>'height:100px', 'id' => 'development_inspiration', 'required']) }}
                                        {!! $errors->first('development_inspiration', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <table id="gameComponent">
                                    <thead>
                                    <tr>
                                        <th>Game component</th>
                                        <th>Component description</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($touristicGameComponents as $touristicGameComponent)
                                    <tr id="gameComponent{{$touristicGameComponent->id}}">
                                        <td><input type="text" name="game_component{{$touristicGameComponent->id}}" value="{{$touristicGameComponent->game_component}}" class="form-control" required></td>
                                        <td><input type="text" name="component_description{{$touristicGameComponent->id}}" value="{{$touristicGameComponent->component_description}}" class="form-control" required></td>
                                        <td><a href="{{route('touristicGame.deleteGameComponent',$touristicGameComponent->uuid)}}" class="btn btn-danger btn-sm">delete</a></td>
                                    </tr>
                                    @empty
                                        <tr id="gameComponent">
                                            <td><input type="text" name="game_component1" class="form-control" required></td>
                                            <td><input type="text" name="component_description1" class="form-control" required></td>
                                            <td><a class="fas fa-pencil-alt" id="addGameComponent">+</a></td>
                                        </tr>
                                    @endforelse
                                    <td><a class="btn btn-primary btn-sm" id="addGameComponent">Add</a></td>
                                    </tbody>
                                </table>
                            </div>
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
        $(document).ready(function (){
            var i={{$touristicGameComponents->count() + 1}};
            $('#addGameComponent').on('click',function()
            {
                i++;
                var html='';
                html += '<tr>';
                html += '<td><input type="text" name="game_component'+i+'" class="form-control" required></td>';
                html += '<td><input type="text" name="component_description'+i+'" class="form-control" required></td>';
                html += '<td><a class="fas fa-pencil-alt" id="removeGameComponent">-</a></td>';
                html += '</tr>';
                $('#gameComponent tbody').append(html);
            })
            $(document).on('click','#removeGameComponent',function ()
            {
                $(this).closest('tr').remove();
            })
        })
    </script>
@endpush

