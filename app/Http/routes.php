<?php
 
use App\Models\project;
use Illuminate\Http\Request;
 
/**
 * Display All Projects for the user
 */
Route::get('/project/{user_id}', function ($user_id) {
    //
});

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
 * Add A New Project
 */
Route::post('/project', function (Request $request) {
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