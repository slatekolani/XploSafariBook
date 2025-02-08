<!doctype html>
<html class="fixed">
<head>

    {{--<!-- Basic -->--}}
    <meta charset="UTF-8">

    <title>{{ config("app.name") . " - " . $title }}</title>

    <meta name="keywords" content="{{ config("env.app.keywords") }}" />
    <meta name="description" content="{{ config("env.app.description") }}">
    <meta name="author" content="{{ config("env.app.vendor") }}">
    {{--TODO: Change this logo to respective project--}}
    {{ Html::style(url("img/np_fav.png"), ['rel' => 'stylesheet icon', 'type' => 'image/x-icon']) }}

    {{--<!-- Mobile Metas -->--}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    {{--<!-- Web Fonts  -->--}}
    {{ Html::style(url("/css/fonts.googleapis.css"), ['rel' => 'stylesheet', 'type' => 'text/css']) }}

    {{--<!-- Vendor CSS -->--}}
    {{ Html::style(url('vendor/bootstrap/css/bootstrap.min.css')) }}
    {{ Html::style(url('vendor/animate/animate.css')) }}
    {{ Html::style(url('vendor/font-awesome/css/fontawesome-all.min.css')) }}
    {{ Html::style(url('vendor/magnific-popup/magnific-popup.css')) }}
    {{ Html::style(url('vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')) }}

    {{--<!-- Theme CSS -->--}}
    {{ Html::style(url('css/theme.css')) }}

    {{--<!-- Skin CSS -->--}}
    {{ Html::style(url('css/skins/default.css')) }}

    {{--<!-- Theme Custom CSS -->--}}
    {{ Html::style(url('css/custom.css')) }}

    {{--<!-- Head Libs -->--}}
    {!! Html::script(url('vendor/modernizr/modernizr.js')) !!}

</head>

<body>

<!-- start: page -->
<section class="body-error error-outside">
    <div class="center-error">

        <div class="error-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-8">
                            <a href="/" class="logo">
                                {{--TODO: Change this logo to respective project--}}
                                <img src="{{ url("img/np_logo.png") }}" height="54" alt="NFLIP Logo" />
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <form class="form">
                               {{-- <div class="input-group">
                                    <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
                                    <span class="input-group-append">
													<button class="btn btn-default" type="submit"><i class="fas fa-search"></i></button>
												</span>
                                </div>--}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                @yield("content")
            </div>
            <div class="col-lg-4">
                <h4 class="text">@lang("label.useful_link")</h4>
                <ul class="nav nav-list flex-column primary">
                    <li class="nav-item">
                        <a class="nav-link" href="{!! url('/') !!}"><i class="fas fa-caret-right text-dark"></i> @lang("label.home")</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{!! url('/') !!}"><i class="fas fa-caret-right text-dark"></i> @lang("label.faqs") </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- end: page -->

    {{--<!-- Vendor -->--}}
    {!! Html::script(url('vendor/jquery/jquery.js')) !!}
    {!! Html::script(url('vendor/jquery-browser-mobile/jquery.browser.mobile.js')) !!}
    {!! Html::script(url('vendor/popper/umd/popper.min.js')) !!}
    {!! Html::script(url('vendor/bootstrap/js/bootstrap.min.js')) !!}
    {!! Html::script(url('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')) !!}
    {!! Html::script(url('vendor/common/common.js')) !!}
    {!! Html::script(url('vendor/nanoscroller/nanoscroller.js')) !!}
    {!! Html::script(url('vendor/magnific-popup/jquery.magnific-popup.min.js')) !!}
    {!! Html::script(url('vendor/jquery-placeholder/jquery-placeholder.js')) !!}

    {{--<!-- Theme Base, Components and Settings -->--}}
    {!! Html::script(url('js/theme.js')) !!}

    {{--<!-- Theme Custom -->--}}
    {!! Html::script(url('js/custom.js')) !!}

    {{--<!-- Theme Initialization Files -->--}}
    {!! Html::script(url('js/theme.init.js')) !!}
</body>
</html>
