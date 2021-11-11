<?php
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin'], function () {
// Blogscomments
    Route::post('blogscomments/media', 'BlogscommentsApiController@storeMedia')->name('blogscomments.storeMedia');
    Route::apiResource('blogscomments', 'BlogscommentsApiController');
});
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Faq Categories
    Route::apiResource('faq-categories', 'FaqCategoryApiController');

    // Faq Questions
    Route::apiResource('faq-questions', 'FaqQuestionApiController');

    // Payments
    Route::apiResource('payments', 'PaymentApiController', ['except' => ['store', 'update', 'destroy']]);
    // Home Page Slider
    Route::post('home-page-sliders/media', 'HomePageSliderApiController@storeMedia')->name('home-page-sliders.storeMedia');
    Route::apiResource('home-page-sliders', 'HomePageSliderApiController');

    // Snippet
    Route::post('snippets/media', 'SnippetApiController@storeMedia')->name('snippets.storeMedia');
    Route::apiResource('snippets', 'SnippetApiController');

    // Founders
    Route::post('founders/media', 'FoundersApiController@storeMedia')->name('founders.storeMedia');
    Route::apiResource('founders', 'FoundersApiController');

    // Coming Soon
    Route::post('coming-soons/media', 'ComingSoonApiController@storeMedia')->name('coming-soons.storeMedia');
    Route::apiResource('coming-soons', 'ComingSoonApiController');

    // Enquiries
    Route::apiResource('enquiries', 'EnquiriesApiController', ['except' => ['store', 'update']]);
    // Blogs
    Route::post('blogs/media', 'BlogsApiController@storeMedia')->name('blogs.storeMedia');
    Route::apiResource('blogs', 'BlogsApiController');

    // Jobs
    Route::post('jobs/media', 'JobsApiController@storeMedia')->name('jobs.storeMedia');
    Route::apiResource('jobs', 'JobsApiController');

    // Job Applications
    Route::post('job-applications/media', 'JobApplicationsApiController@storeMedia')->name('job-applications.storeMedia');
    Route::apiResource('job-applications', 'JobApplicationsApiController');
});
