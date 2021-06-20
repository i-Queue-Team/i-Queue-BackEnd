<?php

namespace App\Exceptions;

use Throwable;
use App\Utils\Responses\IQResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;
use Prophecy\Exception\Doubler\MethodNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Swift_TransportException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
        });

        $this->renderable(function (Throwable $e, $request) {
            switch (true) {
                case $e instanceof Swift_TransportException:
                    return IQResponse::emptyResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
                case $e instanceof NotFoundHttpException:
                case $e instanceof MethodNotFoundException:
                    return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
                case $e instanceof MethodNotAllowedHttpException:
                case $e instanceof AuthenticationException:
                    return IQResponse::emptyResponse(Response::HTTP_FORBIDDEN);
                default:
                    if (App::environment('production')) {
                        return IQResponse::emptyResponse(Response::HTTP_NOT_FOUND);
                    }
            }
        });
    }
}


/*
            switch (true){
                case $e instanceof MethodNotAllowedHttpException:
                    return IQResponse::errorResponse(Response::HTTP_FORBIDDEN,$e);
                default:
                    return IQResponse::errorResponse(Response::HTTP_NOT_FOUND);
            }
*/
