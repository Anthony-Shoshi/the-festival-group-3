<?php

namespace App\Helpers;

use Exception;

class Helper
{
    public static function slug($text)
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text . '-' . time();
    }

    public static function debug($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        exit;
    }

    public static function baseUrl()
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        $base_url = $protocol . "://" . $host;

        return $base_url;
    }

    public static function uploadFile($file, $destinationDirectory)
    {
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];

        if ($fileError === UPLOAD_ERR_OK) {
            $newFileName = uniqid('', true) . '_' . $fileName;
            $uploadPath = $destinationDirectory . '/' . $newFileName;
            if (move_uploaded_file($fileTmpName, $uploadPath)) {
                return $uploadPath;
            } else {
                throw new Exception('Error moving uploaded file');
            }
        } else {
            throw new Exception('Error uploading file: ' . $fileError);
        }
    }
}
