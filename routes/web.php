<?php

use Illuminate\Support\Facades\Route;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/email', function () {
    dd (Mail::to('prakash.5jo@gamil.com')->send(new WelcomeMail()));
    // Mail::to("prakash.5jo@gmail.com")->queue(new TestMail($data));
    dd("Email is sent successfully.");
});
