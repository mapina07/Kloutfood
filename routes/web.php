<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UMController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/logout', [UserController::class,'logout'])->name('userLogout');

Route::post('/user/create', [UserController::class,'create'])->name('userCreate');

Route::post('/authenticate', [UserController::class,'authenticate'])->name('userAuthenticate');




Route::group(['middleware'=>['AuthCheck']],function(){

    //User
    Route::redirect('/', '/login', 301);

    Route::get('/login', [UserController::class,'login'])->name('userLogin');

    Route::get('/register', [UserController::class,'register'])->name('userRegister');


    //Category

    Route::get('/category', [CategoryController::class, 'index']
    )->name('categoryList');

    Route::post('/category', [CategoryController::class, 'store']
    )->name('categoryStore');

    Route::get('/category/search', [CategoryController::class, 'search']
    )->name('categorySearch');

    Route::get('/category/{id}', [CategoryController::class, 'destroy']
    )->name('categoryDelete');

    //Unit of Measurement

    Route::get('/measurement',[UMController::class, 'index']
    )->name('measurementList');

    Route::post('/measurement', [UMController::class, 'store']
    )->name('measurementStore');

    Route::get('/measurement/search', [UMController::class, 'search']
    )->name('measurementSearch');

    Route::get('/measurement/{id}', [UMController::class, 'destroy']
    )->name('measurementDelete');

    //ingredients

    Route::get('/ingredients',[IngredientController::class, 'index']
    )->name('ingredientList');

    Route::post('/ingredients', [IngredientController::class, 'store']
    )->name('ingredientStore');

    Route::get('/ingredient/search', [IngredientController::class, 'search']
    )->name('ingredientSearch');

    Route::get('/ingredient/{id}', [IngredientController::class, 'destroy']
    )->name('ingredientDelete');

    //Recipe
    Route::get('/recipe',[RecipeController::class, 'index']
    )->name('recipeList');

    Route::post('/recipe', [RecipeController::class, 'store']
    )->name('recipeStore');

    Route::get('/recipe/search', [RecipeController::class, 'search']
    )->name('recipeSearch');

    Route::post('/recipe/filter/category', [RecipeController::class, 'filterByCategory']
    )->name('recipeFilterByCategory');

    Route::get('/recipe/{id}', [RecipeController::class, 'destroy']
    )->name('recipeDelete');

    //Shop
    Route::get('/store', [StoreController::class, 'shop']
    )->name('store');

    Route::post('/store/search', [StoreController::class, 'search']
    )->name('storeSearch');

    Route::get('/store/{id}', [StoreController::class, 'detail']
    )->name('storeDetail');

    Route::post('/cart',[StoreController::class,'addCart'])->name('addCart');

    Route::post('/shopping-cart',[StoreController::class,'shoppingCart'])->name('shoppingCart');

});


