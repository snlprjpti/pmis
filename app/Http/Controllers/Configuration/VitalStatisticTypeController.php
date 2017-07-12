<?php namespace Pmis\Http\Controllers\Configuration;

use Exception;
use Pmis\Eloquent\VitalStatisticType;
use Pmis\Http\Controllers\Controller;
use Pmis\Http\Requests\VitalStatisticTypeFormRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VitalStatisticTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param VitalStatisticType $vitalStatisticType
     * @return Response
     */
    public function index(VitalStatisticType $vitalStatisticType)
    {
        $types = $vitalStatisticType->get();

        return view('config.vital-statistic-type.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('config.vital-statistic-type.create');
    }

    /**
     * Store a new created resource in storage.
     *
     * @param VitalStatisticTypeFormRequest $vitalStatisticTypeFormRequest
     * @param VitalStatisticType $vitalStatisticType
     * @return Response
     */
    public function store(VitalStatisticTypeFormRequest $vitalStatisticTypeFormRequest, VitalStatisticType $vitalStatisticType)
    {
        try {
            $vitalStatisticType->fill($vitalStatisticTypeFormRequest->all())->save();

            session()->flash('success', 'Vital Statistic Type Saved successfully.');

            return redirect()->action('Configuration\VitalStatisticTypeController@index');
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param VitalStatisticType $vitalStatisticType
     * @param int $id
     * @return Response
     */
    public function edit(VitalStatisticType $vitalStatisticType, $id)
    {
        $view = view('config.vital-statistic-type.index');
        try {
            $type = $vitalStatisticType->findOrFail($id);
            $label =  'Edit';
            $types = $vitalStatisticType->get();
            $view->with('type', $type)->with('types', $types)->with('label', $label);
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);
        } catch (Exception $e) {
            $this->handleFlashMessage($e);
        }

        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VitalStatisticTypeFormRequest $vitalStatisticTypeFormRequest
     * @param VitalStatisticType $vitalStatisticType
     * @param int $id
     * @return Response
     */
    public function update(VitalStatisticTypeFormRequest $vitalStatisticTypeFormRequest, VitalStatisticType $vitalStatisticType, $id)
    {
        try {
            $type = $vitalStatisticType->findOrFail($id);

            $type->fill($vitalStatisticTypeFormRequest->all())->save();

            session()->flash('success', 'Vital Statistic Type updated successfully.');

            return redirect()->action('Configuration\VitalStatisticTypeController@index');
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
     * @param VitalStatisticType $vitalStatisticType
     * @param int $id
     * @return Response
     */
    public function destroy(VitalStatisticType $vitalStatisticType, $id)
    {
        try {
            $vitalStatisticType->findOrFail($id)->delete();

            session()->flash('success', 'Vital Statistic Type deleted successfully.');

            return redirect()->action('Configuration\VitalStatisticTypeController@index');
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);
        } catch (Exception $e) {
            $this->handleFlashMessage($e);
        }

        return redirect()->back();
    }
}
