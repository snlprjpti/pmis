@extends('layouts.master')

@section('content')

    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading">
                Messages
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Submitted Date</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Is Viewed?</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $message)
                            <tr>
                                <td>{{ $message->created_at }}</td>
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->phone }}</td>
                                <td>{{ $message->subject }}</td>
                                <td><i class="ion {{ ($message->viewed_on >0)?'ion-checkmark-round':'ion-close-round' }}"></i></td>
                                <td>
                                    <a data-toggle="tooltip" data-placement="top" title="View" class="edit-button" href="{{ action('HelpDeskMessagesController@show',[$message->id]) }}">
                                        <i class="icon ion-information-circled"></i> View Detail
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


@endsection