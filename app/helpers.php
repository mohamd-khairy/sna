<?php
if (!function_exists('prepare_image_path')) {
    function prepare_image_path($html)
    {
        // return str_replace("frontend/img", '../public/frontend/img', $html);
        return $html;
 
    }
}
?>