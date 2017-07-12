<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * Frontend route.
 */
Route::get('/pages/{id}', 'WelcomeController@pages');

Route::get('/', 'WelcomeController@index');

Route::get('population-clock', 'HomeController@populationClock');

Route::get('district/{district_id?}', 'DistrictsController@frontIndex');

Route::get('helpdesk', 'HelpDeskMessagesController@create');
Route::post('helpdesk', 'HelpDeskMessagesController@store');
Route::get('videos', 'VideosController@index');
Route::get('videos/{playlist}/playlist', 'VideosController@playlistvideos');

Route::group(['namespace' => 'Document', 'prefix' => 'documents'], function () {

    Route::get('books', 'BooksController@frontIndex');
    Route::get('progress-report', 'ReportsController@frontIndex');
});

//Route::controllers([
//    'auth'     => 'Auth\AuthController',
//    'password' => 'Auth\PasswordController',
//]);

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('home', 'HomeController@index');
    
Route::get('documents/books/{id}/download', 'Document\BooksController@download');

Route::group(['middleware' => 'auth', 'prefix' => 'backend'], function () {

    /*
     * Documents Routes
     */
    Route::group(['namespace' => 'Document', 'prefix' => 'documents'], function () {

        Route::resource('books', 'BooksController', ['except' => ['show']]);
    

        Route::resource('department-document', 'DepartmentDocumentsController', ['except' => ['show']]);
        Route::get('department-document/{id}/download', 'DepartmentDocumentsController@download');

        Route::resource('reports', 'ReportsController', ['except' => ['show']]);
        Route::get('reports/{id}/download', 'ReportsController@download');

    });
    
    Route::get('population-clock', 'HomeController@backendPopulationClock');
    Route::resource('helpdesk', 'HelpDeskMessagesController', ['except' => ['create', 'store', 'edit']]);
    Route::get('helpdesk/{id}/reply', 'HelpDeskMessagesController@edit');
    Route::resource('districts', 'DistrictsController');
    Route::resource('districts.information', 'DistrictsInformationController');
    Route::post('district-information/uploadImage', 'DistrictsInformationController@uploadImage');
    Route::resource('gallery', 'GalleryController');
    Route::get('gallery/status/{id}/', 'GalleryController@status');
    Route::resource('page', 'PageController');
    

    /*
     * Configurations Routes
     */
    Route::group(['namespace' => 'Configuration', 'prefix' => 'config'], function () {

        Route::resource('designation', 'DesignationsController', ['except' => 'create']);
        Route::resource('office', 'OfficesController', ['except' => 'create']);
        Route::resource('financial-year', 'FiscalsController', ['except' => 'create']);
        Route::get('financial-year/status/{id}/', 'FiscalsController@status');
        Route::resource('census-information', 'CensusController');
        Route::resource('vital-statistic-type', 'VitalStatisticTypeController');

    });

    Route::resource('employees', 'Auth\UsersController');
    Route::get('change-password', 'Auth\UsersController@changePassword');
    Route::put('change-password', 'Auth\UsersController@updatePassword');

    Route::group(['namespace' => 'Other', 'prefix' => 'others'], function () {

        Route::resource('links', 'ImportantLinksController');

    });

});
