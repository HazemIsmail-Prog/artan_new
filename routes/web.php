<?php

use App\Http\Controllers\Financial\Reports\AccountStatementController;
use App\Http\Controllers\Financial\Reports\BalanceSheetController;
use App\Http\Controllers\Financial\Reports\BankBookController;
use App\Http\Controllers\Financial\Reports\ProfitLossController;
use App\Http\Controllers\Financial\Reports\TrialBalanceController;
use App\Http\Livewire\Accounts\AccountsIndex;
use App\Http\Livewire\Dashboard\DashbordIndex;
use App\Http\Livewire\Orders\OrderIndex;
use App\Http\Livewire\Users\UsersIndex;
use App\Http\Livewire\Vouchers\VoucherForm;
use App\Http\Livewire\Vouchers\VouchersIndex;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/mf',function(){
    Artisan::call('migrate:fresh');
    return redirect()->route('dashboard');
});
Route::get('/os',function(){
    Artisan::call('db:seed OrderSeeder');
    return redirect()->route('dashboard');
});

Route::group(['middleware' => 'auth'], function(){

    //Livewire
    Route::get('/',                             DashbordIndex::class)   ->name('dashboard');
    Route::get('/users',                        UsersIndex::class)      ->name('users.index');
    Route::get('/orders',                       OrderIndex::class)      ->name('orders.index');
    Route::get('/accounts',                     AccountsIndex::class)   ->name('accounts.index');
    Route::get('/vouchers/{type}',              VouchersIndex::class)   ->name('vouchers.index');
    Route::get('/voucher-form/{type}/{id?}',    VoucherForm::class)     ->name('vouchers.form');
    
    //Financial Reports Routes
    Route::get('/account_statement',            [AccountStatementController::class, 'index' ])->name('account_statement.index');
    Route::get('/account_statement/export',     [AccountStatementController::class, 'export'])->name('account_statement.export');
    Route::get('/bank_book',                    [BankBookController::class,         'index' ])->name('bank_book.index');
    Route::get('/bank_book/export',             [BankBookController::class,         'export'])->name('bank_book.export');
    Route::get('/trial_balance',                [TrialBalanceController::class,     'index' ])->name('trial_balance.index');
    Route::get('/trial_balance/export',         [TrialBalanceController::class,     'export'])->name('trial_balance.export');
    Route::get('/balance_sheet',                [BalanceSheetController::class,     'index' ])->name('balance_sheet.index');
    Route::get('/balance_sheet/export',         [BalanceSheetController::class,     'export'])->name('balance_sheet.export');
    Route::get('/profit_loss',                  [ProfitLossController::class,       'index' ])->name('profit_loss.index');
    Route::get('/profit_loss/export',           [ProfitLossController::class,       'export'])->name('profit_loss.export');
});

