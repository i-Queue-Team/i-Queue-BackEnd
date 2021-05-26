<?php

namespace App\Exceptions;

use App\Utils\Responses\IQResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Prophecy\Exception\Doubler\MethodNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

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
                case $e instanceof MethodNotFoundException:
                    return IQResponse::errorResponse(Response::HTTP_NOT_FOUND);
                case $e instanceof MethodNotAllowedHttpException:
                case $e instanceof AuthenticationException:
                    return IQResponse::errorResponse(Response::HTTP_FORBIDDEN);
                default:
                    return IQResponse::errorResponse(Response::HTTP_NOT_FOUND);
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
