@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-right">
                    <a  class="btn btn-primary" href="{{ action('Auth\UsersController@index') }}"> Employee List</a>
                </div>
                Edit Employee Information
            </div>

            {!! Form::model($user,[
                        'action'=>['Auth\UsersController@update',$user->id],
                        'class' =>'form-horizontal',
                        'method'=>'PUT'
                ])
            !!}

            <div class="panel-body">
                @include('auth.user.form')
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <button type="submit" class="btn-success btn">Save</button>
                        <a href="{{ action('Auth\UsersController@index') }}" class="btn-default btn">Cancel</a>
                        <button type="reset" class="btn-inverse btn">Reset</button>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@stop