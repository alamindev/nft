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

/**
 * backend route
 */
Route::prefix('admin')->middleware(['auth','is_admin'])->group(function(){

    Route::get('/', [App\Http\Controllers\Backend\DashboardController::class, 'redirect']);
    Route::get('/dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');

    // start route for link showing
    Route::get('/links', [App\Http\Controllers\Backend\LinkController::class, 'index'])->name('links');
    Route::post('/link/approve/{id}', [App\Http\Controllers\Backend\LinkController::class, 'approve'])->name('link.approve');
    Route::get('/link/reject/{id}', [App\Http\Controllers\Backend\LinkController::class, 'reject'])->name('link.reject');
    Route::get('/link/delete/{id}', [App\Http\Controllers\Backend\LinkController::class, 'destroy'])->name('link.destroy');

    Route::get('/setting', [App\Http\Controllers\Backend\SettingController::class, 'index'])->name('setting');
    Route::post('/setting/update', [App\Http\Controllers\Backend\SettingController::class, 'update'])->name('setting.update');
    // for dynamic page
    Route::get('/pages', [App\Http\Controllers\Backend\PageController::class, 'index'])->name('pages');
    Route::get('/page/create', [App\Http\Controllers\Backend\PageController::class, 'create'])->name('page.create');
    Route::post('/page/store', [App\Http\Controllers\Backend\PageController::class, 'store'])->name('page.store');
    Route::get('/page/edit/{id}', [App\Http\Controllers\Backend\PageController::class, 'edit'])->name('page.edit');
    Route::get('/page/view/{id}', [App\Http\Controllers\Backend\PageController::class, 'show'])->name('page.show');
    Route::post('/page/update/{id}', [App\Http\Controllers\Backend\PageController::class, 'update'])->name('page.update');
    Route::delete('/page/destroy/{id}', [App\Http\Controllers\Backend\PageController::class, 'destroy'])->name('page.destroy');
    Route::post('/page/uploads',  [App\Http\Controllers\Backend\PageController::class, 'upload']);
    Route::get('/page/file_browser', [App\Http\Controllers\Backend\PageController::class, 'fileBrowser']);

    /**
     *
     * start coding for project route
     */

    Route::get('/projects', [App\Http\Controllers\Backend\ProjectController::class, 'index'])->name('admin.projects');
    Route::get('/projects/approve/{id}', [App\Http\Controllers\Backend\ProjectController::class, 'approve'])->name('admin.projects.approve');
    Route::get('/projects/reject/{id}', [App\Http\Controllers\Backend\ProjectController::class, 'reject'])->name('admin.projects.reject');
    Route::get('/projects/view/{id}', [App\Http\Controllers\Backend\ProjectController::class, 'show'])->name('admin.projects.show');
    Route::delete('/projects/destroy/{id}', [App\Http\Controllers\Backend\ProjectController::class, 'destroy'])->name('admin.projects.destroy');
    Route::get('/projects/promoted/{id}', [App\Http\Controllers\Backend\ProjectController::class, 'promoted'])->name('admin.projects.promoted');
    // start coding for promoted projects
    Route::get('/promoted-projects', [App\Http\Controllers\Backend\PromotedProjectController::class, 'index'])->name('admin.promoted_projects');
    Route::get('/promoted-projects/destroy/{id}', [App\Http\Controllers\Backend\PromotedProjectController::class, 'destroy'])->name('admin.promoted_project.destroy');

    // start coding for backend ads route
    Route::get('/ads', [App\Http\Controllers\Backend\AdsController::class, 'index'])->name('admin.ads');
    Route::get('/ads/approve/{id}', [App\Http\Controllers\Backend\AdsController::class, 'approve'])->name('admin.ads.approve');
    Route::get('/ads/reject/{id}', [App\Http\Controllers\Backend\AdsController::class, 'reject'])->name('admin.ads.reject');
    Route::get('/ads/view/{id}', [App\Http\Controllers\Backend\AdsController::class, 'show'])->name('admin.ads.show');
    Route::delete('/ads/destroy/{id}', [App\Http\Controllers\Backend\AdsController::class, 'destroy'])->name('admin.ads.destroy');



    /**
     *
     * for user route
     */
    Route::get('/users', [App\Http\Controllers\Backend\UsersController::class, 'index'])->name('users');
    Route::get('/user/view/{id}', [App\Http\Controllers\Backend\UsersController::class, 'show'])->name('user.show');
    Route::delete('/users/destroy/{id}', [App\Http\Controllers\Backend\UsersController::class, 'destroy'])->name('user.destroy');
});

/**
 * frontend route
 */

Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
Route::get('/newly-listed', [App\Http\Controllers\Frontend\HomeController::class, 'NewlyListed'])->name('newly_listed');
Route::get('/all-nft', [App\Http\Controllers\Frontend\HomeController::class, 'AllNft'])->name('allnft');
Route::get('/prelaunch', [App\Http\Controllers\Frontend\HomeController::class, 'Prelaunch'])->name('prelaunch');
Route::get('/project/{slug}', [App\Http\Controllers\Frontend\HomeController::class, 'Details'])->name('details');
Route::get('/search', [App\Http\Controllers\Frontend\HomeController::class, 'Search'])->name('search');

/**
 *
 * start coding for page route
 */

Route::get('/p/{page:slug}', [App\Http\Controllers\Frontend\PageController::class, 'show'])->name('page.show');


Route::middleware(['auth'])->group(function(){
    // start coding Profile route
    Route::get('/profile', [App\Http\Controllers\Frontend\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/store', [App\Http\Controllers\Frontend\ProfileController::class, 'store'])->name('profile.store');

    // start coding Project route
    Route::get('/projects', [App\Http\Controllers\Frontend\ProjectController::class, 'index'])->name('projects');
    Route::get('/projects/create', [App\Http\Controllers\Frontend\ProjectController::class, 'create'])->name('projects.create');

    Route::get('/projects/show/{slug}', [App\Http\Controllers\Frontend\ProjectController::class, 'show'])->name('projects.show');

    Route::post('/projects/store', [App\Http\Controllers\Frontend\ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project:slug}/edit/', [App\Http\Controllers\Frontend\ProjectController::class, 'edit'])->name('projects.edit');
    Route::post('/projects/update/{id}', [App\Http\Controllers\Frontend\ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/destroy/{id}', [App\Http\Controllers\Frontend\ProjectController::class, 'destroy'])->name('projects.destroy');

    // start coding Ads route
    Route::get('/ads', [App\Http\Controllers\Frontend\AdsController::class, 'index'])->name('ads');
    Route::get('/ads/create', [App\Http\Controllers\Frontend\AdsController::class, 'create'])->name('ads.create');

    Route::get('/ads/show/{slug}', [App\Http\Controllers\Frontend\AdsController::class, 'show'])->name('ads.show');

    Route::post('/ads/store', [App\Http\Controllers\Frontend\AdsController::class, 'store'])->name('ads.store');
    Route::get('/ads/{ad:slug}/edit/', [App\Http\Controllers\Frontend\AdsController::class, 'edit'])->name('ads.edit');
    Route::post('/ads/update/{id}', [App\Http\Controllers\Frontend\AdsController::class, 'update'])->name('ads.update');
    Route::delete('/ads/destroy/{id}', [App\Http\Controllers\Frontend\AdsController::class, 'destroy'])->name('ads.destroy');



    Route::get('/favourite-lists', [App\Http\Controllers\Frontend\FavouriteController::class, 'index'])->name('favourite_lists');
    Route::get('/add-favourite/{project_id}', [App\Http\Controllers\Frontend\FavouriteController::class, 'Favourite'])->name('add.favourite');
    Route::get('/unfavourite/{project_id}', [App\Http\Controllers\Frontend\FavouriteController::class, 'Unfavourite'])->name('add.unfavourite');


    Route::get('/add-vote/{project_id}', [App\Http\Controllers\Frontend\VoteController::class, 'Vote'])->name('add.vote');
});






require __DIR__.'/auth.php';
