<?php namespace Pmis\Http\Controllers\Other;

use Pmis\Eloquent\Country;
use Pmis\Eloquent\ImportantLink;
use Pmis\Http\Requests;
use Pmis\Http\Controllers\Controller;
use Pmis\Http\Requests\ImportantLinkForm;
use Illuminate\Http\Request;

class ImportantLinksController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request,ImportantLink $importantLink)
    {
        $links = $importantLink->where('id', '>', 0)->orderBy('id','DESC');;
        if(!empty($request->query('q')))
        {
            $links->where('name','LIKE','%'.$request->query('q').'%')->orderBy('id','DESC');
        }

        $links = $links->with('country')->paginate($importantLink->page);

        return view('others.importantLinks.index', compact('links'));
    }

    public function create(Country $country)
    {
        $country = $country->lists('name', 'id');

        return view('others.importantLinks.create',compact('country'));
    }

    public function store(ImportantLinkForm $importantLinkForm,ImportantLink $importantLink)
    {
        try {
            $importantLink->fill($importantLinkForm->all())->save();
            session()->flash('success','Important Links added successfully.');

            return redirect()->action('Other\ImportantLinksController@index');

        }catch (Exception $e) {

            $this->handleFlashMessage($e);
            return redirect()->back()->withInput();
        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id,Country $country,ImportantLink $importantLink)
    {
        $link = '';
        $countrys = '';
        try {

            $link = $importantLink->findOrFail($id);

            $country = $country->lists('name', 'id');

        } catch (ModelNotFoundException $e) {

            $this->handleModelNotFound($e);

        }
        return view('others.importantLinks.edit',compact('link','country'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,ImportantLinkForm $importantLinkForm,ImportantLink $importantLink)
    {
        try {

            $book = $importantLink->findOrFail($id);

            $book->fill($importantLinkForm->all())->save();

            session()->flash('success','Link updated successfully.');

            return redirect()->action('Other\ImportantLinksController@index');

        } catch (ModelNotFoundException $e) {

            $this->handleModelNotFound($e);

            return redirect()->back()->withInput();

        } catch (Exception $e) {

            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id,ImportantLink $importantLink)
    {
        try {

            $link = $importantLink->where('id',$id)->firstOrFail();

            $link->delete();

            session()->flash('success','Link deleted successfully.');

            return redirect()->action('Other\ImportantLinksController@index');

        } catch (ModelNotFoundException $e) {

            $this->handleModelNotFound($e);

            return redirect()->back()->withInput();

        } catch (Exception $e) {

            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }

    }

}
