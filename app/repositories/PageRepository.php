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

    public function update(Page $page, $page_id): bool
    {
        try {
            $stmt = $this->connection->prepare("UPDATE pages SET title = :title, content = :content WHERE page_id = :page_id");
            $stmt->execute([
                ':page_id' => $page_id,
                ':title' => $page->getTitle(),
                ':content' => $page->getContent()
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

    public function getById(int $page_id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM pages WHERE page_id = :page_id");
            $stmt->bindParam(':page_id', $page_id);
            $stmt->execute();
            $pageRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                return $pageRow;
            }
            return null;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM pages");
            $stmt->execute();
            $pages = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $pages;
        } catch (PDOException $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }
}
