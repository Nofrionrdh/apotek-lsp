<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\JenisObatController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Middleware\CheckUserJabatan;
use App\Http\Middleware\RoleAuth;
use Illuminate\Support\Facades\Auth;




// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('/register', [AuthController::class, 'store'])->name('auth.register');

Route::get('/register', [AuthController::class, 'registerForm'])->middleware('guest')->name('registerForm');
Route::post('/register', [AuthController::class, 'registerProcess'])->middleware('guest')->name('registerProcess');

Route::get('/admin', [AdminController::class, 'index'])->name('Auth.Login')->middleware(Roleauth::class . ':admin');


Route::middleware('guest')->group(function () {
    Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'loginUser'])->name('login-user');
    Route::get('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'registerUser'])->name('register-user');
});

// Logout (Hanya bisa diakses oleh user yang sudah login)
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Role-based dashboard
// Route::middleware(['auth.role:admin'])->get('/admin', fn() => view('admin.dashboard'));
// Route::middleware(['auth.role:apoteker'])->get('/apoteker', fn() => view('apoteker.dashboard'));
// Route::middleware(['auth.role:pemilik'])->get('/pemilik', fn() => view('pemilik.dashboard'));
// Route::middleware(['auth.role:kasir'])->get('/kasir', fn() => view('kasir.dashboard'));
// Route::middleware(['auth.role:karyawan'])->get('/karyawan', fn() => view('karyawan.dashboard'));

// dst...

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/', App\Http\Controllers\HomeController::class);
Route::resource('/home', App\Http\Controllers\HomeController::class);
Route::resource('/contact', App\Http\Controllers\ContactController::class);
Route::resource('/about', App\Http\Controllers\AboutController::class);
Route::resource('/keranjang', App\Http\Controllers\KeranjangController::class);

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->level === 'admin') {
        return redirect()->route('admin');
    }
    if ($user->level === 'karyawan') {
        return redirect()->route('karyawan');
    }
    if ($user->level === 'apoteker') {
        return redirect()->route('apoteker');
    }
    if ($user->level === 'pemilik') {
        return redirect()->route('pemilik');
    }
    if ($user->level === 'kasir') {
        return redirect()->route('kasir');
    }

    return redirect()->back()->withErrors('Unauthorized access.');
})->middleware('auth')->name('dashboard');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])
    ->middleware(['auth',  RoleAuth::class . ':admin'])
    ->name('admin');

Route::get('/karyawan', [App\Http\Controllers\KaryawanController::class, 'index'])
    ->middleware(['auth', RoleAuth::class . ':karyawan'])
    ->name('karywanan');

Route::get('/pemilik', [App\Http\Controllers\PemilikController::class, 'index'])
    ->middleware(['auth', RoleAuth::class . ':pemilik'])
    ->name('pemilik');

Route::get('/apoteker', [App\Http\Controllers\ApotekerController::class, 'index'])
    ->middleware(['auth', RoleAuth::class . ':apoteker'])
    ->name('apoteker');

Route::get('/kasir', [App\Http\Controllers\KasirController::class, 'index'])
    ->middleware(['auth', RoleAuth::class . ':kasir'])
    ->name('kasir');

Route::middleware(['auth', RoleAuth::class . ':apoteker'])->group(function () {
    Route::resource('obat', ObatController::class);
    Route::resource('jenis-obat', JenisObatController::class);
});

Route::middleware(['auth', RoleAuth::class . ':admin'])->group(function () {
    Route::resource('manage-user', ManageUserController::class);
});

Route::middleware(['auth', RoleAuth::class . ':apoteker'])->group(function () {
    Route::resource('distributor', DistributorController::class);
});

Route::middleware(['auth', RoleAuth::class . ':apoteker'])->group(function () {
    Route::resource('pembelian', PembelianController::class);
});

Route::middleware(['auth', RoleAuth::class . ':kasir'])->group(function () {
    Route::resource('penjualan', PenjualanController::class);
    Route::put('penjualan/{id}/approve', [PenjualanController::class, 'approve'])->name('penjualan.approve');
    Route::put('penjualan/{id}/reject', [PenjualanController::class, 'reject'])->name('penjualan.reject');
});

// Admin routes
Route::resource('obat', ObatController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/keranjang', [KeranjangController::class, 'index'])->name('fe.keranjang.index');

Route::get('/manage-user', [App\Http\Controllers\ManageUserController::class, 'index'])->name('manage-user.index');
Route::get('/manage-user/create', [App\Http\Controllers\ManageUserController::class, 'create'])->name('manage-user.create');
Route::post('/manage-user/store', [App\Http\Controllers\ManageUserController::class, 'store'])->name('manage-user.store');
Route::get('/manage-user/{id}/edit', [App\Http\Controllers\ManageUserController::class, 'edit'])->name('manage-user.edit');
Route::put('/manage-user/{id}', [App\Http\Controllers\ManageUserController::class, 'update'])->name('manage-user.update');
Route::delete('/manage-user/{id}', [App\Http\Controllers\ManageUserController::class, 'destroy'])->name('manage-user.destroy');

Route::get('/obat', [App\Http\Controllers\ObatController::class, 'index'])->name('obat.index');
Route::get('/obat/create', [App\Http\Controllers\ObatController::class, 'create'])->name('obat.create');
Route::post('/obat/store', [App\Http\Controllers\ObatController::class, 'store'])->name('obat.store');
Route::get('/obat/{id}/edit', [App\Http\Controllers\ObatController::class, 'edit'])->name('obat.edit');
Route::put('/obat/{id}', [App\Http\Controllers\ObatController::class, 'update'])->name('obat.update');
Route::delete('/obat/{id}', [App\Http\Controllers\ObatController::class, 'destroy'])->name('obat.destroy');

Route::get('/jenis-obat', [App\Http\Controllers\JenisObatController::class, 'index'])->name('jenis-obat.index');
Route::get('/jenis-obat/create', [App\Http\Controllers\JenisObatController::class, 'create'])->name('jenis-obat.create');
Route::post('/jenis-obat/store', [App\Http\Controllers\JenisObatController::class, 'store'])->name('jenis-obat.store');
Route::get('/jenis-obat/{id}/edit', [App\Http\Controllers\JenisObatController::class, 'edit'])->name('jenis-obat.edit');
Route::put('/jenis-obat/{id}', [App\Http\Controllers\JenisObatController::class, 'update'])->name('jenis-obat.update');
Route::delete('/jenis-obat/{id}', [App\Http\Controllers\JenisObatController::class, 'destroy'])->name('jenis-obat.destroy');

Route::get('/distributor', [App\Http\Controllers\DistributorController::class, 'index'])->name('distributor.index');
Route::get('/distributor/create', [App\Http\Controllers\DistributorController::class, 'create'])->name('distributor.create');
Route::post('/distributor/store', [App\Http\Controllers\DistributorController::class, 'store'])->name('distributor.store');
Route::get('/distributor/{id}/edit', [App\Http\Controllers\DistributorController::class, 'edit'])->name('distributor.edit');
Route::put('/distributor/{id}', [App\Http\Controllers\DistributorController::class, 'update'])->name('distributor.update');
Route::delete('/distributor/{id}', [App\Http\Controllers\DistributorController::class, 'destroy'])->name('distributor.destroy');

Route::get('pembelian', [App\Http\Controllers\PembelianController::class, 'index'])->name('pembelian.index');
Route::get('pembelian/create', [App\Http\Controllers\PembelianController::class, 'create'])->name('pembelian.create');
Route::post('pembelian/store', [App\Http\Controllers\PembelianController::class, 'store'])->name('pembelian.store');
Route::get('pembelian/{id}/edit', [App\Http\Controllers\PembelianController::class, 'edit'])->name('pembelian.edit');
Route::put('pembelian/{id}', [App\Http\Controllers\PembelianController::class, 'update'])->name('pembelian.update');
Route::delete('pembelian/{id}', [App\Http\Controllers\PembelianController::class, 'destroy'])->name('pembelian.destroy');

Route::get('/products', [HomeController::class, 'product'])->name('products');
Route::get('/product', [App\Http\Controllers\HomeController::class, 'product'])->name('product');
