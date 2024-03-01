<?php

namespace App\Controllers;

use App\Helpers\Helper;
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

    public function index()
    {
        try {
            $pages = $this->pageService->getAllPages();
            require_once __DIR__ . '/../views/backend/pages/index.php';
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function create()
    {
        try {
            require_once __DIR__ . '/../views/backend/pages/create.php';
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function store()
    {
        try {
            $slug = Helper::makeSlug($_POST['title']);
            $page = new Page($_POST['title'], $_POST['content'], $slug);
            $this->pageService->createPage($page);
            $_SESSION['isError'] = 0;
            $_SESSION['flash_message'] = "Page created successfully!";
            header("Location: /page");
            exit();
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function edit()
    {
        try {
            $page_id = $_GET['id'];
            $page = $this->pageService->getPageById($page_id);
            require_once __DIR__ . '/../views/backend/pages/edit.php';
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function update()
    {
        try {
            $page_id = $_POST['page_id'];
            $page = new Page($_POST['title'], $_POST['content']);

            $this->pageService->updatePage($page, $page_id);
            $_SESSION['isError'] = 0;
            $_SESSION['flash_message'] = "Page updated successfully!";
            header("Location: /page");
            exit();
        } catch (Exception $e) {
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function delete()
    {
        try {
            $page_id = $_GET['id'];
            $this->pageService->deletePage($page_id);
            $_SESSION['isError'] = 1;
            $_SESSION['flash_message'] = "Page deleted successfully!";
            header("Location: /page");
            exit();
        } catch (Exception $e) {
            // Handle error appropriately, e.g., redirect to error page
            header("Location: /error?message=" . urlencode($e->getMessage()));
            exit();
        }
    }
}
