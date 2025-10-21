<?php

namespace App\Admin\Controller;

use App\Repository\PagesRepository;
use App\Admin\Support\AuthService;

class PageAdminController extends AbstractAdminController
{
    public function __construct(AuthService $authService, private PagesRepository $pagesRepository)
    {
        parent::__construct($authService);
    }

    public function index(): void
    {
        $pages = $this->pagesRepository->fetchAllPages();
        $this->render('pages/index', [
            'pages' => $pages,
        ]);
    }

    public function create(): void
    {
        $errors = [];

        if (!empty($_POST)) {
            $title = @(string)($_POST['title'] ?? '');
            $slug = @(string)($_POST['slug'] ?? '');
            $content = @(string)($_POST['content'] ?? '');

            $slug = normalizeSlug($slug);

            if (empty($title) || empty($slug) || empty($content)) {
                $errors[] = 'Please fill in all the fields.';
            }

            $isSlugExist = $this->pagesRepository->fetchBySlug($slug);
            if (isset($isSlugExist)) {
                $errors[] = 'This slug already exists.';
            }

            if (empty($errors)) {
                $res = $this->pagesRepository->createNewPage(title: $title, slug: $slug, content: $content);
                if ($res) {
                    header('Location: index.php?route=admin/pages');
                    die();
                }
            }
        }

        $this->render('pages/create', [
            'errors' => $errors,
        ]);
    }

    public function edit(): void
    {
        $errors = [];

        $page = [];
        $id = (int)$_GET['id'];

        if (!isset($id)) {
            header('Location: index.php?route=admin/pages');
            die;
        }

        $page['id'] = $id;

        if (!empty($_POST)) {
            if (!empty($_POST['title'])) {
                $page['title'] = $_POST['title'];
            }
            if (!empty($_POST['slug'])) {
                $page['slug'] = $_POST['slug'];
            }
            if (!empty($_POST['content'])) {
                $page['content'] = $_POST['content'];
            }

            if (!empty($_POST['title']) && !empty($_POST['slug']) && !empty($_POST['content'])) {
                $prevPage = $this->pagesRepository->fetchById($id);
                if ($_POST['title'] === $prevPage->title &&
                    $_POST['slug'] === $prevPage->slug &&
                    $_POST['content'] === $prevPage->content) {
                    $errors[] = 'Nothing to change.';
                } else {
                    $res = $this->pagesRepository->editPage(
                        id: $id, title: $page['title'], slug: $page['slug'], content: $page['content']
                    );

                    if ($res) {
                        header('Location: index.php?route=admin/pages');
                        die;
                    }
                }
            } else {
                $errors[] = 'Please fill in all the fields.';
            }
        } else {
            $pageFromDB = $this->pagesRepository->fetchById($id);

            if (!$pageFromDB) {
                header('Location: index.php?route=admin/pages');
                die;
            }

            $page['title'] = $pageFromDB->title;
            $page['slug'] = $pageFromDB->slug;
            $page['content'] = $pageFromDB->content;
        }

        $this->render('pages/edit', [
            'page' => $page,
            'errors' => $errors,
        ]);
    }

    public function delete(): void
    {
        if (empty($_POST) || mb_strtoupper($_POST['_method']) !== 'DELETE') {
            return;
        }

        $id = (int)$_POST['id'];
        $res = $this->pagesRepository->deletePage($id);

        if ($res) {
            header('Location: index.php?route=admin/pages');
            die();
        }
    }
}