<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    if(Auth::guest()) {
        return redirect()->route('auth.login');
    }
    else {
        if(Auth::user()->role_id == role('member')) {
            return redirect()->route('member.dashboard');
        }
        else {
            return redirect()->route('admin.dashboard');
        }
    }
});

\Ajifatur\Helpers\RouteExt::auth();
\Ajifatur\Helpers\RouteExt::admin();

Route::group(['middleware' => ['faturhelper.admin']], function() {
    // Project
    Route::get('/admin/project', 'ProjectController@index')->name('admin.project.index');
    Route::get('/admin/project/create', 'ProjectController@create')->name('admin.project.create');
    Route::post('/admin/project/store', 'ProjectController@store')->name('admin.project.store');
    Route::get('/admin/project/edit/{id}', 'ProjectController@edit')->name('admin.project.edit');
    Route::post('/admin/project/update', 'ProjectController@update')->name('admin.project.update');
    Route::post('/admin/project/delete', 'ProjectController@delete')->name('admin.project.delete');
});

Route::group(['middleware' => ['faturhelper.nonadmin']], function() {
    // Dashboard
    Route::get('/member', 'DashboardController@index')->name('member.dashboard');

    // Check Project
    Route::get('/member/project', function() {
        return redirect()->route('member.dashboard')->with(['message' => 'Anda wajib memasukkan token sebelum menuju ke halaman Tes.']);
    })->name('member.project');
    Route::post('/member/project', 'ProjectController@check')->name('member.project');
});