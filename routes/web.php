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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

use App\User;
use App\Notifications\OrderShipped;

Route::get('/send-notification', function(){

    $users = User::all();

    Notification::send($users, new OrderShipped());

    return "Mail sent!";
});

Route::get('/send-guest', function(){

    Notification::route('mail', 'guest@example.com')->notify(new OrderShipped());

    return "Guest mail sent!";
});

Route::get('/send-sms', function(){
    $user = User::find(1);
    $user->notify(new OrderShipped());
    return "SMS sent!";
});

Route::get('/send-telegram', function(){
    $user = User::find(1);
    $user->notify(new OrderShipped());
    return "Telegram message sent!";
});

