<?php

namespace App\Users\Models;


use App\Users\Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

/**
 * @property int    $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $created_at
 * @property string $updated_at
 * @property Collection $roles
 *
 * @method BelongsToMany roles()
 *
 * @mixin Builder
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }

    public function setPasswordAttribute(?string $value): void
    {
        if (!$value) return;

        $this->attributes['password'] = Hash::make($value);
    }
}
