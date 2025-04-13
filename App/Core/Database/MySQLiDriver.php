<?php
namespace App\Core\Database;

use App\Core\Database\DatabaseInterface;
use mysqli;

/**
 * Cited sources:
 * 
 * https://www.php.net/manual/en/function.mysqli-report.php
 * https://www.php.net/manual/en/class.mysqli.php
 * 
 */

class MySQLiDriver implements DatabaseInterface {

    /**
     * @since 4.13.25
     * @var mysqli|null Stores the MySQLi instance.
     */

    private mysqli $mysqli;

    /**
     * @see DatabaseInterface->connect()
     */

    public function connect(): void {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->mysqli = new mysqli(getenv("DB_HOST"), getenv("DB_USER"), getenv("DB_PASS"), getenv("DB_NAME"));
        $this->mysqli->set_charset(getenv("DB_CHARSET"));
    }

    /**
     * @see DatabaseInterface->connect()
     */

    public function getConnection() {
        return $this->mysqli;
    }

}
?>