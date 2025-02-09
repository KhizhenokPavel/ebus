<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchAreaRequest;
use App\Models\Organization;
use Pavelkhizhenok\Point\Classes\Point;

class TerritoryController extends Controller
{
    public function buildingsAndOrganizations(SearchAreaRequest $request) {
        $response = [];

        if ($request->get('areaType') == SearchAreaRequest::AREA_TYPES['circle']) {
            $response['buildingIds'] = Organization::getBuildingsInCircle(
                new Point($request->get('centralPointLongitude'), $request->get('centralPointLatitude')),
                $request->get('radius')
            );
        } else {
            $response['buildingIds'] = Organization::getBuildingsInRectangle(
                new Point($request->get('firstPointLongitude'), $request->get('firstPointLatitude')),
                new Point($request->get('secondPointLongitude'), $request->get('secondPointLatitude')),
            );
        }

        $response['organizationIds'] = Organization::getInBuildings($response['buildingIds']);

        return $response;
    }
}
