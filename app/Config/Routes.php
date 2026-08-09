<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- Public Routes ---
$routes->get('/', 'Home::index');
$routes->get('/home/getLiveUpdate', 'Home::getLiveUpdate');

// --- Auth Routes ---
$routes->get('/auth', 'Auth::index');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/auth/logout', 'Auth::logout');

// --- Admin Routes ---
// Add this route inside the admin group
$routes->group('admin', function($routes) {
    $routes->get('/', 'Admin::index');
    
    // Runner Management
    $routes->get('runners', 'Admin::runners');
    $routes->post('saveRunner', 'Admin::saveRunner');
    $routes->get('deleteRunner/(:num)', 'Admin::deleteRunner/$1');
    
    // Watcher Management
    $routes->get('watchers', 'Admin::watchers');
    
    // Add this new route for watcher details
    $routes->get('getWatcherDetails/(:num)', 'Admin::getWatcherDetails/$1');
    
    // Monitoring
    $routes->get('logs', 'Admin::logs');
    $routes->get('reports', 'Admin::reports');
    $routes->get('reset', 'Admin::resetSystem');

    $routes->get('profile', 'Admin::profile');
    $routes->post('updateProfile', 'Admin::updateProfile');
    $routes->post('addWatcher', 'Admin::addWatcher');
    $routes->post('updateWatcher/(:num)', 'Admin::updateWatcher/$1');
    $routes->get('deleteWatcher/(:num)', 'Admin::deleteWatcher/$1');
});

// --- Watcher Routes ---
$routes->group('watcher', function($routes) {
    $routes->get('/', 'Watcher::index');
    $routes->post('submitEntry', 'Watcher::submitEntry');
    // NEW ROUTES FOR EDIT/DELETE
    $routes->get('entries', 'Watcher::viewEntries'); // View all entries for this checkpoint
    $routes->get('editEntry/(:num)', 'Watcher::editEntry/$1'); // Edit entry form
    $routes->post('updateEntry/(:num)', 'Watcher::updateEntry/$1'); // Update entry
    $routes->get('deleteEntry/(:num)', 'Watcher::deleteEntry/$1'); // Delete entry
});