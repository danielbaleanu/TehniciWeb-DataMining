<?php

function sanitize($txt)
{

    $txt = htmlspecialchars($txt);

    $txt = trim($txt);

    $txt = stripslashes($txt);

    return $txt;
}
