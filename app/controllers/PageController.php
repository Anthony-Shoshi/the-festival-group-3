<?php

namespace App\Controllers;

use App\Models\Page;
use App\Services\PageService;
use Exception;

class PageController
{
    private PageService $pageService;

    public function __construct()
    {
        $this->pageService = new PageService();
    }

    public function create()
    {
        try {
            // Assuming there's a view file to display the form for creating a new page
            require_once __DIR__ . '/../views/backend/pages/create.php';
        } catch (Exception $e) {
            // Handle error appropriately, e.g., redirect to error page
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function store()
    {
        try {
            $page = new Page($_POST['title'], $_POST['content'], $_POST['slug']);
            $this->pageService->createPage($page);
            // Redirect to the index page or any other page as needed
            header("Location: /pages");
            exit();
        } catch (Exception $e) {
            // Handle error appropriately, e.g., redirect to error page
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function edit(int $page_id)
    {
        try {
            $page = $this->pageService->getPageById($page_id);
            // Assuming there's a view file to display the form for editing the page
            require_once __DIR__ . '/../views/backend/pages/edit.php';
        } catch (Exception $e) {
            // Handle error appropriately, e.g., redirect to error page
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function update(int $page_id)
    {
        try {
            $page = new Page($_POST['title'], $_POST['content'], $_POST['slug'], $page_id);
            $this->pageService->updatePage($page);
            // Redirect to the index page or any other page as needed
            header("Location: /pages");
            exit();
        } catch (Exception $e) {
            // Handle error appropriately, e.g., redirect to error page
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function delete(int $page_id)
    {
        try {
            $this->pageService->deletePage($page_id);
            // Redirect to the index page or any other page as needed
            header("Location: /pages");
            exit();
        } catch (Exception $e) {
            // Handle error appropriately, e.g., redirect to error page
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function index()
    {
        try {
            $pages = $this->pageService->getAllPages();
            // Assuming there's a view file to display all pages
            require_once __DIR__ . '/../views/backend/pages/index.php';
        } catch (Exception $e) {
            // Handle error appropriately, e.g., redirect to error page
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }
}
