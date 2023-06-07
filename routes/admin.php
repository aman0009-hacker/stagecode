Route::get('custom-page', function () {
    return view('admin.custom-page');
});

<!-- Route::get('custom-form/{id}', 'App\Admin\Controllers\CustomPageController@customForm')->name('custom-form'); -->

<!-- Route::get('auth/attachments', 'App\Admin\Controllers\AttachmentController@index')->name('auth.attachments'); -->