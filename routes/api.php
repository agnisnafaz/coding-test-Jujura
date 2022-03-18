<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'PenggunaController@register'); //untuk register
Route::get('index', 'ControllerPenggunaController@index'); //untuk menampilkan data yang sudah diregister
Route::get('indexproduct', 'ProductController@index'); //untuk menampilkan data product
Route::post('insert', 'ProductController@insert'); //untuk menambahkan data product
Route::post('salesinsert', 'SalesController@salesinsert'); //untuk sales insert