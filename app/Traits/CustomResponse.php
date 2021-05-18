<?php

namespace App\Traits;

use Illuminate\Support\Facades\Lang;

trait CustomResponse {
  protected $options = JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE;
  protected $lang_uri = 'api';

  protected function respond($data, $message_uri = null, $http_code = 200){
    return response()->json([
      'success' => true,
      'status' => $http_code,
      'data' => $data,
      'message' => $message_uri ? Lang::get($this->lang_uri . '.' . $message_uri) : ''
    ], $http_code, [], $this->options);
  }

  protected function respondWithMessage($message_uri, $http_code = 200, $success = true){
    return response()->json([
      'success' => $success,
      'status' => $http_code,
      'message' => Lang::get($this->lang_uri . '.' . $message_uri)
    ], $http_code, [], $this->options);
  }
  
  protected function respondWithValidationError($error_uri, $http_code){
    $messages = [];

    foreach($error_uri as $key => $val){
      $messages[$key] = $val[0];
    }
        
    return response()->json(
      [
        'success' => false,
        'status' => $http_code,
        'errors' => $messages
      ], $http_code, [], $this->options
    );
  }
}