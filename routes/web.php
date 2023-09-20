<?php

use App\Http\Controllers\BoarController;
use App\Http\Controllers\BreedingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LaborController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SowController;
use App\Http\Controllers\WeaningController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/sows' ,[SowController::class, 'index'])->name('sow.index');
Route::get('/sows/create', [SowController::class, 'create'])->name('sow.create');
Route::post('/sows',[SowController::class, 'store'])->name('sow.store');
Route::get('/sows/{sow}',[SowController::class,'show']);
Route::get('/sows/pdf',[PdfController::class,'sowsSummary']);
Route::get('/sows/pdf/{sow}',[PdfController::class,'prodSummary']);
Route::get('/sows/email/{sow}', [SowController::class, 'email']);
Route::get('/sows/search/{searchKey}', [SowController::class, 'search']);
Route::get('/sows/edit/{sow}',[SowController::class,'edit']);
Route::put('/sows/{sow}', [SowController::class, 'update']);
Route::delete('/sows/{sow}', [SowController::class, 'destroy']);

Route::get('/boars' ,[BoarController::class, 'index'])->name('boar.index');
Route::get('/boars/create', [BoarController::class, 'create'])->name('boar.create');
Route::post('/boars',[BoarController::class, 'store'])->name('boar.store');
Route::get('/boars/edit/{boar}', [BoarController::class, 'edit']);
Route::put('/boars/{boar}', [BoarController::class, 'update']);
Route::delete('/boars/{boar}', [BoarController::class, 'destroy']);

Route::get('/breedings' ,[BreedingController::class, 'index'])->name('breeding.index');
Route::get('/breedings/create', [BreedingController::class, 'create'])->name('breeding.create');
Route::post('/breedings',[BreedingController::class, 'store'])->name('breeding.store');
Route::get('/breedings/edit/{breeding}', [BreedingController::class, 'edit']);
Route::put('/breedings/{breeding}', [BreedingController::class, 'update']);
Route::get('/breedings/{breeding}',[BreedingController::class,'show']);
Route::delete('/breedings/{breeding}', [BreedingController::class, 'destroy']);

Route::get('/labors',[LaborController::class, 'index'])->name('labor.index');
Route::get('/labors/create/{breed_id}',[LaborController::class,'create']);
Route::post('/labors',[LaborController::class,'store']);
Route::get('/labors/{labor}',[LaborController::class,'show']);
Route::get('/labors/edit/{labor}', [LaborController::class, 'edit']);
Route::put('/labors/{labor}', [LaborController::class, 'update']);
Route::delete('/labors/{labor}', [LaborController::class, 'destroy']);

Route::get('/weaning' ,[WeaningController::class, 'index'])->name('weaning.index');
Route::get('/weaning/create/{labor_id}',[WeaningController::class,'create']);
Route::post('/weaning',[WeaningController::class,'store']);
Route::get('/weaning/{weaning}',[WeaningController::class,'show']);
Route::get('/weaning/edit/{weaning}', [WeaningController::class, 'edit']);
Route::put('/weaning/{weaning}', [WeaningController::class, 'update']);
Route::delete('/weaning/{weaning}', [WeaningController::class, 'destroy']);


Route::get('/sales' ,[SaleController::class, 'index'])->name('sale.index');
Route::get('/sales/create', [SaleController::class, 'create'])->name('sale.create');
Route::post('/sales',[SaleController::class, 'store'])->name('sale.store');


Route::get('/customers' ,[CustomerController::class, 'index'])->name('customer.index');
Route::get('/customers/create',[CustomerController::class , 'create']);
Route::post('/customers',[CustomerController::class, 'store']);
});

// Route::resource('sows' , [SowController::class]);
// Route::resource('boars', [BoarController::class]);
// Route::resource('breedings', [BreedingController::class]);
// Route::resource('labors', [LaborController::class]);





require __DIR__.'/auth.php';
