@extends('layouts.frontend')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Videos PlayLists
        </div>
        <div class="panel-body">
            @foreach($playlists->chunk(4) as $playlistChunk)

                <div class="row">
                    @foreach($playlistChunk as $playlist)

                        <div class="col-md-3">
                            <a href="{{ action('VideosController@playlistvideos',[$playlist->id]) }}">
                                <img class="img img-responsive" src="{{ $playlist->snippet->thumbnails->medium->url }}" alt=""/>
                                {{ $playlist->snippet->title }}
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach

        </div>
    </div>

@endsection