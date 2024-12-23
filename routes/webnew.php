<?php

use App\Http\Controllers\Web\HomeMasumController;

Route::get('/farmers', [HomeMasumController::class, 'Farmers'])->name('farmers');
Route::get('/gallery', [HomeMasumController::class, 'Gallery'])->name('gallery');
Route::get('/projects/details/{slug}', [HomeMasumController::class, 'ProjectsDetails'])->name('projectsdetails');
Route::get('/newsletter', [HomeMasumController::class, 'Newsletter'])->name('newsletter');

Route::get('/contact-us', [HomeMasumController::class, 'ContactUs'])->name('contactus');
Route::post('/contact-us/store', [HomeMasumController::class, 'ContactUsStore'])->name('contactusstore');