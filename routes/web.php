<?php

use App\Http\Controllers\PeopleController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/upload',[PeopleController::class,'index']);
Route::post('/upload',[PeopleController::class,'upload']);
// Route::get('/store-data',[PeopleController::class,'store']);
Route::get('/batch',[PeopleController::class,'batch']);
Route::get('/home',[PeopleController::class,'home']);
Route::get('/people',[PeopleController::class,'allPeople'])->name('get.people');
Route::get('/people-v2',[PeopleController::class,'allPeopleV2'])->name('get.people.v2');
Route::get('/search',[PeopleController::class,'peopleSearchView'])->name('people.search');
Route::get('/search-term',[PeopleController::class,'peopleSearch'])->name('people.search.term');