<?php
Route::prefix('/admin')->group(function () {

    Route::post('ckeditor/image_upload', 'CKEditorController@upload')->name('upload');

    // ---------------------- Admin Guard Routes -------------------------
    Route::get('/',                 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('/login',                'Auth\Admin\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit',        'Auth\Admin\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout',               'Auth\Admin\AdminLoginController@adminLogout')->name('admin.logout');


    // ------------------- guard/ Middleware admin --------------------------
    Route::group(['middleware' => ['auth:admin', 'permission']], function () {

        // ------------------------------- Admin Profile -------------------------------

        Route::get('profile/{admin}',          'AdminController@profileView')->name('admin.profile');
        Route::put('profile/{admin}',          'AdminController@updateProfile')->name('admin.updateprofile');

        // ------------------Backend all portion------------------
        Route::namespace('Backend')->group(function () {
            // ------------------Role------------------
            Route::resource('role',            'RoleController');
            // ------------------Dominion------------------
            Route::resource('dominion',        'DominionController');
            // ------------------Process------------------
            Route::resource('process',         'ProcessController');
            // ------------------Permission------------------
            Route::resource('permission',       'PermissionController'); // ------------------Menu------------------
            Route::resource('menu',             'MenuController');
            Route::post('menuprocess',          'MenuController@menuProcess')->name('menu.processondominion');


            //------------------------------- Tour Crud -------------------------------
            Route::resource('tour',                 'TourController');
            //------------------------------- Type Crud -------------------------------
            Route::resource('type',                 'TypeController');
            //------------------------------- Gallery Crud -------------------------------
            Route::resource('gallery',               'GalleryController');
            Route::get('forceedit/gallery/{id}',     'GalleryController@forceEdit')->name('gallery.forceEdit');
            Route::post('forceedit/gallery/{id}',    'GalleryController@forceUpdate')->name('gallery.forceUpdate');

            Route::get('/position/gallery',         'GalleryController@position')->name('gallery.position');
            Route::post('/position/gallery',        'GalleryController@savePosition')->name('gallery.savePosition');

            //------------------------------- Category Crud -------------------------------
            Route::resource('category',             'CategoryController');

            //------------------------------- Duration Crud -------------------------------
            Route::resource('duration',             'DurationController');

            //------------------------------- Service Crud -------------------------------
            Route::resource('service',              'ServiceController');

            //------------------------------- Location Crud -------------------------------
            Route::resource('location',             'LocationController');

            //------------------------------- Destination Crud -------------------------------
            Route::resource('destination',           'DestinationController');

            //------------------------------- Activity Crud -------------------------------
            Route::resource('activity',              'ActivityController');

            //------------------------------- Site Settings Crud -------------------------------
            Route::resource('settings',              'SettingsController');

            //------------------------------- Pick up lcoation Crud -------------------------------
            Route::resource('pickuplocation',              'PickuplocationController');

            //------------------------------- Airport Crud -------------------------------
            Route::resource('airport',              'AirportController');
        });

        //------------------------------- Admin Crud -------------------------------
        Route::resource('admin',               'AdminController');
    });

    Route::group(['namespace' => 'Backend', 'middleware' => 'auth:admin'], function () {
        Route::post('galleyImage', 'GalleryController@deleteImage');
    });
});
