<?php

/**
 * Created by PhpStorm.
 * User: amrit
 * Date: 6/10/15
 * Time: 3:20 PM.
 */
namespace Pmis\Http\Controllers\Configuration;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Pmis\Eloquent\CensusInformation;
use Pmis\Http\Controllers\Controller;
use Pmis\Http\Requests\Configuration\CensusFormRequest;

/**
 * Class CensusController.
 */
class CensusController extends Controller
{
    public function __construct()
    {
        $this->middleware('user.central');
    }

    /**
     * @param CensusInformation $censusInformation
     *
     * @return \Illuminate\View\View
     */
    public function index(CensusInformation $censusInformation)
    {
        $censusInformations = $censusInformation->orderBy('status')->get();

        return view('config.census.index', compact('censusInformations'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('config.census.create');
    }

    /**
     * Handle Create Designation Request.
     *
     * @param CensusInformation $censusInformation
     * @param CensusFormRequest $censusFormRequest
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(CensusInformation $censusInformation, CensusFormRequest $censusFormRequest)
    {
        try {
            $status = $censusFormRequest->get('status', 0);

            if ($status) {
                $censusInformation->newInstance()->update(['status' => 0]);
            }

            $censusInformation->fill($censusFormRequest->all())->save();

            session()->flash('success', 'Census Information saved successfully.');

            return redirect()->action('Configuration\CensusController@index');
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }

    /**
     * Render Designation Edit Form.
     *
     * @param CensusInformation $censusInformation
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(CensusInformation $censusInformation, $id)
    {
        $view = view('config.census.edit');

        try {
            $censusInformation = $censusInformation->findOrFail($id);

            $view->with(compact('censusInformation'));
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);
        }

        return $view;
    }

    /**
     * Handle Designation Update Form Request.
     *
     * @param CensusInformation $censusInformation
     * @param CensusFormRequest $censusFormRequest
     * @param $id
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(CensusInformation $censusInformation, CensusFormRequest $censusFormRequest, $id)
    {
        try {
            $status = $censusFormRequest->get('status', 0);

            if ($status) {
                $censusInformation->update(['status' => 0]);
            }

            $censusInformation = $censusInformation->newInstance()->findOrFail($id);

            $censusInformation->fill(array_merge($censusFormRequest->all(), ['status' => $status]))->save();

            session()->flash('success', 'Census Information updated successfully.');

            return redirect()->action('Configuration\CensusController@index');
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
     * @param CensusInformation $censusInformation
     * @param $id
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function destroy(CensusInformation $censusInformation, $id)
    {
        try {
            $censusInformation->inActive()->findOrFail($id)->delete();

            session()->flash('success', 'Census Information deleted successfully.');

            return redirect()->action('Configuration\CensusController@index');
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);

            return redirect()->back()->withInput();
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }
}
