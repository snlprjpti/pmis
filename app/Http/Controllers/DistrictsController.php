<?php

namespace Pmis\Http\Controllers;

use File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Pmis\Eloquent\District;
use Pmis\Eloquent\Zone;
use Pmis\Http\Requests\DistrictFormRequest;

class DistrictsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param District $district
     *
     * @return Response
     */
    public function index(District $district)
    {
        $districts = $district->with('zone')->orderBy('name')->get();

        return view('district.index', compact('districts', 'zones'));
    }

    public function frontIndex(District $district, $districtId = null)
    {
        $districtList = $district->lists('name', 'id');
        $view = view('frontend.district', compact('districtList'));
        if (!is_null($districtId)) {
            $district = $district->with(['zone', 'vdc','informations'=>function($query) {
                $query->where('status',1)
                    ->where('parent_id')
                    ->with(['subpages'=>function($query){
                        $query->where('status',1);
                }]);
            }])->where('id',$districtId)->first();
            $view->with('district', $district);
        }

        return $view;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param District $district
     * @param DistrictFormRequest $districtFormRequest
     *
     * @return Response
     */
    public function store(District $district, DistrictFormRequest $districtFormRequest)
    {
        try {
            $mapInformation = $this->uploadDocuments($districtFormRequest, 'uploads/district-map/', 'map_file');

            $documentInformation['map_path'] = $mapInformation['file_path'];

            $documentInformation['user_id'] = auth()->user()->getAuthIdentifier();

            $district->fill(array_merge($districtFormRequest->all(), $documentInformation))->save();

            session()->flash('success', 'District information saved successfully.');

            return redirect()->action('DistrictsController@index');
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param District $district
     * @param int $id
     *
     * @return Response
     */
    public function show(District $district, $id)
    {
        $view = view('district.show');

        try {
            $district = $district->with('informations')->findOrFail($id);

            $view->with(compact('district'));
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);
        }

        return $view;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param District $district
     * @param Zone $zone
     * @param int $id
     *
     * @return Response
     */
    public function edit(District $district, Zone $zone, $id)
    {
        $view = view('district.edit');

        try {
            $district = $district->findOrFail($id);

            $zones = $zone->lists('name', 'id');

            $view->with(compact('district', 'zones'));
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);
        }

        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param District $district
     * @param DistrictFormRequest $districtFormRequest
     * @param int $id
     *
     * @return Response
     */
    public function update(District $district, DistrictFormRequest $districtFormRequest, $id)
    {
        try {
            $district = $district->findOrFail($id);

            $documentInformation = [];

            $mapInformation = $this->uploadDocuments($districtFormRequest, 'uploads/district-map/', 'map_file');

            $documentInformation['map_path'] = $mapInformation['file_path'];

            File::delete($district->map_path);

            $documentInformation['user_id'] = auth()->user()->getAuthIdentifier();

            $district->fill(array_merge($districtFormRequest->all(), $documentInformation))->save();

            session()->flash('success', 'District information saved successfully.');

            return redirect()->action('DistrictsController@index');
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);

            return redirect()->back()->withInput();
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }

    /**
     * @param $districtFormRequest
     * @param $destination
     * @param $name
     *
     * @return array
     */
    private function uploadDocuments($districtFormRequest, $destination, $name)
    {
        $file = $districtFormRequest->file($name);

        $destinationPath = public_path($destination);

        $filename = microtime(true) . '-' . $file->getClientOriginalName();

        $fileInformation = [];

        $fileInformation['file_type'] = $file->getClientMimeType();

        $fileInformation['file_size'] = $file->getSize();

        $fileInformation['file_name'] = basename($file->getClientOriginalName(),
            '.' . $file->getClientOriginalExtension());

        $fileInformation['file_path'] = $destination . $filename;

        $file->move($destinationPath, $filename);

        return $fileInformation;
    }
}
