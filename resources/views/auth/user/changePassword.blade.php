@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Change Password
            </div>

            {!! Form::open([
                        'action'=>['Auth\UsersController@updatePassword'],
                        'class' =>'form-horizontal',
                        'method'=>'PUT'
                ])
            !!}

            <div class="panel-body">
                <div class="form-group {{ ($errors->has('name'))?"has-error":'' }}">

                    <label for="password" class="col-sm-2 control-label">New Password</label>

                    <div class="col-sm-5">
                        {!!
                            Form::text('password',null,[
                                    'class'         =>  "form-control",
                                    'placeholder'   =>  "Enter new Password",
                                    'id'            =>  "name",
                                    'required'
                            ])
                        !!}
                        {!! $errors->first('password', '<span class="label label-danger" >:message</span >') !!}

                    </div>

                </div>
                <div class="form-group {{ ($errors->has('name'))?"has-error":'' }}">

                    <label for="name" class="col-sm-2 control-label">Confirm New Password</label>

                    <div class="col-sm-5">
                        {!!
                            Form::text('password_confirmation',null,[
                                    'class'         =>  "form-control",
                                    'placeholder'   =>  "Confirm New Password",
                                    'id'            =>  "name",
                                    'required'
                            ])
                        !!}
                        {!! $errors->first('password_confirmation', '<span class="label label-danger" >:message</span >') !!}

                    </div>

                </div>

            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <button type="submit" class="btn-success btn">Save</button>
                        <button type="reset" class="btn-inverse btn">Reset</button>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@stop