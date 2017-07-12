@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ action('Auth\UsersController@create') }}"> Add new User</a>
                </div>

                <i class="ion ion-ios-people"></i> &nbsp;Users List
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Designation</th>
                        <th>District</th>
                        <th>Office</th>
                        <th>User Typr</th>
                        <th>Last Login</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ super_echo($user->designation,['name']) }}</td>
                            <td>{{ super_echo($user->district,['name']) }}</td>
                            <td>{{ super_echo($user->office,['office_name']) }}</td>
                            <td>{{ $user->type }}</td>
                            <td>{{ $user->created_at->toDayDateTimeString()}}</td>
                            <td><i class="ion {{ ($user->status >0)?'ion-checkmark-round':'ion-close-round' }}"></i></td>

                            <td>
                                    <a  data-toggle="tooltip" data-placement="top" title="Edit" class="edit-button" href="{{ action('Auth\UsersController@edit',[$user->id]) }}">
                                        <i class="icon ion-edit"></i>
                                    </a>
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
            </div>
        </div>
    </div>

@stop