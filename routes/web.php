<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    Route::namespace('Site')->group(function () {
        Route::post('/','IndexController@subscribe')->name('subscribe');
        Route::get('/search', 'SearchController@index')->name('search.index');
        Route::get('/', 'IndexController@index')->name('site.index');
        Route::get('/show-pdf/{pdfFileName}', 'IndexController@showPdf')->name('site.showPdf');
        Route::get('/post-showById/', 'ArticlesController@showById')->name('site.articles.showById');
        Route::resource('articles','ArticlesController', ['names' => 'articles']);
        Route::get('/categoryposts/{slug}', 'ArticlesController@categoryPosts')->name('categoryPosts');
        Route::get('/newspage', 'ArticlesController@newsPage')->name('newsPage');
        Route::get('/press-releases', 'ArticlesController@pressReleases')->name('pressReleases');
        Route::get('/pages-simples-showById/', 'Pages\PagesSimplesController@showById')->name('site.simples.showById');
        Route::resource('pages-simples','Pages\PagesSimplesController', ['names' => 'pages.simples']);
        Route::get('/pages-simples-2-showById/', 'Pages\PagesSimples2Controller@showById')->name('site.simples-2.showById');
        Route::resource('pages-simples-2','Pages\PagesSimples2Controller', ['names' => 'pages.simples-2']);
        Route::get('/pages-qualities-showById/', 'Pages\QualitiesSimplesController@showById')->name('site.qualities.showById');
        Route::resource('pages-qualities','Pages\QualitiesSimplesController', ['names' => 'pages.qualities']);

        Route::get('/pageinnovations-showById/', 'Pages\PagesInnovationController@showById')->name('site.pageinnovations.showById');
        Route::resource('pageinnovations','Pages\PagesInnovationController', ['names' => 'pages.pageinnovations']);
        Route::get('/pages-about-us-our-team', 'Pages\AboutusController@aboutUsOurTeam')->name('aboutUsOurTeam');
        Route::get('/our-partners', 'Pages\AboutusController@OurPartners')->name('OurPartners');
        Route::get('/pages-boardOfTrusteesTeam-about-us-our-team', 'Pages\AboutUsBoardoftrusteesteamController@aboutUsOurTeam')->name('aboutUsOurTeam');
        Route::get('/pages-aboutus', 'Pages\AboutusController@AboutUs')->name('AboutUs');

        Route::get('/pages-talents-showById/', 'Pages\PagesTalentsController@showById')->name('site.talents.showById');
        Route::resource('pages-talents','Pages\PagesTalentsController', ['names' => 'pages.talents']);
        Route::get('/business-environment-showById/', 'Pages\BuisnessenvioirmentsController@showById')->name('site.buisness.showById');
        Route::resource('pages-businessEnvironments','Pages\BuisnessenvioirmentsController', ['names' => 'pages.buisnessEnvioirments']);
        Route::resource('pages-boardOfTrusteesTeam','Pages\AboutUsBoardoftrusteesteamController', ['names' => 'pages.boardOfTrusteesTeam']);
        Route::resource('pages-posts', 'Pages\PagepostsController', ['names' => 'pages.pages-posts']);
        Route::get('/talent', 'IndexController@talent')->name('site.talent');
        Route::get('/business-environments', 'IndexController@buisness')->name('site.buisness');
        Route::get('/quality', 'IndexController@quality')->name('site.quality');
        Route::get('/innovation', 'IndexController@innovation')->name('site.innovation');
        Route::get('/lifestyle', 'IndexController@lifestyle')->name('site.lifestyle');
        Route::get('/infrastructure', 'IndexController@infrastructure')->name('site.infrastructure');
        Route::get('/test', 'IndexController@test')->name('site.test');
        Route::get('/tagposts/{slug}', 'ArticlesController@tagPosts')->name('tagPosts');
        Route::resource('galleries', 'GalleriesController', ['names' => 'galleries'])->only('index', 'show');
        Route::resource('galleryvideos', 'GalleryvideoController', ['names' => 'galleryvideos']);
        Route::get( '/download/{filename}', 'BroshyuresController@download');
        Route::resource('brochures', 'BroshyuresController', ['names' => 'broshyures']);
        Route::get('/pages-boardOfTrusteesTeam-about-us-our-team', 'Pages\AboutUsBoardoftrusteesteamController@aboutUsOurTeam')->name('boardOfTrusteesTeam.aboutUsOurTeam');
        Route::get('/pages-boardOfTrusteesTeam-aboutus', 'Pages\AboutUsBoardoftrusteesteamController@AboutUs')->name('boardOfTrusteesTeam.AboutUs');
        Route::get('/how-to-reach-us', 'Pages\HowToReachUsPage@index')->name('how-to-reach-us.index');

        Route::resource('investmentBrochure', 'InvestmentBrochureController', ['names' => 'investmentBrochure']);
        Route::resource('youtubes', 'YoutubeController', ['names' => 'site.youtubes'])->only('index');
        Route::resource('videos', 'VideoController', ['names' => 'site.videos'])->only('index');

    });
    Auth::routes();
});

Auth::routes();

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
//Route::get('account/home', 'HomeController@index')->name('home');
    Route::group(['prefix' => 'account', 'namespace' => 'Account', ['middleware' => ['auth']]], function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('profiles', 'ProfilesController', ['names' => 'account.profiles']);
        Route::resource('messages', 'MessagesController', ['names' => 'account.messages']);
        Route::get('send-manager-message', 'SendManagerMessagesController@sendManagerMessage')->name('account.messages.sendManagerMessage');
        Route::post('send-manager-message', ['as' => 'account.messages.sendManagerMessageSaveData', 'uses' => 'SendManagerMessagesController@sendManagerMessageSaveData']);
    });


});

Route::group(['prefix' => 'admin123', 'namespace' => 'Admin', ['middleware' => ['auth']]], function () {

    Route::get('/', ['uses' => 'IndexController@index', 'as' => 'admin.home']);
    Route::resource('tags', 'TagsController', ['names' => 'admin.tags']);

    Route::resource('subscribe', 'SubscribeController', ['names' => 'admin.subscribe']);
    Route::post('subscribe/storeSubscribeModalTextSettings', ['uses' => 'SubscribeController@storeSubscribeModalTextSettings', 'as' => 'admin.storeSubscribeModalTextSettings']);




    Route::post('posts/storePageSettings', ['uses' => 'ArticlesController@storePageSettings', 'as' => 'admin.articles.storePageSettings']);
    Route::post('press-releases/storePageSettings', ['uses' => 'ArticlesController@storePressReleasesPageSettings', 'as' => 'admin.press-releases.storePressReleasesPageSettings']);
    Route::resource('posts', 'ArticlesController', ['names' => 'admin.articles']);
    Route::get('/press-releases', 'ArticlesController@pressReleases')->name('admin.articles.pressReleases');
    Route::resource('categories', 'CategoriesController', ['names' => 'admin.categories']);
    Route::get('/', ['uses' => 'IndexController@index', 'as' => 'admin.home']);
    Route::resource('roles', 'RoleController', ['names' => 'admin.roles']);
    Route::resource('users', 'UserController', ['names' => 'admin.users']);
    //  Route::get('/menus/{id}/{lang}edit/', ['uses' => 'MenusController@edit', 'as' => 'admin.menus.edit']);
    Route::get('/menus/selectLanguage', ['uses' => 'MenusController@selectLanguage', 'as' => 'admin.menus.selectLanguage']);
    Route::resource('/menus', 'MenusController', ['names' => 'admin.menus']);


    Route::resource('investors', 'InvestorsController', ['names' => 'admin.investors']);
    Route::resource('managers', 'ManagersController', ['names' => 'admin.managers']);
    Route::resource('sliders', 'SlidersController', ['names' => 'admin.sliders']);
    Route::resource('events', 'EventsController', ['names' => 'admin.events']);
    Route::resource('pages-posts', 'Pages\PagepostsController', ['names' => 'admin.pages.pages-posts']);

    Route::resource('pages-simples', 'Pages\PagesSimplesController', ['names' => 'admin.pages.simples']);
    Route::resource('pages-simples-2', 'Pages\PagesSimples2Controller', ['names' => 'admin.pages.simples-2']);
    Route::resource('pages-qualities', 'Pages\QualitiesSimplesController', ['names' => 'admin.pages.qualities']);
    Route::resource('pages-pageinnovations', 'Pages\PagesInnovationController', ['names' => 'admin.pages.pageinnovations']);
    Route::post('pages-aboutus/storePageSettings', ['uses' => 'Pages\AboutusController@storePageSettings', 'as' => 'admin.pages.aboutus.storePageSettings']);
    Route::resource('pages-aboutus', 'Pages\AboutusController', ['names' => 'admin.pages.aboutus']);
    Route::resource('pages-aboutusDepartment', 'Pages\AboutUsDepartmentsController', ['names' => 'admin.pages.aboutusDepartment']);
    Route::resource('pages-talents', 'Pages\PagesTalentsController', ['names' => 'admin.pages.talents']);
    Route::resource('pages-businessEnvironments', 'Pages\BuisnessenvioirmentsController', ['names' => 'admin.pages.buisnessEnvioirments']);
    Route::resource('pages-brochures', 'BroshyuresController', ['names' => 'admin.broshyures']);
    Route::post('pages-brochures/storePageSettings', ['uses' => 'BroshyuresController@storePageSettings', 'as' => 'admin.broshyures.storePageSettings']);
    Route::resource('investmentBrochure', 'InvestmentBrochureController', ['names' => 'admin.investmentBrochure']);
    Route::post('investmentBrochure/storePageSettings', ['uses' => 'InvestmentBrochureController@storePageSettings', 'as' => 'admin.investmentBrochure.storePageSettings']);

    Route::match(['get', 'post'], 'footerSocialLinksMenus', 'FooterSocialLinksMenusController@index')->name('admin.footerSocialLinksMenus.index');
    Route::get('settings/generalSettings', ['uses' => 'SettingsController@generalSettings', 'as' => 'admin.settings.generalSettings']);
    Route::post('settings/storeGeneralSettings', ['uses' => 'SettingsController@storeGeneralSettings', 'as' => 'admin.settings.storeGeneralSettings']);

    Route::get('/ourMissionsMenus/selectLanguage', ['uses' => 'Home\OurMissionsMenusController@selectLanguage', 'as' => 'admin.home.ourMissionsMenus.selectLanguage']);
    Route::resource('ourMissionsMenus', 'Home\OurMissionsMenusController', ['names' => 'admin.home.ourMissionsMenus']);
    Route::post('ourMissionsMenus/storeOurMissionsMenusPageSettings', ['uses' => 'Home\OurMissionsMenusController@storeOurMissionsMenusPageSettings', 'as' => 'admin.storeOurMissionsMenusPageSettings']);

    Route::get('notifications/index', ['uses' => 'NotificationsController@index', 'as' => 'admin.notifications.index']);
    Route::get('notifications/sendNotification', ['uses' => 'NotificationsController@sendNotification', 'as' => 'admin.notifications.sendNotification']);
    Route::post('notifications/storeNotifications', ['uses' => 'NotificationsController@storeNotifications', 'as' => 'admin.notifications.storeNotifications']);
    Route::get('notifications/viewSingleMessage/{id}', ['uses' => 'NotificationsController@viewSingleMessage', 'as' => 'admin.notifications.viewSingleMessage']);

    //DiscoveryArmeniaController
    Route::resource('discovery-armenia', 'Home\DiscoveryArmeniaController', ['names' => 'admin.home.discovery-armenia']);
    //NotificationsController
    Route::post('galleries/storePageSettings', ['uses' => 'GalleriesController@storePageSettings', 'as' => 'admin.galleries.storePageSettings']);
    Route::resource('galleries', 'GalleriesController', ['names' => 'admin.galleries']);
    Route::post('galleryvideos/storePageSettings', ['uses' => 'GalleryvideoController@storePageSettings', 'as' => 'admin.galleryvideos.storePageSettings']);
    Route::resource('galleryvideos', 'GalleryvideoController', ['names' => 'admin.galleryvideos']);

    Route::post('youtubes/storePageSettings', ['uses' => 'YoutubeController@storePageSettings', 'as' => 'admin.youtubes.storePageSettings']);
    Route::resource('youtubes', 'YoutubeController', ['names' => 'admin.youtubes']);

    Route::post('pages-boardOfTrusteesTeam/storePageSettings', ['uses' => 'Pages\AboutUsBoardoftrusteesteamController@storePageSettings', 'as' => 'admin.pages.boardOfTrusteesTeam.storePageSettings']);
    Route::resource('pages-boardOfTrusteesTeam', 'Pages\AboutUsBoardoftrusteesteamController', ['names' => 'admin.pages.boardOfTrusteesTeam']);

    Route::post('videos/storePageSettings', ['uses' => 'VideoController@storePageSettings', 'as' => 'admin.videos.storePageSettings']);
    Route::resource('videos', 'VideoController', ['names' => 'admin.videos']);

});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
