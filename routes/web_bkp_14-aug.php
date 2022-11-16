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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/signup', 'HomeController@signup')->name('signup');
Route::get('/user/verify/{token}', 'HomeController@verifyUser');
Route::post('/user/sendverification', 'HomeController@sendVerification');

Route::post('/subscribe-addon', 'SubscriptionController@createAddonPlan');
Route::post('/checkout', 'SubscriptionController@PostSubscribe');
// Route::get('/checkout', 'SubscriptionController@getSubscribe');
Route::post('/subscribe', 'SubscriptionController@createSubscribe');
Route::get('/cancel_subs', 'SubscriptionController@cancelSubscribe');

Route::post('stripe/webhook','WebhookStripeController@handleWebhook');

Route::get('/view-categories', 'CategoryController@index')->name('view-categories');
Route::get('/import-yelp-categories', 'Yelp@importCategoriesFromJsonFile')->name('import-yelp-categories');
Route::get('/import-yelp-businesslisting', 'Yelp@importBusinessList')->name('import-yelp-businesslisting');
Route::get('/import-yelp-business-reviews', 'Yelp@importAllBusinessReviews')->name('import-yelp-business-reviews');
Route::get('/searchLocation', 'HomeController@getSearchLocation');
Route::get('/searchCat', 'HomeController@getSearchCat');
Route::get('/searchCatgorySignup', 'HomeController@getSearchCatSignup');
Route::get('/searchBusinessSignup', 'HomeController@getSearchBusinessSignup');
Route::get('/search', 'BusinessListingController@getSearch');
Route::get('/business/{slug}', 'BusinessListingController@index');
Route::post('/search', 'BusinessListingController@getSearch');
Route::post('/searchCategory', 'BusinessListingController@searchCategoryList');
Route::post('/searchLocation', 'BusinessListingController@searchLocationList');
Route::post('/view-workinghours', 'BusinessListingController@viewWorkinghours');
Route::post('/signup', 'HomeController@postSignup');
Route::post('/login', 'Auth\LoginController@postLogin');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/privacy-policy', 'HomeController@privacyPolicy');
Route::get('/terms-of-service', 'HomeController@termsOfService');

Route::get('/business/user/signup', 'HomeController@businessSignup')->name('signup');
Route::get('/business/user/signup/{id}', 'HomeController@businessSignupSecond');
Route::get('/business/user/signup-third/{id}', 'HomeController@businessSignupThird');

Route::post('/business/user/signup/{id}', 'HomeController@businessSignupSecondPost');
Route::post('/business/user/signup', 'HomeController@businessPostSignup');
Route::post('/business/user/chkDuplicateAbn', 'HomeController@postDuplicateAbnView');





Route::post('/business/user/like', 'BusinessListingController@postBusinessLike');
Route::post('/business/user/unlike', 'BusinessListingController@postBusinessUnLike');
Route::post('/business/user/review', 'BusinessListingController@postBusinessReview');
Route::post('/business/user/share', 'BusinessListingController@shareSocialPost');

Route::post('/business/click/callusButton', 'BusinessListingController@callusButton');
Route::post('/business/click/emailusButton', 'BusinessListingController@emailusButton');
Route::post('/business/click/websiteButton', 'BusinessListingController@websiteButton');

Route::post('/search/click/callusButton', 'BusinessListingController@callusButtonSearch');
Route::post('/search/click/emailusButton', 'BusinessListingController@emailusButtonSearch');
Route::post('/search/click/websiteButton', 'BusinessListingController@websiteButtonSearch');


Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');
Route::get('/ignore-google', 'HomeController@ignoreGoogleContact')->name('ignore-google-import');

Route::get('auth/fb', 'Auth\LoginController@redirectToFacebook');
Route::get('auth/fb/callback', 'Auth\LoginController@handleFacebookCallback');


Route::get('auth/outlook', 'Auth\LoginController@outLookSingin');
Route::get('auth/outlook/callback', 'Auth\LoginController@handleOutlookCallback');
Route::get('get-outlook-contact', 'HomeController@importContactFromOutlook')->name('getOutlookContact');

Route::get('faq', 'HomeController@getFaq');
Route::get('getContact', 'HomeController@importContact')->name('getContact');
Route::get('user/reset-password/{token}', 'HomeController@getResetUserWithToken');
Route::post('user/reset-password/update', 'HomeController@postResetUser');

Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard')->middleware('auth');
Route::post('/user/change-password', 'DashboardController@changePassword')->middleware('auth');
Route::post('/user/forgot-password', 'DashboardController@forgotPassword');
Route::post('/user/sendquery', 'DashboardController@postSendQuery')->middleware('auth');
Route::post('/user/profile/update', 'DashboardController@postProfile')->middleware('auth');
Route::post('/user/remove-picture', 'DashboardController@removePicture')->middleware('auth');

Route::get('business/user/dashboard', 'DashboardController@businessDashboard')->name('business-dashboard')->middleware('auth');
Route::post('/business/user/info/update', 'DashboardController@businessPostInformation')->middleware('auth');
Route::post('/business/user/remove-picture', 'DashboardController@businessRemoveImage')->middleware('auth');
Route::post('/business/user/address/update', 'DashboardController@businessPostAddress')->middleware('auth');
Route::post('/business/user/about/update', 'DashboardController@businessPostAbout')->middleware('auth');
Route::post('/business/user/service/update', 'DashboardController@businessPostService')->middleware('auth');
Route::post('/business/user/photo/update', 'DashboardController@businessPostPhoto')->middleware('auth');
Route::post('/business/user/certificates/update', 'DashboardController@businessPostCertificates')->middleware('auth');
Route::post('/business/user/remove-business-photo', 'DashboardController@businessRemovePhoto')->middleware('auth');
Route::post('/business/user/remove-business-certificate', 'DashboardController@businessRemoveCertificate')->middleware('auth');
Route::post('/business/user/change-password', 'DashboardController@businessUserChangePassword')->middleware('auth');
Route::post('/business/user/sendquery', 'DashboardController@businesspostSendQuery')->middleware('auth');

Route::post('/business/user/imageUpload', 'DashboardController@imageUpload')->middleware('auth');
Route::post('/business/user/certificateUpload', 'DashboardController@certificateUpload')->middleware('auth');
Route::post('/business/user/imageRemove', 'DashboardController@imageRemove')->middleware('auth');
Route::post('/business/user/imageCertificateRemove', 'DashboardController@imageCertificateRemove')->middleware('auth');

Route::post('save-review', 'DashboardController@saveReview')->name('save_review')->middleware('auth');
Route::post('save-facebook-review', 'DashboardController@saveFacebookReview')->name('save_facebook_review')->middleware('auth');


Route::post('newsletter/subscribe', 'HomeController@SubscibeNewsletter');

Route::get('help', 'HomeController@getHelp');
Route::get('about-us', 'HomeController@getAboutus');
Route::get('contact-us', 'HomeController@getContactUs');
Route::get('/page/{slug}', 'HomeController@getPages');

Route::post('/business-listing/chkStates', 'HomeController@postStatesView');
Route::post('/user/profile/image/update', 'DashboardController@postProfileImageUpdate');

Route::get('glogin',array('as'=>'glogin','uses'=>'UserController@googleLogin')) ;
Route::get('glist',array('as'=>'glist','uses'=>'UserController@listGoogleUser')) ;

Route::get('/import-trust-categories', 'TrustPilot@importCategoryList')->name('import-trust-categories');
Route::get('/import-trust-businesslisting', 'TrustPilot@importBusinessList')->name('import-trust-businesslisting');
Route::get('/import-trust-business-reviews', 'TrustPilot@importAllBusinessReviews')->name('import-trust-business-reviews');

Route::group(['prefix'=>'admin','as'=>'admin'], function(){
	//Login route
	Route::get('/', 'UserController@index');
    Route::get('/login', 'UserController@index');
    Route::post('/login', 'UserController@loginPost');
	Route::get('/logout', 'UserController@logout');
    Route::get('/dashboard', 'Backend\DashboardController@dashboard')->middleware('admin');
	//Category route
	Route::get('/categories', 'Backend\CategoryController@index')->middleware('admin');
	Route::get('/category/add', 'Backend\CategoryController@create')->middleware('admin');
	Route::get('/category/edit/{id}', 'Backend\CategoryController@edit')->middleware('admin');
	Route::get('/category/delete/{id}', 'Backend\CategoryController@destroy')->middleware('admin');
	Route::post('/category/add', 'Backend\CategoryController@store')->middleware('admin');
	Route::post('/category/edit/{id}', 'Backend\CategoryController@update')->middleware('admin');
	Route::post('/categories/map', 'Backend\CategoryController@getMapCategory')->middleware('admin');
	Route::post('/categories/saveMapCategory', 'Backend\CategoryController@saveMapCategory')->middleware('admin');
	Route::post('/categories/map/view', 'Backend\CategoryController@displayMapCategory')->middleware('admin');
	Route::post('/categories/map/delete', 'Backend\CategoryController@deleteMapCategory')->middleware('admin');
	
	//business Listing route
	Route::get('/business-listing', 'Backend\BusinessListingController@index')->middleware('admin');
	Route::get('/business-listing/add', 'Backend\BusinessListingController@create')->middleware('admin');
	Route::get('/business-listing/edit/{id}', 'Backend\BusinessListingController@edit')->middleware('admin');
	Route::post('/business-listing/edit/{id}', 'Backend\BusinessListingController@update')->middleware('admin');
	Route::post('/business-listing/add', 'Backend\BusinessListingController@store')->middleware('admin');
	Route::post('/business-listing/chkStates', 'Backend\BusinessListingController@postStatesView')->middleware('admin');
	Route::post('/business-listing/chkDuplicateAbn', 'Backend\BusinessListingController@postDuplicateAbnView')->middleware('admin');
	Route::get('/business-listing/delete/{id}', 'Backend\BusinessListingController@destroy')->middleware('admin');
	Route::get('/business-listing/view/{id}', 'Backend\BusinessListingController@show')->middleware('admin');
	Route::post('/business-listing/imageUpload', 'Backend\BusinessListingController@imageUpload')->middleware('admin');
	Route::post('/business-listing/certificateUpload', 'Backend\BusinessListingController@certificateUpload')->middleware('admin');
	Route::post('/business-listing/imageRemove', 'Backend\BusinessListingController@imageRemove')->middleware('admin');
	Route::post('/business-listing/imageCertificateRemove', 'Backend\BusinessListingController@imageCertificateRemove')->middleware('admin');
	Route::post('/business-listing/showOnHomePage', 'Backend\BusinessListingController@showOnHomePage')->middleware('admin');
	
	//business category route
	
	Route::get('/business-categories', 'Backend\BusinessListingCategoryController@index')->middleware('admin');
	Route::get('/business-category/delete/{id}', 'Backend\BusinessListingCategoryController@destroy')->middleware('admin');
	//business review route
	
	Route::get('/business-review', 'Backend\BusinessListReviewController@index')->middleware('admin');
	Route::get('/business-review/add', 'Backend\BusinessListReviewController@create')->middleware('admin');
	Route::get('/business-review/edit/{id}', 'Backend\BusinessListReviewController@edit')->middleware('admin');
	Route::get('/business-review/delete/{id}', 'Backend\BusinessListReviewController@destroy')->middleware('admin');
	Route::post('/business-review/add', 'Backend\BusinessListReviewController@create')->middleware('admin');
	Route::get('/business-review/edit/{id}', 'Backend\BusinessListReviewController@update')->middleware('admin');
	Route::post('/business-review/change-status', 'Backend\BusinessListReviewController@statusChange')->middleware('admin');
	
	//User Route
	Route::get('/users', 'Backend\UserController@index')->middleware('admin');
	Route::get('/users/enquiry', 'Backend\UserController@getUserEnquiry')->middleware('admin');
	Route::get('/users/contacts', 'Backend\UserController@getUserContacts')->middleware('admin');
	Route::get('/users/edit/{id}', 'Backend\UserController@edit')->middleware('admin');
	Route::get('/users/delete/{id}', 'Backend\UserController@deleteUser')->middleware('admin');
	Route::get('/users/enquiry/delete/{id}', 'Backend\UserController@deleteUserEnquiry')->middleware('admin');
	Route::get('/users/enquiry/view/{id}', 'Backend\UserController@viewUserEnquiry')->middleware('admin');
	Route::post('/users/edit/{id}', 'Backend\UserController@update')->middleware('admin');
	
	//Staff Route
	Route::get('/staff', 'Backend\StaffController@index')->middleware('admin');
	Route::get('/staff/add', 'Backend\StaffController@create')->middleware('admin');
	Route::get('/staff/edit/{id}', 'Backend\StaffController@edit')->middleware('admin');
	Route::get('/staff/delete/{id}', 'Backend\StaffController@destroy')->middleware('admin');
	Route::get('/staff/profile', 'Backend\StaffController@profile')->middleware('admin');
	Route::get('/staff/change-password', 'Backend\StaffController@changePassword')->middleware('admin');
	Route::get('/staff/role', 'Backend\StaffController@role')->middleware('admin');
	Route::get('/staff/role/add', 'Backend\StaffController@roleAdd')->middleware('admin');
	Route::get('/staff/role/edit/{id}', 'Backend\StaffController@roleEdit')->middleware('admin');
	Route::get('/staff/role/delete/{id}', 'Backend\StaffController@roleDelete')->middleware('admin');
	Route::post('/staff/role/add', 'Backend\StaffController@postRole')->middleware('admin');
	Route::post('/staff/role/edit/{id}', 'Backend\StaffController@postRoleEdit')->middleware('admin');
	Route::post('/staff/add', 'Backend\StaffController@store')->middleware('admin');
	Route::post('/staff/edit/{id}', 'Backend\StaffController@update')->middleware('admin');
	Route::post('/staff/profile/update', 'Backend\StaffController@profileUpdate')->middleware('admin');
	Route::post('/staff/changepassword', 'Backend\StaffController@passwordUpdate')->middleware('admin');
	
	//Faq Route
	Route::get('/users/faq', 'Backend\FaqController@index')->middleware('admin');
	Route::get('/users/faq/add', 'Backend\FaqController@create')->middleware('admin');
	Route::get('/users/faq/edit/{id}', 'Backend\FaqController@edit')->middleware('admin');
	Route::get('/users/faq/view/{id}', 'Backend\FaqController@show')->middleware('admin');
	Route::get('/users/faq/delete/{id}', 'Backend\FaqController@destroy')->middleware('admin');
	Route::post('/users/faq/add', 'Backend\FaqController@store')->middleware('admin');
	Route::post('/users/faq/edit/{id}', 'Backend\FaqController@update')->middleware('admin');
	
	
	//Payment show Route
	Route::get('/users/subscription', 'SubscriptionController@getSubscriptions')->middleware('admin');
	Route::get('/users/payment', 'SubscriptionController@getPaymentDetails')->middleware('admin');
	
	
	
	//Api-settings Route
	Route::get('/api-settings/google', 'Backend\ApiCredentialsController@googleApi')->middleware('admin');
	Route::get('/api-settings/facebook', 'Backend\ApiCredentialsController@facebookApi')->middleware('admin');
	Route::get('/api-settings/outlook', 'Backend\ApiCredentialsController@outlookApi')->middleware('admin');
	Route::get('/api-settings/yelp', 'Backend\ApiCredentialsController@yelpApi')->middleware('admin');
	Route::get('/api-settings/stripe', 'Backend\ApiCredentialsController@stripeApi')->middleware('admin');
	Route::post('/api-settings/google/add', 'Backend\ApiCredentialsController@storeGoogle')->middleware('admin');
	Route::post('/api-settings/facebook/add', 'Backend\ApiCredentialsController@storeFacebook')->middleware('admin');
	Route::post('/api-settings/outlook/add', 'Backend\ApiCredentialsController@storeOutlook')->middleware('admin');
	Route::post('/api-settings/yelp/add', 'Backend\ApiCredentialsController@storeYelp')->middleware('admin');
	Route::post('/api-settings/stripe/add', 'Backend\ApiCredentialsController@storeStripe')->middleware('admin');
	
	
	//Seo-settings Route
	Route::get('/seo-setting', 'Backend\SeoSettingController@index')->middleware('admin');
	Route::get('/seo-setting/add', 'Backend\SeoSettingController@create')->middleware('admin');
	Route::get('/seo-setting/edit/{id}', 'Backend\SeoSettingController@edit')->middleware('admin');
	Route::post('/seo-setting/add', 'Backend\SeoSettingController@store')->middleware('admin');
	Route::post('/seo-setting/edit/{id}', 'Backend\SeoSettingController@update')->middleware('admin');
	
	//pages Route
	Route::get('/pages', 'Backend\SeoSettingController@indexPages')->middleware('admin');
	Route::get('/pages/add', 'Backend\SeoSettingController@createPages')->middleware('admin');
	Route::get('/pages/edit/{id}', 'Backend\SeoSettingController@editPages')->middleware('admin');
	Route::get('/pages/delete/{id}', 'Backend\SeoSettingController@destroyPages')->middleware('admin');
	Route::post('/pages/add', 'Backend\SeoSettingController@storePages')->middleware('admin');
	Route::post('/pages/edit/{id}', 'Backend\SeoSettingController@updatePages')->middleware('admin');
	Route::post('/pages/showOnFooter', 'Backend\SeoSettingController@showOnFooter')->middleware('admin');
	
	//Newsletters Route
	Route::get('/newsletters', 'Backend\NewsletterController@index')->middleware('admin');
	Route::get('/newsletters/export', 'Backend\NewsletterController@export')->middleware('admin');
	Route::get('/newsletters/delete/{id}', 'Backend\NewsletterController@destroy')->middleware('admin');
	
	//Help Route
	Route::get('/help', 'Backend\HelpController@index')->middleware('admin');
	Route::get('/help/add', 'Backend\HelpController@create')->middleware('admin');
	Route::get('/help/edit/{id}', 'Backend\HelpController@edit')->middleware('admin');
	Route::get('/help/view/{id}', 'Backend\HelpController@show')->middleware('admin');
	Route::get('/help/delete/{id}', 'Backend\HelpController@destroy')->middleware('admin');
	Route::post('/help/add', 'Backend\HelpController@store')->middleware('admin');
	Route::post('/help/edit/{id}', 'Backend\HelpController@update')->middleware('admin');
	
	
});
	Route::get('google/import',array('as'=>'google.import','uses'=>'HomeController@redirectToGoogle')) ;
	Route::get('google/import/callback',array('as'=>'google.import.callback','uses'=>'HomeController@importContact')) ;

	Route::get('outlook/import',array('as'=>'outlook.import','uses'=>'HomeController@outLookImportRedirect')) ;
	Route::get('outlook/import/callback',array('as'=>'outlook.import.callback','uses'=>'HomeController@importContactFromOutlook')) ;
	
	Route::get('fb/import',array('as'=>'fb.import','uses'=>'UserController@facebookLogin'));
	Route::get('fb/import/callback',array('as'=>'fb.import.callback','uses'=>'UserController@facebookImportCallBack'));
	
	Route::get('fb/import/review',array('as'=>'fb.import.review','uses'=>'UserController@facebookReviewLogin'));
	Route::get('fb/import/callback/review',array('as'=>'fb.import.callback.review','uses'=>'UserController@facebookReviewImportCallBack'));
	
	
	
	
	
