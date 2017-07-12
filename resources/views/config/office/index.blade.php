@extends('layouts.master')

@section('content')
    @if(!empty($offices))
    <div class="row">
    <div class="row">
        <div class="col-md-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Office List
                    </div>

                    <div class="panel-body">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>District</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($offices as $off)
                                    <tr>
                                        <td>{{ $off->office_name }}</td>
                                        <td>{{ $off->office_type }}</td>
                                        <td>{{ $off->district->name }}</td>
                                        <td>
                                            <form action="{{ action('Configuration\OfficesController@destroy',[$off->id]) }}" method="POST" id="{{ $off->id }}">

                                                <input type="hidden" name="_method" value="DELETE"/>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                                                <a  data-toggle="tooltip" data-placement="top" title="Edit" class="edit-button" href="{{ action('Configuration\OfficesController@edit',[$off->id]) }}">
                                                    <i class="icon ion-edit"></i>
                                                </a>
                                                &nbsp;
                                                <button  data-toggle="tooltip" data-placement="top" title="Delete" type="submit"  class="delete">
                                                    <i class="icon ion-trash-a"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr id="noRecord">
                                        <td class="alert alert-warning" role="alert" colspan="5">No record to show.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>

        @include('config.office.form')
    </div>
    </div>
    @endif
@stop