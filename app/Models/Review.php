<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'number_of_star', 'content','product_id', 'user_id', 'created_at','updated_at'
    ];
    protected $primaryKey = 'id';
    protected $table = 'reviews';
    protected $dates = ['deleted_at'];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
