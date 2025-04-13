<?php
namespace App\Core;

use App\Core\Generic;
use App\Core\Database;
use App\Core\Database\DatabaseInterface;
use App\Core\Database\PDODriver;
use App\Core\Database\MySQLiDriver;

class Database extends Generic {

    /**
     * @since 4.13.25
     * @var array Map of valid drivers for parameter validation
     */

    private array $drivers = [
        "pdo" => \App\Core\Database\PDODriver::class,
        "mysqli" => \App\Core\Database\MySQLiDriver::class
    ];

    /**
     * Creates a new database instance.
     * 
     * @since 4.13.25
     * @param string $driver The requested database driver.
     * @throws \Exception If the driver does not exist or corresponding class does not exist.
     * @return DatabaseInterface The found database driver.
     */

    public function __construct(string $driver) {
        if (!isset($this->drivers[strtolower($driver)])) {
            throw new \Exception("Driver $driver does not exist.");
        }
        
        $class = $this->drivers[strtolower($driver)];

        if (!class_exists($class)) {
            throw new \Exception("Corresponding class for driver $driver, does not exist.");
        }

        return new $class;
    }

    /**
     * Static testing function.
     * 
     * @since 4.13.25
     * @return void
     */

    public static function hi() {
        echo "hi";
    }

}
?>