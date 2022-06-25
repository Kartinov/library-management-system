<?php

/**
 * It dumps the variable and stops the execution of the script.
 * 
 * @param variable The variable you want to dump.
 */
function dd($variable)
{
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';

    die();
}

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
function session_has($name)
{
    return isset($_SESSION[$name])
        ? true
        : false;
}

function session_get($session_name)
{
    return $_SESSION[$session_name] ?? null;
}

/**
 * It stores the data in the session.
 * 
 * @param session_key The key to store the data under in the session.
 * @param data The data to be stored in the session.
 */
function session_put($session_key, $data)
{
    $_SESSION[$session_key] = $data;
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

    return null;
}

function old($key)
{
    if (session_has('old')) {
        if (isset($_SESSION['old'][$key])) {
            $val = $_SESSION['old'][$key];
            unset($_SESSION['old'][$key]);
            return $val;
        }
    }

    return null;
}

/**
 * If the request method is not POST, redirect.
 */
function postOnly()
{
    if ($_SERVER['REQUEST_METHOD'] != 'POST') redirect();
}

function guestOnly()
{
    if (session_has('user')) redirect();
}

function authOnly()
{
    if (!session_has('user')) redirect();
}

function adminOnly()
{
    if (session_get('user')->role != 'admin') redirect();
}
