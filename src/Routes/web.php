<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view("manage::index");
},true);

Route::get('/test/{id?}', function (\Illuminate\Http\Request $request) {
    $v_id = $request->id;
    return view('test', compact('v_id'));
});

Route::get('/test-unit/{id?}', function (\Illuminate\Http\Request $request) {
    $v_id = $request->id;
    return view('test-unit', compact('v_id'));
});

Route::group(['prefix'=>'structure'], function () {
    Route::get('/',function (){
        return view("manage::structure");
    },true);
    Route::group(['prefix' => 'front-pages'], function () {
        //front pages
        Route::get('/', 'PagesController@getIndex',true);
        Route::get('/settings/{param}', 'PagesController@getSettings',true);
        Route::post('/settings/{id}', 'PagesController@postSettings');
        Route::get('/general/{id}', 'PagesController@getGeneral',true);
        Route::post('/user-avatar', 'PagesController@postUserAvatar');
        Route::post('/classify', 'PagesController@postClassify');
        Route::post('/new', 'PagesController@postNew');
        Route::get('/new/{parent_id}', 'PagesController@getAddChild');
        Route::post('/detach', 'PagesController@postDetach');
        Route::post('/get-data', 'PagesController@postData');
        Route::post('/delete', 'PagesController@postDelete');

        Route::group(['prefix' => 'page-preview'], function () {
            Route::get('/{id}', 'PagesController@getPagePreview',true);
            Route::post('/{id}', 'PagesController@postPagePreview');
        });
        Route::get('/page-test-preview/{id}', 'PagesController@getPageTestPreview');
        Route::post('/page-test-preview/{id}', 'PagesController@postPagePreview');

        Route::post('/live-settings', 'PagesController@liveSettings');
        Route::get('/live/{id}', 'PagesController@postPageLive');

        Route::post('/load-tpl', 'PagesController@loadTpl');
        Route::get('/preview/{layout_id?}/{page_id?}', 'PagesController@getPreview',true);
        Route::post('/addchild', 'PagesController@postAddchild');
        Route::post('/changeparent', 'PagesController@postChangeparent');
        Route::get('/delete/{id}', 'PagesController@getDelete');
        Route::get('/template/{page}/{template_id}', 'PagesController@getTemplate');
        Route::post('/delete', 'PagesController@postDelete');
        Route::post('/create', 'PagesController@postCreate');
        Route::get('/update/{id}', 'PagesController@getUpdate');
        Route::post('/update', 'PagesController@postUpdate');
        Route::post('/load-layout', 'PagesController@postLoadLayout');
        Route::post('/layouts', 'PagesController@postLayouts');
        Route::post('/template-variations', 'PagesController@postTemplateVariations');
        Route::post('/update-inavtive', 'PagesController@postUpdateInavtive');
        Route::post('/update-customiser', 'PagesController@postUpdateCustomiser');
        Route::post('/layout-sidebar-counts', 'PagesController@postLayoutSidebarCounts');
        Route::post('/load-area', 'PagesController@postLoadArea');
        Route::post('/apply-area', 'PagesController@postApplyArea');
        Route::post('/membership-list/{id?}', 'PagesController@postMembershipList');
        Route::post('/list/{id?}', 'PagesController@postList');
        Route::post('/partial-access/{id?}', 'PagesController@postPartialAccess');
        Route::post('/get-fields-by-group', 'PagesController@getFieldsByGroup');
    });

    Route::group(['prefix' => 'classify'], function () {
        Route::get('/', 'ClassifyController@getIndex',true);
        Route::post('/', 'ClassifyController@postEditTerm');
        Route::post('/create', 'ClassifyController@postCreate');
        Route::post('/edit/{id}', 'ClassifyController@postEdit');
        Route::post('/delete', 'ClassifyController@postDelete');
        Route::post('/delete-item', 'ClassifyController@postDeleteItem');
        Route::post('/term-create', 'ClassifyController@postTermCreate');
        Route::post('/term-edit/{id}', 'ClassifyController@postTermEdit');
        Route::get('/delete/{id}', 'ClassifyController@getDelete');
        Route::post('/delterm', 'ClassifyController@postDelterm');
        Route::post('/mngchild', 'ClassifyController@postMngchild');
        Route::post('/changeparent', 'ClassifyController@postChangeparent');
        Route::get('/data', 'ClassifyController@getData');
        Route::post('/get-taxonomy-form', 'ClassifyController@postTaxonomyForm');
        Route::post('/generate-term', 'ClassifyController@postGenerateForm');
    });

    Route::group(['prefix' => 'menus'], function () {
        Route::get('/', 'MenusController@getIndex',true);
//        Route::get('/edit', 'MenusController@getEdit');
        Route::get('/edit/{id}', 'MenusController@getEdit',true)->name('edit_front_menu');
        Route::post('/edit/{id}', 'MenusController@postEdit',true)->name('post_edit_front_menu');
        Route::post('/create', 'MenusController@postCreate');
        Route::get('/update/{id}', 'MenusController@getUpdate');
        Route::post('/update', 'MenusController@postUpdate');
        Route::post('/addmenuitem', 'MenuFrontController@postAddmenuitem');
        Route::post('/changeparent', 'MenuFrontController@postChangeparent');
        Route::post('/delmenuitem', 'MenuFrontController@postDelmenuitem');
        Route::get('/html', 'MenuFrontController@getHtml');
        Route::get('/delete/{id}', 'MenuFrontController@getDelete');
        Route::get('/data', 'MenuFrontController@getData');
        Route::get('/menufile', 'MenuFrontController@getMenufile');
        Route::get('/sidebarmenus', 'MenuFrontController@getSidebarmenus');
    });

    Route::group(['prefix' => 'hooks'], function () {
        Route::get('/', 'HooksController@getIndex',true);
        Route::get('/edit/{id}', 'HooksController@getEdit',true);

    });
    Route::group(['prefix' => 'filters'], function () {
        Route::get('/', 'FiltersController@getIndex',true);
    });
});

Route::group(['prefix' => 'settings'], function () {
    Route::get('/', 'SettingsController@getIndex',true);
    Route::post('/', 'SettingsController@storeSystem');
    Route::get('/login-registration', 'SettingsController@getLoginRegistration',true);
    Route::get('/notifications', 'SettingsController@getNotifications',true);
    Route::get('/url-menger', 'SettingsController@getUrlMenger',true);
    Route::get('/adminemails', 'SettingsController@getAdminemails',true);
    Route::get('/lang', 'SettingsController@getLang',true);
    Route::get('/api-settings', 'SettingsController@getApi',true);
    Route::post('/page-settings', 'GeneralController@postSettings')->name('front_pages_general_settings');
    Route::get('/frontend', 'SettingsController@getFrontSettings',true)->name('font_site_settings_frontrnd');
    Route::post('/frontend', 'SettingsController@postFrontSettings')->name('post_font_site_settings_frontrnd');
});

Route::group(['prefix' => 'event'], function () {
    Route::get('/', 'EventsController@getIndex',true);
    Route::post('/get-function-data', 'EventsController@postGetFunctionData');
    Route::post('/get-event-function-relations', 'EventsController@postGetEventFunctionRelation');
    Route::post('/save-event-function-relations', 'EventsController@postSaveEventFunctionRelation');
});

Route::group(['prefix' => 'emails'], function () {
    Route::get('/{id?}', "EmailsController@getIndex",true);
    Route::get('/settings', "EmailsController@getSettings",true);
    Route::post('/settings', "EmailsController@postSettings");
    Route::get('/update/{id?}', "EmailsController@getUpdate",true);
    Route::post('/update/{id}', "EmailsController@postUpdate");
    Route::get('/data/{id}', "EmailsController@getData");
    Route::post('/create-group', "EmailsController@postCreateGroup");
    Route::post('/get-forms-lists', "EmailsController@postGetFormLists");
    Route::post('/get-forms-shortcodes', "EmailsController@getFormShortcodes");
    Route::post('/create-email', "EmailsController@postCreateEmail");
    Route::post('/delete-email/{id}', "EmailsController@postDeleteEmail");
    Route::post('check-email-settings', "EmailsController@postCheckEmail");
});

