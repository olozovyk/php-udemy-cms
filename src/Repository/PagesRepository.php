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
        $stmt = $this->pdo->prepare('SELECT `id`, `slug`, `title`, `content`, `image` FROM `pages` ORDER BY `id`');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, PageModel::class);
    }

    public function fetchAllPages(): array
    {
        return $this->fetchForNavigation();
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

    public function fetchById(int $id): ?PageModel
    {
        $stmt = $this->pdo->prepare('SELECT `id`, `slug`, `title`, `content` FROM `pages` WHERE `id` = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, PageModel::class);
        $page = $stmt->fetch();

        if (empty($page)) {
            return null;
        }
        return $page;
    }

    public function createNewPage(string $title, string $slug, string $content): bool
    {
        try {
            $stmt = $this->pdo->prepare('INSERT INTO `pages` (`title`, `slug`, `content`) VALUES (:title, :slug, :content)');
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':slug', $slug);
            $stmt->bindValue(':content', $content);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function editPage(int $id, string $title, string $slug, string $content): bool
    {
        try {
            $stmt = $this->pdo->prepare('
                UPDATE `pages` 
                SET `title` = :title, `slug` = :slug, `content` = :content
                WHERE `id` = :id
                ');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':slug', $slug);
            $stmt->bindValue(':content', $content);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function deletePage(int $id): bool
    {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM `pages` WHERE `id` = :id');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (\PDOException $e) {
            return false;
        }
    }
}