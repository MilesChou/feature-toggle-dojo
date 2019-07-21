<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->get('/', function () {
    return view('welcome');
});

$router->resource('/store', 'StoreController');
$router->resource('/product', 'ProductController');
