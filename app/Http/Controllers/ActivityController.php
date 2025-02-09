<?php

namespace App\Http\Controllers;

use App\Models\OrganizationActivity;

class ActivityController extends Controller
{
    public function getOrganizationsBySelfActivity($activityId) {
        $organizationIds = OrganizationActivity::getOrganizationsBySelfActivity($activityId);

        if ($organizationIds === false) {
            return response()->json(['error' => __('errors.notFound', ['attribute' => 'Activity'])], 404);
        }

        return $organizationIds;
    }

    public function getOrganizationsByGroupActivity($activityId) {
        $organizationIds = OrganizationActivity::getOrganizationsByGroupActivity($activityId);

        if ($organizationIds === false) {
            return response()->json(['error' => __('errors.notFound', ['attribute' => 'Activity'])], 404);
        }

        return $organizationIds;
    }
}
