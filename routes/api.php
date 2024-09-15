<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\MailController;
use App\Http\Controllers\Api\SendHistoryController;
use App\Http\Controllers\Api\MailHistoryController;
use App\Http\Controllers\Api\SendMailerInfoController;
use App\Http\Controllers\Api\MailerInfoController;
use App\Http\Controllers\Api\SMSController;
use App\Http\Controllers\Api\EmailController;
use App\Http\Controllers\Api\WebMailSendController;
// use App\Mail\SendMail;

// use App\Mail\Webmail;
// use Illuminate\Support\Facades\Mail;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Post Api Pages
Route::post('/login', [LoginController::class, 'login']);
Route::post('/category', [CategoryController::class, 'category']);
Route::post('/contact', [ContactController::class, 'contact']);
Route::post('/send-history', [SendHistoryController::class, 'send_history']);
Route::post('/mail-history', [MailHistoryController::class, 'mail_history']);
Route::post('/send-sms', [SMSController::class, 'sendSms']);
Route::post('/send-mail', [MailController::class, 'send_mail']);
Route::post('/invoice', [InvoiceController::class, 'invoice_store']);
Route::post('/send-mailer-info', [SendMailerInfoController::class, 'send_mailer_info_store']);
Route::post('/imap-mailer-info', [MailerInfoController::class, 'mailer_info_store']);



//View Api Pages
Route::get('/category-view', [CategoryController::class, 'category_view']);
Route::get('/send-history-view', [SendHistoryController::class, 'send_history_view']);
Route::get('/mail-history-view', [MailHistoryController::class, 'mail_history_view']);
Route::get('/contact-view', [ContactController::class, 'contact_view']);
Route::get('/mail-view', [SendMail::class, 'content']);
Route::get('/invoice-view', [InvoiceController::class, 'invoice_view']);
Route::get('/send-mailer-view', [SendMailerInfoController::class, 'send_mailer_info_index']);
Route::get('/imap-mailer-view', [MailerInfoController::class, 'mailer_info_index']);


Route::get('/invoice-download-view', [InvoiceController::class, 'download']);


//Web Mail Fetch and Delete
Route::get('/webmails', [EmailController::class, 'index']);
Route::get('/webmails/{uid}', [EmailController::class, 'show']);
Route::delete('/webmails/{uid}', [EmailController::class, 'delete']);


//send webmail
Route::post('/send-webmail', [WebMailSendController::class, 'send_web_mail']);









// // function (Request $request) {
//     $credentials = $request->only('email', 'password');

//     if (!Auth::attempt($credentials)) {
//         throw ValidationException::withMessages([
//             'email' => ['The provided credentials are incorrect.'],
//         ]);
//     }

//     $user = Auth::user();

//     return response()->json([
//         'status'    => 1,
//         'user'      => $user,
//     ], 200);
// }
