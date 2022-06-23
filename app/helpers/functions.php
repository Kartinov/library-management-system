<?php

/**
 * It takes a path and returns a URL
 * 
 * @param path The path to the file or directory.
 * 
 * @return path value of the path variable.
 */
function route($path = null)
{
    global $config;

    return $path
        ? rtrim($config['APP_URL'], '/') . '/public/' . trim($path, '/')
        : $config['APP_URL'];
}

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

/*
 * This function displays a session variable's value if it exists.
*/
function session($name)
{
    return $_SESSION[$name] ?? "";
}

/*
 * This function displays a session variable's value and unsets it if it exists.
 */
function session_once($name)
{
    if (isset($_SESSION[$name])) {
        $value = $_SESSION[$name];
        unset($_SESSION[$name]);
        return $value;
    }
    return "";
}
