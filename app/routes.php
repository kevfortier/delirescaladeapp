<?php
session_start();
date_default_timezone_set('America/montreal');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::when('*','csrf',array('post','put','delete'));

Route::get('/',array('as' => 'home' ,function(){return Redirect::to('/home');}));

Route::get('/goodbey',array('as' => 'goodbey' ,function(){unset($_SESSION['user']);return Redirect::to('/home');}));
Route::get('/goodbye',array('as' => 'goodbye' ,function(){$_SESSION = array();return Redirect::to('/connexion');}));

Route::get('img/userProfileAvatar/{id}',function(){return Redirect::to('img/userProfileAvatar/default.png');});
Route::get('img/voie/image/{idVoie}',function(){return Redirect::to('img/voie/image/default.png');});

Route::resource('home', 'HomeController');
Route::resource('connexion','ConnexionController');
Route::resource('administration','AdministrationController');
Route::resource('erreur','ErreurController');
Route::resource('notifications', 'NotificationsController');
Route::resource('utilisateurs','UtilisateursController');
Route::resource('partenaires','PartenairesController');
Route::resource('horaires','HorairesController');
Route::resource('motdepasseoublie','MdpController');
Route::resource('voies','VoiesController');
