<?php

/**
 * Created by PhpStorm.
 * User: amrit
 * Date: 6/10/15
 * Time: 3:20 PM.
 */
namespace Pmis\Http\Controllers\Configuration;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Pmis\Eloquent\Fiscal;
use Pmis\Http\Controllers\Controller;
use Pmis\Http\Requests\Configuration\FiscalFormRequest;

class FiscalsController extends Controller
{
    public function __construct()
    {
        $this->middleware('user.central');
    }

    public function index(Fiscal $fiscal)
    {
        $fiscals = $fiscal->get();

        return view('config.fiscal.index', compact('fiscals'));
    }

    /**
     * Handle Create financial year Request.
     *
     * @param Fiscal            $fiscal
     * @param FiscalFormRequest $fiscalFormRequest
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Fiscal $fiscal, FiscalFormRequest $fiscalFormRequest)
    {
        try {
            $fiscal->fill($fiscalFormRequest->all())->save();

            session()->flash('success', 'Financial year saved successfully.');

            return redirect()->action('Configuration\FiscalsController@index');
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }

    /**
     * Render financial year Edit Form.
     *
     * @param Fiscal $fiscalModel
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Fiscal $fiscalModel, $id)
    {
        $fiscal = '';
        $fiscals = '';
        try {
            $fiscal = $fiscalModel->findOrFail($id);

            $fiscals = $fiscalModel->get();

            $label = 'Edit';
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);
        }

        return view('config.fiscal.index', compact('fiscal', 'fiscals', 'label'));
    }

    /**
     * Handle financial year Update Form Request.
     *
     * @param Fiscal            $fiscalModel
     * @param FiscalFormRequest $fiscalFormRequest
     * @param $id
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Fiscal $fiscalModel, FiscalFormRequest $fiscalFormRequest, $id)
    {
        // return $fiscalFormRequest->all();
        try {
            $book = $fiscalModel->findOrFail($id);

            if(!$fiscalFormRequest->status)
            {
                $fiscalFormRequest['status'] = 0;
                
            }

            $book->fill($fiscalFormRequest->all())->save();

            session()->flash('success', 'Financial year updated successfully.');

            return redirect()->action('Configuration\FiscalsController@index');
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);

            return redirect()->back()->withInput();
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }

    /**
     * Delete Financial Year.
     *
     * @param Fiscal $fiscal
     * @param $id
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function destroy(Fiscal $fiscal, $id)
    {
        try {
            $fiscal->findOrFail($id)->delete();

            session()->flash('success', 'fiscal deleted successfully.');

            return redirect()->action('Configuration\FiscalsController@index');
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);

            return redirect()->back()->withInput();
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }

    public function status(Fiscal $fiscal, $id)
    {
    try{
            $financial = $fiscal->findOrFail($id);
            if($financial->status == 1)
            {
                $fiscal->find($id)->update(['status' => '0']);
            }
            else
            {
                $fiscal
                ->update(['status' => '0']);
                $fiscal->find($id)->update(['status' => '1']);
                

                // $status = 1;
            }
            // $financial->status = $status;
            $financial->save();
            return back();
        }
        catch(ModelNotFoundException $e)
        {
            return redirect()->back();
        }

    }
}
