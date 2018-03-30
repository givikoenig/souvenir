<?php

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
use App\Mail\Queued_email;

// \Igaster\LaravelCities\Geo::ApiRoutes();

// Route::get('/mail/queued', function () {
//     // send an email to "batman@batcave.io"
//     Mail::to('batman@batcave.io')->later(5, new Queued_email);

//     return view('welcome');
// });

Route::get('sendmail', 'SendMailController@sendMail');

Route::get('robots.txt', function() {
    // If on the live server, serve a nice, welcoming robots.txt.
    if (App::environment() == 'production')
    {
        RobotsTxt::addUserAgent('*');
        RobotsTxt::addSitemap('sitemap.xml');
    } else {
        // If you're on any other server, tell everyone to go away.
        RobotsTxt::addDisallow('*');
    }
    return Response::make(RobotsTxt::generate(), 200, array('Content-Type' => 'text/plain'));
});

Route::group(['middleware' => 'web'], function() {
	
	Route::match(['get','post'], '/', ['uses'=>'IndexController@execute', 'as'=>'home']);
	Route::get('/subscribe/{token}', ['uses'=>'IndexController@subscribe', 'as'=>'subscribe']);
	Route::get('/articles/{cat_alias?}', ['uses'=>'ArticlesController@execute', 'as'=>'articles']);
	Route::get('/article/{alias}', ['uses'=>'ArticleController@execute', 'as'=>'article']);
	Route::resource('comment','CommentController',['only'=>'store']);
	Route::resource('like','LikeController',['only'=>'store']);
	Route::match(['get','post'],'/brands/{alias?}/{subalias?}', ['uses'=>'ProductsController@execute', 'as'=>'brands']);
	Route::match(['get','post'], '/product/{id}', ['uses'=>'ProductController@execute', 'as'=>'product']);
	Route::match(['get','post'], '/cart', ['uses'=>'CartController@execute', 'as'=>'cart']);
	Route::match(['get','post'], '/compare', ['uses'=>'CompareController@execute', 'as'=>'compare']);
	Route::resource('addtocart', 'AddToCartController', ['only'=> 'store']);
	Route::resource('delfromcart', 'DelFromCartController', ['only'=>'store']);
	Route::resource('updatecart', 'UpdateCartController', ['only'=>'store']);
	Route::resource('addtowishlist', 'AddToWishlistController', ['only'=> 'store']);
	Route::resource('delfromwishlist', 'DelFromWishlistController', ['only'=>'store']);
	Route::resource('shipping', 'ShippingController', ['only'=>'store']);
	Route::resource('addtocompare', 'AddToCompareController', ['only'=> 'store']);
	Route::resource('delfromcompare', 'DelFromCompareController', ['only'=>'store']);
		
	Route::match(['get','post'] ,'/alfa/{alias?}', ['uses'=>'AlfaController@execute', 'as'=>'alfa']);
	Route::match(['get','post'] ,'/bravo/{alias?}', ['uses'=>'BravoController@execute', 'as'=>'bravo']);
	Route::match(['get','post'] ,'/charlie/{alias?}', ['uses'=>'CharlieController@execute', 'as'=>'charlie']);
	Route::match(['get','post'] ,'/delta/{alias?}', ['uses'=>'DeltaController@execute', 'as'=>'delta']);
	Route::match(['get','post'] ,'/echo/{alias?}', ['uses'=>'EchoController@execute', 'as'=>'echo']);
	Route::match(['get','post'] ,'/foxtrot/{alias?}', ['uses'=>'FoxtrotController@execute', 'as'=>'foxtrot']);

});

Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function() {

		Route::get('/',['uses' => 'Admin\IndexController@execute', 'as' => 'adminIndex']);

		Route::group(['prefix'=>'sliders','middleware' => ['role:admin|editor']], function() {
			Route::get('/',['uses'=>'Admin\SlidersController@execute', 'as'=>'sliders']);
			Route::match(['get','post'],'/add',['uses'=>'Admin\SlidersAddController@execute', 'as'=>'slidersAdd']);
			Route::match(['get','post','delete'],'/edit/{slider}',['uses'=>'Admin\SliderEditController@execute', 'as'=>'sliderEdit']);
		});
		Route::group(['prefix'=>'banners','middleware' => ['role:admin|editor']], function() {
			Route::get('/',['uses'=>'Admin\BannersController@execute', 'as'=>'banners']);
			Route::match(['get','post'],'/add',['uses'=>'Admin\BannersAddController@execute', 'as'=>'bannersAdd']);
			Route::match(['get','post'],'/search/{alias?}',['uses'=>'Admin\SearchController@execute', 'as'=>'bannersSearch']);
			Route::match(['get','post','delete'],'/edit/{banner}',['uses'=>'Admin\BannerEditController@execute', 'as'=>'bannerEdit']);
		});
		Route::group(['prefix'=>'upcommings','middleware' => ['role:admin|editor']], function() {
			Route::get('/',['uses'=>'Admin\UpcommingsController@execute', 'as'=>'upcommings']);
			Route::match(['get','post'],'/add',['uses'=>'Admin\UpcommingsAddController@execute', 'as'=>'upcommingsAdd']);
			Route::match(['get','post','delete'],'/edit/{upcomming}',['uses'=>'Admin\UpcommingEditController@execute', 'as'=>'upcommingEdit']);
		});
		Route::group(['prefix'=>'pageblocks','middleware' => ['role:admin|editor']], function() {
			Route::match(['get','post','detach','attach'],'/edit/{block?}',['uses'=>'Admin\PageBlocksEditController@execute', 'as'=>'pageblocksEdit']);
		});
		Route::group(['prefix'=>'categories','middleware' => ['role:admin|editor']], function() {
			Route::get('/',['uses'=>'Admin\CategoriesController@execute', 'as'=>'categories']);
			Route::match(['get','post'],'/add',['uses'=>'Admin\CategoriesAddController@execute', 'as'=>'categoriesAdd']);
			Route::match(['get','post','delete'],'/edit/{category}',['uses'=>'Admin\CategoryEditController@execute', 'as'=>'categoryEdit']);
		});
		Route::group(['prefix'=>'articles','middleware' => ['role:admin|editor']], function() {
			Route::get('/',['uses'=>'Admin\ArticlesController@execute', 'as'=>'arts']);
			Route::match(['get','post'],'/add/{cat_id}',['uses'=>'Admin\ArticlesAddController@execute', 'as'=>'articlesAdd']);
			Route::match(['get','post','delete'],'/edit/{article}',['uses'=>'Admin\ArticleEditController@execute', 'as'=>'articleEdit']);
		});
		Route::group(['prefix'=>'comments','middleware' => ['role:admin|editor']], function() {
			Route::match(['get','post'],'/',['uses'=>'Admin\CommentsController@execute', 'as'=>'comments']);
			Route::match(['get','post','delete'],'/edit/{comment}',['uses'=>'Admin\CommentEditController@execute', 'as'=>'commentEdit']);
		});
		Route::group(['prefix'=>'brands','middleware' => ['role:admin|editor']], function() {
			Route::get('/',['uses'=>'Admin\BrandsController@execute', 'as'=>'brnds']);
			Route::match(['get','post'],'/add',['uses'=>'Admin\BrandsAddController@execute', 'as'=>'brandsAdd']);
			Route::match(['get','post','delete'],'/edit/{brand}',['uses'=>'Admin\BrandEditController@execute', 'as'=>'brandEdit']);
		});
		Route::group(['prefix'=>'subbrands','middleware' => ['role:admin|editor']], function() {
			Route::get('/',['uses'=>'Admin\SubbrandsController@execute', 'as'=>'subbrnds']);
			Route::match(['get','post'],'/add/{brand_id}',['uses'=>'Admin\SubbrandsAddController@execute', 'as'=>'subbrandsAdd']);
			Route::match(['get','post','delete'],'/edit/{subbrand}',['uses'=>'Admin\SubbrandEditController@execute', 'as'=>'subbrandEdit']);
		});
		Route::group(['prefix'=>'prods','middleware' => ['role:admin|editor']], function() {
			Route::match(['get','post'],'/{alias?}/{subalias?}',['uses'=>'Admin\ProductsController@execute', 'as'=>'products']);
			Route::match(['get','post'],'/add/{brandid}/{subbrandid}',['uses'=>'Admin\ProductsAddController@execute', 'as'=>'productsAdd']);
		});
		Route::group(['prefix'=>'product','middleware' => ['role:admin|editor']], function() {
			Route::match(['get','post','delete'],'/edit/{prod}',['uses'=>'Admin\ProductEditController@execute', 'as'=>'prodEdit']);
			Route::any('/delProdSlide/{product}',['uses'=>'Admin\ProductEditController@delProdSlide', 'as'=>'delProdSlide']);
		});
		Route::group(['prefix'=>'mitems','middleware' => ['role:admin|editor']], function() {
			Route::get('/',['uses'=>'Admin\MitemsController@execute', 'as'=>'mitems']);
			Route::match(['get','post'],'/add',['uses'=>'Admin\MitemsAddController@execute', 'as'=>'mitemsAdd']);
			Route::match(['get','post','delete'],'/edit/{mitem}',['uses'=>'Admin\MitemEditController@execute', 'as'=>'mitemEdit']);
		});
		Route::group(['prefix'=>'pages','middleware' => ['role:admin|editor']], function() {
			Route::get('/',['uses'=>'Admin\PagesController@execute', 'as'=>'pages']);
			Route::match(['get','post'],'/add/{mitem_id?}',['uses'=>'Admin\PagesAddController@execute', 'as'=>'pagesAdd']);
			Route::match(['get','post','delete'],'/edit/{page}',['uses'=>'Admin\PageEditController@execute', 'as'=>'pageEdit']);
		});
		Route::group(['prefix'=>'orders', 'middleware' => ['role:admin']], function() {
			Route::match(['get','post'],'/{status?}',['uses'=>'Admin\OrdersController@execute', 'as'=>'orders']);
			Route::match(['get','post'],'/view/{order}',['uses'=>'Admin\OrderViewController@execute', 'as'=>'orderView']);
			Route::match(['get','post','delete'],'/edit/{order}',['uses'=>'Admin\OrderEditController@execute', 'as'=>'orderEdit']);
		});
		Route::group(['prefix'=>'users', 'middleware' => ['role:admin']], function() {
			Route::get('/{role?}',['uses'=>'Admin\UsersController@execute', 'as'=>'users']);
			Route::match(['get','post'],'/user/add',['uses'=>'Admin\UserAddController@execute', 'as'=>'userAdd']);
			Route::match(['get','post','delete','detach','attach'],'/edit/{user}',['uses'=>'Admin\UserEditController@execute', 'as'=>'userEdit']);
		});


});

Route::group(['midleware' => 'auth'], function() {
	// Route::auth();
	Route::get('/profile', 'ProfileController@execute')->name('profile');
	Route::post('/profile', 'ProfileController@editCurrentUserProfile')->name('edit-profile');
	Route::get('/logout','Auth\LoginController@logout');
});

Auth::routes();
Route::get('/users/confirmation/{token}', ['uses' => 'Auth\RegisterController@confirmation','as' => 'confirmation']);
Route::get('/home', 'HomeController@index');

