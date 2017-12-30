<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use Illuminate\Http\Request;

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
  
    // CUSTOMER CONTROLLER
    Route::get('/customer', [
        'uses' => 'CustomerController@index'
    ]);
    Route::get('/customer/view/{id}', [
        'uses' =>'CustomerController@view'
    ]);
    Route::post('/customer/update/{id}', [
        'uses' =>'CustomerController@update'
    ]);
    Route::post('/customer/add', [
        'uses' =>'CustomerController@add'
    ]);
  
    //STORY CONTROLLER
    Route::get('/story', [
        'uses' => 'StoryController@index'
    ]);
    Route::post('/story/create', [
        'uses' =>'StoryController@create'
    ]);
    Route::get('/story/newpage/{id}', [
        'uses' => 'StoryController@newPage'
    ]);
    Route::post('/story/addpage', [
        'uses' => 'StoryController@addpage'
    ]);
    Route::get('/story/editpage/{id}', [
        'uses' => 'StoryController@editpage'
    ]);
    Route::post('/story/addbutton', [
        'uses' => 'StoryController@addbutton'
    ]);
  
    Route::get('/', function() {
      return view('welcome');
    });
  
  Route::get('access', function(){
      echo 'you have access';
  })->middleware('isadmin');
  
  Route::get('form', function(){
    return view('form');
  });

  Route::post('post_to_me', function(Request $request){
      echo $request->input('name');
  });
});
