<?php

use Illuminate\Support\Facades\Route;
use App\Models\Project;
use App\Models\User;
use App\Livewire\ProjectView;
use App\Livewire\ProjectCreate;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('homepage');
});
 
Route::get('/project', ProjectCreate::class);

Route::get('/user', function() {
    $user = User::all();
    return $user;
});
/**
 * Display All Projects for the user
 */
Route::get('/project/{user_id}', ProjectView::class);

/**
 * Display all RAB for the project
 */
Route::get('/rab/{project_id}', function ($project_id) {
    //
});

/**
 * Display rab with the inputted id
 */
Route::get('/rab/{rab_id}', function ($rab_id) {
    //
});

/**
 * Add A New RAB for the project
 */
Route::post('/rab/{project_id}', function (Request $request, $project_id) {
    //
});

/**
 * Add A New item for the RAB for the project
 */
Route::post('/rab_item', function (Request $request) {
    //
});
 
/**
 * Delete An Existing Project
 */
Route::delete('/project/{project_id}', function ($project_id) {
    //
});
