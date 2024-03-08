<?php

namespace App\Models;

class Page
{
    private ?int $page_id;
    private string $title;
    private string $content;
    private ?string $slug;

    public function __construct(string $title, string $content, ?string $slug = null, ?int $page_id = null)
    {
        $this->title = $title;
        $this->content = $content;
        $this->slug = $slug;
        $this->page_id = $page_id;
    }

    public function getPageId(): ?int
    {
        return $this->page_id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }
}
