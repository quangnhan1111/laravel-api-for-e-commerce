<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'name', 'created_at','updated_at',"is_deleted"
    ];
    protected $primaryKey = 'id';
    protected $table = 'roles';
    protected $dates = ['deleted_at'];
//    public function user(): \Illuminate\Database\Eloquent\Relations\HasMany
//    {
//        return $this->hasMany(User::class, 'role_id', 'id');
//    }



    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_roles');
    }
}
