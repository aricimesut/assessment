<?php

namespace App\Repository;

use App\Http\Resources\Api\IntegrationResources;
use App\Models\Integration;

class IntegrationRepository extends BaseRepository
{
    public function __construct(Integration $model)
    {
        $this->model = $model;
        $this->resource = IntegrationResources::class;
    }
}
