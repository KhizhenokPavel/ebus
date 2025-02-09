<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\TerritoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('/organizations')->group(function () {
    Route::get('/{id}', [OrganizationController::class, 'index'])->where('id', '[0-9]+');
    Route::get('/searchByName', [OrganizationController::class, 'searchByName']);
})->name('organizations');

Route::prefix('/buildings')->group(function () {
    Route::get('/{id}/organizations', [BuildingController::class, 'getOrganizationsInBuilding'])->where('id', '[0-9]+');
})->name('buildings');

Route::prefix('/territories')->group(function () {
    Route::get('/buildingsAndOrganizations', [TerritoryController::class, 'buildingsAndOrganizations']);
})->name('territories');

Route::prefix('/activities')->group(function () {
    Route::get('/{id}/self/organizations', [ActivityController::class, 'getOrganizationsBySelfActivity'])->where('id', '[0-9]+');
    Route::get('/{id}/group/organizations', [ActivityController::class, 'getOrganizationsByGroupActivity'])->where('id', '[0-9]+');
});
