@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-right">
                    <a  class="btn btn-primary" href="{{ action('Document\BooksController@index') }}"> Documents List</a>
                </div>
                Upload Document
            </div>
                {!! Form::open([
                            'action'=>'Document\BooksController@store',
                            'files' =>true,
                            'class' =>'form-horizontal'

                    ])
                !!}

                <div class="panel-body">
                    @include('document.book.form')
                </div>

                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <button type="submit" class="btn-success btn">Save</button>
                            <a href="{{ action('Document\BooksController@index') }}" class="btn-default btn">Cancel</a>
                            <button type="reset" class="btn-inverse btn">Reset</button>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

@stop