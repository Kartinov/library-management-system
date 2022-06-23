<?php


/**
 * It redirects the user to a new page
 * 
 * @param path The path to redirect to. If not set, it will redirect to the home page.
 */
function redirect($path = null)
{
    global $config;

    $url = $path
        ? rtrim($config['APP_URL'], '/') . '/public/' . trim($path, '/')
        : $config['APP_URL'];

    header("Location: $url");
    die();
}

function asset($file)
{
    global $config;

    $appUrl = rtrim($config['APP_URL'], '/');
    $requestedFile = trim($file, '/');

    return "{$appUrl}/public/{$requestedFile}";
}
