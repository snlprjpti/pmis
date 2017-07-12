<?php

namespace Pmis\Http\Controllers\Document;

use Exception;
use File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Pmis\Eloquent\Book;
use Pmis\Eloquent\Office;
use Pmis\Http\Controllers\Controller;
use Pmis\Http\Requests\Document\BookFormRequest;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Book   $book
     * @param Office $office
     *
     * @return Response
     */
    public function index(Book $book, Office $office)
    {
        $books = $book->getPaginated();

        $offices = $office->lists('office_name', 'id');

        return view('document.book.index', compact('books', 'offices'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param Book   $book
     * @param Office $office
     *
     * @return Response
     */
    public function frontIndex(Book $book, Office $office)
    {
        $books = $book->filtered()->where('book_status', 1)->get();

        $offices = $office->lists('office_name', 'id');

        return view('frontend.documents.book-index', compact('books', 'offices'));
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

        return view('document.book.create', compact('offices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookFormRequest $bookFormRequest
     * @param Book            $book
     *
     * @return Response
     */
    public function store(BookFormRequest $bookFormRequest, Book $book)
    {
        try {
            $fileInformation = $this->uploadBook($bookFormRequest);

            $fileInformation['user_id'] = auth()->user()->getAuthIdentifier();

            $book->fill(array_merge($bookFormRequest->all(), $fileInformation))->save();

            session()->flash('success', 'Document uploaded successfully.');

            return redirect()->action('Document\BooksController@index');

        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int      $id
     * @param District $district
     * @param Book     $bookModel
     *
     * @return Response
     */
    public function edit($id, Office $office, Book $bookModel)
    {
        $book = '';
        $offices = '';
        try {
            if (!is_super_admin()) {
                $bookModel = $bookModel->where('office_id', auth()->user()->office_id);
            }

            $book = $bookModel->findOrFail($id);

            $offices = $office->lists('office_name', 'id');
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);
        }

        return view('document.book.edit', compact('book', 'offices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int             $id
     * @param BookFormRequest $bookFormRequest
     * @param Book            $bookModel
     *
     * @return Response
     */
    public function update($id, BookFormRequest $bookFormRequest, Book $bookModel)
    {
        try {
            if (!is_super_admin()) {
                $bookModel = $bookModel->where('office_id', auth()->user()->office_id);
            }

            $book = $bookModel->findOrFail($id);

            if ($bookFormRequest->hasFile('book_file')) {
                $fileInformation = $this->uploadBook($bookFormRequest);

                File::delete($book->file_path);
            }

            $fileInformation['user_id'] = auth()->user()->getAuthIdentifier();

            $fileInformation['book_status'] = $bookFormRequest->get('book_status', 0);

            $fileInformation['is_viewable_to_central'] = $bookFormRequest->get('is_viewable_to_central', 0);

            $fileInformation['is_viewable_to_district'] = $bookFormRequest->get('is_viewable_to_district', 0);

            $book->fill(array_merge($bookFormRequest->all(), $fileInformation))->save();

            session()->flash('success', 'Document updated successfully.');

            return redirect()->action('Document\BooksController@index');
           
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
     * @param int  $id
     * @param Book $bookModel
     *
     * @return Response
     */
    public function destroy($id, Book $bookModel)
    {
        try {
            if (!is_super_admin()) {
                $bookModel = $bookModel->where('office_id', auth()->user()->office_id);
            }

            $book = $bookModel->where('id', $id)->firstOrFail();

            File::delete($book->file_path);

            $book->delete();

            session()->flash('success', 'Document deleted successfully.');

            return redirect()->action('Document\BooksController@index');
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);

            return redirect()->back()->withInput();
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }

    public function download($id, Book $bookModel)
    {
        try {
            // if (!is_super_admin()) {
            //     $bookModel = $bookModel->where('office_id', auth()->user()->office_id);
            // }

            $book = $bookModel->where('id', '=', $id)->firstOrFail();

            return response()->download(public_path($book->file_path), $book->file_name, [
                'Content-Type' => $book->file_type,
                'filename' => $book->file_name,
            ]);
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
    protected function uploadBook(BookFormRequest $bookFormRequest)
    {
        $file = $bookFormRequest->file('book_file');

        $destination = 'uploads/documents/books/';

        $destinationPath = public_path($destination);

        $filename = microtime(true).'-'.$file->getClientOriginalName();

        $fileInformation = [];

        $fileInformation['file_type'] = $file->getClientMimeType();

        $fileInformation['file_size'] = $file->getSize();

        $fileInformation['file_name'] = $filename;


        $fileInformation['file_path'] = $destination.$filename;

        $file->move($destinationPath, $filename);

        return $fileInformation;
    }
}
