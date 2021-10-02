<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'title', 'content','image_id','created_at','updated_at'
    ];
    protected $dates = ['deleted_at'];
    protected $primaryKey = 'id';
    protected $table = 'posts';
}
