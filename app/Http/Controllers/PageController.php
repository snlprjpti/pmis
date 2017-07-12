<?php 
namespace Pmis\Http\Controllers;

use Pmis\Eloquent\Page;
use Pmis\Http\Requests;
use Pmis\Http\Requests\PageRequest;
use Pmis\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PageController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$pages = Page::orderBy('id','Desc')->get();

		return view('page.index', compact('pages'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('page.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(PageRequest $request)
	{
		$page =  $request->all();	
		Page::create($page);
        return redirect()->route('backend.page.index');	
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
		$page = Page::find($id);
		return view('page.edit', compact('page'));	
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(PageRequest $request, $id)
	{
		 $page = Page::find($id);
		 // return $page;		
        $page->title = $request->input('title');
        $page->description = $request->input('description');
        $page->order = $request->input('order');
        $page->status = $request->input('status');
        $page->update();
        return redirect()->route('backend.page.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if($id == 2)
		{
			return redirect()->back();
		}
		$page = Page::find($id);
		$page->delete();
		return back();
	}

}
