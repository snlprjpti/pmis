@extends('layouts.frontend')
@section('content')

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">   

                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                    <!-- Wrapper for slides -->
                      <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="3  "></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="{{ asset('images/Population- Distribution(1971-2001).gif') }}" alt="Population- Distribution(1971-2001)">
                            <div class="carousel-caption">

                            </div>
                        </div>
                        @forelse($galleries as $gallery)
                            <div class="item">
                                <img src="{{ url('gallery',$gallery->image) }}"  alt="{{$gallery->title}}" >
                                <div class="carousel-caption">
                                    {{$gallery->title}}
                                </div>
                            </div>
                           @empty
                        @endforelse                      
                        </div>
                     

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="ion-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="ion-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <hr/>
                    <div>
                        <h4>{{$pages->title}}</h4>
                        <p>{{$pages->description}}</p>
                    </div>
                </div>
            </div>
        </div>
@endsection