<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home');
});

Route::get('/booking', function () {
    return view('components.booking');
});

Route::get('/payment', function () {
    return view('components.payment');
});

Route::get('/category', function () {
    return view('components.category');
});

Route::get('/rawMaterial', function () {
    return view('components.raw-material');
});

Route::get('/totalPayment', function () {
    return view('components.total-payment');
});


Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/signup', function () {
    return view('auth.signup');
});

Route::get('signup', function () {
    return view('auth.signUp');
});
Route::get('login', function () {
    return view('auth.login');
});
Route::get('userDocument', function () {
    return view('components.user-document');
});
Route::get('updatedDocument', function () {
    return view('components.updated-documents');
});
Route::get('documentProcess', function () {
    return view('components.document-process');
});

