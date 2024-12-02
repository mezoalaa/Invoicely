<?php

use Termwind\Components\Dd;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Invoices_Report;
use App\Http\Controllers\Customers_Report;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\InvoiceArchiveController;

use App\Http\Controllers\InvoiceDetailsController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', function () {
        return view('index'); // Authenticated users will see this page
    })->name('home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::resource('invoices', InvoicesController::class);

Route::resource('sections', SectionController::class);


Route::resource('products', ProductsController::class);

Route::resource('InvoiceAttachments', InvoiceAttachmentsController::class);

Route::resource('Archive', InvoiceArchiveController::class);


Route::get('section/{id}', [InvoicesController::class, 'getProducts']);

Route::get('InvoicesDetails/{id}', [InvoiceDetailsController::class, 'edit']);

Route::get('download/{invoice_number}/{file_name}', [InvoiceDetailsController::class ,'get_file'] )->where('file_name', '.*'); // Allows dots in the file name

Route::get('View_file/{invoice_number}/{file_name}', [InvoiceDetailsController::class ,'open_file']);

Route::post('delete_file', [InvoiceDetailsController::class ,'destroy'])->name('delete_file');

Route::get('edit_invoice/{id}', [InvoicesController::class, 'edit']);

Route::get('Status_show/{id}', [InvoicesController::class ,'show'])->name('Status_show');

Route::post('Status_Update/{id}', [InvoicesController::class ,'Status_Update'])->name('Status_Update');



// web.php
Route::get('Invoice_Paid', [InvoicesController::class, 'Invoice_Paid'])->name('Invoice_Paid');

Route::get('Invoice_unPaid', [InvoicesController::class, 'Invoice_unPaid'])->name('Invoice_unPaid');

Route::get('Invoice_Partial',[InvoicesController::class, 'Invoice_Partial'])->name('Invoice_Partial');

Route::get('Print_invoice/{id}', [InvoicesController::class ,'Print_invoice']);

// Route::post('/users-import', [InvoicesController::class, 'import']);
Route::get('export-invoices', [InvoicesController::class, 'export']);

Route::get('invoices_report', [Invoices_Report::class, 'index']);
Route::post('Search_invoices', [Invoices_Report::class, 'Search_invoices']);

Route::get('customers_report', [Customers_Report::class, 'index'])->name("customers_report");

Route::post('Search_customers', [Customers_Report::class,'Search_customers']);

Route::post('MarkAsRead_all', [InvoicesController::class,'MarkAsRead_all'])->name('MarkAsRead_all');

Route::get('unreadNotifications_count', [InvoicesController::class, 'unreadNotifications_count'])->name('unreadNotifications_count');

Route::get('unreadNotifications', [InvoicesController::class, 'unreadNotifications'])->name('unreadNotifications');



Route::middleware('auth')->group(function () {

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});



Route::get('/{page}', [AdminController::class, 'index']);



// use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Auth;

// use App\Http\Controllers\RoleController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\AdminController;
// use App\Http\Controllers\SectionController;
// use App\Http\Controllers\InvoicesController;
// use App\Http\Controllers\ProductsController;
// use App\Http\Controllers\InvoiceDetailsController;
// use App\Http\Controllers\InvoiceArchiveController;
// use App\Http\Controllers\InvoiceAttachmentsController;

// // Routes accessible only to authenticated and verified users
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     // Dashboard/Home
//     Route::get('/home', function () {
//         return view('index');
//     })->name('home');

//     // Invoices Management
//     Route::middleware('can:view-invoices')->group(function () {
//         Route::resource('invoices', InvoicesController::class);
//         Route::get('InvoicesDetails/{id}', [InvoiceDetailsController::class, 'edit']);
//         Route::get('edit_invoice/{id}', [InvoicesController::class, 'edit']);
//         Route::get('Status_show/{id}', [InvoicesController::class, 'show'])->name('Status_show');
//         Route::post('Status_Update/{id}', [InvoicesController::class, 'Status_Update'])->name('Status_Update');
//         Route::get('Invoice_Paid', [InvoicesController::class, 'Invoice_Paid'])->name('Invoice_Paid');
//         Route::get('Invoice_unPaid', [InvoicesController::class, 'Invoice_unPaid'])->name('Invoice_unPaid');
//         Route::get('Invoice_Partial', [InvoicesController::class, 'Invoice_Partial'])->name('Invoice_Partial');
//         Route::get('Print_invoice/{id}', [InvoicesController::class, 'Print_invoice']);
//         Route::get('export-invoices', [InvoicesController::class, 'export']);
//     });

//     // Sections Management
//     Route::middleware('can:manage-sections')->group(function () {
//         Route::resource('sections', SectionController::class);
//         Route::get('section/{id}', [InvoicesController::class, 'getProducts']);
//     });

//     // Products Management
//     Route::middleware('can:manage-products')->group(function () {
//         Route::resource('products', ProductsController::class);
//     });

//     // Invoice Attachments
//     Route::middleware('can:manage-attachments')->group(function () {
//         Route::resource('InvoiceAttachments', InvoiceAttachmentsController::class);
//         Route::get('download/{invoice_number}/{file_name}', [InvoiceDetailsController::class, 'get_file'])
//             ->where('file_name', '.*'); // Allows dots in the file name
//         Route::get('View_file/{invoice_number}/{file_name}', [InvoiceDetailsController::class, 'open_file']);
//         Route::post('delete_file', [InvoiceDetailsController::class, 'destroy'])->name('delete_file');
//     });

//     // Invoice Archive
//     Route::middleware('can:archive-invoices')->group(function () {
//         Route::resource('Archive', InvoiceArchiveController::class);
//     });

//     // Roles and Users Management
//     Route::middleware('can:manage-roles')->group(function () {
//         Route::resource('roles', RoleController::class);
//     });

//     Route::middleware('can:manage-users')->group(function () {
//         Route::resource('users', UserController::class);
//     });
// });

// // Catch-all route for admin pages or custom single-page app routing
// Route::get('/{page}', [AdminController::class, 'index'])->middleware(['auth', 'can:view-admin-pages']);




// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\RoleController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\AdminController;
// use App\Http\Controllers\SectionController;
// use App\Http\Controllers\InvoicesController;
// use App\Http\Controllers\ProductsController;
// use App\Http\Controllers\InvoiceArchiveController;
// use App\Http\Controllers\InvoiceDetailsController;
// use App\Http\Controllers\InvoiceAttachmentsController;
// use Laravel\Fortify\Http\Controllers\RegisteredUserController;

// // جميع الروابط تحتاج إلى التحقق من المصادقة و الصلاحيات
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/home', function () {
//         return view('index'); // سيتم عرض هذه الصفحة للمستخدمين المصادق عليهم
//     })->name('home');
// });

// // إدارة الفواتير مع الصلاحيات
// Route::middleware(['auth', 'permission:view-invoices'])->group(function () {
//     Route::resource('invoices', InvoicesController::class);
//     Route::get('Invoice_Paid', [InvoicesController::class, 'Invoice_Paid'])->name('Invoice_Paid');
//     Route::get('Invoice_unPaid', [InvoicesController::class, 'Invoice_unPaid'])->name('Invoice_unPaid');
//     Route::get('Invoice_Partial',[InvoicesController::class, 'Invoice_Partial'])->name('Invoice_Partial');
//     Route::get('Print_invoice/{id}', [InvoicesController::class ,'Print_invoice']);
//     Route::get('Status_show/{id}', [InvoicesController::class ,'show'])->name('Status_show');
//     Route::post('Status_Update/{id}', [InvoicesController::class ,'Status_Update'])->name('Status_Update');
//     Route::get('export-invoices', [InvoicesController::class, 'export']);
//     Route::get('download/{invoice_number}/{file_name}', [InvoiceDetailsController::class ,'get_file'])->where('file_name', '.*');
//     Route::get('View_file/{invoice_number}/{file_name}', [InvoiceDetailsController::class ,'open_file']);
//     Route::post('delete_file', [InvoiceDetailsController::class ,'destroy'])->name('delete_file');
// });

// // إدارة الأقسام مع الصلاحيات
// Route::middleware(['auth', 'permission:view-sections'])->group(function () {
//     Route::resource('sections', SectionController::class);
//     Route::get('section/{id}', [InvoicesController::class, 'getProducts']);
// });

// // إدارة المنتجات مع الصلاحيات
// Route::middleware(['auth', 'permission:view-products'])->group(function () {
//     Route::resource('products', ProductsController::class);
// });

// // إدارة المرفقات مع الصلاحيات
// Route::middleware(['auth', 'permission:view-attachments'])->group(function () {
//     Route::resource('InvoiceAttachments', InvoiceAttachmentsController::class);
// });

// // أرشفة الفواتير مع الصلاحيات
// Route::middleware(['auth', 'permission:view-archives'])->group(function () {
//     Route::resource('Archive', InvoiceArchiveController::class);
// });

// // عرض تفاصيل الفواتير مع الصلاحيات
// Route::middleware(['auth', 'permission:view-invoices'])->group(function () {
//     Route::get('InvoicesDetails/{id}', [InvoiceDetailsController::class, 'edit']);
// });

// // إدارة الأدوار و المستخدمين
// Route::middleware(['auth', 'permission:manage-roles'])->group(function () {
//     Route::resource('roles', RoleController::class);
//     Route::resource('users', UserController::class);
// });

// // للوصول إلى واجهات الإدارة (إذا كان لديك صفحة Admin)
// Route::get('/{page}', [AdminController::class, 'index']);

// // إذا كان لديك صلاحيات أخرى للتحكم فيها عبر الرابط (مثل صلاحيات إدخال أو تعديل بيانات):
// Route::middleware(['auth', 'permission:edit-invoices'])->group(function () {
//     Route::get('edit_invoice/{id}', [InvoicesController::class, 'edit']);
// });
