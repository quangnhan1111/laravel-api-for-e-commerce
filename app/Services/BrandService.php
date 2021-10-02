<?php

namespace App\Services;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Repositories\Brand\BrandRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class BrandService
{
    private BrandRepositoryInterface $brandRepositoryInterface;
    public function __construct(BrandRepositoryInterface $brandRepositoryInterface)
    {
        $this->brandRepositoryInterface = $brandRepositoryInterface;
    }

    public function getAll()
    {
        $brands = $this->brandRepositoryInterface->getAll();
        return $brands;
    }

        public function index()
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee() ) {
            $brands = $this->brandRepositoryInterface->index();
//            $brands = Brand::query()->orderBy('id', 'desc')->paginate(10);
            return $brands;
        }
        return 'Unauthorized';
    }

    public function store(BrandRequest $request)
    {
        $inputs = $request->all();
        $user=Auth::user();
        $brand = new Brand();
        if($user->isAdmin() || $user->isEmployee()) {
            $result = $this->brandRepositoryInterface->store($brand, $inputs);
//            $brandUpdate->name = $inputs['name'];
//            $brandUpdate->save();
            return $result;
        }
        return 'Unauthorized';
    }

    public function show(int $id)
    {
        $brand = $this->brandRepositoryInterface->show($id);
        return $brand;
    }

    public function update(BrandRequest $request,int $id)
    {
        $inputs = $request->all();
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee()) {
            $brandUpdate=Brand::query()->findOrFail($id);
            $result = $this->brandRepositoryInterface->update($brandUpdate, $inputs);
            return $result;
        }
        return 'Unauthorized';
    }


    public function destroy(int $id)
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee()) {
            $brandDestroy = $this->brandRepositoryInterface->destroy($id);
//            $brandDestroy=Brand::query()->findOrFail($id);
            return $brandDestroy;
        }
        return 'Unauthorized';
    }

}
