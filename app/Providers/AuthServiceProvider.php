<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Invoice;
use App\Models\Post;
use App\Models\Product;
use App\Models\Review;
use App\Models\Role;
use App\Models\User;
use App\Policies\BrandPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\ColorPolicy;
use App\Policies\ImagePolicy;
use App\Policies\InvoicePolicy;
use App\Policies\PostPolicy;
use App\Policies\ProductPolicy;
use App\Policies\ReviewPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Brand::class => BrandPolicy::class,
        Category::class => CategoryPolicy::class,
        Color::class => ColorPolicy::class,
        Image::class => ImagePolicy::class,
        Post::class => PostPolicy::class,
        Review::class => ReviewPolicy::class,
        Role::class => RolePolicy::class,
        Product::class => ProductPolicy::class,
        Invoice::class => InvoicePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
