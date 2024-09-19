<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});





/* web
Route::apiResource('contact', ContactController::class);Route::get('contacts', [ContactWebController::class, 'index'])->name('contacts.index');
Route::get('contacts/create', [ContactWebController::class, 'create'])->name('contacts.create');
Route::post('contacts', [ContactWebController::class, 'store'])->name('contacts.store');

Route::delete('contacts/{id}', [ContactController::class, 'destroy']);
Route::delete('contacts/{id}', [ContactWebController::class, 'destroy'])->name('contacts.destroy');



// routes/web.php
Route::get('contacts/{id}/edit', [ContactWebController::class, 'edit'])->name('contacts.edit');
Route::put('contacts/{id}', [ContactWebController::class, 'update'])->name('contacts.update');

*/
Route::prefix('api')->group(function () {

    Route::get('/contacts', [ContactController::class, 'index'])->name('api.contacts.index'); // Liste tous les contacts

    Route::post('/contacts', [ContactController::class, 'store'])->name('api.contacts.store'); // Crée un nouveau contact

    Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('api.contacts.show'); // Affiche un contact spécifique

    Route::put('/contacts/{id}', [ContactController::class, 'update'])->name('api.contacts.update'); // Met à jour un contact

    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('api.contacts.destroy'); // Supprime un contact
});

Route::prefix('contacts')->group(function () {
    // Afficher tous les contacts
    Route::get('/', [ContactWebController::class, 'index'])->name('contacts.index');

    // Afficher le formulaire de création de contact
    Route::get('/create', [ContactWebController::class, 'create'])->name('contacts.create');

    // Enregistrer un nouveau contact
    Route::post('/', [ContactWebController::class, 'store'])->name('contacts.store');

    // Afficher le formulaire de modification d'un contact
    Route::get('/{id}/edit', [ContactWebController::class, 'edit'])->name('contacts.edit');

    // Mettre à jour un contact existant
    Route::put('/{id}', [ContactWebController::class, 'update'])->name('contacts.update');

    // Supprimer un contact
    Route::delete('/{id}', [ContactWebController::class, 'destroy'])->name('contacts.destroy');
});