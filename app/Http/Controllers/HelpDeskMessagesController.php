<?php

namespace Pmis\Http\Controllers;

use DateTime;
use Exception;
use Mail;
use Pmis\Eloquent\HelpDeskMessage;
use Pmis\Http\Requests\HelpDeskMessageFormRequest;

class HelpDeskMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param HelpDeskMessage $helpDeskMessage
     *
     * @return Response
     */
    public function index(HelpDeskMessage $helpDeskMessage)
    {
        $messages = $helpDeskMessage->orderBy('viewed_on')->orderBy('created_at')->get();

        return view('helpdesk.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('frontend.helpdesk');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HelpDeskMessage            $helpDeskMessage
     * @param HelpDeskMessageFormRequest $helpDeskMessageFormRequest
     *
     * @return Response
     */
    public function store(HelpDeskMessage $helpDeskMessage, HelpDeskMessageFormRequest $helpDeskMessageFormRequest)
    {
        try {
            $helpDeskMessage->fill($helpDeskMessageFormRequest->all())->save();

            session()->flash('success', 'Your message is submitted.Thank you.');

            return redirect()->action('HelpDeskMessagesController@create');
        } catch (Exception $e) {
            $this->handleFlashMessage($e);

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param HelpDeskMessage $helpDeskMessage
     * @param int             $id
     *
     * @return Response
     */
    public function show(HelpDeskMessage $helpDeskMessage, $id)
    {
        $view = view('helpdesk.show');

        try {
            $message = $helpDeskMessage->findOrFail($id);

            $view->with(compact('message'));
            $message->viewed_on = new DateTime();
            $message->save();
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);
        }

        return $view;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param HelpDeskMessage $helpDeskMessage
     * @param int             $id
     *
     * @return Response
     */
    public function edit(HelpDeskMessage $helpDeskMessage, $id)
    {
        $view = view('helpdesk.edit');

        try {
            $message = $helpDeskMessage->findOrFail($id);

            $view->with(compact('message'));
        } catch (ModelNotFoundException $e) {
            $this->handleModelNotFound($e);
        }

        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HelpDeskMessage            $helpDeskMessage
     * @param HelpDeskMessageFormRequest $helpDeskMessageFormRequest
     * @param int                        $id
     *
     * @return Response
     */
    public function update(HelpDeskMessage $helpDeskMessage, HelpDeskMessageFormRequest $helpDeskMessageFormRequest, $id)
    {
        try {
            $replyMessage = nl2br($helpDeskMessageFormRequest->get('reply_message'));

            $helpDeskMessage = $helpDeskMessage->findOrFail($id);

            $helpDeskMessage->reply_message = $replyMessage;

            $helpDeskMessage->replied_on = new DateTime();

            $helpDeskMessage->replied_by = auth()->user()->getAuthIdentifier();

            $helpDeskMessage->save();

            Mail::raw($replyMessage, function ($message) use ($helpDeskMessage, $helpDeskMessageFormRequest) {

                $message->from('no-reply@'.$helpDeskMessageFormRequest->getHost())
                    ->to($helpDeskMessage->email, $helpDeskMessage->name);
            });

            session()->flash('success', 'Message sent.');

            return redirect()->action('HelpDeskMessagesController@show', [$id]);
        } catch (Exception $e) {
            $this->handleFlashMessage($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
