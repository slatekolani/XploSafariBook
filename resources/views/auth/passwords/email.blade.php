@extends('layouts.main', ['title' => __("label.password_reset"), 'header' => __("label.password_reset")])

@section('content')
<div class="container">
    <div class="row justify-content-center">



        <!-- start: page -->
            <section class="body-sign">
                <div class="top-sign">
                    <a href="/" class="logo float-left">
                        {{--<img src="{{ url("img/np_logo.png") }}"   height="54" alt="NEXTPROJECT" />--}}
                    </a>

                    <div class="panel card-sign">
                        <div class="card-title-sign mt-3 text-right">
                            <h2 class="title text-uppercase font-weight-bold m-0" style="background-color: #32464a"><i class="fas fa-user mr-1"></i>{{ __('label.password_reset') }}</h2>
                        </div>
                        <div class="card-body" style="border-top-color:#32464a">
                            <div class="alert alert-info">
                                <p class="m-0">{{ __('passwords.reset_title') }}</p>
                            </div>

                            <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                                <div class="form-group mb-0">
                                    <div class="input-group">
                                        <input id="email" name="email" type="email" placeholder="E-mail" class="form-control form-control-lg{{ $errors->has('email') ? ' is-invalid' : '' }}" />
                                        <span class="input-group-append">
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                            {{--{{ $errors->first('email', '<span class="badge badge-danger">:message</span>') }}--}}
										<button class="btn btn-dark btn-lg" type="submit">{{ __('buttons.general.reset') }}!</button>
									</span>

                                    </div>

                                </div>

                                <p class="text-center mt-3">{{ __('passwords.remembered') }} <a href="{{ route('login') }}">{{ __('label.login') }}</a></p>
                            </form>
                        </div>
                    </div>

                    {{--<p class="text-center text-muted mt-3 mb-3">&copy; Copyright 2017. All Rights Reserved.</p>--}}
                </div>
            </section>
            <!-- end: page -->
    </div>
</div>



@endsection
