<?php

function asset($file)
{
    global $config;

    $appUrl = rtrim($config['APP_URL'], '/');
    $requestedFile = trim($file, '/');

    return "{$appUrl}/public/{$requestedFile}";
}
