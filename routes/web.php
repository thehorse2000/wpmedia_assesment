<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CrawlController;
use \App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'viewHomepage'])->name('home');
Route::get('/downloadxml', [HomeController::class, 'downloadXmlFile'])->name('download:xml');
Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::get('/crawl', [CrawlController::class, 'startCrawling'])->name('crawl');
Route::get('/results', [CrawlController::class, 'viewAllResults'])->name('results');
Route::get('/results/view', [CrawlController::class, 'viewSingleResult'])->name('results:view');

