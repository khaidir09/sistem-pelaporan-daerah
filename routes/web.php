<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\LaporanController;
use App\Http\Controllers\Backend\OutcomeController;
use App\Http\Controllers\Backend\SkpdController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UrusanController;
use App\Http\Controllers\Pengawas\LaporanPengawasController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

Route::middleware('auth')->group(function () {

    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/profile/store', [AdminController::class, 'ProfileStore'])->name('profile.store');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
});


Route::middleware('auth')->group(function () {

    // Route::resource('master/urusan', UrusanController::class);
    // Route::post('/update/urusan', [UrusanController::class, 'update'])->name('update.urusan');

    Route::controller(UrusanController::class)->group(function () {
        Route::get('/master/urusan', 'index')->name('urusan.index');
        // Route::get('/master/urusan/create', 'create')->name('urusan.create');
        Route::post('/master/urusan/store', 'store')->name('urusan.store');
        Route::get('/master/urusan/edit/{id}', 'edit')->name('urusan.edit');
        Route::post('/master/urusan/update/{id}', 'update')->name('urusan.update');
        Route::get('/master/urusan/delete/{id}', 'destroy')->name('urusan.destroy');
    });

    Route::controller(OutcomeController::class)->group(function () {
        Route::get('/master/outcome', 'index')->name('outcome.index');
        Route::get('/master/outcome/create', 'create')->name('outcome.create');
        Route::post('/master/outcome/store', 'store')->name('outcome.store');
        Route::get('/master/outcome/edit/{id}', 'edit')->name('outcome.edit');
        Route::post('/master/outcome/update/{id}', 'update')->name('outcome.update');
        Route::get('/master/outcome/delete/{id}', 'destroy')->name('outcome.destroy');
    });

    Route::controller(SkpdController::class)->group(function () {
        Route::get('/master/skpd', 'index')->name('skpd.index');
        Route::post('/master/skpd/store', 'store')->name('skpd.store');
        Route::get('/master/edit/skpd/{id}', 'edit')->name('skpd.edit');
        Route::post('/master/skpd/update/{id}', 'update')->name('skpd.update');
        Route::get('/master/skpd/delete/{id}', 'destroy')->name('skpd.destroy');
    });

    Route::controller(LaporanController::class)->group(function () {
        Route::get('/laporan/ikk', 'index')->name('laporan.index');
        Route::get('/laporan/ikk/create/{id}', 'create')->name('laporan.create');
        Route::post('/laporan/ikk/store', 'store')->name('laporan.store');
        Route::get('/laporan/edit/ikk/{id}', 'edit')->name('laporan.edit');
        Route::post('/laporan/ikk/update/{id}', 'update')->name('laporan.update');
        Route::get('/laporan/ikk/delete/{id}', 'destroy')->name('laporan.destroy');
    });

    Route::controller(LaporanPengawasController::class)->group(function () {
        Route::get('/pengawas/laporan/detail/ikk/{id}', 'show')->name('laporan-pengawas.show');
        Route::post('/pengawas/laporan/ikk/update/{id}', 'storeReviu')->name('laporan-pengawas.update');
    });

    Route::controller(SupplierController::class)->group(function () {
        Route::get('/all/customer', 'AllCustomer')->name('all.customer');
        Route::get('/add/customer', 'AddCustomer')->name('add.customer');
        Route::post('/store/customer', 'StoreCustomer')->name('store.customer');
        Route::get('/edit/customer/{id}', 'EditCustomer')->name('edit.customer');
        Route::post('/update/customer', 'UpdateCustomer')->name('update.customer');
        Route::get('/delete/customer/{id}', 'DeleteCustomer')->name('delete.customer');
    });


    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/permission', 'AllPermission')->name('all.permission');
        Route::get('/add/permission', 'AddPermission')->name('add.permission');
        Route::post('/store/permission', 'StorePermission')->name('store.permission');
        Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');
        Route::post('/update/permission', 'UpdatePermission')->name('update.permission');
        Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');
    });

    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/roles', 'AllRoles')->name('all.roles');
        Route::get('/add/roles', 'AddRoles')->name('add.roles');
        Route::post('/store/roles', 'StoreRoles')->name('store.roles');
        Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.roles');
        Route::post('/update/roles', 'UpdateRoles')->name('update.roles');
        Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles');
    });

    Route::controller(RoleController::class)->group(function () {
        Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
        Route::post('/role/permission/store', 'RolePermissionStore')->name('role.permission.store');
        Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission');

        Route::get('/admin/edit/roles/{id}', 'AdminEditRoles')->name('admin.edit.roles');
        Route::post('/admin/roles/update/{id}', 'AdminRolesUpdate')->name('admin.roles.update');
        Route::get('/admin/delete/roles/{id}', 'AdminDeleteRoles')->name('admin.delete.roles');
    });


    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/admin', 'AllAdmin')->name('all.admin');
        Route::get('/add/admin', 'AddAdmin')->name('add.admin');
        Route::post('/store/admin', 'StoreAdmin')->name('store.admin');
        Route::get('/edit/admin/{id}', 'EditAdmin')->name('edit.admin');
        Route::post('/update/admin/{id}', 'UpdateAdmin')->name('update.admin');
        Route::get('/delete/admin/{id}', 'DeleteAdmin')->name('delete.admin');
    });
});
