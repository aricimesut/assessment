<?php

namespace App\Repository;

use App\Http\Resources\Api\PaginateCollection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected Model $model;

    protected string $resource;

    public function store(array $data): array
    {
        $record = $this->model->create($data);

        return [
            'message' => 'Kayıt başarılı',
            'status' => 200,
            'data' => $record
        ];
    }

    public function index(array $data): array
    {
        $records = $this->model->paginate($data['per_page'] ?? 10);
        return [
            'message' => 'Records found',
            'status' => 200,
            'data' => json_encode(new PaginateCollection($records, $this->resource))
        ];
    }

    public function show(int $id): array
    {
       $record = $this->model->findOrFail($id);

         return [
              'message' => 'Record found',
              'status' => 200,
              'data' => $record
         ];
    }

    public function update(int $id, array $data): array
    {
        $model = $this->model->findOrFail($id);
        $model->update($data);

        return [
            'message' => 'Record updated successfully',
            'status' => 200,
            'data' => $model
        ];
    }

    public function destroy(int $id): bool
    {
        return $this->model->destroy($id);
    }
}
