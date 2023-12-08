<?php

use Illuminate\Http\Request;
use App\Models\ProductService;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;

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

// Route::middleware('auth:api')->get('/ccivr/retreivetoken/{meterNumber}', [RetrieveTokenController::class, 'index']);


//Route::group(['middleware' => 'auth:api'], function () {
    Route::get('product', [ProductController::class, 'index']); //{
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. This will be cleaned up later.
   // return ProductService::all();
    //});


    Route::get('product/{id}', [ProductController::class, 'show']);
    // Route::get('product/{id}', function($id) {
    //     return ProductService::find($id);
    // });

    Route::post('product', [ProductController::class, 'store']);
    // Route::post('product', function(Request $request) {
    //     return ProductService::create($request->all);
    // });

    Route::put('product/{id}', [ProductController::class, 'update']);
    // Route::put('product/{id}', function(Request $request, $id) {
    //     $product = ProductService::findOrFail($id);
    //     $product->update($request->all());

    //     return $product;
    // });

    Route::delete('product/{id}', [ProductController::class, 'delete']);
    // Route::delete('product/{id}', function($id) {
    //     ProductService::find($id)->delete();

    //     return 204;
    // });
//});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
