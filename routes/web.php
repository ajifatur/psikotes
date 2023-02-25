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

// Register
Route::get('/register', 'RegisterController@showRegistrationForm')->name('auth.register');

\Ajifatur\Helpers\RouteExt::auth();
\Ajifatur\Helpers\RouteExt::admin();

// Guest Routes
Route::group(['middleware' => ['faturhelper.guest']], function() {
	Route::get('/login', function() {
		return view('auth/login');
	})->name('auth.login');
    Route::post('/login', 'LoginController@authenticate');
});

Route::group(['middleware' => ['faturhelper.admin']], function() {
    // Project
    Route::get('/admin/project', 'ProjectController@index')->name('admin.project.index');
    Route::get('/admin/project/create', 'ProjectController@create')->name('admin.project.create');
    Route::post('/admin/project/store', 'ProjectController@store')->name('admin.project.store');
    Route::get('/admin/project/edit/{id}', 'ProjectController@edit')->name('admin.project.edit');
    Route::post('/admin/project/update', 'ProjectController@update')->name('admin.project.update');
    Route::post('/admin/project/delete', 'ProjectController@delete')->name('admin.project.delete');

    // Result
    Route::get('/admin/result', 'ResultController@index')->name('admin.result.index');
    Route::get('/admin/result/detail/{id}', 'ResultController@detail')->name('admin.result.detail');
    Route::post('/admin/result/delete', 'ResultController@delete')->name('admin.result.delete');
    Route::post('/admin/result/print', 'ResultController@print')->name('admin.result.print');
});

Route::group(['middleware' => ['faturhelper.nonadmin']], function() {
    // Dashboard
    Route::get('/member', 'DashboardController@index')->name('member.dashboard');

    // Check Project
    Route::get('/member/project', function() {
        return redirect()->route('member.dashboard')->with(['message' => 'Anda wajib memasukkan token sebelum menuju ke halaman Tes.']);
    })->name('member.project');
    Route::post('/member/project', 'ProjectController@check');

    // Test
    Route::get('/member/test/{path}', 'TestController@index')->name('member.test.index');
    Route::post('/member/test/{path}/store', 'TestController@store')->name('member.test.store');
});