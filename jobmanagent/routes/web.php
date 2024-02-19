<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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
    return view('home');
});
Route::get('/home', function () {
    return view('home');
});
// routes/web.php
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/employee', 'EmployeeController@dashboard')->name('employee.dashboard');
        Route::post('/create-job-application', 'EmployeeController@createJobApplication')->name('employee.createJobApplication');
        Route::get('/finance', 'FinanceController@dashboard')->name('finance.dashboard');
        Route::get('/admin', 'AdminController@dashboard')->name('admin.dashboard');
        Route::post('/approve-job-application/{id}', 'AdminController@approveJobApplication')->name('admin.approveJobApplication');
        Route::post('/reject-job-application/{id}', 'AdminController@rejectJobApplication')->name('admin.rejectJobApplication');
    });
    
});
// routes/web.php

Route::middleware(['auth', 'role:employee'])->group(function () {
    Route::get('/employee/dashboard', 'EmployeeController@dashboard')->name('employee.dashboard');
    Route::get('/employee/create-job-application', 'JobApplicationController@create')->name('employee.createJobApplication');
    Route::post('/employee/store-job-application', 'JobApplicationController@store')->name('employee.storeJobApplication');
    Route::get('/employee/view-job-application-status/{id}', 'JobApplicationController@viewStatus')->name('employee.viewJobApplicationStatus');    Route::get('/user/profile-settings', 'UserController@profileSettings')->name('user.profileSettings');
    Route::post('/user/update-password', 'UserController@updatePassword')->name('user.updatePassword');
    Route::get('/user/reset-password', 'UserController@resetPassword')->name('user.resetPassword');
    Route::post('/employee/update-status/{id}', 'JobApplicationController@updateStatus')->name('employee.updateStatus');
    Route::get('/employee/view-job-application-status/{id}', 'EmployeeController@viewJobApplicationStatus')->name('employee.viewJobApplicationStatus');
    Route::get('/employee/profile-settings', 'EmployeeController@profileSettings')->name('employee.profileSettings');
    Route::get('/employee/change-password', 'EmployeeController@changePassword')->name('employee.changePassword');



});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::post('/admin/register-employee', 'AdminController@registerEmployee')->name('admin.registerEmployee');
    Route::get('/admin/view-job-applications', 'AdminController@viewJobApplications')->name('admin.viewJobApplications');
    Route::post('/admin/approve-job-application/{id}', 'AdminController@approveJobApplication')->name('admin.approveJobApplication');
    Route::post('/admin/reject-job-application/{id}', 'AdminController@rejectJobApplication')->name('admin.rejectJobApplication');
    Route::get('/show-approved-applications', 'AdminController@showApprovedApplications')->name('show-approved-applications');
    Route::get('/show-rejected-applications', 'AdminController@showRejectedApplications')->name('show-rejected-applications');
    Route::get('/department/{name}/dashboard', 'DepartmentController@dashboard')
    ->middleware(['department:finance,admin,production,stock'])->name('department.dashboard');
    
    Route::get('/admin/show-employee-registration-form', 'AdminController@showEmployeeRegistrationForm')->name('admin.showEmployeeRegistrationForm')->middleware('permission:show-employee-registration-form');
    Route::get('/admin/show-admin-registration-form', 'AdminController@showAdminRegistrationForm')->name('admin.showAdminRegistrationForm')->middleware('permission:show-admin-registration-form');
    Route::post('/admin/create-admin', 'AdminController@createAdmin')->name('admin.createAdmin');
    Route::get('/show-pending-applications', 'AdminController@showPendingApplications')->name('show-pending-applications');

    Route::get('/admin/manage-users', 'AdminController@manageUsers')->name('admin.manageUsers')->middleware('permission:manage-users');
    Route::get('/edit-user/{id}', 'UserController@editUser')->name('edit-user');
    Route::post('/update-user/{id}', 'UserController@updateUser')->name('update-user');
    Route::get('/delete-user/{id}', 'UserController@deleteUser')->name('delete-user');

});
Route::middleware(['auth', 'role:admin|finance|production|stockkeeper'])->group(function () {
    Route::post('/stock/update-stock', 'StockController@updateStock')->name('stock.updateStock');
    Route::get('/reports/generate', 'ReportController@generate')->name('reports.generate');
    Route::get('/reports/generate', 'ReportController@generate')->name('reports.generate');
    Route::get('/reports/generate', 'ReportController@generate')->name('reports.generate');
    Route::get('/admin/approve-job-application/{id}', 'AdminController@approveJobApplication')->name('admin.approveJobApplication');
    Route::get('/reports/generate-by-role/{role}', 'ReportController@generateByRole')->name('reports.generateByRole');


});

Route::middleware(['auth', 'role:finance'])->group(function () {
    Route::get('/finance/dashboard', 'FinanceController@dashboard')->name('finance.dashboard');
    Route::post('/finance/approve-job-application/{id}', 'FinanceController@approveJobApplication')->name('finance.approveJobApplication');
    Route::post('/finance/reject-job-application/{id}', 'FinanceController@rejectJobApplication')->name('finance.rejectJobApplication');
    Route::post('/finance/approve-stock-requisition/{id}', 'FinanceController@approveStockRequisition')->name('finance.approveStockRequisition');

});

Route::middleware(['auth', 'role:production'])->group(function () {
    Route::get('/production/check-materials/{id}', 'ProductionController@checkMaterials')->name('production.checkMaterials');
    Route::post('/production/start-production/{id}', 'ProductionController@startProduction')->name('production.startProduction');
    Route::get('/production/dashboard', 'ProductionController@dashboard')->name('production.dashboard');
    Route::post('/production/check-stock', 'ProductionController@checkStock')->name('production.checkStock');
    // Route::post('/production/start-production/{id}', 'ProductionController@startProduction')->name('production.startProduction');
    Route::post('/production/notify-employees/{id}', 'ProductionController@notifyEmployees')->name('production.notifyEmployees');
    Route::get('/production/check-materials-availability/{id}', 'ProductionController@checkMaterialsAvailability')->name('production.checkMaterialsAvailability');
    Route::get('/production/confirm-start-production/{id}', 'ProductionController@confirmStartProduction')->name('production.confirmStart');
    Route::get('/production/create-stock-requisition/{id}', 'ProductionController@createStockRequisition')->name('production.createStockRequisition');
});

Route::middleware(['auth', 'role:stockkeeper'])->group(function () {
    Route::post('/stock/raise-requisition', 'StockController@raiseRequisition')->name('stock.raiseRequisition');
    Route::post('/stock/update-stock', 'StockController@updateStock')->name('stock.updateStock');
    Route::post('/stock/update-stock/{id}', 'StockKeeperController@updateStock')->name('stock.updateStock');
    Route::get('/stock/approve-stock-requisition/{id}', 'StockKeeperController@approveStockRequisition')->name('stock.approveStockRequisition');
    Route::get('/stock/view-stock-requisition/{id}', 'StockKeeperController@viewStockRequisition')->name('stock.viewStockRequisition');
    Route::get('/stock/reject-stock-requisition/{id}', 'StockKeeperController@rejectStockRequisition')->name('stock.rejectStockRequisition');
    
});

    Route::get('/profile/show-profile', 'ProfileController@showProfile')->name('profile.showProfile');
    Route::post('/profile/update-profile', 'ProfileController@updateProfile')->name('profile.updateProfile');

    Route::get('/profile/show-password-reset', 'ProfileController@showPasswordReset')->name('profile.showPasswordReset');
    Route::post('/profile/update-password', 'ProfileController@updatePassword')->name('profile.updatePassword');

