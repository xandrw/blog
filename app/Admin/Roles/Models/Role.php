<?php

namespace App\Admin\Roles\Models;

use App\Admin\Roles\Database\Factories\RoleFactory;
use App\Users\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Builder
 *
 * @property int                     $id
 * @property string                  $name
 * @property string                  $description
 * @property boolean                 $ignore_id
 * @property boolean                 $ignore_columns
 * @property string                  $created_at
 * @property string                  $updated_at
 * @property Collection|User[]       $users
 * @property Collection|Permission[] $permissions
 */
class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'ignore_id', 'ignore_columns'];

    protected $casts = ['ignore_id' => 'bool', 'ignore_columns' => 'bool'];

    protected static function newFactory(): RoleFactory
    {
        return RoleFactory::new();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class);
    }
}
