@extends('layouts.frontend')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            {{ super_echo($playlist->get('snippet'),['title']).' :: ' }} Videos PlayLists
        </div>
        <div class="panel-body">
            <div class="row" style="margin-bottom: 35px;">
                <div id="player" style="display: none">

                </div>
            </div>
            @if(!empty($playlistItems))
            @foreach($playlistItems->chunk(4) as $playlistItemChunk)

                <div class="row">
                    @foreach($playlistItemChunk as $video)

                        <div class="col-md-3">
                           <a href="#" class="yt-video" data-video="{{ $video->snippet->resourceId->videoId }}" data-playlist="{{ $video->snippet->playlistId }}">
                               <img class="img img-responsive" src="{{ $video->snippet->thumbnails->medium->url }}" alt=""/>
                               {{ $video->snippet->title }}
                           </a>
                            <div class="description">
                                <small>{{ $video->snippet->description }} </small>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
            @else
                <div class="alert alert-info">
                    Videos not uploaded
                </div>
            @endif

        </div>
    </div>

@endsection

@section('js')

    <script type="text/javascript">
        (function () {
            $('.yt-video').click(function(e)
            {
                e.preventDefault();
                var video = $(this).data('video');
                var playlist = $(this).data('playlist');
                var markup = '<iframe class="col-md-12" height="480" src="https://www.youtube.com/embed/'+video+'?list='+playlist+'&listType=playlist&rel=0&showinfo=1&autoplay=1" frameborder="0" allowfullscreen></iframe>';
                $('#player').html(markup).slideDown();
                // Load the IFrame Player API code asynchronously.
//                var tag = document.createElement('script');
//                tag.src = "https://www.youtube.com/player_api";
//                var firstScriptTag = document.getElementsByTagName('script')[0];
//                firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
//
//                // Replace the 'ytplayer' element with an <iframe> and
//                // YouTube player after the API code downloads.
//                var player;
//                function onYouTubePlayerAPIReady() {
//                    player = new YT.Player('player', {
//                        height: '390',
//                        width: '640',
//                        videoId: video
//                    });
//                }

            });
        }());

    </script>
@endsection