<?php

namespace App\Models;

class Section
{
    private ?int $section_id;
    private string $section_title;
    private ?string $content;
    private ?string $image_url;
    private int $page_id;

    public function __construct(string $section_title, string $content, string $image_url, int $page_id, ?int $section_id = null)
    {
        $this->section_id = $section_id;
        $this->section_title = $section_title;
        $this->content = $content;
        $this->image_url = $image_url;
        $this->page_id = $page_id;
    }

    public function getSectionId(): ?int
    {
        return $this->section_id;
    }

    public function setSectionId(?int $section_id): void
    {
        $this->section_id = $section_id;
    }

    public function getSectionTitle(): string
    {
        return $this->section_title;
    }

    public function setSectionTitle(string $section_title): void
    {
        $this->section_title = $section_title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getImageUrl(): string
    {
        return $this->image_url;
    }

    public function setImageUrl(string $image_url): void
    {
        $this->image_url = $image_url;
    }

    public function getPageId(): int
    {
        return $this->page_id;
    }

    public function setPageId(int $page_id): void
    {
        $this->page_id = $page_id;
    }
}
