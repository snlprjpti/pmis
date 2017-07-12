<?php
namespace Pmis\Http\Controllers;

use Pmis\Eloquent\Gallery;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Pmis\Http\Controllers\Controller;
use Pmis\Http\Requests\GalleryRequest;

use Illuminate\Http\Request;

class GalleryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$galleries = Gallery::orderBy('id','Desc')->paginate(10);
		return view('gallery.index', compact('galleries'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('gallery.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
		public function store(GalleryRequest $request)
		{
		
			$galleries = $request->all();
			$images = $galleries['image'];
			$extension = $images->getClientOriginalExtension();
			$imageName = time().rand(0,900000).'.'.$extension ;
			$images->move('gallery', $imageName);
			$galleries['image'] = $imageName;
			Gallery::create($galleries);	
            session()->flash('success', 'Saved successfully.');
			return redirect()->route('backend.gallery.index');				
		}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$gallery = Gallery::find($id);
		// return $gallery;
        @unlink(public_path().'/gallery/'.$gallery->image);
		$gallery->delete();
		return back();
	}

	public function status($id)
	{
		$gallery = Gallery::find($id);
		if($gallery->status == 1)
		{
			$status = 0;
		}	
		else
		{
			$status = 1;
		}
		$gallery->status = $status;
		$gallery->save();
		return back();
	}

}
