<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Services\BrandService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    private BrandService $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }//end __construct()

    public function getBrands()
    {
        $brands = $this->brandService->getAll();
        return $this->response("successfully", $brands, 200, true);
    }

    public function index()
    {
        $user=Auth::user();
        if($this->authorize('viewAny', $user)) {
            $brands = $this->brandService->index();
            return $this->response("successfully", $brands, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


    public function store(BrandRequest $request)
    {
        $user=Auth::user();
        if($this->authorize('create', $user)) {
            $brand = $this->brandService->store($request);
            return $this->response("successfully", $brand, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


    public function show($id)
    {
        $brand = $this->brandService->show($id);
        return $this->response("successfully", $brand, 200, true);
    }


    public function update(BrandRequest $request, $id)
    {
        $user=Auth::user();
        if($this->authorize('update', $user)) {
            $brand = $this->brandService->update($request, $id);
            return $this->response("successfully", $brand, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


    public function destroy($id)
    {
        $user=Auth::user();
        if($this->authorize('delete', $user)) {
            $brand = $this->brandService->destroy($id);
            return $this->response("successfully", $brand, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }
}
