@extends('layouts.frontend')
@section('title')
    Population Clock
@stop
@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body population-clock">
                <h3 class="text-center "> Current Population </h3>
                <h3 class="text-center population-count cc1" style="font-size: 30px;"> </h3>
                <br/>
                <div class="row">
                    <div class="col-md-6">
                        <i class="ion-man gender-icon"></i>

                        <div class="sec-box-gender">
                            <div class="sec-text"> &nbsp;Current male population </div>
                            <div class="sec-counter population-count cc4"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <i class="ion-woman gender-icon"></i>
                        <div class="sec-box-gender">
                            <div class="sec-text"> Current female population </div>
                            <div class="sec-counter population-count cc5"></div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                <div class="col-md-6">
                    <h4 class="text-center population-tabs">TODAY</h4>
                    <div class="sec-box">
                        <div class="sec-text green">Births </div>
                        <div class="sec-counter population-count cc7"></div>
                    </div>
                    <hr/>
                    <div class="sec-box">
                        <div class="sec-text red">Death </div>
                        <div class="sec-counter population-count cc9"></div>
                    </div>
                    <hr/>
                    <div class="sec-box">
                        <div class="sec-text red">Net migration </div>
                        <div class="sec-counter population-count cc11"></div>
                    </div>
                    <hr/>
                    <div class="sec-box">
                        <div class="sec-text green">Population growth </div>
                        <div class="sec-counter population-count cc13"></div>
                    </div>
                    <hr/>
                </div>
                <div class="col-md-6">
                    <h4 class="text-center population-tabs">THIS YEAR</h4>
                    <div class="sec-box">
                        <div class="sec-text green">Births </div>
                        <div class="sec-counter population-count cc6"></div>
                    </div>
                    <hr/>
                    <div class="sec-box">
                        <div class="sec-text red">Death </div>
                        <div class="sec-counter population-count cc8"></div>
                    </div>
                    <hr/>
                    <div class="sec-box">
                        <div class="sec-text red">Net migration </div>
                        <div class="sec-counter population-count cc10"></div>
                    </div>
                    <hr/>
                    <div class="sec-box">
                        <div class="sec-text green">Population growth </div>
                        <div class="sec-counter population-count cc12"></div>
                    </div>
                    <hr/>
                </div>
                </div>
                <div class="text-center">
                    <br/>
                    Every 46.66 sec. a baby is born in Nepal. Every hour 77.2 persons are born. <br/><br/>
                    Every 151.90 sec. one person dies in Nepal. Every hour die 23.7 persons. <br/>
                </div>
            </div>
        </div>
    </div>
@endsection