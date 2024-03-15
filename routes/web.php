<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Website\{
    HomeController,
};

use App\Http\Controllers\Website\AthletesCoach\{
    RegisterController,
    QuestionController,
    DashboardController,
    VideoConttroller,
    BankController
};


use App\Http\Controllers\Website\User\{
    UserRegisterController,
};

use App\Http\Controllers\Admin\{
    AuthController,
    UserController,
    AtheliticsAndCoachesController,
    PagesController,
    FaqController
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
    Route::get('/athletes', 'Allathletes')->name('athletes');
    Route::get('/coach', 'Allcoach')->name('coach');
    Route::get('/friday-frenzy', 'fridayFrenzy')->name('friday.frenzy');
    Route::get('/parent', 'parent')->name('parent');
    Route::get('/question', 'Question')->name('question');
    Route::get('/question-video/{id}', 'QuestionVideo')->name('question.video');
    Route::get('/new-video', 'NewVideo')->name('new.video');
    Route::get('/videopublisher/{slug}', 'VideoPublisher')->name('video.publisher');
    Route::get('/videopublisherlist/{id}', 'VideoPublisherList')->name('video.publisher.list');
    Route::get('/videopublisherall', 'VideoPublisherAll')->name('video.publisher.all');
    Route::get('/publisher-play-video/{id}', 'publisherPlayVideo')->name('publisher.play');
    Route::get('/video/{id}', 'Video')->name('video');
    Route::get('/coming-soon', 'ComingSoon')->name('coming-soon');
    Route::get('/login', 'Login')->name('login');
    Route::post('/loginpost', 'LoginPost')->name('login.post');
    Route::get('/forgotpassword', 'forgotPassword')->name('forgotpassword');
    Route::post('/forgotpasswordpost', 'forgotPasswordPost')->name('forgotpassword.post');
    Route::get('reset-password/{token}', 'showResetPasswordForm')->name('reset.password.get');
    Route::post('submitResetPasswordForm', 'submitResetPasswordForm')->name('submitResetPasswordForm');
    Route::get('joinnow', 'joinNow')->name('joinnow');
    Route::post('subscription', 'subscription')->name('subscription.create');
    Route::post('ask-question', 'askquestion')->name('askquestion.create');
    Route::post('news-letter', 'newsletter')->name('newsletter.create');
    Route::post('contactus-save', 'contactSave')->name('contactus.create');
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
    Route::name('web.athletes.coach.')->controller(RegisterController::class)->group(function () {
        Route::get('/logout', 'logout')->name('logout');
        Route::get('/verificationsucces', 'verificationSuccess')->name('verificationSuccess');
        Route::get('/editprofile', 'GetEditProfile')->name('GetEditProfile');
        Route::post('/profileupdate', 'profileupdate')->name('profileupdate');
        Route::get('/changepassword', 'ChangePassword')->name('ChangePassword');
        Route::post('/passwordupdate', 'passwordupdate')->name('passwordupdate');
        Route::get('/refer-and-earn', 'referralAndEarn')->name('referralAndEarn');
        Route::post('/referralandearnsend', 'referralAndEarnSend')->name('referralAndEarnSend');
        Route::get('/my-subscription', 'MySubcription')->name('MySubcription');
        Route::get('/resume_subcription', 'resume_subcription')->name('resume_subcription');
        Route::get('/cancel_subcription', 'cancel_subcription')->name('cancel_subcription');
    });
    Route::name('web.athletes.coach.')->prefix('athletes-coach')->controller(QuestionController::class)->group(function () {
        Route::get('/athelitics-coach-question', 'atheliticsCoachQuestion')->name('atheliticsCoachQuestion');
        Route::get('/update-role', 'UpdateRole')->name('update.role');
        Route::post('/save-role', 'SaveRole')->name('save.role');
        Route::post('/upload-Video', 'uploadVideo')->name('uploadVideo');
        Route::get('/remove-Video', 'removeVideo')->name('removeVideo');
        Route::get('/saveanswere', 'SaveAnswere')->name('SaveAnswere');
        Route::get('/question-and-answere/{new_video?}', 'questionandanswere')->name('questionandanswere');
        Route::post('/showvideo', 'showVideo')->name('show.video');
        Route::get('/addvideo/{questionid}', 'addQuestionVideo')->name('add.video');
        Route::get('/editvideo/{questionid}', 'editQuestionVideo')->name('edit.video');
        Route::post('/questionupdate', 'questionupdateVideo')->name('question.update');
        Route::post('/questionstore', 'questionstoreVideo')->name('question.store');
    });

    Route::name('web.')->prefix('athletes-coach')->controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'Dashboard')->name('dashboard');
        Route::get('/revenue-history', 'RevenueHistory')->name('revenue.history');
    });

    Route::name('web.Video.')->prefix('Video')->controller(VideoConttroller::class)->group(function () {
        Route::get('/index/{new_video?}', 'index')->name('index');
        Route::get('/add', 'add')->name('add');
        Route::post('/store', 'store')->name('store');
        Route::get('/view-Video/{id}', 'viewVideo')->name('viewVideo');
        Route::get('/editvideo/{id}', 'editVideo')->name('edit.video');
        Route::post('/update', 'updateVideo')->name('update');
    });


    Route::name('web.bank.')->prefix('bank')->controller(BankController::class)->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/add', 'add')->name('add');
        Route::get('/accountResponse/{accountId}', 'accountResponse')->name('accountResponse');
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
        Route::get('/profile', 'edit_profile')->name('profile');
        Route::post('/profileupdate', 'profileupdate')->name('profileupdate');
        Route::post('/passwordupdate', 'passwordupdate')->name('passwordupdate');
        Route::get('/verificationsucces', 'verificationSuccess')->name('verificationSuccess');
    });
});


//Admin Login
Route::name('admin.')->prefix('admin')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'Login')->name('login');
    Route::post('/loginpost', 'LoginPost')->name('loginpost');
    Route::get('/forgotpassword', 'forgotpassword')->name('forgotpassword');
    Route::post('/forgotpasswordpost', 'forgotPasswordPost')->name('forgotpassword.post');
    Route::get('reset-password/{token}', 'showResetPasswordForm')->name('reset.password.get');
    Route::post('submitResetPasswordForm', 'submitResetPasswordForm')->name('submitResetPasswordForm');

    Route::group(['middleware'=>'admin'],function(){
        Route::get('logout','logout')->name('logout');
        Route::get('dashboard','dashboard')->name('dashboard');
        Route::get('profile','editProfile')->name('profile');
        Route::post('/profileupdate', 'profileupdate')->name('profileupdate');
    });
});

// Admin User

Route::group(['middleware' => 'admin'], function ()
{
    Route::name('admin.user.')->prefix('user/')->controller(UserController::class)->group(function () {
        Route::get('list', 'list')->name('list');
        Route::post('delete', 'delete')->name('delete');
        Route::get('view-detail/{id}', 'ViewDetail')->name('detail');
    });

    Route::name('admin.athelitics.')->prefix('atheletes-coaches/')->controller(AtheliticsAndCoachesController::class)->group(function () {
        Route::get('list', 'list')->name('list');
        Route::post('delete', 'delete')->name('delete');
        Route::post('showvideo', 'showVideo')->name('show.video');
        Route::get('view-detail/{id}', 'ViewDetail')->name('detail');
        Route::post('changestatus', 'changestatus')->name('changestatus');
        Route::post('aprrovedstatus', 'aprrovedstatus')->name('aprrovedstatus');
        Route::post('rejectstatus', 'rejectstatus')->name('rejectstatus');
    });

    Route::name('admin.user.')->prefix('user/')->controller(UserController::class)->group(function () {
        Route::get('list', 'list')->name('list');
        Route::post('delete', 'delete')->name('delete');
        Route::get('view-detail/{id}', 'ViewDetail')->name('detail');
    });

    Route::name('admin.pages.')->prefix('pages/')->controller(PagesController::class)->group(function () {
        Route::get('ask-question-list', 'askquestionlist')->name('ask.question.list');
        Route::get('newsletter-list', 'newsletterlist')->name('newsletter.list');
        Route::get('contact-list', 'contactus')->name('contactus.list');
    });


    Route::name('admin.faq.')->prefix('faq/')->controller(FaqController::class)->group(function () {
        Route::get('list', 'list')->name('list');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::post('destroy', 'destroy')->name('destroy');
    });
});
