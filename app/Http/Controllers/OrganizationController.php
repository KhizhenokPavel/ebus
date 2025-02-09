<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index($id) {
        $organizationInfo = Organization::getFullInformationById($id);

        if ($organizationInfo === false) {
            return response()->json(['error' => __('errors.notFound', ['attribute' => 'Organization'])], 404);
        }

        return $organizationInfo;
    }

    public function searchByName(Request $request) {
        $request->validate([
            'name' => 'required|string',
        ]);

        $organizationIds = Organization::searchByName($request->get('name'));

        if ($organizationIds === false) {
            return response()->json(['error' => __('errors.notFound', ['attribute' => 'Organization'])], 404);
        }

        return $organizationIds;
    }
}
