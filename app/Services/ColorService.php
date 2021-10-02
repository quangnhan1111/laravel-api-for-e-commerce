<?php

namespace App\Services;
use App\Http\Requests\ColorRequest;
use App\Http\Requests\UserRequest;
use App\Models\Color;
use App\Repositories\Color\ColorRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColorService
{
    private ColorRepositoryInterface $colorRepositoryInterface;
    public function __construct(ColorRepositoryInterface $colorRepositoryInterface)
    {
        $this->colorRepositoryInterface = $colorRepositoryInterface;
    }

    public function getColorByGenderAndSize($gender_id, $size, $nameProduct)
    {
        $colors = $this->colorRepositoryInterface->getColorByGenderAndSize($gender_id, $size, $nameProduct);
        return $colors;
    }

    public function getColorByGenderAndSizeAndColor($color_id, $gender_id, $size, $nameProduct)
    {
        $colors = $this->colorRepositoryInterface->getColorByGenderAndSizeAndColor($color_id, $gender_id, $size, $nameProduct);
        return $colors;
    }

    public function getAll()
    {
        $colors = $this->colorRepositoryInterface->getAll();
        return $colors;
    }

    public function index()
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee() ) {
            $colors = $this->colorRepositoryInterface->index();
            return $colors;
        }
        return 'Unauthorized';
    }

    public function store(ColorRequest $request)
    {
        $inputs = $request->all();
        $user=Auth::user();
        $color = new Color();
        if($user->isAdmin() || $user->isEmployee()) {
            $result = $this->colorRepositoryInterface->store($color, $inputs);;
            return $result;
        }
        return 'Unauthorized';
    }

    public function show(int $id)
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee()) {
            $color = $this->colorRepositoryInterface->show($id);
            return $color;
        }
        return 'Unauthorized';
    }

    public function update(ColorRequest $request,int $id)
    {
        $inputs = $request->all();
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee()) {
            $colorUpdate=Color::query()->findOrFail($id);
            $result = $this->colorRepositoryInterface->update($colorUpdate, $inputs);
            return $result;
        }
        return 'Unauthorized';
    }


    public function destroy(int $id)
    {
        $user=Auth::user();
        if($user->isAdmin() || $user->isEmployee()) {
            $colorDestroy = $this->colorRepositoryInterface->destroy($id);
            return $colorDestroy;
        }
        return 'Unauthorized';
    }

}
