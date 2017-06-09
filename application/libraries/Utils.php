<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Utils {

    public function redirectPage($pageName) {
        redirect(base_url() . $pageName);
    }
    public function isEmptyPost($fields) {
        $error = false;
        foreach ($fields as $field) {
            if (empty($_POST[$field])) {
                $error = true;
            }
        }
        return $error;
    }
    public function inflatePost($fields)
    {
        $result = array();        
        foreach ($fields as $field) {            
            $result[$field] = $_POST[$field];
        }
        return $result;
    }
    
    public function uploadImage($m_image, $index, $width = 320, $height = 420) {
        $upload_file = $m_image['tmp_name'];
        $path_parts = pathinfo($m_image['name']);
        if (($path_parts['basename'] == "") || ((strtolower($path_parts['extension']) != 'jpg') and ( strtolower($path_parts['extension']) != 'png'))) {
            return "";
        }
        $date = new DateTime();
        $name = $date->getTimestamp();
        $filename = $name . "_" . $index . "." . $path_parts["extension"];
        $m_imgPath = BASEPATH . '../upload/' . $filename;
        if (is_uploaded_file($upload_file))
            move_uploaded_file($upload_file, $m_imgPath);
        $thumb_filename = '/upload/' . $filename;
        $this->resizeThumbnailImage($m_imgPath, $m_imgPath, $width, $height);
        return $thumb_filename;
    }

    function resizeThumbnailImage($thumb_path, $org_image_path, $width = 320, $height = 420) {
        list($imagewidth, $imageheight, $imageType) = getimagesize($org_image_path);
        $imageType = image_type_to_mime_type($imageType);

        $newImageWidth = $width;
        $newImageHeight = $height;
        $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
        switch ($imageType) {
            case "image/gif":
                $source = imagecreatefromgif($org_image_path);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source = imagecreatefromjpeg($org_image_path);
                break;
            case "image/png":
            case "image/x-png":
                $source = imagecreatefrompng($org_image_path);
                break;
        }
        imagecopyresampled($newImage, $source, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $imagewidth, $imageheight);
        switch ($imageType) {
            case "image/gif":
                imagegif($newImage, $thumb_path);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage, $thumb_path, 90);
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage, $thumb_path);
                break;
        }
        chmod($thumb_path, 0777);
        return $thumb_path;
    }
    
}
