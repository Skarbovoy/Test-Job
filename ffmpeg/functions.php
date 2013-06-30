<?php

if (!function_exists("debugvar")) {

    function debugvar($var, $title = '')
    {
        ob_start();
        if ($title)
            echo "$title\n";
        print_r($var);
        $out = ob_get_clean();
        echo "<pre>";
        echo htmlentities($out);
        echo "</pre>";
    }

}

?>