<?php

namespace Pmis\Http\Controllers;

use File;
use Pmis\Eloquent\Page;
use Pmis\Eloquent\Gallery;
use Pmis\Eloquent\District;

class WelcomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Welcome Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the "marketing page" for the application and
    | is configured to only allow guests. Like most of the other sample
    | controllers, you are free to modify or remove it as you desire.
    |
    */

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
       // $districts = District::all();
       // $data = (array)json_decode(File::get(public_path('vdc.json')),true);
       // $collection = collect($data);
       // foreach($districts as $district)
       // {
       //     if($collection->has($district->name))
       //     {
       //         $districtModel = District::find($district->id);
       //         $vdc = $collection->pull($district->name);
       //         $districtModel->vdc()->createMany($vdc);
       //     }
       // }
       // return 'Done';

        $galleries = Gallery::where('status','=',1)->get();
        $pages = Page::where('id',2)->first();
       return view('frontend.index', compact('galleries','pages'));
     }

     public function pages($id)
    {
      try{
         $page = Page::findorFail($id);
          if($page->status == 1 && $page->id != 2)
          {
            return view('frontend.pages', compact('page'));
          }
      } 
       catch(\Exception $e)
       {
        abort(404);
       } 
    }

}

