<?php


use App\Http\Utility\ApiResponseUtility;
function api($success, $code, $message)
{
    return new ApiResponseUtility($success, $code, $message);
}
function api_exception(Exception $e, $code = null, $message = null)
{
    return api(false, $code ?? $e->getCode(), $message ?? $e->getMessage())
        ->add('error', [
            'line' => $e->getLine(),
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'trace' => $e->getTrace(),
        ])->get();
}

define('FL', strtoupper('en'));
define('SL', strtoupper('ar'));

