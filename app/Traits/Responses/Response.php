<?php

namespace App\Traits\Responses;

trait Response{
    protected $response = [
        "error" => false,
        "msgs" => [],
        "data" => []
    ];
}
