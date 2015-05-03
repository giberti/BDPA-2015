<?php

/**
 * Returns the current filename
 */
function getFilename() {
    $path = explode('/', $_SERVER['PHP_SELF']);
    return array_pop($path);
}
