<?php
declare(strict_types=1);
namespace App\Utils\Responses;

use Symfony\Component\HttpFoundation\Response;

class ErrorResponse{

    public $code;
    public $message;

    public function __construct(int $code = Response::HTTP_NOT_FOUND){
        $this->code = $code;
        $this->message = array_key_exists($code,ErrorResponse::$messageDescriptions) ? ErrorResponse::$messageDescriptions[$code] : "Unknown Error";
    }

    public static array $messageDescriptions = [
        //TODO Add more code messages
        404 => 'Not Found',
        202 => 'Accepted',
    ];

    /**
     * Returns a response with the following format. code is equivalent to returned HTTP code
     * See
     *
     *  {
     *      "code": 202,
     *      "message": "Accepted"
     *  }
     *
     * See \Symfony\Component\HttpFoundation\Response for HTTP codes
     *
     * @param   int  $code
     * @return  \Illuminate\Contracts\Routing\ResponseFactory
     */
    public static function errorResponse(int $code){
        return response()->json(new ErrorResponse($code),$code);
    }
}
?>
