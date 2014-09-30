<?php
/**
 * Created by Md. Mahedi Azad.
 * Date: 8/18/14
 * Time: 11:07 AM
 */

class ImageConverter {

    /**
     * Function for resizing any jpg, gif, or png image files
     *
     * @param $target source image path 'upload/example.jpg'
     * @param $newcopy new image path 'upload/resize/example.jpg'
     * @param $w width of new image '500'
     * @param $h height of new image '500'
     * @param $ext extension of old image i.e jpg, png, gif getting function end(explode('.', 'imagename_with_extension'))
     */
    public function imageResize($target, $newcopy, $w, $h)
    {
        $ext = end(explode('.', $target));
        list($w_orig, $h_orig) = getimagesize($target);
        $scale_ratio = $w_orig / $h_orig;
        if (($w / $h) > $scale_ratio) {
            $w = $h * $scale_ratio;
        } else {
            $h = $w / $scale_ratio;
        }

        $img = "";
        $ext = strtolower($ext);
        if ($ext == "gif"){
            $img = imagecreatefromgif($target);
        } else if($ext =="png"){
            $img = imagecreatefrompng($target);
        } else {
            $img = imagecreatefromjpeg($target);
        }

        $tci = imagecreatetruecolor($w, $h);
        // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
        imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
        if ($ext == "gif"){
            imagegif($tci, $newcopy);
        } else if($ext =="png"){
            imagepng($tci, $newcopy);
        } else {
            imagejpeg($tci, $newcopy, 84);
        }
    }


    /**
     * Function for creating a true thumbnail cropping from any jpg, gif, or png image files
     *
     * @param $target source image path 'upload/example.jpg'
     * @param $newcopy new image path 'upload/resize/example.jpg'
     * @param $w width of new image '500'
     * @param $h height of new image '500'
     * @param $ext extension of old image i.e jpg, png, gif getting function end(explode('.', 'imagename_with_extension'))
     */

    public function img2Thumb($target, $newcopy, $w, $h, $ext)
    {
        list($w_orig, $h_orig) = getimagesize($target);
        $src_x = ($w_orig / 2) - ($w / 2);
        $src_y = ($h_orig / 2) - ($h / 2);
        $ext = strtolower($ext);
        $img = "";

        if ($ext == "gif"){
            $img = imagecreatefromgif($target);
        } else if($ext =="png"){
            $img = imagecreatefrompng($target);
        } else {
            $img = imagecreatefromjpeg($target);
        }

        $tci = imagecreatetruecolor($w, $h);
        imagecopyresampled($tci, $img, 0, 0, $src_x, $src_y, $w, $h, $w, $h);
        if ($ext == "gif"){
            imagegif($tci, $newcopy);
        } else if($ext =="png"){
            imagepng($tci, $newcopy);
        } else {
            imagejpeg($tci, $newcopy, 84);
        }
    }

    /**
     * Function for converting GIFs and PNGs to JPG upon upload
     *
     * @param $target "uploads/resize/exampleImage.jpg"
     * @param $newcopy new jpg image file path  "uploads/resize/newExampleImage.jpg"
     * @param $ext extension of old image i.e jpg, png, gif getting function end(explode('.', 'imageName_with_extension'))
     */
    public function imgConvert2JPG($target, $newcopy)
    {
        $ext = end(explode('.', $target));
        list($w_orig, $h_orig) = getimagesize($_SERVER['DOCUMENT_ROOT'].'/'.$target);
        $ext = strtolower($ext);
        $img = "";
        if ($ext == "gif"){
            $img = imagecreatefromgif($target);
        } else if($ext =="png"){
            $img = imagecreatefrompng($target);
        }
        $tci = imagecreatetruecolor($w_orig, $h_orig);
        imagecopyresampled($tci, $img, 0, 0, 0, 0, $w_orig, $h_orig, $w_orig, $h_orig);
        imagejpeg($tci, $newcopy, 84);
    }


}
