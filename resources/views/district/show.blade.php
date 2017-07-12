@extends('layouts.master')

@section('content')

    @if(!empty($district))
        <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading"> 
                        <div class="pull-right">
                            <a class="btn btn-sm btn-primary" href="{{ action('DistrictsInformationController@index',[$district->id]) }}">Informations List</a>
                            <a class="btn btn-sm btn-primary" href="{{ action('DistrictsController@index') }}"> Districts List</a>
                        </div>
                    Information of {{ $district->name }}
                
                </div>

                <div class="panel-body">
                    
                    <div class="col-md-6">

                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="badge">{{ $district->name }}</span>
                                District Name
                            </li>
                            <li class="list-group-item">
                                <span class="badge">{{ super_echo($district->zone,['name']) }}</span>
                                Zone
                            </li>
                            <li class="list-group-item">
                                <span class="badge">{{ $district->headquarter }}</span>
                                Headquarter
                            </li>
                            <li class="list-group-item">
                                <span class="badge">{{ $district->latitude }}</span>
                                Latitude
                            </li>

                            <li class="list-group-item">
                                <span class="badge">{{ $district->longitude }}</span>
                                Longitude
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img class="img img-responsive" src="{{ asset($district->map_path) }}" alt="{{ $district->name }}"/>
                    </div>
                    {{--<hr/>--}}
                    {{--<a class="btn btn-primary" href="{{ action('DistrictsInformationController@create',[$district->id]) }}">Add Informations</a>--}}
                    {{--<br/>--}}
                    {{--<br/>--}}
                    {{--<div class="district-information">--}}
                        {{--@foreach($district->informations as $information)--}}
                            {{--<article>--}}
                            {{--<h4 id="{{ $information->title }}">--}}
                                {{--<a href="#{{ $information->title }}">{{ $information->title }}</a>--}}

                                {{--<small><a href="{{action('DistrictsInformationController@edit',[$district->id,$information->id])}}">&nbsp;[Edit]</a></small>--}}
                            {{--</h4>--}}
                            {{--<hr/>--}}
                             {{--{!! $information->content !!}--}}
                            {{--</article>--}}
                            {{--<br/>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    @endif

@endsection
