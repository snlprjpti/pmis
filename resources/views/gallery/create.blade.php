@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-right">
                    <a  class="btn btn-primary" href="{{ action('GalleryController@index') }}">Back</a>
                </div>
                Upload your images
            </div>

            {!! Form::open(['action' => 'GalleryController@store','method' => 'post', 'class' =>'form-horizontal','files' => true])!!}
            <div class="panel-body">
    			<div class="col-sm-5">

	            	<div class="form-group">
						{!!Form::label('title','Title')!!}
						{!!Form::text('title', null, array('class' => 'form-control'))!!}
						 {!! $errors->first('title', '<span class="label label-danger" >:message</span >') !!}
					</div>
					<div class="form-group">
						{!!Form::label('image','Image')!!}
						{!!Form::file('image', array('class' => 'form-control','multiple' => 'true'))!!}
						 {!! $errors->first('image', '<span class="label label-danger" >:message</span >') !!}

					</div>
		            <div class="form-group">
                        {!!Form::label('status','Status')!!}
                        {!!Form::select('status', array('0' => 'Off', '1' => 'On'), array('class' => 'form-control'))!!}
                        {!! $errors->first('status', '<span class="label label-danger" >:message</span >') !!}
                    </div>
			
            	</div>

	            <div class="panel-footer">
	                <div class="row">
	                    <div class="col-sm-8 col-sm-offset-2">
	                      {!!Form::submit('Upload', array('class' => 'btn btn-primary'))!!}
	                    </div>
	                </div>
	            </div>

        	{!! Form::close() !!}
        	</div>
    	</div>
    </div>
	

@endsection