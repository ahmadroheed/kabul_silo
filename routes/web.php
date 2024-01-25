<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AppController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BiographyController;



Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/add-sliders', [SliderController::class, 'index'])->name('add-sliders');
Route::get('/view-sliders', [SliderController::class, 'viewSliderPage'])->name('view-sliders');
Route::post('/save-slider', [SliderController::class, 'saveSlider'])->name('save-slider');
Route::get('/get-biography-details/{id}', [BiographyController::class, 'getBiographyDetails']);
Route::delete('/delete-slider/{id}', [SliderController::class, 'deleteSlider']);
Route::post('/update-slider/{id}', [SliderController::class, 'updateSlider']);

// View all biographies
Route::get('/biography', [BiographyController::class, 'index'])->name('view-biography');


// Delete biography
Route::delete('/delete-biography/{id}', [BiographyController::class, 'deleteBiography']);
Route::post('/save-biography', [BiographyController::class, 'store'])->name('save-biography');

// Update biography
Route::post('/update-biography/{id}', [BiographyController::class, 'updateBiography'])->name('update-biography');

Route::get('/update', function () {
    return view('auth.login');
});
Route::group(['middleware' => ['auth']], function () {

    Route::get('/update_home', function () {
        return view('cpanel.home');
    });
    Route::get('/cpanel/home', function () {
        return view('cpanel.home');
    });

    Route::post('/update_sliders', [HomeController::class, 'update_sliders']);
    Route::post('/update_information', [HomeController::class, 'update_information']);
    Route::post('/update_biography', [HomeController::class, 'update_biography']);

    Route::get('/update_services', function () {
        return view('cpanel.services');
    });

    Route::get('/update_gallary', function () {
        return view('cpanel.gallary');
    });
    Route::post('/save_photo_gallary', [HomeController::class, 'save_photo_gallary']);
    Route::post('/delete_galary_photo', [HomeController::class, 'delete_galary_photo']);

    Route::get('/update_contact', function () {
        return view('cpanel.contact');
    });

    Route::get('/update_news', function () {
        return view('cpanel.news');
    });
    Route::post('/get_latest_news_for_update', [HomeController::class, 'get_latest_news_for_update']);
    Route::post('/update_news', [HomeController::class, 'update_news']);

    Route::get('/view_news_detials/{id}', function ($id) {
        return view('cpanel.news_details')->with('id', $id);
    });
    Route::post('/add_news', [HomeController::class, 'add_news']);
    Route::post('/delete_delete_news', [HomeController::class, 'delete_delete_news']);

});


Route::get('/locale/{lang}', [AppController::class, 'setLocale']);
Route::get('/', [AppController::class, 'index']);

Route::group(['middleware' => ['lang']], function () {

    Route::get('/home', function () {
        return view('index');
    });


    Route::get('/main', function () {
        return view('index');
    })->name('home');


    Route::get('/home', function () {
        return view('index');
    })->name('login');


    Route::get('/services', function () {
        return view('services');
    });

    Route::get('/documents', function () {
        return view('documents');
    });
    Route::post('/download_document', [VisitorController::class, 'download_document']);

    Route::get('/gallary', function () {
        return view('gallary');
    });

    Route::get('/news', function () {
        return view('news');
    });
    Route::post('/get_latest_news', [VisitorController::class, 'get_latest_news']);
    Route::post('/search_news', [VisitorController::class, 'search_news']);

    Route::get('/news_details/{id}', function ($id) {
        return view('news_details')->with('id', $id);
    });

    Route::post('/save_comments', [VisitorController::class, 'save_comments']);

    Route::get('/contact', function () {
        return view('contact');
    });
    Route::post('/save_contact', [VisitorController::class, 'save_contact_msg']);
});

