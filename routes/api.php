<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeOptionController;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CatalogTagController;
use App\Http\Controllers\CatalogTagMappingController;

use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\TrendTipController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SliderContentController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ProductBrandController;


use App\Http\Controllers\BlogController;

use App\Http\Controllers\SectionController;
use App\Http\Controllers\BlockController;

use App\Http\Controllers\SliderController;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\SiteSettingController;

use App\Http\Controllers\QuoteController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MediaManagerController;


use App\Http\Controllers\Auth\ForgotPasswordController;



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
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::post('password/reset', [AuthController::class, 'passwordReset']);
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);


Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('users', [AuthController::class, 'userList']);
    Route::post('createuser', [AuthController::class, 'createuser']);
    Route::post('updateuser', [AuthController::class, 'updateuser']);
});