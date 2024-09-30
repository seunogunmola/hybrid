<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\PinController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;

require __DIR__ . '/auth.php';

// Staff Routes
Route::get('/verify',[StaffController::class,'verify'])->name('verify.page');
Route::post('/verify',[StaffController::class,'verifyPin'])->name('verify');

Route::get('/register',[StaffController::class,'register'])->name('staff.register');
Route::post('/register',[StaffController::class,'store'])->name('staff.store');

Route::get('/success',[StaffController::class,'success'])->name('register.success');

Route::get('/form',[StaffController::class,'form'])->name('staff.form');
Route::post('/form',[StaffController::class,'storeForm'])->name('staff.form.store');


Route::get('/', function () {
    $pageTitle = 'Login';
    return view('/admin/login', compact('pageTitle'));
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


#USERS
Route::middleware(['auth', 'role:user'])->group(
    function () {
        Route::controller(UserController::class)->group(
            function () {
                Route::get('logout', 'logout')->name('user.logout');
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

                Route::get('/mail/view/{uniqueid}', 'viewMail')->name('user.mail.view');
            }

        );
    }
);

//ADMIN 
#Admin Routes
Route::middleware(['auth', 'role:admin'])->group(
    function () {
        //Staff
        Route::get('admin/staff',[StaffController::class,'index'])->name('admin.staffs.index');
        Route::get('admin/{user}/delete',[StaffController::class,'destroy'])->name('admin.staffs.delete');
        //Pins
        Route::get('/admin/pins',[PinController::class,'index'])->name('admin.pins.index');
        
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

        #MAILS
        Route::controller(MailController::class)->group(
            function () {
                //ALL MAILS
                Route::get('admin/mail/index', 'index')->name('admin.mail.index');

                // EDIT MAIL 
                Route::get('/admin/mail/edit/{uniqueid}', 'edit')->name('admin.mail.edit');

                // UPDATE MAIL
                Route::post('/admin/mail/update/{id}', 'update')->name('admin.mail.update');

                //SHOW MAIL CREATION FORM
                Route::get('admin/mail/create', 'create')->name('admin.mail.create');
                //STORE MAIL
                Route::post('admin/mail/store', 'store')->name('admin.mail.store');

                Route::get('/admin/mail/delete/{id}', 'destroy')->name('admin.mail.delete');

                Route::get('/admin/main/view/{uniqueid}', 'view')->name('admin.mail.view');
            }
        );

        #CATEGORIES
        Route::controller(CategoryController::class)->group(
            function () {
                Route::get('/admin/category/list', 'index')->name('admin.category.list');
                Route::get('/admin/category/create', 'create')->name('admin.category.create');
                Route::post('/admin/category/store', 'store')->name('admin.category.store');
                Route::get('/admin/category/edit/{uniqueid}', 'edit')->name('admin.category.edit');
                Route::get('/admin/category/delete/{id}', 'destroy')->name('admin.category.delete');

                Route::post('/admin/category/update/{id}', 'update')->name('admin.category.update');
            }
        );


        #OPERATONS
        Route::controller(OperationController::class)->group(
            function () {
                Route::get('/admin/operations/upload', 'excel')->name('admin.excel.upload');
                Route::post('/admin/operation/storeExcel', 'storeExcel')->name('admin.excel.store');

                Route::get('/admin/operation/backup', 'backup')->name('admin.database.backup')->name('admin.database.backup');
            }
        );

        #DESTINATIONS
        Route::controller(DestinationController::class)->group(
            function () {
                Route::get('/admin/destinations/create', 'create')->name('admin.destinations.create');
                Route::get('/admin/destinations/view', 'index')->name('admin.destinations.list');

                Route::post('/admin/destinations/store', 'store')->name('admin.destinations.store');

                Route::get('/admin/destinations/edit/{uniqueid}', 'edit')->name('admin.destinations.edit');
                Route::post('admin/destinations/update/{id}', 'update')->name('admin.destinations.update');
            }
        );

        #USERS
        Route::controller(UserController::class)->group(
            function () {
                Route::get('/admin/users', 'index')->name('admin.users.all');
                Route::get('/admin/users/create', 'create')->name('admin.users.create');

                Route::get('/admin/users/edit/{uniqueid}', 'edit')->name('admin.users.edit');
                Route::get('/admin/users/delete/{id}', 'delete')->name('admin.users.delete');

                Route::post('/admin/users', 'store')->name('admin.users.store');
                Route::post('/admin/users/update/{id}', 'update')->name('admin.users.update');
            }
        );

        #FILES
        Route::controller(FileController::class)->group(
            function () {
                // View All File 
                Route::get('admin/files/index', 'index')->name('admin.files.index');
                // View Single File
                Route::get('admin/files/show/{file}', 'show')->name('admin.files.show');
                // Show File Upload Page
                Route::get('admin/files/create', 'create')->name('admin.files.create');
                // Show File Edit Page
                Route::get('admin/files/{file}/edit', 'edit')->name('admin.files.edit');
                //Upload File
                Route::post('admin/files/store', 'store')->name('admin.files.store');
                //Update File
                Route::post('admin/files/update/{file}', 'update')->name('admin.files.update');
                //Delete File
                Route::get('admin/files/delete/{file}', 'destroy')->name('admin.files.destroy');
            }
        );
    }
);

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');

Route::controller(AdminController::class)->group(
    function () {
        Route::get('/import', 'import');
    }
);

//VENDOR
Route::middleware(['auth', 'role:vendor'])->group(
    function () {
        #Vendor Routes
        Route::controller(VendorController::class)->group(
            function () {
                Route::get('vendor/dashboard', 'dashboard')->name('vendor.dashboard');
            }
        );
    }
);
