<?php
namespace App\Repositories\Color;

use App\Models\Color;
use App\Repositories\BaseRepository;
use App\Utils\Helper;
use Illuminate\Support\Facades\DB;


class ColorRepository extends BaseRepository implements ColorRepositoryInterface
{

    protected $model;

    public function __construct(Color $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        return $this->model::all();
    }


    public function getColorByGenderAndSize($gender_id, $size, $nameProduct)
    {
        $colors = DB::table('colors')
            ->join('products','products.color_id', 'colors.id')
            ->join('genders','products.gender_id', 'genders.id')
            ->selectRaw('colors.id,colors.name')
            ->whereRaw('products.deleted_at is null and colors.deleted_at is null and genders.deleted_at is null')
            ->where('products.name','=',$nameProduct)
            ->where('products.gender_id','=',$gender_id)
            ->where('products.name_size','=',$size)
            ->groupBy('colors.name')
            ->get();
//        $helper = new Helper();
        return $colors;
    }

    public function getColorByGenderAndSizeAndColor($color_id, $gender_id, $size, $nameProduct)
    {
        $product = DB::table('products')
            ->join('colors','products.color_id', 'colors.id')
            ->join('genders','products.gender_id', 'genders.id')
            ->selectRaw('products.id,products.name')
            ->whereRaw('products.deleted_at is null and colors.deleted_at is null and genders.deleted_at is null')
            ->where('products.name','=',$nameProduct)
            ->where('products.gender_id','=',$gender_id)
            ->where('products.name_size','=',$size)
            ->where('products.color_id','=',$color_id)
            ->get();
//        $helper = new Helper();
        return $product;
    }
}
