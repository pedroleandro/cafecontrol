<?php

ob_start();

require __DIR__ . "/vendor/autoload.php";


/**
 * BOOTSTRAP
 */
use Source\Core\Session;
use CoffeeCode\Router\Router;

$session = new Session();
$route = new Router(url(), "::");

/**
 * WEB ROUTE
 */
$route->namespace("Source\Controllers");
$route->get("/", "Web::home");
$route->get("/sobre", "Web::about");

//blog
$route->get("/blog", "Web::blog");
$route->get("/blog/page/{page}", "Web::blog");
$route->get("/blog/{postName}", "Web::blogPost");

//auth
$route->get("/entrar", "Web::login");
$route->get("/recuperar", "Web::forget");
$route->get("/cadastrar", "Web::register");

//opt-in
$route->get("/confirma", "Web::confirm");
$route->get("/obrigado", "Web::success");

//

//services
$route->get("/termos", "Web::terms");

/**
 * ERROR ROUTES
 */
$route->namespace("Source\Controllers")->group("/whops");
$route->get("/{errcode}", "Web::error");


/**
 * ROUTE
 */
$route->dispatch();


/**
 * ERROR REDIRECT
 */
if($route->error()){
    $route->redirect("/whops/{$route->error()}");
}

ob_end_flush();