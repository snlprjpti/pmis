@extends('layouts.master')

@section('content')
    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading">
                Districts
            </div>

            <div class="panel-body">

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>District Name</th>
                            <th>Zone</th>
                            <th>Headquarter</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($districts as $district)
                        <tr>
                            <td>{{ $district->name }}</td>
                            <td>{{ super_echo($district->zone,['name']) }}</td>
                            <td>{{ $district->headquarter }}</td>

                            <td >
                                &nbsp;

                                <a data-toggle="tooltip" data-placement="top" title="View Details" class="edit-button" href="{{ action('DistrictsController@show',[$district->id]) }}">
                                    <i class="icon ion-information-circled"></i>
                                </a>

                                &nbsp;
                                    <a data-toggle="tooltip" data-placement="top" title="Edit" class="edit-button" href="{{ action('DistrictsController@edit',[$district->id]) }}">
                                        <i class="icon ion-edit"></i>
                                    </a>
                            </td>
                        </tr>
                    @empty
                        <tr id="noRecord">
                            <td class="alert alert-warning" role="alert" colspan="10">No record to show.</td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection