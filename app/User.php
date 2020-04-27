<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\Uuids;
use Tymon\JWTAuth\Contracts\JWTSubject;
use YoHang88\LetterAvatar\LetterAvatar;


class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use Notifiable;
    use SoftDeletes;
    use Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $keyType = 'string';
    protected $guard_name = 'web';
    public $incrementing = false;

    protected $fillable = [
        'title','name','surname','email','contact_number','profile_picture_url','date_of_birth','address','race','gender','api_token','email_verified_at','password','vendor_id'
    ];

    public function vendor(){
        return $this->hasOne(Vendor::class,'user_id','id');
    }

    public function getAvatarAttribute()
    {
        return new LetterAvatar($this->name . ' ' .$this->surname);

    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users','user_id');
    }


    /**
     * Checks if User has access to $permissions.
     */
    public function hasAccess(array $permissions) : bool
    {
        // check if the permission is available in any role
        foreach ($this->roles as $role) {
            if($role->hasAccess($permissions)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
        return [];
    }
}
