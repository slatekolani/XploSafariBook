<!DOCTYPE html>
@auth
    <html class="fixed sidebar-left-sm">
    {{-- <html class="fixed"> --}}
    {{-- sidebar-left-collapsed  sidebar-left-big-icons left-sidebar-panel --}}
@endauth

@guest
    <html class="fixed has-top-menu">
    {{-- <html class="fixed"> --}}
@endguest

<head>
    {{-- <!-- Basic --> --}}
    <meta charset="UTF-8">

    <title>{{ config('app.name') . ' - ' . $title }}</title>
    <meta name="keywords" content="{{ config('env.app.keywords') }}" />
    <meta name="description" content="{{ config('env.app.description') }}">
    <meta name="author" content="{{ config('env.app.vendor') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('before-styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{ Html::style(url('/css/fonts.googleapis.css'), ['rel' => 'stylesheet', 'type' => 'text/css']) }}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Playfair+Display:400,700|Roboto:400,700|Lato:400,700|Pacifico&display=swap">

    <link rel="apple-touch-icon" sizes="180x180" href="/public/Favicons/favicon_io /apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/public/Favicons/favicon_io /favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/public/Favicons/favicon_io /favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    


    {{ Html::style(url('vendor/bootstrap/css/bootstrap.min.css')) }}
    {{ Html::style(url('vendor/animate/animate.css')) }}
    {{ Html::style(url('vendor/font-awesome/css/fontawesome-all.min.css')) }}
    {{ Html::style(url('vendor/magnific-popup/magnific-popup.css')) }}
    {{ Html::style(url('vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')) }}
    {{ Html::style(url('assets/nextbyte/plugins/jquery-ui/css/jquery-ui.min.css'), ['rel' => 'stylesheet']) }}
    @stack('after-styles')
    {{ Html::style(url('css/theme.css')) }}
    {{ Html::style(url('css/theme-elements.css')) }}
    {{ Html::style(url('css/skins/default.css')) }}
    {{ Html::style(url('css/custom.css')) }}
    {{ Html::style(url('vendor/select2/css/select2.min.css')) }}

    {{ Html::script(url('vendor/modernizr/modernizr.js')) }}

    {{-- STart notification css --}}
    {{-- {{ Html::style(asset_url() . "/nextbyte/plugins/AmaranJS/dist/css/amaran.min.css") }} --}}
    {{-- {{ Html::style(asset_url() . "/nextbyte/plugins/AmaranJS/dist/css/animate.min.css") }} --}}
    {{-- end notification css --}}
    @stack('custom')

    <style>
       html {
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    scroll-behavior: smooth;
}

        h2,
        h3,
        h4{
            font-family: 'Montserrat', 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        p {
            font-family: 'Open Sans', 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        span {
            font-family: 'Open Sans', 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;

        }

        a {
            font-family: 'Open Sans', 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 14px;
            /* Increased for better readability */
        }

        .page-content {
            margin-top: 50px;
            margin-bottom: 100px;
        }
        p{
            font-size: 14px;
        }


        @media (max-width: 768px) {
            .page-content {
                margin-top: 150px;
                margin-bottom: 150px;
            }

            h2,
            h3,
            h4{
                font-family: 'Montserrat', 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
                font-weight: 700;
                font-size: 1rem;
                margin-bottom: 0.5rem;
            }
            #bottomNavigation {
            overflow: hidden;
            background-color: #FFF;
            position: fixed;
            width: 100%;
            z-index: 1001;
            text-align: center;
            padding: 5px 5px 5px 5px;
        }
        
        }


        .pagination {
            font-size: 0.8rem;
            /* Make pagination links huge */
            float: right;
            padding: 5px 5px 5px 5px;
        }

        .sticky {
            position: fixed;
            top: -50px;
            width: 100%;
        }


        .textWhite {
            color: white;
        }

        .card-body {
            background-color: rgba(255, 255, 255, 0.8);
        }

        .required_asterik:after {
            content: '*';
            color: red;
            padding-left: 5px;
        }

        .hidden_fields {
            display: none;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .top-left {
            position: absolute;
            top: 8px;
            left: 16px;
        }

        .top-right {
            position: absolute;
            top: 8px;
            right: 16px;
        }

        .center-text {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 90%;
            transform: translate(-50%, -50%);
            background-color: rgba(30, 144, 255, 0.5);
        }

        .bottom-left {
            position: absolute;
            bottom: 0;
            left: 16px;
            width: 92%;
            background: linear-gradient(rgba(0, 0, 0, 0), rgba(30, 144, 255, 0.8));
        }

        .card-with-gradient {
            position: relative;
            z-index: 1;
            overflow: hidden;
            transition: box-shadow 0.3s ease;
            /* Add transition for smooth effect */
        }

        .card-img-overlay {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.7));
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 1rem;
            color: #fff;
            font-family: 'Roboto', Sans-serif;
            z-index: 2;
        }

        .card-text-white {
            color: #fff !important;
        }

        .card-with-gradient:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            /* Add shadow on hover */
        }

        div.scroll-container {
            overflow: scroll;
            white-space: nowrap;
            padding: 10px;
            scroll-behavior: smooth;
        }

        div.scroll-container button {
            margin-right: 10px;
            max-width: 100%;
            height: auto;
        }

        .callout {
            position: fixed;
            bottom: 20%;
            right: 20px;
            margin-left: 20px;
            max-width: 300px;
            z-index: 1001;
        }

        /* Callout header */
        .callout-header {
            padding: 25px 25px;
            background: #555;
            font-size: 10px;
            color: white;
        }

        /* Callout container/body */
        .callout-container {
            padding: 15px;
            background-color: #ccc;
            color: black;
            text-align: center;
        }

        /* Close button */
        .closebtn {
            position: absolute;
            top: 5px;
            right: 15px;
            color: white;
            font-size: 30px;
            cursor: pointer;
        }

        /* Change color on mouse-over */
        .closebtn:hover {
            color: lightgrey;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            /* Adjust the padding as needed */
            text-align: left;
            border-bottom: 1px solid #ddd;
            /* Add a border at the bottom of each row */
        }

        .d-flex img:hover {
            transform: scale(1.2);
            /* Increase the size on hover */
            transition: transform 0.3s ease;
            /* Add a smooth transition effect */
        }

        .gallery-row {
            display: flex;
            flex-wrap: wrap;
            margin: -10px;
            /* Adjust margin as needed */
        }

        .gallery-item {
            flex: 1 1 calc(50% - 20px);
            /* Adjust width and margin as needed */
            margin: 10px;
            /* Adjust margin as needed */
            position: relative;
            overflow: hidden;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            vertical-align: middle;
        }

        .map-container {
            position: relative;
            overflow: hidden;
            height: 500px;
            /* Adjust the height as needed */
            margin-top: 20px;
            /* Add margin or padding as needed */
            border: 1px solid gainsboro;
            width: 100%;
        }

        .map-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ensure the image covers the container */
        }

        .economic-activity {
            padding-left: 20px;
        }

        .carousel-inner img {
            width: 100%;
            height: auto;
            object-fit: cover;
            /* This ensures the image covers the entire container while maintaining its aspect ratio */
        }

        .honey-points-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            justify-content: center;
        }

        .honey-point {
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .honey-point:hover {
            transform: scale(1.05);
        }

        .honey-point-header {
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid #ccc;
        }

        .honey-point-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .honey-point-title {
            position: absolute;
            bottom: 10px;
            left: 10px;
            color: #fff;
            font-size: 20px;
            font-weight: bold;
        }

        .honey-point-description {
            padding: 15px;
            font-size: 13px;

        }

        .no-honey-points {
            text-align: center;
            font-style: italic;
            padding: 20px;
        }

        .zoom-effect {
            overflow: hidden;
            position: relative;
        }

        .zoom-img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease-in-out;
        }

        .zoom-effect:hover .zoom-img {
            transform: scale(1.5);
        }

        .modal-backdrop.show {
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        .modal-content {
            position: relative;
        }

        .modal-header .close {
            position: absolute;
            top: 15px;
            right: 15px;
        }

        #bottomNavigation {
            overflow: hidden;
            background-color: #FFF;
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 1001;
            text-align: center;
            padding: 5px 5px 5px 5px;
        }


        .main {
            padding: 16px;
            margin-bottom: 30px;
        }

        .alertAbsence {
            padding: 10px;
            background-color: #f44336;
            color: white;
            text-align: center;
            justify-content: center;
            position: center;
        }

        .success {
            padding: 10px;
            margin-bottom: 10px;
            background-color: dodgerblue;
            color: white;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }

        .nav-container {
            overflow-x: auto;
        }

        .nav-link {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .img-thumbnail {
            max-width: 100px;
            cursor: pointer;
        }

        .reservationImageThumbnail {
            max-width: 100px;
            cursor: pointer;
            padding: 5px 5px 5px 5px;
        }

        .modal-img {
            max-width: 100%;
        }

        .website-content {
            margin-top: 10px;
            text-align: center;
        }

        .img-container {
            overflow: hidden;
        }

        .img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .custom-checkbox input[type="checkbox"] {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #4CAF50;
            border-radius: 5px;
            cursor: pointer;
            outline: none;
            position: relative;
            transition: background-color 0.3s ease;
        }

        .custom-checkbox input[type="checkbox"]:checked::before {
            content: '\2713';
            font-size: 16px;
            color: #4CAF50;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .custom-checkbox label {
            margin-left: 5px;
            cursor: pointer;
        }
    </style>


</head>

<body style="background-color:rgb(255, 255, 255,0.2)">
    @auth
        @if (Auth::user()->role == 1 || Auth::user()->role == 2)
            <section class="body">

                @include('includes/components/header')

                <div class="inner-wrapper">

                    @auth
                        @include('includes/components/left_sidebars/index')
                    @endauth

                    <section role="main" class="content-body">
                        {{-- Hide header on home page --}}
                        @auth

                            <header class="page-header">
                                <h2>{{ $header }}</h2>
                                <div style="margin-right: 10px" class="right-wrapper text-right">
                                    {{ Breadcrumbs::render() }}
                                </div>
                            </header>
                        @endauth

                        @include('includes.partials.messages')

                        {{-- Wrap yielded content with a div for spacing adjustments --}}
                        <div class="page-content">
                            @yield('content')
                        </div>
                    </section>
                </div>
                @include('includes/components/footer')
            </section>
        @elseif (Auth::user()->role == 3)
            <section class="body">

                @include('includes/components/header')

                <div class="inner-wrapper">
                    <section role="main" class="content">
                        <div class="page-content">
                            @include('includes.partials.messages')
                            @yield('content')
                        </div>
                    </section>

                </div>
                @include('includes/components/footer')
            </section>
        @endif
    @endauth
    @guest
        <section class="body">

            @include('includes/components/header')

            <div class="inner-wrapper">

                @auth
                    @include('includes/components/left_sidebars/index')
                @endauth

                <section role="main" class="content">


                    {{-- Hide header on home page --}}
                    @auth
                        <header class="page-header">
                            <h2>{{ $header }}</h2>
                            <div style="margin-right: 10px" class="right-wrapper text-right">
                                {{ Breadcrumbs::render() }}
                            </div>
                        </header>
                    @endauth

                    {{-- @include("includes/ads/top_advert") --}}


                    <div class="page-content">
                        @include('includes.partials.messages')
                        @yield('content')

                    </div>
                </section>


            </div>
            @include('includes/components/footer')



        </section>
    @endguest


    <script>
        var base_url = "{{ url('/') }}";
    </script>
    {{-- <!-- Scripts --> --}}
    @stack('before-scripts')
    {{ Html::script(url('vendor/jquery/jquery.js')) }}
    {{ Html::script(url('assets/nextbyte/plugins/jquery-ui/js/jquery-ui.min.js')) }}
    {{ Html::script(url('vendor/jquery-browser-mobile/jquery.browser.mobile.js')) }}
    {{ Html::script(url('vendor/popper/umd/popper.min.js')) }}
    {{ Html::script(url('vendor/bootstrap/js/bootstrap.min.js')) }}
    {{ Html::script(url('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')) }}
    {{ Html::script(url('vendor/common/common.js')) }}
    {{ Html::script(url('vendor/nanoscroller/nanoscroller.js')) }}
    {{ Html::script(url('vendor/magnific-popup/jquery.magnific-popup.min.js')) }}
    {{ Html::script(url('vendor/jquery-placeholder/jquery-placeholder.js')) }}
    <script type='text/javascript'
        src='//platform-api.sharethis.com/js/sharethis.js#property=5bdc6737afad5b00117c870d&product=inline-share-buttons'
        async='async'></script>
    @stack('after-scripts')
    {{ Html::script(url('js/theme.js')) }}
    {{-- {{ Html::script(url('js/custom.js')) }} --}}
    {{ Html::script(url('js/theme.init.js')) }}
    {{ Html::script(url('vendor/select2/js/select2.min.js')) }}
    {{ Html::script(url('js/share.js')) }}
    {{ Html::script(url('assets/nextbyte/plugins/maskmoney/js/maskmoney.min.js')) }}
    {{ Html::script(url('vendor/jquery-maskedinput/jquery.maskedinput.js')) }}
    {{ Html::script(url('assets/nextbyte/js/custom.js')) }}
    {{-- STart - Notification --}}
    {{-- {{ Html::script(asset_url(). "/global/plugins/AmaranJS/dist/js/jquery.amaran.min.js") }} --}}
    {{-- End notification --}}
    {{-- <script>
        $(document).ready(function() {

            $('.mobile').mask("9999999999");

        })
    </script> --}}
</body>

</html>
