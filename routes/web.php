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
Auth::routes(['verify' => true]);

Route::any('verify', 'Auth\\LoginController@verify')->name('login.verify');

Route::get('/', 'IndexController@index');
Route::get('/auto/investor', 'IndexController@investor')->name('auto.investor');
Route::get('/auto/client', 'IndexController@client')->name('auto.client');
Route::get('/auto/mail', 'IndexController@mail')->name('auto.client');
Route::get('/auto/transaction', 'IndexController@transaction')->name('auto.transaction');
Route::get('/auto/transdata', 'IndexController@transdata')->name('auto.transdata');
Route::get('/auto/confirm', 'ClientController@confirm_transaction')->name('auto.confirm');
Route::get('/auto/deposit', 'ClientController@confirm_deposit')->name('auto.deposit');

Route::get('/client/dashboard/{client}', 'HomeController@clientDashboard')->name('client.dashboard');
Route::post('password/change', 'ProfileController@changePassword')->name('password.change');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::post('/profile', 'ProfileController@update')->name('profile.update');
Route::any('/clients/{client}', 'ClientController@index')->name('client');
Route::post('/clients/{client}/transaction', 'ClientController@transaction')->name('transaction');
Route::any('/client/{client}/referral', 'ClientController@referral')->name('referral');
Route::any('/client/{client}/deposit', 'ClientController@deposit')->name('mind.deposit');
Route::any('/client/{client}/deposits', 'ClientController@deposits')->name('mind.deposits');
Route::any('/client/{client}/withdraw', 'ClientController@withdraw')->name('mind.withdraw');
Route::post('/profit', 'ClientController@profit')->name('profit');
Route::post('/auto_profit', 'ClientController@auto_profit')->name('auto_profit');
Route::get('/auto/profit_post', 'ClientController@auto_profit_post')->name('auto_profit_post');
Route::post('/ticket/{client}', 'ClientController@openTicket')->name('client.ticket');
Route::post('/client/mark/investment/{transaction}', 'ClientController@markTransaction')->name('mark');

Route::get('reports/{name?}', 'ReportController@report')->name('report');
Route::any('system/{section?}', 'Admin\\SupportController@index')->name('support');
Route::any('mailbox', 'Admin\\SupportController@mailbox')->name('mailbox');

Route::any('support/{action?}', 'SupportTicketController@index')->name('support.ticket');
Route::any('helpdesk/{action?}', 'Admin\\TicketController@index')->name('support.resolution');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/realtime','ClientController@realtime');   
Route::get('/deposit_status/{id}', 'ClientController@deposit_status')->name('deposit_status');