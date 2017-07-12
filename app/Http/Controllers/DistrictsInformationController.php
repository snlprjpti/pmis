<?php

namespace Pmis\Http\Controllers;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Pmis\Eloquent\District;
use Pmis\Eloquent\DistrictInformation;
use Pmis\Http\Requests\DistrictInformationFormRequest;

class DistrictsInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param District $district
     * @param $districtId
     *
     * @return Response
     */
    public function index(District $district, $districtId)
    {
        try {
            $district = $district->with([
                'informations' => function ($query) {
                    $query->orderBy('parent_id')->orderBy('display_order');

                },
            ])->findOrFail($districtId);
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);
        } catch (Exception $e) {
            $this->handleFlashMessage($e);
        }

        return view('district-information.index', compact('district'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param DistrictInformation $districtInformation
     * @param $districtId
     *
     * @return Response
     */
    public function create(DistrictInformation $districtInformation, $districtId)
    {
        $district_id = $districtInformation->all()->lists('district_id');
   
        $lists = $districtInformation->where('district_id','=',$districtId)->where('parent_id')->lists('title', 'id');
            
        return view('district-information.create', compact('districtId', 'lists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param District                       $district
     * @param DistrictInformationFormRequest $districtInformationFormRequest
     * @param $districtId
     *
     * @return Response
     */
    public function store(District $district, DistrictInformationFormRequest $districtInformationFormRequest, $districtId)
    {
        try {
            $district = $district->findOrFail($districtId);

            $information = new DistrictInformation($districtInformationFormRequest->all());

            $district->informations()->save($information);

            session()->flash('success', 'Information saved successfully.');

            return redirect()->action('DistrictsInformationController@index', [$districtId]);
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);
        } catch (Exception $e) {
            $this->handleFlashMessage($e);
        }

        return redirect()->back()->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param DistrictInformation $districtInformation
     * @param $districtId
     * @param int $id
     *
     * @return Response
     */
    public function edit(DistrictInformation $districtInformation, $districtId, $id)
    {
        try {
            $lists = $districtInformation->where('district_id','=',$districtId)->where('parent_id')->where('id', '<>', $id)->lists('title', 'id');

            $information = $districtInformation->where('district_id', $districtId)->findOrFail($id);

        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);
        } catch (Exception $e) {
            $this->handleFlashMessage($e);
        }

        return view('district-information.edit', compact('information', 'lists', 'districtId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DistrictInformation            $districtInformation
     * @param DistrictInformationFormRequest $districtInformationFormRequest
     * @param $districtId
     * @param int $id
     *
     * @return Response
     */
    public function update(DistrictInformation $districtInformation, DistrictInformationFormRequest $districtInformationFormRequest, $districtId, $id)
    {
        try {
            $information = $districtInformation->where('district_id', $districtId)->findOrFail($id);

            $information->fill($districtInformationFormRequest->all())->save();

            session()->flash('success', 'Information saved successfully.');

            return redirect()->action('DistrictsInformationController@index', [$districtId]);
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);
        } catch (Exception $e) {
            $this->handleFlashMessage($e);
        }

        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(DistrictInformation $districtInformation,$districtId, $id)
    {
        // return $id;
        $information = $districtInformation->findOrFail($id);
        $information->delete();
        session()->flash('success', 'Information Deleted successfully.');
        return back();
    }

    public function uploadImage(Request $requests)
    {
        $file = $requests->file('image');

        $destination = '/uploads/district-information/';

        $destinationPath = public_path($destination);

        $filename = microtime(true).'-'.$file->getClientOriginalName();

        $file->move($destinationPath, $filename);

        return $destination.$filename;
    }

    public function show(DistrictInformation $districtInformation, $districtId, $id)
    {
        try {
            $lists = $districtInformation->where('parent_id')->where('id', '<>', $id)->lists('title', 'id');

            $information = $districtInformation->where('district_id', $districtId)->findOrFail($id);
            
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);
        } catch (Exception $e) {
            $this->handleFlashMessage($e);
        }

        return view('district-information.show', compact('information', 'lists', 'districtId'));

    }
}
