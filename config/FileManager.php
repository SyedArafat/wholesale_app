<?php

class FileManager
{
    public function uploadImageAndGetPath($key, $destination_folder)
    {
        if($_FILES[$key]) {
            $img = $_FILES[$key]['name'];
            $tmp = $_FILES[$key]['tmp_name'];
            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            if(in_array($ext, Statics::VALID_IMAGE_EXTENSIONS)) {
                $final_image = rand(1000, 1000000) . "_" . $img;
                $path = $destination_folder . strtolower($final_image);
                if(move_uploaded_file($tmp, $this->getRootPath() .$path)) return $path;
            }
        }

        return false;
    }

    private function getRootPath(): string
    {
        return __DIR__ . "/..";
    }
}