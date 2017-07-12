@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-right">
                    <a  class="btn btn-primary" href="{{ action('Configuration\CensusController@index') }}"> Census Informations</a>
                </div>
                New Census Information
            </div>
            {!! Form::open([
                        'action'=>'Configuration\CensusController@store',
                        'class' =>'form-horizontal'

                ])
            !!}

            <div class="panel-body">
                @include('config.census.form')
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <button type="submit" class="btn-success btn">Save</button>
                        <a href="{{ action('Configuration\CensusController@index') }}" class="btn-default btn">Cancel</a>
                        <button type="reset" class="btn-inverse btn">Reset</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@stop