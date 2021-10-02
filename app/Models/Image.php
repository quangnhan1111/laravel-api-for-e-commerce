<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'name', 'link','created_at','updated_at'
    ];
    protected $dates = ['deleted_at'];
    protected $primaryKey = 'id';
    protected $table = 'images';

    public function product(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class, 'image_id', 'id');
    }
}
