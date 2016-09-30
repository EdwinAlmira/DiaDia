<?php
Class Validator
{
    public static function validateForm($fields)
    {
        foreach ($fields as $index => $value) {
            $value = trim($value);
            $fields[$index] = $value;
        }
        return $fields;
    }

    public static function validateImage($file)
    {
        $img_size = $file["size"];
            $img_type = $file["type"];
            if($img_type == "image/jpeg" || $img_type == "image/png" || $img_type == "image/gif")
            {
                $img_temporal = $file["tmp_name"];
                $img_info = getimagesize($img_temporal);
                    $image = file_get_contents($img_temporal);
                    return base64_encode($image);
            }
            else
            {
                return false;
            }
    }

}
?>