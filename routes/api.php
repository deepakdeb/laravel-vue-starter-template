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
Route::get('category-list', [CategoryController::class, 'index']);
Route::get('faq-list', [FaqController::class, 'index']);
Route::post('form-submit', [ FormController::class , 'sendMail' ]);
Route::post('category/product', [ ProductController::class , 'getCategoryproducts' ]);
Route::get('product-list', [ProductController::class, 'index']);
Route::get('page-list', [PageController::class, 'page_option']);
Route::get('testimonial-list', [TestimonialController::class, 'list']);
Route::get('product-brand-list', [ProductBrandController::class, 'list']);
Route::post('product-data', [ProductController::class, 'getProductBySlug']);
Route::get('search-product', [ProductController::class, 'getSearchedProducts']);
Route::get('media-storage', [MediaManagerController::class, 'index']);


Route::get('fars', [HomeController::class, 'sendMail']);


Route::post('product-all-attributes', [ProductController::class, 'getAllAttributes']);


Route::post('product-category-attributes', [ProductController::class, 'getCategoryAttributes']);

Route::post('product-filtered', [ProductController::class, 'getFilteredProduct']);

Route::post('product-category-filtered', [ProductController::class, 'getCategoryFilteredProduct']);
Route::get('slider-list', [SliderController::class, 'list']);

Route::get('team', [HomeController::class, 'getTeam']); 

/************** Blog [trends-tips] - public routes ******************************/

Route::get('blog-list', [BlogController::class, 'index']);
Route::get('blog-list-recent', [BlogController::class, 'getRecentBlogs']);
Route::get('blog/category', [ BlogController::class , 'categoryList' ]);
Route::get('blog/tag', [ BlogController::class , 'tagList' ]);
Route::get('blog/{slug}', [BlogController::class, 'details']);

Route::get('blog/category/options', [BlogController::class, 'categoryOptions']);
Route::get('blog/category/optionlist', [BlogController::class, 'categoryOptionList']);
Route::get('blog/tag', [ BlogController::class , 'tagList' ]);
Route::get('blog/tag/options', [BlogController::class, 'tagOptions']);
Route::get('blog/tag/optionlist', [BlogController::class, 'tagOptionList']);

Route::get('catalog/tag', [ ProductController::class , 'tagList' ]);
Route::get('catalog/tag/options', [ProductController::class, 'tagOptions']);
Route::get('catalog/tag/optionlist', [ProductController::class, 'tagOptionList']);

Route::get('blog/category/{category}', [ BlogController::class , 'showCategory' ]);
Route::get('blog/category/{tag}', [ BlogController::class , 'showTag' ]);
/************** ****************************************************************/
Route::get('category/list/taxonomy', [CategoryController::class, 'getCategoryTaxonomy']);
Route::get('section-content/{slug}', [ SectionController::class , 'content' ]);
Route::post('page-contents', [ SectionController::class , 'getSectionContents' ]);

Route::get('project-list', [ ProjectController::class , 'index' ]);
Route::get('project/type', [ ProjectController::class , 'typeList' ]);
Route::get('project/product', [ ProjectController::class , 'productList' ]);

Route::get('project/type/options', [ProjectController::class, 'typeOptions']);
Route::get('project/product/options', [ProjectController::class, 'productOptions']);
Route::get('get-settings', [SiteSettingController::class, 'getSettings']);
Route::get('page-data/{slug}', [PageController::class, 'getPagedata']);


Route::get('script', [MediaManagerController::class, 'script']);


Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('users', [AuthController::class, 'userList']);
    Route::post('createuser', [AuthController::class, 'createuser']);
    Route::get('slider-contents/get-all-item', [SliderContentController::class, 'getAllItemBySlug']);
    Route::get('slider-contents/page-slug-map', [SliderContentController::class, 'getPageSlugMap']);
    Route::get('product/attributes', [ProductController::class, 'getAttributes']);
    Route::post('product/attributes', [ProductController::class, 'saveAttributes']);
    Route::get('attribute-option/list', [AttributeOptionController::class, 'attributeOptions']);
    Route::get('forms/get-all-item', [FormController::class, 'getAllItemBySlug']);
    Route::get('category/option', [CategoryController::class, 'getCategoryOption']);
    Route::get('category/list', [CategoryController::class, 'getCategoryListLevel']);
    Route::post('block/update', [BlockController::class, 'blockUpdate']);
    Route::post('block/image-update', [BlockController::class, 'blockImageUpdate']);
    
    Route::get('category/tree', [CategoryController::class, 'getCategoryTree']);
    Route::get('category/list/taxonomy', [CategoryController::class, 'getCategoryTaxonomy']); 
    Route::post('category/list/taxonomy', [CategoryController::class, 'setCategoryTaxonomy']);
    Route::get('settings/email', [SiteSettingController::class, 'getFormEmailSettings']); 
    Route::post('settings/email/update', [SiteSettingController::class, 'saveFormEmailSettings']);
    Route::post('settings/save', [SiteSettingController::class, 'saveSettings']);
    Route::post('updateuser', [AuthController::class, 'updateuser']);

    Route::resource('product-brand', ProductBrandController::class);
    Route::resource('testimonial', TestimonialController::class );
    Route::resource('trend-tip', TrendTipController::class );
    Route::resource('page', PageController::class);
    Route::resource('product', ProductController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('faq', FaqController::class );
    Route::resource('attribute', AttributeController::class);
    Route::resource('slider-contents', SliderContentController::class);
    Route::resource('attribute-option', AttributeOptionController::class);
    Route::resource('forms', FormController::class );
    Route::resource('settings', SiteSettingController::class );
    Route::resource('quotes', QuoteController::class );
    Route::resource('media-storage', MediaManagerController::class);
    
    


    
    Route::get('team/member/{id}', [HomeController::class, 'getTeamMember']); 
    Route::post('team/member', [HomeController::class, 'saveTeamMember']);
    Route::put('team/member/{id}', [HomeController::class, 'updateTeamMember']);
    Route::delete('team/member/{id}', [HomeController::class, 'deleteTeamMember']);


    /************** Blog [trends-tips] - system routes *******************************/
    Route::resource('blog', BlogController::class );
    Route::post('blog/category', [ BlogController::class , 'categorySave' ]);
    Route::put('blog/category/{category}', [ BlogController::class , 'updateCategory' ]);

    Route::post('blog/tag', [ BlogController::class , 'tagSave' ]);
    Route::put('blog/tag/{tag}', [ BlogController::class , 'updateTag' ]);
    Route::post('catalog/tag', [ ProductController::class , 'tagSave' ]);
    Route::put('catalog/tag/{tag}', [ ProductController::class , 'updateTag' ]);
    
    /************** Blog [trends-tips] - public routes ******************************/
    Route::post('page-content/save', [ SectionController::class , 'saveSectionContents' ]);
    Route::resource('section', SectionController::class);
    Route::resource('block', BlockController::class);


   /************************/
    Route::resource('project', ProjectController::class);
    
    Route::post('project/type', [ ProjectController::class , 'typeSave' ]);
    Route::put('project/type/{type}', [ ProjectController::class , 'updateType' ]);

    Route::post('project/product', [ ProjectController::class , 'productSave' ]);
    Route::put('project/product/{product}', [ ProjectController::class , 'updateProduct' ]);
    
    Route::delete('project/image/{image}', [ProjectController::class, 'deleteImage']);
    
});



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
