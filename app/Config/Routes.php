<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('sign', function($routes){
    $routes->get('signIn','sign\SignIn::index');
    $routes->get('signUp', 'sign\SignUp::index');
    
    $routes->post('signUp/insert', 'sign\SignUp::insert');
    $routes->post('signIn/verify','sign\SignIn::verify');
});

$routes->group('mypage', function($routes){
    $routes->get('','mypage\MyPage::index');
    $routes->get('cancel/(:any)','mypage\MyPage::cancel/$1');
    $routes->get('revise','mypage\revise::revise');
    $routes->get('reviseUser','mypage\revise::reviseUser');
    $routes->get('changePW','mypage\revise::changePW');

    $routes->post('reviseRequest','mypage\revise::reviseRequest');
    $routes->post('changePWRequest','mypage\revise::changePWRequest');
});

$routes->group('manage', function($routes){
   
    $routes->get('group/groupinfo/(:any)','manage\Group::groupinfo/$1');
    $routes->get('group/approval/(:any)/(:any)','manage\Group::approval/$1/$2');
    $routes->get('mt/reviseMT/(:any)','manage\MT::reviseMT/$1');
    $routes->get('mt/addGroup/(:any)','manage\MT::addGroup/$1');
    $routes->get('mt/(:any)','manage\MT::index/$1');
    $routes->get('group/(:any)','manage\Group::index/$1');

    $routes->post('mt/addGroupInfo/(:any)','manage\MT::addGroupInfo/$1');
    $routes->post('mt/revise/(:any)','manage\MT::revise/$1');
    $routes->post('group/reviseGroup/(:any)','manage\Group::reviseGroup/$1');

});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
