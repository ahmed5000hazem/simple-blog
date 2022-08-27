<?php

namespace App\Traits\Responses;
use App\Traits\Responses\Response;

trait SuccessResponse {
    use Response;
    
    public function SuccessResponse($data = [], $msgs = []){
        // convert the data and message to array if is not
        if (!is_array($data)) $data = [$data];
        if (!is_array($msgs)) $msgs = [$msgs];

        $result = $this->response;
        
        $result["error"] = false;
        $result['data'] = $data;
        $result['msgs'] = $msgs;

        return $result;
    }
}