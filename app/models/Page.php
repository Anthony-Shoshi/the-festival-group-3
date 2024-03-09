<?php

namespace App\Models;

class Page
{
    private ?int $page_id;
    private string $title;
    private string $page_url;
    private ?string $slug;

    public function __construct(string $title, string $page_url, ?string $slug = null, ?int $page_id = null)
    {
        $this->title = $title;
        $this->page_url = $page_url;
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

    public function getpageUrl(): string
    {
        return $this->page_url;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }
}
