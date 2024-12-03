<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('Home/getImages', 'Home::getImages');
// $routes->get('news/index', 'News::index', ['filter' => 'role:administrator, user']);
// $routes->get('news/add', 'News::add', ['filter' => 'role:administrator']);
// $routes->get('/upload', 'Home::upload');
$routes->get('gallery/sort', 'GalleryController::galleryBySort', ['filter' => 'role:administrator, user']);
$routes->post('/laporkan', 'ReportController::laporkan', ['filter' => 'role:administrator, user']);
$routes->get('/pelaporan', 'ReportController::index', ['filter' => 'role:administrator, user, kemahasiswaan']);


$routes->post('report/updateStatus', 'ReportController::updateStatus', ['filter' => 'role:kemahasiswaan,administrator']);
$routes->get('report/delete/(:num)', 'ReportController::delete/$1', ['filter' => 'role:kemahasiswaan,administrator']);
	
$routes->get('users/index', 'Users::index', ['filter' => 'role:administrator']);
$routes->post('users/changeGroup', 'Users::changeGroup', ['filter' => 'role:administrator']);
$routes->post('users/activate', 'Users::activate', ['filter' => 'role:administrator']);
$routes->get('users/changePassword/(:num)', 'Users::changePassword/$1', ['filter' => 'role:administrator']);
$routes->post('users/setPassword', 'Users::setPassword', ['filter' => 'role:administrator']);


$routes->post('/upload', 'Home::upload');
$routes->get('monitoring', 'MonitoringController::index');
$routes->get('api/monitoring/files', 'MonitoringController::fetchFiles');
$routes->get('/forbidden', 'Home::forbidden');



