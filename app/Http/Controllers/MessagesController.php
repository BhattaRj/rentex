<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Auth;

class MessagesController extends Controller
{

    protected $message;
    public function __construct(Message $message)
    {
        $this->middleware('auth');
        $this->message = $message;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $result['data']    = $this->message->myMessage();
        $result['success'] = true;
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(MessageRequest $request)
    {

        $input              = $request->input('data');
        $input['sender_id'] = Auth::id();
        $message            = $this->message->create($input);
        $result['data']     = $message->load('sender', 'recever');
        $result['success']  = true;

        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($sender_id)
    {
        $per_page          = 15;
        $result['data']    = $this->message->getConversation($sender_id)->skip(0)->take($per_page)->get();
        $result['success'] = true;
        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $messageData['status'] = 1;
        $result['data']        = $this->message->updateModel($messageData, $id);
        $result['success']     = true;
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($ids)
    {
        $ids = explode(",", $ids);
        foreach ($ids as $id) {
            $this->message->remove($id);
        }
        $result['success'] = true;
        return $result;
    }
}
