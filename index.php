<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/App/Core/Framework.php";
use App\Core\Database;
use App\Core\Route;

require_once $_SERVER["DOCUMENT_ROOT"] . '/App/Routes/web.php';
Route::dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
?>