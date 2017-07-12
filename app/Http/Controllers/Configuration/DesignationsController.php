<?php

/**
 * Created by PhpStorm.
 * User: amrit
 * Date: 6/10/15
 * Time: 3:20 PM.
 */
namespace Pmis\Http\Controllers\Configuration;

use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Pmis\Eloquent\Designation;
use Pmis\Http\Controllers\Controller;
use Pmis\Http\Requests\Configuration\DesignationFormRequest;

class DesignationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('user.central');
    }

    public function index(Designation $designation)
    {
        $designations = $designation->orderBy(DB::raw('-display_order'), 'DESC')->get();

        return view('config.designation.index', compact('designations'));
    }

    /**
     * Handle Create Designation Request.
     *
     * @param Designation            $designation
     * @param DesignationFormRequest $designationFormRequest
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Designation $designation, DesignationFormRequest $designationFormRequest)
    {
        try {
            $designation->fill($designationFormRequest->all())->save();

            session()->flash('success', 'Designation saved successfully.');

            return redirect()->action('Configuration\DesignationsController@index');
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }

    /**
     * Render Designation Edit Form.
     *
     * @param Designation $designationModel
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Designation $designationModel, $id)
    {
        $designation = '';
        $designations = '';
        try {
            $designation = $designationModel->findOrFail($id);

            $designations = $designationModel->orderBy('display_order')->get();

            $label = 'Edit';
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);
        }

        return view('config.designation.index', compact('designation', 'designations', 'label'));
    }

    /**
     * Handle Designation Update Form Request.
     *
     * @param Designation            $designationModel
     * @param DesignationFormRequest $designationFormRequest
     * @param $id
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Designation $designationModel, DesignationFormRequest $designationFormRequest, $id)
    {
        try {
            $book = $designationModel->findOrFail($id);

            $book->fill($designationFormRequest->all())->save();

            session()->flash('success', 'Designation updated successfully.');

            return redirect()->action('Configuration\DesignationsController@index');
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
     * @param Designation $designation
     * @param $id
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function destroy(Designation $designation, $id)
    {
        try {
            $designation->findOrFail($id)->delete();

            session()->flash('success', 'Designation deleted successfully.');

            return redirect()->action('Configuration\DesignationsController@index');
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);

            return redirect()->back()->withInput();
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }
}
