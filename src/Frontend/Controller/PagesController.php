<?php

namespace App\Frontend\Controller;

use \App\Repository\PagesRepository;

class PagesController extends AbstractController
{
    public function __construct(PagesRepository $pagesRepository)
    {
        parent::__construct($pagesRepository);
    }

    public function showPage(string $pageKey): void
    {
        $page = $this->pagesRepository->fetchBySlug($pageKey);
        if (!isset($page)) {
            $this->error404();
            return;
        }

        $paragraphsArray = explode("\n", $page->content);
        $paragraphsArrayTrimmed = array_filter($paragraphsArray, fn(string $p) => trim($p) !== '');

        $this->render('pages/showPage', [
            'page' => $page,
            'content' => $paragraphsArrayTrimmed
        ]);
    }
}