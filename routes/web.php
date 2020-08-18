<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Auth::routes();
Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth']], function () {
    //*Category
    Route::get('/add-category', 'CategoryController@category');
    Route::post('/add-category-post', 'CategoryController@CategoryPost');
    Route::get('/view-category-list', 'CategoryController@CategoryView');
    Route::get('/delete-category/{cat_id}', 'CategoryController@CategoryDelete');
    Route::get('/edit-category/{cat_id}', 'CategoryController@CategoryEdit');
    Route::post('/update-category-post', 'CategoryController@CategoryUpdate');
    //*Sub_Category
    Route::get('/add-subcategory', 'SubCategoryController@SubCategory');
    Route::post('/add-subcategory-post', 'SubCategoryController@SubCategoryPost');
    Route::get('/view-subcategory-list', 'SubCategoryController@SubCategoryView');
    Route::get('/delete-subcategory/{cat_id}', 'SubCategoryController@SubCategoryDelete');
    Route::get('/edit-subcategory/{cat_id}', 'SubCategoryController@SubCategoryEdit');
    Route::post('/update-subcategory-post', 'SubCategoryController@SubCategoryUpdate');
    Route::get('/deleted-subcategory', 'SubCategoryController@SubCategoryDeleted');
    Route::get('/restore-subcategory/{id}', 'SubCategoryController@SubCategoryRestore');
    Route::get('/pdeleted-subcategory/{id}', 'SubCategoryController@SubCategoryPdeleted');
    //*Product
    Route::get('/add-product', 'ProductController@Product');
    Route::post('/add-product-post', 'ProductController@ProductPost');
    Route::get('/view-product-list', 'ProductController@ProductView');
    Route::get('/delete-product/{cat_id}', 'ProductController@ProductDelete');
    Route::get('/edit-product/{pro_id}', 'ProductController@ProductEdit');
    Route::post('/update-product-post', 'ProductController@ProductUpdate')->name('ProductUpdate');
//------------------------------------------------------------
    // Route::get('/admin/dashboard', 'AdminController@index')->name('adminDashboard');
    Route::get('/customer/dashboard', 'CustomerController@index')->name('customerDashboard');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('single/cart-delete/{id}', 'CartController@SingleCartDelete')->name('SingleCartDelete');
    Route::get('/checkout', 'CheckoutController@checkout')->name('checkout');
    Route::get('/api/get-state-list/{country_id}', 'CheckoutController@GetStateList')->name('GetStateList');
    Route::get('api/get-city-list/{state_id}', 'CheckoutController@GetCountryList')->name('GetCountryList');
    Route::post('/Payment', 'PaymentController@Payment')->name('Payment');
});

    Route::get('/', 'FrontendController@FrontPage')->name('FrontPage');
    Route::get('/items/{slug}', 'FrontendController@singleProduct')->name('single-product');
    Route::get('/shop', 'FrontendController@shop')->name('shop');
    Route::get('/single-cart/{slug}', 'FrontendController@SingleCart')->name('SingleCart');
    Route::get('/cart', 'CartController@cart')->name('cart');
    Route::get('/cart/{coupon}', 'CartController@cart')->name('CouponCart');
    Route::post('cart/update', 'CartController@CartUpdate')->name('CartUpdate');
