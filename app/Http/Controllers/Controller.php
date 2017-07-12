<?php namespace Pmis\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

//use Pmis\Eloquent\Page;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

//     $pages = Page::where('status','=','1')
//                    ->orderBy('order','asc')->get();
//     View::share('pages',$pages);

    public function handleFlashMessage(\Exception $e)
    {

        if(env('APP_DEBUG'))
        {
            session()->flash('error',$e->getMessage());

        }else {
            session()->flash('error','Something went wrong.');

        }
    }

    public function handleModelNotFound($e)
    {
        if(env('APP_DEBUG'))
        {
            session()->flash('error',$e->getMessage());

        }else {
            session()->flash('error','Invalid Request.');

        }

    }



}
