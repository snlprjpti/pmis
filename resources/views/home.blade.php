@extends('layouts.master')

@section('content')
	<div class="row">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Progress Reports
                    </div>

                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>District</th>
                                <th>Submission Date</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($reports as $report)
                                <tr>
                                    <td>{{ $report->title }}</td>
                                    <td>{{ $report->office->district->name }}</td>
                                    <td>{{ $report->submission_date }}</td>
                                    <td>{{ $report->type }}</td>
                                    <td class="text-center">
                                        <a target="_blank" data-toggle="tooltip" data-placement="top" title="Download" class="edit-button" href="{{ action('Document\ReportsController@download',[$report->id]) }}">
                                            <i class="icon ion-android-download"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr id="noRecord">
                                    <td class="alert alert-warning" role="alert" colspan="9">No record to show.</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Department Documents
                    </div>

                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Published On</th>
                                    <th>Office</th>
                                    <th>File Size</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($departmentdocuments as $departmentdocument)
                                    <tr>
                                        <td>{{ $departmentdocument->title }}</td>
                                        <td>{{ $departmentdocument->type }}</td>
                                        <td>{{ $departmentdocument->published_on }}</td>
                                        <td>{{ super_echo($departmentdocument->office,['office_name']) }}</td>
                                        <td>{{ humanize_filesize($departmentdocument->file_size) }}</td>
                                        <td><i class="ion {{ ($departmentdocument->documents_status >0)?'ion-checkmark-round':'ion-close-round' }}"></i></td>
                                        <td>
                                            <a target="_blank" data-toggle="tooltip" data-placement="top" title="Download" class="edit-button" href="{{ action('Document\DepartmentDocumentsController@download',[$departmentdocument->id]) }}">
                                                <i class="icon ion-android-download"></i>
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

            </div>

        </div>

    </div>

@endsection
