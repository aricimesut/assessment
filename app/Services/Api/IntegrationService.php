<?php

namespace App\Services\Api;

use App\Enum\MarketPlace;
use App\Repository\IntegrationRepository;
use Illuminate\Support\Facades\Validator;

class IntegrationService extends ApiService
{

    public function __construct(IntegrationRepository $repository)
    {
        $this->repository = $repository;
        $this->rules = [
            'marketplace' => 'required|in:'.implode(',',array_column(MarketPlace::cases(), 'value')),
            'username' => 'nullable',
            'password' => 'nullable',
        ];
        $this->niceNames = [
            'marketplace' => 'Marketplace',
            'username' => 'Username',
            'password' => 'Password',
        ];
    }

}
