<?php
$currentPath = "/var/log/nginx/";
//$commandPath = ".././log/nginx";
$commandPath = ".././apache2/error_log";
//$commandPath = ".././lib/postfix";
//$commandPath = "/var/log/nginx";
//$commandPath = "../../xdebug.log";



/**
 * Функция realpath проверяет существует ли файл или директория
 * Проверено на моей системе, где есть такой файл error_log
 * $currentPath = "/var/log/nginx/";
 * $commandPath = ".././apache2/error_log";
 * @param $currentPath string
 * @param $commandPath string
 * @return string
 */
function myRealPath(string $currentPath, string $commandPath): string
{
    $preparedCommandPath = prepareStringPath($commandPath);
    if (checkForAbsolutePath($preparedCommandPath)) {
        return $preparedCommandPath;
    }
    $preparedCurrentPath = prepareStringPath($currentPath);
    if ($realPath = realpath($preparedCurrentPath . $preparedCommandPath)) {
        return $realPath;
    }
    return 'Файл не найден';
}



/**
 * Подготавливает строку, в зависимости от системы
 * Windows \ использует
 * Unix /
 * Приводит все к DIRECTORY_SEPARATOR
 * чтобы работало на любой запущенной системе, не зависимо какой получен путь
 * @param $path string
 * @return string
 */
function prepareStringPath(string $path): string
{
    return str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
}

/** В Unix системе путь, начинающий с /
 * даст результат от корня системы, независимо какой будет $currentPath
 * поэтому cd $commandPath /var/log/nginx/ перейдет именно в эту директорию,
 * независимо от того, в какой категории находится скрипт
 * @param $path string
 * @return bool
 */
function checkForAbsolutePath(string $path): bool
{
    if ($path[0] === DIRECTORY_SEPARATOR) {
        return true;
    }
    return false;
}

function myCd($currentPath, $commandPath)
{
    // РЕШЕНИЕ


    $result = "/var/log/nginx";
    return $result;
}


echo myRealPath($currentPath, $commandPath);
