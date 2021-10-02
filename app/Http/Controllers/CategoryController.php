<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }//end __construct()

    public function getCategories()
    {
        $categories = $this->categoryService->getAll();
        return $this->response("successfully", $categories, 200, true);
    }



    public function index()
    {
        $user=Auth::user();
        if($this->authorize('viewAny', $user)) {
            $categories = $this->categoryService->index();
            return $this->response("successfully", $categories, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }

    public function store(CategoryRequest $request)
    {
        $user=Auth::user();
        if($this->authorize('create', $user)) {
            $category = $this->categoryService->store($request);
            return $this->response("successfully", $category, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


    public function show($id)
    {
        $category = $this->categoryService->show($id);
        return $this->response("successfully", $category, 200, true);
    }

    public function update(CategoryRequest $request, $id)
    {
        $user=Auth::user();
        if($this->authorize('update', $user)) {
            $category = $this->categoryService->update($request, $id);
            return $this->response("successfully", $category, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }


    public function destroy($id)
    {
        $user=Auth::user();
        if($this->authorize('delete', $user)) {
            $category = $this->categoryService->destroy($id);
            return $this->response("successfully", $category, 200, true);
        }
        return $this->response("fail", null, 422, false);
    }
}
