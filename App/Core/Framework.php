<?php
/**
 * Written by vf9r
 * Started development on 4.13.25
 * 
 * Cited sources (general, not specific to any certain file):
 * 
 * https://developer.wordpress.org/coding-standards/inline-documentation-standards/php/
 */

require_once $_SERVER["DOCUMENT_ROOT"] . "/App/Core/Autoload.php";

use App\Core\Environment;

$envPath = $_SERVER["DOCUMENT_ROOT"] . "/.env";
$env = new Environment($envPath);
$env->parse();
?>