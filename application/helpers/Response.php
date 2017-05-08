<?php
/**
 * Created by PhpStorm.
 * User: Manuela Duque M
 * Date: 19/04/2017
 * Time: 2:43 PM
 */

class Response {

    public static function okResponse($data){

        $response = new stdClass();
        $response->code = OK_RESPONSE_CODE;
        $response->success = true;
        $response->data = $data;
        
        return json_encode($response, JSON_UNESCAPED_UNICODE);

    }

    public static function notFoundResponse(){

        $response = new stdClass();
        $response->code = NOT_FOUND_RESPONSE_CODE;
        $response->success = false;
        $response->data = null;

        return json_encode($response, JSON_UNESCAPED_UNICODE);

    }

    public static function tokenExpiredResponse(){
        
        $response = new stdClass();
        $response->code = OK_RESPONSE_CODE;
        $response->success = false;

        $error = new stdClass();
        $error->expired = true;
        $error->name = "TokenExpiredError";
        $error->description = "The provided token has expired";

        $response->data = $error;
        return json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    public static function okUpdateResponse(){

        $response = new stdClass();
        $response->code = OK_RESPONSE_CODE;
        $response->success = true;
        $response->message = 'Updated succesfully';

        return json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    public static function okInsertResponse(){

        $response = new stdClass();
        $response->code = OK_RESPONSE_CODE;
        $response->success = true;
        $response->message = 'Created succesfully';

        return json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    public static function internalServerResponse(){

        $response = new stdClass();
        $response->code = INTERNAL_ERROR_RESPONSE_CODE;
        $response->success = false;

        $error = new stdClass();
        $error->name = 'InternalServerError';
        $error->description = 'The server has an unexpected error, please try again later';

        $response->error = $error;

        return json_encode($response, JSON_UNESCAPED_UNICODE);

    }

    public static function dataMissingResponse(){

        $response = new stdClass();
        $response->code = BAD_REQUEST_RESPONSE_CODE;
        $response->success = false;

        $error = new stdClass();
        $error->name = 'ObjectNotFound';
        $error->description = 'Server was expecting a missing parameter, check your request parameters';

        $response->error = $error;

        return json_encode($response, JSON_UNESCAPED_UNICODE);

    }



}