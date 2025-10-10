<?php

namespace App\Repository;

use PDO;
use \App\Model\PageModel;

readonly class PagesRepository
{
    public function __construct(private PDO $pdo)
    {

    }

    public function fetchForNavigation(): array
    {
        $stmt = $this->pdo->prepare('SELECT `id`, `slug`, `title`, `content` FROM `pages` ORDER BY `id`');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, PageModel::class);
    }

    public function fetchBySlug(string $slug): ?PageModel
    {
        $stmt = $this->pdo->prepare('SELECT `id`, `slug`, `title`, `content` FROM `pages` WHERE `slug` = :slug');
        $stmt->bindValue(':slug', $slug);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, PageModel::class);
        $page = $stmt->fetch();

        if (empty($page)) {
            return null;
        }
        return $page;
    }
}