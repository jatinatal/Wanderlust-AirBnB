<?php

function redirect($filename)
{
    if (!headers_sent())
        header('Location: ' . $filename);
    else {
        echo '<script type="text/javascript">';
        echo 'window.location.href = \'' . $filename . '\';';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=\'' . $filename . '\'" />';
        echo '</noscript>';
    }
    exit();
}