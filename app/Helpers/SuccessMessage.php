<?php
namespace App\Helpers;
 class SuccessMessage {

    public function customResponse($model, $action, $httpCode){ // user is created 201
        return response()->json([$model.'is'.$action], $httpCode);
    }
} 
?>