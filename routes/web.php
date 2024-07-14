<?php

use Illuminate\Support\Facades\Route;
use App\Actions\User\RetrieveUsersAction;
use App\Actions\User\RetrieveUserAction;

Route::get('/', function (RetrieveUserAction $action) {
    // Wanted to check if redis data was being called
    // $action->execute(['page'=> 1, 'limit' => 200]);
    $action->execute(1);
    return view('welcome');
});
