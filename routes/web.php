<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Auth\LoginController@showLoginForm');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/settings', 'HomeController@settings')->name('user.settings');

Route::prefix("greenhouse")->group(function () {
    Route::get('/get-past-metrics', 'GreenhouseNodeController@getStats')->name("greenhouse.get-past-metrics");
    Route::get('/get-greenhouse-environmental-limits', 'GreenhouseEnvironmentController@getEnvironmentalLimits')->name("greenhouse.get-environmental-limits");
    Route::post('/update-greenhouse-environmental-limits', 'GreenhouseEnvironmentController@updateEnvironmentalCondition')->name("greenhouse.update-environmental-limits");
    Route::get('/{greenhouse:code}', 'GreenhouseNodeController@show')
        ->name('greenhouse-node.show')->middleware('can:control-greenhouse,greenhouse');
    Route::get('/{greenhouse:code}/manage-conditions', 'GreenhouseNodeController@manageConditions')
        ->name('greenhouse-node.manage-conditions')->middleware('can:control-greenhouse,greenhouse');

});

Route::prefix('/manage-greenhouses')->group(function () {
    Route::get('/', 'GreenhouseController@index')->name('greenhouses.index');
    Route::get('/add', 'GreenhouseController@create')->name('greenhouses.create');
    Route::post('/', 'GreenhouseController@store')->name('greenhouses.store');
    Route::get('/{greenhouse}/add-success', 'GreenhouseController@successfulStore')->name('greenhouses.successful-store');
    Route::delete('/{greenhouse}/add-gh', 'GreenhouseController@destroy')->name('greenhouses.destroy');
});

Route::prefix("user-management")->group(function () {
    Route::get("/", "UserManagementController@index")->name("user-management.index");
    Route::get("/create-user", "UserManagementController@create")->name("user-management.create");
    Route::post("/create-user", "UserManagementController@store")->name("user-management.store");
    Route::get("/update-user/{user}/e", "UserManagementController@edit")->name("user-management.edit");
    Route::post("/update-user/{user}/u", "UserManagementController@update")->name("user-management.update");
    Route::post("/approve-user", "UserManagementController@approveAccount")->name("user-management.approve-account");
//    Route::get("/","UserManagementController@")->name("user-management.");
});
