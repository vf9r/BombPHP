<?php
namespace App\Core;

class Generic {
    
    /**
     * @since 4.13.25
     * @var static Holds a static instance of the parent class.
     */
    
    private static $instance = null;

    /**
     * Returns a static instance of the parent class.
     * 
     * @since 4.13.25
     * @return static
     */

    public static function singleton() {
        if (self::$instance === null) {
            self::$instance = new static;
        }
        return self::$instance;
    }
}
?>