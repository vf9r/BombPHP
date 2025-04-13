<?php
namespace App\Core\Database;

use App\Core\Database\DatabaseInterface;
use PDO;
use PDOException;

/**
 * Cited sources:
 * 
 * https://www.php.net/manual/en/class.pdo.php
 * https://www.php.net/manual/en/class.mysqli.php
 * 
 */

class PDODriver implements DatabaseInterface {

    /**
     * @since 4.13.25
     * @var PDO|null Stores the PDO instance.
     */

    private PDO $pdo;

    /**
     * @see DatabaseInterface->connect()
     */

    public function connect(): void {
        $dsn = "mysql:host=" . getenv("DB_HOST") . ";dbname=" . getenv("DB_NAME") . ";charset=" . getenv("DB_CHARSET");
        $this->pdo = new PDO(
            $dsn, getenv("DB_USER"), getenv("DB_PASS"), (array) getenv("PDO_OPTIONS")
        );
    }

    /**
     * @see DatabaseInterface->getConnection()
     */

    public function getConnection() {
        return $this->pdo;
    }

}
?>