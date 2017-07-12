<?php

namespace Pmis\Http\Controllers\Document;

use Exception;
use File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Pmis\Eloquent\Fiscal;
use Pmis\Eloquent\Office;
use Pmis\Eloquent\Report;
use Pmis\Http\Controllers\Controller;
use Pmis\Http\Requests\Document\ReportFormRequest;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Report $report
     * @param Office $office
     * @param Fiscal $fiscal
     *
     * @return Response
     */
    public function index(Report $report, Office $office, Fiscal $fiscal)
    {
        $reports = $report->getPaginated();

        $offices = $office->lists('office_name', 'id');

        $fiscals = $fiscal->lists('name', 'id');

        return view('document.report.index', compact('reports', 'offices', 'fiscals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Fiscal $fiscal
     * @param Office $office
     * @return Response
     */
    public function create(Fiscal $fiscal, Office $office)
    {
        $offices = $office->lists('office_name', 'id');
        $fiscals = $fiscal->lists('name', 'id');

        return view('document.report.create', compact('offices', 'fiscals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReportFormRequest $reportFormRequest
     * @param Report            $report
     *
     * @return Response
     */
    public function store(ReportFormRequest $reportFormRequest, Report $report)
    {
        try {
            $fileInformation = $this->uploadBook($reportFormRequest);

            $fileInformation['user_id'] = auth()->user()->getAuthIdentifier();

            $report->fill(array_merge($reportFormRequest->all(), $fileInformation))->save();

            session()->flash('success', 'Document uploaded successfully.');

            return redirect()->action('Document\ReportsController@index');
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int    $id
     * @param Fiscal $fiscal
     * @param Office $office
     * @param Report $reportModel
     *
     * @return Response
     */
    public function edit($id, Fiscal $fiscal, Office $office, Report $reportModel)
    {
        $report = '';
        $districts = '';
        $fiscals = '';
        try {
            if (!is_super_admin()) {
                $reportModel = $reportModel->where('office_id', auth()->user()->office_id);
            }
            $offices = $office->lists('office_name', 'id');
            $fiscals = $fiscal->lists('name', 'id');

            $report = $reportModel->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);
        }

        return view('document.report.edit', compact('report', 'offices', 'fiscals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int               $id
     * @param ReportFormRequest $reportFormRequest
     * @param Report            $reportModel
     *
     * @return Response
     */
    public function update($id, ReportFormRequest $reportFormRequest, Report $reportModel)
    {
        try {
            $report = $reportModel->findOrFail($id);

            if ($reportFormRequest->hasFile('book_file')) {
                $fileInformation = $this->uploadBook($reportFormRequest);

                File::delete($report->file_path);
            }

            $fileInformation['user_id'] = auth()->user()->getAuthIdentifier();

            $report->fill(array_merge($reportFormRequest->all(), $fileInformation))->save();

            session()->flash('success', 'Document updated successfully.');

            return redirect()->action('Document\ReportsController@index');
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
     *
     * @param int    $id
     * @param Report $reportModel
     *
     * @return Response
     */
    public function destroy($id, Report $reportModel)
    {
        try {
            if (!is_super_admin()) {
                $reportModel = $reportModel->where('office_id', auth()->user()->office_id);
            }

            $report = $reportModel->where('id', $id)->firstOrFail();

            File::delete($report->file_path);

            $report->delete();

            session()->flash('success', 'Document deleted successfully.');

            return redirect()->action('Document\ReportsController@index');
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);

            return redirect()->back()->withInput();
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }

    public function download($id, Report $reportModel)
    {
        try {
            if (!is_super_admin()) {
                $reportModel = $reportModel->where('office_id', auth()->user()->office_id);
            }

            $report = $reportModel->where('id', '=', $id)->firstOrFail();

            return response()->download(
                public_path($report->file_path),
                $report->file_name,
                [
                'Content-Type' => $report->file_type,
                'filename' => $report->file_name,
                ]
            );
        } catch (Exception $e) {
            return response('File not found');
        }
    }

    /**
     * Upload book.
     *
     * @param $bookFormRequest
     *
     * @return array
     */
    protected function uploadBook(ReportFormRequest $bookFormRequest)
    {
        $file = $bookFormRequest->file('book_file');

        $destination = 'uploads/documents/reports/';

        $destinationPath = public_path($destination);

        $filename = microtime(true).'-'.$file->getClientOriginalName();

        $fileInformation = [];

        $fileInformation['file_type'] = $file->getClientMimeType();

        $fileInformation['file_size'] = $file->getSize();

        $fileInformation['file_name'] =  $file->getClientOriginalName();

        $fileInformation['file_path'] = $destination.$filename;

        $file->move($destinationPath, $filename);

        return $fileInformation;
    }
}
