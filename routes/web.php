<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AppController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BiographyController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\DashboardController;



Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/update', function () {
    return view('auth.login');
});
Route::group(['middleware' => ['auth']], function () {
    Route::get('/add-sliders', [SliderController::class, 'index'])->name('add-sliders');
Route::get('/view-sliders', [SliderController::class, 'viewSliderPage'])->name('view-sliders');
Route::post('/save-slider', [SliderController::class, 'saveSlider'])->name('save-slider');
Route::get('/get-biography-details/{id}', [BiographyController::class, 'getBiographyDetails']);
Route::get('/get-slider-details/{id}', [SliderController::class, 'getSliderDetails']);
Route::delete('/delete-slider/{id}', [SliderController::class, 'deleteSlider']);
Route::post('/update-slider/{id}', [SliderController::class, 'updateSlider']);
Route::get('/biography', [BiographyController::class, 'index'])->name('view-biography');
Route::delete('/delete-biography/{id}', [BiographyController::class, 'deleteBiography']);
Route::post('/save-biography', [BiographyController::class, 'store'])->name('save-biography');
Route::post('/update-biography/{id}', [BiographyController::class, 'updateBiography'])->name('update-biography');
Route::get('/view-information', [InformationController::class, 'index'])->name('view-information');
Route::get('/get-information-details/{id}', [InformationController::class, 'getInformationDetails']);
Route::post('/update-information/{id?}', [InformationController::class, 'updateInformation'])->name('update-information');
Route::delete('/delete-information/{id}', [InformationController::class, 'deleteInformation']);
Route::get('/view-news', [NewsController::class, 'index'])->name('view-news');
Route::post('/save-news', [NewsController::class, 'store'])->name('save-news');
Route::get('/view-add-news', [NewsController::class, 'viewAddNewsPage'])->name('view-add-news');
Route::get('/get-news-details/{id}', [NewsController::class, 'getNewsDetails'])->name('get-news-details');
Route::get('/news', [NewsController::class, 'index'])->name('view-news');
Route::get('/edit-news/{id}', [NewsController::class, 'edit'])->name('edit-news');
Route::post('/update-news/{id}', [NewsController::class, 'update'])->name('update-news');
Route::delete('/delete-news/{id}', [NewsController::class, 'deleteNews'])->name('delete-news');
Route::get('/gallery', [GalleryController::class, 'index'])->name('view-gallery');
Route::get('/gallery/create', [GalleryController::class, 'create'])->name('create-gallery');
Route::post('/gallery/store', [GalleryController::class, 'store'])->name('store-gallery');
Route::get('/gallery/edit/{id}', [GalleryController::class, 'edit'])->name('edit-gallery');
Route::post('/update-gallery/{id}', [GalleryController::class, 'update'])->name('update-gallery');
Route::delete('/gallery/delete/{id}', [GalleryController::class, 'destroy'])->name('delete-gallery');
Route::post('/gallery/upload-image', [GalleryController::class, 'uploadImage'])->name('upload-gallery-image');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/get-gallery-details/{id}', [GalleryController::class, 'getGalleryDetails'])->name('get-gallery-details');
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

