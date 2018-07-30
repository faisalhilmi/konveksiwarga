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

Route::get('/', 'IndexController@index');

// Route::get('/login', function () {
//     return view('layouts.login');
// });

// Route::get('/admin/dashboard',function(){
// 	return view('layouts.layout');
// });
// Auth::routes();

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/admin/dashboard', 'HomeController@index');
Route::get('/admin/blogpost', function () {
    return view('admin.blogpost');
});

// Setting Banner
// Route::get('/admin/slider', 'SliderController@index');
Route::get('/admin/slider/getdata', ['as' => 'admin.slider.getdata', 'uses' => 'SliderController@getData']);
Route::get('/admin/slider', ['as' => 'admin.slider.index', 'uses' => 'SliderController@index']);
Route::get('/admin/slider/create',['as' => 'admin.slider.create', 'uses'=> 'SliderController@create']);
Route::get('/admin/slider/{id}',['as' => 'admin.slider.edit', 'uses'=> 'SliderController@edit']);
Route::patch('/admin/slider/{id}',['as' => 'admin.slider.update', 'uses'=> 'SliderController@update']);
Route::post('/admin/slider/store',['as' => 'admin.slider.store', 'uses'=> 'SliderController@store']);
Route::get('/admin/slider/{id}/delete',['as' => 'admin.slider.destroy', 'uses'=> 'SliderController@destroy']);
Route::get('/admin/slider/show/{id}',['as' => 'admin.slider.show', 'uses'=> 'SliderController@show']);

// Setting WelcomePage
// Route::get('/admin/welcome', 'WelcomeController@index');
Route::get('/admin/welcome/getdata', ['as' => 'admin.welcome.getdata', 'uses' => 'WelcomeController@getData']);
Route::get('/admin/welcomepage', ['as' => 'admin.welcome.index', 'uses' => 'WelcomeController@index']);
Route::get('/admin/welcome/create',['as' => 'admin.welcome.create', 'uses'=> 'WelcomeController@create']);
Route::get('/admin/welcome/{id}',['as' => 'admin.welcome.edit', 'uses'=> 'WelcomeController@edit']);
Route::patch('/admin/welcome/{id}',['as' => 'admin.welcome.update', 'uses'=> 'WelcomeController@update']);
Route::post('/admin/welcome/store',['as' => 'admin.welcome.store', 'uses'=> 'WelcomeController@store']);
Route::get('/admin/welcome/{id}/delete',['as' => 'admin.welcome.destroy', 'uses'=> 'WelcomeController@destroy']);
Route::get('/admin/welcome/show/{id}',['as' => 'admin.welcome.show', 'uses'=> 'WelcomeController@show']);

// Setting Recent Works
// Route::get('/admin/recentworks', 'RecentWorksController@index');
Route::get('/admin/lending/recentworks/getdata', ['as' => 'admin.recentworks.getdata', 'uses' => 'RecentWorksController@getData']);
Route::get('/admin/lending/recentworks', ['as' => 'admin.recentworks.index', 'uses' => 'RecentWorksController@index']);
Route::get('/admin/lending/recentworks/create',['as' => 'admin.recentworks.create', 'uses'=> 'RecentWorksController@create']);
Route::get('/admin/lending/recentworks/{id}',['as' => 'admin.recentworks.edit', 'uses'=> 'RecentWorksController@edit']);
Route::patch('/admin/lending/recentworks/{id}',['as' => 'admin.recentworks.update', 'uses'=> 'RecentWorksController@update']);
Route::post('/admin/lending/recentworks/store',['as' => 'admin.recentworks.store', 'uses'=> 'RecentWorksController@store']);
Route::get('/admin/lending/recentworks/{id}/delete',['as' => 'admin.recentworks.destroy', 'uses'=> 'RecentWorksController@destroy']);
Route::get('/admin/lending/recentworks/show/{id}',['as' => 'admin.recentworks.show', 'uses'=> 'RecentWorksController@show']);

// Setting Clients
// Route::get('/admin/client', 'ClientController@index');
Route::get('/admin/lending/client/getdata', ['as' => 'admin.client.getdata', 'uses' => 'ClientController@getData']);
Route::get('/admin/lending/client', ['as' => 'admin.client.index', 'uses' => 'ClientController@index']);
Route::get('/admin/lending/client/create',['as' => 'admin.client.create', 'uses'=> 'ClientController@create']);
Route::get('/admin/lending/client/{id}',['as' => 'admin.client.edit', 'uses'=> 'ClientController@edit']);
Route::patch('/admin/lending/client/{id}',['as' => 'admin.client.update', 'uses'=> 'ClientController@update']);
Route::post('/admin/lending/client/store',['as' => 'admin.client.store', 'uses'=> 'ClientController@store']);
Route::get('/admin/lending/client/{id}/delete',['as' => 'admin.client.destroy', 'uses'=> 'ClientController@destroy']);
Route::get('/admin/lending/client/show/{id}',['as' => 'admin.client.show', 'uses'=> 'ClientController@show']);

// Setting Testimoni
// Route::get('/admin/testimoni', 'TestimoniController@index');
Route::get('/admin/lending/testimoni/getdata', ['as' => 'admin.testimoni.getdata', 'uses' => 'TestimoniController@getData']);
Route::get('/admin/lending/testimoni', ['as' => 'admin.testimoni.index', 'uses' => 'TestimoniController@index']);
Route::get('/admin/lending/testimoni/create',['as' => 'admin.testimoni.create', 'uses'=> 'TestimoniController@create']);
Route::get('/admin/lending/testimoni/{id}',['as' => 'admin.testimoni.edit', 'uses'=> 'TestimoniController@edit']);
Route::patch('/admin/lending/testimoni/{id}',['as' => 'admin.testimoni.update', 'uses'=> 'TestimoniController@update']);
Route::post('/admin/lending/testimoni/store',['as' => 'admin.testimoni.store', 'uses'=> 'TestimoniController@store']);
Route::get('/admin/lending/testimoni/{id}/delete',['as' => 'admin.testimoni.destroy', 'uses'=> 'TestimoniController@destroy']);
Route::get('/admin/lending/testimoni/show/{id}',['as' => 'admin.testimoni.show', 'uses'=> 'TestimoniController@show']);

// Setting Social Media
// Route::get('/admin/socialmedia', 'SocialMediaController@index');
Route::get('/admin/lending/socialmedia/getdata', ['as' => 'admin.socialmedia.getdata', 'uses' => 'SocialMediaController@getData']);
Route::get('/admin/lending/socialmedia', ['as' => 'admin.socialmedia.index', 'uses' => 'SocialMediaController@index']);
Route::get('/admin/lending/socialmedia/create',['as' => 'admin.socialmedia.create', 'uses'=> 'SocialMediaController@create']);
Route::get('/admin/lending/socialmedia/{id}',['as' => 'admin.socialmedia.edit', 'uses'=> 'SocialMediaController@edit']);
Route::patch('/admin/lending/socialmedia/{id}',['as' => 'admin.socialmedia.update', 'uses'=> 'SocialMediaController@update']);
Route::post('/admin/lending/socialmedia/store',['as' => 'admin.socialmedia.store', 'uses'=> 'SocialMediaController@store']);
Route::get('/admin/lending/socialmedia/{id}/delete',['as' => 'admin.socialmedia.destroy', 'uses'=> 'SocialMediaController@destroy']);
Route::get('/admin/lending/socialmedia/show/{id}',['as' => 'admin.socialmedia.show', 'uses'=> 'SocialMediaController@show']);

// Setting About Us
// Route::get('/admin/aboutus', 'AboutUsController@index');
Route::get('/admin/lending/aboutus/getdata', ['as' => 'admin.aboutus.getdata', 'uses' => 'AboutUsController@getData']);
Route::get('/admin/lending/aboutus', ['as' => 'admin.aboutus.index', 'uses' => 'AboutUsController@index']);
Route::get('/admin/lending/aboutus/create',['as' => 'admin.aboutus.create', 'uses'=> 'AboutUsController@create']);
Route::get('/admin/lending/aboutus/{id}',['as' => 'admin.aboutus.edit', 'uses'=> 'AboutUsController@edit']);
Route::patch('/admin/lending/aboutus/{id}',['as' => 'admin.aboutus.update', 'uses'=> 'AboutUsController@update']);
Route::post('/admin/lending/aboutus/store',['as' => 'admin.aboutus.store', 'uses'=> 'AboutUsController@store']);
Route::get('/admin/lending/aboutus/{id}/delete',['as' => 'admin.aboutus.destroy', 'uses'=> 'AboutUsController@destroy']);
Route::get('/admin/lending/aboutus/show/{id}',['as' => 'admin.aboutus.show', 'uses'=> 'AboutUsController@show']);