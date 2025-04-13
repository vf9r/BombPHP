<?php
namespace App\Core;

/**
 * Cited sources:
 * 
 * https://www.php.net/manual/en/function.is-readable.php
 * https://www.php.net/manual/en/class.invalidargumentexception.php
 * https://www.php.net/manual/en/function.file.php
 * https://www.php.net/manual/en/function.preg-match.php
 * https://stackoverflow.com/questions/67963371/load-a-env-file-with-php
 * 
 */

class Environment {

    /**
     * @since 4.13.25
     * @var string The path of the .env file.
     */

    protected string $envPath;

    /**
     * Create a new environment instance.
     * 
     * @since 4.13.25
     * @param string $envPath
     * @return void
     */

    public function __construct($envPath) {
        if (!is_readable($envPath)) {
            throw new InvalidArgumentException("The .env file cannot be found at the given path.");
        }

        $this->envPath = $envPath;
    }

    /**
     * Loads all environment variables from a specific .env file.
     * 
     * @since 4.13.25
     * @param string $envPath The path of the .env file.
     * @throws Exception If the given .env file cannot be found.
     * @return void
     */
    
    public function parse() {
        $lines = file($this->envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $lineNumber => $line) {
            $line = trim($line);
            if (empty($line) || $line[0] == "#") {
                continue;
            }

            $broken = explode("=", $line, 2);
            if (count($broken) != 2) {
                continue;
            }

            $key = trim($broken[0]);
            $value = ($broken[1]);

            if (preg_match('/^["\'].*["\']$/', $value)) {
                $value = substr($value, 1, -1);
            }

            putenv("$key=$value");
        }
    }

}
?>