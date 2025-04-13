<?php
use App\Core\Route;

function basicRoute() {
    echo "on bomb";
}

Route::get('/', basicRoute());
?>