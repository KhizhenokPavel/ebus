<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public static function getGroupActivities($activityId): array {
        $activity = static::query()->find($activityId);
        $children = $activity->children();

        $activityIds = [$activity->id];

        if ($children->exists()) {
            foreach ($children->get() as $child) {
                $activityIds = array_merge($activityIds, static::getGroupActivities($child->id));
            }
        }

        return $activityIds;
    }

    public static function exists($id): bool {
        return static::query()->where('id', $id)->exists();
    }

    public function children(): HasMany{
        return $this->hasMany(Activity::class, 'parent_id');
    }

    public function parent(): BelongsTo {
        return $this->belongsTo(Activity::class, 'parent_id');
    }

    public function organizationActivities(): HasMany {
        return $this->hasMany(OrganizationActivity::class);
    }
}
