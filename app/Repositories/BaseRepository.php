<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return $this->model::query()->orderBy('id', 'desc')->paginate(10);
    }

    public function store($objUpdate, $inputs)
    {
        $objUpdate->name = $inputs['name'];
        $objUpdate->save();
        return $objUpdate;
    }

    public function update($objUpdate, $inputs)
    {
        $objUpdate->name = $inputs['name'];
        $objUpdate->save();
        return $objUpdate;
    }

    public function show( $id)
    {
        return $this->model::query()->find($id);;
    }

    public function destroy($id)
    {
        $objDestroy=$this->model::query()->findOrFail($id);
        $objDestroy->delete();
        return $objDestroy;
    }
}
