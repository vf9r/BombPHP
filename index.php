<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/App/Core/Framework.php";
use App\Core\Database;

Database::hi();
$pdo = new Database("PDO");
?>

<style>
    * {
    background-color:black;
    color:white;
    }
</style>