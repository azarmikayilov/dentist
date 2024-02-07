<?php

use App\Http\Controllers\Admin\AboutMenuController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DoctorImageController;
use App\Http\Controllers\Admin\HeadDoctorController;
use App\Http\Controllers\Admin\IconController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TvProgramController;
use App\Http\Controllers\Admin\YoutubeController;
use App\Http\Controllers\Front\ContactFormController;
use App\Http\Controllers\Front\SinglePageController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;

Route::get('locale/{locale}', [LocaleController::class, 'setLocale'])->name('locale.set');

Route::get('/search', [\App\Http\Controllers\SearchController::class, 'search'])->name('front.search');

Route::get('/', [\App\Http\Controllers\Front\MainPageController::class, 'index'])->name('front.index');
Route::get('/singlePage', [\App\Http\Controllers\Front\BlogController::class, 'singlePage']);
Route::get('/about', [\App\Http\Controllers\Front\BlogController::class, 'about'])->name('front.about');
Route::get('/dr-abdulkadir-narin', [\App\Http\Controllers\Front\BlogController::class, 'doctorPageShow'])->name('front.dr_narin');
Route::get('/iletisim', [\App\Http\Controllers\Front\BlogController::class, 'contact'])->name('front.contact');
Route::get('/makaleler', [\App\Http\Controllers\Front\BlogController::class, 'article']);
Route::get('/tv-programlari', [\App\Http\Controllers\Front\BlogController::class, 'tvPrograms']);

Route::get('/{blog:slug}', [SinglePageController::class, 'index'])->name('front.singleBlog');

Route::post('/contact', [ContactFormController::class, 'store'])->name('contact.store');



// Admin giriş sayfası
Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');

// Admin giriş işlemi
Route::post('admin/login', [AdminAuthController::class, 'login']);

// Admin kayıt sayfası
Route::get('admin/register', [AdminAuthController::class, 'showRegistrationForm'])->name('admin.register');

// Admin kayıt işlemi
Route::post('admin/register', [AdminAuthController::class, 'register']);

Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');




Route::group(['middleware' => ['admin.auth'], 'prefix' => 'admin'], function () {
    Route::resource('languages', LanguageController::class)->names('admin.language');
    Route::put('/languages/{language}', [LanguageController::class,'update'])->name('admin.language.edits');


    Route::get('/index', [AdminController::class, 'index'])->name('admin.index');

    Route::resource('/slider', SliderController::class)->names('admin.slider');

    Route::resource('/sponsors', SponsorController::class)->names('admin.sponsor');

    Route::resource('/youtubes', YoutubeController::class)->names('admin.youtube');

    // QUOTE START
    Route::resource('/quotes', QuoteController::class)->names('admin.quotes');
    Route::put('/quotes/{quote}', [QuoteController::class, 'update'])->name('admin.quotes.updates');
    Route::delete('/quotes/{quote}', [QuoteController::class, 'delete'])->name('admin.quotes.delete');
    // QUOTE END

    // ABOUT-MENU START
    Route::get('/about-menu', [AboutMenuController::class, 'index'])->name('admin.menu.index');
    Route::get('/about-menu/create', [AboutMenuController::class, 'create'])->name('admin.menu.create');
    Route::post('/about-menu/create', [AboutMenuController::class, 'store'])->name('admin.menu.store');
    Route::put('/about-menu-update/{menu}', [AboutMenuController::class, 'update'])->name('admin.menu.update');
    Route::get('/about-menu/edit/{menu}', [AboutMenuController::class, 'edit'])->name('admin.menu.edit');
    Route::delete('/about-menu-delete/{menu}', [AboutMenuController::class, 'delete'])->name('admin.menu.delete');
    // ABOUT-MENU END


    // ABOUT-US START
    Route::get('/about-us', [AboutUsController::class, 'index'])->name('admin.about-us.index');
    Route::get('/about-us/create', [AboutUsController::class, 'create'])->name('admin.about-us.create');
    Route::post('/about-us/create', [AboutUsController::class, 'store'])->name('admin.about-us.store');
    Route::put('/about-us-update/{aboutus}', [AboutUsController::class, 'update'])->name('admin.about-us.update');
    Route::get('/about-us/edit/{aboutus}', [AboutUsController::class, 'edit'])->name('admin.about-us.edit');
    Route::delete('/about-us-delete/{aboutus}', [AboutUsController::class, 'delete'])->name('admin.about-us.delete');
    // ABOUT-US END

    // TV-PROGRAMS START
//    Route::resource('tv-programs', TvProgramController::class)->names('admin.tv-program');
    Route::get('tv-programs', [TvProgramController::class, 'index'])->name('admin.tv-program.index');
    Route::get('tv-programs/create', [TvProgramController::class, 'create'])->name('admin.tv-program.create');
    Route::post('tv-programs', [TvProgramController::class, 'store'])->name('admin.tv-program.store');
    Route::get('tv-programs/{tv_program}', [TvProgramController::class, 'edit'])->name('admin.tv-program.edit');
    Route::put('tv-programs/{tv_program}', [TvProgramController::class, 'update'])->name('admin.tv-program.update');
    Route::delete('tv-programs/{tv_program}', [TvProgramController::class, 'destroy'])->name('admin.tv-program.destroy');
    // TV-PROGRAMS END

    // ICON START
//    Route::resource('icon', IconController::class)->names('admin.icon');
    Route::get('icon', [IconController::class, 'index'])->name('admin.icon.index');
    Route::get('icon/create', [IconController::class, 'create'])->name('admin.icon.create');
    Route::post('icon', [IconController::class, 'store'])->name('admin.icon.store');
    Route::get('icon/{item}', [IconController::class, 'edit'])->name('admin.icon.edit');
    Route::put('icon/{item}', [IconController::class, 'update'])->name('admin.icon.update');
    Route::delete('icon/{item}', [IconController::class, 'destroy'])->name('admin.icon.destroy');
    // ICON END


    // TEAM START
    Route::get('/teams/index', [TeamController::class, 'index'])->name('admin.teams.index');
    Route::get('/teams/create', [TeamController::class, 'create'])->name('admin.teams.create');
    Route::post('/teams', [TeamController::class, 'store'])->name('admin.teams.store');
    Route::get('/teams/edit/{team}', [TeamController::class, 'edit'])->name('admin.teams.edit');
    Route::post('/teams/update', [TeamController::class, 'update'])->name('admin.teams.update');
    Route::delete('/teams-delete/{team}', [TeamController::class, 'delete'])->name('admin.teams.destroy');
    // TEAM END

    // BLOG START
    Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class)->names('admin.blogs');
    Route::get('/blogs/{blog}/edit', [\App\Http\Controllers\Admin\BlogController::class, 'edit'])->name('admin.blogs.edit');
    // BLOG END

    // BLOG START
    Route::get('/head-doctor', [HeadDoctorController::class, 'index'])->name('admin.doctor.index');
    Route::get('/doctor-create', [HeadDoctorController::class, 'create'])->name('admin.doctor.create');
    Route::post('/doctor-create', [HeadDoctorController::class, 'store'])->name('admin.doctor.store');
    Route::get('/doctor-edit/{doctor}', [HeadDoctorController::class, 'edit'])->name('admin.doctor.edit');
    Route::put('/doctor-edit/update{id}', [HeadDoctorController::class, 'update'])->name('admin.doctor.update');
    Route::delete('/doctor-delete/{doctor}', [HeadDoctorController::class, 'destroy'])->name('admin.doctor.destroy');
    // BLOG END

    // SETTING START
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings.index');
    Route::get('/settings/create', [SettingController::class, 'create'])->name('admin.settings.create');
    Route::post('/settings', [SettingController::class, 'store'])->name('admin.settings.store');
    Route::get('/settings/{setting}/edit', [SettingController::class, 'edit'])->name('admin.settings.edit');
    Route::put('/settings/{setting}', [SettingController::class, 'update'])->name('admin.settings.update');
    Route::delete('/settings/{setting}', [SettingController::class, 'destroy'])->name('admin.settings.destroy');
    // SETTING END


    Route::put('/category/update/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.category.update');
    Route::resource('/category', \App\Http\Controllers\Admin\CategoryController::class, [
        'names' => 'admin.category',
        'except' => ['update']
    ]);


    Route::get('/doctor-images', [DoctorImageController::class, 'index'])->name('admin.d_image.index');
    Route::get('/doctor-images/create', [DoctorImageController::class, 'create'])->name('admin.d_image.create');
    Route::post('/doctor-images/store', [DoctorImageController::class, 'store'])->name('admin.d_image.store');
    Route::get('/doctor-images/edit/{image}', [DoctorImageController::class, 'edit'])->name('admin.d_image.edit');
    Route::put('/doctor-images/update/{image}', [DoctorImageController::class, 'update'])->name('admin.d_image.update');
    Route::delete('/doctor-images/destroy/{image}', [DoctorImageController::class, 'destroy'])->name('admin.d_image.destroy');

});
