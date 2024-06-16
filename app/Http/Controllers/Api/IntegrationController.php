<?php

namespace App\Http\Controllers\Api;



use App\Services\Api\IntegrationService;

class IntegrationController extends ApiController
{
    public function __construct(IntegrationService $service)
    {
        $this->service = $service;
    }

}
