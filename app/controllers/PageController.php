<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Models\Page;
use App\Models\Section;
use App\Services\PageService;
use App\Services\SectionService;
use Exception;

class PageController
{
    private PageService $pageService;
    private SectionService $sectionService;

    public function __construct()
    {
        $this->pageService = new PageService();
        $this->sectionService = new SectionService();
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
            if (!isset($_POST['title'], $_POST['page_url'])) {
                throw new Exception("Title and page URL are required.");
            }

            $slug = Helper::slug($_POST['title']);
            $page = new Page($_POST['title'], $_POST['page_url'], $slug);
            $pageId = $this->pageService->createPage($page);

            if (isset($_POST['section_title'])) {
                $sectionTitles = $_POST['section_title'];

                foreach ($sectionTitles as $index => $sectionTitle) {                    
                    if (!isset($sectionTitle)) {
                        continue;
                    }

                    $sectionContent = isset($_POST['section_content'][$index]) ? $_POST['section_content'][$index] : "";

                    if (isset($_FILES['image_url']['name'][$index], $_FILES['image_url']['tmp_name'][$index]) && $_FILES['image_url']['name'][$index] != "" && $_FILES['image_url']['tmp_name'][$index]) {
                        $fileName = $_FILES['image_url']['name'][$index];
                        $tmpFilePath = $_FILES['image_url']['tmp_name'][$index];

                        $uploadDir = __DIR__ . '/../public/images/';

                        $newFileName = uniqid('', true) . '_' . $fileName;

                        $uploadPath = $uploadDir . $newFileName;

                        if (!move_uploaded_file($tmpFilePath, $uploadPath)) {
                            $_SESSION['isError'] = 1;
                            $_SESSION['flash_message'] = "Error uploading file: $fileName";
                            header("Location: /page");
                            exit();
                        }

                        $imageUrl = '/images/' . $newFileName;
                    } else {
                        $imageUrl = "";
                    }

                    $sectionPageId = $pageId;

                    $section = new Section($sectionTitle, $sectionContent, $imageUrl, $sectionPageId);

                    $this->sectionService->createSection($section);
                }
            } else {
                $_SESSION['isError'] = 1;
                $_SESSION['flash_message'] = "Please provide at least a title for each section!";
                header("Location: /page");
                exit();
            }

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
