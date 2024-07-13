<?php

use Illuminate\Support\Facades\Route;
use App\Actions\User\RetrieveUserAction;

Route::get('/', function (RetrieveUserAction $action) {
    // Wanted to check if redis data was being called
    $action->execute(['page'=> 1, 'limit' => 200]);
    return view('welcome');
});
