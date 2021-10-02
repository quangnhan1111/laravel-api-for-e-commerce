<?php

namespace App\Services;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryService
{
    private CategoryRepositoryInterface $categoryRepositoryInterface;
    public function __construct(CategoryRepositoryInterface $categoryRepositoryInterface)
    {
        $this->categoryRepositoryInterface = $categoryRepositoryInterface;
    }

    public function getAll()
    {
        $categorys = $this->categoryRepositoryInterface->getAll();
        return $categorys;
    }

    public function index()
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee() ) {
            $categorys = $this->categoryRepositoryInterface->index();
//            $categorys = Category::query()->orderBy('id', 'desc')->paginate(10);
            return $categorys;
        }
        return 'Unauthorized';
    }

    public function store(CategoryRequest $request)
    {
        $inputs = $request->all();
        $user=Auth::user();
        $category = new Category();
        if($user->isAdmin() || $user->isEmployee()) {
            $result = $this->categoryRepositoryInterface->store($category, $inputs);;
            return $result;
        }
        return 'Unauthorized';
    }

    public function show(int $id)
    {
        $category = $this->categoryRepositoryInterface->show($id);
        return $category;
    }

    public function update(CategoryRequest $request,int $id)
    {
        $inputs = $request->all();
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee()) {
            $categoryUpdate=Category::query()->findOrFail($id);
            $result = $this->categoryRepositoryInterface->update($categoryUpdate, $inputs);
            return $result;
        }
        return 'Unauthorized';
    }


    public function destroy(int $id)
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee()) {
            $categoryDestroy = $this->categoryRepositoryInterface->destroy($id);
            return $categoryDestroy;
        }
        return 'Unauthorized';
    }

}
