@extends('layouts.master')

@section('content')
    @if(!empty($fiscals))
    <div class="row">
    <div class="row">
        <div class="col-md-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Financial Year List
                    </div>

                    <div class="panel-body">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <td>Status</td>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($fiscals as $fis)
                                    <tr>
                                        <td>{{ $fis->name }}</td>
                                        <td>
                                            <a href="{{url('/backend/config/financial-year/status', $fis->id)}}"><button class="ion {{ ($fis->status == 1)?'ion-checkmark-round btn-success':'ion-close-round btn-danger' }}"></button></a> 

                                        </td>
                                        <td>
                                            <form action="{{ action('Configuration\FiscalsController@destroy',[$fis->id]) }}" method="POST"  id="{{  $fis->id}}">

                                                <input type="hidden" name="_method" value="DELETE"/>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                                                <a  data-toggle="tooltip" data-placement="top" title="Edit" class="edit-button" href="{{ action('Configuration\FiscalsController@edit',[$fis->id]) }}">
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
                                        <td class="alert alert-warning" role="alert" colspan="5">No record to show.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>

        @include('config.fiscal.form')
    </div>
    </div>

    @endif
@stop