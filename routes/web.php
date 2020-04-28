<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/quotes');
});



Route::group(['middleware' => 'auth'], function () {
    // ---------------Quotes


    Route::resource('quotes', 'QuotesController', ['except' => ['index', 'show'] ]);
    Route::post('quotes/comment/{id}', 'CommentController@store');
    Route::get('/quotes/comment/{id}/edit', 'CommentController@edit');
    Route::put('/quotes/comment/{id}', 'CommentController@update');
    Route::delete('/quotes/comment/{id}', 'CommentController@destroy');

    Route::get('/like/{model}/{type}', 'LikeController@like');
    Route::get('/unlike/{model}/{type}', 'LikeController@unlike');

    Route::get('/notification', 'NotificationController@notification');
    Route::delete('/notification/{id}', 'NotificationController@destroy');


    // ---------------End Quotes
});

Route::resource('quotes', 'QuotesController', ['only' => ['index', 'show'] ]);
Route::get('/quotes-random', 'QuotesController@random');
// Route profile (opsional : pakai id atau tidak)
Route::get('/quotes-profile/{id?}', 'QuotesController@profile');
Route::get('/quotes-filter/{tag}', 'QuotesController@filter');







Auth::routes();
// Auth::routes(['register' => false]);

