<?php

global $pdo;

use App\Support\Container;
use App\Frontend\Controller\NotFoundController;
use App\Frontend\Controller\PagesController;
use App\Repository\PagesRepository;
use App\Admin\Controller\PageAdminController;
use App\Admin\Controller\LoginController;
use App\Admin\Support\AuthService;
use App\Support\CsrfHelper;

require __DIR__ . '/../inc/all.inc.php';

$container = Container::getContainer();
$container->bind('pdo', fn() => require __DIR__ . '/../inc/db-connect.inc.php');
$container->bind('authService', fn() => new AuthService($container->get('pdo')));
$container->bind('pageRepository', fn() => new PagesRepository($container->get('pdo')));
$container->bind('pageController', fn() => new PagesController($container->get('pageRepository')));
$container->bind('notFoundController', fn() => new NotFoundController($container->get('pageRepository')));
$container->bind('pageAdminController', fn() => new PageAdminController(
        $container->get('authService'),
        $container->get('pageRepository')
));
$container->bind('loginController', fn() => new LoginController($container->get('authService')));
$container->bind('csrfHelper', fn() => new CsrfHelper());

$csrfHelper = $container->get('csrfHelper');
$csrfHelper->handle();

function gen_csrf_token(): string
{
    global $container;
    $csrfHelper = $container->get('csrfHelper');
    return $csrfHelper->generateCsrf();
}

$route = @(string)($_GET['route'] ?? 'pages');

if ($route === 'pages') {
    $page = @(string)($_GET['page'] ?? 'index');
    $pageController = $container->get('pageController');
    $pageController->showPage($page);
} else if ($route === 'admin/login') {
    $loginController = $container->get('loginController');
    $loginController->login();
} else if ($route === 'admin/logout') {
    $loginController = $container->get('loginController');
    $loginController->logout();
} else if ($route === 'admin/pages') {
    $authService = $container->get('authService');
    $authService->ensureLoggedIn();

    $pageAdminController = $container->get('pageAdminController');
    $pageAdminController->index();
} else if ($route === 'admin/pages/create') {
    $authService = $container->get('authService');
    $authService->ensureLoggedIn();

    $pageAdminController = $container->get('pageAdminController');
    $pageAdminController->create();
} else if ($route === 'admin/pages/edit') {
    $authService = $container->get('authService');
    $authService->ensureLoggedIn();

    $pageAdminController = $container->get('pageAdminController');
    $pageAdminController->edit();
} else if ($route === 'admin/pages/delete') {
    $authService = $container->get('authService');
    $authService->ensureLoggedIn();

    $pageAdminController = $container->get('pageAdminController');
    $pageAdminController->delete();
} else {
    $notFoundController = $container->get('notFoundController');
    $notFoundController->error404();
}