<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OTPHandleController;
use App\Http\Controllers\DocumentProcessController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProductCategoryController;
use App\Models\UserPayment;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\PaymentController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/home', function () {
    return view('home');
})->name('/home');

// Route::get('/booking', function () {
//     return view('components.booking');
// });

Route::get('/payment', function () {
    return view('components.payment');
});

// Route::get('/category', function () {
//     return view('components.category');
// });



Route::get('/totalPayment', function () {
    return view('components.total-payment');
});


// Route::get('/login', function () {
//     return view('auth.login');
// });
// Route::get('/signup', function () {
//     return view('auth.signup');
// })->name('signUp');

Route::get('signup', function () {
    return view('auth.signUp');
})->name('signUp');
Route::get('login', function () {
    return view('auth.login');
})->name('login');
Route::get('userDocument', function () {
    return view('components.user-document');
})->name('userDocument');

// Route::get('userDocument/{id}', 'DocumentProcessController@index');

Route::get('updatedDocument', function () {
    return view('components.updated-documents');
})->name('updatedDocument');


Route::get('documentProcess', function () {
    return view('components.document-process');
})->name('documentProcess');


// Route::get("/redirect",function()
// {
//     if (!Auth::check()) {
//         return redirect()->route('register');
//     }
//     return redirect("/");
// });


Route::get("/resetPassword", function () {
    return view('auth.resetPassword');
});


Route::post('ajaxRequest', [OTPHandleController::class, 'ajaxRequestPost'])->name('ajaxRequest.post');
Route::post('store', [OTPHandleController::class, 'store'])->name('store');
Route::post('ajaxRequestPostDocument', [DocumentProcessController::class, 'ajaxRequestPostDocument'])->name('ajaxRequest.postdocument');
Route::post('fileUploadPost', 'App\Http\Controllers\FileUploadController@fileUploadPost')->name('file.upload.post');


Route::get('signUpSubmit', function () {
    return view('auth.signUpSubmit');
})->name('signUpSubmit');

Route::post('post-login', [LoginController::class, 'postLogin'])->name('login.post');


Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
// Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
// Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


//new roue add

Route::post('documentOutput', [DocumentProcessController::class, 'documentOutput'])->name('documentOutput');

Route::get("/forgot-password", function () {
    return view('auth.forgot-password');
})->name('forgot-password');

// Route::get('post-logout', [LoginController::class, 'postLogout'])->name('postLogout'); 
Route::get('/logout', function () {
    Auth::logout();
    Session::flush();
    return redirect('/login');
})->name('logout');


Route::get("/redirect", function (Request $request) {

    //dd(Auth::user()->state);
    if (Auth::check()) {
        // dd(Auth::user()->state);
        if (Auth::user()->state == 1) {
            redirect()->route('signUpSubmit');

        } else if (Auth::user()->state == 2) {
            //session(['state' => '2']);  
            //dd(Session::get('state'));

            redirect()->route('userDocument');

        } else if (Auth::user()->state == 3) {
            redirect()->route('documentProcess');
        } else {

           
            
            //redirect()->route('home');
            $userId = Auth::id();
            $userStatus = User::find($userId)->approved;
            if (isset($userStatus) && $userStatus === 1) 
            {
                $userPayment = UserPayment::where('user_id', $userId)
                    ->where('payment_status', 'Success')
                    ->first();

                if ($userPayment) {
                    //return redirect()->route('category');
                    return redirect()->route('RawMaterial');
                } else {
                    return redirect()->route('PaymentDetailsView');
                }
                //return redirect()->route('RawMaterial');
            }
            else if(isset($userStatus) && $userStatus === 2)
            {
                return redirect()->route('chat');
            }
            else if(isset($userStatus) && $userStatus === 0)
            {
                return redirect()->route('/home');
            }

        }
    }

    return redirect()->route('/home');

});


Route::get("/test", function () {
    return view("components.test");
});

Route::post('myaccount', [LoginController::class, 'myaccount'])->name('myaccount');

Route::get('document-process-update', function () {
    return view('components.document-process-update');
})->name('documentUpdate');
Route::post('fileUploadPostUpdate', 'App\Http\Controllers\FileUploadController@fileUploadPostUpdate')->name('file.upload.post.update');


Route::get("dashboard", function () {
    return view('dashboard');
})->name('dashboard');

Route::post('userMsgHandling', [FileUploadController::class, 'userMsgHandling'])->name('userMsgHandling');
Route::post('adminMsgHandling', [App\Admin\Controllers\CustomPageController::class, 'adminMsgHandling'])->name('adminMsgHandling');

Route::post('adminReturnMsg', [FileUploadController::class, 'adminReturnMsg'])->name('adminReturnMsg');

//Route::post('store',[FileUploadController::class,'store'])->name('store');
Route::post('dropzone/store', [FileUploadController::class, 'store'])->name('dropzone.store');
Route::post('adminDownload', [App\Admin\Controllers\CustomPageController::class, 'adminDownload'])->name('adminDownload');


Route::get('/chat', function () {
    return view('components.chat');
})->name('chat');

// Route::get('/chat',[App\Admin\Controllers\CustomPageController::class,'start'])->name("chat");


Route::post('checkurl', [App\Admin\Controllers\CustomPageController::class, 'checkurl'])->name('checkurl');
Route::post('checkurlIndex', [App\Admin\Controllers\CustomPageController::class, 'checkurlIndex'])->name('checkurlIndex');
Route::post('chatData', [App\Admin\Controllers\CustomPageController::class, 'chatData'])->name('chatData');
Route::post('chatDataPost', [App\Admin\Controllers\CustomPageController::class, 'chatDataPost'])->name('chatDataPost');




Route::get('PaymentDetails', function () {
    return view('components.payment-details');
})->name('PaymentDetailsView');


Route::get("PaymentDetails/{id}", [App\Admin\Controllers\CustomPageController::class, 'PaymentDetails'])->name('PaymentDetails');
Route::get("PaymentDetailsOrder/{id}/{status}", [App\Admin\Controllers\CustomPageController::class, 'PaymentDetailsOrder'])->name('PaymentDetailsOrder');



Route::any('congratulations', function () {
    return view('components.congratulations');
})->name('congratulations');


Route::post("/checkStatus", [LoginController::class, 'chartStatus'])->name('checkStatus');

Route::post("/chartApproveStatus", [App\Admin\Controllers\CustomPageController::class, 'chartApproveStatus'])->name('chartApproveStatus');

Route::post('/entities/{categoryId}', [ProductCategoryController::class, 'entity'])->name('category.entities');




//Route::get('/category',[ProductCategoryController::class,'index'])->name('category');
Route::get('/RawMaterial', [ProductCategoryController::class, 'index'])->name('RawMaterial');
// Route::get('/rawMaterial', function () {
//     return view('components.raw-material');
// });




Route::post('/entityData', [ProductCategoryController::class, 'entityData'])->name('entityData');
Route::post('/storeOrder', [ProductCategoryController::class, 'storeOrder'])->name('storeOrder');

Route::get("/booking", [ProductCategoryController::class, 'booking'])->name('booking');
Route::get("/order", [ProductCategoryController::class, 'order'])->name('order');



Route::get('/supervisor_records', function () {
    return view('supervisor_records');
});

Route::post("/records", [ProductCategoryController::class, 'records'])->name('records');


// Route::get('/supervisor',function(){
//    return view('supervisor');
// });

Route::get("admin/records/create", [ProductCategoryController::class, 'supervisor']);

Route::post('storeSupervisor', [ProductCategoryController::class, 'storeSupervisor'])->name('storeSupervisor');

Route::post('verifyAdminStatus', [ProductCategoryController::class, 'verifyAdminStatus'])->name('verifyAdminStatus');
Route::post('verifyAdminStatusOrder', [ProductCategoryController::class, 'verifyAdminStatusOrder'])->name('verifyAdminStatusOrder');


Route::post('/storing', [ProductCategoryController::class, 'storing'])->name('storing');



Route::post('/storeOrderBulk', [ProductCategoryController::class, 'storeOrderBulk'])->name('storeOrderBulk');


Route::post('/payment_info_store', [ProductCategoryController::class, 'payment_info_store'])->name('payment_info_store');


Route::get('refresh_captcha', [ProductCategoryController::class, 'refreshCaptcha'])->name('refresh_captcha');

// Route::post('/payment/response',[PaymentController::class,'paymentResponse'])->name("payment.response");
// Route::post('/payment',[PaymentController::class,'paymentData'])->name("payment");






Route::post("/payment/process/data",[PaymentController::class,'paymentProcess'])->name('payment.process.data');
Route::get("/payment/process",[PaymentController::class,'index'])->name('payment.process');
Route::get("/payment/verify",[PaymentController::class,'paymentVerify'])->name('payment.verify');
Route::get("/payment/process/verify",[PaymentController::class,'paymentProcessVerify'])->name('payment.process.verify');











