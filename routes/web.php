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
    return view('chat');
});

Route::get('/test', function () {

	// $arr = array(
	// 	'1' => 'qwe',
	// 	'2' => 'qwe',
	// 	'3' => 'qwe',
	// 	'4' => 'qwe',
	// 	'5' => 'qwe',
	// 	'6' => 'qwe',
	// 	'7' => 'qwe',
	// 	'8' => 'qwe',
	// 	'9' => 'qwe',
	// 	'10' => 'qwe',
	// 	'11' => 'qwe',
	// );
 //    return view('test', ['arr'=>$arr]);
});

Route::get('/room', function () {
    return view('room');
});

Route::get('/room/{room}', "MessagesController@GetMessages");

Route::get('/dialog', 'DialogsController@getDialog');

Route::get('/users', 'UsersController@GetUsers');

Route::get('/search', 'UsersController@GetAllUsers');

Route::get('/friends', 'FriendsController@index');

Route::post('/request_out', 'FriendsController@request_out');

Route::post('/friends_list', 'FriendsController@friends_list');

Route::post('/acceptFriend', 'FriendsController@acceptFriend');

Route::post('/request_in', 'FriendsController@request_in');

Route::post('/deleteRequest', 'UsersController@deleteRequest');

Route::post('/search_people', 'UsersController@GetUsersForSearch');

Route::post('/delFriend', 'UsersController@DeleteFriend');

Route::post('/addToFriend', 'UsersController@AddFriends');

Route::get('/groups', 'GroupsController@index')->name('home');

Route::post('/add_to_groupe', 'GroupsController@add_to_groupe');

Route::post('/del_to_groupe', 'GroupsController@del_to_groupe');

Route::post('/get_list_for_groupe', 'GroupsController@get_list_for_groupe');

Route::post('/get_alllist_for_groupe', 'GroupsController@get_alllist_for_groupe');

Route::post('/friends_list_for_groupe', 'FriendsController@get_friends_list_for_groupe');

Route::get('/group/{group}', 'GroupsController@view');

Route::get('/groups_create', 'GroupsController@create');

Route::post('/groups_add', 'GroupsController@add')->name('groups_add');

Route::post('/privat_mess', 'MessagesController@sendMessage');

Route::post('/serchByEmail', 'NotAuthController@searchByEmail');

Route::post('/sendMail', 'MailController@sendRequest');

Route::post('/getListBuys', 'BuysController@index');

Route::post('/addBuy', 'BuysController@addBuy');

Route::post('/setPayUsers', 'BuysController@SetPayUsers');

Route::post('/add_products', 'ProductsController@addProducts');

Route::post('/get_products', 'ProductsController@getProducts');

Route::post('/setStatusProd', 'ProductsController@setStatusProd');

Route::post('/get_users_to_products', 'ProductsController@GetListUsersToProducts');

Route::post('/setPay', 'GroupsController@setPay');

// Route::post('privat_mess', function(Illuminate\Http\Request $request) {
	// App\Events\PrivateChat::dispatch($request->all());
// });

Route::post('new_massage', function(Illuminate\Http\Request $request) {
	App\Events\NewMessage::dispatch($request->all());
});

Route::post('messages', function(Illuminate\Http\Request $request) {

	App\Events\Message::dispatch($request->all());
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
