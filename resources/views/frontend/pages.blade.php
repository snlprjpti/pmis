@extends('layouts.frontend')
@section('title')
    {{$page->title}}
@stop
@section('content')
    <div class="row">
    	<div class="col-md-9">
    		<h2>{{$page->title}}</h2>
        	<div class="panel panel-default">
       		<pre>{!!$page->description!!}</pre>
    	</div>
    </div>
</div>
@endsection