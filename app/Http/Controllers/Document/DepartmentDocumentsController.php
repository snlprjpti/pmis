<?php

namespace Pmis\Http\Controllers\Document;

use Exception;
use File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Pmis\Eloquent\DepartmentDocument;
use Pmis\Eloquent\Office;
use Pmis\Http\Controllers\Controller;
use Pmis\Http\Requests\Document\DepartmentDocumentFormRequest;

class DepartmentDocumentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('user.central');
    }

    /**
     * Display a listing of the resource.
     *
     * @param DepartmentDocument $departmentDocument
     * @param Office             $office
     *
     * @return Response
     */
    public function index(DepartmentDocument $departmentDocument, Office $office)
    {
        $departmentdocuments = $departmentDocument->with('uploader')->filtered()->paginate(20);

        $offices = $office->lists('office_name', 'id');

        return view('document.department-document.index', compact('departmentdocuments', 'offices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Office $office
     *
     * @return Response
     */
    public function create(Office $office)
    {
        $offices = $office->lists('office_name', 'id');

        return view('document.department-document.create', compact('offices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DepartmentDocumentFormRequest $departmentDocumentFormRequest
     * @param DepartmentDocument            $departmentDocument
     *
     * @return Response
     */
    public function store(DepartmentDocumentFormRequest $departmentDocumentFormRequest, DepartmentDocument $departmentDocument)
    {
        try {
            $fileInformation = $this->uploadBook($departmentDocumentFormRequest);

            $fileInformation['user_id'] = auth()->user()->getAuthIdentifier();

            $departmentDocument->fill(array_merge($departmentDocumentFormRequest->all(), $fileInformation))->save();

            session()->flash('success', 'Document uploaded successfully.');

            return redirect()->action('Document\DepartmentDocumentsController@index');
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int                $id
     * @param Office             $office
     * @param DepartmentDocument $departmentDocumentModel
     *
     * @return Response
     */
    public function edit($id, Office $office, DepartmentDocument $departmentDocumentModel)
    {
        $book = '';
        $offices = '';
        try {
            $book = $departmentDocumentModel->findOrFail($id);
            $offices = $office->lists('office_name', 'id');
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);
        }

        return view('document.department-document.edit', compact('book', 'offices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int                           $id
     * @param DepartmentDocument            $departmentDocumentModel
     * @param DepartmentDocumentFormRequest $departmentDocumentFormRequest
     *
     * @return Response
     */
    public function update($id, DepartmentDocument $departmentDocumentModel, DepartmentDocumentFormRequest $departmentDocumentFormRequest)
    {
        try {
            $book = $departmentDocumentModel->findOrFail($id);

            if ($departmentDocumentFormRequest->hasFile('book_file')) {
                $fileInformation = $this->uploadBook($departmentDocumentFormRequest);

                File::delete($book->file_path);
            }

            $fileInformation['user_id'] = auth()->user()->getAuthIdentifier();

            $fileInformation['documents_status'] = $departmentDocumentFormRequest->get('documents_status', 0);

            $book->fill(array_merge($departmentDocumentFormRequest->all(), $fileInformation))->save();

            session()->flash('success', 'Document updated successfully.');

            return redirect()->action('Document\DepartmentDocumentsController@index');
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
     * @param int                $id
     * @param DepartmentDocument $departmentDocumentModel
     *
     * @return Response
     */
    public function destroy($id, DepartmentDocument $departmentDocumentModel)
    {
        try {
            $book = $departmentDocumentModel->where('id', $id)->firstOrFail();

            File::delete($book->file_path);

            $book->delete();

            session()->flash('success', 'Document deleted successfully.');

            return redirect()->action('Document\DepartmentDocumentsController@index');
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);

            return redirect()->back()->withInput();
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }

    public function download($id, DepartmentDocument $departmentDocument)
    {
        try {
            $book = $departmentDocument->where('id', '=', $id)->firstOrFail();

            return response()->download(
                public_path($book->file_path),
                $book->file_name,
                [
                'Content-Type' => $book->file_type,
                'filename' => $book->file_name,
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
    protected function uploadBook(DepartmentDocumentFormRequest $bookFormRequest)
    {
        $file = $bookFormRequest->file('book_file');

        $destination = 'uploads/documents/department-document/';

        $destinationPath = public_path($destination);

        $filename = microtime(true).'-'.$file->getClientOriginalName();

        $fileInformation = [];

        $fileInformation['file_type'] = $file->getClientMimeType();

        $fileInformation['file_size'] = $file->getSize();

        $fileInformation['file_name'] = $file->getClientOriginalName();

        $fileInformation['file_path'] = $destination.$filename;

        $file->move($destinationPath, $filename);

        return $fileInformation;
    }
}
