<?php
use App\Http\Controllers\AdminsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes();

Route::middleware(['role:admin', 'auth'])->group(function(){
    Route::get('/roles', 'RoleController@index')->name('roles.index');

    Route::post('/roles/store', 'RoleController@store')->name('roles.store');

    Route::delete('/roles/{role}/destroy', 'RoleController@destroy')->name('roles.destroy');

    Route::get('/roles/{role}/edit', 'RoleController@edit')->name('roles.edit');

    Route::put('/roles/{role}/update', 'RoleController@update')->name('roles.update');
});