<?php

use App\User;



Route::get('/', [
	'as'=> 'index',
    'uses'=> 'auth\AuthController@index'
]);


Route::group(['prefix'=> 'guest'], function(){

	Route::get('/rooms', [
	'as'=> 'rooms',
	'uses'=> 'auth\AuthController@rooms'
	]);

	Route::get('/amenities', [
		'as'=> 'amenities',
		'uses'=> 'auth\AuthController@amenities'
	]);
		

	Route::get('/tariff', [
		'as'=> 'tariff',
		'uses'=> 'auth\AuthController@tariff'
	]);

	Route::post('/category-rooms', [
		'as'=> 'get_rooms',
		'uses'=> 'auth\AuthController@get_rooms'
	]);

	

        
});

Route::group(['prefix'=> 'auth'], function(){

		Route::get('/login', [
			'as'=> 'login',
			'uses'=> 'auth\AuthController@login'
		]);

		Route::post('/login', [
			'as'=> 'loginCheck',
			'uses'=> 'auth\AuthController@loginCheck'
		]);

		Route::get('/register', [
			'as'=> 'register',
			'uses'=> 'auth\AuthController@register'
		]);

		Route::post('/register',[
			'as'=> 'registerCheck',
			'uses'=> 'auth\AuthController@registerCheck'
		]);
		
});

Route::group(['prefix'=> 'receptionist'], function(){
		Route::get('/main', [
			'as'=> 'recept_main',
			'uses'=> 'recept\ReceptController@recept_main'
		]);
});



Route::group(['prefix'=> 'user'], function(){
	Route::get('/book', [
		'as'=> 'tambook',
		'uses'=>'user\UserController@tambook'
	]);

	Route::post('/bookNow/{id}', [
		'as'=> 'book_now',
		'uses'=> 'user\UserController@book_now'
	]);

	Route::get('/logout', [
		'as'=> 'customer_logout',
		'uses'=> 'user\UserController@customer_logout'
	]);

	Route::get('/activity', [
		'as'=> 'customer_activity',
		'uses'=> 'user\UserController@customer_activity'
	]);
		Route::get('/activity/{id}', [
			'as'=> 'customer_activity_view',
			'uses'=> 'user\UserController@customer_activity_view'
		]);

		Route::post('/activity/{id}/payment', [
			'as'=> 'customer_payment',
			'uses'=> 'user\UserController@customer_payment'
		]);

	Route::get('/profile', [
		'as'=> 'customer_profile',
		'uses'=> 'user\UserController@customer_profile'
	]);

	Route::get('/settings', [
		'as'=> 'customer_setting',
		'uses'=> 'user\UserController@customer_setting'
	]);

		Route::post('/change_password', [
			'as'=> 'customer_password_change',
			'uses'=> 'user\UserController@customer_password_change'
		]);

		Route::post('/update-custoemr',[
			'as'=> 'customer_update_info',
			'uses'=> 'user\UserController@customer_update_info'
		]);


});

Route::group(['prefix'=> 'admin'], function(){

	


	Route::get('/main', [
		'as'=> 'admin_main',
		'uses'=> 'admin\AdminController@admin_main'
	]);


		Route::get('/reserve-view-modal/{id}', [
			'as'=> 'admin_reserve_view_modal',
			'uses'=> 'admin\AdminController@admin_reserve_view_modal'
		]);

		Route::get('/cancel/{id}', [
			'as'=> 'cancel',
			'uses'=> 'admin\AdminController@cancel'
		]);

		Route::get('/approve/{id}', [
			'as'=> 'approve',
			'uses'=> 'admin\AdminController@approve'
		]);

		Route::get('/info/{id}', [
			'as'=> 'info',
			'uses'=> 'admin\AdminController@info'
		]);

		Route::get('/set-check-in/{id}', [
			'as'=> 'admin_set_check_in',
			'uses'=> 'admin\AdminController@admin_set_check_in'
		]);

		Route::get('/set-check-out/{id}', [
			'as'=> 'admin_set_check_out',
			'uses'=> 'admin\AdminController@admin_set_check_out'
		]);

	Route::get('/rooms', [
		'as'=> 'admin_rooms',
		'uses'=> 'admin\AdminController@admin_rooms'
	]);
		Route::get('/room-create', [
			'as'=> 'admin_rooms_create',
			'uses'=> 'admin\AdminController@admin_rooms_create'
		]);

		Route::post('/room-create', [
			'as'=> 'admin_create_check',
			'uses'=> 'admin\AdminController@admin_create_check'
		]);

		Route::post('/room-in-category', [
			'as'=> 'admin_room_in_cat',
			'uses'=> 'admin\AdminController@admin_room_in_cat'
		]);


	Route::get('/reports', [
		'as'=> 'admin_reports',
		'uses'=> 'admin\AdminController@admin_reports'
	]);
		Route::get('/checkin', [
			'as'=> 'admin_checkin',
			'uses'=> 'admin\AdminController@admin_checkin'
		]);

		Route::get('/checkout', [
			'as'=> 'admin_checkout',
			'uses'=> 'admin\AdminController@admin_checkout'
		]);

		Route::get('/cancel', [
			'as'=> 'admin_cancel',
			'uses'=> 'admin\AdminController@admin_cancel'
		]);

		Route::get('/rate', [
			'as'=> 'admin_rate',
			'uses'=> 'admin\AdminController@admin_rate'
		]);
			Route::get('/rate-edit/{id}', [
				'as'=> 'admin_rate_edit',
				'uses'=> 'admin\AdminController@admin_rate_edit'
			]);

			Route::post('/rate-update/{id}', [
				'as'=> 'admin_rate_update',
				'uses'=> 'admin\AdminController@admin_rate_update'
			]);

			Route::get('/rate-delete/{id}', [
				'as'=> 'admin_rate_delete',
				'uses'=> 'admin\AdminController@admin_rate_delete'
			]);

		Route::get('/amenities', [
			'as'=> 'admin_amenities',
			'uses'=> 'admin\AdminController@admin_amenities'
		]);

			Route::get('/amenities-edit/{id}', [
				'as'=> 'admin_amenities_edit',
				'uses'=> 'admin\AdminController@admin_amenities_edit'
			]);

			Route::post('/amenities-update/{id}', [
				'as'=> 'admin_amenities_update',
				'uses'=> 'admin\AdminController@admin_amenities_update'
			]);

			Route::get('/amenities-delete/{id}', [
				'as'=> 'admin_amenities_delete',
				'uses'=> 'admin\AdminController@admin_amenities_delete'
			]);

			Route::post('/amenites-add-new',[
				'as'=> 'admin_add_amenities',
				'uses'=> 'admin\AdminController@admin_add_amenities'
			]);


	Route::get('/walk-in', [
		'as'=> 'admin_walkin',
		'uses'=> 'admin\AdminController@admin_walkin'
	]);	

		Route::get('/walk-in/{id}/{cat}', [
			'as'=> 'admin_walkin_cat',
			'uses'=> 'admin\AdminController@admin_walkin_cat'
		]);

		Route::get('/walk-in-book/{room_no}', [
			'as'=> 'admin_walkin_book',
			'uses'=> 'admin\AdminController@admin_walkin_book'
		]);

		Route::post('/walk-in-book-search/{room_no}', [
			'as'=> 'admin_walkin_book_search',
			'uses'=> 'admin\AdminController@admin_walkin_book_search'
		]);

		Route::get('/walk-inbook-now/{room_no}/{customer_id}', [
			'as'=> 'admin_walkin_boow_now',
			'uses'=> 'admin\AdminController@admin_walkin_boow_now'
		]);

		Route::post('/walk-in-new-account',[
			'as'=> 'admin_walkin_new',
			'uses'=> 'admin\AdminController@admin_walkin_new'
		]);

		Route::post('/walk-in-book-me/{room_no}/{customer_id}', [
			'as'=> 'admin_walk_me_yes',
			'uses'=> 'admin\AdminController@admin_walk_me_yes'
		]);

	Route::get('/record', [
		'as'=> 'admin_record',
		'uses'=> 'admin\AdminController@admin_record'
	]);

	Route::get('/users', [
		'as'=> 'admin_users',
		'uses'=> 'admin\AdminController@admin_users'
	]);	
		Route::get('/customer-users',[
			'as'=> 'admin_customers',
			'uses'=> 'admin\AdminController@admin_customers'
		]);

		Route::post('/new-users', [
			'as'=> 'admin_new_user',
			'uses'=> 'admin\AdminController@admin_new_user'
		]);

		Route::get('/user-lock/{id}', [
			'as'=> 'admin_user_lock',
			'uses'=> 'admin\AdminController@admin_user_lock'
		]);

		Route::get('/admin-lock/{id}', [
			'as'=> 'admin_lock_me',
			'uses'=> 'admin\AdminController@admin_lock_me'
		]);

	Route::get('/setting', [
		'as'=> 'admin_settings',
		'uses'=> 'admin\AdminController@admin_settings'
	]);

		Route::post('/setting_change',[
			'as'=> 'admin_password_change',
			'uses'=> 'admin\AdminController@admin_password_change'
		]);

	Route::get('/profile', [
		'as'=> 'admin_profile',
		'uses'=> 'admin\AdminController@admin_profile'
	]);	

	Route::get('/logout', [
			'as'=> 'logout',
			'uses'=> 'admin\AdminController@logout'
		]);

	Route::get('/new-customer-twin-hotel', [
		'as'=> 'admin_new_customer_twin',
		'uses'=> 'admin\AdminController@admin_new_customer_twin'
	]);

	Route::get('/new-admin-user', [
		'as'=> 'admin_new_me',
		'uses'=> 'admin\AdminController@admin_new_me'
	]);

	Route::get('/walk-room-check-in-view/{id}', [
		'as'=> 'admin_walk_checkin_view',
		'uses'=> 'admin\AdminController@admin_walk_checkin_view'
	]);
});


// Route::get('/addUser', function(){
// 	$user = new User;
// 	$user->fname = 'Morls';
// 	$user->lname = 'Karim';
// 	$user->username = 'recept123';
// 	$user->email = 'admin1233@yahoo.com';
// 	$user->password = bcrypt('admin123');
// 	$user->role_id = '3';
// 	$user->contact = "12321321";
// 	$user->save();
// });