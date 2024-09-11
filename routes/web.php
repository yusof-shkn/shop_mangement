<?php

use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\redirectController;
use App\Http\Controllers\service_managerController;
use App\Http\Controllers\inventory_managerController;
use App\Http\Controllers\registrationController;
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/registration/{role}',[registrationController::class,'registration']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard',
        [redirectController::class,'redirectUser']
    )->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin',
])->prefix('admin')->group(function () {
    Route::get('/dashboard',[adminController::class,'index'])->name('admin.dashboard');
    // employee routes
    Route::get('/search-employee',[adminController::class, 'search_employee'])->name('admin.search_employee');
    Route::post('/create-employee',[adminController::class,'create_employee'])->name('admin.create_employee');
    Route::post('/update-employee',[adminController::class,'update_employee'])->name('admin.update_employee');
    Route::post('/delete-employee',[adminController::class,'delete_employee'])->name('admin.delete_employee');
    Route::post('/create-employee-account',[adminController::class,'account_employee'])->name('admin.account_employee');
    Route::get('/employee-shifts/{id}',[adminController::class, 'shifts'])->name('admin.employee_shifts');
    Route::post('/employee-shift-delete',[adminController::class, 'delete_shift'])->name('admin.delete_employee_shift');
    // product routes
    Route::get('/search-product',[adminController::class, 'search_product'])->name('admin.search_product');
    Route::post('/create-product',[adminController::class, 'create_product'])->name('admin.create_product');
    Route::post('/update-product',[adminController::class, 'update_product'])->name('admin.update_product');
    Route::post('/delete-product',[adminController::class, 'delete_product'])->name('admin.delete_product');
    Route::get('/show-products/{id}',[adminController::class, 'show_products'])->name('admin.show_products');
    Route::post('/show-products/update-markup',[adminController::class, 'update_product_markup'])->name('admin.update_Product_markup');
    // sales and purchases
    Route::get('/sales',[adminController::class, 'sales'])->name('admin.sales');
    Route::get('/purchases',[adminController::class, 'purchases'])->name('admin.purchase');
    // salaries page
    Route::post('/employee-salary',[adminController::class, 'employee_salary'])->name('admin.employee_salary');
    Route::get('/salaries',[adminController::class, 'salaries'])->name('admin.salaries');
    Route::get('/delete-salary',[adminController::class, 'delete_salary'])->name('admin.delete_salary');
    
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:inventory_manager',
])->prefix('inventory_manager')->group(function () {
    Route::get('/dashboard',[inventory_managerController::class,'index'])->name('inventory_manager.dashboard');
    Route::get('/search',[inventory_managerController::class, 'search']);
    Route::post('/create-new-product',[inventory_managerController::class, 'create'])->name('inventory_manager.create_product');
    Route::post('/update_product',[inventory_managerController::class, 'update'])->name('inventory_manager.update_product');
    Route::post('/dashboard',[inventory_managerController::class,'purchases']);
    Route::get('/records',[inventory_managerController::class,'record_search']);
    Route::get('/records',[inventory_managerController::class,'records'])->name('inventory_manager.records');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:service_manager',
])->prefix('service_manager')->group(function () {
    Route::get('/search',[service_managerController::class, 'search']);
    Route::post('/dashboard',[service_managerController::class,'sales']);
    Route::get('/records',[service_managerController::class,'record_search']);
    Route::get('/records',[service_managerController::class,'records'])->name('service_manager.records');
    Route::get('/dashboard',[service_managerController::class,'index'])->name('service_manager.dashboard');
});
