@extends('layouts.master')

@section('content')
    <div class="row">
        @include('document.report.filter-form')
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ action('Document\ReportsController@create') }}"> Upload Progress Report</a>
                </div>

                Progress Report List
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Submission Date</th>
                            <th>File Name</th>
                            <th>Office</th>
                            <th>Financial Year</th>
                            <th>Type</th>
                            <th>File Size</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($reports as $report)
                            <tr>
                                <td>{{ $report->submission_date }}</td>
                                <td>{{ $report->file_name }}</td>
                                <td>{{ super_echo($report->office,['office_name']) }}</td>
                                <td>{{ super_echo($report->fiscal,['name']) }}</td>
                                <td>{{ $report->type }}</td>

                                <td>{{ humanize_filesize($report->file_size) }}</td>
                                <td>
                                    <form action="{{ action('Document\ReportsController@destroy',[$report->id]) }}" method="POST"  id="{{ $report->id }}">

                                        <input type="hidden" name="_method" value="DELETE"/>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                                        <a target="_blank" data-toggle="tooltip" data-placement="top" title="Download" class="edit-button" href="{{ action('Document\ReportsController@download',[$report->id]) }}">
                                            <i class="icon ion-android-download"></i>
                                        </a>
                                        &nbsp;
                                        <a  data-toggle="tooltip" data-placement="top" title="Edit" class="edit-button" href="{{ action('Document\ReportsController@edit',[$report->id]) }}">
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
                                <td class="alert alert-warning" role="alert" colspan="9">No record to show.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                {{  $reports->render() }}
            </div>
        </div>
    </div>

@stop