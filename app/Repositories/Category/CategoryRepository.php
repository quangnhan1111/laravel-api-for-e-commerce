<?php
namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;


class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    protected $model;

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }


    public function getAll()
    {
        return $this->model::all();
    }
}
