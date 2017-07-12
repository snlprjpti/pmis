@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Census Information's
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ action('Configuration\CensusController@create') }}">Add New Census Information</a>
                </div>
            </div>

            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Census Year</th>
                            <th>Total Population</th>
                            <th>Birth Per Sec</th>
                            <th>Death Per Sec</th>
                            <th>Migration Per Sec</th>
                            <th>Sex Ratio</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($censusInformations as $census)
                        <tr>
                            <td>{{ $census->census_year->toFormattedDateString() }}</td>
                            <td>{{ $census->total_population }}</td>
                            <td>{{ $census->birth_per_sec }}</td>
                            <td>{{ $census->death_per_sec }}</td>
                            <td>{{ $census->migration_per_sec }}</td>
                            <td>{{ $census->sex_ratio }}</td>
                            <td><i class="ion {{ ($census->status >0)?'ion-checkmark-round':'ion-close-round' }}"></i></td>
                            <td>
                                <form action="{{ action('Configuration\CensusController@destroy',[$census->id]) }}" method="POST"  id="{{  $census->id}}">

                                    <input type="hidden" name="_method" value="DELETE"/>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                                    <a  data-toggle="tooltip" data-placement="top" title="Edit" class="edit-button" href="{{ action('Configuration\CensusController@edit',[$census->id]) }}">
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
                            <td class="alert alert-warning" role="alert" colspan="10">No record to show.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection