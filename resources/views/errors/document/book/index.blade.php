@extends('layouts.master')

@section('content')
    <div class="row">
        @include('document.book.filter-form')
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ action('Document\BooksController@create') }}"> Upload Document</a>
                </div>

                Documents List
            </div>
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
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($books as $book)
                            <tr>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->organization_name }}</td>
                                <td>{{ $book->organization_type }}</td>
                                <td>{{ $book->type }}</td>
                                <td>{{ super_echo($book->office,['office_name']) }}</td>
                                <td>{{ humanize_filesize($book->file_size) }}</td>
                                <td>
                                    <form action="{{ action('Document\BooksController@destroy',[$book->id]) }}" method="POST"  id="{{ $book->id }}">

                                        <input type="hidden" name="_method" value="DELETE"/>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                                        <a target="_blank" data-toggle="tooltip" data-placement="top" title="Download" class="edit-button" href="{{ action('Document\BooksController@download',[$book->id]) }}">
                                            <i class="icon ion-android-download"></i>
                                        </a>
                                        &nbsp;
                                        <a  data-toggle="tooltip" data-placement="top" title="Edit" class="edit-button" href="{{ action('Document\BooksController@edit',[$book->id]) }}">
                                            <i class="icon ion-edit"></i>
                                        </a>
                                        &nbsp;
                                        <button  data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="delete">
                                            <i class="icon ion-trash-a"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr id="noRecord">
                                <td class="alert alert-warning" role="alert" colspan="8">No record to show.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                {{  $books->render() }}
            </div>
        </div>
    </div>

@stop