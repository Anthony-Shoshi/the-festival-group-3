<?php

namespace App\Repositories;

use App\Models\Section;
use Exception;
use PDO;

class SectionRepository extends Repository
{
    public function create(Section $section): bool
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO sections (section_title, content, image_url, page_id) VALUES (:section_title, :content, :image_url, :page_id)");
            $stmt->execute([
                ':section_title' => $section->getSectionTitle(),
                ':content' => $section->getContent(),
                ':image_url' => $section->getImageUrl(),
                ':page_id' => $section->getPageId()
            ]);
            return true;
        } catch (Exception $e) {
            throw new Exception("Error creating section: " . $e->getMessage());
        }
    }

    public function update(Section $section): bool
    {
        try {
            $stmt = $this->connection->prepare("UPDATE sections SET section_title = :section_title, content = :content, image_url = :image_url WHERE section_id = :section_id");
            $stmt->execute([
                ':section_title' => $section->getSectionTitle(),
                ':content' => $section->getContent(),
                ':image_url' => $section->getImageUrl(),
                ':section_id' => $section->getSectionId()
            ]);
            return true;
        } catch (Exception $e) {
            throw new Exception("Error updating section: " . $e->getMessage());
        }
    }

    public function delete(int $section_id): bool
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM sections WHERE section_id = :section_id");
            $stmt->execute([':section_id' => $section_id]);
            return true;
        } catch (Exception $e) {
            throw new Exception("Error deleting section: " . $e->getMessage());
        }
    }

    public function getById(int $section_id): ?Section
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM sections WHERE section_id = :section_id");
            $stmt->execute([':section_id' => $section_id]);
            $sectionData = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($sectionData) {
                return new Section(
                    $sectionData['section_title'],
                    $sectionData['content'],
                    $sectionData['image_url'],
                    $sectionData['page_id'],
                    $sectionData['section_id']
                );
            }
            return null;
        } catch (Exception $e) {
            throw new Exception("Error retrieving section: " . $e->getMessage());
        }
    }

    public function getAllByPageId(int $page_id): array
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM sections WHERE page_id = :page_id");
            $stmt->execute([':page_id' => $page_id]);
            $sections = [];
            while ($sectionData = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $sections[] = new Section(
                    $sectionData['section_title'],
                    $sectionData['content'],
                    $sectionData['image_url'],
                    $sectionData['page_id'],
                    $sectionData['section_id']
                );
            }
            return $sections;
        } catch (Exception $e) {
            throw new Exception("Error retrieving sections by page ID: " . $e->getMessage());
        }
    }
}
