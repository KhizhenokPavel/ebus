<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Pavelkhizhenok\Point\Classes\Point;

class Organization extends Model
{
    use HasFactory;

    public const EARTH_RADIUS = 6371210;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public static function getFullInformationById(int $id): array|false {
        $activityInfo = Organization::with(['organizationPhones', 'organizationActivities', 'building'])
            ->where('id', $id);

        if ($activityInfo->exists()) {
            return false;
        }

        $activityInfo = $activityInfo->first();
        $activityInfo->organizationActivities->load('activity');

        return $activityInfo->toArray();
    }

    public static function searchByName(string $name): array {
        return static::all()->where('name', $name)->pluck('id')->toArray();
    }

    public static function getInBuilding(int $id): array|false {
        if (!Building::exists($id)) {
            return false;
        }

        return static::query()->where('building_id', $id)->pluck('id')->toArray();
    }

    public static function getInBuildings(array $ids): array {
        return static::query()->whereIn('building_id', $ids)->pluck('id')->toArray();
    }

    public static function getBuildingsInCircle(Point $circleCenter, float $circleRadius, int $objectRadius = self::EARTH_RADIUS): array {
        $circleCenterLatitude = $circleCenter->getY();

        return Building::query()->selectRaw(
            '*, (' . $objectRadius . ' * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude)
            - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance',
            [$circleCenterLatitude, $circleCenter->getX(), $circleCenterLatitude]
        )->having('distance', '<=', $circleRadius)->pluck('id')->toArray();
    }

    public static function getBuildingsInRectangle(Point $firstPoint, Point $secondPoint): array {
        $longitudeDiapason = [$firstPoint->getX(), $secondPoint->getX()];
        $latitudeDiapason = [$firstPoint->getY(), $secondPoint->getY()];

        sort($longitudeDiapason);
        sort($latitudeDiapason);

        return Building::all()
            ->whereBetween('longitude', $longitudeDiapason)
            ->whereBetween('latitude', $latitudeDiapason)
            ->pluck('id')->toArray();
    }

    public function organizationPhones(): HasMany {
        return $this->hasMany(OrganizationPhone::class);
    }

    public function organizationActivities(): HasMany {
        return $this->hasMany(OrganizationActivity::class);
    }

    public function building(): BelongsTo {
        return $this->belongsTo(Building::class);
    }
}
