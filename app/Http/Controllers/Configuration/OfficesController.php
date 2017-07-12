<?php

/**
 * Created by PhpStorm.
 * User: amrit
 * Date: 6/10/15
 * Time: 3:20 PM.
 */
namespace Pmis\Http\Controllers\Configuration;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Pmis\Eloquent\District;
use Pmis\Eloquent\Office;
use Pmis\Http\Controllers\Controller;
use Pmis\Http\Requests\Configuration\OfficeFormRequest;

class OfficesController extends Controller
{
    public function __construct()
    {
        $this->middleware('user.central');
    }

    public function index(Office $office, District $district)
    {
        $districts = $district->lists('name', 'id');

        $offices = $office->with('district')->paginate(20);

        return view('config.office.index', compact('offices', 'districts'));
    }

    /**
     * Handle Create Office Request.
     *
     * @param Office            $office
     * @param OfficeFormRequest $officeFormRequest
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Office $office, OfficeFormRequest $officeFormRequest)
    {
        try {
            $office->fill($officeFormRequest->all())->save();

            session()->flash('success', 'Office saved successfully.');

            return redirect()->action('Configuration\OfficesController@index');
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }

    /**
     * Render Office Edit Form.
     *
     * @param Office   $officeModel
     * @param District $district
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Office $officeModel, District $district, $id)
    {
        $office = '';
        $offices = '';
        try {
            $office = $officeModel->findOrFail($id);

            $offices = $officeModel->paginate(20);

            $districts = $district->lists('name', 'id');

            $offices = $officeModel->with('district')->get();

            $label = 'Edit';
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);
        }

        return view('config.office.index', compact('office', 'offices', 'label', 'districts'));
    }

    /**
     * Handle Designation Update Form Request.
     *
     * @param Office            $officeModel
     * @param OfficeFormRequest $officeFormRequest
     * @param $id
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Office $officeModel, OfficeFormRequest $officeFormRequest, $id)
    {
        try {
            $office = $officeModel->findOrFail($id);

            $office->fill($officeFormRequest->all())->save();

            session()->flash('success', 'Office updated successfully.');

            return redirect()->action('Configuration\OfficesController@index');
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);

            return redirect()->back()->withInput();
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }

    /**
     * Delete Designation.
     *
     * @param Office $office
     * @param $id
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function destroy(Office $office, $id)
    {
        try {
            $office->findOrFail($id)->delete();

            session()->flash('success', 'Office deleted successfully.');

            return redirect()->action('Configuration\OfficesController@index');
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);

            return redirect()->back()->withInput();
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }
}
