<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Building extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public static function exists($id): bool {
        return static::query()->where('id', $id)->exists();
    }

    public function organizations(): HasMany {
        return $this->hasMany(Organization::class);
    }
}
