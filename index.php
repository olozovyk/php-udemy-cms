<?php

global $pdo;

use App\Support\Container;
use App\Frontend\Controller\NotFoundController;
use App\Frontend\Controller\PagesController;
use App\Repository\PagesRepository;

require __DIR__ . '/inc/all.inc.php';

$container = Container::getContainer();
$container->bind('pdo', fn() => require __DIR__ . '/inc/db-connect.inc.php');
$container->bind('pageRepository', fn() => new PagesRepository($container->get('pdo')));
$container->bind('pageController', fn() => new PagesController($container->get('pageRepository')));
$container->bind('notFoundController', fn() => new NotFoundController($container->get('pageRepository')));

$route = @(string)($_GET['route'] ?? 'pages');

if ($route === 'pages') {
    $page = @(string)($_GET['page'] ?? 'index');
    $pageController = $container->get('pageController');
    $pageController->showPage($page);
} else {
    $notFoundController = $container->get('notFoundContainer');
    $notFoundController->error404();
}