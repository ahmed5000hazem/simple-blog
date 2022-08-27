<?php

namespace App\Traits\Responses;
use App\Traits\Responses\Response;

trait ErrorResponse{
    use Response;
    
    public function ErrorResponse($data = [], $msgs = []){
        if (!is_array($data)) $data = [$data];
        if (!is_array($msgs)) $msgs = [$msgs];
        
        $result = $this->response;
        
        $result["error"] = true;
        $result['data'] = $data;
        $result['msgs'] = $msgs;

        return $result;
    }
}
