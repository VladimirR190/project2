<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::get('/logout',[AuthController::class, 'logout']);
    Route::post('/products',[ProductController::class, 'store']);
    Route::put('/products/{id}',[ProductController::class, 'update']);
    Route::delete('/products/{id}',[ProductController::class, 'destroy']);
    
});

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::get('/products',[ProductController::class, 'index']);
Route::post('/products/{id}',[ProductController::class, 'show']);

Route::apiResources([
    'desks'=> \App\Http\Controllers\Api\DeskController::class,
]);
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::get('/products',function(){
//     return Product::all();
// });

// Route::post('/products',function(Request $request){
//     return Product::create($request->all());
//     // return Product::create([
//     //     'name' => 'Prodect 1',
//     //     'descrption' => 'This is product 1',
//     //     'price' => '99.99',
//     // ]
//     // );
// });
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
