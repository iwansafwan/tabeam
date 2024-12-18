<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\GeneralFundController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'welcome_page']);
Route::get('/guest/fund_detail/{id}', [FundController::class, 'guest_fund_details'])->name('guest.fund_details');
Route::get('/guest/general_fund_detail', [GeneralFundController::class, 'guest_fund_details'])->name('guest.general_fund_details');
Route::get('/guest/donate_general/{fund}', [FundController::class, 'guest_donate_general'])->name('guest.donate_general');
Route::get('/guest/donate_main/{fund}', [FundController::class, 'guest_donate_main'])->name('guest.donate_main');
Route::get('/guest/donate_section/{fund}/{section}', [FundController::class, 'guest_donate_section'])->name('guest.donate_section');


// Define the dashboard routes for admin and treasurer and donator
Route::middleware(['auth', 'verified'])->group(function () {

    // admin route
    Route::get('/admin/dashboard', [HomeController::class, 'admin_dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [HomeController::class, 'admin_users'])->name('admin.users');
    Route::post('/admin/create_treasurer', [HomeController::class, 'admin_create_treasurer'])->name('admin.create_treasurer');
    Route::get('/admin/treasurer/{id}', [FundController::class, 'admin_view_treasurer'])->name('admin.view_treasurer');
    Route::get('/admin/donator/{id}', [InvoiceController::class, 'admin_view_donator'])->name('admin.view_donator');
    Route::get('/admin/funds', [FundController::class, 'admin_fund'])->name('admin.funds');
    Route::get('/admin/general_fund', [GeneralFundController::class, 'show'])->name('admin.general_fund');
    Route::get('/admin/fund/{id}', [FundController::class, 'admin_show'])->name('admin.view');
    Route::get('/admin/transaction', [InvoiceController::class, 'admin_transaction_list'])->name('admin.transaction');

    // treasurer route
    Route::get('/treasurer/dashboard', [HomeController::class, 'treasurer_dashboard'])->name('treasurer.dashboard');
    Route::get('/treasurer/funds', [FundController::class, 'treasurer_fund'])->name('treasurer.funds');
    Route::post('/treasurer/submit_fund', [FundController::class, 'store'])->name('treasurer.submit_fund');
    Route::get('/treasurer/fund/{id}', [FundController::class, 'show'])->name('treasurer.view');
    Route::get('/treasurer/edit_fund/{id}', [FundController::class, 'edit'])->name('treasurer.edit_fund');
    Route::post('/treasurer/update_fund', [FundController::class, 'update'])->name('treasurer.update_fund');
    Route::get('/treasurer/transaction', [InvoiceController::class, 'treasurer_transaction_list'])->name('treasurer.transaction');
    Route::post('/treasurer/terminate_fund', [FundController::class, 'treasurer_terminate_fund'])->name('treasurer.terminate_fund');

    // donator route
    Route::get('/donator/dashboard', [HomeController::class, 'donator_dashboard'])->name('donator.dashboard');
    Route::get('/donator/scan_qr', [FundController::class, 'donator_scan_qr'])->name('donator.scan_qr');
    Route::get('/donator/donate_general/{fund}', [FundController::class, 'donator_donate_general'])->name('donator.donate_general');
    Route::get('/donator/donate_main/{fund}', [FundController::class, 'donator_donate_main'])->name('donator.donate_main');
    Route::get('/donator/donate_section/{fund}/{section}', [FundController::class, 'donator_donate_section'])->name('donator.donate_section');
    Route::post('/donator/submit_payment', [InvoiceController::class, 'donator_submit_payment'])->name('donator.submit_payment');
    Route::get('/donator/transaction', [InvoiceController::class, 'donator_transaction_list'])->name('donator.transaction');

    
    // QR route
    Route::get('/funds/fund_details/{id}', [FundController::class, 'fund_details'])->name('funds.fund_details');
    Route::get('/general_funds/fund_details/{id}', [GeneralFundController::class, 'fund_details'])->name('general_funds.fund_details');
    Route::get('/funds/update_fund_status', [FundController::class, 'update_fund_status'])->name('funds.update_fund_status');
    Route::get('/general_funds/check_general_qrcode', [GeneralFundController::class, 'check_general_qr_code'])->name('general_funds.check_general_qrcode');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
