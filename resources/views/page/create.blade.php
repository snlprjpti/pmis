@extends('layouts.master')

@section('content')
	
        <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-right">
                    <a  class="btn btn-primary" href="{{ action('PageController@index') }}">Pages List</a>
                </div>
                Add New Page
            </div>

            {!! Form::open(['action' => 'PageController@store','method' => 'post', 'class' =>'form-horizontal'])!!}
            <div class="panel-body">
                <div class="col-sm-5 col-sm-offset-3">

                    <div class="form-group">
                        {!!Form::label('title','Title')!!}
                        {!!Form::text('title', null, array('class' => 'form-control','placeholder' => 'Type Title Name'))!!}
                         {!! $errors->first('title', '<span class="label label-danger" >:message</span >') !!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('description','Description')!!}
                        {!!Form::textarea('description', null, array('class' => 'form-control','placeholder' => 'Write Something!!'))!!}
                         {!! $errors->first('description', '<span class="label label-danger" >:message</span >') !!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('order','Order')!!}
                        {!!Form::text('order', null, array('class' => 'form-control','placeholder' => 'Order Position'))!!}
                         {!! $errors->first('order', '<span class="label label-danger" >:message</span >') !!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('status','Status')!!}
                        {!!Form::select('status', array('0' => 'Off', '1' => 'On'), array('class' => 'form-control'))!!}
                         {!! $errors->first('status', '<span class="label label-danger" >:message</span >') !!}
                    </div>
                    
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                          {!!Form::submit('Add Pages', array('class' => 'btn btn-primary'))!!}
                        </div>
                    </div>
                </div>
                </div>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
    

@endsection