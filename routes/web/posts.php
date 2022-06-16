<?php

use App\Http\Controllers\AdminsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/post/{post}', 'PostController@show')->name('post');

Route::middleware('auth')->group(function(){//everything n this group must be authenticated
    Route::get('/posts/create', 'PostController@create')->name('post.create');

    Route::post('/posts', 'PostController@store')->name('post.store');

    Route::get('/posts', 'PostController@index')->name('post.index');//to show all posts

    //you realize the uri is repeated in 2 routes thats because one of them is get and the other is post so it won't make an issue

    Route::delete('/posts/{post}/destroy', 'PostController@destroy')->name('post.destroy');

    Route::get('/posts/{post}/edit', 'PostController@edit')->name('post.edit');

    Route::patch('/posts/{post}/update', 'PostController@update')->name('post.update');
});