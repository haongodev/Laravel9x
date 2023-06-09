<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    /**
     * Create a new repository instance.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }



    /**
     * @param array $inputs
     * @return mixed
     */
    public function store(array $inputs)
    {
        try {
            return $this->model->create($inputs);
        } catch (QueryException $exc) {
            Log::error($exc->getMessage(), $exc->getTrace());
            return null;
        }
    }


    /**
     * @param $id
     * @param array $inputs
     * @return mixed
     */
    public function update($id, array $inputs)
    {
        try {
            $model = $this->getById($id);
            if ($model) {
                $model->update($inputs);
                return $model;
            } else {
                return null;
            }
        } catch (QueryException $exc) {
            Log::error($exc->getMessage(), $exc->getTrace());
            return null;
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        try {
            $data = $this->getById($id);
            return $data ? $data->delete() : false;
        } catch (QueryException $exc) {
            Log::error($exc->getMessage(), $exc->getTrace());
            return false;
        }
    }

    /**
     * @return bool
     */
    public function destroyAll(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $exc) {
            Log::error($exc->getMessage(), $exc->getTrace());
            return false;
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function forceDelete($id): bool
    {
        try {
            $data = $this->getById($id, [], true);
            return $data ? $data->forceDelete() : false;
        } catch (QueryException $exc) {
            Log::error($exc->getMessage(), $exc->getTrace());
            return false;
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function restore($id): bool
    {
        try {
            $data = $this->getById($id, [], true);
            return $data ? $data->restore() : false;
        } catch (QueryException $exc) {
            Log::error($exc->getMessage(), $exc->getTrace());
            return false;
        }
    }

}
