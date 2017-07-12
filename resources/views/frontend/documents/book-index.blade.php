@extends('layouts.frontend')

@section('title')
    Books, Reports And Research
@stop

@section('content')

    <div class="panel panel-default"  id="filter_incomes">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="ion-ios-color-filter"></i> Filter Documents
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <form>

                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::text('title',Input::query('title'),[
                                'class' =>'form-control',
                                'id'    => "title",
                                'placeholder' =>'Enter Document Title'
                                ])
                            !!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="ion-ios-home"></i>
                                </div>

                                {!! Form::select('organization_type',[''=>'Choose Organization']+['Government'=>'Government','INGO/NGO'=>'INGO/NGO'],Input::query('organization_type'),[
                                    'class'         => "form-control",
                                    'id'            => "branch",
                                    ])
                                !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="ion-ios-briefcase"></i>
                                </div>

                                {!! Form::select('office',[''=>'Choose Office'] + $offices,Input::query('office'),[
                                    'class'         => "form-control",
                                    'id'            => "office",
                                    ])
                                !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-block">
                            Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Organization</th>
                        <th>Organization Type</th>
                        <th>Type</th>
                        <th>Office</th>
                        <th>File Size</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($books as $book)
                    <tr>
                        <td>
                            <a target="_blank" data-toggle="tooltip" data-placement="top" title="Download" class="edit-button" href="{{ action('Document\BooksController@download',[$book->id]) }}">
                                {{ $book->title }}
                            </a>
                        </td>
                        <td>{{ $book->organization_name }}</td>
                        <td>{{ $book->organization_type }}</td>
                        <td>{{ $book->type }}</td>
                        <td>{{ super_echo($book->office,['office_name']) }}</td>
                        <td>{{ humanize_filesize($book->file_size) }}</td>
                        <td>
                            <a target="_blank" data-toggle="tooltip" data-placement="top" title="Download" class="edit-button" href="{{ action('Document\BooksController@download',[$book->id]) }}">
                                <i class="ion ion-android-download"></i>Download
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr id="noRecord">
                        <td class="alert alert-warning" role="alert" colspan="8">No record to show.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>
    </div>
@stop
