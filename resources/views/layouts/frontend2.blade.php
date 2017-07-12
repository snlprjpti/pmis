<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PMIS - @yield('title')</title>

    <link href='http://fonts.googleapis.com/css?family=Orbitron:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('/css/all.css') }}" rel="stylesheet">
    @section('css')
    @show

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<header class="container" style="margin-bottom: 5px">
    {{--<div class="row">--}}
        {{--<div class="col-md-8 logo_information ">--}}
            {{--<img src="{{asset('images/nepal-government-logo.png')}}" alt="" class="logo"/>--}}
            {{--<h1 >PMIS </h1>--}}
            {{--<h6 >Government Of Nepal </h6>--}}
            {{--<h6>Ministry Of Health And Population </h6>--}}

        {{--</div>--}}
        {{--<div class="col-md-4 user_information front-right-head">--}}
            {{--<ul class="list-group">--}}
                {{--<li class="list-group-item">--}}
                    {{--<i class="ion-android-call"></i> &nbsp; {!! Html::link("tel:01 426-2543", strtoupper('01 426-2543')) !!}, {!! Html::link("tel:01 426-2802", strtoupper('426-2802')) !!}, {!! Html::link("tel:01 426-2696", strtoupper('426-2696')) !!}, {!! Html::link("tel:01 426-7376", strtoupper('426-7376')) !!}--}}
                {{--</li>--}}
                {{--<li class="list-group-item">--}}
                    {{--<i class="ion-android-mail"></i> &nbsp; {!! Html::mailto('info@mohp.gov.np') !!}--}}
                {{--</li>--}}
                {{--<li class="list-group-item">--}}
                    {{--<i class="ion-earth"></i> &nbsp; {!! Html::link('//mohp.gov.np','www.mohp.gov.np',['target'=>'_blank']) !!}--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</div>--}}

    {{--</div>--}}


    <div class="row">
        <div class="col-md-6 logo_information ">
            <img src="{{asset('images/nepal-government-logo.png')}}" alt="" class="logo"/>
            <h1 style="font-size: 24px; padding-top: 10px;"> नेपाल सरकार </h1>
            <h5 >जनसंख्या तथा वातावरण मन्त्रालय</h5>
            <h5>सिंहदरबार, काठमाडौँ, नेपाल</h5>

        </div>
        <div class="col-md-6 user_information front-right-head" style="text-align: center;">
            {{--<ul class="list-group">--}}
            {{--<li class="list-group-item">--}}
            {{--<i class="ion-android-call"></i> &nbsp; {!! Html::link("tel:01 426-2543", strtoupper('01 426-2543')) !!}, {!! Html::link("tel:01 426-2802", strtoupper('426-2802')) !!}, {!! Html::link("tel:01 426-2696", strtoupper('426-2696')) !!}, {!! Html::link("tel:01 426-7376", strtoupper('426-7376')) !!}--}}
            {{--</li>--}}
            {{--<li class="list-group-item">--}}
            {{--<i class="ion-android-mail"></i> &nbsp; {!! Html::mailto('info@mohp.gov.np') !!}--}}
            {{--</li>--}}
            {{--<li class="list-group-item">--}}
            {{--<i class="ion-earth"></i> &nbsp; {!! Html::link('//mohp.gov.np','www.mohp.gov.np',['target'=>'_blank']) !!}--}}
            {{--</li>--}}
            {{--</ul>--}}

            <img src="{{asset('images/nepal_flag.gif')}}" alt="" height="50"/>
            <h4>Population Management Information System(PMIS)</h4>
        </div>

    </div>

</header>
@include('layouts.front-nav')
<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-md-3">
                @section('sidebar')
                @show
            </div>
            <div class="col-md-9">
                @yield('content')
            </div>

        </div>
    </div>
</div>
<footer class="text-center">
    <p>Copyright © {{ date('Y') }} <a href="#">Design by Young Minds</a></p>
</footer>

<script src="{{ asset('/js/app.js') }}"></script>
@include('component.population-clock')
@section('js')

@show
</body>
</html>