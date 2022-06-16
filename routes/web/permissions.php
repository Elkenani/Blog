<?php
use App\Http\Controllers\AdminsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes();

Route::get('/permissions', 'PermissionController@index')->name('permissions.index');