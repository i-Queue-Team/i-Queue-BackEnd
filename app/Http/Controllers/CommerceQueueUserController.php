<?php

namespace App\Http\Controllers;

use App\Models\Commerce;
use App\Models\User;
use Illuminate\Http\Request;
use App\Utils\Responses\IQResponse;
use Symfony\Component\HttpFoundation\Response;

class CommerceQueueUserController extends Controller
{

    public function index(Commerce $commerce)
    {
        //TODO IMPLEMENT
        return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
    public function store(Commerce $commerce, Request $request)
    {
        //TODO IMPLEMENT
        return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
    public function show(Commerce $commerce, User $user)
    {
        //TODO IMPLEMENT
        return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function destroy(Commerce $commerce, User $user)
    {
        //TODO IMPLEMENT
        return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
