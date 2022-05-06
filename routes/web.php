<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\AdvisersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CareersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\EvaluationsController;
use App\Http\Controllers\EvaluatorsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeamsController;
use App\Models\Careers;
use App\Models\Gender;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome',['careers' => Careers::all(),'gender' => Gender::all()]);
});

Route::post('/check', [AuthController::class,'check'])->name('auth.check');
Route::post('/create', [StudentsController::class,'create'])->name('student.create');

Route::group(['middleware'=>['auth']], function(){
    //Auth
    Route::get('logout',[AuthController::class,'logout'])->name('logout');

    //Admins
    Route::get('/panel-admins',[AdminsController::class,'index'])->name('admins.panel')->middleware('isAdmin');
    
        //Admins-Navigation
        Route::get('/panel-a-categories&careers',[AdminsController::class,'CategoriesCareersView'])->name('admins.categories-careers')->middleware('isAdmin');
        Route::get('/panel-a-events',[AdminsController::class,'eventsView'])->name('admins.events')->middleware('isAdmin');
        Route::get('/panel-a-students',[AdminsController::class,'studentsView'])->name('admins.students')->middleware('isAdmin');
        Route::get('/panel-a-evaluations',[AdminsController::class,'evaluationsView'])->name('admins.evaluations')->middleware('isAdmin');
        Route::get('/panel-a-advisers',[AdminsController::class,'advisersView'])->name('admins.advisers')->middleware('isAdmin');
        Route::get('/panel-a-evaluators',[AdminsController::class,'evaluatorsView'])->name('admins.evaluators')->middleware('isAdmin');

            //Categories
            Route::post('/panel-a-categories-store',[CategoriesController::class,'store'])->name('admins.categories-store')->middleware('isAdmin');
            Route::delete('/panel-a-categories-destroy/{categories}',[CategoriesController::class,'destroy'])->name('admins.categories-destroy')->middleware('isAdmin');
            Route::post('/panel-a-categories-update',[CategoriesController::class,'update'])->name('admin.categories-update')->middleware('isAdmin');
            //Careers
            Route::post('/panel-a-careers-store',[CareersController::class,'store'])->name('admins.careers-store')->middleware('isAdmin');
            Route::delete('/panel-a-careers-destroy/{careers}',[CareersController::class,'destroy'])->name('admins.careers-destroy')->middleware('isAdmin');
            Route::post('/panel-a-careers-update',[CareersController::class,'update'])->name('admin.careers-update')->middleware('isAdmin');
            //Events
            Route::post('/panel-a-events-store',[EventsController::class,'store'])->name('admin.eve-store')->middleware('isAdmin');
            Route::get('/panel-a-events-view/{id}',[EventsController::class,'show'])->name('admin.eve-show')->middleware('isAdmin');
            Route::post('/panel-a-events-update/{event}',[EventsController::class,'update'])->name('admin.eve-update')->middleware('isAdmin');
            //Students
            Route::get('/panle-a-students-show/{student}',[StudentsController::class,'show'])->name('admin.students-show')->middleware('isAdmin');
            Route::post('/panle-a-students-update/{student}',[StudentsController::class,'update'])->name('admin.students-update')->middleware('isAdmin');
            Route::delete('/panel-a-students-destroy/{student}',[StudentsController::class,'destroy'])->name('admins.students-destroy')->middleware('isAdmin');
            Route::get('/panle-a-students-pass/{student}',[StudentsController::class,'editPassword'])->name('admin.students-pass')->middleware('isAdmin');
            //Items
            Route::post('/panel-a-items-store',[ItemsController::class,'store'])->name('admin.i-store')->middleware('isAdmin');
            Route::delete('/panel-a-items-delete/{id}',[ItemsController::class,'destroy'])->name('admin.i-destroy')->middleware('isAdmin');
            Route::post('/panel-a-items-update',[ItemsController::class,'update'])->name('admin.i-update')->middleware('isAdmin');
            //Evaluations
            Route::post('/panel-a-evaluations-store',[EvaluationsController::class,'store'])->name('admin.evaluations-store')->middleware('isAdmin');
            Route::get('/panel-a-evaluations-view/{id}',[EvaluationsController::class,'show'])->name('admin.evaluations-show')->middleware('isAdmin');
            Route::delete('/panel-a-evaluations-delete/{evaluation}',[EvaluationsController::class,'destroy'])->name('admin.evaluations-destroy')->middleware('isAdmin');
            Route::post('/panel-a-evaluations-update/{evaluation}',[EvaluationsController::class,'update'])->name('admin.evaluations-update')->middleware('isAdmin');
            //Advisers
            Route::post('/panel-a-adviser-store',[AdvisersController::class,'store'])->name('admin.adviser-store')->middleware('isAdmin');
            Route::post('/panel-a-adviser-update/{adviser}',[AdvisersController::class,'update'])->name('admin.adviser-update')->middleware('isAdmin');
            Route::delete('/panel-a-adviser-delete/{adviser}',[AdvisersController::class,'destroy'])->name('admin.adviser-destroy')->middleware('isAdmin');
            //Evaluators
            Route::post('/panel-a-evaluators-store',[EvaluatorsController::class,'store'])->name('admin.evaluators-store')->middleware('isAdmin');
            Route::post('/panel-a-evaluators-update/{evaluator}',[EvaluatorsController::class,'update'])->name('admin.evaluators-update')->middleware('isAdmin');
            Route::delete('/panel-a-evaluators-delete/{adviser}',[EvaluatorsController::class,'destroy'])->name('admin.evaluators-destroy')->middleware('isAdmin');


    //Students
    Route::get('/panel-estudiantes',[studentsController::class,'panel'])->name('students.panel')->middleware('isStudent');
        //Teams
        Route::get('/panel-e-teams-view',[TeamsController::class,'viewTeam'])->name('students.teams-update')->middleware('isStudent');
        Route::get('/panel-e-teams-create',[TeamsController::class,'create'])->name('students.teams-create')->middleware('isStudent');
        Route::post('/panel-e-teams-update',[TeamsController::class,'update'])->name('students.teams-refresh')->middleware('isStudent');
        Route::post('/panel-e-teams-create',[TeamsController::class,'store'])->name('students.teams-store')->middleware('isStudent');
        //Request
        Route::post('/panel-e-t-r-joinstudent',[TeamsController::class,'sendRequestStudent'])->name('teams.request-student')->middleware('isStudent');
        Route::post('/panel-e-t-r-responserequest', [TeamsController::class,'updateRequest'])->name('teams.respons-request-student')->middleware('isStudent');
        Route::post('/panel-e-t-outTeam/{id}', [TeamsController::class,'outofTeam'])->name('teams.outofTeam')->middleware('isAdminOrStudent');
        Route::get('/panel-e-t-view/{id}',[TeamsController::class,'viewTeam'])->name('students.team-view')->middleware('isStudent');
        Route::get('/download-file/{url}',function($url){
            return response()->download(public_path('documents/'.$url));
        })->name('viewDocument')->middleware('isStudent');

    //Advisers
    Route::get('/panel-asesores',[AdvisersController::class,'panel'])->name('adviser.panel')->middleware('isAdviser');
    Route::post('/panel-a-complete',[AdvisersController::class,'completeRegister'])->name('adviser.complete')->middleware('isAdviser');
    Route::post('/panel-a-t-r-responserequest', [TeamsController::class,'updateRequestAdviser'])->name('teams.respons-request-adviser')->middleware('isAdviser');
    Route::get('/panel-a-teams',[TeamsController::class,'create'])->name('teams.adviserTeams')->middleware('isAdviser');
    Route::get('/panel-a-t-view/{id}',[TeamsController::class,'viewTeam'])->name('adviser.teamView')->middleware('isAdviser');
    Route::get('/download-file/{url}',function($url){
        return response()->download(public_path('documents/'.$url));
    })->name('viewDocument')->middleware('isAdviser');
    Route::post('/panel-a-t-submitComment',[AdvisersController::class,'submitComment'])->name('adviser.submit')->middleware('isAdviser');
    Route::post('/panel-a-t-vbo',[AdvisersController::class,'submitVBO'])->name('adviser.vbo')->middleware('isAdviser');
    Route::post('/panel-a-t-outTeam', [TeamsController::class,'outofTeam'])->name('adviser.outofTeam')->middleware('isAdviser');

    //Evaluators
    Route::get('/panel-evaluator',[EvaluatorsController::class,'index'])->name('evaluator.panel')->middleware('isEvaluator');
});

