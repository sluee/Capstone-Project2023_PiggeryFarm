<?php

use App\Http\Controllers\BoarController;
use App\Http\Controllers\BreedingController;
use App\Http\Controllers\CashAdvanceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LaborController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleItemController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SaleHistoryController;
use App\Http\Controllers\SowController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeaningController;
use App\Http\Controllers\FinancialTransactionController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PayrollItemController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ConsumptionController;
use App\Http\Controllers\FeedsPurchaseController;
use App\Http\Controllers\FinancialTransactionItemsController;

// use App\Models\Payroll;
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
        // 'canRegister' => Route::has('register'),
        // 'laravelVersion' => Application::VERSION,
        // 'phpVersion' => PHP_VERSION,
    ]);
})->middleware('checkUserStatus')->name('login');



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('can:manage_pigs')->group(function(){
         ///for sows///
    Route::get('/sows' ,[SowController::class, 'index'])->name('sow.index');
    Route::get('/sows/create', [SowController::class, 'create'])->name('sow.create');
    Route::post('/sows',[SowController::class, 'store'])->name('sow.store');
    Route::get('/sows/{sow}',[SowController::class,'show']);
    Route::get('/sows/edit/{sow}',[SowController::class,'edit']);
    Route::put('/sows/{sow}', [SowController::class, 'update']);
    Route::delete('/sows/{sow}', [SowController::class, 'destroy']);
    Route::post('/sows/deactivate/{sow}', [SowController::class, 'deactivateSow']);
    Route::post('/sows/activate/{sow}', [SowController::class, 'activateSow']);

    ///For Boars/////
    Route::get('/boars' ,[BoarController::class, 'index'])->name('boar.index');
    Route::get('/boars/create', [BoarController::class, 'create'])->name('boar.create');
    Route::post('/boars',[BoarController::class, 'store'])->name('boar.store');
    Route::get('/boars/edit/{boar}', [BoarController::class, 'edit']);
    Route::put('/boars/{boar}', [BoarController::class, 'update']);
    Route::get('/boars/{boar}',[BoarController::class,'show']);
    Route::delete('/boars/{boar}', [BoarController::class, 'destroy']);
    Route::post('/boars/deactivate/{boar}', [BoarController::class, 'deactivateBoar']);
    Route::post('/boars/activate/{boar}', [BoarController::class, 'activateBoar']);

    //For Breeding///
    Route::get('/breedings' ,[BreedingController::class, 'index'])->name('breeding.index');
    Route::get('/breedings/create', [BreedingController::class, 'create'])->name('breeding.create');
    Route::post('/breedings',[BreedingController::class, 'store'])->name('breeding.store');
    Route::post('/breedings/reheat/{breeding}', [BreedingController::class, 'reheatRemarks']);
    Route::post('/breedings/abort/{breeding}', [BreedingController::class, 'abortRemarks']);
    Route::get('/breedings/edit/{breeding}', [BreedingController::class, 'edit']);
    Route::put('/breedings/{breeding}', [BreedingController::class, 'update']);
    Route::get('/breedings/{breeding}',[BreedingController::class,'show']);
    Route::delete('/breedings/{breeding}', [BreedingController::class, 'destroy']);


    //For Labor///
    Route::get('/labors',[LaborController::class, 'index'])->name('labor.index');
    Route::get('/labors/create/{breed_id}',[LaborController::class,'create']);
    Route::post('/labors',[LaborController::class,'store']);
    Route::get('/labors/{labor}',[LaborController::class,'show']);
    Route::get('/labors/edit/{labor}', [LaborController::class, 'edit']);
    Route::put('/labors/{labor}', [LaborController::class, 'update']);
    Route::delete('/labors/{labor}', [LaborController::class, 'destroy']);
    ;

    //for weaning///
    Route::get('/weaning' ,[WeaningController::class, 'index'])->name('weaning.index');
    Route::get('/weaning/create/{labor_id}',[WeaningController::class,'create']);
    Route::post('/weaning',[WeaningController::class,'store']);
    Route::get('/weaning/{weaning}',[WeaningController::class,'show']);
    Route::get('/weaning/edit/{weaning}', [WeaningController::class, 'edit']);
    Route::put('/weaning/{weaning}', [WeaningController::class, 'update']);
    Route::delete('/weaning/{weaning}', [WeaningController::class, 'destroy']);
    });


    Route::middleware('can:manage_sales')->group(function(){
        Route::get('/sales' ,[SaleItemController::class, 'index'])->name('SalesItem.index');
        Route::get('/sales/create', [SaleItemController::class, 'create'])->name('SalesItem.create');
        Route::post('/sales',[SaleItemController::class, 'store']);
        Route::get('/sales/{sale}',[SaleController::class,'show'])->name('SalesItem.show');
          // Route for customers
        Route::get('/customers' ,[CustomerController::class, 'index'])->name('customer.index');
        Route::get('/customers/create',[CustomerController::class , 'create']);
        Route::post('/customers',[CustomerController::class, 'store']);
        Route::get('/customers/edit/{customer}', [CustomerController::class, 'edit']);
        Route::put('/customers/{customer}', [CustomerController::class, 'update']);
        Route::get('/customers/{customer}',[CustomerController::class,'show']);
        Route::delete('/customers/{customer}', [CustomerController::class, 'destroy']);

    });

    Route::middleware('can:view_sales')->group(function(){

        Route::get('/histories' ,[SaleController::class, 'index'])->name('SalesHistory.index');
        Route::get('/salesChart' ,[SaleHistoryController::class, 'index'])->name('SalesHistory.chart');

    });

    Route::middleware('can:manage_feeds')->group(function(){
         //Route for suppliers
        Route::get('/suppliers' ,[SupplierController::class, 'index'])->name('suppliers.index');
        Route::get('/suppliers/create',[SupplierController::class , 'create']);
        Route::post('/suppliers',[SupplierController::class, 'store']);

        Route::get('/categories' ,[CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create',[CategoryController::class , 'create']);
        Route::post('/categories',[CategoryController::class, 'store']);

        Route::get('/feeds' ,[FeedController::class, 'index'])->name('feeds.index');
        Route::get('/feeds/create',[FeedController::class , 'create']);
        Route::post('/feeds',[FeedController::class, 'store']);

        Route::get('/feeds-purchase' ,[FeedsPurchaseController::class, 'index'])->name('purchase.index');
        Route::post('/feeds-purchase',[FeedsPurchaseController::class, 'store']);
        Route::put('/feeds-purchase/{feedsPurchase}', [FeedsPurchaseController::class, 'update']);
        Route::get('/sales/pdf/{sale}',[PdfController::class,'salesReceipt']);
        Route::get('/feeds-purchase/pdf/',[PdfController::class,'feedsPurchase']);
        Route::get('/feeds-purchases/pdf/',[PdfController::class,'feedsConsumption'])->name('consumption.pdf');

        Route::get('/feeds-consumption' ,[ConsumptionController::class, 'index'])->name('consumption.index');
        Route::post('/feeds-consumption',[ConsumptionController::class, 'store']);
    });

    Route::middleware('can:manage_users')->group(function(){
        Route::get('/positions', [PositionController::class, 'index'])->name('positions.index');
        Route::post('/positions', [PositionController::class, 'store']);

        Route::get('/employees/create',[EmployeeController::class , 'create']);
        Route::post('/employees', [EmployeeController::class, 'store']);
        Route::get('/employees/edit/{employee}',[EmployeeController::class , 'edit']);
        Route::post('/employees/toggle/{employee}', [EmployeeController::class, 'toggleActive'])->name('employees.toggle');
        Route::put('/employees/{employee}', [EmployeeController::class, 'update']);
        Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy']);

    });
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index')->middleware('can:read_users');

    Route::middleware('can:manage_users')->group(function(){
    Route::get('/users',[UserController::class, 'index'])->name('user.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/users',[UserController::class, 'store'])->name('user.store');
    Route::get('/users/edit/{user}', [UserController::class, 'edit']);
    Route::put('/users/{user}',[UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
    });

    Route::middleware('can:manage_finance' )->group(function(){
    Route::get('/transactions',[FinancialTransactionController::class, 'index'])->name('transaction.index');
    Route::get('/transactions-charts',[FinancialTransactionItemsController::class, 'index'])->name('transactions.chart');
    Route::get('/transactions/create', [FinancialTransactionController::class, 'create']);
    // Route::post('/transactions',[FinancialTransactionItemsController::class, 'store']);
    Route::post('/transactions',[FinancialTransactionController::class, 'store']);
    Route::get('/transactions/{financialTransaction}',[FinancialTransactionController::class, 'show']);

    });

    Route::get('/financial}',[FinancialTransactionController::class, 'financial'])->name('transaction.financial')->middleware('can:manage_reports');

    Route::middleware('can:manage_payroll')->group(function(){
        Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
        Route::get('/payroll/create', [PayrollController::class, 'create'])->name('payroll.create');
        Route::post('/payroll', [PayrollItemController::class, 'store'])->name('payroll.create');
        Route::get('/payroll/{payroll}',[PayrollController::class,'show']);

        Route::get('/cashAdvance', [CashAdvanceController::class, 'index'])->name('cashAdvance.index');
        Route::get('/cashAdvance/create', [CashAdvanceController::class, 'create'])->name('cashAdvance.create');
        Route::post('/cashAdvance',[CashAdvanceController::class, 'store'])->name('cashAdvance.store');

    });


    Route::get('/payrolls', [PayrollController::class, 'payroll'])->name('payroll.payroll')->middleware('can:manage_reports');

    Route::get('/payslip', [PayrollItemController::class, 'showMyPayroll'])->name('payroll.payslip')->middleware('can:read_payslip');


    Route::middleware('can:view_invoice')->group(function(){
        Route::get('/transactions/pdf/{financialTransaction}', [PdfController::class, 'transaction'])->name('transaction.pdf');
        Route::get('/employee/pdf/',[PdfController::class,'employeeSummary'])->name('employee.pdf');
        Route::get('/payrolls/pdf', [PdfController::class, 'payrollHistory'])->name('payroll.pdf');
        Route::get('/payroll/pdf/{payroll}',[PdfController::class,'payrollSummary']);
        Route::get('/boar/pdf/',[PdfController::class,'boars'])->name('boars.pdf');
        Route::get('/sow/pdf/',[PdfController::class,'sows'])->name('sows.pdf');
        Route::get('/labor/pdf/',[PdfController::class,'labors'])->name('labors.pdf');
        Route::get('/weanings/pdf/',[PdfController::class,'weanings'])->name('weanings.pdf');
        Route::get('/breeding/pdf/',[PdfController::class,'breedings'])->name('breeding.pdf');
        Route::get('/cashAdvance/pdf/',[PdfController::class,'cashAdvance'])->name('cashAdvance.pdf');
        Route::get('/transaction/pdf/',[PdfController::class,'transactionSummary'])->name('transaction.pdf');
    });


});





require __DIR__.'/auth.php';
