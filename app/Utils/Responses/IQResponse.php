<?php
declare(strict_types=1);
namespace App\Utils\Responses;

use Symfony\Component\HttpFoundation\Response;

class IQResponse{

    public int $code;
    public string $message;
    public mixed $data;
    public mixed $debugInfo;

    public function __construct(int $code = Response::HTTP_NOT_FOUND, mixed $data = null, mixed $debugInfo = null){
        $this->code = $code;
        $this->message = array_key_exists($code,IQResponse::$messageDescriptions) ? IQResponse::$messageDescriptions[$code] : "No Message";
        if (isset($data)){
            $this->data = $data;
        }
        if (config('app.debug') == true && isset($debugInfo)){
            $this->debugInfo = $debugInfo;
        }
    }

    public static array $messageDescriptions = [
        //TODO Add more code messages
        200 => 'OK',
        201 => 'Resource Created',
        202 => 'Accepted',
        204 => 'No Content',
        400 => 'Bad Request',
        401 => 'Invalid Credentials',
        404 => 'Not Found',
        409 => 'Conflict',
        500 => 'Internal Server Error',
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
    public static function emptyResponse($code){
        return response()->json(new IQResponse($code));
    }
    public static function errorResponse(int $code,$debugInfo = null){
        return response()->json(new IQResponse($code,null,$debugInfo),$code);
    }
    public static function response(int $code, mixed $data = null){
        return response()->json(new IQResponse($code,$data),$code);
    }
}
?>
