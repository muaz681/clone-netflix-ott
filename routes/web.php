<?php

use Illuminate\Support\Facades\Route;

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


$namespace = 'App\Http\Controllers';



Route::prefix('{lang?}')->group(function () use ($namespace) {

    Route::get('/download-android', function () {
        return Redirect::to('https://play.google.com/store/apps/details?id=com.app.shaplamedia');
    })->name('download_android');

    Route::get('/download-ios', function () {
        return Redirect::to('https://apps.apple.com/us/app/cinebaz/id1585936862');
    })->name('download_ios');

    Route::namespace($namespace)->middleware(['web'])->name('frontend.')->group(function () {
        Route::get('/welcome', 'FrontendController@welcome')->name('welcome');
        Route::get('/', 'FrontendController@index')->name('index');
        Route::get('/search', 'SearchController@index')->name('search_index');
        Route::get('/home', 'FrontendController@index')->name('home');
        Route::get('/movie', 'FrontendController@movies')->name('movie');
        Route::get('/all-movie', 'FrontendController@movie_all')->name('movie.all');
        Route::get('/Tv-show', 'FrontendController@TVShow')->name('tv_show');
        // Route::get('/season', 'FrontendController@season')->name('season');
        // Route::get('/series', 'FrontendController@series')->name('series');
        Route::get('/details/{slug}', 'FrontendController@details')->name('details');
        Route::get('/combo/details', 'FrontendController@combo');
        Route::get('/artist/profile/{slug}', 'FrontendController@artistProfile')->name('artist.profile');

        Route::get('/upcoming', 'FrontendController@upcoming')->name('upcoming');
        Route::get('/free', 'FrontendController@free')->name('free');
        Route::get('/trending', 'FrontendController@trending')->name('trending');
        Route::get('/premium', 'FrontendController@premium')->name('premium');
        Route::get('/category/{slug}', 'FrontendController@mediaList')->name('media_list');
        Route::get('/upcoming/movie/{slug}', 'FrontendController@upcomingMediaList')->name('upcoming_media_list');
        Route::get('/genre/{slug}', 'FrontendController@generMediaList')->name('gener.media_list');


        // Notification
        Route::get('/read/notification/{id}', 'FrontendController@readNotification')->name('readNotification');




        // Terms & Conditions

        Route::get('/privacy-policy', 'ContentController@privacy')->name('privacy');
        Route::get('/about-us', 'ContentController@about_us')->name('about_us');
        Route::get('/terms-conditions', 'ContentController@tearmsConditions')->name('tearms-conditions');
        Route::get('/return-refund', 'ContentController@returnConditions')->name('return-conditions');
        Route::get('/market-policy', 'ContentController@marketPolicy')->name('market-policy');
        Route::get('/contact-us', 'ContentController@contactUs')->name('contact-us');
        Route::post('/send-contact-info', 'ContentController@storeContact')->name('send-contact-info');
        Route::get('/help-center', 'ContentController@helpCenter')->name('help-center');
        Route::get('/legal-notice', 'ContentController@legalNotice')->name('legal-notice');
        Route::get('/corporate-information', 'ContentController@corporateInformation')->name('corporate-information');
        Route::get('/error', 'ErrorController@index')->name('error_page');
    });


    Route::namespace($namespace)->middleware(['web', 'auth:member'])->name('frontend.')->group(function () {
        // Cart

        Route::get('/cart/checkout', 'CartController@checkout')->name('cart:checkout');
        Route::post('/cart/checkout/process', 'CartController@checkout_process')->name('cart.checkout.process');


        Route::get('/ticket/invoice', 'TicketController@invoice')->name('ticket:invoice');
        Route::get('/ticket/invoice/print/{code}', 'TicketController@invoicePrint')->name('ticket.print');
    });


    Route::namespace($namespace)->middleware(['web', 'member'])->name('frontend.')->group(function () {
        Route::get('/aws/{slug}', 'FrontendController@start_aws')->name('start_aws');
    });

    Route::namespace($namespace)->name('member.auth.')->middleware(['web'])->group(function () {
        Route::get('member/subscription/plan/purchase/{id}', 'PurchaseController@Index')->name('purchase');
    });

    // Ajax data route
    Route::namespace($namespace)->middleware(['web'])->name('frontend.ajax.')->group(function () {
        Route::get('frontend/ajax/favorite/{id}', 'FrontendController@ajax_favorite')->name('favorite');
        Route::get('frontend/ajax/listing/{id}', 'FrontendController@ajax_listing')->name('listing');
        Route::post('save/playback/media', 'FrontendController@savePlayHistory')->name('media.history');
        Route::get('search', 'FrontendController@ajax_search')->name('search');
    });

    Route::namespace($namespace)->name('member.auth.')->middleware(['web'])->group(function () {
        Route::get('member', 'MemberController@register')->name('register');
        Route::post('member/register/save', 'MemberController@store')->name('store');
        Route::get('member/login', 'MemberController@showlogin')->name('showlogin');
        Route::post('member/login/save', 'MemberController@login')->name('login');
        Route::get('member/profile', 'MemberController@index')->name('profile');
        Route::get('member/settings', 'MemberController@settings')->name('settings');
        Route::post('member/update', 'MemberController@update')->name('update');
        Route::get('member/library', 'MemberController@library')->name('library');
        Route::get('member/bucket', 'MemberController@bucket')->name('bucket');
        // Route::get('member/plan', 'MemberController@plan')->name('plan');
        Route::get('member/change/password', 'MemberController@changePassword')->name('change_password');
        Route::post('member/update/password', 'MemberController@updatePassword')->name('updatePassword');
        Route::get('member/logout', 'MemberController@logout')->name('logout');
        // Route::get('complete', 'MemberController@complete')->name('payment.complete');
    });

    // Facebook Login URL
    Route::namespace($namespace)->name('member.facebook.auth.')->middleware(['web'])->group(function () {
       
    });

    Route::namespace($namespace)->middleware(['web'])->group(function () {
        Route::get('login/otp', 'OtpLoginController@Index')->name('login.otp');
        Route::get('send/otp/code', 'OtpLoginController@SendOTPCode')->name('send.otp');
        Route::get('save/otp/code', 'OtpLoginController@SaveOTPCode')->name('save.otp');
        Route::get('login/google', 'MemberController@redirectToGoogle')->name('login.google');

        Route::get('login/apple', 'MemberController@loginApple')->name('login.apple');
        Route::post('auth/apple/callback', 'MemberController@handleAppleCallback');


        Route::get('auth', 'FaceBookController@loginUsingFacebook')->name('login.facebook');
        Route::get('auth/facebook/callback', 'FaceBookController@callbackFromFacebook')->name('callback');

        Route::get('password/forgot', 'MemberController@getPasswordForgote')->name('pass-forgot');
        Route::post('forgate-password', 'MemberController@forgate_password')->name('forgot-password');
        Route::get('password/forgot/status', 'MemberController@ForgoteStatus')->name('forgot-password-status');
        Route::get('password/reset', 'MemberController@getPasswordReset')->name('password-reset');
        Route::post('reset-password', 'MemberController@resetPassword')->name('reset-password');
        Route::get('password/reset/status', 'MemberController@ResetStatus')->name('password-reset-status');;
    });
});

////////////////////////////////////////////////////////
// Without Lang routes List
///////////////////////////////////////////////////////
Route::namespace($namespace)->middleware(['web'])->group(function () {
    Route::get('auth/google/callback', 'MemberController@handleGoogleCallback')->name('google.callback');
    Route::get('auth/facebook/callback', 'MemberController@handleFacebookCallback');

});

Route::namespace($namespace)->middleware(['web', 'auth:member'])->name('frontend.')->group(function () {

    Route::get('/callback/nagad', 'CartController@nagad_callback')->name('callback');
});
Route::namespace($namespace)->middleware(['web', 'auth:member'])->name('frontend.checkout.sslcommerz.')->group(function () {
    // SSLCOMMERZ
    Route::get('/cart/sslcommerz/{id}/payment', 'SslCommerzPaymentController@index')->name('index');
});

Route::post('/pay-via-ajax', [App\Http\Controllers\SSLPayController::class, 'payViaAjax']);
Route::post('/pay', [App\Http\Controllers\SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [App\Http\Controllers\SslCommerzPaymentController::class, 'payViaAjax']);
Route::post('/success', [App\Http\Controllers\SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [App\Http\Controllers\SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [App\Http\Controllers\SslCommerzPaymentController::class, 'cancel']);
Route::post('/ipn', [App\Http\Controllers\SslCommerzPaymentController::class, 'ipn']);


Route::namespace($namespace)->middleware(['web'])->name('frontend.')->group(function () {
    Route::get('/cart/add/{id}', 'CartController@index')->name('cart:add');
    Route::get('/cart/remove/{id}', 'CartController@delete')->name('cart:remove');
    Route::get('/download-android', 'FrontendController@download_android')->name('download_android');
});


