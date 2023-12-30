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

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
	Route::get('/dashboard', 'HomeController@dashboard');
});

//Route::get('/forgot/password','HomeController@forgotPassword')->name('forgot.password');
Route::post('/forgot/password','HomeController@forgotPasswordStore')->name('forgot.password');
Route::post('/forgot/password/verify','HomeController@forgotPasswordCheckStore')->name('otp.verify.password');

Route::group(['middleware' => ['auth', 'active']], function() {

    Route::post('/logout', 'HomeController@logout')->name('logout');
    Route::get('/otp/screen', 'HomeController@otpCheck')->name('check.otp');
    Route::post('/otp/screen/store', 'HomeController@otpCheckStore')->name('check.otp.store');
    Route::get('/', 'HomeController@dashboard');
    Route::get('/home', 'HomeController@dashboard')->name('home');
    Route::get('/wp', 'HomeController@whatsapp');
    Route::get('/mmt', 'HomeController@mobileMoneyToken');
    Route::get('/mmr', 'HomeController@mobileMoneyRequest');
    Route::get('/mms', 'HomeController@mobileMoneyStatus');
    Route::get('/dashboard-filter/{start_date}/{end_date}', 'HomeController@dashboardFilter');
    Route::get('check-batch-availability/{product_id}/{batch_no}/{warehouse_id}', 'ProductController@checkBatchAvailability');

	Route::get('language_switch/{locale}', 'LanguageController@switchLanguage');

	Route::get('role/permission/{id}', 'RoleController@permission')->name('role.permission');
	Route::post('role/set_permission', 'RoleController@setPermission')->name('role.setPermission');
	Route::resource('role', 'RoleController');

	Route::get('user/profile/{id}', 'UserController@profile')->name('user.profile');
	Route::put('user/update_profile/{id}', 'UserController@profileUpdate')->name('user.profileUpdate');
	Route::put('user/changepass/{id}', 'UserController@changePassword')->name('user.password');
	Route::get('user/genpass', 'UserController@generatePassword');
	Route::post('user/deletebyselection', 'UserController@deleteBySelection');
	Route::resource('user','UserController');

	Route::get('setting/general_setting', 'SettingController@generalSetting')->name('setting.general');
	Route::post('setting/general_setting_store', 'SettingController@generalSettingStore')->name('setting.generalStore');
	Route::get('setting/general_setting/change-theme/{theme}', 'SettingController@changeTheme');
	Route::get('setting/sms_setting', 'SettingController@smsSetting')->name('setting.sms');
	Route::get('setting/createsms', 'SettingController@createSms')->name('setting.createSms');
	Route::post('setting/sendsms', 'SettingController@sendSms')->name('setting.sendSms');
	Route::post('setting/sms_setting_store', 'SettingController@smsSettingStore')->name('setting.smsStore');

	Route::get('expense_categories/gencode', 'ExpenseCategoryController@generateCode');
	Route::post('expense_categories/import', 'ExpenseCategoryController@import')->name('expense_category.import');
	Route::post('expense_categories/deletebyselection', 'ExpenseCategoryController@deleteBySelection');
	Route::resource('expense_categories', 'ExpenseCategoryController');

	Route::post('expenses/deletebyselection', 'ExpenseController@deleteBySelection');
	Route::resource('expenses', 'ExpenseController');
	Route::get('/expense/asset', 'ExpenseController@asset')->name('asset.expense');
	//accounting routes
	Route::get('accounts/make-default/{id}', 'AccountsController@makeDefault');
	Route::resource('accounts', 'AccountsController');
	//HRM routes
	Route::post('departments/deletebyselection', 'DepartmentController@deleteBySelection');
	Route::resource('departments', 'DepartmentController');

	Route::post('musician/deletebyselection', 'EmployeeController@deleteBySelection');
	Route::resource('musician', 'EmployeeController');
    Route::get('musician/gallery/{id}', 'EmployeeController@gallery')->name('musician.gallery');
    Route::get('musician/gallery/delete/{id}', 'EmployeeController@galleryDestroy')->name('musician.gallery.delete');
    Route::get('musician/gallery/edit/{id}', 'EmployeeController@galleryEdit')->name('musician.gallery.edit');
    Route::get('musician/gallery/update', 'EmployeeController@galleryUpload')->name('musician.gallery.update');
    Route::get('musician/upload/{id}', 'EmployeeController@upload')->name('musician.upload');
    Route::post('musician/upload/store', 'EmployeeController@uploadStore')->name('musician.file.store');
    Route::get('musician/votes/{id}', 'EmployeeController@votes')->name('musician.votes');


    Route::post('notifications/store', 'NotificationController@store')->name('notifications.store');
    Route::get('notifications/mark-as-read', 'NotificationController@markAsRead');

    Route::resource('currency', 'CurrencyController');

    Route::get('my-transactions/{year}/{month}', 'HomeController@myTransaction');


    Route::resource('votes', 'VoteController');
    Route::resource('tasks', 'TaskController');
    Route::get('tasks/index/monthly/{year}/{month}', 'TaskController@sheetMonthly')->name('tasks.index.monthly');
    Route::resource('mission', 'MissionController');
    Route::get('mission/approve/{id}/{status}', 'MissionController@approve')->name('mission.approve');
    Route::get('mission/print/{id}', 'MissionController@print')->name('mission.print');
    Route::get('clone', 'TaskController@clone')->name('clone');
    Route::resource('task', 'ParentTaskController');
    Route::resource('workSheet', 'WorkSheetController');
    Route::resource('region', 'RegionController');
    Route::resource('project', 'ProjectController');
    Route::post('votes/deletebyselection', 'VoteController@deleteBySelection');
    Route::resource('judge', 'JudgeController');
    Route::resource('coins', 'CoinController');
    Route::post('coins/deletebyselection', 'CoinController@deleteBySelection');


    Route::get('timesheet/generate', 'TimesheetController@generate')->name('timesheet.generate');
    Route::post('timesheet/generate', 'TimesheetController@generateStore')->name('timesheet.generate');
    Route::get('timesheet/report', 'TimesheetController@index')->name('timesheet.report');
    Route::delete('timesheet/destroy/{id}', 'TimesheetController@destroy')->name('timesheet.destroy');
    Route::get('timesheet/approve/{id}', 'TimesheetController@approve')->name('timesheet.approve');
    Route::get('timesheet/sign/{id}', 'TimesheetController@sign')->name('timesheet.sign');
    Route::get('timesheet/show/{id}', 'TimesheetController@show')->name('timesheet.show');


    Route::get('user/role/{id}', 'UserController@userRole')->name('user.role');
    Route::get('voter/user', 'UserController@voter')->name('voter.index');

    Route::get('report/voting', 'ReportController@votingReport')->name('voting.report');


});

