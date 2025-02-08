@extends('layouts.main', ['title' => __("Touristic game"), 'header' => __('Touristic game')])

@include('includes.validate_assets')
@section('content')

    {{ Form::open(['enctype="multipart/form-data"','route'=>'touristicGame.store', 'autocomplete' => 'off','method' => 'post','multiple'=>true, 'class' => 'needs-validation', 'novalidate']) }}
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
                                        {{ Form::text('game_name',null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'game_name', 'required']) }}
                                        {!! $errors->first('game_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('game_category', __("Game category"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('game_category',null, ['class' => 'form-control','autocomplete' => 'off', 'id' => 'game_category', 'required']) }}
                                        {!! $errors->first('game_category', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('game_theme', __("Game theme"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('game_theme',null, ['class' => 'form-control','autocomplete' => 'off', 'id' => 'game_theme', 'required']) }}
                                        {!! $errors->first('game_theme', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('total_players', __("Total number of  players"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('total_players',null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'total_players', 'required']) }}
                                        {!! $errors->first('total_players', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('age', __("Age rank"), ['class' => 'required_asterik']) }}
                                        {{ Form::text('age', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'age', 'required']) }}
                                        {!! $errors->first('age', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tutorial_directory_link', __("Tutorial directory link"), ['class' => 'required_asterik']) }}
                                        {{ Form::url('tutorial_directory_link', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'tutorial_directory_link', 'required']) }}
                                        {!! $errors->first('tutorial_directory_link', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('game_images', __("Game images"), ['class' => 'required_asterik']) }}
                                        {{ Form::file('game_images[]', ['class' => 'form-control', 'multiple'=>true,'autocomplete' => 'off', 'id' => 'game_images', 'required']) }}
                                        {!! $errors->first('game_images', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('game_price', __("Game price"), ['class' => 'required_asterik']) }}
                                        {{ Form::number('game_price', null, ['class' => 'form-control', 'autocomplete' => 'off','id' => 'game_price', 'required']) }}
                                        {!! $errors->first('game_price', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('mode_of_play', __("Mode of play"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('mode_of_play', null, ['class' => 'form-control', 'autocomplete' => 'off','maxLength'=>'200', 'style'=>'height:100px', 'id' => 'mode_of_play', 'required']) }}
                                        {!! $errors->first('mode_of_play', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('development_inspiration', __("Development inspiration"), ['class' => 'required_asterik']) }}
                                        {{ Form::textarea('development_inspiration', null, ['class' => 'form-control', 'autocomplete' => 'off', 'maxlength'=>'200','style'=>'height:100px', 'id' => 'development_inspiration', 'required']) }}
                                        {!! $errors->first('development_inspiration', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Game component</th>
                                        <th>Component description</th>
                                    </tr>
                                    </thead>
                                    <tbody id="gameComponent">
                                    <tr>
                                        <td><input type="text" name="game_component1" class="form-control" required></td>
                                        <td><input type="text" name="component_description1" class="form-control" required></td>
                                        <td><a class="fas fa-pencil-alt" id="addGameComponent">+</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="element-form">
                                        <div class="form-group pull-left">
                                            {{ Form::button(trans('Add'), ['class' => 'btn btn-primary', 'type'=>'submit','style' => 'border-radius: 5px;']) }}
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
            var i=1;
            $('#addGameComponent').on('click',function()
            {
                i++;
                var html='';
                html += '<tr>';
                html += '<td><input type="text" name="game_component'+i+'" class="form-control" required></td>';
                html += '<td><input type="text" name="component_description'+i+'" class="form-control" required></td>';
                html += '<td><a class="fas fa-pencil-alt" id="removeGameComponent">-</a></td>';
                html += '</tr>';
                $('#gameComponent').append(html);
            })
            $(document).on('click','#removeGameComponent',function ()
            {
                $(this).closest('tr').remove();
            })
        })
    </script>
@endpush

