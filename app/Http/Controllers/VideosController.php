<?php
/**
 * Created by PhpStorm.
 * User: amrit
 * Date: 7/5/15
 * Time: 3:24 PM
 */

namespace Pmis\Http\Controllers;

use Pmis\Library\Youtube;

class VideosController extends Controller{

    public function index()
    {
        try {
            $youtube = new Youtube(['key' => env('YOUTUBE_KEY')]);

            $playlists =   $youtube->getPlaylistsByChannelId('UC-rUEkcszpGM-eUGRnjoM3Q');

            return view('frontend.videos.index',compact('playlists'));

        }catch (\Exception $e)
        {
            dd($e);
        }
    }

    public function playlistvideos($playlistId)
    {
        try {
            $youtube = new Youtube(['key' => env('YOUTUBE_KEY')]);
            $playlist = $youtube->getPlaylistById($playlistId);
            $playlistItems =  $youtube->getPlaylistItemsByPlaylistId($playlistId);

            return view('frontend.videos.video-list',compact('playlist','playlistItems'));
        }catch (\Exception $e)
        {
            dd($e);
        }
    }
}