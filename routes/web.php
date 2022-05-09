<?php

/*
|--------------------------------------------------------------------------
| ADM Routes
|--------------------------------------------------------------------------
*/

// auth routes
Auth::routes();
//Auth::routes(['register' => false]);

// login routes
// Route::get('/adm/home', "Adm\HomeController@index")->name('login-adm');
// Route::get('/adm/login', 'Adm\HomeController@index')->name('adm-login');

// // Acompanhe Routes
// Route::resource('/adm/acompanhe/', 'Adm\AcompanheController');
// Route::get('/adm/acompanhe/order/', 'Adm\AcompanheController@order');
// Route::get('/adm/acompanhe/edit/{url}/', 'Adm\AcompanheController@edit')->name('acompanhe-editar');
// Route::post('/adm/acompanhe/edited/{id}', 'Adm\AcompanheController@update')->name('acompanhe-update');
// Route::get('/adm/acompanhe/orderned/', 'Adm\AcompanheController@orderned');
// Route::get('/adm/acompanhe/search/', 'Adm\AcompanheController@search');
// Route::get('/adm/acompanhe-apagar/{id}', 'Adm\AcompanheController@destroy');

// // Curriculum
// Route::get('/adm/profissionais/edit/{id}','Adm\CurriculumController@showEdit');
// Route::get('/adm/profissionais/','Adm\CurriculumController@show');
// Route::post('/adm/profissionais/edited/{id}','Adm\CurriculumController@edit');

// // Videos Routes
// Route::resource('/adm/videos/', 'Adm\VideosController');
// Route::get('/adm/videos/showCreate', 'Adm\VideosController@showCreate')->name('adm-videos-show-create');
// Route::post('/adm/videos/create', 'Adm\VideosController@Create')->name('adm-videos-create');
// Route::get('/adm/videos/edit/{url}/', 'Adm\VideosController@showEdit')->name('adm-videos-editar');
// Route::post('/adm/videos/edited/{id}', 'Adm\VideosController@Edit')->name('adm-videos-update');
// Route::get('/adm/videos/order/', 'Adm\VideosController@order')->name('adm-video-order');
// Route::get('/adm/videos/orderned/', 'Adm\VideosController@orderned')->name('adm-video-orderned');
// Route::get('/adm/videos/search/', 'Adm\VideosController@search')->name('adm-videos-search');
// Route::get('/adm/videos/del/{id}', 'Adm\VideosController@del')->name('adm-videos-del');

// // Equipe Routes
// Route::resource('/adm/equipe/', 'Adm\EquipeController');
// Route::get('/adm/equipe/order/', 'Adm\EquipeController@order');
// Route::get('/adm/equipe/edit/{url}/', 'Adm\EquipeController@edit')->name('equipe-editar');
// Route::post('/adm/equipe/edited/{id}', 'Adm\EquipeController@update')->name('equipe-update');
// Route::get('/adm/equipe/orderned/', 'Adm\EquipeController@orderned');
// Route::get('/adm/equipe/search/', 'Adm\EquipeController@search');
// Route::get('/adm/equipe-apagar/{id}', 'Adm\EquipeController@destroy');

// // Contato Routes
// Route::resource('/adm/contato/', 'Adm\ContatoController');
// Route::get('/adm/contato/editar/{id}', 'Adm\ContatoController@edit')->name('contato-editar');
// Route::post('/adm/contato/edited/{id}', 'Adm\ContatoController@update')->name('contato-update');
// Route::get('/adm/contato/search/', 'Adm\ContatoController@search');
// Route::get('/adm/contato/excel/', 'Adm\ContatoController@excel');
// Route::get('adm/contato/delete/{id}', 'Adm\ContatoController@destroy')->name('contato-delete');

// // News Routes
// Route::resource('/adm/news/', 'Adm\NewsController');
// Route::get('/adm/news/editar/{id}', 'Adm\NewsController@edit')->name('news-editar');
// Route::post('/adm/news/edited/{id}', 'Adm\NewsController@update')->name('news-update');
// Route::get('/adm/news/search/', 'Adm\NewsController@search');
// Route::get('/adm/news/delete/{id}', 'Adm\NewsController@destroy')->name('news-delete');
// Route::get('/adm/news/excel/', 'Adm\NewsController@excel');

// // Google Routes
// Route::resource('/adm/tags/', 'Adm\GoogleController');
// Route::get('/adm/tags/editar/{id}', 'Adm\GoogleController@edit')->name('google-editar');
// Route::post('/adm/tags/edited/{id}', 'Adm\GoogleController@update')->name('google-update');
// Route::get('/adm/tags/delete/{id}', 'Adm\GoogleController@destroy')->name('google-delete');

// // Acompanhe Routes
// Route::resource('/adm/seo/', 'Adm\SeoController');
// Route::post('adm/seo/upload/','Adm\SeoController@upload')->name('seo-upload');


// // UserDados
// Route::get('/adm/dados-usuario/', 'Adm\UserController@index');
// Route::post('/adm/dados-usuario/update/{id}','Adm\UserController@submit');

/*
|--------------------------------------------------------------------------
| Website Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'HomeController@index');
Route::post('/home', 'HomeController@news')->name('home-formulario-enviado');

// Route::resource("/termos","LGPD\TermosController");
// Route::post("/termos","LGPD\TermosController@submit")->name("termos-submit");

// Route::get('/contato', 'ContatoController@index')->name('contato');
// Route::post('/contato/create','ContatoController@create')->name('contato-create');
