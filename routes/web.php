<?php

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
    return view('home');
});
Route::get('/logout', function () {
    return view('home');
});

// Route::get('/gmaps', 'Admin@gmaps');
Route::get('/map', 'Admin@map');


Route::get('/index', 'Admin@dash');
Route::get('/login', 'Admin@login');
Route::get('/logaction', 'Admin@logact');
Route::get('/adminhome', 'Admin@adhome');
Route::get('/data_keris', 'Admin@dtkeris');
Route::get('/data_map={id}', 'Admin@dtmap');
Route::post('/act_tmb_ker', 'Admin@tmbker');
Route::post('/act_ed_ker={id}', 'Admin@edker');
Route::get('/ker:hapus={id}', 'Admin@delker');



Route::get('/data_pemilik', 'Admin@dtmilik');
Route::post('/act_tmb_pem', 'Admin@tmbpem');
Route::post('/act_ed_pem={id}', 'Admin@edpem');
Route::get('/pem:hapus={id}', 'Admin@delpem');

Route::get('/data_galeri', 'Admin@dtgaleri');
Route::post('/act_tmb_gal', 'Admin@tmbgal');
Route::post('/act_ed_gal={id}', 'Admin@edgal');
Route::get('/gal:hapus={id}', 'Admin@delgal');


Route::get('/pemilikhome', 'Admin@pehome');
Route::get('/pdata_keris', 'Admin@pdtkeris');
Route::post('/act_tmb_pker', 'Admin@ptmbker');
Route::post('/act_ed_pker={id}', 'Admin@pedker');
Route::get('/pker:hapus={id}', 'Admin@pdelker');

?>
