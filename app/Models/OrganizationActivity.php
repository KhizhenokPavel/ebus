<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrganizationActivity extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public static function getOrganizationsBySelfActivity(int $activityId): array|false {
        if (!Activity::exists($activityId)) {
            return false;
        }

        return static::all()->where("activity_id", $activityId)->pluck('id')->toArray();
    }

    public static function getOrganizationsByGroupActivity(int $activityId): array|false {
        if (!Activity::exists($activityId)) {
            return false;
        }

        return static::query()->distinct()->whereIn("activity_id", Activity::getGroupActivities($activityId))->pluck('organization_id')->toArray();
    }

    public function organization(): BelongsTo {
        return $this->belongsTo(Organization::class);
    }

    public function activity(): BelongsTo {
        return $this->belongsTo(Activity::class);
    }
}
