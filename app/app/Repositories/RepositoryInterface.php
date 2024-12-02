<?php

namespace App\Repositories;

interface RepositoryInterface
{

    /**
     * @param array $inputs
     * @return mixed
     */
    public function store(array $inputs);


    /**
     * @param $id
     * @param array $inputs
     * @return mixed
     */
    public function update($id, array $inputs);

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool;


    /**
     * @param $id
     * @return bool
     */
    public function restore($id): bool;

}
