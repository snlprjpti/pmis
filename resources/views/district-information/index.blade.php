@extends('layouts.master')

@section('content')

    @if($district->count())
    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ action('DistrictsInformationController@create',[$district->id]) }}">Add new Information</a>
                </div>
                Districts [{{ $district->name }}]
            </div>

            <div class="panel-body">

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Parent Title</th>
                            <th>status</th>
                            <th>Actions</th>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($district->informations as $information)
                        <tr>
                            <td>{{ $information->title }}</td>
                            <td>
                             <?php
                                    $parent = Pmis\Eloquent\DistrictInformation::find($information->parent_id);
                                  ?>
                                {{($parent != '')?$parent->title:'Is a Parent'}}                         
                            </td>
                            <td><i class="ion {{ ($information->status >0)?'ion-checkmark-round':'ion-close-round' }}"></i></td>
                            <td >
                                &nbsp;

                                <a data-toggle="tooltip" data-placement="top" title="View Details" class="edit-button" href="{{ action('DistrictsInformationController@show',[$district->id,$information->id]) }}">
                                    <i class="icon ion-information-circled"></i>
                                </a>

                                &nbsp;
                                    <a data-toggle="tooltip" data-placement="top" title="Edit" class="edit-button" href="{{ action('DistrictsInformationController@edit',[$district->id,$information->id]) }}">
                                        <i class="icon ion-edit"></i>
                                    </a>
                            </td>    
                            <td>
                                <form action="{{ action('DistrictsInformationController@destroy',[$district->id,$information->id]) }}" method="POST" id="{{$information->id}}">                                  
                                    <input type="hidden" name="_method" value="DELETE"/>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                    <button  data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="delete">
                                        <i class="btn-lg icon ion-trash-a"></i>
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
    @endif
@endsection