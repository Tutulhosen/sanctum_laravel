<?php

namespace App\Traits;

Trait HttpResponses{

/**
 * create a success method
 */
protected function success($data, $message=null, $code=200){

    return response()->json([
        'status'        =>'Request was successfull',
        'message'       =>$message,
        'data'          =>$data
    ], $code);
   
}

/**
 * create error method
 */

 protected function error($data, $message=null, $code){

    return response()->json([
        'status'        =>'Some error has been occered...',
        'message'       =>$message,
        'data'          =>$data
    ], $code);


 }




}















?>