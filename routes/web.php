<?php
use storeHub\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\Facades\DataTables;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


//PageController
Route::get('/home', 'PageController@index')->name('home');
Route::get('/profile', 'PageController@profile')->name('profile');

//SocialAuthFacebookControlle
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');

//UserController
Route::post('profile', 'UserController@update_avatar');

//Register all routes, these are accessed to ProductController
Route::resource('products','ProductController');
Route::get('pic/{id}', 'ProductController@showPicture');
Route::get('/addProduct', 'ProductController@create')->name('addProduct');
Route::get('/productDashboard', 'ProductController@Index')->name('productDashboard');
Route::post('/editProduct', 'ProductController@update');
Route::post('/serverSideProduct', 'ProductController@serverside')->name('serverSideProduct');

//Register all routes, these are accessed to CustomerController
Route::resource('customers','CustomerController');
Route::get('/CustomerList', 'CustomerController@index')->name('CustomerList');
Route::post('/createItem', 'CustomerController@store');
Route::post('/editItem', 'CustomerController@edit');
Route::post('/deleteItem', 'CustomerController@destroy');
Route::get('/serverSideCustomer', 'CustomerController@serverside')->name('serverSideCustomer');
