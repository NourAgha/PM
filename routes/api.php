<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\MilestoneController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);

    Route::get('teams', [TeamController::class, 'index']);
    Route::get('projects', [ProjectController::class, 'index']);
    Route::get('roles', [roleController::class, 'index']);
    Route::get('employees', [OrganizationController::class, 'getAllEmployees']);
    Route::get('admins', [OrganizationController::class, 'getAllAdmins']);
    Route::get('developers', [OrganizationController::class, 'getAllDevelopers']);
    Route::get('tasks', [AuthController::class, 'getAllTasks']);
    Route::get('milestones', [ProjectController::class, 'getAllMilestones']);

    Route::delete('organization/{organization}',[OrganizationController::class, 'destroy']);
    Route::delete('projects/{project}',[ProjectController::class, 'destroy']);
    Route::delete('teams/{team}',[TeamController::class, 'destroy']);
    Route::delete('roles/{role}',[roleController::class, 'destroy']);
    Route::delete('tasks/{task}',[TaskController::class, 'destroy']);
    Route::delete('milestones/{milestone}',[MilestoneController::class, 'destroy']);
    Route::delete('users/{user}',[AuthController::class, 'destroy']);

    Route::put('organization/{organization}', [OrganizationController::class, 'update']);
    Route::put('projects/{project}',[ProjectController::class, 'update']);
    Route::put('teams/{team}',[TeamController::class, 'update']);
    Route::put('roles/{role}',[roleController::class, 'update']);
    Route::put('tasks/{task}',[TaskController::class, 'update']);
    Route::put('milestones/{milestone}',[MilestoneController::class, 'update']);
    Route::put('users/{user}',[AuthController::class, 'update']);

    Route::post('organization', [OrganizationController::class, 'store']);
    Route::post('projects}',[ProjectController::class, 'store']);
    Route::post('teams',[TeamController::class, 'store']);
    Route::post('roles',[roleController::class, 'store']);
    Route::post('tasks',[TaskController::class, 'store']);
    Route::post('milestones',[MilestoneController::class, 'store']);
    Route::post('users',[AuthController::class, 'store']);

});
