<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'name', 'price','name_size', 'number', 'des', 'cate_id', 'brand_id', 'gender_id', 'image_id','color_id',
        'created_at','updated_at'
    ];
    protected $dates = ['deleted_at'];
    protected $primaryKey = 'id';
    protected $table = 'products';

    public function invoiceDetail(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(InvoiceDetail::class, 'product_id', 'id');
    }

    public function review(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }
}
