<?php

class  Image
{

    public static function watermark($wm_path, $image_path, $quality = 90)
    {
        $watermark = imagecreatefrompng($wm_path);
        $wm_width = imagesx($watermark);
        $wm_height = imagesy($watermark);
        $image = imagecreatefromjpeg($image_path);
        $width = imagesx($image);
        $height = imagesy($image);
        $dest_x =$width-$wm_width;
        $dest_y = $height-$wm_height;
        imagecopy($image, $watermark, $dest_x, $dest_y, 0, 0, $wm_width, $wm_height);
        imagejpeg($image, $image_path, $quality);
        imagedestroy($image);
        imagedestroy($watermark);
    }

    public static function createThumb($pathToImage, $pathToThumb, $thumb_sufix, $width, $height, $crop = false, $quality = 50, $watermark = FALSE)
    {
        $message = '';
        $info = pathinfo($pathToImage);
        $filename = $info['basename'];
        $ext = strtolower($info['extension']);
        // continue only if this is a JPEG image or PNG
        if ($ext == 'jpg' or $ext == 'jpeg' or $ext == 'png') {
            // load image and get image size
            if ($ext == "png") {
                $img = imagecreatefrompng($pathToImage);
                $quality = $quality / 10;
            } else {
                $img = imagecreatefromjpeg($pathToImage);
            }
            $w_original = imagesx($img);
            $h_original = imagesy($img);
            $w = imagesx($img);
            $h = imagesy($img);
            // calculate thumbnail size
            if ($crop) {

                $ratio = max($width / $w, $height / $h);
                $h = $height / $ratio;
                $w = $width / $ratio;
                $y = ($h_original - $h) / 2;
                $x = ($w_original - $w) / 2;

            }
            else
            {
                if ($w < $width and $h < $height)
                {
                    $width = $w;
                    $height = $h;
                }
                $ratio = min($width / $w, $height / $h);
                $width = $w * $ratio;
                $height = $h * $ratio;
                $x = 0;
                $y = 0;
            }
            // create a new temporary image
            $tmp_img = imagecreatetruecolor($width, $height);
            // copy and resize old image into new image
            if ($ext == "png") {
                imagealphablending($tmp_img, false);
                imagesavealpha($tmp_img, true);

            }
            imagecopyresampled($tmp_img, $img, 0, 0, $x, $y, $width, $height, $w, $h);
            if ($pathToThumb != '') {
                if (!is_dir($pathToThumb)) {
                    mkdir($pathToThumb);
                }
                $path = $pathToThumb . $thumb_sufix . $filename;
            } else {
                $path = $pathToImage;
            }
            // save thumbnail into a file
            if ($ext == "png") {
                imagepng($tmp_img, $path, $quality);
            } else {
                imagejpeg($tmp_img, $path, $quality);
            }
            //watermark
            if ($watermark != '') {
                self::watermark($watermark, $path, $quality);
                $message = $path;
                return $message;
            }
        } else {
            $message = 'Uknown extension!';
            return $message;
        }
        return $message;
    }

    public static function createThumbs($pathToImages, $pathToThumbs, $l_width, $l_height, $m_width, $m_height, $s_width, $s_height, $quality, $watermark)
    {
        if (!is_dir($pathToThumbs)) {
            mkdir($pathToThumbs);
        }
        // open the directory
        $dir = opendir($pathToImages);
        // loop through it, looking for any/all JPG files:
        while (false !== ($fname = readdir($dir))) {
            // parse path for the extension
            $info = pathinfo($pathToImages . $fname);
            // continue only if this is a JPEG image
            if (strtolower($info['extension']) == 'jpg' or strtolower($info['extension']) == 'jpeg') {
                self::createThumb($pathToImages . $fname, $pathToThumbs, 'l_', $l_width, $l_height, false, $quality, $watermark);
                self::createThumb($pathToImages . $fname, $pathToThumbs, 'm_', $m_width, $m_height, true, $quality);
                self::createThumb($pathToImages . $fname, $pathToThumbs, 's_', $s_width, $s_height, true, $quality);
            }
        }
        // close the directory
        closedir($dir);
    }
}