@extends('layouts.master')

@section('content')

   
    @if(!empty($information))
    <div class="row">

        <h4>{{$information->title}}</h4>
        <hr>
        {!! $information->content!!}

    </div>
    @endif

@endsection