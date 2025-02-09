<?php

namespace App\Http\Controllers;

use App\Models\Organization;

class BuildingController extends Controller
{
    public function getOrganizationsInBuilding($buildingId) {
        $organizationIds = Organization::getInBuilding($buildingId);

        if ($organizationIds === false) {
            return response()->json(['error' => __('errors.notFound', ['attribute' => 'Building'])], 404);
        }

        return $organizationIds;
    }
}
