<?php

/*
|--------------------------------------------------------------------------
| Laravel Roles API Routes
|--------------------------------------------------------------------------
|
*/

Route::group([
    'middleware'    => ['auth:api'],
    'as'            => 'laravel-roles::',
    'namespace'     => 'jeremykenedy\LaravelRoles\App\Http\Controllers\Api',
    'prefix'        => 'api',
], function () {
    Route::apiResource('roles-api', 'LaravelRolesApiController');
});
