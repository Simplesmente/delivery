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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware'=>'auth.checkrole:admin', 'as' => 'admin.'],function(){

    Route::get('categories',['uses' => 'CategoriesController@index','as' => 'categories.index']);
    Route::get('category/create',['uses' => 'CategoriesController@create','as' => 'category.create']);
    Route::post('category/store',['uses' => 'CategoriesController@store','as' => 'category.store']);
    Route::get('category/edit/{id}',['uses' => 'CategoriesController@edit','as' => 'category.edit']);
    Route::post('category/update/{id}',['uses' => 'CategoriesController@update','as' => 'category.update']);
    Route::get('category/delete/{id}',['uses' => 'CategoriesController@delete','as' => 'category.delete']);
    
    
    Route::get('products',['uses' => 'ProductsController@index','as' => 'products.index']);
    Route::get('produtcs/create',['uses' => 'ProductsController@create','as' => 'products.create']);
    Route::post('produtcs/store',['uses' => 'ProductsController@store','as' => 'product.store']);
    Route::get('produtcs/edit/{id}',['uses' => 'ProductsController@edit','as' => 'product.edit']);
    Route::post('produtcs/update/{id}',['uses' => 'ProductsController@update','as' => 'product.update']);
    Route::get('produtcs/destroy/{id}',['uses' => 'ProductsController@destroy','as' => 'product.destroy']);

    Route::get('/clients',['uses' => 'ClientsController@index','as' => 'clients.index']);
    Route::get('/client/create',['uses' => 'ClientsController@create','as' => 'client.create']);
    Route::post('/client/store',['uses' => 'ClientsController@store','as' => 'client.store']);
    Route::get('/client/edit/{id}',['uses' => 'ClientsController@edit','as' => 'client.edit']);
    Route::post('/client/update/{id}',['uses' => 'ClientsController@update','as' => 'client.update']);
    Route::get('/client/destroy/{id}',['uses' => 'ClientsController@destroy','as' => 'client.destroy']);

    Route::get('/orders',['uses' => 'OrdersController@index','as' => 'pedidos.index']);
    Route::get('/orders/edit/{id}',['uses' => 'OrdersController@edit','as' => 'pedidos.edit']);
    Route::post('/orders/update/{id}',['uses' => 'OrdersController@update','as' => 'pedido.update']);
    
    Route::get('/cupoms',['uses' => 'CupomsController@index','as' => 'cupoms.index']);
    Route::get('/cupom/create',['uses' => 'CupomsController@create','as' => 'cupom.create']);
    Route::post('/cupom/store',['uses' => 'CupomsController@store','as' => 'cupom.store']);

    //Route::post('/cupom/update/{id}',['uses' => 'CupomsController@update','as' => 'cupom.update']);
    //Route::get('/cupom/edit/{id}',['uses' => 'CupomsController@edit','as' => 'cupom.edit']);
});


Route::group(['prefix' => 'customer', 'middleware'=>'auth.checkrole:client', 'as' => 'customer.'], function(){
    
    Route::get('/order/index',['uses' => 'CheckoutController@index','as' => 'order.index']);
    Route::get('/order/create',['uses' => 'CheckoutController@create','as' => 'order.create']);
    Route::post('/order/store',['uses' => 'CheckoutController@store','as' => 'order.store']);

});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});


Route::group(['prefix' => 'api', 'middleware'=>'oauth', 'as' => 'api.'], function(){
       
    Route::group(['prefix' => 'client','middleware' => 'delivery.api.role:client', 'as' => 'client.'],function(){
		
		Route::resource('order',
			'Api\Client\ClientCheckoutController',['except' => ['create','edit','destroy'] ]);
		Route::resource('authenticated',
			'Api\Client\UserController',['except' => ['create','edit','destroy'] ]);
    });
    

	Route::group(['prefix' => 'deliveryman','middleware' => 'delivery.api.role:deliveryman', 'as' => 'deliveryman.'],function(){
		
		Route::resource('order',
			'Api\Deliveryman\DeliverymanController',['except' => ['create','edit','destroy']]);
		
		Route::patch('order/{id}/update-status',
			['uses' => 'Api\Deliveryman\DeliverymanController@updateStatus', 
			'as' => 'order.update-status']);
	});

});

