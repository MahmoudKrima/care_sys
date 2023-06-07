<?php

use App\Http\Controllers\Api\AppLangController;
use App\Http\Controllers\Api\CartController;
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
use App\Http\Controllers\Api\SmsController;
use App\Http\Controllers\Api\SubHomeVisitController;
use App\Http\Controllers\Api\TicketCategoryController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\VisitBookController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\TicketCategory;
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

Route::post('/medical-login',[RegisterController::class,'login']);
Route::post('/medical-register',[RegisterController::class,'register']);
Route::post('/medical-confirm',[RegisterController::class,'confirmCode']);

//OnBoarding
Route::get('/medical-onboarding', [OnBoardingController::class, 'index'])->middleware('lang');

//language
Route::post('/medical-lang',[AppLangController::class,'setLang']);

Route::group(['middleware' => ['api.token','lang']], function () {

//Auth
Route::post('/medical-logout', [RegisterController::class, 'logout']);
Route::post('/medical-complete-register',[RegisterController::class,'completeRegister']);



//Service
Route::get('/medical-services', [ServiceController::class, 'index']);
Route::post('/medical-service', [ServiceController::class, 'show']);
Route::post('/medical-doctor-details', [ServiceController::class, 'DoctorDetails']);
Route::post('/medical-all-doctors', [ServiceController::class, 'allDoctors']);

// Departments
Route::get('/medical-departments', [DepartmentController::class, 'index']);
Route::get('/medical-top-departments', [DepartmentController::class, 'topDepartments']);
Route::post('/medical-department', [DepartmentController::class, 'show']);


//Slider
Route::get('/medical-slider', [SliderController::class, 'index']);

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
Route::post('/medical-disease-specialization', [DiseasSpecialistController::class, 'show']);

//specialist
Route::get('/medical-disease', [DiseasController::class, 'index']);
Route::post('/medical-one-disease', [DiseasController::class, 'show']);

// Review
Route::get('/medical-reviews', [ReviewController::class, 'index']);
Route::post('/medical-add-review', [ReviewController::class, 'store']);
Route::post('/medical-edit-review', [ReviewController::class, 'update']);

//Visits Category
Route::get('/medical-all-visit-categories', [HomeVisitController::class, 'index']);
Route::post('/medical-visit-category', [HomeVisitController::class, 'show']);

//Sub Visit Category
Route::get('/medical-all-sub-visit', [SubHomeVisitController::class, 'index']);
Route::post('/medical-sub-visit', [SubHomeVisitController::class, 'show']);

//Booked Visits
Route::post('/medical-booked-visit', [VisitBookController::class, 'index']);
Route::post('/medical-booked-details', [VisitBookController::class, 'show']);
Route::post('/medical-add-visit', [VisitBookController::class, 'store']);

//Cart
Route::post('/medical-add-cart', [CartController::class, 'add']);
Route::post('/medical-all-cart', [CartController::class, 'index']);
Route::post('/medical-checkout', [CartController::class, 'checkout']);
Route::post('/medical-track', [CartController::class, 'trackOrder']);

// Ticket Category
Route::get('/medical-ticket-categories', [TicketCategoryController::class, 'index']);

//Add Tickets
Route::post('/medical-add-ticket', [TicketController::class, 'store']);
Route::post('/medical-all-ticket', [TicketController::class, 'index']);


});











