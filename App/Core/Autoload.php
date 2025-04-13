<?php
spl_autoload_register(function ($className) {
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $file = $_SERVER["DOCUMENT_ROOT"] . '/' . $classPath . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});
?>