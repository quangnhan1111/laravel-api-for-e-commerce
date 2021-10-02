<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, SoftDeletes;

    public $timestamps = false; //set time to false

    protected $primaryKey = 'id';
    protected $table = 'users';
    protected $fillable = [
        'full_name',
        'email',
        'address',
        'username',
        'password',
        'phone_number',
        'created_at',
        'updated_at',
    ];

    protected $dates = ['deleted_at'];

    public function review(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Review::class, 'user_id', 'id');
    }

//    public function role(): BelongsTo
//    {
//        return $this->belongsTo(Role::class);
//    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'users_roles','user_id','role_id');
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();

    }//end getJWTIdentifier()


    public function getJWTCustomClaims()
    {
        return [];

    }//end getJWTCustomClaims()

    public function isAdmin()
    {
//        $role_id= DB::table('users_roles')
//            ->select('users_roles.user_id', 'users_roles.role_id')
//            ->where('users_roles.user_id','=',Auth::user()->getAuthIdentifier())
//            ->first();
//        $role=Role::query()->findOrFail($role_id->role_id);
//        $roleName=$role->name;
//        return $roleName=='admin';
        return $this->roles->contains('name','admin');
    }


    public function isEmployee()
    {
        return $this->roles->contains('name','employee');
    }

    public function isCustomer()
    {
        return $this->roles->contains('name','customer');
    }
}
