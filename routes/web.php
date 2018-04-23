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

#Filter by type
Route::get('/events/type/{type}', function($type) {

    $events = App\Event::where('type', $type)->paginate(24);

    return view('events.index', compact('events'));
});


#Events
Route::resource('events', 'EventController');

#Toggle favorite event
Route::post('events/{event}/favorites', 'FavoriteController@store');
Route::delete('events/{event}/favorites', 'FavoriteController@destroy');

#Toggle favorite reply
Route::post('replies/{reply}/favorites', 'FavoriteReplyController@store');
Route::delete('replies/{reply}/favorites', 'FavoriteReplyController@destroy');

#Photo
Route::post('events/{event}/photos', 'PhotoController@store')->name('photos.store');
Route::delete('photos/{photo}', 'PhotoController@destroy')->name('photos.destroy');


#Replies
Route::post('/events/{event}/replies','ReplyController@store')->name('reply.store');
Route::delete('/replies/{reply}','ReplyController@destroy')->name('reply.destroy');
Route::patch('/replies/{reply}','ReplyController@update')->name('reply.update');
