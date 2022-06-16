<?php

use App\Http\Controllers\AdminsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function(){//everything n this group must be authenticated
    Route::get('/admin', 'AdminsController@index')->name('admin.index');//admin.index is the view in views directory
   
});
