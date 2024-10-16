<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{

    protected $model;


    public function __construct()
    {
        $this->setModel();

    }//end __construct()


    /**
     * Get model
     *
     * @return string
     */
    abstract public function getModel();


    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );

    }//end setModel()


    /**
     * Get All
     *
     * @return Collection|static[]
     */
    public function getAll()
    {
        return $this->model->all();

    }//end getAll()


    /**
     * Get data with pagination
     *
     * @return mixed
     */
    public function getWithPagination($paginate)
    {
        return $this->model->paginate($paginate);

    }//end getWithPagination()


    /**
     * Get one
     *
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;

    }//end find()


    /**
     * Check if model exists
     *
     * @return mixed
     */
    public function exists($id)
    {
        return $this->model->exists($id);

    }//end exists()


    /**
     * Get one
     *
     * @return mixed
     */
    public function findOrFail($id)
    {
        $result = $this->model->findOrFail($id);

        return $result;

    }//end findOrFail()


    /**
     * Get first
     *
     * @return mixed
     */
    public function firstOrFail()
    {
        $result = $this->model->firstOrFail();

        return $result;

    }//end firstOrFail()


    /**
     * Query filter
     *
     * @return mixed
     */
    public function filter($where)
    {
        $result = $this->model->where($where)->get();

        return $result;

    }//end filter()


    /**
     * Create
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function create(array $attributes)
    {
        try {
            return $this->model->newQuery()->create($attributes);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

    }//end create()


    /**
     * Create
     *
     * @return mixed
     */
    public function insert(array $attributes)
    {
        try {
            return $this->model->insert($attributes);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

    }//end insert()


    /**
     * Update
     *
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->model->newQuery()->findOrFail($id);
        $result->update($attributes);

    }//end update()


    /**
     * Delete
     *
     * @return bool
     */
    public function delete($id)
    {
        try {
            $result = $this->findOrFail($id);
            $result->delete();
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

    }//end delete()


    /**
     * Create all
     *
     * @return mixed
     */
    public function createAll(array $attributes)
    {
        return $this->model->insert($attributes);

    }//end createAll()


    /**
     * Count all record
     *
     * @return mixed
     */
    public function countAll()
    {
        return $this->model->count();

    }//end countAll()


    public function newQuery()
    {
        return clone $this->model;

    }//end newQuery()


    public function whereIn($field, $arr)
    {
        $result = $this->model->whereIn($field, $arr)->get();

        return $result;

    }//end whereIn()


    public function updateOrCreate($where, $attributes)
    {
        try {
            return $this->model->updateOrCreate($where, $attributes);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

    }//end updateOrCreate()


}//end class
