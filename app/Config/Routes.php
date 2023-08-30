<?php

namespace Config;

use App\Controllers\Comments;
use App\Controllers\Customer;
use App\Controllers\Detail;
use App\Controllers\Login;
use App\Controllers\Pages;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index',['filter' => 'auth']);
$routes->get('/index', 'Home::index',['filter' => 'auth']);

## LOGIN PAGE
$routes->get('login', [Login::class, 'index']);
$routes->post('login/signIn', [Login::class,'signIn']);
$routes->get('login/logout', [Login::class, 'logout']);

## DETAIL PAGE
$routes->get('detail', [Detail::class,'index'],['filter' => 'auth']);
$routes->post('detail/filters', [Detail::class,'filters'],['filter' => 'auth']);

## Comments Page
$routes->get('comment_add', [Comments::class,'index'],['filter' => 'auth']);
$routes->post('comment_add', [Comments::class,'add_ledger'],['filter' => 'auth']);
$routes->get('comment_list', [Comments::class,'listing'],['filter' => 'auth']);
$routes->post('comment_filter', [Comments::class,'comment_filter'],['filter' => 'auth']);

## PDF & Excel
$routes->get('generate-pdf', [Comments::class,'generatePDF'],['filter' => 'auth']);
$routes->get('generate-excel', [Comments::class,'generateExcel'],['filter' => 'auth']);

## FIRST PAGE
/**
 * not used
 */
$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);

## CUSTOMER PAGE
$routes->get('customers/(:segment)', [Customer::class, 'view'],['filter' => 'auth']);
$routes->match(['get','post'],'customers/edit_info/id=(:segment)',[Customer::class,'edit_info'],['filter' => 'auth']);


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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
