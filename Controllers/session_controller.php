<?php

    class Session {
        
        public static function start() {
            if (!isset($_SESSION['id'])) {
                session_start(); 
            }
        }

        public static function end() {
            if (isset($_SESSION['id'])) {
                session_destroy(); 
            }
        }

    }
    

?>