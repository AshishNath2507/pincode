<?php

function uju_imageAutoResize($photo, $nheight, $nwidth, $location, $imgSize)
{
    date_default_timezone_set('Asia/Kolkata');

    $allowed = array('jpg', 'jpeg', 'png');

    // Image
    $filename = $photo['name'];
    $filesize = $photo['size'];
    $filetype = $photo['type'];
    $filetemp = $photo['tmp_name'];
    $fileExt = explode('.', $filename);
    $fileActualEXt = strtolower(end($fileExt));

    if (!in_array($fileActualEXt, $allowed)) {
        $response['error'] = true;
        $response['message'] = "Invalid Image Format. Use png, jpg, jpeg only";
        $response['location'] = null;
        // echo mysqli_error($connect);
    } else if ($filesize > $imgSize) {
        // echo mysqli_error($connect);
        $response['error'] = true;
        $response['message'] = "File too large. 10MB max";
        $response['location'] = null;
    } else {
        // $filenamenew = uniqid('', true) . "." . $fileActualEXt;
        $filenamenew = date("his")."-".date('dmy') . "." . $fileActualEXt;
        list($width, $height) = getimagesize($filetemp);
        $newImage = imagecreatetruecolor($nwidth, $nheight);
        imagealphablending($newImage, false);
        imagesavealpha($newImage, true);

        switch ($filetype) {
                // case "image/gif":
                //     $source = imagecreatefromgif($filetemp);
                //     break;
            case "image/pjpeg":
                $source = imagecreatefromjpeg($filetemp);
                break;
            case "image/jpeg":
                $source = imagecreatefromjpeg($filetemp);
                break;
            case "image/jpg":
                $source = imagecreatefromjpeg($filetemp);
                break;
            case "image/png":
                $source = imagecreatefrompng($filetemp);
                break;
            case "image/x-png":
                $source = imagecreatefrompng($filetemp);
                break;
        }

        // $source = imagecreatefromjpeg($filetemp);

        imagecopyresampled($newImage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);
        $actual_location = $location . $filenamenew;

        switch ($filetype) {
                // case "image/gif":
                //     $newPhoto = imagegif($newImage, $actual_location);
                //     break;
            case "image/pjpeg":
                $newPhoto = imagejpeg($newImage, $actual_location, 100);
                break;
            case "image/jpeg":
                $newPhoto = imagejpeg($newImage, $actual_location, 100);
                break;
            case "image/jpg":
                $newPhoto = imagejpeg($newImage, $actual_location, 100);
                break;
            case "image/png":
                $newPhoto = imagepng($newImage, $actual_location, 9);
                break;
            case "image/x-png":
                $newPhoto = imagepng($newImage, $actual_location, 9);
                break;
        }

        // $newPhoto = imagejpeg($newImage, $actual_location);

        // $upload = 0;            

        if ($newPhoto) {
            $response['error'] = false;
            $response['message'] = "Photo Updated Successfully!";
            $response['location'] = $actual_location;
        } else {
            $response['error'] = true;
            $response['message'] = "Error in uploading. Please Contact Admin";
            $response['location'] = null;
        }
    }
    return json_encode($response);
}
