<?php

namespace App\Repositories\Product;
use App\Repositories\BaseRepositoryInterface;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function getRelatedProductByBrand($id);

    public function getRelatedProductByCate($id);

    public function getBestProduct();

    public function getNewProduct();

    public function getProductBySearch($key);

    public function indexForAdmin();

    public function showForAdmin($id);

}
