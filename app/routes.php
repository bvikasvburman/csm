<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*Route::get('/', function()
{
	return View::make('Home.hello');
});
 */
Route::get('/', "HomeController@index");
Route::get('login', 'HomeController@getLogin')->before('guest');
Route::post('login', 'HomeController@postLogin');
Route::get('logout', 'HomeController@logout');
Route::get('about', 'PagesController@about');
Route::get('terms-of-use', 'PagesController@termsofuse');
Route::get('suggestions', 'PagesController@suggestions');
Route::get('contact', 'PagesController@contact');

Route::filter('auth', function()
{
    if (Auth::guest()) return Redirect::guest('login');
});

Route::group(array('before' => 'auth'), function(){
    
    Route::get('company/{tab?}', 'CompanyController@index');
    Route::get('company/index', 'CompanyController@index');
    Route::get('company/more/{id}', 'CompanyController@moreData');
    
    Route::post('company/vic/data', 'CompanyController@vicData');
    
    Route::post('company/index', 'CompanyController@index');
    Route::post('company/listingAjax', 'CompanyController@listingAjax');
    Route::post('company/delete', 'CompanyController@delete');
    Route::post('company/addajax', 'CompanyController@addAjax');
    Route::post('company/getCompanyData', 'CompanyController@getCompanyData');
    Route::post('company/listingOtherAdd', 'CompanyController@listingOtherAdd');
    Route::post('company/listingPerson', 'CompanyController@listingPerson');
    Route::post('company/deleteOtherAdd', 'CompanyController@deleteOtherAdd');
    Route::post('company/deletePerson', 'CompanyController@deletePerson');
    Route::post('company/deletePersonCommu', 'CompanyController@deletePersonCommu');
    Route::post('company/saveOtherAdd', 'CompanyController@saveOtherAdd');
    Route::post('company/savePerson', 'CompanyController@savePerson');
    Route::post('company/companyDelete', 'CompanyController@companyDelete');
    Route::post('company/getPersonCommu', 'CompanyController@getPersonCommu');
    Route::post('company/savePersonCommu', 'CompanyController@savePersonCommu');
});

