<?php

namespace App\Http\Controllers;

use App\Presenter\MessagePresenter;
use App\Repository\MessageRepository;
use App\Service\CreateReply;
use App\Service\CreateSMS;
use App\Service\SMS\SMSEmpresa\Input;
use App\Transformer\MessageTransformer;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    public function store(Request $request)
    {
        $message = MessageTransformer::arrayToEntity($request->all());
        (new CreateSMS($message))->run();
        $data = MessagePresenter::toStore($message);
        return response()->json($data);
    }

    public function view(Request $request, string $uuid)
    {
        $message = MessageRepository::findByUuid($uuid);
        $data = MessagePresenter::toView($message);
        return response()->json($data);
    }

    public function receive(Request $request)
    {
        $message = Input::payloadToEntity($request->all());
        (new CreateReply($message))->run();
        return response()->json(["OK!"]);
    }
}
