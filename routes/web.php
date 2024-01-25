<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Website\{
    HomeController,
};

use App\Http\Controllers\Website\AthletesCoach\{
    RegisterController,
    QuestionController,
    DashboardController,
    VideoConttroller
};


use App\Http\Controllers\Website\User\{
    UserRegisterController,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});


// Route::name('download.')->prefix('download')->controller(DownloadReportController::class)->group(function () {
//     Route::get('report/{id}', 'index')->name('report');
// });


// Website Route


Route::name('web.')->controller(HomeController::class)->group(function () {
    Route::get('/', 'Index')->name('index');
    Route::get('/about', 'About')->name('about');
    Route::get('/contact-us', 'ContactUs')->name('contact-us');
    Route::get('/categories', 'AllCategories')->name('categories');
    Route::get('/videopublisher/{slug}', 'VideoPublisher')->name('video.publisher');
    Route::get('/videopublisherlist/{id}', 'VideoPublisherList')->name('video.publisher.list');
    Route::get('/publisher-play-video/{id}', 'publisherPlayVideo')->name('publisher.play');
    Route::get('/video/{id}', 'Video')->name('video');
    Route::get('/coming-soon', 'ComingSoon')->name('coming-soon');
    Route::get('/login', 'Login')->name('login');
    Route::post('/loginpost', 'LoginPost')->name('login.post');
});

Route::name('web.athletes.coach.')->prefix('athletes-coach')->controller(RegisterController::class)->group(function () {
    Route::get('/register', 'Register')->name('register');
    Route::post('/register', 'RegisterSubmit')->name('register.post');
    Route::get('/verification/otp', 'verification_otp')->name('VerificationOtp');
    Route::get('/resend/otp', 'reSendOtp')->name('RsendOtp');
    Route::post('/verifyotp', 'verifyOtp')->name('verifyotp');
});

Route::group(['middleware' => 'auth'], function ()
{
    Route::name('web.athletes.coach.')->prefix('athletes-coach')->controller(RegisterController::class)->group(function () {
        Route::get('/logout', 'logout')->name('logout');
        Route::get('/verificationsucces', 'verificationSuccess')->name('verificationSuccess');
        Route::get('/editprofile', 'GetEditProfile')->name('GetEditProfile');
        Route::post('/profileupdate', 'profileupdate')->name('profileupdate');
        Route::get('/changepassword', 'ChangePassword')->name('ChangePassword');
        Route::post('/passwordupdate', 'passwordupdate')->name('passwordupdate');
    });
    Route::name('web.athletes.coach.')->prefix('athletes-coach')->controller(QuestionController::class)->group(function () {
        Route::get('/athelitics-coach-question', 'atheliticsCoachQuestion')->name('atheliticsCoachQuestion');
        Route::post('/upload-vedio', 'uploadVedio')->name('uploadVedio');
        Route::get('/remove-vedio', 'removeVedio')->name('removeVedio');
        Route::get('/saveanswere', 'SaveAnswere')->name('SaveAnswere');
    });

    Route::name('web.')->prefix('athletes-coach')->controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'Dashboard')->name('dashboard');
    });

    Route::name('web.vedio.')->prefix('vedio')->controller(VideoConttroller::class)->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/add', 'add')->name('add');
        Route::post('/store', 'store')->name('store');
        Route::get('/view-vedio/{id}', 'viewvedio')->name('viewvedio');
    });
});

//  User Register Controler

Route::name('web.user.')->prefix('user')->controller(UserRegisterController::class)->group(function () {
    Route::get('/register', 'Register')->name('register');
    Route::post('/register', 'RegisterSubmit')->name('register.post');
    Route::get('/verification/otp', 'verification_otp')->name('VerificationOtp');
    Route::get('/resend/otp', 'reSendOtp')->name('RsendOtp');
    Route::post('/verifyotp', 'verifyOtp')->name('verifyotp');
});


Route::group(['middleware' => 'auth'], function ()
{
    Route::name('web.user.')->prefix('user')->controller(UserRegisterController::class)->group(function () {
        Route::get('/logout', 'logout')->name('logout');
        Route::get('/verificationsucces', 'verificationSuccess')->name('verificationSuccess');
    });
});
