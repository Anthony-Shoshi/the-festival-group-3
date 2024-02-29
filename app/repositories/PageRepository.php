<?php

namespace App\Repositories;

use App\Models\Page;
use Exception;
use PDO;
use PDOException;

class PageRepository extends Repository
{
    public function create(Page $page): bool
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO pages (title, content, slug) VALUES (:title, :content, :slug)");
            $stmt->execute([
                ':title' => $page->getTitle(),
                ':content' => $page->getContent(),
                ':slug' => $page->getSlug()
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function update(Page $page): bool
    {
        try {
            $stmt = $this->connection->prepare("UPDATE pages SET title = :title, content = :content, slug = :slug WHERE page_id = :page_id");
            $stmt->execute([
                ':page_id' => $page->getPageId(),
                ':title' => $page->getTitle(),
                ':content' => $page->getContent(),
                ':slug' => $page->getSlug()
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function delete(int $page_id): bool
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM pages WHERE page_id = :page_id");
            $stmt->execute([':page_id' => $page_id]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function findBySlug(string $slug): ?Page
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM pages WHERE slug = :slug");
            $stmt->execute([':slug' => $slug]);
            $pageData = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($pageData) {
                return new Page(
                    $pageData['title'],
                    $pageData['content'],
                    $pageData['slug'],
                    $pageData['page_id']
                );
            }
            return null;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function getById(int $page_id): ?Page
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM pages WHERE page_id = :page_id");
            $stmt->execute([':page_id' => $page_id]);
            $pageData = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($pageData) {
                return new Page(
                    $pageData['title'],
                    $pageData['content'],
                    $pageData['slug'],
                    $pageData['page_id']
                );
            }
            return null;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function getAll(): array
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM pages");
            $stmt->execute();
            $pages = [];
            while ($pageData = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $pages[] = new Page(
                    $pageData['title'],
                    $pageData['content'],
                    $pageData['slug'],
                    $pageData['page_id']
                );
            }
            return $pages;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
}
