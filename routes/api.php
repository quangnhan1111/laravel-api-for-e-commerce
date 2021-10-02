<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(
    [
        'middleware' => 'api',
        'namespace'  => 'App\Http\Controllers',
        'prefix'     => 'v1/auth',
    ],
    function ($router) {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('logout', 'AuthController@logout');
        //Route::get('profile', 'AuthController@profile');
//        Route::post('refresh', 'AuthController@refresh');
    }
);

Route::get('v1/categories/getAll', [CategoryController::class,'getCategories']);
Route::get('v1/brands/getAll', [BrandController::class,'getBrands']);
Route::get('v1/images/getAll', [ImageController::class,'getImages']);
Route::get('v1/colors/getAll', [ColorController::class,'getColors']);
Route::get('v1/colors/get/byGender/{gender_id}/bySize/{size}/byNameProduct/{nameProduct}', [ColorController::class,'getColorByGenderAndSize']);
Route::get('v1/colors/get/byColor/{color_id}/byGender/{gender_id}/bySize/{size}/byNameProduct/{nameProduct}', [ColorController::class,'getColorByGenderAndSizeAndColor']);
Route::get('v1/brands/{id}', [BrandController::class,'show']);
Route::get('v1/categories/{id}', [CategoryController::class,'show']);
Route::get('v1/client/product/new', [ProductController::class,'getNewProduct']);
Route::get('v1/client/product/best', [ProductController::class,'getBestProduct']);
Route::get('v1/client/product/search/{key}', [ProductController::class,'getProductBySearch']);
Route::get('v1/client/brand/relateProduct/{idBrand}', [ProductController::class,'getRelatedProductByBrand']);
Route::get('v1/client/category/relateProduct/{idCate}', [ProductController::class,'getRelatedProductByCate']);
Route::get('v1/products/{id}', [ProductController::class,'show']);
Route::get('v1/products/', [ProductController::class,'index']);
Route::get('v1/productsForAdmin/{id}', [ProductController::class,'showForAdmin']);
Route::get('v1/productsForAdmin/', [ProductController::class,'indexForAdmin']);
Route::get('v1/client/review/{nameProduct}', [ReviewController::class,'getAllReviewByIdProduct']);
Route::post('v1/reviews', [ReviewController::class,'store']);
Route::get('v1/posts/', [PostController::class,'index']);
Route::get('v1/posts/{id}', [PostController::class,'show']);
Route::post('v1/invoices', [InvoiceController::class,'store']);
Route::get('v1/images/{id}', [ImageController::class,'show']);
Route::group(
    [
        'middleware' => 'auth:api',
    ],
    function ($router) {
        Route::get('v1/admin/user/customer/getAll', [UserController::class,'getCustomersAll']);
        Route::get('v1/admin/user/customer', [UserController::class,'getCustomers']);
        Route::get('v1/admin/user/employee', [UserController::class,'getEmployees']);
        Route::get('v1/admin/role/userRole/{idRole}', [RoleController::class,'getUserByRoles']);
        Route::get('v1/client/review/good', [ReviewController::class,'getGoodReview']);

//        show all ( index ) va ten cua customer hoac cua employee
        Route::get('v1/invoice/showNamebyCustomer', [InvoiceController::class,'getInvoicesByCustomer']);
        Route::get('v1/invoice/showNamebyEmployee', [InvoiceController::class,'getInvoicesByEmployee']);
//        show by customer show details name hien 1 invoice
        Route::get('v1/invoice/showByCustomer/{id}', [InvoiceController::class,'showOneInvoicesAndShowCustomer']);
        Route::get('v1/invoice/showByEmployee/{id}', [InvoiceController::class,'showOneInvoicesAndShowEmployee']);

        //        show by customer show details name hien 1 invoice
        Route::get('v1/invoice/showByCustomer/get/{id}', [InvoiceController::class,'showOneInvoices']);


//        show invoice boi 1 customer hoac 1 employee
        Route::get('v1/invoice/byIdCustomer/{id}', [InvoiceController::class,'showInvoicesByIdCustomer']);
        Route::get('v1/invoice/byIdEmployee/{id}', [InvoiceController::class,'showInvoicesByIdEmployee']);
//        show invoice and user inner join bang user va bang invoice
        Route::get('v1/invoice/getInvoice/customer/status', [InvoiceController::class,'getInvoicesForCustomerStatus']);
        Route::get('v1/invoice/getInvoice/employee/status', [InvoiceController::class,'getInvoicesForEmployeeStatus']);

        //        show invoice and user inner join bang user va bang invoice
        Route::get('v1/invoice/getInvoice/customer/status/{id}', [InvoiceController::class,'getInvoicesForOneCustomerStatus']);
        Route::get('v1/invoice/getInvoice/employee/status/{id}', [InvoiceController::class,'getInvoicesForOneEmployeeStatus']);

        Route::get('v1/saleFigure/getTotalProductSoldOut', [SaleController::class,'getTotalProductSoldOut']);
        Route::get('v1/saleFigure/getTotalUser', [SaleController::class,'getTotalUser']);
        Route::get('v1/saleFigure/byDay', [SaleController::class,'getSaleFigureByDay']);
        Route::get('v1/saleFigure/byMonth', [SaleController::class,'getSaleFigureByMonth']);
        Route::get('v1/saleFigure/byEmployee', [SaleController::class,'getSaleFigureByEmployee']);

        Route::apiResource('v1/users',UserController::class);
        Route::apiResource('v1/brands', BrandController::class)->except([
            'show'
        ]);
        Route::apiResource('v1/categories', CategoryController::class)->except([
            'show'
        ]);
        Route::apiResource('v1/posts',PostController::class)->except([
            'index', 'show'
        ]);
        Route::apiResource('v1/colors', ColorController::class);
        Route::apiResource('v1/images', ImageController::class)->except([
            'show'
        ]);
        Route::apiResource('v1/products', ProductController::class)->except([
            'show', 'index'
        ]);
        Route::apiResource('v1/reviews', ReviewController::class)->except([
            'store'
        ]);
        Route::apiResource('v1/roles',RoleController::class);
        Route::apiResource('v1/invoices', InvoiceController::class)->except([
            'store'
        ]);

    }
);

