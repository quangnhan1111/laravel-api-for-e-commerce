<?php

namespace App\Services;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    private ProductRepositoryInterface $productRepositoryInterface;
    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    public function getProductBySearch($key)
    {
        $products = $this->productRepositoryInterface->getProductBySearch($key);
        return $products;
    }

    public function getBestProduct()
    {
        $products = $this->productRepositoryInterface->getBestProduct();
        return $products;
    }

    public function getNewProduct()
    {
        $products = $this->productRepositoryInterface->getNewProduct();
        return $products;
    }

    public function getRelatedProductByBrand($id)
    {
        $products = $this->productRepositoryInterface->getRelatedProductByBrand($id);
        return $products;
    }

    public function getRelatedProductByCate($id)
    {

        $products = $this->productRepositoryInterface->getRelatedProductByCate($id);
        return $products;
    }

    public function index()
    {
        $products = $this->productRepositoryInterface->index();
        return $products;
    }

    public function indexForAdmin()
    {
        $products = $this->productRepositoryInterface->indexForAdmin();
        return $products;
    }

    public function store(ProductRequest $request)
    {
        $inputs = $request->all();
        $user=Auth::user();
        $product = new Product();
        if($user->isAdmin() || $user->isEmployee()) {
            $result = $this->productRepositoryInterface->store($product, $inputs);;
            return $result;
        }
        return 'Unauthorized';
    }

    public function show($id)
    {
        $product = $this->productRepositoryInterface->show($id);
        return $product;
    }

    public function showForAdmin($id)
    {
        $product = $this->productRepositoryInterface->showForAdmin($id);
        return $product;
    }

    public function update(ProductRequest $request,int $id)
    {
        $inputs = $request->all();
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee()) {
            $productUpdate=Product::query()->findOrFail($id);
            $result = $this->productRepositoryInterface->update($productUpdate, $inputs);
            return $result;
        }
        return 'Unauthorized';
    }


    public function destroy(int $id)
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee()) {
            $productDestroy = $this->productRepositoryInterface->destroy($id);
            return $productDestroy;
        }
        return 'Unauthorized';
    }

}
