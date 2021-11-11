<?php

Route::redirect('/', '/homepage');
Route::get('/homepage', 'HomeController@index')->name('site-home');
Route::get('/content/{slug}', 'HomeController@pageContent')->name('pageContent');
Route::get('/contact-us', 'HomeController@contactUs')->name('contactUs');

Route::get('/join-us', 'HomeController@joinUs')->name('joinUs');
Route::post('/join_create', 'HomeController@join_create')->name('join_create');

Route::get('/blogs/{category_id}', 'BlogsController@index');
Route::get('/blogs/view/{article_id}', 'BlogsController@view');

Route::post('/enquiry_create', 'HomeController@enquiry_create')->name('enquiry_create');

Route::post('/comment_create', 'BlogsController@comment_create')->name('comment_create');

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});
Route::post('job-applications/media', 'JobApplicationsController@storeMedia')->name('job-applications.storeMedia');
Route::post('job-applications/ckmedia', 'JobApplicationsController@storeCKEditorImages')->name('job-applications.storeCKEditorImages');
Route::get('job-applications', 'JobApplicationsController@create');

Auth::routes();

// Route::get('/{lang}', function ($lang) {
//     App::setlocale($lang);
//     return view('home');
// });


Route::get('/register', function () {
    return redirect("/en/register");
});

Route::group([
        'prefix' => '{locale}', 
        'where' => ['locale' => '[a-zA-Z]{2}'],
        // 'middleware' => 'localization'
    ], function($locale) {
        Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'Auth\RegisterController@register');
    }
);











// KG 27/01 Start
Route::get('/events-registeration', 'Auth\RegisterController@eventsRegisteration')->name('eventsRegisteration');
Route::post('/eventsRegisterationSave', 'Auth\RegisterController@register')->name('eventsRegisterationSave');
// KG 27/01 ENd
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
// Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => []], function () {
    Route::post('/users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('/approval', 'ApprovalController@index')->name('users.approval');
    Route::post('/installment', 'ApprovalController@installment')->name('users.installment');
    Route::post('/disapproval', 'ApprovalController@finaldisapproval')->name('users.disapproval');

    // Ajax on system emails
    
    Route::post('/system-emails-search', 'SystemEmailsController@search')->name('system-emails.search');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/verify', 'UsersController@verify')->name('users.verify');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');
    // Lectures
    Route::delete('lectures/destroy', 'LecturesController@massDestroy')->name('lectures.massDestroy');
    Route::post('lectures/media', 'LecturesController@storeMedia')->name('lectures.storeMedia');
    Route::post('lectures/ckmedia', 'LecturesController@storeCKEditorImages')->name('lectures.storeCKEditorImages');
    Route::resource('lectures', 'LecturesController');

    // SystemEmails
    Route::delete('system-emails/destroy', 'SystemEmailsController@massDestroy')->name('system-emails.massDestroy');
    Route::post('system-emails/media', 'SystemEmailsController@storeMedia')->name('system-emails.storeMedia');
    Route::post('system-emails/ckmedia', 'SystemEmailsController@storeCKEditorImages')->name('system-emails.storeCKEditorImages');
    Route::resource('system-emails', 'SystemEmailsController');

    // UserLogs
    Route::delete('user-logs/destroy', 'UserLogsController@massDestroy')->name('user-logs.massDestroy');
    Route::post('user-logs/media', 'UserLogsController@storeMedia')->name('user-logs.storeMedia');
    Route::post('user-logs/ckmedia', 'UserLogsController@storeCKEditorImages')->name('user-logs.storeCKEditorImages');
    Route::resource('user-logs', 'UserLogsController');


    // Route::get('system-emails/testmail', 'SystemEmailsController@testmail')->name('system-emails.testmail');
    Route::get('testmail2', 'SystemEmailsController@testmail')->name('system-emails.testmail');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Faq Categories
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Questions
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Payments
    Route::resource('payments', 'PaymentController', ['except' => ['destroy']]);
    Route::get('lectures-payments', 'PaymentController@lectures')->name('payments.lectures');

    // Pay Nows
    Route::get('store-payments', 'PaymentController@add')->name('payments.add-store');
    Route::get('payment/cancel', 'PaymentController@cancel')->name('payments.cancel');
    Route::get('payment/error', 'PaymentController@error')->name('payments.error');
    Route::post('pay-nows', 'PayNowController@index');
   // Route::resource('pay-nows', 'PayNowController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('unpaid/send-email', 'UnpaidApplicantsController@index')->name('unpaid.send');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');

    Route::get('binding-student', 'bindingController@index')->name('student.binding');
    Route::get('Unchecked-student', 'UncheckedController@index')->name('student.Unchecked');
    Route::get('withdrawal-student', 'withdrawalController@index')->name('student.withdrawal');
    Route::get('approved-student', 'approvedController@index')->name('student.approved');
    Route::get('disapproved-student', 'disapprovedController@index')->name('student.disapproved');
    Route::get('Unverified-student', 'UnverifiedController@index')->name('student.Unverified');

    Route::get('Unchecked-visitor', 'UncheckedController@visitors')->name('visitor.Unchecked');
    Route::get('approved-visitor', 'approvedController@visitors')->name('visitor.approved');
    Route::get('Unverified-visitor', 'UnverifiedController@visitors')->name('visitor.Unverified');

    // KG Start
    Route::get('payment', 'PaypalController@index');
    Route::post('charge', 'PaypalController@charge');
    Route::get('paymentsuccess', 'PaypalController@payment_success');
    Route::get('paymenterror', 'PaypalController@payment_error');
    // KG End
    // Programmes
    Route::delete('programmes/destroy', 'ProgrammesController@massDestroy')->name('programmes.massDestroy');
    Route::resource('programmes', 'ProgrammesController');

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');
    // Home Page Slider
    Route::delete('home-page-sliders/destroy', 'HomePageSliderController@massDestroy')->name('home-page-sliders.massDestroy');
    Route::post('home-page-sliders/media', 'HomePageSliderController@storeMedia')->name('home-page-sliders.storeMedia');
    Route::post('home-page-sliders/ckmedia', 'HomePageSliderController@storeCKEditorImages')->name('home-page-sliders.storeCKEditorImages');
    Route::resource('home-page-sliders', 'HomePageSliderController');

    // Snippet
    Route::delete('snippets/destroy', 'SnippetController@massDestroy')->name('snippets.massDestroy');
    Route::post('snippets/media', 'SnippetController@storeMedia')->name('snippets.storeMedia');
    Route::post('snippets/ckmedia', 'SnippetController@storeCKEditorImages')->name('snippets.storeCKEditorImages');
    Route::resource('snippets', 'SnippetController');

    // Founders
    Route::delete('founders/destroy', 'FoundersController@massDestroy')->name('founders.massDestroy');
    Route::post('founders/media', 'FoundersController@storeMedia')->name('founders.storeMedia');
    Route::post('founders/ckmedia', 'FoundersController@storeCKEditorImages')->name('founders.storeCKEditorImages');
    Route::resource('founders', 'FoundersController');

    // Coming Soon
    Route::delete('coming-soons/destroy', 'ComingSoonController@massDestroy')->name('coming-soons.massDestroy');
    Route::post('coming-soons/media', 'ComingSoonController@storeMedia')->name('coming-soons.storeMedia');
    Route::post('coming-soons/ckmedia', 'ComingSoonController@storeCKEditorImages')->name('coming-soons.storeCKEditorImages');
    Route::resource('coming-soons', 'ComingSoonController');

    // Enquiries
    Route::delete('enquiries/destroy', 'EnquiriesController@massDestroy')->name('enquiries.massDestroy');
    Route::resource('enquiries', 'EnquiriesController', ['except' => ['create', 'store', 'edit', 'update']]);

    // Blogs
    Route::delete('blogs/destroy', 'BlogsController@massDestroy')->name('blogs.massDestroy');
    Route::post('blogs/media', 'BlogsController@storeMedia')->name('blogs.storeMedia');
    Route::post('blogs/ckmedia', 'BlogsController@storeCKEditorImages')->name('blogs.storeCKEditorImages');
    Route::resource('blogs', 'BlogsController');
    // Blogscomments
    Route::delete('blogscomments/destroy', 'BlogscommentsController@massDestroy')->name('blogscomments.massDestroy');
    Route::post('blogscomments/media', 'BlogscommentsController@storeMedia')->name('blogscomments.storeMedia');
    Route::post('blogscomments/ckmedia', 'BlogscommentsController@storeCKEditorImages')->name('blogscomments.storeCKEditorImages');
    Route::resource('blogscomments', 'BlogscommentsController');
    // Jobs
    Route::delete('jobs/destroy', 'JobsController@massDestroy')->name('jobs.massDestroy');
    Route::post('jobs/media', 'JobsController@storeMedia')->name('jobs.storeMedia');
    Route::post('jobs/ckmedia', 'JobsController@storeCKEditorImages')->name('jobs.storeCKEditorImages');
    Route::resource('jobs', 'JobsController');

    // Job Applications
    Route::delete('job-applications/destroy', 'JobApplicationsController@massDestroy')->name('job-applications.massDestroy');
    Route::post('job-applications/media', 'JobApplicationsController@storeMedia')->name('job-applications.storeMedia');
    Route::post('job-applications/ckmedia', 'JobApplicationsController@storeCKEditorImages')->name('job-applications.storeCKEditorImages');
    Route::resource('job-applications', 'JobApplicationsController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
