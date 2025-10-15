<?php

namespace App\Admin\Controller;

use App\Repository\PagesRepository;

class PageAdminController extends AbstractAdminController
{
    public function __construct(private PagesRepository $pagesRepository)
    {

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

            if (empty($title) || empty($slug) || empty($content)) {
                $errors[] = 'Please fill in all the fields.';
            }

            $slug = normalizeSlug($slug);

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
}