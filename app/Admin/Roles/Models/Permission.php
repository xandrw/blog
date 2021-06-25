<?php

namespace App\Admin\Roles\Models;

use App\Admin\Roles\Database\Factories\PermissionFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Builder
 *
 * @property int    $id
 * @property int    $role_id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property Role $role
 */
class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    protected static function newFactory(): PermissionFactory
    {
        return PermissionFactory::new();
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
