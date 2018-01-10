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

Route::get('/', function (){ 
    return view('welcome'); 
});


Route::get('/DernekListele', 'DernekController@Listele'); //DernekController sayfasındaki listele fonk.cagrdık.(Ne zaman? Bu url:/DernekListele get ile giriince)


Route::post('/DernekEkle','DernekController@DernekEkle');
Route::get('/DernekEkle','DernekController@DernekEkleSayfasiGoruntule'); 

Route::post('/DernekGuncelle','DernekController@DernekGuncelle'); //Derneği güncelleme
Route::get('/DernekGuncelle/{id}', 'DernekController@GuncellemeSayfasiniGoster'); //Derneği gösterme fonksiyonu




Route::get('/DernekSil/{id}', 'DernekController@DernekSil'); //Dernek Sil fonksiyonu için

Route::get('/IlinIlceleriniGetir/{il_id}','DernekController@IleGoreIlceGonder');

Route::get('/IlceninSemtleriniGetir/{ilce_id}','DernekController@IlceyeGoreSemtGonder'); //{ilce_id} olmasının sebebi Controllerın içindeki fonskiyon parametreli