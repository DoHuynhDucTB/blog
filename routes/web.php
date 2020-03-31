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
    $prefixNews = Config::get('zvn.url.pre_news');
    Route::group(['prefix' => $prefixNews],function(){

        //====================== HOME ======================
        $prefix = '';
        $controllerName = 'home';
        Route::group(['prefix' => $prefix],function() use($prefix, $controllerName) {

            $controller = ucfirst($controllerName) . "Controller@";
            
            Route::get('',  ['as' => $controllerName,      'uses' => $controller . 'index']);
        });

        //====================== CATEGORY ======================
        $prefix = 'danh-muc';
        $controllerName = 'category';
        Route::group(['prefix' => $prefix],function() use($prefix, $controllerName) {

            $controller = ucfirst($controllerName) . "Controller@";

            Route::get('{categoryId}' . '.html',   ['as' => $controllerName . '/news', 'uses' => $controller . 'news']);
        });

        //====================== DETAIL ======================
        $prefix = 'bai-viet';
        $controllerName = 'article';
        Route::group(['prefix' => $prefix],function() use($prefix, $controllerName) {

            $controller = ucfirst($controllerName) . "Controller@";

            Route::get('{articleId}' . '.html',   ['as' => $controllerName . '/news', 'uses' => $controller . 'news']);
        });

        //====================== USER ======================
        $prefix = 'user';
        $controllerName = 'user';
        Route::group(['prefix' => $prefix],function() use($prefix, $controllerName) {

            $controller = ucfirst($controllerName) . "Controller@";

            Route::get('login',        ['as' => $controllerName . '/login',       'uses' => $controller . 'login']);

            Route::post('postLogin',        ['as' => $controllerName . '/postLogin',       'uses' => $controller . 'postLogin']);

            Route::get('logout',        ['as' => $controllerName . '/logout',       'uses' => $controller . 'logout']);
        });

    });



    $prefixAdmin = Config::get('zvn.url.pre_admin');
    Route::group(['prefix' => $prefixAdmin, 'middleware' => ['check.login']],function(){

        //====================== DASHBOARD ======================
        $prefix = 'dashboard';
        $controllerName = 'dashboard';
        Route::group(['prefix' => $prefix],function() use($prefix, $controllerName) {
            
            $controller = ucfirst($controllerName) . "Controller@";

            Route::get('',                                  ['as' => $controllerName,                   'uses' => $controller . 'index']);
        
        });

        //====================== SLIDER ======================
        $prefix = 'slider';
        $controllerName = 'slider';
        Route::group(['prefix' => $prefix],function() use($prefix, $controllerName) {
            
            $controller = ucfirst($controllerName) . "Controller@";

            Route::get('',                                  ['as' => $controllerName,                   'uses' => $controller . 'index']);
            
            Route::get('form/{id?}',                        ['as' => $controllerName . '/form',         'uses' => $controller . 'form'])->where('id', '[0-9]+');

            Route::post('save',                             ['as' => $controllerName . '/save',         'uses' => $controller . 'save']);

            Route::get('delete/{id}',                      ['as' => $controllerName . '/delete',       'uses' => $controller . 'delete'])->where('id', '[0-9]+');

            Route::get('change-status-{status}/{id}',       ['as' => $controllerName . '/status',       'uses' => $controller . 'status'])->where(['status' => '[a-z]+', 'id' => '[0-9]+']);

        });

        //====================== CATEGORY ======================
        $prefix = 'category';
        $controllerName = 'category';
        Route::group(['prefix' => $prefix],function() use($prefix, $controllerName) {
            
            $controller = ucfirst($controllerName) . "Controller@";

            Route::get('',                                  ['as' => $controllerName,                   'uses' => $controller . 'index']);
            
            Route::get('form/{id?}',                        ['as' => $controllerName . '/form',         'uses' => $controller . 'form'])->where('id', '[0-9]+');

            Route::post('save',                             ['as' => $controllerName . '/save',         'uses' => $controller . 'save']);

            Route::get('delete/{id}',                      ['as' => $controllerName . '/delete',       'uses' => $controller . 'delete'])->where('id', '[0-9]+');

            Route::get('change-status-{status}/{id}',       ['as' => $controllerName . '/status',       'uses' => $controller . 'status'])->where(['status' => '[a-z]+', 'id' => '[0-9]+']);
            
            Route::get('change-show-{is_home}/{id}',       ['as' => $controllerName . '/is_home',       'uses' => $controller . 'is_home'])->where(['is_home' => '[a-z]+', 'id' => '[0-9]+']);

            Route::get('change-display-{display}/{id}',       ['as' => $controllerName . '/display',       'uses' => $controller . 'display'])->where(['display' => '[a-z]+', 'id' => '[0-9]+']);
        });

        //====================== Article ======================
        $prefix = 'article';
        $controllerName = 'article';
        Route::group(['prefix' => $prefix],function() use($prefix, $controllerName) {
            
            $controller = ucfirst($controllerName) . "Controller@";

            Route::get('',                                  ['as' => $controllerName,                   'uses' => $controller . 'index']);
            
            Route::get('form/{id?}',                        ['as' => $controllerName . '/form',         'uses' => $controller . 'form'])->where('id', '[0-9]+');

            Route::post('save',                             ['as' => $controllerName . '/save',         'uses' => $controller . 'save']);

            Route::get('delete/{id}',                      ['as' => $controllerName . '/delete',       'uses' => $controller . 'delete'])->where('id', '[0-9]+');

            Route::get('change-status-{status}/{id}',       ['as' => $controllerName . '/status',       'uses' => $controller . 'status'])->where(['status' => '[a-z]+', 'id' => '[0-9]+']);

            Route::get('change-type-{type}/{id}',        ['as' => $controllerName . '/type',       'uses' => $controller . 'type'])->where(['type' => '[a-z]+', 'id' => '[0-9]+']);
        });

        //====================== User ======================
        $prefix = 'user';
        $controllerName = 'user';
        Route::group(['prefix' => $prefix],function() use($prefix, $controllerName) {
            
            $controller = ucfirst($controllerName) . "Controller@";

            Route::get('',                                  ['as' => $controllerName,                   'uses' => $controller . 'index']);
            
            Route::get('form/{id?}',                        ['as' => $controllerName . '/form',         'uses' => $controller . 'form'])->where('id', '[0-9]+');

            Route::post('save',                             ['as' => $controllerName . '/save',         'uses' => $controller . 'save']);

            Route::get('delete/{id}',                      ['as' => $controllerName . '/delete',       'uses' => $controller . 'delete'])->where('id', '[0-9]+');

            Route::get('change-status-{status}/{id}',       ['as' => $controllerName . '/status',       'uses' => $controller . 'status'])->where(['status' => '[a-z]+', 'id' => '[0-9]+']);

            Route::get('change-level-{level}/{id}',        ['as' => $controllerName . '/level',       'uses' => $controller . 'level'])->where(['level' => '[a-z]+', 'id' => '[0-9]+']);

            Route::post('change-password',        ['as' => $controllerName . '/password',       'uses' => $controller . 'password']);

        });
    });
