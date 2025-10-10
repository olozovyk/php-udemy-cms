<?php

global $pdo;

use App\Frontend\Controller\NotFoundController;
use App\Frontend\Controller\PagesController;
use App\Repository\PagesRepository;

require __DIR__ . '/inc/all.inc.php';

$route = @(string)($_GET['route'] ?? 'pages');

$pageRepository = new PagesRepository($pdo);
$pageController = new PagesController($pageRepository);

if ($route === 'pages') {
    $page = @(string)($_GET['page'] ?? 'index');
    $pageController->showPage($page);
} else {
    $notFoundController = new NotFoundController($pageRepository);
    $notFoundController->error404();
}