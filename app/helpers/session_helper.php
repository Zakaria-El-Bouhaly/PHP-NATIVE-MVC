<?php
    session_start();

    function isLoggedIn() {
        if (isset($_SESSION['session_id'])) {
            return true;
        } else {
            return false;
        }
    }
