<?php

namespace App\Frontend\Controller;

use App\Repository\PagesRepository;

class NotFoundController extends AbstractController
{
    public function __construct(PagesRepository $pagesRepository)
    {
        parent::__construct($pagesRepository);
    }

    public function error404(): void
    {
        parent::error404();
    }
}