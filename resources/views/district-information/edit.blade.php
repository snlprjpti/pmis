@extends('layouts.master')

@section('content')

    @if(!empty($information))
    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading"> Edit Information</div>
        {!! Form::model($information,[
            'action'    => ['DistrictsInformationController@update',$districtId,$information->id],
            'method'    => 'PUT',
            'class'     => 'form-horizontal'

            ])
        !!}

        <div class="panel-body">

            @include('district-information.form')

        </div>

        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <button type="submit" class="btn-success btn">Save</button>
                    <a href="{{ action('DistrictsController@show',[$districtId]) }}" class="btn-default btn">Cancel</a>
                    <button type="reset" class="btn-inverse btn">Reset</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
    @endif

@endsection