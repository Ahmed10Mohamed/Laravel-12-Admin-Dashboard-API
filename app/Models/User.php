<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Contracts\OAuthenticatable;
use App\Models\UserType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read UserType|null $userType
 */
class User extends Authenticatable implements OAuthenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'userName',
        'fullName',
        'phone',
        'email',
        'password',
        'user_type_id',
        'isActive',
        'image',
        'access_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'isActive'          => 'boolean',
    ];
    /**
     * Get the user type associated with the user.
     */
    public function userType(): BelongsTo
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }



}
