<?php
namespace App\Core\Database;

interface DatabaseInterface {

    /**
     * Established a database connection.
     * 
     * @since 4.13.25
     * @return void
     */

    public function connect(): void;

    /**
     * Returns the current database connection.
     * 
     * @since 4.13.25
     * @return PDO|myqsli
     */

    public function getConnection();

}

?>