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
| Middleware options can be located in `app/Http/Kernel.php`
|
*/

// Homepage Route
Route::get('/', 'WelcomeController@welcome')->name('welcome');

// Authentication Routes

Auth::routes(['register' => false]);

// Public Routes
Route::group(['middleware' => ['web', 'activity']], function () {

    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'Auth\ActivateController@exceeded']);

    // Socialite Register Routes
    Route::get('/social/redirect/{provider}', [
        'as' => 'social.redirect', 'uses' => 'Auth\SocialController@getSocialRedirect'
    ]);
    Route::get('/social/handle/{provider}', [
        'as' => 'social.handle', 'uses' => 'Auth\SocialController@getSocialHandle'
    ]);

    // Route to for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'RestoreUserController@userReActivate']);

    // --> Route to show image config
    Route::get('images/configs/{short}/config/{image}', [
        'uses' => 'ConfigController@imageConfig',
    ]);
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity']], function () {

    // Activation Routes
    Route::get('/activation-required', [
        'uses' => 'Auth\ActivateController@activationRequired'
    ])->name('activation-required');
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'twostep']], function () {

    //  Homepage Route - Redirect based on user role is in controller.
    Route::get('/home', ['as' => 'public.home',   'uses' => 'UserController@index']);
    Route::get('/chart', ['as' => 'chart.estadist',   'uses' => 'UserController@chart']);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@show',
    ]);
});

// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'twostep']], function () {

    // User Profile and Account Routes
    Route::resource(
        'profile',
        'ProfilesController',
        [
            'only' => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );
    Route::put('profile/{username}/updateUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@deleteUserAccount',
    ]);

    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        'uses' => 'ProfilesController@userProfileAvatar',
    ]);

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'ProfilesController@upload']);

    //  Para la venta
    //Route::resource('sells','VentaController');
    Route::get('sells', ['as' => 'public.home.sells', 'uses' => 'VentaController@index']);
    Route::get('create', ['as' => 'sells.create', 'uses' => 'VentaController@create']);
    Route::get('searchclient', ['as' => ' searchclient', 'uses' => 'VentaController@searchClient']);
    Route::get('searchproductsell', ['as' => 'searchproductsell', 'uses' => 'VentaController@searchProductSell']);
    Route::get('searchproduct', ['as' => 'searchproduct', 'uses' => 'VentaController@searchProduct']);
    Route::get('sells/detail/{id}', ['as' => 'sells.details', 'uses' => 'VentaController@show']);
    Route::post('save', 'VentaController@store')->name('save');
    Route::delete('sells/destroy/{id}', ['as' => 'sells.destroy', 'uses' => 'VentaController@destroy']);

    // Para la caja
    Route::get('caja', ['as' => 'caja.index', 'uses' => 'HomeController@show']);

    //  Para Producto
    Route::resources([
        'producto' => 'ProductoController'
    ]);
    Route::get('descargar-productos', 'ProductoController@pdf')->name('producto.pdf');
    // --> Route to show image product
    Route::get('images/products/{id}/product/{image}', [
        'uses' => 'ProductoController@imageProduct',
    ]);
    // -->Route to upload image product.
    Route::post('producto/upload/{id}', ['as' => 'producto.upload', 'uses' => 'ProductoController@upload']);

    //  Para Categoría
    Route::resources([
        'categorias' => 'CategoriaController'
    ]);

    //  Para Clientes
    Route::resource('clientes', 'ClientesController');
    Route::get('clienteslist', 'ClientesController@list')->name('clientelist');

    //  Para Proveedore
    Route::resource('proveedor', 'ProveedoresController');
    Route::get('proveedoreslist', 'ProveedoresController@list')->name('proveedorlist');
    Route::get('searchproovedor', 'ProveedoresController@searchproovedor')->name('searchproveedor');

    // Para Configuracion
    Route::get('config/config', 'Configurar\ConfigController@getConfig');
});

// Registered, activated, and is admin routes.
Route::group(['middleware' => ['auth', 'activated', 'role:admin', 'twostep']], function () {
    Route::resource('/users/deleted', 'SoftDeletesController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::post('search-users', 'UsersManagementController@search')->name('search-users');

    Route::get('routes', 'AdminDetailsController@listRoutes');
    Route::get('active-users', 'AdminDetailsController@activeUsers');

    // Para Caja Admin
    Route::put('caja/update', ['as' => 'caja.process', 'uses' => 'HomeController@process']);
    Route::get('caja/historial', ['as' => 'caja.history', 'uses' => 'HomeController@history']);
    Route::get('caja/historial/{id}', ['as' => 'caja.historyone', 'uses' => 'HomeController@detailone']);

    // Para Inventario
    Route::resource('inventario', 'Invent\InventarioController');
    Route::get('abastecer', 'Invent\InventarioController@invlist')->name('abastecerinv');
    Route::get('abastecimientos', 'Invent\InventarioController@abastecerlist')->name('reabastecerinv');
    Route::get('inventario/history/{id}', 'Invent\InventarioController@history')->name('inventario.history');

    // Para reportes
    Route::get('reporte/products', 'Reports\ReporteController@sellbyproduct')->name('sells.product');
    Route::post('reporte/products', 'Reports\ReporteController@getsellbyproduct')->name('getsells.product');
    Route::get('reporte/categorias', 'Reports\ReporteController@sellbycategory')->name('sells.category');
    Route::post('reporte/categorias', 'Reports\ReporteController@getsellbycategory')->name('getsells.category');
    Route::get('reporte/sells', 'Reports\ReporteController@sellbysells')->name('sells.sells');
    Route::get('reporte/buys', 'Reports\ReporteController@sellbybuys')->name('sells.buys');

    //  Para Configuración
    Route::get('/config', 'ConfigController@index')->name('config.index');
    Route::post('/config/update', 'ConfigController@update')->name('config.update');
    // -->Route to upload image config.
    Route::post('config/upload/{short}', ['as' => 'config.upload', 'uses' => 'ConfigController@upload']);
    Route::get('/test', ['as' => 'test', 'uses' => 'TestController@test']);
});
