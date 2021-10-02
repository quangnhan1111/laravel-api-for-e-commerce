<?php
namespace App\Repositories\Review;
use App\Models\Review;
use App\Repositories\BaseRepository;
use App\Utils\Helper;
use Illuminate\Support\Facades\DB;


class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{

    protected $model;

    public function __construct(Review $model)
    {
        parent::__construct($model);
    }

    public function getGoodReview()
    {
        $goodReviews = Review::query()->orderBy("number_of_star","desc")->take(4)->get();
        return $goodReviews;
    }

    public function getAllReviewByIdProduct($nameProduct)
    {
        $results = DB::select(DB::raw("SELECT reviews.id, reviews.number_of_star, reviews.content, products.name as ProductName,
        users.full_name as UserName, users.email, reviews.created_at
        FROM reviews inner join products on products.id = reviews.product_id
        inner join users on users.id = reviews.user_id where products.name = :nameProduct"),array('nameProduct' => $nameProduct));
        $helper = new Helper();
        return $helper->paginate($results);
    }


    public function index()
    {
        $results = DB::select(DB::raw("SELECT reviews.id, reviews.number_of_star, reviews.content, products.name as ProductName, users.full_name as UserName, users.email
        FROM reviews inner join products on products.id = reviews.product_id
        inner join users on users.id = reviews.user_id Where reviews.deleted_at IS NULL
        "));
        $helper = new Helper();
        return $helper->paginate($results);
    }

    public function show( $id)
    {
        $results = DB::select(DB::raw("SELECT reviews.id, reviews.number_of_star, reviews.content, products.name as ProductName, users.full_name as UserName, users.email
        FROM reviews inner join products on products.id = reviews.product_id
        inner join users on users.id = reviews.user_id Where reviews.id = :id"),array('id' => $id));
        return $results;
    }

    public function store($objUpdate, $inputs)
    {
        $objUpdate->number_of_star = $inputs['number_of_star'];
        $objUpdate->content = $inputs['content'];
        $objUpdate->product_id = $inputs['product_id'];
        $objUpdate->user_id = $inputs['user_id'];
        $objUpdate->save();
        return $objUpdate;
    }

    public function update($objUpdate, $inputs)
    {
        $objUpdate->number_of_star = $inputs['number_of_star'];
        $objUpdate->content = $inputs['content'];
        $objUpdate->product_id = $inputs['product_id'];
        $objUpdate->user_id = $inputs['user_id'];
        $objUpdate->save();
        return $objUpdate;
    }

}
