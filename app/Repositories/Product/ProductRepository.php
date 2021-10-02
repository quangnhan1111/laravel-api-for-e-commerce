<?php
namespace App\Repositories\Product;
use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Utils\Helper;
use Illuminate\Support\Facades\DB;


class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    protected $model;

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }


    public function getProductBySearch($key)
    {
//        $products = Product::query()->where('name','like','%'.$key.'%')->get();

        $products = DB::table('products')
            ->join('categories','products.cate_id', 'categories.id')
//            ->join('genders','products.gender_id', 'genders.id')
//            ->join('colors','products.color_id', 'colors.id')
            ->join('images','products.image_id', 'images.id')
            ->join('brands','products.brand_id', 'brands.id')
            ->selectRaw('products.id,products.name,products.price,sum(products.number) as totalNumber,

            products.des,brands.name AS Name_Brand,categories.name AS Name_Category,
            images.name AS Name_Image,images.link,
            products.created_at')
            ->whereRaw('products.deleted_at is null')
            ->where('products.name','like','%'.$key.'%')
            ->groupBy('products.name')
            ->get();
        $helper = new Helper();
        return $helper->paginate($products);
    }

    public function getBestProduct()
    {
        $newProducts = DB::table('products')
            ->join('categories','products.cate_id', 'categories.id')
//            ->join('genders','products.gender_id', 'genders.id')
//            ->join('colors','products.color_id', 'colors.id')
            ->join('images','products.image_id', 'images.id')
            ->join('invoice_detail','invoice_detail.product_id', 'products.id')
            ->leftJoin('reviews','products.id', 'reviews.product_id')
            ->join('brands','products.brand_id', 'brands.id')
            ->selectRaw('products.id,products.name,products.price,sum(products.number) as totalNumber,

            products.des,brands.name AS Name_Brand,categories.name AS Name_Category,
            images.name AS Name_Image,images.link,
            avg(reviews.number_of_star) as avgStar, products.created_at, sum(invoice_detail.number) AS NumberSOLDOUT')
            ->whereRaw('products.deleted_at is null')
            ->groupBy('products.name')
            ->orderBy('NumberSOLDOUT', 'DESC')
            ->take(4)
            ->get();
        return $newProducts;
    }

    public function getNewProduct()
    {
        $newProducts = DB::table('products')
            ->join('categories','products.cate_id', 'categories.id')
//            ->join('genders','products.gender_id', 'genders.id')
//            ->join('colors','products.color_id', 'colors.id')
            ->join('images','products.image_id', 'images.id')
            ->leftJoin('reviews','products.id', 'reviews.product_id')
            ->join('brands','products.brand_id', 'brands.id')
            ->selectRaw('products.id,products.name,products.price,sum(products.number) as totalNumber,

            products.des,brands.name AS Name_Brand,categories.name AS Name_Category,
            images.name AS Name_Image,images.link,
            avg(reviews.number_of_star) as avgStar, products.created_at')
            ->whereRaw('products.deleted_at is null')
            ->groupBy('products.name')
            ->orderBy('products.created_at', 'ASC')
            ->take(4)->get();
        return $newProducts;
    }

    public function getRelatedProductByBrand($id)
    {
//        $products = Product::whereHas('brand', function($brand) use ($id) {
//            $brand->where('id', '=',$id);
//        })->orderBy('id', 'desc')->paginate(10);
//        return $products;

        $products = DB::table('products')
            ->join('categories','products.cate_id', 'categories.id')


            ->join('images','products.image_id', 'images.id')
            ->leftJoin('reviews','products.id', 'reviews.product_id')
            ->join('brands','products.brand_id', 'brands.id')
            ->selectRaw('products.id,products.name,products.price,sum(products.number) as totalNumber,

            products.des,brands.name AS Name_Brand,categories.name AS Name_Category,
            images.name AS Name_Image,images.link,
            avg(reviews.number_of_star) as avgStar')
            ->where('brands.id',$id)
            ->whereRaw('products.deleted_at is null')
            ->groupBy('products.name')
            ->orderBy('products.id', 'ASC')
            ->paginate(10);
        return $products;
    }

    public function getRelatedProductByCate($id)
    {
//        $products = Product::whereHas('categories', function($category) use ($id) {
//            $category->where('id', '=',$id);
//        })->orderBy('id', 'desc')->paginate(10);

//        $products = DB::table('products')
//            ->select('products.*')
//            ->join('categories','products.cate_id', 'categories.id')
//            ->where('categories.id',$id)
//            ->orderBy('products.id', 'DESC')
//            ->paginate(10);

        $products = DB::table('products')
            ->join('categories','products.cate_id', 'categories.id')

            ->join('images','products.image_id', 'images.id')
            ->leftJoin('reviews','products.id', 'reviews.product_id')
            ->join('brands','products.brand_id', 'brands.id')
            ->selectRaw('products.id,products.name,products.price,sum(products.number) as totalNumber,

            products.des,brands.name AS Name_Brand,categories.name AS Name_Category,
            images.name AS Name_Image,images.link,
            avg(reviews.number_of_star) as avgStar')
            ->where('categories.id',$id)
            ->whereRaw('products.deleted_at is null')
            ->groupBy('products.name')
            ->orderBy('products.id', 'ASC')
            ->paginate(10);
        return $products;
    }

    public function index()
    {
//        $results = DB::select(DB::raw("SELECT products.id,products.name,products.price,products.number,
//        products.name_size,products.des,brands.name AS Name_Brand,categories.name AS Name_Category,
//        genders.name AS Name_Gender, images.name AS Name_Image,images.link, colors.name AS Name_Color,
//        avg(reviews.number_of_star) as avgStar
//        from products inner join brands on brands.id = products.brand_id
//        inner join categories on categories.id = products.cate_id
//        inner join genders on genders.id = products.gender_id
//        inner join colors on colors.id = products.color_id
//        inner join images on images.id = products.image_id
//        left join reviews on reviews.product_id = products.id group by products.id
//       "));
        $products = DB::table('products')
            ->join('categories','products.cate_id', 'categories.id')


            ->join('images','products.image_id', 'images.id')
            ->leftJoin('reviews','products.id', 'reviews.product_id')
            ->join('brands','products.brand_id', 'brands.id')
            ->selectRaw('products.id,products.name,products.price,sum(products.number) as totalNumber,

            products.des,products.brand_id, brands.name AS Name_Brand,categories.name AS Name_Category, products.cate_id,
            products.image_id, images.name AS Name_Image,images.link,
            avg(reviews.number_of_star) as avgStar')
            ->whereRaw('products.deleted_at IS NULL')
            ->groupBy('products.name')
            ->orderBy('products.id', 'ASC')
            ->paginate(10);
        return $products;
    }

    public function indexForAdmin()
    {
//        $results = DB::select(DB::raw("SELECT products.id,products.name,products.price,products.number,
//        products.name_size,products.des,brands.name AS Name_Brand,categories.name AS Name_Category,
//        genders.name AS Name_Gender, images.name AS Name_Image,images.link, colors.name AS Name_Color,
//        avg(reviews.number_of_star) as avgStar
//        from products inner join brands on brands.id = products.brand_id
//        inner join categories on categories.id = products.cate_id
//        inner join genders on genders.id = products.gender_id
//        inner join colors on colors.id = products.color_id
//        inner join images on images.id = products.image_id
//        left join reviews on reviews.product_id = products.id group by products.id
//       "));
        $products = DB::table('products')
            ->join('categories','products.cate_id', 'categories.id')
            ->join('genders','products.gender_id', 'genders.id')
            ->join('colors','products.color_id', 'colors.id')
            ->join('images','products.image_id', 'images.id')
            ->leftJoin('reviews','products.id', 'reviews.product_id')
            ->join('brands','products.brand_id', 'brands.id')
            ->selectRaw('products.id,products.name,products.price,products.number,
            products.name_size, genders.name AS Name_Gender, colors.name AS Name_Color,
            products.des,products.brand_id, brands.name AS Name_Brand,categories.name AS Name_Category, products.cate_id,
            products.image_id, images.name AS Name_Image,images.link, products.color_id, products.gender_id,
            avg(reviews.number_of_star) as avgStar')
            ->whereRaw('products.deleted_at IS NULL')
            ->groupBy('products.id')
            ->orderBy('products.id', 'ASC')
            ->paginate(10);
        return $products;
    }

    public function show( $id)
    {
        $results = DB::select(DB::raw("SELECT products.name,products.price,sum(products.number) as totalNumber,

        products.des,brands.name AS Name_Brand,categories.name AS Name_Category,
        products.brand_id,products.cate_id,products.image_id,
        images.name AS Name_Image,images.link,
        avg(reviews.number_of_star) as avgStar
        from products inner join brands on brands.id = products.brand_id
        inner join categories on categories.id = products.cate_id


        inner join images on images.id = products.image_id
        left join reviews on reviews.product_id = products.id Where products.name = :id group by products.name "),array('id' => $id));
        return $results;

//        $products = DB::table('products')
//            ->join('categories','products.cate_id', 'categories.id')
//            ->join('genders','products.gender_id', 'genders.id')
//            ->join('colors','products.color_id', 'colors.id')
//            ->join('images','products.image_id', 'images.id')
//            ->leftJoin('reviews','products.id', 'reviews.product_id')
//            ->join('brands','products.brand_id', 'brands.id')
//            ->selectRaw('products.id,products.name,products.price,products.number,
//            products.name_size,products.des,brands.name AS Name_Brand,categories.name AS Name_Category,
//            genders.name AS Name_Gender, images.name AS Name_Image,images.link, colors.name AS Name_Color,
//            avg(reviews.number_of_star) as avgStar')
//            ->where('products.id',$id)
//            ->groupBy('products.id')
//            ->orderBy('products.id', 'ASC')
//            ->paginate(10);
//        return $products;
    }

    public function showForAdmin($id) {
        $results = DB::select(DB::raw("SELECT products.name,products.price,products.number,
        products.name_size, genders.name AS Name_Gender, colors.name AS Name_Color,
        products.des,brands.name AS Name_Brand,categories.name AS Name_Category,
        products.brand_id,products.cate_id,products.image_id, products.color_id, products.gender_id,
        images.name AS Name_Image,images.link,
        avg(reviews.number_of_star) as avgStar
        from products inner join brands on brands.id = products.brand_id
        inner join categories on categories.id = products.cate_id
        inner join genders on genders.id = products.gender_id
        inner join colors on colors.id = products.color_id
        inner join images on images.id = products.image_id
        left join reviews on reviews.product_id = products.id Where products.id = :id group by products.name "),array('id' => $id));
        return $results;
    }


    public function store($objUpdate, $inputs)
    {
        $objUpdate->name = $inputs['name'];
        $objUpdate->price = $inputs['price'];
        $objUpdate->name_size = $inputs['name_size'];
        $objUpdate->number = $inputs['number'];
        $objUpdate->des = $inputs['des'];
        $objUpdate->gender_id   = $inputs['gender_id'];
        $objUpdate->cate_id   = $inputs['cate_id'];
        $objUpdate->brand_id   = $inputs['brand_id'];
        $objUpdate->image_id   = $inputs['image_id'];
        $objUpdate->color_id  = $inputs['color_id'];
        $objUpdate->save();
        return $objUpdate;
    }

    public function update($objUpdate, $inputs)
    {
        $objUpdate->name = $inputs['name'];
        $objUpdate->price = $inputs['price'];
        $objUpdate->name_size = $inputs['name_size'];
        $objUpdate->number = $inputs['number'];
        $objUpdate->des = $inputs['des'];
        $objUpdate->gender_id   = $inputs['gender_id'];
        $objUpdate->cate_id   = $inputs['cate_id'];
        $objUpdate->brand_id   = $inputs['brand_id'];
        $objUpdate->image_id   = $inputs['image_id'];
        $objUpdate->color_id  = $inputs['color_id'];
        $objUpdate->save();
        return $objUpdate;
    }
}
