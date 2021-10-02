<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }//end __construct()

    public function getProductBySearch($key){
        $products = $this->productService->getProductBySearch($key);
        return $this->response("successfully", $products, 200, true);
    }

    public function getNewProduct(){
        $products = $this->productService->getNewProduct();
        return $this->response("successfully", $products, 200, true);
    }

    public function getBestProduct(){
        $products = $this->productService->getBestProduct();
        return $this->response("successfully", $products, 200, true);
    }

    public function getRelatedProductByBrand($id){
        $products = $this->productService->getRelatedProductByBrand($id);
        return $this->response("successfully", $products, 200, true);
    }

    public function getRelatedProductByCate($id){
        $products = $this->productService->getRelatedProductByCate($id);
        return $this->response("successfully", $products, 200, true);
    }

    public function index()
    {
        $products = $this->productService->index();
        return $this->response("successfully", $products, 200, true);
    }

    public function indexForAdmin()
    {
        $products = $this->productService->indexForAdmin();
        return $this->response("successfully", $products, 200, true);
    }



    public function store(ProductRequest $request)
    {
        $user=Auth::user();
        if($this->authorize('create', $user)) {
            $product = $this->productService->store($request);
            return $this->response("successfully", $product, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


    public function show($id)
    {
        $product = $this->productService->show($id);
        return $this->response("successfully", $product, 200, true);
    }

    public function showForAdmin($id)
    {
        $product = $this->productService->showForAdmin($id);
        return $this->response("successfully", $product, 200, true);
    }

    public function update(ProductRequest $request, $id)
    {
        $user=Auth::user();
        if($this->authorize('update', $user)) {
            $product = $this->productService->update($request, $id);
            return $this->response("successfully", $product, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


    public function destroy($id)
    {
        $user=Auth::user();
        if($this->authorize('delete', $user)) {
            $product = $this->productService->destroy($id);
            return $this->response("successfully", $product, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }
}
