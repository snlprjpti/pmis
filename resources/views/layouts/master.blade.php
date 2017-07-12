<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PMIS</title>

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
        {{--<div class=" col-md-8 logo_information ">--}}
            {{--<img src="{{asset('images/nepal-government-logo.png')}}" alt="" class="logo"/>--}}
            {{--<h1 >PMIS </h1>--}}
            {{--<h6 >Government Of Nepal </h6>--}}
            {{--<h6>Ministry Of Health And Population </h6>--}}

        {{--</div>--}}
        {{--@if(auth()->check())--}}

        {{--<div class="col-md-4 user_information">--}}
            {{--<ul class="list-group">--}}
                {{--<li class="list-group-item">--}}
                    {{--<span class="badge">{{ auth()->user()->created_at->toDayDateTimeString() }}</span>--}}
                    {{--Last Login--}}
                {{--</li>--}}
                {{--<li class="list-group-item">--}}
                    {{--<span class="badge"><strong>{{ super_echo(auth()->user()->district,['name']) }}</strong></span>--}}
                    {{--Logged In From--}}
                {{--</li>--}}
                {{--<li class="list-group-item">--}}
                    {{--<span class="badge"><strong>{{auth()->user()->type }}</strong></span>--}}
                    {{--Logged In As--}}
                {{--</li>--}}
                {{--<li class="list-group-item">--}}
                    {{--<span class="badge"><strong>{{ super_echo(auth()->user()->office,['office_name']) }}</strong></span>--}}
                    {{--Office--}}
                {{--</li>--}}

            {{--</ul>--}}

            {{--Last Login : {{ auth()->user()->created_at->toDayDateTimeString() }} <br/>--}}
            {{--Logged In From :: <strong>{{ super_echo(auth()->user()->district,['name']) }}</strong><br/>--}}
            {{--User Type :: <strong>{{auth()->user()->type }}</strong> <br/>--}}
            {{--Office :: <strong>{{ super_echo(auth()->user()->office,['office_name']) }}</strong>--}}
        {{--</div>--}}

        {{--@endif--}}

    {{--</div>--}}

    <div class="row">
        <div class="col-md-6 logo_information ">
            <a href="/"><img src="{{asset('images/nepal-government-logo.png')}}" alt="" class="logo"/></a>
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
<nav class="navbar navbar-deep-purple">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                {{--<a class="navbar-brand" href="#">{ PMIS }</a>--}}
            </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('home') ? 'active': null}}"><a href="{{ url('/home') }}"><i class="ion ion-ios-home"></i>&nbsp;Dashboard</a></li>
                @if (!Auth::guest())
                    <li class="dropdown  {{ Request::is('backend/documents/*') ? 'active': null}}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="ion ion-document-text"></i> &nbsp;Documents <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">

                            <li class="{{ Request::is('backend/documents/book*') ? 'active': null}}" ><a href="{{ action('Document\BooksController@index') }}">Books And Reports</a></li>
                            <li class="divider"></li>
                            @if(is_super_admin())
                            <li class="{{ Request::is('backend/documents/department-document*') ? 'active': null}}" ><a href="{{ action('Document\DepartmentDocumentsController@index') }}">Department Documents</a></li>
                            <li class="divider"></li>
                            @endif
                            <li class="{{ Request::is('backend/documents/report*') ? 'active': null}}"><a href="{{ action('Document\ReportsController@index') }}">Progress Reports</a></li>

                        </ul>
                    </li>
                    {{--<li class="{{ Request::is('population-clock') ? 'active': null}}"><a href="{{ action('HomeController@backendPopulationClock') }}"><i class="ion ion-ios-people"></i>&nbsp;Population Clock</a></li>--}}
                    {{--<li><a href="#"><i class="ion ion-network"></i>&nbsp;E-pop Info</a></li>--}}

                @if(is_super_admin())
                        <li class="{{ Request::is('backend/districts*') ? 'active': null}}" ><a href="{{ action('DistrictsController@index') }}"><i class="ion ion-pound"></i> &nbsp;Districts</a></li>
                        <li class="{{ Request::is('backend/helpdesk*') ? 'active': null}}" ><a href="{{ action('HelpDeskMessagesController@index') }}"> <i class="ion ion-help-buoy"></i> &nbsp;HelpDesk</a></li>
                        <li class="{{ Request::is('backend/employees*') ? 'active': null}}"><a href="{{ action('Auth\UsersController@index') }}"> <i class="ion ion-person"></i>&nbsp;Users</a></li>
                        <li class="dropdown {{ Request::is('config*') ? 'active': null}}">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="ion ion-settings"></i> &nbsp;Configurations <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">

                                <li class="{{ Request::is('backend/config/financial-year*') ? 'active': null}}"><a href="{{ action('Configuration\FiscalsController@index') }}">Financial Year</a></li>
                                <li class="divider"></li>
                                <li class="{{ Request::is('backend/config/designation*') ? 'active': null}}"><a href="{{ action('Configuration\DesignationsController@index') }}">Designation</a></li>
                                <li class="divider"></li>
                                <li class="{{ Request::is('backend/config/office*') ? 'active': null}}"><a href="{{ action('Configuration\OfficesController@index') }}">Office</a></li>
                                <li class="divider"></li>
                                <li class="{{ Request::is('backend/config/census*') ? 'active': null}}"><a href="{{ action('Configuration\CensusController@index') }}">Census Information</a></li>
                                <li class="divider"></li>
                              <!--  <li class="{{ Request::is('backend/config/vital-statistic-type*') ? 'active': null}}"><a href="{{ action('Configuration\VitalStatisticTypeController@index') }}">Vital Statistic Type</a></li> -->
                                <li class="divider"></li>
                                <li class="{{ Request::is('backend/config/vital-statistic-type*') ? 'active': null}}"><a href="{{ action('Other\ImportantLinksController@index') }}">Important Links</a></li>
                            </ul>
                        </li>
                         <li class="{{ Request::is('backend/gallery*') ? 'active': null}}"><a href="{{ action('GalleryController@index') }}"> <i class="ion ion-camera"></i>&nbsp;Gallery</a></li>
                         <li class="{{ Request::is('backend/page*') ? 'active': null}}"><a href="{{ action('PageController@index') }}"> <i class="ion-ios-paper-outline"></i>&nbsp;Page</a></li>
                    @endif
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/auth/login') }}">Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ action('Auth\UsersController@changePassword') }}">Change Password</a></li>
                            <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Warning!</strong> {{ session('error').session()->forget('error') }}.
            </div>

        @elseif(session()->has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Success!</strong> {{ session('success').session()->forget('success') }}
            </div>

        @endif


    </div>
    @yield('content')
</div>
<footer class="text-center">
    <p>Copyright © {{ date('Y') }} <a href="">Design by Young Minds</a></p>
</footer>
<script src="{{ asset('/js/app.js') }}"></script>
@include('component.population-clock')
@section('js')
@show
</body>
</html>
