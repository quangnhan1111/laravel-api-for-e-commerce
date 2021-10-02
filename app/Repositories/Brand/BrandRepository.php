<?php
namespace App\Repositories\Brand;

use App\Models\Brand;
use App\Repositories\BaseRepository;


class BrandRepository extends BaseRepository implements BrandRepositoryInterface
{

    protected $model;

    public function __construct(Brand $model)
    {
        parent::__construct($model);
    }


    public function getAll()
    {
        return $this->model::all();
    }
}
