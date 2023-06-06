<?php

use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\DiseasController;
use App\Http\Controllers\Api\DiseasSpecialistController;
use App\Http\Controllers\Api\HomeVisitController;
use App\Http\Controllers\Api\MedicineController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\OfferDetailsController;
use App\Http\Controllers\Api\PharmacyController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\OnBoardingController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\SubHomeVisitController;
use App\Http\Controllers\Api\VisitBookController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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

//Auth
Route::post('/medical-login', [LoginController::class, 'store']);
Route::post('/medical-logout', [LoginController::class, 'destroy']);
Route::post('/medical-register', [RegisterController::class, 'store']);

//Service
Route::get('/medical-services', [ServiceController::class, 'index']);
Route::post('/medical-service/{id?}', [ServiceController::class, 'show']);

// Departments
Route::get('/medical-departments', [DepartmentController::class, 'index']);

//Slider
Route::get('/medical-slider', [SliderController::class, 'index']);

//OnBoarding
Route::get('/medical-onboarding', [OnBoardingController::class, 'index']);
Route::get('/medical-onboarding/{id?}', [OnBoardingController::class, 'index']);

//Offers
Route::get('/medical-offers', [OfferController::class, 'index']);
Route::post('/medical-offer/{id?}', [OfferController::class, 'show']);

//Offer Details
Route::get('/medical-offer-details/{id?}', [OfferDetailsController::class, 'show']);

// Pharmacy Category
Route::get('/medical-pharmacy', [PharmacyController::class, 'index']);
Route::post('/medical-pharmacy/{id?}', [PharmacyController::class, 'show']);

//Medicine
Route::get('/medical-medicine', [MedicineController::class, 'index']);
Route::post('/medical-medicine/{id?}', [MedicineController::class, 'show']);

//specialist
Route::get('/medical-disease-specialist', [DiseasSpecialistController::class, 'index']);
Route::post('/medical-disease-specialist/{id?}', [DiseasSpecialistController::class, 'show']);

//specialist
Route::get('/medical-disease', [DiseasController::class, 'index']);
Route::post('/medical-disease/{id?}', [DiseasController::class, 'show']);

// Review
Route::get('/medical-reviews', [ReviewController::class, 'index']);
Route::post('/medical-add-review', [ReviewController::class, 'store']);
Route::post('/medical-edit-review', [ReviewController::class, 'edit']);

//Visits Category
Route::get('/medical-visit-categories', [HomeVisitController::class, 'index']);
Route::get('/medical-visit-category/{id?}', [HomeVisitController::class, 'show']);

//Sub Visit Category
Route::get('/medical-sub-visit', [SubHomeVisitController::class, 'index']);
Route::get('/medical-sub-visit/{id?}', [SubHomeVisitController::class, 'show']);

//Booked Visits
Route::get('/medical-booked-visit', [VisitBookController::class, 'index']);
Route::get('/medical-booked-visit/{id?}', [VisitBookController::class, 'show']);
Route::post('/medical-add-visit', [VisitBookController::class, 'store']);









